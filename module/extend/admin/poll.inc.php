<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = get_type('poll', 1);
require MD_ROOT.'/poll.class.php';
$do = new poll();
$menus = array (
    array('���Ʊѡ', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('Ʊѡ�б�', '?moduleid='.$moduleid.'&file='.$file),
    array('���µ�ַ', '?moduleid='.$moduleid.'&file='.$file.'&action=update'),
    array('Ʊѡ����', 'javascript:Dwidget(\'?file=type&item='.$file.'\', \'Ʊѡ����\');'),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);
if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('��ӳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$poll_max = 0;
			$poll_page = 30;
			$poll_cols = 3;
			$poll_order = 0;
			$thumb_width = 120;
			$thumb_height = 90;
			$addtime = timetodate($AJ_TIME);
			$menuid = 0;
			include tpl('poll_edit', $module);
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
			$fromtime = $fromtime ? timetodate($fromtime, 3) : '';
			$totime = $totime ? timetodate($totime, 3) : '';
			$menuid = 1;
			include tpl('poll_edit', $module);
		}
	break;
	case 'update':
		$do->update();
		dmsg('���³ɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ��Ʊѡ');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ��Ʊѡ');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	case 'record':
		$pollid = intval($pollid);
		$pollid or msg();
		$do->itemid = $pollid;		
		$P = $do->get_one();
		$P or exit('Ʊѡ������');
		$I = $do->item_all("pollid=$pollid");
		$condition = "pollid=$pollid";
		if($itemid) $condition .= " AND itemid=$itemid";
		if($keyword) $condition .= " AND (ip LIKE '%$keyword%' OR username LIKE '%$keyword%')";
		$lists = $do->get_list_record($condition);
		include tpl('poll_record', $module);
	break;
	case 'item':
		$itemid or msg();
		$do->itemid = $itemid;
		$P = $do->get_one();
		$P or exit('Ʊѡ������');
		if($submit) {
			$do->item_update($post);
			$t = $db->get_one("SELECT SUM(polls) AS total FROM {$AJ_PRE}poll_item WHERE pollid=$itemid");
			if($t['total'] != $P['poll']) $db->query("UPDATE {$AJ_PRE}poll SET polls=$t[total] WHERE itemid=$itemid");
			dmsg('���³ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&itemid='.$itemid);
		} else {
			$sorder  = array('�������ʽ', 'ͶƱ��������', 'ͶƱ��������');
			$dorder  = array('listorder DESC,itemid DESC', 'polls DESC', 'polls ASC');
			$sfields = array('����', '���', '����');
			$dfields = array('title', 'introduce', 'linkurl');
			isset($fields) && isset($dfields[$fields]) or $fields = 0;
			isset($order) && isset($dorder[$order]) or $order = 0;
			$fields_select = dselect($sfields, 'fields', '', $fields);
			$order_select  = dselect($sorder, 'order', '', $order);
			$condition = "pollid=$itemid";
			if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
			$lists = $do->item_list($condition, $dorder[$order]);
			include tpl('poll_item', $module);
		}
	break;
	default:
		$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', 'ͶƱ��������', 'ͶƱ��������', '�����������', '�����������', 'ѡ����������', 'ѡ����������', '��ʼʱ�併��', '��ʼʱ������', '����ʱ�併��', '����ʱ������');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'polls DESC', 'polls ASC', 'hits DESC', 'hits ASC', 'items DESC', 'items ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC');
		isset($order) && isset($dorder[$order]) or $order = 0;
		isset($typeid) or $typeid = 0;
		$type_select = type_select('poll', 1, 'typeid', '��ѡ�����', $typeid);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
		if($keyword) $condition .= " AND title LIKE '%$keyword%'";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('poll', $module);
	break;
}
?>