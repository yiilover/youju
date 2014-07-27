<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/spread.class.php';
$do = new spread();
$menus = array (
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=price'),
    array('��������', '?moduleid='.$moduleid.'&file='.$file.'&action=html'),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);
if(in_array($action, array('', 'check'))) {
	$sfields = array('�ؼ���', '��Ա��', '��˾��', '��ϢID', '�۸�');
	$dfields = array('word', 'username', 'company', 'tid', 'price');
	$sorder  = array('�������ʽ', '�۸���', '�۸�����', '���ʱ�併��', '���ʱ������', '��ʼʱ�併��', '��ʼʱ������', '����ʱ�併��', '����ʱ������');
	$dorder  = array('itemid DESC', 'price DESC', 'price ASC', 'addtime DESC', 'addtime ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$mid = isset($mid) ? intval($mid) : 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	isset($type) or $type = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$condition = '';
	if($keyword) $condition .= in_array($dfields[$fields], array('tid', 'price')) ? " AND $dfields[$fields]='$kw'" : " AND $dfields[$fields] LIKE '%$keyword%'";
	if($mid) $condition .= " AND mid=$mid";
	$times = array('fromtime', 'fromtime', 'totime', 'addtime');
	$time = $times[$type];
	if($fromtime) $condition .= " AND $time>=".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND $time<=".(strtotime($totime.' 23:59:59'));
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&typeid='.$post['typeid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$status = 3;
			$mid = 5;
			$fromtime = timetodate($AJ_TIME, 3);
			$menuid = 0;
			$currency = $MOD['spread_currency'];
			include tpl('spread_edit', $module);
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
			$fromtime = $fromtime ? timetodate($fromtime, 3) : '';
			$totime = $totime ? timetodate($totime, 3) : '';
			$menuid = 1;
			include tpl('spread_edit', $module);
		}
	break;
	case 'html':
		$all = (isset($all) && $all) ? 1 : 0;
		$one = (isset($one) && $one) ? 1 : 0;
		if(!isset($num)) {
			$num = 50;
			$globs = glob(AJ_CACHE.'/htm/*.htm');
			foreach($globs as $v) {
				if(substr(basename($v), 0, 1) == 'm') {
					@unlink($v);
				}
			}
		}
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(itemid) AS fid FROM {$AJ_PRE}spread WHERE totime>$AJ_TIME");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(itemid) AS tid FROM {$AJ_PRE}spread WHERE totime>$AJ_TIME");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		if($fid <= $tid) {
			$result = $db->query("SELECT itemid,mid FROM {$AJ_PRE}spread WHERE totime>$AJ_TIME AND itemid>=$fid ORDER BY itemid LIMIT 0,$num");
			if($db->affected_rows($result)) {
				while($r = $db->fetch_array($result)) {
					$itemid = $r['itemid'];
					$MOD = cache_read('module-'.$r['mid'].'.php');
					tohtml('spread', $module);
				}
				$itemid += 1;
			} else {
				$itemid = $fid + $num;
			}
		} else {
			if($all) dheader('?moduleid=3&file=ad&action=html&all=1&one='.$one);
			dmsg('���ɳɹ�', "?moduleid=$moduleid&file=$file");
		}
		msg('ID��'.$fid.'��'.($itemid-1).'[�����ƹ�]���ɳɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num&all=$all&one=$one");
	break;
	case 'price':
		if($submit) {
			$do->price_update($post);
			dmsg('���³ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&page='.$page);
		} else {
			$condition = 1;
			$mid = isset($mid) ? intval($mid) : 0;
			if($mid) $condition = "moduleid=$mid";
			$lists = $do->get_price_list($condition);
			include tpl('spread_price', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ������');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ������');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	case 'check':
		if($itemid) {
			$status = $status == 3 ? 3 : 2;
			$do->check($itemid, $status);
			dmsg($status == 3 ? '��˳ɹ�' : 'ȡ���ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			$menuid = 2;
			include tpl('spread', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 1;
		include tpl('spread', $module);
	break;
}
?>