<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
//if(!$CAT || $CAT['moduleid'] != $moduleid) include load('404.inc');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$typeid = isset($typeid) && isset($TYPE[$typeid]) ? intval($typeid) : 99;
if($day) $fromdate = timetodate($AJ_TIME-$day*86400, 'Ymd');
$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
if($MOD['list_html']) {
	$html_file = listurl($CAT, $page);
	if(is_file(AJ_ROOT.'/'.$MOD['moduledir'].'/'.$html_file)) d301($MOD['linkurl'].$html_file);
}
if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) include load('403.inc');
$CP = $MOD['cat_property'] && $CAT['property'];
if($MOD['cat_property'] && $CAT['property']) {
	require AJ_ROOT.'/include/property.func.php';
	$PPT = property_condition($catid);
}
unset($CAT['moduleid']);
extract($CAT);
$maincat = get_maincat($child ? $catid : $parentid, $moduleid);
$condition = 'status=3';

	
if($catid) $condition .= $CAT['child'] ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";	      
//$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
$areaids=$_GET['areaid'];
if($AJ['city']){
$mainarea = get_mainarea($cityid);
$mainareas = get_mainarea2($areaids);
}else{
$mainarea = get_mainarea(0);
$mainareas = get_mainarea3($areaids);}
if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
//价目格范围
	if($p== 1){
			$condition.=' AND price<30';
			$price_option='30万以下';
		}
	if($p == 2){
			$condition.=" AND price>=30  AND price<50";
			$price_option='30-50万';
		}
	if($p == 3){
			$condition.=' AND 50<=price AND price<80';
			$price_option='50-80万';
		}
	if($p== 4){
			$condition.=' AND 80<=price AND price<100';
			$price_option='80-100万';
		}
	if($p == 5){
			$condition.=' AND 100<=price AND price<120';
			$price_option='100-120万';
		}
	if($p == 6){
			$condition.=' AND 120<=price AND price<150';
			$price_option='120-150万';
		}
	if($p == 7){
			$condition.=' AND 150<=price AND price<200';
			$price_option='150-200万';
		}
			//面积范围
	if($a== 1){
			$condition.=' AND houseearm<40';
			$houseearm_option='40平米以下';
		}
	if($a == 2){
			$condition.=" AND houseearm>40  AND houseearm<60";
			$houseearm_option='40-60平米';}
	if($a == 3){
			$condition.=' AND 60<=houseearm AND houseearm<80';
			$houseearm_option='60-80平米';
			
		}
	if($a== 4){
			$condition.=' AND 80<=houseearm AND houseearm<100';
			$houseearm_option='80-100平米';
		}
	if($a == 5){
			$condition.=' AND 100<=houseearm AND houseearm<120';
			$houseearm_option='100-120平米';
		}
	if($a == 6){
			$condition.=' AND 120<=houseearm AND houseearm<150';
			$houseearm_option='120-150平米';
		}
	if($a == 7){
			$condition.=' AND 150<=houseearm';
			$houseearm_option='150平米以上';
		}
		//户型范围
	if($r== 1){
			$condition.=' AND room=1';
			$room_option='一室';
		}
	if($r == 2){
			$condition.=" AND room=2";
			$room_option='二室';}
	if($r == 3){
			$condition.=' AND room=3';
			$room_option='三室';
			
		}
	if($r== 4){
			$condition.=' AND room=4';
			$room_option='四室';
		}
	if($r == 5){
			$condition.=' AND 5<=room ';
			$room_option='五室以上';
		}
   		//房龄范围
	if($y== 1){
			$condition.=' AND houseyear<2000';
			$year_option='2000年以前';
		}
	if($y == 2){
			$condition.=" AND houseyear>=2000";
			$year_option='2000年以后';
		}
	if($y == 3){
			$condition.=' AND houseyear>=2005';
			$year_option='2005年以后';
		}
	if($y== 4){
			$condition.=' AND houseyear>=2010';
			$year_option='2010年以后';
		}
	
				//楼层范围
	if($f== 1){
			$condition.=' AND floor1<6';
			$floor_option='6层以下';
		}
	if($f == 2){
			$condition.=" AND floor1>=6  AND floor<12";
			$floor_option='6-12层';
		}
	if($f == 3){
			$condition.=' AND 12<=floor1 AND floor<20';
			$floor_option='12-20层';
		}
	if($f== 4){
			$condition.=' AND 20<=floor1 ';
			$floor_option='20层以上';
		}
	
		
	//list_order 排序转换
switch ($_GET['order']){
	case "dd":
		$order = " order by price/houseearm desc";
		break;
	case "da":
		$order = " order by price/houseearm asc";
		break;
	case "ed":
		$order = " order by edittime desc";
		break;
		case "ea":
		$order = " order by edittime asc";
		break;
	case "pa":
		$order = " order by price asc";
		break;
	case "pd":
		$order = " order by price desc";
		break;
	case "ha":
		$order = " order by houseearm asc";
		break;
	case "hd":
		$order = " order by houseearm desc";
		break;
	default:
		$order = " order by itemid desc";
		break;
}
$letter = $_GET['letter'];
if($letter){
	$condition .= " and letter like '".$letter."%'";
	
}

	
	
	
if($typeid != 99) $condition .= " AND typeid=$typeid";	
if($fromtime) $condition .= " AND edittime>=$fromtime";
$pagesize = $MOD['pagesize'];
$offset = ($page-1)*$pagesize;
$items = $db->count($table, $condition, $CFG['db_expires']);
$itemsale=$items;
//$pages = pages($items, $page, $pagesize);
$pages = listpages($CAT, $items, $page, $pagesize);
$tags = array();
if($items) {
	$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE {$condition} $order LIMIT {$offset},{$pagesize}", ($CFG['db_expires'] && $page == 1) ? 'CACHE' : '', $CFG['db_expires']);
	while($r = $db->fetch_array($result)) {
		$r['adddate'] = timetodate($r['addtime'], 5);
		$r['editdate'] = timetodate($r['edittime'], 5);
			if($lazy && isset($r['thumb']) && $r['thumb']) $r['thumb'] = AJ_SKIN.'image/lazy.gif" original="'.$r['thumb'];
		$r['danjia']=floor($r['price']*10000/$r['houseearm']);
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
		
		$tags[] = $r;
	}
	$db->free_result($result);
}
$showpage = 1;
$datetype = 5;
//右边浏览过房源
if($_COOKIE['SRecentlyGoods']){
	$browseHouse = browsesale($_COOKIE['SRecentlyGoods']);
  
 }

$seo_file = 'list';
include AJ_ROOT.'/include/seo.inc.php';

$template = $CAT['template'] ? $CAT['template'] : ($MOD['template_list'] ? $MOD['template_list'] : 'list');
include template($template, $module);
?>