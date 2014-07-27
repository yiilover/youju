<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/job.class.php';
$do = new job($moduleid);
$menus = array (
    array('�����Ƹ', '?moduleid='.$moduleid.'&action=add'),
    array('��Ƹ�б�', '?moduleid='.$moduleid),
    array('�����Ƹ', '?moduleid='.$moduleid.'&action=check'),
    array('������Ƹ', '?moduleid='.$moduleid.'&action=expire'),
    array('δͨ����Ƹ', '?moduleid='.$moduleid.'&action=reject'),
    array('����վ', '?moduleid='.$moduleid.'&action=recycle'),
    array('�ƶ���Ƹ', '?moduleid='.$moduleid.'&action=move'),
);

if(in_array($action, array('add', 'edit'))) {
	$FD = cache_read('fields-job.php');
	if($FD) require AJ_ROOT.'/include/fields.func.php';
	isset($post_fields) or $post_fields = array();
	$CP = $MOD['cat_property'];
	if($CP) require AJ_ROOT.'/include/property.func.php';
	isset($post_ppt) or $post_ppt = array();
}

if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';

if(in_array($action, array('', 'check', 'expire', 'reject', 'recycle'))) {
	$GENDER[0] = '�Ա�Ҫ��';
	$TYPE[0] = '��������';
	$MARRIAGE[0] = '����״��';
	$EDUCATION[0] = 'ѧ��Ҫ��';
	$sfields = array('ģ��', 'ְλ����', '���', '��Ƹ����', '��˾��', '��ϵ��', '��ϵ�绰', '��ϵ��ַ', '�����ʼ�', '��ϵMSN', '��ϵQQ', '��Ա��', 'IP');
	$dfields = array('keyword', 'title', 'introduce', 'department', 'company', 'truename', 'telephone', 'address', 'email', 'msn', 'qq','username', 'ip');
	$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '���ʱ�併��', '���ʱ������', '�����������', '�����������', '��Ƹ��������', '��Ƹ��������', '��ʹ�������', '��ʹ�������', '��ߴ�������', '��ߴ�������', 'ѧ���ߵͽ���', 'ѧ���ߵ�����', '��ϢID����', '��ϢID����');
	$dorder  = array($MOD['order'], 'edittime DESC', 'edittime ASC', 'addtime DESC', 'addtime ASC', 'hits DESC', 'hits ASC', 'total DESC', 'total ASC', 'minsalary DESC', 'minsalary ASC', 'maxalary DESC', 'maxsalary ASC', 'education DESC', 'education ASC', 'itemid DESC', 'itemid ASC');

	$level = isset($level) ? intval($level) : 0;
	$gender = isset($gender) ? intval($gender) : 0;
	$type = isset($type) ? intval($type) : 0;
	$marriage = isset($marriage) ? intval($marriage) : 0;
	$education = isset($education) ? intval($education) : 0;
	$experience = isset($experience) ? intval($experience) : 0;
	$areaid = isset($areaid) ? intval($areaid) : 0;
	$minsalary = isset($minsalary) ? intval($minsalary) : 0;
	$maxsalary = isset($maxsalary) ? intval($maxsalary) : 0;

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	
	isset($datetype) && in_array($datetype, array('edittime', 'addtime', 'totime')) or $datetype = 'edittime';
	$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
	$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
	$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
	$totime = $todate ? strtotime($todate.' 23:59:59') : 0;

	$areaid = isset($areaid) ? intval($areaid) : 0;
	$itemid or $itemid = '';
	$minvip = isset($minvip) ? intval($minvip) : '';
	$minvip or $minvip = '';
	$maxvip = isset($maxvip) ? intval($maxvip) : '';
	$maxvip or $maxvip = '';


	$fields_select = dselect($sfields, 'fields', '', $fields);
	$level_select = level_select('level', '����', $level);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($_childs) $condition .= " AND catid IN (".$_childs.")";//CATE
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($catid) $condition .= ($CATEGORY[$catid]['child']) ? " AND catid IN (".$CATEGORY[$catid]['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND areaid IN (".$AREA[$areaid]['arrchildid'].")" : " AND areaid=$areaid";
	if($level) $condition .= " AND level=$level";
	if($gender) $condition .= " AND gender=$gender";
	if($type) $condition .= " AND type=$type";
	if($marriage) $condition .= " AND marriage=$marriage";
	if($education) $condition .= " AND education>=$education";
	if($experience) $condition .= " AND experience>=$experience";
	if($minsalary) $condition .= " AND minsalary>=$minsalary";
	if($maxsalary) $condition .= " AND maxsalary<=$maxsalary";
	if($fromtime) $condition .= " AND `$datetype`>=$fromtime";
	if($totime) $condition .= " AND `$datetype`<=$totime";
	if($minvip)  $condition .= " AND vip>=$minvip";
	if($maxvip)  $condition .= " AND vip<=$maxvip";
	if($itemid) $condition = " AND itemid=$itemid";

	$timetype = strpos($dorder[$order], 'add') !== false ? 'add' : '';
}
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				if($FD) fields_check($post_fields);
				if($CP) property_check($post_ppt);
				$do->add($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				if($CP) property_update($post_ppt, $moduleid, $post['catid'], $do->itemid);
				dmsg('��ӳɹ�', '?moduleid='.$moduleid.'&action='.$action);
			} else {
				msg($do->errmsg);
			}
		} else {
			foreach($do->fields as $v) {
				isset($$v) or $$v = '';
			}
			$content = '';
			$status = 3;
			$sex = 1;
			$addtime = timetodate($AJ_TIME);
			$username = $_username;
			$item = array();
			$menuid = 0;
			$tname = $menus[$menuid][0];
			isset($url) or $url = '';
			if($url) {
				$tmp = fetch_url($url);
				if($tmp) extract($tmp);
			}
			include tpl('edit', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->pass($post)) {
				if($FD) fields_check($post_fields);
				if($CP) property_check($post_ppt);
				$do->edit($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				if($CP) property_update($post_ppt, $moduleid, $post['catid'], $do->itemid);
				dmsg('�޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$item = $do->get_one();
			extract($item);
			$addtime = timetodate($addtime);
			$totime = $totime ? timetodate($totime, 3) : '';
			$menuon = array('5', '4', '2', '1', '3');
			$menuid = $menuon[$status];
			$tname = '�޸���Ƹ';
			include tpl($action, $module);
		}
	break;
	case 'move':
		if($submit) {
			$fromids or msg('����д��ԴID');
			if($tocatid) {
				$db->query("UPDATE {$table} SET catid=$tocatid WHERE `{$fromtype}` IN ($fromids)");
				dmsg('�ƶ��ɹ�', $forward);
			} else {
				msg('��ѡ��Ŀ�����');
			}
		} else {
			$itemid = $itemid ? implode(',', $itemid) : '';
			$menuid = 6;
			include tpl($action, $module);
		}
	break;
	case 'update':
		is_array($itemid) or msg('��ѡ��'.$MOD['name']);
		foreach($itemid as $v) {
			$do->update($v);
		}
		dmsg('���³ɹ�', $forward);
	break;
	case 'tohtml':
		is_array($itemid) or msg('��ѡ��'.$MOD['name']);
		foreach($itemid as $itemid) {
			tohtml('show', $module);
		}
		dmsg('���³ɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ��'.$MOD['name']);
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'restore':
		$itemid or msg('��ѡ��'.$MOD['name']);
		$do->restore($itemid);
		dmsg('��ԭ�ɹ�', $forward);
	break;
	case 'refresh':
		$itemid or msg('��ѡ��'.$MOD['name']);
		$do->refresh($itemid);
		dmsg('ˢ�³ɹ�', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('��ճɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ��'.$MOD['name']);
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	case 'recycle':
		$lists = $do->get_list('status=0'.$condition, $dorder[$order]);
		$menuid = 5;
		include tpl('index', $module);
	break;
	case 'reject':
		if($itemid && !$psize) {
			$do->reject($itemid);
			dmsg('�ܾ��ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=1'.$condition, $dorder[$order]);
			$menuid = 4;
			include tpl('index', $module);
		}
	break;
	case 'expire':
		if(isset($refresh)) {
			if(isset($extend)) {
				$days = isset($days) ? intval($days) : 0;
				$days or msg('����д����');
				$itemid or msg('��ѡ����Ϣ');
				foreach($itemid as $v) {
					$db->query("UPDATE {$table} SET totime=totime+$days*86400,status=3 WHERE itemid='$v' AND totime>0");
				}
				$do->expire();
				dmsg('��ʱ�ɹ�', $forward);
			} else {
				$do->expire();
				dmsg('ˢ�³ɹ�', $forward);
			}
		} else {
			$lists = $do->get_list('status=4'.$condition, $dorder[$order]);
			$menuid = 3;
			include tpl('index', $module);
		}
	break;
	case 'check':
		if($itemid && !$psize) {
			$do->check($itemid);
			dmsg('��˳ɹ�', $forward);
		} else {
			$lists = $do->get_list('status=2'.$condition, $dorder[$order]);
			$menuid = 2;
			include tpl('index', $module);
		}
	break;
	default:
		$lists = $do->get_list('status=3'.$condition, $dorder[$order]);
		$menuid = 1;
		include tpl('index', $module);
	break;
}
?>