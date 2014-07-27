<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/guestbook.class.php';
$do = new guestbook();
$menus = array (
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);
if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';
if(in_array($action, array('', 'check'))) {
	$sfields = array('������', '���Ա���', '��Ա��', '��ϵ��', '��ϵ�绰', '�����ʼ�', 'QQ', '��������', 'MSN','Skype','����IP', '��������', '�ظ�����');
	$dfields = array('title','title','username','truename','telephone','email','qq','ali','msn','skype','ip','content','reply');
	$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '�ظ�ʱ�併��', '�ظ�ʱ������');
	$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '1';
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
}
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
			$addtime = timetodate($addtime);
			include tpl('guestbook_edit', $module);
		}
	break;
	case 'check':
		$itemid or msg('��ѡ������');
		$do->check($itemid, $status);
		dmsg('���óɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ������');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('guestbook', $module);
	break;
}
?>