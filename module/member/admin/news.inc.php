<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/news.class.php';
$do = new news();
$menus = array (
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('δͨ������', '?moduleid='.$moduleid.'&file='.$file.'&action=reject'),
    array('����վ', '?moduleid='.$moduleid.'&file='.$file.'&action=recycle'),
    array('���µ�ַ', '?moduleid='.$moduleid.'&file='.$file.'&action=update'),
);
if(in_array($action, array('', 'check', 'reject', 'recycle'))) {
	$level = isset($level) ? intval($level) : 0;
	$sfields = array('������', '����', '��Ա��');
	$dfields = array('title', 'title', 'username');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '�޸�ʱ�併��', '�޸�ʱ������', '�����������', '�����������');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC', 'hits DESC', 'hits ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$level_select = level_select('level', '����', $level);

	$condition = '';
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($level) $condition .= " AND level=$level";
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catid='.$post['catid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$content = '';
			$username = $_username;
			$status = 3;
			$addtime = timetodate($AJ_TIME);
			$menuid = 0;
			include tpl('news_edit', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('�޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$addtime = timetodate($addtime);
			$menuon = array('4', '3', '2', '1');
			$menuid = $menuon[$status];
			include tpl('news_edit', $module);
		}
	break;
	case 'push':
		$MODULE[$aid]['module'] == 'article' or msg('��ѡ������ģ��');
		if($submit) {
			$catid or msg('��ѡ�����');
			$tb = get_table($aid);
			$tb_data = get_table($aid, 1);
			$result = $db->query("SELECT * FROM {$AJ_PRE}news WHERE itemid IN ($ids)");
			$i = 0;
			while($r = $db->fetch_array($result)) {
				$r = daddslashes($r);
				$t = $db->get_one("SELECT itemid FROM {$tb} WHERE linkurl='$r[linkurl]'");
				if($t) continue;
				$db->query("INSERT {$tb} (catid,title,linkurl,islink,addtime,username,edittime,editor,status) VALUES ('$catid', '$r[title]', '$r[linkurl]', '1', '$r[addtime]', '$r[username]', '$AJ_TIME', '$_username','3')");
				$itemid = $db->insert_id();
				$db->query("INSERT {$tb_data} (itemid) VALUES ('$itemid')");
				$i++;
			}
			dmsg('���ͳɹ�'.$i.'������', "?moduleid=$moduleid&file=$file");
		} else {
			$itemid or msg('��ѡ������');
			$ids = implode(',', $itemid);
			include tpl('news_push', $module);
		}
	break;		
	case 'update':
		if(!isset($num)) {
			$num = 500;
		}
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(itemid) AS fid FROM {$AJ_PRE}news");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(itemid) AS tid FROM {$AJ_PRE}news");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if($fid <= $tid) {
			$result = $db->query("SELECT itemid FROM {$AJ_PRE}news WHERE itemid>=$fid ORDER BY itemid LIMIT 0,$num");
			if($db->affected_rows($result)) {
				while($r = $db->fetch_array($result)) {
					$itemid = $r['itemid'];
					$do->update($itemid);
				}
				$itemid += 1;
			} else {
				$itemid = $fid + $num;
			}
		} else {
			dmsg('���³ɹ�', "?moduleid=$moduleid&file=$file");
		}
		msg('ID��'.$fid.'��'.($itemid-1).'���³ɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num");
	break;
	case 'recycle':
		$lists = $do->get_list('status=0'.$condition, $dorder[$order]);
		include tpl('news_recycle', $module);
	break;
	case 'check':
		if($itemid && !$psize) {
			$do->check($itemid);
			dmsg('��˳ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			include tpl('news_check', $module);
		}
	break;
	case 'reject':
		if($itemid && !$psize) {
			$do->reject($itemid);
			dmsg('�ܾ��ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=1'.$condition, $dorder[$order]);
			include tpl('news_reject', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ������');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'restore':
		$itemid or msg('��ѡ������');
		$do->restore($itemid);
		dmsg('��ԭ�ɹ�', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('��ճɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ������');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		include tpl('news', $module);
	break;
}
?>