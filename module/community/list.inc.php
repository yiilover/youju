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

$condition = 'status=3 ';

	
if($catid) $condition .= $CAT['child'] ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";	      
//$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";

if($AJ['city']){
$mainarea = get_mainarea($cityid);
}else{
$mainarea = get_mainarea(0);}
if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";

	
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
$hsall=$db->pre.'sale_5';
$hrent=$db->pre.'rent_7';
$null="' '";
if($items) {
	$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE {$condition} ORDER BY ".$MOD['order']." LIMIT {$offset},{$pagesize}", ($CFG['db_expires'] && $page == 1) ? 'CACHE' : '', $CFG['db_expires']);
	while($r = $db->fetch_array($result)) {
		$r['adddate'] = timetodate($r['addtime'], 5);
		$r['editdate'] = timetodate($r['edittime'], 5);
		$r['alt'] = $r['title'];
			if($lazy && isset($r['thumb']) && $r['thumb']) $r['thumb'] = AJ_SKIN.'image/lazy.gif" original="'.$r['thumb'];
		$r['tedian'] = $r['tedian'];
		$r['telephone'] = $r['telephone'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
		  $itemids=$r['itemid'];
	       $sum_array = $db->query('select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from '.$hsall.' as t where status=3 and  price <>'.$null.' and houseearm <>'.$null.'and houseid='.$itemids.'');
		 $sum_arrays=$db->fetch_array($sum_array);
		  $avg_price = intval($sum_arrays['sum_p']*10000/$sum_arrays['sum_c']);
		 $avg_pricess=$sum_arrays['avg_price'];
		  $r['avg_price']=$avg_price;
		    $pb= mktime(0,0,0,date('m')-1,date('d'),date('Y'));
		    $sum_arrayb = $db->query('select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from '.$hsall.' as t where status=3 and price <>'.$null.' and houseearm <>'.$null.'and  houseid='.$itemids.' and addtime >='.$pb.'');
		$sum_arraybs=$db->fetch_array($sum_arrayb);
		  $avg_priceb = intval($sum_arraybs['sum_p']*10000/$sum_arraybs['sum_c']);
		  $r['avg_priceb']=$avg_priceb;
		  $percent_change = round(($avg_priceb-$avg_price)/$avg_priceb*100,2);
		$r['percent_change']=$percent_change;
		
		$sales=$db->get_one("SELECT COUNT(*) AS num FROM $hsall WHERE status=3 and houseid=$itemids");
        $sales=$sales[num];
		$r['sales']=$sales;
		
		$rents=$db->get_one("SELECT COUNT(*) AS num FROM $hrent WHERE status=3 and houseid=$itemids");
        $rents=$rents[num];
		$r['rents']=$rents;
		  
		$tags[] = $r;
	}
	$db->free_result($result);
}
$showpage = 1;
$datetype = 5;

$seo_file = 'list';
include AJ_ROOT.'/include/seo.inc.php';

$template = $CAT['template'] ? $CAT['template'] : 'list';
include template($template, $module);
?>