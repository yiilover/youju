<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
if($html == 'show') {
	$itemid or exit;
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
	if(!$item || $item['status'] < 3) exit;
	extract($item);
	$fee = get_fee($item['fee'], $MOD['fee_view']);
	$currency = $MOD['fee_currency'];
	$unit = $currency == 'money' ? $AJ['money_unit'] : $AJ['credit_unit'];
	$name = $currency == 'money' ? $AJ['money_name'] : $AJ['credit_name'];
	$inner = false;
	if(check_group($_groupid, $MOD['group_show'])) {
		if($fee) {
			$inner = true;
			if($MG['fee_mode'] && $MOD['fee_mode']) {
				$user_status = 3;
			} else {
				$mid = $moduleid;
				if($_userid) {
					if(check_pay($mid, $itemid)) {
						$user_status = 3;
					} else {
						$user_status = 2;						
						$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
						$pay_url = linkurl($MODULE[2]['linkurl'], 1).'pay.php?mid='.$mid.'&itemid='.$itemid.'&fee='.$fee.'&currency='.$currency.'&sign='.crypt_sign($_username.$mid.$itemid.$fee.$currency.$linkurl.$item['title']).'&title='.rawurlencode($item['title']).'&forward='.urlencode($linkurl);
					}
				} else {
					$user_status = 0;
				}
			}
		} else {
			$user_status = 3;
		}
	} else {
		$inner = true;
		$user_status = $_userid ? 1 : 0;
	}	
	if($_username && $_username == $item['username']) $user_status = 3;
	if($inner) {
		if($user_status == 3 || $user_status == 2) {
			$best = $aid ? $db->get_one("SELECT * FROM {$AJ_PRE}know_answer WHERE itemid=$aid") : array();
			if($user_status == 2 && $best) $description = get_description($best['content'], $MOD['pre_view']);
		}
		$content = strip_nr(ob_template('content', 'chip'), true);
		echo 'Inner("content", \''.$content.'\');';
	}
	$update = '';
	include AJ_ROOT.'/include/update.inc.php';
	echo 'Inner("hits", \''.$item['hits'].'\');';
	if($MOD['show_html'] && $task_item && $AJ_TIME - @filemtime(AJ_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl']) > $task_item) tohtml('show', $module);
} else if($html == 'list') {
	$catid or exit;
	if($MOD['list_html'] && $task_list && $CAT) {
		$num = 1;
		$totalpage = max(ceil($CAT['item']/$MOD['pagesize']), 1);
		$demo = AJ_ROOT.'/'.$MOD['moduledir'].'/'.listurl($CAT, '{DEMO}');
		$fid = $page;
		if($fid >= 1 && $fid <= $totalpage && $AJ_TIME - @filemtime(str_replace('{DEMO}', $fid, $demo)) > $task_list) tohtml('list', $module);
		$fid = $page + 1;
		if($fid >= 1 && $fid <= $totalpage && $AJ_TIME - @filemtime(str_replace('{DEMO}', $fid, $demo)) > $task_list) tohtml('list', $module);
		$fid = $totalpage + 1 - $page;
		if($fid >= 1 && $fid <= $totalpage && $AJ_TIME - @filemtime(str_replace('{DEMO}', $fid, $demo)) > $task_list) tohtml('list', $module);
	}
} else if($html == 'index') {
	if($AJ['cache_hits'] && $AJ_TIME - @filemtime(AJ_CACHE.'/hits-'.$moduleid.'.dat') > $AJ['cache_hits']) update_hits($moduleid, $table);
	if($MOD['index_html']) {
		$file = AJ_ROOT.'/'.$MOD['moduledir'].'/'.$AJ['index'].'.'.$AJ['file_ext'];
		if($AJ_TIME - @filemtime($file) > $task_index) tohtml('index', $module);
	}
}
?>