<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = get_type('style', 1);
require MD_ROOT.'/style.class.php';
$do = new style();
$menus = array (
    array('��װģ��', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('ģ���б�', '?moduleid='.$moduleid.'&file='.$file),
    array('ģ�����', '?file=type&item=style'),
);

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
			$addtime = timetodate($AJ_TIME);
			include tpl('style_add', $module);
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
			$groupid = substr($groupid, 1, -1);
			$addtime = timetodate($addtime);
			include tpl('style_edit', $module);
		}
	break;
	case 'show':
		$itemid or msg();
		$u = $db->get_one("SELECT username FROM {$AJ_PRE}company ORDER BY vip DESC");
		dheader(AJ_PATH.'index.php?homepage='.$u['username'].'&preview='.$itemid);
	break;
	case 'order':
		$do->order($listorder);
		dmsg('���³ɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ��ģ��');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	default:
		$sfields = array('������', 'ģ������', '���Ŀ¼', 'ģ��Ŀ¼', '����');
		$dfields = array('title', 'title', 'skin', 'template', 'author');
		$sorder  = array('�������ʽ', 'ģ��۸���', 'ģ��۸�����', $AJ['money_name'].'���潵��', $AJ['money_name'].'��������', $AJ['credit_name'].'���潵��', $AJ['credit_name'].'��������', 'ʹ����������', 'ʹ����������', '���ʱ�併��', '���ʱ������');
		$dorder  = array('listorder DESC,addtime DESC', 'fee DESC', 'fee ASC', 'money DESC', 'money ASC', 'credit DESC', 'credit ASC', 'hits DESC', 'hits ASC', 'addtime DESC', 'addtime ASC');
	
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$groupid = isset($groupid) ? intval($groupid) : 0;
		$typeid = isset($typeid) ? intval($typeid) : 0;
		isset($currency) or $currency = '';
		isset($minfee) or $minfee = '';
		isset($maxfee) or $maxfee = '';
	
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$type_select = type_select('style', 1, 'typeid', '��ѡ�����', $typeid);
	
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($groupid) $condition .= " AND groupid LIKE '%,$groupid,%'";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($currency) $condition .= $currency == 'free' ? " AND fee=0" : " AND currency='$currency'";
		if($minfee) $condition .= " AND fee>=$minfee";
		if($maxfee) $condition .= " AND fee<=$maxfee";
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('style', $module);
	break;
}
?>