<?php
/*
	[aijiacms  System] Copyright (c) 2008-2013 aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
array('ϵͳ��ҳ', '?action=123'),
array('�޸�����', '?action=password'),
array('��Ϣͳ��', '?file=count'),
array('��Ա����', $MODULE[2]['linkurl'], 'target="_blank"'),
array('��վ��ҳ', AJ_PATH, 'target="_blank"'),
array('��ȫ�˳�', '?file=logout','target="_top" onclick="return confirm(\'ȷ��Ҫ�˳�������?\');"'),
);
if($_admin > 1) unset($menus[1]);
switch($action) {
	case 'cache':
		isset($step) or $step = 0;
		if($step == 1) {
			cache_clear('module');
			cache_module();
			msg('ϵͳ���ø��³ɹ�', '?action='.$action.'&step='.($step+1));
		} else if($step == 2) {
			cache_clear_tag(1);
			msg('��ǩ���û�����³ɹ�', '?action='.$action.'&step='.($step+1));
		} else if($step == 3) {
			cache_clear('php', 'dir', 'tpl');
			msg('ģ�建����³ɹ�', '?action='.$action.'&step='.($step+1));
		} else if($step == 4) {
			cache_clear('cat');
			cache_category();
			msg('���໺����³ɹ�', '?action='.$action.'&step='.($step+1));
		} else if($step == 5) {
			cache_clear('area');
			cache_area();
			msg('����������³ɹ�', '?action='.$action.'&step='.($step+1));
		} else if($step == 6) {
			cache_clear('fields');
			cache_fields();
			cache_clear('option');
			msg('�Զ����ֶθ��³ɹ�', '?action='.$action.'&step='.($step+1));
		} else if($step == 7) {
			cache_clear_ad();
			tohtml('index');
			msg('ȫ��������³ɹ�');
		} else {
			cache_clear('group');
			cache_group();
			cache_clear('type');
			cache_type();
			cache_clear('keylink');
			cache_keylink();
			cache_pay();
			cache_banip();
			cache_banword();
			cache_bancomment();
			msg('���ڿ�ʼ���»���', '?action='.$action.'&step='.($step+1));
		}
	break;
	case 'cacheclear':
		if($CFG['cache'] == 'file') dheader('?action=update');
		$dc->clear();
		msg('������³ɹ�');
	break;
	case 'update':
		$job = 'php';
		if(isset($dir)) {
			isset($cf) or $cf = 0;
			isset($cd) or $cd = 0;
			if(preg_match("/^".$job."[0-9]{14}$/", $dir)) {
				$dirs = glob(AJ_CACHE.'/'.$dir.'/*');
				if($dirs) {
					$sub = $dirs[array_rand($dirs)];
					file_del($sub.'/index.html');
					$files = glob($sub.'/*.php');
					if($files) {
						$i = 0;
						foreach($files as $f) {
							file_del($f);
							$cf++;
							$i++;
							if($i > 500) msg('��ɾ�� '.$cd.' ��Ŀ¼��'.$cf.' ���ļ�'.progress(0, $cd, $tt), '?action='.$action.'&dir='.$dir.'&cd='.$cd.'&cf='.$cf.'&job='.$job.'&tt='.$tt, 0);
						}
						dir_delete($sub);
						$cd++;
						msg('��ɾ�� '.$cd.' ��Ŀ¼��'.$cf.' ���ļ�'.progress(0, $cd, $tt), '?action='.$action.'&dir='.$dir.'&cd='.$cd.'&cf='.$cf.'&job='.$job.'&tt='.$tt, 0);
					} else {
						dir_delete($sub);
						$cd++;
						msg('��ɾ�� '.$cd.' ��Ŀ¼��'.$cf.' ���ļ�'.progress(0, $cd, $tt), '?action='.$action.'&dir='.$dir.'&cd='.$cd.'&cf='.$cf.'&job='.$job.'&tt='.$tt, 0);
					}
				} else {
					dir_delete(AJ_CACHE.'/'.$dir);
					msg('������³ɹ�');
				}
			} else {
				msg('Ŀ¼������');
			}
		} else {
			$dir = $job.timetodate($AJ_TIME, 'YmdHis');
			if(rename(AJ_CACHE.'/'.$job, AJ_CACHE.'/'.$dir)) {
				dir_create(AJ_CACHE.'/'.$job);
				file_del(AJ_CACHE.'/'.$dir.'/index.html');
				$dirs = glob(AJ_CACHE.'/'.$dir.'/*');
				$tt = count($dirs);
				msg('���ڸ��£��˲���������ʱ�ϳ����벻Ҫ�ж�..', '?action='.$action.'&dir='.$dir.'&job='.$job.'&tt='.$tt);
			} else {
				msg('����ʧ��');
			}
		}
	break;
	case 'html':
		cache_clear_tag(1);
		$db->expires = $CFG['db_expires'] = $CFG['tag_expires'] = 0;
		tohtml('index');
		$filename = $CFG['com_dir'] ? AJ_ROOT.'/'.$AJ['index'].'.'.$AJ['file_ext'] : AJ_CACHE.'/index.inc.html';
		msg('��ҳ���³ɹ� '.(is_file($filename) ? dround(filesize($filename)/1024).'Kb ' : '').'&nbsp;&nbsp;<a href="'.AJ_PATH.'" target="_blank">����鿴</a>');
	break;
	case 'phpinfo':
		phpinfo();
		exit;
	break;
	case 'password':
		if($submit) {
			if(!$oldpassword) msg('��������������');
			if(!$password) msg('������������');
			if(strlen($password) < 6) msg('����������6λ�����޸�');
			if($password != $cpassword) msg('������������벻һ�£�����');
			$r = $db->get_one("SELECT password FROM {$AJ_PRE}member WHERE userid='$_userid'");
			if($r['password'] != md5(md5($oldpassword)))  msg('���������������');
			if($password == $oldpassword) msg('�����벻��������������ͬ');
			$password = md5(md5($password));
			$db->query("UPDATE {$AJ_PRE}member SET password='$password' WHERE userid='$_userid'");
			userclean($_username);
			msg('����Ա�����޸ĳɹ�', '?action=main');
		} else {
			include tpl('password');
		}
	break;
	case 'static':
		if($itemid) {
			foreach(array(AJ_ROOT.'/file/flash/', AJ_ROOT.'/file/image/', AJ_ROOT.'/file/script/', AJ_ROOT.'/skin/'.$CFG['skin'].'/', AJ_ROOT.'/'.$MODULE[2]['moduledir'].'/image/', AJ_ROOT.'/'.$MODULE[4]['moduledir'].'/skin/') as $d) {
				$s = str_replace(AJ_ROOT, AJ_ROOT.'/file/static', $d);
				dir_copy($d, $s);
			}
			foreach(array(AJ_ROOT.'/favicon.ico', AJ_ROOT.'/lang/'.AJ_LANG.'/lang.js') as $d) {
				$s = str_replace(AJ_ROOT, AJ_ROOT.'/file/static', $d);
				file_copy($d, $s);
			}
		}
		include tpl('static');
	break;
	case 'side':
		$files = glob(AJ_CACHE.'/*.part');
		$spart = 0;
		if($files) {
			foreach($files as $f) {
				$mid = basename($f, '.part');
				$fd = $mid == 4 ? 'userid' : 'itemid';
				$r = $db->get_one("SELECT MAX($fd) AS maxid FROM ".get_table($mid));
				$part = split_id($r['maxid']);
				if($mid == 5) $spart = $part;
				split_content($mid, $part);
				split_content($mid, $part+1);
			}
		}
		/*
		if($spart) {
			split_sell($spart);
			split_sell($spart+1);
		}
		*/
		$dc->expire();
		include tpl('side');
	break;
		case 'top':
		$files = glob(AJ_CACHE.'/*.part');
		if($files) {
			foreach($files as $f) {
				$mid = basename($f, '.part');
				$fd = $mid == 4 ? 'userid' : 'itemid';
				$r = $db->get_one("SELECT MAX($fd) AS maxid FROM ".get_table($mid));
				$part = split_id($r['maxid']);
				split_content($mid, $part);
				split_content($mid, $part+1);
			}
		}
		/*
		if(isset($MODULE[5])) {
			$r = $db->get_one("SELECT MAX(itemid) AS maxid FROM {$AJ_PRE}sell");
			$part = split_id($r['maxid']);
			split_sell($part);
			split_sell($part+1);
		}
		*/
		$dc->expire();
		include tpl('top');
	break;
	case 'main':
		if($submit) {
			$note = '<?php exit;?>'.stripslashes($note);
			file_put(AJ_ROOT.'/file/user/'.dalloc($_userid).'/'.$_userid.'/note.php', $note);
			dmsg('���³ɹ�', '?action=main');
		} else {
			$user = $db->get_one("SELECT loginip,logintime,logintimes FROM {$AJ_PRE}member WHERE userid=$_userid");
			$note = AJ_ROOT.'/file/user/'.dalloc($_userid).'/'.$_userid.'/note.php';
			$note = file_get($note);
			if($note) {
				$note = substr($note, 13);
			} else {
				$note = '';
			}
			$install = file_get(AJ_CACHE.'/install.lock');
			if(!$install) {
				$install = $AJ_TIME;
				file_put(AJ_CACHE.'/install.lock', $AJ_TIME);
			}
			$r = $db->get_one("SELECT item_value FROM {$AJ_PRE}setting WHERE item='aijiacms' AND item_key='backtime'");
			$backtime = $r['item_value'];
			$backdays = intval(($AJ_TIME - $backtime)/86400);
			$backtime = timetodate($backtime, 6);
			$notice_url = decrypt('UGgMI155ACddNwEpVSYBLAF4DSgLLwo/AGZQPgc9DjpZags9U3MCewAzVDwBMAVwDnVQcgBuCj8Jclc2VCkGI1BoDCc', 'aijiacms').'?version='.AJ_VERSION.'&release='.AJ_RELEASE.'&lang='.AJ_LANG.'&charset='.AJ_CHARSET.'&install='.$install.'&os='.PHP_OS.'&soft='.urlencode($_SERVER['SERVER_SOFTWARE']).'&php='.urlencode(phpversion()).'&mysql='.urlencode(mysql_get_server_info()).'&url='.urlencode($AJ_URL).'&site='.urlencode($AJ['sitename']).'&auth='.strtoupper(md5($AJ_URL.$install.$_SERVER['SERVER_SOFTWARE']));
			$help_url= decrypt('BT0MI155AiUGbFR8XC8BLFsiUncOKgQpWSNRNA8yBz9ZaAw2USwEMFBvB20', 'aijiacms');
			$install = timetodate($install, 5);			
			$edition = edition(1);
			include tpl('main');
		}
	break;
	case 'left':
		$mymenu = cache_read('menu-'.$_userid.'.php');
		include tpl('left');
	break;
	default:
		include tpl('index');
	break;
}
?>