<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/honor.class.php';
$do = new honor();
$menus = array (
    array('���֤��', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('֤���б�', '?moduleid='.$moduleid.'&file='.$file),
    array('���֤��', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('����֤��', '?moduleid='.$moduleid.'&file='.$file.'&action=expire'),
    array('δͨ��֤��', '?moduleid='.$moduleid.'&file='.$file.'&action=reject'),
    array('����վ', '?moduleid='.$moduleid.'&file='.$file.'&action=recycle'),
);
if(in_array($action, array('', 'check', 'expire', 'reject', 'recycle'))) {
	$sfields = array('������', '֤������', '��֤����', '��Ա��');
	$dfields = array('title', 'title', 'authority', 'username');
	$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '�޸�ʱ�併��', '�޸�ʱ������', '��֤ʱ�併��', '��֤ʱ������', '����ʱ�併��', '����ʱ������');
	$dorder  = array('addtime DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC');

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
				dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catid='.$post['catid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$content = '';
			$username = $_username;
			$status = 3;
			$addtime = timetodate($AJ_TIME);
			$menuid = 0;
			include tpl('honor_edit', $module);
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
			$addtime = timetodate($addtime);
			$fromtime = timetodate($fromtime, 3);
			$totime = $totime ? timetodate($totime, 3) : '';
			$menuon = array('5', '4', '2', '1', '3');
			$menuid = $menuon[$status];
			include tpl('honor_edit', $module);
		}
	break;
	case 'recycle':
		$lists = $do->get_list('status=0'.$condition, $dorder[$order]);
		include tpl('honor_recycle', $module);
	break;
	case 'expire':
		if(isset($refresh)) {
			if(isset($delete)) {
				$days = isset($days) ? intval($days) : 0;
				$days or msg('����д����');
				$do->clear("status=4 AND totime>0 AND totime<$AJ_TIME-$days*86400");
				dmsg('ɾ���ɹ�', $forward);
			} else {
				$do->expire();
				dmsg('ˢ�³ɹ�', $forward);
			}
		} else {
			$lists = $do->get_list('status=4'.$condition);
			include tpl('honor_expire', $module);
		}
	break;
	case 'check':
		if($itemid && !$psize) {
			$do->check($itemid);
			dmsg('��˳ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			include tpl('honor_check', $module);
		}
	break;
	case 'reject':
		if($itemid && !$psize) {
			$do->reject($itemid);
			dmsg('�ܾ��ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=1'.$condition, $dorder[$order]);
			include tpl('honor_reject', $module);
		}
	break;
	case 'delete':
		$itemid or msg('��ѡ��֤��');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'restore':
		$itemid or msg('��ѡ��֤��');
		$do->restore($itemid);
		dmsg('��ԭ�ɹ�', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('��ճɹ�', $forward);
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		include tpl('honor', $module);
	break;
}
?>