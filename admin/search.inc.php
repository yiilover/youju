<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('��̨����', '?file='.$file),
);
$lists = $files = array();
if($kw) {
	$ukw = urlencode($kw);
	$mid = $moduleid;
	$menu = array();
	include AJ_ROOT.'/admin/menu.inc.php';
	foreach($menu as $m) {
		$m[0] = 'ϵͳά�� - ϵͳ���� - '.$m[0];
		if(strpos($m[0], $kw) !== false) $files[] = $m;
	}
	foreach($menu_system as $m) {
		if(strpos($m[0], $kw) !== false) {
			$m[0] = 'ϵͳά�� - ϵͳ���� - '.$m[0];
			$files[] = $m;
		}
	}
	foreach($MODULE as $k=>$v) {
		if($v['islink'] || $k == 1) continue;
		$menu = array();
		$moduleid = $k;
		$name = $v['name'];
		include AJ_ROOT.'/module/'.$v['module'].'/admin/menu.inc.php';
		$name = $moduleid == 3 ? '��չ����' : $name.'����';
		foreach($menu as $m) {
			if(strpos($m[0], $kw) !== false) {
				$m[0] = ($moduleid > 2 ? '����ģ�� - ' : '').$name.' - '.$m[0];
				$files[] = $m;
			}
		}
	}
	foreach($menu_finance as $m) {
		if(strpos($m[0], $kw) !== false) {
			$m[0] = '��Ա���� - ������� - '.$m[0];
			$files[] = $m;
		}
	}
	foreach($menu_relate as $m) {
		if(strpos($m[0], $kw) !== false) {
			$m[0] = '��Ա���� - ��Ա��� - '.$m[0];
			$files[] = $m;
		}
	}
	$moduleid = $mid;
	$content = file_get_contents(AJ_ROOT.'/admin/template/setting.tpl.php');
	if(preg_match_all('/('.$kw.')/i', $content, $m)) {
		$lists[1]['num'] = count($m[1]);
		$lists[1]['name'] = 'ϵͳά�� - ��վ����';
	}
	foreach($MODULE as $k=>$v) {
		if($v['islink'] || $k == 1) continue;
		$content = file_get_contents(AJ_ROOT.'/module/'.$v['module'].'/admin/template/setting.tpl.php');
		if(preg_match_all('/('.$kw.')/i', $content, $m)) {
			$lists[$k]['num'] = count($m[1]);
			$lists[$k]['name'] = '����ģ�� - '.($k == 3 ? '��չ����' : $v['name'].'����').' - ģ������';
		}
	}
	$content = file_get_contents(AJ_ROOT.'/module/member/admin/template/group_edit.tpl.php');
	if(preg_match_all('/('.$kw.')/i', $content, $m)) {
		foreach(cache_read('group.php') as $m) {
			$_m = array();
			$_m[0] = '��Ա���� - ��Ա����� - '.$m['groupname'];
			$_m[1] = '?moduleid=2&file=group&action=edit&groupid='.$m['groupid'].'&kw='.$ukw;
			$files[] = $_m;
		}
	}
	foreach(cache_read('menu-'.$_userid.'.php') as $m) {
		if(strpos($m['title'], $kw) !== false) {
			$_m = array();
			$_m[0] = '�ҵ���� - '.$m['title'];
			$_m[1] = $m['url'];
			$files[] = $_m;
		}
	}
}
include tpl('search');
?>