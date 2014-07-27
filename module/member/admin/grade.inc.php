<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/grade.class.php';
$do = new grade();
$menus = array (
    array('������¼', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('�ܾ���¼', '?moduleid='.$moduleid.'&file='.$file.'&action=reject'),
    array(VIP.'����', '?moduleid=4&file=vip'),
);
if(in_array($action, array('', 'check', 'reject'))) {
	$sfields = array('������', '��˾��', '��Ա��', '��ϵ��', '�绰', '�ֻ�', 'Email', 'MSN', 'QQ', 'IP', '����', '��ע', '�Ż���');
	$dfields = array('company', 'company', 'username', 'truename', 'telephone', 'mobile', 'email', 'msn', 'qq', 'ip', 'content', 'note', 'promo_code');
	$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '����ʱ�併��', '����ʱ������', '�������', '����������');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC', 'amount DESC', 'amount ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
}
$menuon = array('4', '2', '1', '0');
switch($action) {
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->edit($post)) {
				dmsg('�����ɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$user = $username ? userinfo($username) : array();
			$addtime = timetodate($addtime);
			$edittime = timetodate($edittime);
			$fromtime = timetodate($AJ_TIME, 3);
			$days =  $promo_amount && $promo_type == 1 ? $promo_amount : 365;
			$totime = timetodate($AJ_TIME + 86400*$days);
			$UG = cache_read('group-'.$groupid.'.php');
			$fee = $UG['fee'];
			$pay = $fee - $amount;
			if($promo_amount) {
				$pay = $promo_type == 1 ? 0 : $pay - $promo_amount;
			}
			include tpl('grade_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ���¼');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'reject':
		$status = 1;
		$lists = $do->get_list('status='.$status.$condition, $dorder[$order]);
		include tpl('grade', $module);
	break;
	case 'check':
		$status = 2;
		$lists = $do->get_list('status='.$status.$condition, $dorder[$order]);
		include tpl('grade', $module);
	break;
	default:
		$status = 3;
		$lists = $do->get_list('status='.$status.$condition, $dorder[$order]);
		include tpl('grade', $module);
	break;
}
?>