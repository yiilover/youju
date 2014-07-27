<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = get_type('link', 1);
require MD_ROOT.'/link.class.php';
$do = new dlink();
$menus = array (
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�������', '?moduleid='.$moduleid.'&file='.$file.'&action=check'),
    array('���ӷ���', 'javascript:Dwidget(\'?file=type&item='.$file.'\', \'���ӷ���\');'),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);
if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
if(in_array($action, array('', 'check'))) {
	$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '�Ƿ����ֽ���', '�Ƿ���������', '�Ƿ��Ƽ�����', '�Ƿ��Ƽ�����');
	$dorder  = array('listorder DESC,itemid DESC', 'edittime DESC', 'eidttime ASC', 'type DESC', 'type ASC', 'elite DESC', 'elite ASC');
	$stype  = array('����', '����', 'LOGO');
	$dtype  = array('0', '1', '2');
	$level = isset($level) ? intval($level) : 0;
	$typeid = isset($typeid) ? intval($typeid) : 0;
	$type = isset($type) ? intval($type) : 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$type_select = type_select('link', 1, 'typeid', '��ѡ�����', $typeid);
	$order_select  = dselect($sorder, 'order', '', $order);
	$level_select = level_select('level', '����', $level);
	$_type_select  = dselect($stype, 'type', '', $type);
	$condition = '';
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND title LIKE '%$keyword%'";
	if($typeid) $condition .= " AND typeid=$typeid";
	if($type) $condition .= $type == 1 ? " AND thumb=''" : " AND thumb<>''";
	if($level) $condition .= " AND level=$level";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&typeid='.$post['typeid']);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$linkurl = 'http://';
			$status = 3;
			$addtime = timetodate($AJ_TIME);
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
			include tpl('link_edit', $module);
		}
	break;
	case 'check':
		if($itemid) {
			$do->check($itemid);
			dmsg('��˳ɹ�', $forward);
		} else {
			$lists = $do->get_list("status=2 AND username=''".$condition, $dorder[$order]);
			include tpl('link_check', $module);
		}
	break;
	case 'order':
		$do->order($listorder); 
		dmsg('����ɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ������');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ������');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	default:
		$lists = $do->get_list("status=3 AND username=''".$condition, $dorder[$order]);
		include tpl('link', $module);
	break;
}
?>