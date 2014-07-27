<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = get_type('gift', 1);
require MD_ROOT.'/gift.class.php';
$do = new gift();
$menus = array (
    array('�����Ʒ', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('��Ʒ�б�', '?moduleid='.$moduleid.'&file='.$file),
    array('�����б�', 'javascript:Dwidget(\'?moduleid='.$moduleid.'&file='.$file.'&action=order\', \'��������\');'),
    array('���µ�ַ', '?moduleid='.$moduleid.'&file='.$file.'&action=update'),
    array('��Ʒ����', 'javascript:Dwidget(\'?file=type&item='.$file.'\', \'��Ʒ����\');'),
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
			$groupid = '5,6,7';
			$addtime = timetodate($AJ_TIME);
			$menuid = 0;
			include tpl('gift_edit', $module);
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
			include tpl('gift_edit', $module);
		}
	break;
	case 'update':
		$do->update();
		dmsg('���³ɹ�', $forward);
	break;
	case 'html':
		if(!isset($num)) {
			$num = 50;
		}
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(itemid) AS fid FROM {$AJ_PRE}gift");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(itemid) AS tid FROM {$AJ_PRE}gift");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		if($fid <= $tid) {
			$result = $db->query("SELECT itemid FROM {$AJ_PRE}gift WHERE itemid>=$fid ORDER BY itemid LIMIT 0,$num");
			if($db->affected_rows($result)) {
				while($r = $db->fetch_array($result)) {
					$itemid = $r['itemid'];
					tohtml('gift', $module);
				}
				$itemid += 1;
			} else {
				$itemid = $fid + $num;
			}
		} else {
			dmsg('���ɳɹ�', "?moduleid=$moduleid&file=$file");
		}
		msg('ID��'.$fid.'��'.($itemid-1).'���ɳɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num");
	break;
	case 'delete':
		$itemid or msg('��ѡ����Ʒ');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ����Ʒ');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	case 'order':
		if($submit) {
			$do->update_order($post);
			dmsg('���³ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&itemid='.$itemid);
		} else {
			$sfields = array('������', '��Ʒ', '��Ա��', '״̬', '��ע');
			$dfields = array('g.title','o.username','o.status','o.note');
			isset($fields) && isset($dfields[$fields]) or $fields = 0;
			$fields_select = dselect($sfields, 'fields', '', $fields);
			$condition = "1";
			if($itemid) $condition .= " AND o.itemid=$itemid";
			if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
			$lists = $do->get_list_order($condition);
			include tpl('gift_order', $module);
		}
	break;
	default:
		$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '��Ʒ��������', '��Ʒ��������', '�����������', '�����������', '��ʼʱ�併��', '��ʼʱ������', '����ʱ�併��', '����ʱ������');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'gifts DESC', 'gifts ASC', 'hits DESC', 'hits ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC');
		isset($order) && isset($dorder[$order]) or $order = 0;
		isset($typeid) or $typeid = 0;
		$type_select = type_select('gift', 1, 'typeid', '��ѡ�����', $typeid);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
		if($keyword) $condition .= " AND title LIKE '%$keyword%'";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('gift', $module);
	break;
}
?>