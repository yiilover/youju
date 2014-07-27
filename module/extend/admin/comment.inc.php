<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/comment.class.php';
$do = new comment();
$menus = array (
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('���۽�ֹ', '?moduleid='.$moduleid.'&file='.$file.'&action=ban'),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sfields = array('����', 'ԭ�ı���', '��Ա��', 'IP', 'ԭ��ID', '����ID');
	$dfields = array('content', 'item_title', 'username', 'ip', 'item_id', 'itemid');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '�ظ�ʱ�併��', '�ظ�ʱ������', '���ô�������', '���ô�������', '֧�ִ�������', '֧�ִ�������', '���Դ�������', '���Դ�������', '���ָߵͽ���', '���ָߵ�����');
	$dorder  = array('itemid desc', 'addtime DESC', 'addtime ASC', 'replytime DESC', 'replytime ASC', 'quote DESC', 'quote ASC', 'agree DESC', 'agree ASC', 'against DESC', 'against ASC', 'star DESC', 'star ASC');
	$sstar = $L['star_type'];

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	isset($star) && isset($sstar[$star]) or $star = 0;
	isset($ip) or $ip = '';
	$mid = isset($mid) ? intval($mid) : 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$module_select = module_select('mid', 'ģ��', $mid);
	$order_select  = dselect($sorder, 'order', '', $order);
	$star_select  = dselect($sstar, 'star', '', $star);

	$condition = '';
	if($keyword) $condition .= in_array($dfields[$fields], array('item_id', 'itemid', 'ip')) ? " AND $dfields[$fields]='$kw'" : " AND $dfields[$fields] LIKE '%$keyword%'";
	if($mid) $condition .= " AND item_mid='$mid'";
	if($ip) $condition .= " AND ip='$ip'";
	if($star) $condition .= " AND star='$star'";
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
			include tpl('comment_edit', $module);
		}
	break;
	case 'ban':
		if($submit) {
			$do->ban_update($post);
			dmsg('���³ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=ban&page='.$page);
		} else {
			$condition = 1;
			$mid = isset($mid) ? intval($mid) : 0;
			if($mid) $condition = "moduleid=$mid";
			$lists = $do->get_ban_list($condition);
			include tpl('comment_ban', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ������');
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
			include tpl('comment', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 0;
		include tpl('comment', $module);
	break;
}
?>