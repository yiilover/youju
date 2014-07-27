<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/webpage.class.php';
isset($item) or $item = 1;
$do = new webpage();
$do->item = $item;
$menus = array (
    array('��ӵ�ҳ', '?moduleid='.$moduleid.'&file='.$file.'&item='.$item.'&action=add'),
    array('��ҳ�б�', '?moduleid='.$moduleid.'&file='.$file.'&item='.$item),
    array('ȫ����ҳ', '?moduleid='.$moduleid.'&file='.$file.'&item='.$item.'&itemid=1'),
    array('��������', '?moduleid='.$moduleid.'&file='.$file.'&item='.$item.'&action=group'),
    array('������ҳ', '?moduleid='.$moduleid.'&file='.$file.'&item='.$item.'&action=html'),
);

if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';

$this_forward = '?moduleid='.$moduleid.'&file='.$file.'&item='.$item;
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
			$filepath = 'about/';
			$filename = '';
			$menuid = 0;
			include tpl('webpage_edit', $module);
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
			if($islink) {
				$filepath = $filename = '';
			} else {
				$filestr = str_replace(AJ_PATH, '', $linkurl);
				$filepath = strpos($filestr, '/') !== false ? dirname($filestr).'/' : '';
				$filename = basename($filestr);
			}
			$menuid = 1;
			include tpl('webpage_edit', $module);
		}
	break;
	case 'group':
		if($submit) {
			$name or msg('����д��������');
			preg_match("/^[a-z0-9]{1,}$/", $item) or msg('�����ʶӦΪ���ֺ���ĸ�����');
			$name = addslashes($name);
			$url = '?moduleid=3&file=webpage&item='.$item;
			$db->query("INSERT INTO {$AJ_PRE}admin (userid,title,url,style) VALUES('$_userid','$name','$url','#FF0000')");
			require_once AJ_ROOT.'/admin/admin.class.php';
			$do = new admin;
			$do->cache_menu($_userid);
			msg('��ӳɹ�<script type="text/javascript">window.parent.frames[0].location.reload();</script>', $url);
		} else {
			$name = '��������';
			$item = 'new';
			include tpl('webpage_group', $module);
		}
	break;
	case 'order':
		$do->order($listorder);
		dmsg('����ɹ�', $forward);
	break;
	case 'html':
		$all = (isset($all) && $all) ? 1 : 0;
		$one = (isset($one) && $one) ? 1 : 0;
		if(!isset($num)) {
			$num = 50;
		}
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(itemid) AS fid FROM {$AJ_PRE}webpage");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(itemid) AS tid FROM {$AJ_PRE}webpage");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		if($fid <= $tid) {
			$result = $db->query("SELECT itemid FROM {$AJ_PRE}webpage WHERE itemid>=$fid ORDER BY itemid LIMIT 0,$num");
			if($db->affected_rows($result)) {
				while($r = $db->fetch_array($result)) {
					$itemid = $r['itemid'];
					tohtml('webpage', $module);
				}
				$itemid += 1;
			} else {
				$itemid = $fid + $num;
			}
		} else {
			if($all) dheader("?moduleid=3&file=vote&action=html&all=1&item=$item&one=$one");
			dmsg('���ɳɹ�', "?moduleid=$moduleid&file=$file&item=$item");
		}
		msg('ID��'.$fid.'��'.($itemid-1).'[��ҳ]���ɳɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num&item=$item&all=$all&one=$one");
	break;
	case 'delete':
		$itemid or msg('��ѡ��ҳ');
		$do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ��ҳ');
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	default:
		$sfields = array('������', '����', '���ӵ�ַ', '����', '������');
		$dfields = array('title','title','linkurl','content','domain');
		$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '�����������', '�����������');
		$dorder  = array('listorder DESC,itemid DESC', 'addtime DESC', 'addtime ASC', 'hits DESC', 'hits ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$level = isset($level) ? intval($level) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$level_select = level_select('level', '����', $level);
		$condition = $itemid ? "1" : "item='$item'";
		if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($level) $condition .= " AND level=$level";
		if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('webpage', $module);
	break;
}
?>