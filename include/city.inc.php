<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$AREA = cache_read('area.php');
$c = array();
$city = get_cookie('city');
if($city) {
	list($cityid, $city_domain) = explode('|', $city);
	if(strpos(AJ_PATH, $_SERVER['HTTP_HOST']) === false && strpos($city_domain, $_SERVER['HTTP_HOST']) === false) {
		$c = $db->get_one("SELECT * FROM {$AJ_PRE}city WHERE domain='http://".$_SERVER['HTTP_HOST']."/'");
		if($c) {
			set_cookie('city', $c['areaid'].'|'.$c['domain'], $AJ_TIME + 365*86400);
			$cityid = $c['areaid'];
		}
	}
	#if($city_domain && !defined('AJ_ADMIN') && strpos($AJ_URL, AJ_PATH) !== false) dheader(str_replace(AJ_PATH, $city_domain, $AJ_URL));
} else {
	if(strpos(AJ_PATH, $_SERVER['HTTP_HOST']) === false) {
		$c = $db->get_one("SELECT * FROM {$AJ_PRE}city WHERE domain='http://".$_SERVER['HTTP_HOST']."/'");
		if($c) {
			set_cookie('city', $c['areaid'].'|'.$c['domain'], $AJ_TIME + 365*86400);
			$cityid = $c['areaid'];
		}
	} else {
		if($AJ['city_ip'] && !defined('AJ_ADMIN') && !$AJ_BOT) {
			$iparea = ip2area($AJ_IP);
			$result = $db->query("SELECT * FROM {$AJ_PRE}city");
			while($r = $db->fetch_array($result)) {
				if(preg_match("/".$r['name'].($r['iparea'] ? '|'.$r['iparea'] : '')."/i", $iparea)) {
					set_cookie('city', $r['areaid'].'|'.$r['domain'], $AJ_TIME + 365*86400);
					$cityid = $r['areaid'];
					if($r['domain']) dheader($r['domain']);
					$c = $r;
					break;
				}
			}
		}
	}
}
if($cityid) {
	$c or $c = $db->get_one("SELECT * FROM {$AJ_PRE}city WHERE areaid=$cityid");
	if(!defined('AJ_ADMIN')) {
		if($c['seo_title']) {		
			$AJ['seo_title'] = $city_sitename = $c['seo_title'];
		} else {
			$citysite = lang($L['citysite'], array($c['name']));
			$AJ['seo_title'] = $citysite.$AJ['seo_delimiter'].$AJ['seo_title'];
			$city_sitename = $citysite.$AJ['seo_delimiter'].$AJ['sitename'];
		}
		if($c['seo_keywords']) $AJ['seo_keywords'] = $c['seo_keywords'];
		if($c['seo_description']) $AJ['seo_description'] = $c['seo_description'];
	}
	$map_mid = $c['map_mid'];
	$city_name = $c['name'];
	$city_domain = $c['domain'];
	$city_template = $c['template'];
}
//Ĭ�ϳ���

	$c or $c = $db->get_one("SELECT * FROM {$AJ_PRE}city WHERE hits=1");
	if(!defined('AJ_ADMIN')) {
		if($c['seo_title']) {		
			$AJ['seo_title'] = $city_sitename = $c['seo_title'];
		} else {
			$citysite = lang($L['citysite'], array($c['name']));
			$AJ['seo_title'] = $citysite.$AJ['seo_delimiter'].$AJ['seo_title'];
			//$AJ['sitename'] = $citysite.$AJ['seo_delimiter'].$AJ['sitename'];
			$city_sitename = $citysite.$AJ['seo_delimiter'].$AJ['sitename'];
		}
		if($c['seo_keywords']) $AJ['seo_keywords'] = $c['seo_keywords'];
		if($c['seo_description']) $AJ['seo_description'] = $c['seo_description'];
	}
	$city_namem = $c['name'];
	$cityid = $c['areaid'];
	$map_mid = $c['map_mid'];
	$city_domain = $c['domain'];
	$city_template = $c['template'];

if($city_domain) {
	foreach($MODULE as $k=>$v) {
		if($v['islink']) continue;
		$MODULE[$k]['linkurl'] = $k == 1 ? $city_domain : $city_domain.$v['moduledir'].'/';
	}
	$MOD['linkurl'] = $MODULE[$moduleid]['linkurl'];
	foreach($EXT as $k=>$v) {
		if(strpos($k, '_url') !== false) {
			$EXT[$k] = $city_domain.str_replace('_url', '', $k).'/';
		}
	}
}
?>