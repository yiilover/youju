<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
$itemid or dheader($MOD['linkurl']);
if(!check_group($_groupid, $MOD['group_show'])) include load('403.inc');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
if($item && $item['status'] > 2) {
	if($MOD['xiangce_html'] && is_file(AJ_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl'])) d301($MOD['linkurl'].$item['linkurl']);
	extract($item);
} else {
	include load('404.inc');
}


$CP = $MOD['cat_property'] && $CAT['property'];
if($CP) {
	require AJ_ROOT.'/include/property.func.php';
	$options = property_option($catid);
	$values = property_value($moduleid, $itemid);
}

	//Â¥ÅÌÍ¼Æ¬  
$a=$db->pre.'photo_12';
$pagesize =6;
$catid=$_GET['catid'];
$cat=get_cat($catid);
$r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}photo_12 WHERE houseid=$itemid");
$zong=$r['num'];
if($catid) $condition .= $cat['child'] ? " AND catid IN (".$cat['arrchildid'].")" : " AND catid=$catid";	  	
if(!$pagesize || $pagesize > 100) $pagesize = 30;
	$offset = ($page-1)*$pagesize;
	$r = $db->get_one("SELECT COUNT(*) AS num FROM $a   where houseid=$itemid {$condition}");
	$items = $r['num'];
	$pages = pages($r['num'], $page, $pagesize);
$tjw=$db->query("SELECT  *FROM $a  where houseid=$itemid  {$condition}
ORDER BY itemid DESC  LIMIT $offset,$pagesize");
 while($tjws=$db->fetch_array($tjw)){
  $tjws['title'] = $tjws['introduce'];
	$pic_lists[]=$tjws;
		 }
		
$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
$todate = $totime ? timetodate($totime, 3) : 0;
$expired = $totime && $totime < $AJ_TIME ? true : false;
$linkurl = $MOD['linkurl'].$linkurl;
$thumbs = get_albums($item);
$albums =  get_albums($item, 1);
$amount = number_format($amount, 0, '.', '');
$fee = get_fee($item['fee'], $MOD['fee_view']);

$update = '';
if(check_group($_groupid, $MOD['group_contact'])) {
	if($fee) {
		$user_status = 4;
		$AIJIACMS_task = "moduleid=$moduleid&html=show&itemid=$itemid";
	} else {
		$user_status = 3;
		$member = $item['username'] ? userinfo($item['username']) : array();
		if($item['totime'] && $item['totime'] < $AJ_TIME && $item['status'] == 3) {
			$update .= ",status=4";
			$db->query("UPDATE {$table}_search SET status=4 WHERE itemid=$itemid");
		}
		if($member) {
			foreach(array('groupid', 'vip','validated','company','truename','mobile','qq','msn','ali','skype') as $v) {
				if($item[$v] != $member[$v]) $update .= ",$v='".addslashes($member[$v])."'";
			}
			if($item['email'] != $member['mail']) $update .= ",email='$member[mail]'";
		}
	}
} else {
	$user_status = $_userid ? 1 : 0;
	if($_username && $item['username'] == $_username) {
		$member = userinfo($item['username']);
		$user_status = 3;
	}
}
//include AJ_ROOT.'/include/update.inc.php';
$seo_file = 'show';
include AJ_ROOT.'/include/seo.inc.php';
$template = $item['template'] ? $item['template'] : ($CAT['show_template'] ? $CAT['show_template'] : 'xiangce');
include template($template, $module);
?>