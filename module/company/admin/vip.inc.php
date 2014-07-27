<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/company.class.php';
$menus = array (
    array('���'.VIP, '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array(VIP.'�б�', '?moduleid='.$moduleid.'&file='.$file),
    array('����'.VIP, '?moduleid='.$moduleid.'&file='.$file.'&action=expire'),
    array('��˾�б�', '?moduleid='.$moduleid),
    array('��Ա�б�', '?moduleid=2'),
);
$do = new company;
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if($_catids || $_areaids) {
	if(isset($userid)) $itemid = $userid;
	if(isset($member['areaid'])) $post['areaid'] = $member['areaid'];
	require AJ_ROOT.'/admin/admin_check.inc.php';
}
$fromtime = timetodate($AJ_TIME, 3);
$GROUP = cache_read('group.php');
switch($action) {
	case 'add':	
		if($submit) {		
			if(!$vip['username']) msg('��Ա������Ϊ��');
			$vip['username'] = trim($vip['username']);
			$money = dround($money);
			$credit = intval($credit);
			$sms = intval($sms);

			$usernames = explode("\n", trim($vip['username']));
			foreach($usernames as $username) {
				$username = trim($username);
				if(!$username) continue;
				$vip['username'] = $username;
				$do->vip_edit($vip);
				if($money) {
					money_add($username, $money);
					money_record($username, $money, 'վ��', $_username, $reason, $GROUP[$vip['groupid']]['groupname']);
				}
				if($credit) {
					credit_add($username, $credit);
					credit_record($username, $credit, $_username, $reason, $GROUP[$vip['groupid']]['groupname']);
				}
				if($sms) {
					sms_add($username, $sms);
					sms_record($username, $sms, $_username, $reason, $GROUP[$vip['groupid']]['groupname']);
				}
			}

			dmsg('��ӳɹ�', $this_forward);
		} else {
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
			$totime = timetodate($AJ_TIME+365*86400, 3);
			include tpl('vip_add', $module);
		}
	break;
	case 'edit':
		$userid or msg();
		$do->userid = $userid;
		if($submit) {
			if($do->vip_edit($vip)) {
				dmsg('�޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$fromtime = timetodate($fromtime, 3);
			$totime = timetodate($totime, 3);
			$validtime = $validtime ? timetodate($validtime, 3) : '';
			include tpl('vip_edit', $module);
		}
	break;
	case 'delete':
		$userid or msg('��ѡ��˾');
		$do->vip_delete($userid);
		dmsg('�����ɹ�', $forward);
	break;
	case 'update':
		is_array($userid) or msg('��ѡ��˾');
		foreach($userid as $v) {
			$do->update($v);
		}
		dmsg('���³ɹ�', $forward);
	break;
	default:
		$sfields = array('������', '��˾��', '��Ա��');
		$dfields = array('keyword', 'company', 'username');
		$sorder  = array('�������ʽ', '����ʼ����', '����ʼ����', '�����������', '�����������', VIP.'ָ������', VIP.'ָ������', '����ֵ����', '����ֵ����', '����ֵ����', '����ֵ����', '��ԱID����', '��ԱID����');
		$dorder  = array('fromtime DESC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC', 'vip DESC', 'vip ASC', 'vipt DESC', 'vipt ASC', 'vipr DESC', 'vipr ASC', 'userid DESC', 'userid ASC');
	
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($vipt) or $vipt = '';
		isset($vipr) or $vipr = '';
		isset($timetype) or $timetype = 'fromtime';
		$vip = isset($vip) ? intval($vip) : 0;
		$groupid = isset($groupid) ? intval($groupid) : 0;
	
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$group_select = group_select('groupid', '��Ա��', $groupid);
		
		if($action == 'expire') {
			$condition = "groupid>4 AND totime>0 AND totime<$AJ_TIME";
		} else {
			$condition = $vip ? "vip=$vip" : "vip>0";
		}
		if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($groupid) $condition .= " AND groupid=$groupid";
		if($dfromtime) $condition .= " AND $timetype>".(strtotime($dfromtime.' 00:00:00'));
		if($dtotime) $condition .= " AND $timetype<".(strtotime($dtotime.' 23:59:59'));
		if($vipt != '') $condition .= " AND vipt=".intval($vipt);
		if($vipr != '') $condition .= " AND vipr=".intval($vipr);
		$companys = $do->get_list($condition, $dorder[$order]);
		include tpl($action == 'expire' ? 'vip_expire' : 'vip', $module);
	break;
}
?>