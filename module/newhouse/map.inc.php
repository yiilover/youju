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

	
if($catid) $condition .= $CAT['child'] ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";	      
//$condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";

if($AJ['city']){
$mainarea = get_mainarea($cityid);
}else{
$mainarea = get_mainarea(0);}
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