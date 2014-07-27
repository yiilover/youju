<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$AJ_LICENSE = md5(file_get(AJ_ROOT.'/license.txt'));
#exit($AJ_LICENSE);
if(!empty($_SERVER['REQUEST_URI'])) strip_uri($_SERVER['REQUEST_URI']);
if(!$forward) $forward = '?';
if($_aijiacms_admin && $_userid && $_aijiacms_admin == $_userid) dheader($forward);
if($AJ['admin_area']) {
	$AA = explode("|", trim($AJ['admin_area']));
	$A = ip2area($AJ_IP);
	$pass = false;
	foreach($AA as $v) {
		if(strpos($A, $v) !== false) { $pass = true; break; }
	}
	if(!$pass) dalert('δ������ĵ���', $MODULE[2]['linkurl'].'logout.php?forward='.urlencode(AJ_PATH));
}
if($AJ['admin_ip']) {
	$IP = explode("|", trim($AJ['admin_ip']));
	$pass = false;
	foreach($IP as $v) {
		if($v == $AJ_IP) { $pass = true; break; }
		if(preg_match("/^".str_replace('*', '[0-9]{1,3}', $v)."$/", $AJ_IP)) { $pass = true; break; }
	}
	if(!$pass) dalert('δ�������IP��', $MODULE[2]['linkurl'].'logout.php?forward='.urlencode(AJ_PATH));
}
if($AJ['close']) $AJ['captcha_admin'] = 0;
if($submit) {
	captcha($captcha, $AJ['captcha_admin']);
	if(!$username) msg('�������û���');
	if(!$password) msg('����������');
	include load('member.lang');
	$MOD = cache_read('module-2.php');
	require AJ_ROOT.'/include/module.func.php';
	require AJ_ROOT.'/module/member/member.class.php';
	$do = new member;
	$user = $do->login($username, $password);
	if($user) {
		if($user['groupid'] != 1 || $user['admin'] < 1) msg('����Ȩ�޷��ʺ�̨', $MODULE[2]['linkurl'].'logout.php?forward='.urlencode(AJ_PATH));
		if($user['userid'] != $CFG['founderid']) {
			if(($AJ['admin_week'] && !check_period($AJ['admin_week'])) || ($AJ['admin_hour'] && !check_period($AJ['admin_hour']))) {
				set_cookie('auth', '');
				dalert('δ������Ĺ���ʱ��', $MODULE[2]['linkurl'].'logout.php?forward='.urlencode(AJ_PATH));
			}
		}
		if($CFG['authadmin'] == 'cookie') {
			set_cookie($secretkey, $user['userid']);
		} else {
			$_SESSION[$secretkey] = $user['userid'];
		}
		require AJ_ROOT.'/admin/admin.class.php';
		$admin = new admin;
		$admin->cache_right($user['userid']);
		$admin->cache_menu($user['userid']);
		if($AJ['login_log']) $do->login_log($username, $password, 1);
		dheader($forward);
	} else {
		if($AJ['login_log']) $do->login_log($username, $password, 1, $do->errmsg);
		msg($do->errmsg);
	}
} else {
	if(strpos($AJ_URL, AJ_PATH) === false) dheader(AJ_PATH.basename(get_env('self'), 1));
	$username = isset($username) ? $username : $_username;
	include tpl('login');
}
?>