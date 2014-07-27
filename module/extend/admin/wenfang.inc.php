<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/wenfang.class.php';
$do = new wenfang();
$menus = array (
    array('�ʷ��б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�ʷ����', '?moduleid='.$moduleid.'&file='.$file.'&item_id='.$item_id.'&action=check'),
    array('�ʷ�����', '?moduleid='.$moduleid.'&file=setting#wenfang'),
);
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sfields = array('����', 'ԭ�ı���', 'ԭ������', '��Ա��', 'IP', 'ԭ��ID', '�ʷ�ID');
	$dfields = array('content', 'item_title', 'item_linkurl', 'username', 'ip', 'item_id', 'itemid');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '�ظ�ʱ�併��', '�ظ�ʱ������');
	$dorder  = array('itemid desc', 'addtime DESC', 'addtime ASC', 'replytime DESC', 'replytime ASC');
	$sstar = $L['star_type'];

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	
	isset($ip) or $ip = '';
	$mid = isset($mid) ? intval($mid) : 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$module_select = module_select('mid', 'ģ��', $mid);
	$order_select  = dselect($sorder, 'order', '', $order);
	

	$condition = '';
	if($keyword) $condition .= in_array($dfields[$fields], array('item_id', 'itemid', 'ip')) ? " AND $dfields[$fields]='$kw'" : " AND $dfields[$fields] LIKE '%$keyword%'";
	if($mid) $condition .= " AND item_mid='$mid'";
	if($ip) $condition .= " AND ip='$ip'";
	if($item_id) $condition = " AND item_id=$item_id";
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
			$replytime = $replytime ? timetodate($replytime, 6) : '';
			include tpl('wenfang_edit', $module);
		}
	break;
	
	case 'delete':
		$itemid or msg('��ѡ���ʷ�');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $this_forward);
	break;
	case 'check':
		if($itemid) {
			$status = $status == 3 ? 3 : 2;
			$do->check($itemid, $status);
			dmsg($status == 3 ? '��˳ɹ�' : 'ȡ���ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			$menuid = 1;
			include tpl('wenfang', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 0;
		include tpl('wenfang', $module);
	break;
}
?>