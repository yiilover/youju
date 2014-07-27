<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$typeid = isset($typeid) && isset($TYPE[$typeid]) ? intval($typeid) : 99;
if($day) $fromdate = timetodate($AJ_TIME-$day*86400, 'Ymd');
$fromdate = isset($fromdate) && preg_match("/^([0-9]{8})$/", $fromdate) ? $fromdate : '';
$fromtime = $fromdate ? strtotime($fromdate.' 0:0:0') : 0;
$todate = isset($todate) && preg_match("/^([0-9]{8})$/", $todate) ? $todate : '';
$totime = $todate ? strtotime($todate.' 23:59:59') : 0;
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
//��Ŀ��Χ
	if($p== 1){
			$condition.=' AND price<200';
			$price_option='200Ԫ����';
		}
	if($p == 2){
			$condition.=" AND price>=200  AND price<500";
			$price_option='200-500Ԫ';}
	if($p == 3){
			$condition.=' AND price>=500 AND price<1000';
			$price_option='500-1000Ԫ';
			
		}
	if($p== 4){
			$condition.=' AND price>=1000 AND price<1500';
			$price_option='1000-1500Ԫ';
		}
	if($p == 5){
			$condition.=' AND price>=1500 AND price<2000';
			$price_option='1500-2000Ԫ';
		}
	if($p == 6){
			$condition.=' AND price>=2000 AND price<3000';
			$price_option='2000-3000Ԫ';
		}
	if($p == 7){
			$condition.=' AND 3000<=price';
			$price_option='3000Ԫ����';
		}
				//�����Χ
	if($a== 1){
			$condition.=' AND houseearm<40';
			$houseearm_option='40ƽ������';
		}
	if($a == 2){
			$condition.=" AND houseearm>40  AND houseearm<60";
			$houseearm_option='40-60ƽ��';}
	if($a == 3){
			$condition.=' AND 60<=houseearm AND houseearm<80';
			$houseearm_option='60-80ƽ��';
			
		}
	if($a== 4){
			$condition.=' AND 80<=houseearm AND houseearm<100';
			$houseearm_option='80-100ƽ��';
		}
	if($a == 5){
			$condition.=' AND 100<=houseearm AND houseearm<120';
			$houseearm_option='100-120ƽ��';
		}
	if($a == 6){
			$condition.=' AND 120<=houseearm AND houseearm<150';
			$houseearm_option='120-150ƽ��';
		}
	if($a == 7){
			$condition.=' AND 150<=houseearm';
			$houseearm_option='150ƽ������';
		}
		//���ͷ�Χ
	if($r== 1){
			$condition.=' AND room=1';
			$room_option='һ��';
		}
	if($r == 2){
			$condition.=" AND room=2";
			$room_option='����';}
	if($r == 3){
			$condition.=' AND room=3';
			$room_option='����';
			
		}
	if($r== 4){
			$condition.=' AND room=4';
			$room_option='����';
		}
	if($r == 5){
			$condition.=' AND 5<=room ';
			$room_option='��������';
		}
   		//���䷶Χ
	if($y== 1){
			$condition.=' AND houseyear<2000';
			$year_option='2000����ǰ';
		}
	if($y == 2){
			$condition.=" AND houseyear>=2000";
			$year_option='2000���Ժ�';
		}
	if($y == 3){
			$condition.=' AND houseyear>=2005';
			$year_option='2005���Ժ�';
		}
	if($y== 4){
			$condition.=' AND houseyear>=2010';
			$year_option='2010���Ժ�';
		}
	
				//¥�㷶Χ
	if($f== 1){
			$condition.=' AND floor1<6';
			$floor_option='6������';
		}
	if($f == 2){
			$condition.=" AND floor1>=6  AND floor<12";
			$floor_option='6-12��';
		}
	if($f == 3){
			$condition.=' AND 12<=floor1 AND floor<20';
			$floor_option='12-20��';
		}
	if($f== 4){
			$condition.=' AND 20<=floor1 ';
			$floor_option='20������';
		}
   
	//list_order ����ת��
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
$pagesize = $MOD['pagesize'];
$offset = ($page-1)*$pagesize;
$items = $db->count($table, $condition, $CFG['db_expires']);
$itemsale=$items;
$pages = pages($items, $page, $pagesize);
$tags = array();
if($items) {
	$result = $db->query("SELECT ".$MOD['fields']." FROM {$table} WHERE {$condition} $order LIMIT {$offset},{$pagesize}", ($CFG['db_expires'] && $page == 1) ? 'CACHE' : '', $CFG['db_expires']);
	while($r = $db->fetch_array($result)) {
		$r['adddate'] = timetodate($r['addtime'], 5);
		$r['editdate'] = timetodate($r['edittime'], 5);
		$r['danjia']=floor($r['price']*10000/$r['houseearm']);
			if($lazy && isset($r['thumb']) && $r['thumb']) $r['thumb'] = AJ_SKIN.'image/lazy.gif" original="'.$r['thumb'];
		$r['alt'] = $r['title'];
		$r['title'] = set_style($r['title'], $r['style']);
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
		$tags[] = $r;
	}
	$db->free_result($result);
}
$showpage = 1;
$datetype = 24;
//�ұ��������Դ
if($_COOKIE['RRecentlyGoods']){
	$browseHouse = browseHouse($_COOKIE['RRecentlyGoods']);
  
 }


$seo_file = 'list';
include AJ_ROOT.'/include/seo.inc.php';


$template = $CAT['template'] ? $CAT['template'] : ($MOD['template_list'] ? $MOD['template_list'] : 'list');
include template($template, $module);
?>