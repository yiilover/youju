<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/message.class.php';
$menus = array (
    array('�����ż�', '?moduleid='.$moduleid.'&file='.$file.'&action=send'),
    array('��Ա�ż�', '?moduleid='.$moduleid.'&file='.$file),
    array('ϵͳ�ż�', '?moduleid='.$moduleid.'&file='.$file.'&action=system'),
    array('�ʼ�ת��', '?moduleid='.$moduleid.'&file='.$file.'&action=mail'),
    array('�ż�����', '?moduleid='.$moduleid.'&file='.$file.'&action=clear'),
);
$do = new message;
$this_forward = '?moduleid='.$moduleid.'&file='.$file;

$NAME = array('��ͨ', '����Ǽ�', '����', '����', '��ʹ');

switch($action) {
	case 'send':
		if($submit) {
			if($do->_send($message)) {
				dmsg('���ͳɹ�', $this_forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			isset($touser) or $touser = '';
			include tpl('message_send', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			$do->_edit($message);
			dmsg('�޸ĳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=system');
		} else {
			extract($do->get_one());
			include tpl('message_edit', $module);
		}
	break;
	case 'clear':
		if($submit) {
			if($do->_clear($message)) {
				dmsg('����ɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$todate = timetodate(strtotime('-1 year'), 3);
			include tpl('message_clear', $module);
		}
	break;
	
	case '_delete':
		if(!$itemid) msg();
		$do->_delete($itemid);
		dmsg('ɾ���ɹ�', $this_forward);
	break;
	
	case 'delete':
		if(!$itemid) msg();
		$do->itemid = $itemid;
		$do->delete();
		dmsg('ɾ���ɹ�', $forward);
	break;
	
	default:
		$sfields = array('����', '������', '�ռ���');
		$dfields = array('title', 'fromuser', 'touser');
		$S = array('״̬', '�ݸ���', '������', '�ռ���', '����վ');

		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$typeid = isset($typeid) ? intval($typeid) : -1;
		$read = isset($read) ? intval($read) : -1;
		$send = isset($send) ? intval($send) : -1;
		$status = isset($status) ? intval($status) : 0;

		$fields_select = dselect($sfields, 'fields', '', $fields);
		$status_select = dselect($S, 'status', '', $status);

		$condition = "groupids=''";
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($status) $condition .= " AND status=$status";
		$condition .= " AND typeid=1";
		if($read > -1) $condition .= " AND isread=$read";
		if($send > -1) $condition .= " AND issend=$send";
        if($title) $condition .= " AND title='$title'";
		$lists = $do->get_list($condition);
		include tpl('house_groupbuy', $module);
	break;
}
?>