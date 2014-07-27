<?php
defined('IN_AIJIACMS') or exit('Access Denied');
isset($username) or $username = '';
$menus = array (
    array('��������', '?moduleid='.$moduleid.'&file='.$file.'&username='.$username.'&action=add'),
    array('������¼', '?moduleid='.$moduleid.'&file='.$file.'&username='.$username),
    array('��¼����', '?moduleid='.$moduleid.'&file='.$file.'&action=clear', 'onclick="if(!confirm(\'Ϊ��ϵͳ��ȫ,ϵͳ��ɾ��90��֮ǰ�ļ�¼\n�˲������ɳ��������������\')) return false"'),
);
function _userinfo($mobile) {
	global $db;
	return $db->get_one("SELECT * FROM {$db->pre}member m,{$db->pre}company c WHERE m.userid=c.userid AND m.mobile='$mobile'");
}
$table = $AJ_PRE.'finance_sms';
switch($action) {
	case 'clear':
		$time = $today_endtime - 90*86400;
		$db->query("DELETE FROM {$table} WHERE addtime<$time");
		dmsg('����ɹ�', $forward);
	break;
	case 'add':
		if($submit) {
			$username or msg('����д��Ա��');
			$amount or msg('����д����');
			$reason or msg('����д����');
			$amount = intval($amount);
			if($amount <= 0) msg('������ʽ����');
			if(!$type) $amount = -$amount;
			$error = '';
			$success = 0;
			$usernames = explode("\n", trim($username));
			foreach($usernames as $username) {
				$username = trim($username);
				if(!$username) continue;
				$r = $db->get_one("SELECT username,sms FROM {$AJ_PRE}member WHERE username='$username'");
				if(!$r) {
					$error .= '<br/>��Ա['.$username.']������';
					continue;
				}
				if(!$type && $r['sms'] < abs($amount)) {
					$error .= '<br/>��Ա['.$username.']�������㣬��ǰ���Ϊ:'.$r['sms'];
					continue;
				}
				$reason or $reason = '����';
				$note or $note = '�ֹ�';
				sms_add($username, $amount);
				sms_record($username, $amount, $_username, $reason, $note);
			}
			if($error) message('�����ɹ� '.$success.' λ��Ա���������´���'.$error);
			dmsg('�����ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=record');
		} else {
			if(isset($userid)) {
				if($userid) {
					$userids = is_array($userid) ? implode(',', $userid) : $userid;					
					$result = $db->query("SELECT username FROM {$AJ_PRE}member WHERE userid IN ($userids)");
					while($r = $db->fetch_array($result)) {
						$username .= $r['username']."\n";
					}
				}
			}
			include tpl('sms_add', $module);
		}
	break;
	case 'delete':
		$itemid or msg('δѡ���¼');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$sfields = array('������', '��Ա��', '����', '����', '��ע', '������');
		$dfields = array('username', 'username', 'amount', 'reason', 'note', 'editor');
		$sorder  = array('����ʽ', '��������', '��������', 'ʱ�併��', 'ʱ������');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($type) $condition .= $type == 1 ? " AND amount>0" : " AND amount<0";
		if($username) $condition .= " AND username='$username'";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$records = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$income = $expense = 0;
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['amount'] > 0 ? $income += $r['amount'] : $expense += $r['amount'];
			$records[] = $r;
		}
		include tpl('sms', $module);
	break;
}
?>