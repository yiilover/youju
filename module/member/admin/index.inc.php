<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/member.class.php';
$do = new member;
$menus = array (
    array('��ӻ�Ա', '?moduleid='.$moduleid.'&action=add'),
    array('��Ա�б�', '?moduleid='.$moduleid),
    array('��˻�Ա', '?moduleid='.$moduleid.'&action=check'),
    array('��Ա����', '?moduleid='.$moduleid.'&file=grade&action=check'),
    array('��ϵ��Ա', '?moduleid='.$moduleid.'&file=contact'),
    array('��˾�б�', '?moduleid=4'),
    array(VIP.'�б�', '?moduleid=4&file=vip'),
);
isset($userid) or $userid = 0;
if(in_array($action, array('add', 'edit'))) {
	$MFD = cache_read('fields-member.php');
	$CFD = cache_read('fields-company.php');
	isset($post_fields) or $post_fields = array();
	if($MFD || $CFD) require AJ_ROOT.'/include/fields.func.php';
}

if($_catids || $_areaids) {
	if(isset($userid)) $itemid = $userid;
	if(isset($member['areaid'])) $post['areaid'] = $member['areaid'];
	require AJ_ROOT.'/admin/admin_check.inc.php';
}

if(in_array($action, array('', 'check'))) {
	$sfields = array('������', '��˾��', '��Ա��', 'ͨ��֤��','����', '�ֻ�����', '����', 'ְλ', 'Email', 'QQ', 'MSN', '��������', 'Skype', 'ע��IP', '��¼IP', '�ͷ�רԱ', '��������', '�����ʺ�', $AJ['trade_nm'], '�Ƽ���');
	$dfields = array('username', 'company', 'username', 'passport', 'truename', 'mobile', 'department', 'career', 'email', 'qq', 'msn', 'ali', 'skype', 'regip', 'loginip', 'support', 'bank', 'account', 'trade', 'inviter');
	$sorder  = array('�������ʽ', 'ע��ʱ�併��', 'ע��ʱ������', '��¼ʱ�併��', '��¼ʱ������', '��¼��������', '��¼��������', '�˻�'.$AJ['money_name'].'����', '�˻�'.$AJ['money_name'].'����', '��Ա'.$AJ['credit_name'].'����', '��Ա'.$AJ['credit_name'].'����', '��������', '�����������');
	$dorder  = array('userid DESC', 'regtime DESC', 'regtime ASC', 'logintime DESC', 'logintime ASC', 'logintimes DESC', 'logintimes ASC', 'money DESC', 'money ASC', 'credit DESC', 'credit ASC', 'sms DESC', 'sms ASC');
	$sgender = array('�Ա�', '����' , 'Ůʿ');
	$savatar = array('ͷ��', '���ϴ�' , 'δ�ϴ�');
	$sprofile = array('����', '������' , 'δ����');
	$semail = array('�ʼ�', '����֤' , 'δ��֤');
	$smobile = array('�ֻ�', '����֤' , 'δ��֤');
	$struename = array('ʵ��', '����֤' , 'δ��֤');
	$sbank = array('����', '����֤' , 'δ��֤');
	$scompany = array('��˾', '����֤' , 'δ��֤');
	$strade = array($AJ['trade_nm'], '����֤' , 'δ��֤');

	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($order) && isset($dorder[$order]) or $order = 0;
	$groupid = isset($groupid) ? intval($groupid) : 0;
	$gender = isset($gender) ? intval($gender) : 0;
	$avatar = isset($avatar) ? intval($avatar) : 0;
	$uid = isset($uid) ? intval($uid) : '';
	$username = isset($username) ? trim($username) : '';
	$vprofile = isset($vprofile) ? intval($vprofile) : 0;
	$vemail = isset($vemail) ? intval($vemail) : 0;
	$vmobile = isset($vmobile) ? intval($vmobile) : 0;
	$vtruename = isset($vtruename) ? intval($vtruename) : 0;
	$vbank = isset($vbank) ? intval($vbank) : 0;
	$vcompany = isset($vcompany) ? intval($vcompany) : 0;
	$vtrade = isset($vtrade) ? intval($vtrade) : 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	isset($timetype) or $timetype = 'regtime';
	$minmoney = isset($minmoney) ? intval($minmoney) : '';
	$maxmoney = isset($maxmoney) ? intval($maxmoney) : '';
	$mincredit = isset($mincredit) ? intval($mincredit) : '';
	$maxcredit = isset($maxcredit) ? intval($maxcredit) : '';
	$minsms = isset($minsms) ? intval($minsms) : '';
	$maxsms = isset($maxsms) ? intval($maxsms) : '';

	$fields_select = dselect($sfields, 'fields', '', $fields);
	$order_select  = dselect($sorder, 'order', '', $order);
	$gender_select = dselect($sgender, 'gender', '', $gender);
	$avatar_select = dselect($savatar, 'avatar', '', $avatar);
	$group_select = group_select('groupid', '��Ա��', $groupid);
	$vprofile_select = dselect($sprofile, 'vprofile', '', $vprofile);
	$vemail_select = dselect($semail, 'vemail', '', $vemail);
	$vmobile_select = dselect($smobile, 'vmobile', '', $vmobile);
	$vtruename_select = dselect($struename, 'vtruename', '', $vtruename);
	$vbank_select = dselect($sbank, 'vbank', '', $vbank);
	$vcompany_select = dselect($scompany, 'vcompany', '', $vcompany);
	$vtrade_select = dselect($strade, 'vtrade', '', $vtrade);

	$condition = $action ? 'groupid=4' : 'groupid!=4';//
	if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($gender) $condition .= " AND gender=$gender";
	if($avatar) $condition .= $avatar == 1 ? " AND avatar=1" : " AND avatar=0";
	if($groupid) $condition .= " AND groupid=$groupid";
	if($uid) $condition .= " AND userid=$uid";
	if($username) $condition .= " AND username='$username'";
	if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	if($vprofile) $condition .= $vprofile == 1 ? " AND edittime>0" : " AND edittime=0";
	if($vemail) $condition .= $vemail == 1 ? " AND vemail>0" : " AND vemail=0";
	if($vmobile) $condition .= $vmobile == 1 ? " AND vmobile>0" : " AND vmobile=0";
	if($vtruename) $condition .= $vtruename == 1 ? " AND vtruename>0" : " AND vtruename=0";
	if($vbank) $condition .= $vbank == 1 ? " AND vbank>0" : " AND vbank=0";
	if($vcompany) $condition .= $vcompany == 1 ? " AND vcompany>0" : " AND vcompany=0";
	if($vtrade) $condition .= $vtrade == 1 ? " AND vtrade>0" : " AND vtrade=0";
	if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
	if($minmoney) $condition .= " AND money>=$minmoney";
	if($maxmoney) $condition .= " AND money<=$maxmoney";
	if($mincredit) $condition .= " AND credit>=$mincredit";
	if($maxcredit) $condition .= " AND credit<=$maxcredit";
	if($minsms) $condition .= " AND sms>=$minsms";
	if($maxsms) $condition .= " AND sms<=$maxsms";
}
if(in_array($action, array('add', 'edit'))) {
	$COM_TYPE = explode('|', $MOD['com_type']);
	$COM_SIZE = explode('|', $MOD['com_size']);
	$COM_MODE = explode('|', $MOD['com_mode']);
	$MONEY_UNIT = explode('|', $MOD['money_unit']);
	$BANKS = explode('|', trim($MOD['cash_banks']));
}
switch($action) {
	case 'add':
		if($submit) {
			$member['groupid'] = $member['regid'];
			if($member['groupid'] == 5) $member['company'] = $member['truename'];
			$member['passport'] = $member['passport'] ? $member['passport'] : $member['username'];
			$member['edittime'] = $member['edittime'] ? $AJ_TIME : 0;
			$member['inviter'] = $member['username'];
			if($MFD) fields_check($post_fields, $MFD);
			if($CFD) fields_check($post_fields, $CFD);
			if($do->add($member)) {
				if($MFD) fields_update($post_fields, $do->table_member, $do->userid, 'userid', $MFD);
				if($CFD) fields_update($post_fields, $do->table_company, $do->userid, 'userid', $CFD);
				if($MOD['welcome_sms'] && $AJ['sms'] && is_mobile($member['mobile'])) {
					$message = lang('sms->wel_reg', array($member['truename'], $AJ['sitename'], $member['username'], $member['password']));
					$message = strip_sms($message);
					send_sms($member['mobile'], $message);
				}
				if($MOD['welcome_message'] || $MOD['welcome_email']) {
					$post = $member;
					$username = $member['username'];
					$email = $member['email'];
					$title = $L['register_msg_welcome'];
					$content = ob_template('welcome', 'mail');
					if($MOD['welcome_message']) send_message($username, $title, $content);
					if($MOD['welcome_email'] && $AJ['mail_type'] != 'close') send_mail($email, $title, $content);
				}
				dmsg('��ӳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			include tpl('member_add', $module);
		}
	break;
	case 'edit':
		$userid or msg();
		$do->userid = $userid;
		$user = $do->get_one();
		if(!$_founder && $userid != $_userid && $user['groupid'] == 1) msg('����Ȩ�޸���������Ա����');
		if($submit) {
			if($userid == $_userid && $member['password']) msg('ϵͳ��鵽��Ҫ�޸����룬���ڽ��������޸Ľ���...', '?action=password', 3);
			$member['edittime'] = $member['edittime'] ? $AJ_TIME : 0;
			$member['validtime'] = $member['validtime'] ? strtotime($member['validtime']) : 0;
			if($userid == 1 || $userid == $CFG['founderid']) $member['groupid'] = 1;
			if($MFD) fields_check($post_fields, $MFD);
			if($CFD) fields_check($post_fields, $CFD);
			$status = 0;
			if($gid != $member['groupid']) {
				$groupid = $member['groupid'];
				if($groupid == 1) {
					$status = 1;
					$member['groupid'] = $gid;
				} else if($GROUP[$groupid]['vip']) {
					$status = 2;
					$member['groupid'] = $gid;
				}
			}
			if($do->edit($member)) {
				if($MFD) fields_update($post_fields, $do->table_member, $do->userid, 'userid', $MFD);
				if($CFD) fields_update($post_fields, $do->table_company, $do->userid, 'userid', $CFD);
				if($status == 1) msg('��Ա�����޸ĳɹ��������Ҫ��ӹ���Ա����������Ա����...', '?file=admin&action=add&username='.$username, 5);
				if($status == 2) msg('��Ա�����޸ĳɹ��������Ҫ���'.VIP.'��Ա�������'.VIP.'����...', '?moduleid=4&file=vip&action=add&username='.$username, 5);
				dmsg('��Ա�����޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($user);
			$content_table = content_table(4, $userid, is_file(AJ_CACHE.'/4.part'), $AJ_PRE.'company_data');
			$t = $db->get_one("SELECT * FROM {$content_table} WHERE userid=$userid");
			if($t) {
				$introduce = $t['content'];
			} else {
				$introduce = '';
				$db->query("INSERT INTO {$content_table} (userid,content) VALUES ('$userid','')");
			}
			$cates = $catid ? explode(',', substr($catid, 1, -1)) : array();
			$validtime = $validtime ? timetodate($validtime, 3) : '';
			include tpl('member_edit', $module);
		}
	break;
	case 'show':
		if(isset($mobile)) {
			$r = $db->get_one("SELECT username FROM {$table} WHERE mobile='$mobile'");
			if($r) $username = $r['username'];
		}
		if(isset($email)) {
			$r = $db->get_one("SELECT username FROM {$table} WHERE email='$email'");
			if($r) $username = $r['username'];
		}
		$username = isset($username) ? $username : '';
		($userid || $username) or msg('��Ա������');
		if($userid) $do->userid = $userid;
		$user = $do->get_one($username);
		$user or msg('��Ա������');
		if(!$_founder && $userid != $_userid && $user['groupid'] == 1) msg('����Ȩ�鿴��������Ա����');
		extract($user);
		include tpl('member_show', $module);
	break;
	case 'delete':
		$userid or msg('��ѡ���Ա');
		$db->halt = 0;
		if(!$_founder) {
			if(is_array($userid)) {
				foreach($userid as $uid) {
					$do->userid = $uid;
					$user = $do->get_one();
					if($user['groupid'] == 1) dalert('����Ȩɾ������Ա', '?file=logout');
				}
			} else {
				$do->userid = $userid;
				$user = $do->get_one();
				if($user['groupid'] == 1) dalert('����Ȩɾ������Ա', '?file=logout');
			}
		}
		if($do->delete($userid)) {
			dmsg('ɾ���ɹ�', $forward);
		} else {
			msg($do->errmsg);
		}
	break;
	case 'move':
		$userid or msg('��ѡ���Ա');
		$gid = isset($groupids) ? $groupids : $groupid;
		if($gid == 1) msg('����ʧ�ܣ�&nbsp;�����Ҫ��ӹ���Ա<br/><a href="?file=admin&action=add">�������������Ա����...</a>');
		if($GROUP[$gid]['vip']) msg('����ʧ�ܣ�&nbsp;�����Ҫ���'.VIP.'��Ա<br/><a href="?moduleid=4&file=vip&action=add">����������'.VIP.'����...</a>');
		$do->move($userid, $gid);
		dmsg('�ƶ��ɹ�', $forward);
	break;
	case 'check':
		if($userid) {
			if(is_array($userid)) {
				$userids = $userid;
			} else {
				$userids[0] = $userid;
			}
			foreach($userids as $userid) {
				$do->userid = $userid;
				$member = $do->get_one();
				$groupid = $member['regid'];
				$db->query("UPDATE {$AJ_PRE}member SET groupid=$groupid WHERE userid=$userid");
				$db->query("UPDATE {$AJ_PRE}company SET groupid=$groupid WHERE userid=$userid");
				if($MOD['welcome_message'] || $MOD['welcome_email']) {
					$username = $member['username'];
					$email = $member['email'];
					$title = $L['register_msg_welcome'];
					$content = ob_template('welcome', 'mail');
					if($MOD['welcome_message']) send_message($username, $title, $content);
					if($MOD['welcome_email'] && $AJ['mail_type'] != 'close') send_mail($email, $title, $content);
				}
			}
			dmsg('��˳ɹ�', $forward);
		} else {
			$members = $do->get_list($condition, $dorder[$order]);
			include tpl('member_check', $module);
		}
	break;
	case 'rename':
		$cusername or message('��ǰ��Ա������Ϊ��');
		$nusername or message('��Ա������Ϊ��');
		$user = $do->get_one($cusername);
		$userid = $user['userid'];
		if(!$_founder && $cusername != $_username) {
			if($user['groupid'] == 1) msg('����Ȩ�޸���������Ա�û���');
		}
		if($do->rename($cusername, $nusername)) {
			if(!$user['domain']) {
				$linkurl = userurl($nusername);
				$db->query("UPDATE {$AJ_PRE}company SET linkurl='$linkurl' WHERE userid=$userid");
			}
			dmsg('�޸ĳɹ�', $forward);
		} else {
			msg($do->errmsg);
		}
	break;
	case 'login':
		if($userid) {
			if($_userid == $userid) msg('', $MODULE[2]['linkurl']);
			if(!$_founder) {
				$do->userid = $userid;
				$user = $do->get_one();
				if($user['groupid'] == 1) msg('����Ȩ������������Ա��Ա����');
				if($_admin > 1 && $user['support'] && $user['support'] != $_username) msg('����Ȩ����û�Ա�Ļ�Ա����');
			}
			$auth = encrypt($userid.'|'.$_username);
			set_cookie('admin_user', $auth);
			msg('��Ȩ�ɹ�������ת���Ա��Ա����...', $MODULE[2]['linkurl'].'?tm='.$AJ_TIME);
		} else {
			msg();
		}
	break;
	case 'unlock':
		$ip or msg('����д��Ҫ������IP');
		$ipfile = AJ_CACHE.'/ban/'.$ip.'.php';
		if(is_file($ipfile)) {
			cache_delete($ip.'.php', 'ban');
			msg('IP:'.$ip.' �Ѿ��ɹ��������', $forward);
		} else {
			msg('IP:'.$ip.' δ��ϵͳ����');
		}
	break;
	default:
		$members = $do->get_list($condition, $dorder[$order]);
		include tpl('member', $module);
	break;
}
?>