<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = get_type('announce', 1);
require MD_ROOT.'/announce.class.php';
$do = new announce();
$menus = array (
    array('��ӹ���', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file),
    array('���µ�ַ', '?moduleid='.$moduleid.'&file='.$file.'&action=update'),
    array('������ҳ', '?moduleid='.$moduleid.'&file='.$file.'&action=html'),
    array('�������', 'javascript:Dwidget(\'?file=type&item='.$file.'\', \'�������\');'),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);

if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';

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
			$addtime = timetodate($AJ_TIME);
			$menuid = 0;
			include tpl('announce_edit', $module);
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
			include tpl('announce_edit', $module);
		}
	break;
	case 'order':
		$do->order($listorder);
		dmsg('����ɹ�', $forward);
	break;
	case 'update':
		$do->update();
		dmsg('���³ɹ�', $forward);
	break;
	case 'html':
		$all = (isset($all) && $all) ? 1 : 0;
		$one = (isset($one) && $one) ? 1 : 0;
		if(!isset($num)) {
			$num = 50;
		}
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(itemid) AS fid FROM {$AJ_PRE}announce");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(itemid) AS tid FROM {$AJ_PRE}announce");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		if($fid <= $tid) {
			$result = $db->query("SELECT itemid FROM {$AJ_PRE}announce WHERE itemid>=$fid ORDER BY itemid LIMIT 0,$num");
			if($db->affected_rows($result)) {
				while($r = $db->fetch_array($result)) {
					$itemid = $r['itemid'];
					tohtml('announce', $module);
				}
				$itemid += 1;
			} else {
				$itemid = $fid + $num;
			}
		} else {
			if($all) dheader('?moduleid=3&file=webpage&action=html&all=1&one='.$one);
			dmsg('���ɳɹ�', "?moduleid=$moduleid&file=$file");
		}
		msg('ID��'.$fid.'��'.($itemid-1).'[����]���ɳɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num&all=$all&one=$one");
	break;
	case 'delete':
		$itemid or msg('��ѡ�񹫸�');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ�񹫸�');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	default:
		$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '�����������', '�����������', '��ʼʱ�併��', '��ʼʱ������', '����ʱ�併��', '����ʱ������');
		$dorder  = array('listorder DESC,addtime DESC', 'addtime DESC', 'addtime ASC', 'hits DESC', 'hits ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC');
		isset($order) && isset($dorder[$order]) or $order = 0;
		isset($typeid) or $typeid = 0;
		$level = isset($level) ? intval($level) : 0;
		$type_select = type_select('announce', 1, 'typeid', '��ѡ�����', $typeid);
		$order_select  = dselect($sorder, 'order', '', $order);
		$level_select = level_select('level', '����', $level);
		$condition = '1';
		if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
		if($keyword) $condition .= " AND title LIKE '%$keyword%'";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($level) $condition .= " AND level=$level";
		if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('announce', $module);
	break;
}
?>