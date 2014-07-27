<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/group.class.php';
$do = new group($moduleid);
$menus = array (
    array('���'.$MOD['name'], '?moduleid='.$moduleid.'&action=add'),
    array($MOD['name'].'�б�', '?moduleid='.$moduleid),
    array('���'.$MOD['name'], '?moduleid='.$moduleid.'&action=check'),
    array('����'.$MOD['name'], '?moduleid='.$moduleid.'&action=expire'),
    array('δͨ��'.$MOD['name'], '?moduleid='.$moduleid.'&action=reject'),
    array('����վ', '?moduleid='.$moduleid.'&action=recycle'),
    array('�ƶ�����', '?moduleid='.$moduleid.'&action=move'),
);

if(in_array($action, array('add', 'edit'))) {
	$FD = cache_read('fields-'.substr($table, strlen($AJ_PRE)).'.php');
	if($FD) require AJ_ROOT.'/include/fields.func.php';
	isset($post_fields) or $post_fields = array();
	$CP = $MOD['cat_property'];
	if($CP) require AJ_ROOT.'/include/property.func.php';
	isset($post_ppt) or $post_ppt = array();
}

if($_catids || $_areaids) require AJ_ROOT.'/admin/admin_check.inc.php';

if(in_array($action, array('', 'check', 'expire', 'reject', 'recycle'))) {
	$sfields = array('ģ��','����', '���', '��˾��', '��ϵ��', '��ϵ�绰', '��ϵ��ַ', '�����ʼ�', '��ϵMSN', '��ϵQQ', '��Ա��', 'IP');
	$dfields = array('keyword','title', 'introduce', 'company', 'truename', 'telephone', 'address', 'email', 'msn', 'qq','username', 'ip');
	$sorder  = array('�������ʽ', '������������', '������������', '����������', '����������', '�Ź��۽���', '�Ź�������', '�г��۽���', '�г�������', '��ʡ���ý���', '��ʡ��������', '�����ۿ۽���', '�����ۿ�����', '�����������', '�����������', '�����������', '�����������', '����˴ν���', '����˴�����', '����ʱ�併��', '����ʱ������', VIP.'������', VIP.'��������', '���ʱ�併��', '���ʱ������', '����ʱ�併��', '����ʱ������', '��ϢID����', '��ϢID����');
	$dorder  = array($MOD['order'], 'orders DESC', 'orders ASC', 'sales DESC', 'sales ASC', 'price DESC', 'price ASC', 'marketprice DESC', 'marketprice ASC', 'savemoney DESC', 'savemoney ASC', 'discount DESC', 'discount ASC', 'amount DESC', 'amount ASC', 'minamount DESC', 'minamount ASC', 'hits DESC', 'hits ASC', 'edittime DESC', 'edittime ASC', 'vip DESC', 'vip ASC', 'addtime DESC', 'addtime ASC', 'endtime DESC', 'endtime ASC', 'itemid DESC', 'itemid ASC');
	$_process = array(
	'<span style="color:#008000;">[������]</span>',
	'<span style="color:#0000FF;">[�Ź���]</span>',
	'<span style="color:#FF0000;">[�ѽ���]</span>',
	);

	$level = isset($level) ? intval($level) : 0;
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;

	isset($datetype) && in_array($datetype, array('edittime', 'addtime', 'totime', 'endtime')) or $datetype = 'addtime';
	$fromdate = isset($fromdate) && is_date($fromdate) ? $fromdate : '';
	$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
	$todate = isset($todate) && is_date($todate) ? $todate : '';
	$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
	
	$minprice = isset($minprice) ? dround($minprice) : '';
	$minprice or $minprice = '';
	$maxprice = isset($maxprice) ? dround($maxprice) : '';
	$maxprice or $maxprice = '';
	$minmarketprice = isset($minmarketprice) ? dround($minmarketprice) : '';
	$minmarketprice or $minmarketprice = '';
	$maxmarketprice = isset($maxmarketprice) ? dround($maxmarketprice) : '';
	$maxmarketprice or $maxmarketprice = '';
	$minamount = isset($minamount) ? dround($minamount) : '';
	$minamount or $minamount = '';
	$maxamount = isset($maxamount) ? dround($maxamount) : '';
	$maxamount or $maxamount = '';
	$minminamount = isset($minminamount) ? dround($minminamount) : '';
	$minminamount or $minminamount = '';
	$maxminamount = isset($maxminamount) ? dround($maxminamount) : '';
	$maxminamount or $maxminamount = '';
	$mindiscount = isset($mindiscount) ? intval($mindiscount) : '';
	$mindiscount or $mindiscount = '';
	$maxdiscount = isset($maxdiscount) ? intval($maxdiscount) : '';
	$maxdiscount or $maxdiscount = '';
	$logistic = isset($logistic) ? intval($logistic) : '-1';
	$process = isset($process) ? intval($process) : '-1';
	$itemid or $itemid = '';

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$level_select = level_select('level', '����', $level);
	$order_select  = dselect($sorder, 'order', '', $order);

	$condition = '';
	if($_childs) $condition .= " AND catid IN (".$_childs.")";//CATE
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($catid) $condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";

	if($level) $condition .= " AND level=$level";
	if($minprice)  $condition .= " AND price>=$minprice";
	if($maxprice)  $condition .= " AND price<=$maxprice";
	if($minmarketprice)  $condition .= " AND marketprice>=$minmarketprice";
	if($maxmarketprice)  $condition .= " AND marketprice<=$maxmarketprice";
	if($minamount)  $condition .= " AND amount>=$minamount";
	if($maxamount)  $condition .= " AND amount<=$maxamount";
	if($minminamount)  $condition .= " AND minamount>=$minminamount";
	if($maxminamount)  $condition .= " AND minamount<=$maxminamount";
	if($mindiscount)  $condition .= " AND discount>=$mindiscount";
	if($maxdiscount)  $condition .= " AND discount<=$maxdiscount";
	if($fromtime) $condition .= " AND `$datetype`>=$fromtime";
	if($totime) $condition .= " AND `$datetype`<=$totime";
	if($itemid) $condition .= " AND itemid=$itemid";
	if($logistic > -1) $condition .= " AND logistic=$logistic";
	if($process > -1) $condition .= " AND process=$process";

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
				if($MOD['show_html'] && $post['status'] > 2) $do->tohtml($do->itemid);
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
			$addtime = timetodate($AJ_TIME);
			$totime = '';
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
				if($FD) fields_update($post_fields, $table, $do->itemid);
				if($CP) property_update($post_ppt, $moduleid, $post['catid'], $do->itemid);
				$do->edit($post);
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
			$tname = '�޸�'.$MOD['name'];
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
		is_array($itemid) or msg('��ѡ����Ʒ');
		foreach($itemid as $v) {
			$do->update($v);
		}
		dmsg('���³ɹ�', $forward);
	break;
	case 'tohtml':
		is_array($itemid) or msg('��ѡ����Ʒ');
		foreach($itemid as $itemid) {
			tohtml('show', $module);
		}
		dmsg('���³ɹ�', $forward);
	break;
	case 'delete':
		$itemid or msg('��ѡ����Ʒ');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'restore':
		$itemid or msg('��ѡ����Ʒ');
		$do->restore($itemid);
		dmsg('��ԭ�ɹ�', $forward);
	break;
	case 'refresh':
		$itemid or msg('��ѡ����Ʒ');
		$do->refresh($itemid);
		dmsg('ˢ�³ɹ�', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('��ճɹ�', $forward);
	break;
	case 'level':
		$itemid or msg('��ѡ����Ʒ');
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
					$db->query("UPDATE {$table} SET totime=totime+$days*86400,status=3,process=1 WHERE itemid='$v' AND totime>0");
				}
				$do->expire();
				dmsg('��ʱ�ɹ�', $forward);
			} else {
				$do->expire();
				dmsg('ˢ�³ɹ�', $forward);
			}
		} else {
			$lists = $do->get_list('status=4'.$condition);
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