<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = $L['ad_type'];
$AREA or $AREA = cache_read('area.php');
require MD_ROOT.'/ad.class.php';
isset($pid) or $pid = 0;
isset($aid) or $aid = 0;
$menus = array (
    array('��ӹ��λ', '?moduleid='.$moduleid.'&file='.$file.'&action=add_place'),
    array('���λ����', '?moduleid='.$moduleid.'&file='.$file),	
    array('������', 'javascript:Dwidget(\'?moduleid='.$moduleid.'&file='.$file.'&action=list\', \'������\');'),
    array('������', 'javascript:Dwidget(\'?moduleid='.$moduleid.'&file='.$file.'&action=list&job=check\', \'������\');'),
    array('���¹��', '?moduleid='.$moduleid.'&file='.$file.'&action=html'),
    array('ģ������', '?moduleid='.$moduleid.'&file=setting#'.$file),
);
$menusad = array (
    array('��ӹ��', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid.'&action=add'),
    array('������', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid.'&action=list'),
    array('������', '?moduleid='.$moduleid.'&file='.$file.'&pid='.$pid.'&action=list&job=check'),
);
$do = new ad();
$do->pid = $pid;
$do->aid = $aid;
$currency = $MOD['ad_currency'];
$unit = $currency == 'money' ? $AJ['money_unit'] : $AJ['credit_unit'];
$this_forward = '?moduleid='.$moduleid.'&file='.$file.'&action=list&pid='.$pid.'&page='.$page;
$this_place_forward = '?moduleid='.$moduleid.'&file='.$file.'&page='.$page;
switch($action) {
	case 'add':
		$pid or msg('δָ�����λ');
		if($submit) {
			if($do->is_ad($ad)) {
				$do->add($ad);
				$aid = $do->aid;
				if($ad['typeid'] == 6) {
					$MOD['linkurl'] = $MODULE[$ad['key_moduleid']]['linkurl'];
				}
				tohtml('ad', $module);
				dmsg('��ӳɹ�', $forward ? $forward : $this_forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$p = $do->get_one_place();
			$fromtime = timetodate($AJ_TIME, 3);
			include tpl('ad_add', $module);
		}
	break;
	case 'edit':
		$aid or msg();
		if($submit) {
			if($do->is_ad($ad)) {
				$do->edit($ad);
				if($pid != $ad['pid']) {
					$db->query("UPDATE {$AJ_PRE}ad_place SET ads=ads+1 WHERE pid=$ad[pid]");
					$db->query("UPDATE {$AJ_PRE}ad_place SET ads=ads-1 WHERE pid=$pid");
				}
				if($ad['typeid'] == 6) {
					$MOD['linkurl'] = $MODULE[$ad['key_moduleid']]['linkurl'];
				}
				tohtml('ad', $module);
				dmsg('�޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one());
			$do->pid = $pid;
			$p = $do->get_one_place();
			$fromtime = timetodate($fromtime, 3);
			$totime = timetodate($totime, 3);
			include tpl('ad_edit', $module);
		}
	break;
	case 'delete':
		$aids or msg('��ѡ����');
		$do->delete($aids);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'order_ad':
		$do->order_ad($listorder);
		dmsg('����ɹ�', $forward);
	break;
	case 'list':
		$job = isset($job) ? $job : '';
		$P = $do->get_place();
		$sfields = array('������', '�������', '������', '��Ա��');
		$dfields = array('title', 'title', 'introduce', 'username');
		$sorder  = array('�������ʽ', '���ʱ�併��', '���ʱ������', '��ʼʱ�併��', '��ʼʱ������', '����ʱ�併��', '����ʱ������', '�����������', '�����������');
		$dorder  = array('pid DESC,listorder ASC,addtime ASC', 'addtime DESC', 'addtime ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC', 'hits DESC', 'hits ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		isset($typeid) or $typeid = 0;
		$areaid = isset($areaid) ? intval($areaid) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = $job == 'check' ? "status=2" : "status=3";
		if($pid) $condition .= " AND pid=$pid";
		if($typeid) $condition .= " AND typeid=$typeid";
		$type_select  = dselect($TYPE, 'typeid', '�������', $typeid);
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
		$ads = $do->get_list($condition, $dorder[$order]);
		include tpl('ad_list', $module);
	break;
	case 'add_place':
		if($submit) {
			if($do->is_place($place)) {
				$do->add_place($place);
				dmsg('���λ��ӳɹ�������ӹ��', '?moduleid='.$moduleid.'&file='.$file.'&id='.$do->itemid.'&tm='.($AJ_TIME+5));
			} else {
				msg($do->errmsg);
			}
		} else {
			include tpl('ad_add_place', $module);
		}
	break;
	case 'edit_place':
		$pid or msg();
		if($submit) {
			if($do->is_place($place)) {
				$do->edit_place($place);
				dmsg('�޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$r = $do->get_one_place();
			$mid = $r['moduleid'];
			unset($r['moduleid']);
			extract($r);
			include tpl('ad_edit_place', $module);
		}
	break;
	case 'view':
		$aijiacms_task = '';
		$filename = '';
		$ad_moduleid = 0;
		if($pid) {
			$p = $do->get_one_place();
			$head_title = '���λ ['.$p['name'].'] Ԥ��';
			$typeid = $p['typeid'];
		} else if($aid) {
			$a = $do->get_one();
			$head_title = '��� ['.$a['title'].'] Ԥ��';
			$pid = $a['pid'];
			$typeid = $a['typeid'];
			if($typeid > 5) {
				$ad_moduleid = $a['key_moduleid'];
				$ad_catid = $a['key_catid'];
				$ad_kw = $a['key_word'];
			}
		}
		include template('ad_view', $module);
	break;
	case 'runcode':
		$aijiacms_task = '';
		$codes = stripslashes($codes);
		include tpl('ad_runcode', $module);
	break;
	case 'delete_place':
		$pids or msg('��ѡ����λ');
		$do->delete_place($pids);
		dmsg('ɾ���ɹ�', $forward ? $forward : $this_place_forward);
	break;
	case 'order_place':
		$do->order_place($listorder);
		dmsg('����ɹ�', $forward ? $forward : $this_place_forward);
	break;
	case 'html':
		$all = (isset($all) && $all) ? 1 : 0;
		$one = (isset($one) && $one) ? 1 : 0;
		if(!isset($num)) {
			$num = 100;
			cache_clear_ad(1);
			$result = $db->query("SELECT * FROM {$AJ_PRE}ad_place WHERE ads=0 AND code<>''");
			$totime = $AJ_TIME+86400*365*10;
			while($r = $db->fetch_array($result)) {
				if($r['typeid'] > 5) {
					$filename = 'ad_'.$r['moduleid'].'_d'.$r['typeid'].'.htm';
				} else {
					$filename = 'ad_'.$r['pid'].'_d0.htm';
				}
				$data = '<!--'.$totime.'-->'.$r['code'];
				file_put(AJ_CACHE.'/htm/'.$filename, $data);
				if($r['typeid'] > 1 && $r['typeid'] < 6) {
					$data = 'document.write(\''.dwrite($r['code']).'\');';
					file_put(AJ_ROOT.'/file/script/A'.$r['pid'].'.js', $data);
				}
			}
		}
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(aid) AS fid FROM {$AJ_PRE}ad");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(aid) AS tid FROM {$AJ_PRE}ad");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		$_moduleid = $moduleid;
		if($fid <= $tid) {
			$_result = $db->query("SELECT * FROM {$AJ_PRE}ad WHERE aid>=$fid ORDER BY aid LIMIT 0,$num");
			if($db->affected_rows($_result)) {
				while($a = $db->fetch_array($_result)) {
					$aid = $a['aid'];
					if($a['typeid'] == 6) {
						$MOD['linkurl'] = $MODULE[$a['key_moduleid']]['linkurl'];
					}
					tohtml('ad', $module);
				}
				$aid += 1;
			} else {
				$aid = $fid + $num;
			}
		} else {
			if($all) dheader('?moduleid=3&file=announce&action=html&all=1&one='.$one);
			dmsg('���ɳɹ�', "?moduleid=$_moduleid&file=$file");
		}
		msg('ID��'.$fid.'��'.($aid-1).'[���]���ɳɹ�'.progress($sid, $fid, $tid), "?moduleid=$_moduleid&file=$file&action=$action&sid=$sid&fid=$aid&tid=$tid&num=$num&all=$all&one=$one");
	break;
	default:
		isset($typeid) or $typeid = 0;
		$width = isset($width) ? intval($width) : '';
		$height = isset($height) ? intval($height) : '';
		$open = isset($open) ? $open : -1;
		$thumb = isset($thumb) ? intval($thumb) : 0;
		$condition = '1';
		$type_select  = dselect($TYPE, 'typeid', '', $typeid);
		if($keyword) $condition .= " AND name LIKE '%$keyword%'";
		if($typeid) $condition .= " AND typeid=$typeid";
		if($width) $condition .= " AND width=$width";
		if($height) $condition .= " AND height=$height";
		if($thumb) $condition .= " AND thumb<>''";
		if($open > -1) $condition .= " AND open=$open";
		$places = $do->get_list_place($condition);
		include tpl('ad', $module);
	break;
}
?>