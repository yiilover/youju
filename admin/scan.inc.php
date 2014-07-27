<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('木马扫描', '?file='.$file),
    array('文件校验', '?file=md5'),
);
$sys = array('admin', 'api', 'include', 'javascript', 'lang', 'module', 'template', 'wap');
$bd_code = 'VBScript.Encode|GetProcesses|gzuncompress|gzinflate|passthru|eval|base64_decode|shell|zend|exec|cmd|soname|windows|000000|fso.|.exe|.dll|孱|提权|挂马|木马|\x';
$bd_ext = 'php|asp|aspx|asa|asax|dll|jsp|cgi|fcgi|pl';
$sys = array();
$fbs = array();
if($submit) {
	$filedir or $filedir = $sys;
	$fileext or $fileext = $bd_ext;
	$code or $code = $bd_code;
	$codenum or $codenum = 2;
	$code = str_replace('\|', '|', preg_quote(stripslashes($code)));
	$code = convert($code, AJ_CHARSET, $charset);
	$files = array();
	foreach(glob(AJ_ROOT.'/*.*') as $f) {
		$files[] = $f;
	}
	foreach($filedir as $d) {
		$files = array_merge($files, get_file(AJ_ROOT.'/'.$d, $fileext));
	}
	$lists = $mirror = array();
	if(is_file(AJ_ROOT.'/file/md5/'.AJ_VERSION.'.php')) {
		$content = substr(trim(file_get(AJ_ROOT.'/file/md5/'.AJ_VERSION.'.php')), 13);
		foreach(explode("\n", $content) as $v) {
			list($m, $f) = explode(' ', trim($v));
			$mirror[$m] = $f;
		}
	}
	foreach($files as $f) {
		if(preg_match("/(scan\.inc\.php)$/i", $f)) continue;
		$content = file_get($f);
		if(preg_match_all('/('.$code.')/i', $content, $m)) {
			$r = $c = array();
			foreach($m[1] as $v) {
				in_array($v, $c) or $c[] = $v;
			}
			$r['num'] = count($c);
			if($r['num'] < $codenum && strpos($content, 'Zend') === false) continue;
			$r['file'] = str_replace(AJ_ROOT.'/', '', $f);
			if($mirror && in_array($r['file'], $mirror)) {
				if(md5_file($f) == array_search($r['file'], $mirror)) continue;
			}
			$r['code'] = convert(implode(',', $c), $charset, AJ_CHARSET);
			$lists[] = $r;
		}
	}
	$find = count($lists);
} else {
	$files = glob(AJ_ROOT.'/*');
	$dirs = $rfiles = array();
	foreach($files as $f) {
		if(is_file($f)) {
			$rfiles[] = basename($f);
		} else {
			$dirs[] = basename($f);
		}
	}
	$code = $bd_code;
	$fileext = $bd_ext;
}
include tpl('scan');
?>