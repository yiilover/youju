<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$houseid=$_GET['houseid'];
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$houseid");
$p=$_GET['p'];
$items = $db->get_one("SELECT * FROM {$db->pre}photo_12 WHERE houseid=$houseid and itemid=$p");
$nowtime=$items['addtime'];
if($item && $item['status'] > 2) {
	if($MOD['tupian_html'] && is_file(AJ_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl'])) d301($MOD['linkurl'].$item['linkurl']);
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

$next_photo =get_photo('status=3 and houseid='.$houseid.' and addtime>'.$nowtime);
if($next_photo)$next_photo=$MODULE[6][linkurl].'tupian.php?houseid='.$houseid.'&p='.$next_photo['itemid'];
$prev_photo =get_photo('status=3 and houseid='.$houseid.' and addtime<'.$nowtime);
if($prev_photo)$prev_photo=$MODULE[6][linkurl].'tupian.php?houseid='.$houseid.'&p='.$prev_photo['itemid'];
$P['src']=$items['thumb'];
$P['adddate'] = timetodate($items['addtime'], 3);
$r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}photo_12 WHERE houseid=$houseid");
$zong=$r['num'];



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
$seo_file = 'show';
include AJ_ROOT.'/include/seo.inc.php';
$template = $item['template'] ? $item['template'] : ($CAT['show_template'] ? $CAT['show_template'] : 'tupian');
include template($template, $module);
?>