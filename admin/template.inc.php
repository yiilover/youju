<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
if(!isset($CFG['edittpl']) || !$CFG['edittpl']) msg('ϵͳ��ֹ�������޸�ģ�壬��FTP�޸ĸ�Ŀ¼config.inc.php<br/>$CFG[\'edittpl\'] = \'0\'; �޸�Ϊ $CFG[\'edittpl\'] = \'1\';');
isset($dir) or $dir = '';
$menus = array (
	array('�½�ģ��', '?file='.$file.'&action=add&dir='.$dir),
    array('ģ�����', '?file='.$file),
    array('�ؽ�����', '?file='.$file.'&action=cache'),
    array('������', '?file=skin'),
    array('��ǩ��', '?file=tag'),
);
isset($bakid) or $bakid = '';
isset($fileid) or $fileid = '';
$this_forward = '?file='.$file.'&dir='.$dir;
$template_root = AJ_ROOT.'/template/'.$CFG['template'].'/'.$dir;
$template_path = 'template/'.$CFG['template'].'/'.$dir;
@include $template_root.'/these.name.php';

function template_name($fileid = '', $name = '') {
	global $template_root, $names;
	isset($names) or $names = array();
	if($fileid && $name) $names[$fileid] = $name;
	foreach($names as $k => $v) {
		if(!is_file($template_root.'/'.$k.'.htm') && !is_dir($template_root.'/'.$k)) unset($names[$k]);
	}
	if($names) ksort($names);
	file_put($template_root.'/these.name.php', "<?php\n\$names = ".var_export($names, true).";\n?>");
}

switch($action) {
	case 'add':
		if($submit) {
			if(!preg_match("/^[a-z0-9_\-]+$/", $fileid)) msg('�ļ���ֻ��ΪСд��ĸ�����֡��л��ߡ��»���');
			if(!$name) $name = $fileid;
			$template = $template_root.'/'.$fileid.'.htm';
			if(isset($nowrite) && is_file($template)) msg('�ļ��Ѿ�����');
			file_put($template, stripslashes($content));
			if($name != $fileid) template_name($fileid, $name);
			dmsg('�����ɹ�', $this_forward);
		} else {
			$content = '';
			if(isset($type)) $content = htmlspecialchars(file_get($template_root.'/'.$type.'.htm'));
			include tpl('template_add');
		}
	break;
	case 'edit':
		if($submit) {
			$dfileid or msg();
			if(!preg_match("/^[a-z0-9_\-]+$/", $fileid)) msg('�ļ���ֻ��ΪСд��ĸ�����֡��л��ߡ��»���');
			if(!$name) $name = $fileid;
			$dfile = $template_root.'/'.$dfileid.'.htm';
			$nfile = $template_root.'/'.$fileid.'.htm';
			if(isset($backup)) {
				$i = 0;
				while(++$i) {
					$bakfile = $template_root.'/'.$dfileid.'.'.$i.'.bak';
					if(!is_file($bakfile)) {
						file_copy($dfile, $bakfile);
						break;
					}
				}
			}
			file_put($nfile, stripslashes($content));
			if($dfileid != $fileid) file_del($dfile);
			if($name != $fileid) template_name($fileid, $name);
			dmsg('�޸ĳɹ�', '?file='.$file.'&action='.$action.'&fileid='.$fileid.'&dir='.$dir);
		} else {
			$fileid or msg();
			if(!is_write($template_root.'/'.$fileid.'.htm')) msg($fileid.'.htm����д���뽫����������Ϊ��д');
			if($dir) $template_path = $template_path.'/';
			$name = (isset($names[$fileid]) && $names[$fileid]) ? $names[$fileid] : $fileid;
			$content = htmlspecialchars(file_get($template_root.'/'.$fileid.'.htm'));
			include tpl('template_edit');
		}
	break;
	case 'preview':
		$db->halt = 0;
		require_once AJ_ROOT.'/include/template.func.php';
		$tpl_content = stripslashes($content);
		unset($content);
		$tpl_content = template_parse($tpl_content);
		cache_write('_preview.tpl.php', $tpl_content, 'tpl');
		$module = $dir ? $dir : 'aijiacms';
		$head_title = 'ģ��Ԥ��';
		include AJ_CACHE.'/tpl/_preview.tpl.php';
		exit();
	break;
	case 'import':
		$fileid or msg();
		$bakid or msg();
		if(file_copy($template_root.'/'.$fileid.'.'.$bakid.'.bak', $template_root.'/'.$fileid.'.htm')) dmsg('�ָ��ɹ�', $this_forward);
		msg('�����ļ��ָ�ʧ��');
	break;
	case 'template_name':
		$fileid or exit('0');
		$name or exit('0');
		$name = convert($name, 'UTF-8', AJ_CHARSET);
		template_name($fileid, $name);
		exit('1');
	break;
	case 'download':
		$fileid or msg();
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.htm';
		file_down($template_root.'/'.$fileid.$file_ext);
	break;
	case 'delete':
		$fileid or msg();
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.htm';
		file_del($template_root.'/'.$fileid.$file_ext);
		if(!$bakid) template_name();
		dmsg('ɾ���ɹ�', $this_forward);
	break;
	case 'cache':
		cache_clear('php', 'dir', 'tpl');
		dmsg('���³ɹ�', $this_forward);	
	break;
	default:
		$dirs = $files = $templates = $baks = array();
		if(substr($template_root, -1) != '/') $template_root .= '/';
		$files = glob($template_root.'*');
		if(!$files) msg('ģ���ļ������ڣ����ȴ���', "?file=$file&action=add&dir=$dir");
		foreach($files as $k=>$v) {
			if(is_dir($v)) {
				$dirid = basename($v);
				$dirs[$dirid]['dirname'] = $dirid;
				$dirs[$dirid]['name'] = (isset($names[$dirid]) && $names[$dirid]) ? $names[$dirid] : $dirid;
				$dirs[$dirid]['mtime'] = timetodate(filemtime($v), 5);
				$dirs[$dirid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
			} else {
				$filename = str_replace($template_root, '', $v);
				if(preg_match("/^[0-9a-z_-]+\.htm$/", $filename)) {
					$fileid = str_replace('.htm', '', $filename);
					$templates[$fileid]['fileid'] = $fileid;
					$templates[$fileid]['filename'] = $filename;
					$templates[$fileid]['filesize'] = round(filesize($v)/1024, 2);
					$templates[$fileid]['name'] = (isset($names[$fileid]) && $names[$fileid]) ? $names[$fileid] : $fileid;
					$tmp = strpos($filename, '-');
					$templates[$fileid]['type'] = $tmp ? substr($filename, 0, $tmp) : $fileid;
					$templates[$fileid]['mtime'] = timetodate(filemtime($v), 5);
					$templates[$fileid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
				} else if(preg_match("/^([0-9a-z_-]+)\.([0-9]+)\.bak$/", $filename, $m)) {
					$fileid = str_replace('.bak', '', $filename);
					$baks[$fileid]['fileid'] = $fileid;
					$baks[$fileid]['filename'] = $filename;
					$baks[$fileid]['filesize'] = round(filesize($v)/1024, 2);
					$baks[$fileid]['number'] = $m[2];
					$baks[$fileid]['type'] = $m[1];
					$baks[$fileid]['mtime'] = timetodate(filemtime($v), 5);
					$baks[$fileid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
				}
			}
		}
		if($dirs) ksort($dirs);
		if($templates) ksort($templates);
		if($baks) ksort($baks);
		include tpl('template');
	break;
}
?>