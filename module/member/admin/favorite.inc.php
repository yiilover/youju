<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/favorite.class.php';
$do = new favorite();
$menus = array (
    array('�ղ��б�', '?moduleid='.$moduleid.'&file='.$file),
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
			include tpl('favorite_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ���ղ�');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$sfields = array('������', '����', 'URL');
		$dfields = array('title', 'title', 'url');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$userid = isset($userid) ? intval($userid) : '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($userid) $condition .= " AND userid=$userid";
		$lists = $do->get_list($condition);
		include tpl('favorite', $module);
	break;
}
?>