<?php
/*
	[aijiacms System] Copyright (c) 2008-2011 aijiacms.com
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
if($action == 'ftp') {
	require AJ_ROOT.'/include/ftp.class.php';
	if(strpos($ftp_pass, '***') !== false) $ftp_pass = $AJ['ftp_pass'];
	$ftp = new dftp($ftp_host, $ftp_user, $ftp_pass, $ftp_port, $ftp_path, $ftp_pasv, $ftp_ssl);
	if(!$ftp->connected) dialog('FTP�޷����ӣ���������');
	if(!$ftp->dftp_chdir()) dialog('FTP�޷�����Զ�̴洢Ŀ¼������Զ�̴洢Ŀ¼');
	dialog('FTP��������,����ʹ��');
} else if ($action == 'mail') {
	define('TESTMAIL', true);
	if(strpos($smtp_pass, '***') !== false) $smtp_pass = $AJ['smtp_pass'];
	$AJ['mail_type'] = $mail_type;
	$AJ['smtp_host'] = $smtp_host;
	$AJ['smtp_port'] = $smtp_port;
	$AJ['smtp_auth'] = $smtp_auth;
	$AJ['smtp_user'] = $smtp_user;
	$AJ['smtp_pass'] = $smtp_pass;
	$AJ['mail_sender'] = $mail_sender;
	$AJ['mail_name'] = $mail_name;
	$AJ['mail_delimiter'] = $mail_delimiter;
	$AJ['mail_sign'] = '<br/>------------------------------------<br><a href="http://www.AIJIACMS.com/" target="_blank">Send By AIJIACMS Mail Tester</a>';
	if(send_mail($testemail, $AJ['sitename'].'�ʼ����Ͳ���', '<b>��ϲ������վ��['.$AJ['sitename'].']�ʼ��������óɹ���</b>')) dialog('�ʼ��ѷ�����'.$testemail.'����ע�����', $mail_sender);
	dialog('�ʼ�����ʧ�ܣ���������');
} else {
	$tab = isset($tab) ? intval($tab) : 0;
	$all = isset($all) ? intval($all) : 0;
	if($submit) {
		if(!preg_match("/^[0-9a-z]{10,}$/i", $config['authkey'])) $config['authkey'] = random(18);
		$setting['safe_domain'] = str_replace(array('http://', 'www.'), array('', ''), $setting['safe_domain']);
		if(!preg_match("/^[a-z]{1}[0-9a-z]{2}_$/i", $config['cookie_pre'])) $config['cookie_pre'] = 'D'.random(2).'_';
		if(substr($config['url'], -1) != '/') $config['url'] = $config['url'].'/';
		if($config['cookie_domain'] && substr($config['cookie_domain'], 0, 1) != '.') $config['cookie_domain'] = '.'.$config['cookie_domain'];
		$setting['smtp_pass'] = pass_decode($setting['smtp_pass'], $AJ['smtp_pass']);
		$setting['ftp_pass'] = pass_decode($setting['ftp_pass'], $AJ['ftp_pass']);
		$setting['sms_key'] = pass_decode($setting['sms_key'], $AJ['sms_key']);
		$setting['trade_pw'] = pass_decode($setting['trade_pw'], $AJ['trade_pw']);
		$setting['admin_week'] = implode(',', $setting['admin_week']);
		$setting['check_week'] = implode(',', $setting['check_week']);		
		if($setting['logo'] != $AJ['logo']) clear_upload($setting['logo']);
		if(!is_writable(AJ_ROOT.'/config.inc.php')) msg('��Ŀ¼config.inc.php�޷�д�룬�����ÿ�дȨ��');
		$tmp = file_get(AJ_ROOT.'/config.inc.php');
		foreach($config as $k=>$v)	{
			$tmp = preg_replace("/[$]CFG\['$k'\]\s*\=\s*[\"'].*?[\"']/is", "\$CFG['$k'] = '$v'", $tmp);
		}
		file_put(AJ_ROOT.'/config.inc.php', $tmp);
		update_setting($moduleid, $setting);
		cache_module(1);
		cache_module();
		$filename = AJ_ROOT.'/'.$setting['index'].'.'.$setting['file_ext'];
		if(!$setting['index_html'] && $setting['file_ext'] != 'php') @unlink($filename);
		$mdir = AJ_ROOT.'/'.$MODULE[2]['moduledir'].'/';
		if($setting['file_register'] != $old_file_register) @rename($mdir.$old_file_register, $mdir.$setting['file_register']);
		if($setting['file_login'] != $old_file_login) @rename($mdir.$old_file_login, $mdir.$setting['file_login']);
		if($setting['file_my'] != $old_file_my) @rename($mdir.$old_file_my, $mdir.$setting['file_my']);
		dmsg('���³ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&tab='.$tab);
	} else {
		include AJ_ROOT.'/config.inc.php';
		extract(dhtmlspecialchars($CFG));
		extract(dhtmlspecialchars($AJ));
		$W = array('��', 'һ', '��', '��', '��', '��', '��');
		$smtp_pass = pass_encode($smtp_pass);
		$ftp_pass = pass_encode($ftp_pass);
		$sms_key = pass_encode($sms_key);
		$trade_pw = pass_encode($trade_pw);
		if($kw) {
			$all = 1;
			ob_start();
		}
		include tpl('setting', $module);
		if($kw) {
			$data = $content = ob_get_contents();
			ob_clean();
			$data = preg_replace('\'(?!((<.*?)|(<a.*?)|(<strong.*?)))('.$kw.')(?!(([^<>]*?)>)|([^>]*?</a>)|([^>]*?</strong>))\'si', '<span class=highlight>'.$kw.'</span>', $data);
			$data = preg_replace('/<span class=highlight>/', '<a name=high></a><span class=highlight>', $data, 1);
			echo $data ? $data : $content;
		}
	}
}
?>