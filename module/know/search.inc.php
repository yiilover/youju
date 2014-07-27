<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
if(!check_group($_groupid, $MOD['group_search'])) {
	$head_title = lang('message->without_permission');
	include template('noright', 'message');
	exit;
}
require AJ_ROOT.'/include/post.func.php';
include load('search.lang');
$CP = $MOD['cat_property'] && $catid && $CAT['property'];
if(!$areaid && $cityid && strpos($AJ_URL, 'areaid') === false) {
	$areaid = $cityid;
	$ARE = $AREA[$cityid];
}
$typeid = isset($typeid) ? intval($typeid) : 99;
$sfields = array($L['by_auto'], $L['by_title'], $L['by_content'], $L['by_introduce']);
$dfields = array('keyword', 'title', 'content', 'introduce');
$sorder  = array($L['order'], $L['order_auto'], $L['order_reward'], $L['order_answer'], $L['order_hits']);
$dorder  = array($MOD['order'], '', 'credit DESC', 'answer DESC', 'hits DESC');
if(!$MOD['fulltext']) unset($sfields[2], $dfields[2]);
isset($fields) && isset($dfields[$fields]) or $fields = 0;
isset($order) && isset($dorder[$order]) or $order = 0;
$order_select  = dselect($sorder, 'order', '', $order);
$category_select = category_select('catid', $L['all_category'], $catid, $moduleid);
$area_select = $AJ['city'] ? ajax_area_select('areaid', $L['all_area'], $areaid) : '';
$tags = array();
if($AJ_QST) {
	if($kw) {
		if(strlen($kw) < $AJ['min_kw'] || strlen($kw) > $AJ['max_kw']) message(lang($L['word_limit'], array($AJ['min_kw'], $AJ['max_kw'])), $MOD['linkurl'].'search.php');
		if($AJ['search_limit'] && $page == 1) {
			if(($AJ_TIME - $AJ['search_limit']) < get_cookie('last_search')) message(lang($L['time_limit'], array($AJ['search_limit'])), $MOD['linkurl'].'search.php');
			set_cookie('last_search', $AJ_TIME);
		}
	}

	$pptsql = '';
	if($CP) {
		require AJ_ROOT.'/include/property.func.php';
		$PPT = property_condition($catid);
		foreach($PPT as $k=>$v) {
			$PPT[$k]['select'] = '';
			$oid = $v['oid'];
			$tmp = 'ppt_'.$oid;
			if(isset($$tmp)) {
				$PPT[$k]['select'] = $tmp = $$tmp;
				if($tmp && in_array($tmp, $v['options'])) {
					$tmp = 'O'.$oid.':'.$tmp.';';
					$pptsql .= " AND pptword LIKE '%$tmp%'";
				}
			}
		}
	}
	$fds = $MOD['fields'];
	$condition = '';
	if($catid) $condition .= ($CAT['child']) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	if($typeid == 0) {
		$condition .= " AND process=3";
	} else if($typeid == 1) {
		$condition .= " AND process=1";
	} else if($typeid == 2) {
		$condition .= " AND process=2";
	} else if($typeid == 3) {
		$condition .= " AND process=1 AND answer=0";
	} else if($typeid == 4) {
		$condition .= " AND level>0";
	} else if($typeid == 5) {
		$hc = intval($MOD['highcredit']);
		if($hc > 0) $condition .= " AND process=1 AND credit>$hc";
	}
	if($dfields[$fields] == 'content') {
		if($keyword && $MOD['fulltext'] == 1) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		$condition = str_replace('AND ', 'AND i.', $condition);
		$condition = str_replace('i.content', 'd.content', $condition);
		$condition = "i.status=3 AND i.itemid=d.itemid".$condition;
		if($keyword && $MOD['fulltext'] == 2) $condition .= " AND MATCH(`content`) AGAINST('$kw'".(preg_match("/[+-<>()~*]/", $kw) ? ' IN BOOLEAN MODE' : '').")";
		$table = $table.' i,'.$table_data.' d';
		$fds = 'i.'.str_replace(',', ',i.', $fds);
	} else {
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($pptsql) $condition .= $pptsql;//PPT
		$condition = "status=3".$condition;
	}
	$pagesize = $MOD['pagesize'];
	$offset = ($page-1)*$pagesize;
	$items = $db->count($table, $condition, $AJ['cache_search']);
	$pages = pages($items, $page, $pagesize);
	if($items) {
		$order = $dorder[$order] ? " ORDER BY $dorder[$order]" : '';
		$result = $db->query("SELECT $fds FROM {$table} WHERE {$condition}{$order} LIMIT {$offset},{$pagesize}", $AJ['cache_search'] && $page == 1 ? 'CACHE' : '', $AJ['cache_search']);
		if($kw) {
			$replacef = explode(' ', $kw);
			$replacet = array_map('highlight', $replacef);
		}
		while($r = $db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['alt'] = $r['title'];
			$r['title'] = set_style($r['title'], $r['style']);
			if($kw) $r['title'] = str_replace($replacef, $replacet, $r['title']);
			$r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
			$tags[] = $r;
		}
		$db->free_result($result);
		if($page == 1 && $kw) keyword($kw, $items, $moduleid);
	}
}
$showpage = 1;
$datetype = 5;
$target = '_blank';
$cols = 5;
$class = '';
$seo_file = 'search';
include AJ_ROOT.'/include/seo.inc.php';
include template('search', $module);
?>