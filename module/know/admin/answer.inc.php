<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/answer.class.php';
$do = new answer();
$menus = array (
    array('���б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�����', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
);
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sfields = array('����', '��Ա��', 'IP', '����ID', '��ID', '�ο�����');
	$dfields = array('content', 'username', 'ip', 'qid', 'itemid', 'linkurl');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', 'ͶƱ��������', 'ͶƱ��������');
	$dorder  = array('itemid desc', 'addtime DESC', 'addtime ASC', 'vote DESC', 'vote ASC');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	isset($ip) or $ip = '';
	$qid = isset($qid) ? intval($qid) : 0;

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($keyword) $condition .= in_array($dfields[$fields], array('qid', 'itemid', 'ip')) ? " AND $dfields[$fields]='$kw'" : " AND $dfields[$fields] LIKE '%$keyword%'";
	if($qid) $condition .= " AND qid='$qid'";
	if($ip) $condition .= " AND ip='$ip'";
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
			include tpl('answer_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ���');
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
			include tpl('answer', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 0;
		include tpl('answer', $module);
	break;
}
?>