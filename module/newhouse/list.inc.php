<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$typeid = isset($typeid) && isset($TYPE[$typeid]) ? intval($typeid) : 99;
if($MOD['list_html']) {
	$html_file = listurl($CAT, $page);
	if(is_file(AJ_ROOT.'/'.$MOD['moduledir'].'/'.$html_file)) {
		@header("HTTP/1.1 301 Moved Permanently");
		dheader($MOD['linkurl'].$html_file);
	}
}
if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
$CP = $MOD['cat_property'] && $CAT['property'];
if($MOD['cat_property'] && $CAT['property']) {
	require AJ_ROOT.'/include/property.func.php';
	$PPT = property_condition($catid);
}
unset($CAT['moduleid']);
extract($CAT);

$maincat = get_maincat($child ? $catid : $parentid, $moduleid);

$condition = 'status=3 and isnew=1';
$sorder  = array($L['order'], $L['order_auto'], $L['price_dsc'], $L['price_asc'], $L['vip_dsc'], $L['vip_asc'], $L['selltime_dsc'], $L['selltime_asc'], $L['minamount_dsc'], $L['minamount_asc']);
$dorder  = array($MOD['order'], '', 'price DESC', 'price ASC', 'vip DESC', 'vip ASC', 'selltime DESC', 'selltime ASC', 'minamount DESC', 'minamount ASC');
isset($order) && isset($dorder[$order]) or $order = 0;
	
//if($catid) $condition .= $CAT['child'] ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
if($catid) $condition .= " AND FIND_IN_SET('$catid',`catid`)" ;	        
//$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
if($buildtype) $condition .= " AND FIND_IN_SET('$buildtype',`buildtype`)" ;	
$areaids=$_GET['areaid'];
if($AJ['city']){
$mainarea = get_mainarea($cityid);
$mainareas = get_mainarea2($areaids);
}else{
$mainarea = get_mainarea(0);
$mainareas = get_mainarea3($areaids);}

if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
//¼ÛÄ¿¸ñ·¶Î§
	if($p == 1){
			$condition.=' AND price<4000';
		}
	if($p == 2){
			$condition.=" AND price>=4000  AND price<5000";
			
		}
	if($p == 3){
			$condition.=' AND 5000<=price AND price<6000';
			
		}
	if($p == 4){
			$condition.=' AND 6000<=price AND price<7000';
		}
	if($p == 5){
			$condition.=' AND 7000<=price AND price<8000';
		}
	if($p == 6){
			$condition.=' AND 8000<=price AND price<9000';
		}
	if($p == 7){
			$condition.=' AND 9000<=price AND price<10000';
		}
    if($p == 8){
			$condition.=' AND 10000<=price';
		}
	
$letter = $_GET['l'];
if($letter){
	$condition .= " and letter like '".$letter."%'";
	
}

	if($minprice)  $condition .= " AND price>=$minprice";
	if($maxprice)  $condition .= " AND price<=$maxprice";
	if($typeid != 99) $condition .= " AND typeid=$typeid";
	if($fromtime) $condition .= " AND edittime>=$fromtime";
	if($totime) $condition .= " AND edittime<=$totime";	
	
	
	
$pagesize = $MOD['pagesize'];
$offset = ($page-1)*$pagesize;
$items = $db->count($table, $condition, $CFG['db_expires']);
$pages = pages($items, $page, $pagesize);
//$pages = listpages($CAT, $items, $page, $pagesize);
$tags = array();
if($items) {
    $order = $dorder[$order] ? " ORDER BY $dorder[$order]" : '';
	$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE {$condition} {$order} LIMIT {$offset},{$pagesize}", ($CFG['db_expires'] && $page == 1) ? 'CACHE' : '', $CFG['db_expires']);
	while($r = $db->fetch_array($result)) {
		$r['adddate'] = timetodate($r['addtime'], 5);
		$r['editdate'] = timetodate($r['edittime'], 5);
		$r['alt'] = $r['title'];
		$r['tedian'] = $r['tedian'];
			if($lazy && isset($r['thumb']) && $r['thumb']) $r['thumb'] = AJ_SKIN.'image/lazy.gif" original="'.$r['thumb'];
		$r['buildtype'] = $r['buildtype'];
		$r['telephone'] = $r['telephone'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
		$tags[] = $r;
	}
	$db->free_result($result);
}
$showpage = 1;
$datetype = 5;

$seo_file = 'list';
include AJ_ROOT.'/include/seo.inc.php';

$template = $CAT['template'] ? $CAT['template'] : ($MOD['template_list'] ? $MOD['template_list'] : 'list');
include template($template, $module);
?>