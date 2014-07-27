<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/alert.class.php';
$do = new alert();
$menus = array (
    array('���ͷ�Դ', '?moduleid='.$moduleid.'&file='.$file.'&action=send'),
    array('ó������', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
);
$mids = array();
$tmp = explode('|', $MOD['alertid']);
foreach($tmp as $v) {
	if($v > 4 && isset($MODULE[$v])) $mids[] = $v;
}
if(in_array($action, array('', 'check'))) {
	$sfields = array('������', '�ؼ���', '��Ա��', 'Email');
	$dfields = array('word', 'word', 'username', 'email');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '����ʱ�併��', '����ʱ������', '����Ƶ�ʽ���', '����Ƶ������');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'sendtime DESC', 'sendtime ASC', 'rate DESC', 'rate ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$areaid = isset($areaid) ? intval($areaid) : 0;
	$mid = isset($mid) ? intval($mid) : 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
	if($mid) $condition .= " AND mid=$mid";
}
switch($action) {
	case 'send':
		if(isset($send)) {
			if(isset($first)) {
				$item = array();
				$item['title'] = $title;
				$item['total'] = $total;
				$item['num'] = $num;
				$item['sql'] = $sql;
				$item['ord'] = $ord;
				$item['template'] = $template;
				cache_write('alert.php', $item);
			} else {
				$item = cache_read('alert.php');
				extract($item);
			}
			if(!isset($num)) {
				$num = 5;
			}
			if(!isset($fid)) {
				$r = $db->get_one("SELECT min(itemid) AS fid FROM {$AJ_PRE}alert");
				$fid = $r['fid'] ? $r['fid'] : 0;
			}
			isset($sid) or $sid = $fid;
			if(!isset($tid)) {
				$r = $db->get_one("SELECT max(itemid) AS tid FROM {$AJ_PRE}alert");
				$tid = $r['tid'] ? $r['tid'] : 0;
			}
			if($fid <= $tid) {
				$result = $db->query("SELECT * FROM {$AJ_PRE}alert WHERE itemid>=$fid AND status=3 ORDER BY itemid LIMIT 0,$num");
				$_MOD = $MOD;
				if($db->affected_rows($result)) {
					while($r = $db->fetch_array($result)) {
						$itemid = $r['itemid'];
						$rate = $r['rate'];
						if($rate && $r['sendtime'] && $AJ_TIME - $rate*86400 < $r['sendtime']) continue;
						$kw = $r['word'];
						$mid = $r['mid'];
						$catid = $r['catid'];
						$areaid = $r['areaid'];
						$MOD = cache_read('module-'.$mid.'.php');
						$CAT = get_cat($catid);
						$condition = "status=3 AND addtime>$r[sendtime]";
						if($kw) $condition .= " AND keyword LIKE '%$kw%'";
						if($areaid) $condition .= $AREA[$areaid]['child'] ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
						if($catid) $condition .= $CAT['child'] ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
						if($sql) $condition .= ' '.$sql;
						if($ord) $condition .= ' ORDER BY '.$ord;
						$lists = array();
						$results = $db->query("SELECT * FROM ".get_table($mid)." WHERE $condition LIMIT 0,$total");
						while($rs = $db->fetch_array($results)) {
							if(strpos($rs['linkurl'], '://') === false) $rs['linkurl'] =  $MOD['linkurl'].$rs['linkurl'];
							$lists[] = $rs;
						}
						$content = ob_template($template ? $template : 'alert', 'mail');
						send_mail($r['email'], $title, $content);
						$db->query("UPDATE {$AJ_PRE}alert SET sendtime=$AJ_TIME WHERE itemid=$itemid");
					}
					$itemid += 1;
				} else {
					$itemid = $fid + $num;
				}
				$MOD = $_MOD;
			} else {
				dmsg('���ͳɹ�', "?moduleid=$moduleid&file=$file");
			}
			msg('ID��'.$fid.'��'.($itemid-1).'���ͳɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num&send=1");
		} else {
			$item = cache_read('alert.php');
			if($item) {
				extract($item);
			} else {
				$title = $AJ['sitename'].'[ó������]';
				$total = 30;
				$num = 5;
				$template = '';
				$sql = 'AND vip>0';
				$ord = 'addtime DESC';
			}
			include tpl('alert_send', $module);
		}
	break;
	case 'add':
		if($submit) {			
			$usernames = explode("\n", trim($post['username']));
			foreach($usernames as $username) {
				$username = trim($username);
				if(!$username) continue;
				$user = userinfo($username);
				if(!$user) continue;
				$post['username'] = $username;
				$post['email'] = $user['email'];
				$post['addtime'] = $AJ_TIME;
				if($do->pass($post)) {
					$do->add($post);
				} else {
					message($do->errmsg);
				}
			}
			dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			$mid = isset($mid) ? intval($mid) : $mids[0];
			$mid or msg();
			isset($username) or $username = '';
			if(isset($userid)) {
				if($userid) {
					$userids = is_array($userid) ? implode(',', $userid) : $userid;					
					$result = $db->query("SELECT username FROM {$AJ_PRE}member WHERE userid IN ($userids)");
					while($r = $db->fetch_array($result)) {
						$username .= $r['username']."\n";
					}
				}
			}
			$word = '';
			$catid = $areaid = $rate = 0;
			$status = 3;
			$menuid = 1;
			include tpl('alert_add', $module);
		}
	break;
	case 'edit':
		$itemid or message();
		$do->itemid = $itemid;
		$r = $do->get_one();
		if(!$r) message();
		if($submit) {
			if($do->pass($post)) {
				$user = userinfo($post['username']);
				if($user) {
					$email = $post['email'] = $user['email'];
					$do->edit($post);
					$db->query("UPDATE {$AJ_PRE}alert SET email='$email' WHERE username='$post[username]'");
					dmsg('�޸ĳɹ�', $forward);
				} else {
					message('��Ա������');
				}
			} else {
				message($do->errmsg);
			}
		} else {
			extract($r);
			$menuid = 1;
			include tpl('alert_edit', $module);
		}
	break;
	case 'reject':		
		$itemid or msg('��ѡ��ó������');
		$do->check($itemid, 2);
		dmsg('�����ɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ��ó������');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'check':
		if($itemid && !$psize) {
			$do->check($itemid);
			dmsg('��˳ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			if($lists) {
				$tmp = $MOD['linkurl'];
				foreach($lists as $k=>$v) {
					if($v['catid']) {
						$lists[$k]['cate'] = cat_pos(get_cat($v['catid']), '-', 1);
					}
				}
				$MOD['linkurl'] = $tmp;
			}
			$menuid = 2;
			include tpl('alert', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		if($lists) {
			$tmp = $MOD['linkurl'];
			foreach($lists as $k=>$v) {
				if($v['catid']) {
					$lists[$k]['cate'] = cat_pos(get_cat($v['catid']), '-', 1);
				}
			}
			$MOD['linkurl'] = $tmp;
		}
		$menuid = 1;
		include tpl('alert', $module);
	break;
}
?>