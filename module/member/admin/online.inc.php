<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('���߻�Ա', '?moduleid='.$moduleid.'&file=online'),
    array('���߹���Ա', '?moduleid='.$moduleid.'&file=online&action=admin'),
);
if($action == 'admin') {
	$AJ['admin_online'] or msg('ϵͳδ�����˹���', '?file=setting&kw='.urlencode('��̨����').'#high');
	$lastime = $AJ_TIME - $AJ['online'];
	$db->query("DELETE FROM {$AJ_PRE}admin_online WHERE lasttime<$lastime");
	$sid = session_id();
	$lists = array();
	$result = $db->query("SELECT * FROM {$AJ_PRE}admin_online ORDER BY lasttime DESC");
	while($r = $db->fetch_array($result)) {
		$r['lasttime'] = timetodate($r['lasttime'], 'H:i:s');
		$lists[] = $r;
	}
	include tpl('online_admin', $module);
} else {
	$sfields = array('������', '��Ա��', '��ԱID');
	$dfields = array('username', 'username', 'userid');
	$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '��ԱID����', '��ԱID����');
	$dorder  = array('lasttime DESC', 'lasttime DESC', 'lasttime ASC', 'userid DESC', 'userid ASC');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	$mid = isset($mid) ? intval($mid) : 0;
	$online = isset($online) ? intval($online) : 2;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$condition = '1';
	if($keyword) $condition .= " AND $dfields[$fields]='$kw'";
	if($mid) $condition .= " AND moduleid=$mid";
	if($online < 2) $condition .= " AND online=$online";
	$order = $dorder[$order];
	$lastime = $AJ_TIME - $AJ['online'];
	$db->query("DELETE FROM {$AJ_PRE}online WHERE lasttime<$lastime");
	if($page > 1 && $sum) {
		$items = $sum;
	} else {
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}online WHERE $condition");
		$items = $r['num'];
	}
	$pages = pages($items, $page, $pagesize);
	$lists = array();
	$result = $db->query("SELECT * FROM {$AJ_PRE}online WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
	while($r = $db->fetch_array($result)) {
		$r['lasttime'] = timetodate($r['lasttime'], 'H:i:s');
		$lists[] = $r;
	}
	include tpl('online', $module);
}
?>