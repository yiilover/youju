<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('404��־', '?file='.$file),
    array('�����־', '?file='.$file.'&action=truncate', 'onclick="if(!confirm(\'ȷ��Ҫ�������404��־��\')) return false"'),
);
switch($action) {
	case 'delete':
		$itemid or msg('��ѡ���¼');
		$ids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$AJ_PRE}404 WHERE itemid IN ($ids)");
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'truncate':
		$db->query("TRUNCATE TABLE {$AJ_PRE}404");
		dmsg('����ɹ�', $forward);
	break;
	default:
		require AJ_ROOT.'/file/config/robot.inc.php';
		$sfields = array('������', '��ַ', '��������', '��Ա', 'IP');
		$dfields = array('url', 'url', 'robot', 'username', 'ip');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$ip = isset($ip) ? $ip : '';
		$robot = isset($robot) ? $robot : '';
		$username = isset($username) ? $username : '';
		$fromdate = isset($fromdate) ? $fromdate : '';
		$fromtime = is_date($fromdate) ? strtotime($fromdate.' 0:0:0') : 0;
		$todate = isset($todate) ? $todate : '';
		$totime = is_date($todate) ? strtotime($todate.' 23:59:59') : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>$fromtime";
		if($totime) $condition .= " AND addtime<$totime";
		if($ip) $condition .= " AND ip='$ip'";
		if($robot) $condition .= " AND robot='$robot'";
		if($username) $condition .= " AND username='$username'";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}404 WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}404 WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$tmp = parse_url($r['url']);
			$r['durl'] = dsubstr(basename($r['url']), 30, '...');
			$r['addtime'] = timetodate($r['addtime'], 6);
			$lists[] = $r;
		}
		include tpl('404');
	break;
}
?>