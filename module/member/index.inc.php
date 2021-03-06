<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
if(!$_userid) dheader($MODULE[2]['linkurl'].$AJ['file_my']);
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
if($action == 'logout' && $admin_user) {
	set_cookie('admin_user', '');
	dmsg($L['index_msg_logout'], $MODULE[2]['linkurl']);
}
require MD_ROOT.'/member.class.php';
require AJ_ROOT.'/include/post.func.php';
$do = new member;
if($submit) {
	if(word_count($note) > 1000) message($L['index_msg_note_limit']);
	$note = '<?php exit;?>'.stripslashes($note);
	file_put(AJ_ROOT.'/file/user/'.dalloc($_userid).'/'.$_userid.'/note.php', $note);
	dmsg($L['op_update_success'], $MODULE[2]['linkurl']);
} else {
	$head_title = '';
	$do->userid = $_userid;
	$user = $do->get_one();
	extract($user);
	$logintime = timetodate($logintime, 5);
	$regtime = timetodate($regtime, 5);
	$userurl = userurl($_username, '', $domain);	
	$sys = array();
	$i = 0;
	$result = $db->query("SELECT itemid,title,addtime,groupids FROM {$AJ_PRE}message WHERE groupids<>'' ORDER BY itemid DESC", 'CACHE');
	while($r = $db->fetch_array($result)) {
		$groupids = explode(',', $r['groupids']);
		if(!in_array($_groupid, $groupids)) continue;
		if($i > 2) continue;
		$i++;
		$sys[] = $r;
	}
	$note = AJ_ROOT.'/file/user/'.dalloc($_userid).'/'.$_userid.'/note.php';
	$note = file_get($note);
	if($note) {
		$note = substr($note, 13);
	} else {
		$note = $MOD['usernote'];
	}
	$trade = $db->count("{$AJ_PRE}mall_order", "seller='$_username' AND status=0");
	$expired = $totime && $totime < $AJ_TIME ? true : false;
	$havedays = $expired ? 0 : ceil(($totime-$AJ_TIME)/86400);
	include template('index', $module);
}
?>