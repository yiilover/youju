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

$condition = "status=3  and map<>''";

	
if($catid) $condition .= $CAT['child'] ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";	      
//$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";

if($AJ['city']){
$mainarea = get_mainarea($cityid);
}else{
$mainarea = get_mainarea(0);}
if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
//价目格范围
	if($p== 1){
			$condition.=' AND price<200';
		}
	if($p == 2){
			$condition.=" AND price>=200  AND price<500";}
	if($p == 3){
			$condition.=' AND price>=500 AND price<1000';
			
		}
	if($p== 4){
			$condition.=' AND price>=1000 AND price<1500';
		}
	if($p == 5){
			$condition.=' AND price>=1500 AND price<2000';
		}
	if($p == 6){
			$condition.=' AND price>=2000 AND price<3000';
		}
	if($p == 7){
			$condition.=' AND 3000<=price';
		}
			//面积范围
			 
	if($a== 1){
			$condition.=' AND houseearm<40';
		}
	if($a == 2){
			$condition.=" AND houseearm>40  AND houseearm<60";}
	if($a == 3){
			$condition.=' AND 60<=houseearm AND houseearm<80';
			
		}
	if($a== 4){
			$condition.=' AND 80<=houseearm AND houseearm<100';
		}
	if($a == 5){
			$condition.=' AND 100<=houseearm AND houseearm<120';
		}
	if($a == 6){
			$condition.=' AND 120<=houseearm AND houseearm<150';
		}
	if($a == 7){
			$condition.=' AND 150<=houseearm';
		}
		//户型范围
	if($r== 1){
			$condition.=' AND room=1';
		}
	if($r == 2){
			$condition.=" AND room=2";}
	if($r == 3){
			$condition.=' AND room=3';
			
		}
	if($r== 4){
			$condition.=' AND room=4';
		}
	if($r == 5){
			$condition.=' AND 5<=room ';
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

    $str='[';
	$result = $db->query("SELECT * FROM {$table} WHERE {$condition} ");
	while($r = $db->fetch_array($result)) {
		$arr=$r['map'];
		$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
	$map=explode(",",$arr);
		foreach($map as $key =>$value){
		  $x =$map['0'];
		   $y=$map['1']; 
		   }
		$a='{Project:"'.$r['title'].'",'.'ProjAdd:"'.$r['address'].'",'.'Tel:"'.$r['telephone'].'",'.'ProjPic:"'.$r['thumb'].'",'.'ProjID:"'.$r['itemid'].'",'.'ProjURL:"'.$r['linkurl'].'",'.'point:"'.$x.'|'.$y.'"                               },';
	 
		$str .=$a;
	}
	$len=strlen($str); 
	if($len==1){
	 $s=substr($str,0,$len); }
	 else
	{$s=substr($str,0,$len-1);}
	
	$s .=']';
	

$showpage = 1;
$datetype = 5;


$template = $CAT['template'] ? $CAT['template'] : 'map';
include template($template, $module);
?>