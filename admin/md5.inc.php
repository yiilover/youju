<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('ľ��ɨ��', '?file=scan'),
    array('�ļ�У��', '?file='.$file),
);
$sys = array('admin', 'api', 'include', 'javascript', 'lang', 'module', 'template', 'wap');
$fbs = array('file', 'cache');
switch($action) {
	case 'delete':
		preg_match("/^[0-9]{4}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}[\s]{1}[0-9]{2}[\.]{1}[0-9]{2}$/", $mirror) or msg('��ѡ�����ļ�');
		file_del(AJ_ROOT.'/file/md5/'.$mirror.'.php');
		dmsg('ɾ���ɹ�', '?file='.$file);
	break;
	case 'add':
		$filedir or $filedir = $sys;
		$fileext or $fileext = 'php|js|htm';
		$files = array();
		foreach(glob(AJ_ROOT.'/*.*') as $f) {
			if(preg_match("/(config\.inc\.php|version\.inc\.php)$/i", $f)) continue;
			if(preg_match("/\.($fileext)$/i", $f)) $files[] = $f;
		}
		foreach($filedir as $d) {
			$files = array_merge($files, get_file(AJ_ROOT.'/'.$d, $fileext));
		}
		$data = '<?php exit;?>';
		foreach($files as $f) {
			if(preg_match("/(index\.html|these\.name\.php)$/i", $f)) continue;
			$data .= md5_file($f).' '.str_replace(AJ_ROOT.'/', '', $f)."\n";
		}
		file_put(AJ_ROOT.'/file/md5/'.timetodate($AJ_TIME, 'Y-m-d H.i').'.php', $data);
		is_file(AJ_ROOT.'/file/md5/'.AJ_VERSION.'.php') or file_put(AJ_ROOT.'/file/md5/'.AJ_VERSION.'.php', $data);
		if(isset($js)) exit;
		dmsg('�����ɹ�', '?file='.$file);
	break;
	default:
		if($submit) {
			$mirror or $mirror = AJ_VERSION;
			$mirror = $mirror.'.php';
			is_file(AJ_ROOT.'/file/md5/'.$mirror) or msg('��ѡ�����ļ�');
			$filedir or $filedir = $sys;
			$fileext or $fileext = 'php|js|htm';
			$files = array();
			foreach(glob(AJ_ROOT.'/*.*') as $f) {
				if(preg_match("/(config\.inc\.php|version\.inc\.php)$/i", $f)) continue;
				if(preg_match("/\.($fileext)$/i", $f)) $files[] = $f;
			}
			foreach($filedir as $d) {
				$files = array_merge($files, get_file(AJ_ROOT.'/'.$d, $fileext));
			}
			$lists = array();
			foreach($files as $f) {
				if(preg_match("/(index\.html|these\.name\.php)$/i", $f)) continue;
				$lists[md5_file($f)] = str_replace(AJ_ROOT.'/', '', $f);
			}
			$content = substr(trim(file_get(AJ_ROOT.'/file/md5/'.$mirror)), 13);
			foreach(explode("\n", $content) as $v) {
				list($m, $f) = explode(' ', trim($v));
				if(isset($lists[$m]) && $lists[$m] == $f) unset($lists[$m]);
			}
		} else {
			is_file(AJ_ROOT.'/file/md5/'.AJ_VERSION.'.php') or msg('���ڴ��������ļ�..', '?file='.$file.'&action=add');
			$files = glob(AJ_ROOT.'/*');
			$dirs = $rfiles = array();
			foreach($files as $f) {
				if(is_file($f)) {
					$rfiles[] = basename($f);
				} else {
					$dirs[] = basename($f);
				}
			}
			$mfiles = glob(AJ_ROOT.'/file/md5/*.php');
		}
		include tpl('md5');
	break;
}
?>