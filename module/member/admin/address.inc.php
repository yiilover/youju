<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/address.class.php';
$do = new address();
$menus = array (
    array('��ַ�б�', '?moduleid='.$moduleid.'&file='.$file),
);

switch($action) {
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
			include tpl('address_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ���ַ');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$sfields = array('������', '����', '��ַ', '�ʱ�', '�ֻ�', '�绰', '��Ա', '��ע');
		$dfields = array('address', 'truename', 'address', 'postcode', 'mobile', 'telephone', 'username', 'note');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($username) or $username = '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($username) $condition .= " AND username='$username'";
		$lists = $do->get_list($condition, 'itemid DESC');
		include tpl('address', $module);
	break;
}
?>