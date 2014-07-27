<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('���ɳ�ֵ��', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('��ֵ������', '?moduleid='.$moduleid.'&file='.$file),
);
$table = $AJ_PRE.'finance_card';
switch($action) {
	case 'add':
		if($submit) {
			$amount = dround($amount);
			if($amount <= 0) msg('����ʽ����');
			$prefix_length = strlen($prefix);
			$number_length = intval($number_length);
			if($number_length < 8) msg('���Ų�������8λ');
			$rand_length = $number_length - $prefix_length;
			if($rand_length < 4)  msg('���ų��Ⱥ�ǰ׺���Ȳ������4λ');
			$password_length = intval($password_length);
			if($password_length < 6) msg('���벻������6λ');
			$number_part = trim($number_part);
			if(!preg_match("/^[0-9a-zA-z]{6,}$/", $number_part)) msg('����ֻ����6λ�������ֺ���ĸ���');
			$totime = strtotime($totime);
			if($totime < $AJ_TIME) msg('����ʱ������ڵ�ǰʱ��֮��');
			$total = intval($total);
			$total or $total = 100;
			$t = 0;
			for($i = 0; $i < $total; $i++) {
				$number = $prefix.random($rand_length, $number_part);
				if($db->get_one("SELECT itemid FROM {$table} WHERE number='$number'")) {
					$i--;
				} else {
					$t++;
					$password = random($password_length, '0123456');
					$db->query("INSERT INTO {$table} (number,password,amount,editor,addtime,totime) VALUES('$number','$password','$amount','$_username','$AJ_TIME','$totime')");
				}
			}
			msg('�ɹ����� '.$t.' ��', '?moduleid='.$moduleid.'&file='.$file);
		} else {
			$prefix = mt_rand(1000, 9999);
			$totime = (timetodate($AJ_TIME, "Y") + 3).timetodate($AJ_TIME, '-m-d');
			include tpl('card_add', $module);
		}
	break;
	case 'delete':
		$itemid or msg('δѡ���¼');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$table} WHERE itemid IN ($itemids)");
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$print = isset($print) ? 1 : 0;
		$sfields = array('������', '����', '����', '���', '��Ա', 'IP', '������');
		$dfields = array('number', 'number', 'password', 'amount', 'username', 'ip', 'editor');
		$sorder  = array('����ʽ', '����', '�������', '��ֵʱ�併��', '��ֵʱ������', '����ʱ�併��', '����ʱ������', '�ƿ�ʱ�併��', '�ƿ�ʱ������');
		$dorder  = array('itemid DESC', 'amount DESC', 'amount ASC', 'updatetime DESC', 'updatetime ASC', 'totime DESC', 'totime ASC', 'addtime DESC', 'addtime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		isset($number) or $number = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		isset($minamount) or $minamount = '';
		isset($maxamount) or $maxamount = '';
		isset($status) or $status = 0;
		isset($timetype) or $timetype = 'updatetime';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields]='$keyword'";
		if($print) $condition .= " AND updatetime=0  AND totime>$AJ_TIME";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		if($username) $condition .= " AND username='$username'";
		if($number) $condition .= " AND number='$number'";
		if($minamount != '') $condition .= " AND amount>=$minamount";
		if($maxamount != '') $condition .= " AND amount<=$maxamount";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$lists = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		$income = $expense = 0;
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['totime'] = timetodate($r['totime'], 3);
			$r['updatetime'] = $r['updatetime'] ? timetodate($r['updatetime'], 5) : 'δʹ��';			
			$lists[] = $r;
		}
		include tpl('card', $module);
	break;
}
?>