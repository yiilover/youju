<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('��¼��־', '?moduleid='.$moduleid.'&file='.$file),
    array('��־����', '?moduleid='.$moduleid.'&file='.$file.'&action=clear', 'onclick="if(!confirm(\'Ϊ��ϵͳ��ȫ,ϵͳ��ɾ��90��֮ǰ����־\n�˲������ɳ��������������\')) return false"'),
);
switch($action) {
	case 'clear':
		$time = $today_endtime - 90*86400;
		$db->query("DELETE FROM {$AJ_PRE}login WHERE logintime<$time");
		dmsg('����ɹ�', $forward);
	break;
	case 'md':
		echo md5(md5($password));
		exit;
	break;
	case 'cp':
		$r = $db->get_one("SELECT password FROM {$AJ_PRE}login WHERE logid='$logid'");
		echo $r['password'] == $password ? 'ƥ��' : '��ƥ��';
		exit;
	break;
	default:
		$sfields = array('������', '���', '��Ա', '����', 'IP', '�ͻ���');
		$dfields = array('message', 'message', 'username', 'password', 'loginip', 'agent');
		isset($admin) or $admin = -1;
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$ip = isset($ip) ? $ip : '';
		$username = isset($username) ? $username : '';
		$fromdate = isset($fromdate) ? $fromdate : '';
		$fromtime = is_date($fromdate) ? strtotime($fromdate.' 0:0:0') : 0;
		$todate = isset($todate) ? $todate : '';
		$totime = is_date($todate) ? strtotime($todate.' 23:59:59') : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND logintime>$fromtime";
		if($totime) $condition .= " AND logintime<$totime";
		if($ip) $condition .= " AND loginip='$ip'";
		if($username) $condition .= " AND username='$username'";
		if($admin > -1) $condition .= " AND admin='$admin'";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {	
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}login WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);		
		$logs = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}login WHERE $condition ORDER BY logid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['password'] = substr($r['password'], 0, 10).'************'.substr($r['password'], 20);
			$r['logintime'] = timetodate($r['logintime'], 6);
			$logs[] = $r;
		}
		include tpl('loginlog', $module);
	break;
}
?>