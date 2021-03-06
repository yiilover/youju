<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
$itemid or dheader($MOD['linkurl']);
if(!check_group($_groupid, $MOD['group_show'])) include load('403.inc');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
if($item && $item['status'] > 2) {
	if($MOD['zixun_html'] && is_file(AJ_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl'])) d301($MOD['linkurl'].$item['linkurl']);
	extract($item);
} else {
	include load('404.inc');
}
$CAT = get_cat($catid);
if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
$t = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
$content = $t['content'];
if($MOD['keylink']) $content = keylink($content, $moduleid);

$CP = $MOD['cat_property'] && $CAT['property'];
if($CP) {
	require AJ_ROOT.'/include/property.func.php';
	$options = property_option($catid);
	$values = property_value($moduleid, $itemid);
}

//同价位楼盘  10条记录
$area=$db->pre.'area';

$h = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
$price = $h['price'];
	$tjw =$db->query("SELECT itemid,title,price,areaid,linkurl FROM  {$table} WHERE price!=0 AND price between $h[price]-500 and $h[price]+500  and $itemid != itemid and isnew=1 ORDER BY itemid DESC LIMIT 0,10");
	while($tjws=$db->fetch_array($tjw)){
		$quyu = $tjws['areaid'];
		
		 $qynames = $db->query("SELECT areaname FROM $area WHERE areaid=$quyu");
		 $qyname = $db->fetch_array($qynames);
		 $diqu=$qyname['areaname'];
		 $tjws[quyu]=$diqu;
		 
		$same_price_list[]=$tjws;
	}
	//同区域楼盘  10条记录

	$tqy =$db->query("SELECT itemid,title,price,areaid,linkurl FROM  {$table} WHERE  $areaid=areaid and $itemid != itemid and isnew=1 ORDER BY itemid DESC LIMIT 0,10");
	while($tqys=$db->fetch_array($tqy)){
	
		 
		$same_quyu_list[]=$tqys;
	}

	//资讯  10条记录
$article=$db->pre.'article_8';
  $pagesize =10;
	if(!$pagesize || $pagesize > 100) $pagesize = 30;
	$offset = ($page-1)*$pagesize;
	$r = $db->get_one("SELECT COUNT(*) AS num FROM $article   WHERE  houseid = $itemid");
	$items = $r['num'];
	$pages = pages($r['num'], $page, $pagesize);


	$tjw =$db->query("SELECT * FROM  $article WHERE houseid=$itemid ORDER BY itemid DESC LIMIT $offset,$pagesize");
	
	while($tjws=$db->fetch_array($tjw)){
	$quyu = $tjws['houseid'];
		
		 $qynames = $db->query("SELECT * FROM {$table} WHERE itemid=$quyu");
		 $qyname = $db->fetch_array($qynames);
		 $diqu=$qyname['title'];
		 $tjws[quyu]=$diqu;
	
		$new_lists[]=$tjws;	
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
		$aijiacms_task = "moduleid=$moduleid&html=show&itemid=$itemid";
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
$template = $item['template'] ? $item['template'] : ($CAT['show_template'] ? $CAT['show_template'] : 'zixun');
include template($template, $module);
?>