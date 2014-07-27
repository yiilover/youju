<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/link.class.php';
$do = new dlink();
$menus = array (
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
);
if(in_array($action, array('', 'check'))) {
	$sfields = array('������', '��վ', '����', '��Ա��');
	$dfields = array('title', 'title', 'linkurl', 'username');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '�޸�ʱ�併��', '�޸�ʱ������');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action);
			} else {
				msg($do->errmsg);
			}
		} else {
			$title = $linkurl = $style = $username = '';
			$status = 3;
			$menuid = 0;
			include tpl('link_edit', $module);
		}
	break;
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
			$menuid = $status == 3 ? 1 : 2;
			include tpl('link_edit', $module);
		}
	break;
	case 'check':
		if($itemid) {
			$status = $status == 3 ? 3 : 2;
			$do->check($itemid, $status);
			dmsg($status == 3 ? '��˳ɹ�' : 'ȡ���ɹ�', $forward);
		} else {
			$lists = $do->get_list("username<>'' AND status=2".$condition, $dorder[$order]);
			$menuid = 2;
			include tpl('link', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ������');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$lists = $do->get_list("username<>'' AND status=3".$condition, $dorder[$order]);
		$menuid = 1;
		include tpl('link', $module);
	break;
}
?>