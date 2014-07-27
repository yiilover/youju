<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
if(!isset($CFG['edittpl']) || !$CFG['edittpl']) msg('ϵͳ��ֹ�������޸�ģ�壬��FTP�޸ĸ�Ŀ¼config.inc.php<br/>$CFG[\'edittpl\'] = \'0\'; �޸�Ϊ $CFG[\'edittpl\'] = \'1\';');
$menus = array (
    array('���CSS', '?file=skin&action=add'),
    array('������', '?file=skin'),
    array('ģ�����', '?file=template'),
    array('��ǩ��', '?file=tag'),
);
$this_forward = '?file='.$file;
$skin_root = AJ_ROOT.'/skin/'.$CFG['skin'].'/';
is_dir($skin_root) or dir_create($skin_root);
$skin_path = './skin/'.$CFG['skin'].'/';
isset($fileid) or $fileid = '';
isset($bakid) or $bakid = '';
if($fileid && !preg_match("/^[0-9a-z_\-]+$/", $fileid))  msg('�ļ���ʽ����');

switch($action) {
	case 'add':
		if($submit) {
			if(!$fileid)  msg('�ļ�������Ϊ��');
			if(!$content) msg('������ݲ���Ϊ��');
			$dfile = $skin_root.$fileid.'.css';
			if(isset($nowrite) && is_file($dfile)) msg('�ļ��Ѿ�����');
			file_put($dfile, stripslashes($content));
			dmsg('�����ӳɹ�', $this_forward);
		} else {
			include tpl('skin_add');
		}
	break;
	case 'edit':
		if(!$fileid)  msg('�ļ�������Ϊ��');
		if($submit) {
			if(!$dfileid) msg('Invalid Request');
			if(!$content) msg('������ݲ���Ϊ��');
			$dfile = $skin_root.$dfileid.'.css';
			$nfile = $skin_root.$fileid.'.css';
			if(isset($backup)) {
				$i = 0;
				while(++$i) {
					$bakfile = $skin_root.$dfileid.'.'.$i.'.bak';
					if(!is_file($bakfile)) {
						file_copy($dfile, $bakfile);
						break;
					}
				}
			}
			file_put($nfile, stripslashes($content));
			if($dfileid != $fileid) file_del($dfile);
			dmsg('����޸ĳɹ�', $forward);
		} else {
			if(!is_write($skin_root.$fileid.'.css')) msg($fileid.'.css����д���뽫����������Ϊ��д');
			$content = file_get($skin_root.$fileid.'.css');
			include tpl('skin_edit');
		}
	break;
	case 'import':
		if(!$fileid) msg('�ļ�������Ϊ��');
		if(!$bakid) msg('Invalid Request');
		if(file_copy($skin_root.$fileid.'.'.$bakid.'.bak', $skin_root.$fileid.'.css')) dmsg('�����ļ��ָ��ɹ�', $this_forward);
		dmsg('�����ļ��ָ�ʧ��');
	break;
	case 'download':
		if(!$fileid) msg('�ļ�������Ϊ��');
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.css';
		file_down($skin_root.$fileid.$file_ext);
	break;
	case 'delete':
		if(!$fileid) msg('�ļ�������Ϊ��');
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.css';
		file_del($skin_root.$fileid.$file_ext);
		dmsg('�ļ�ɾ���ɹ�', $this_forward);
	break;
	default:
		$files = $skins = $baks = array();
		$files = glob($skin_root.'*.*');
		if(!$files) msg('����ļ������ڣ����ȴ���', "?file=$file&action=add");
		foreach($files as $k=>$v) {
			$filename = str_replace($skin_root, '', $v);
			if(preg_match("/^[0-9a-z_-]+\.css$/", $filename)) {
				$fileid = str_replace('.css', '', $filename);
				$skins[$fileid]['fileid'] = $fileid;
				$skins[$fileid]['filename'] = $filename;
				$skins[$fileid]['filesize'] = round(filesize($v)/1024, 2);
				$skins[$fileid]['mtime'] = date('Y-m-d H:i', filemtime($v));
			} else if(preg_match("/^([0-9a-z_-]+)\.([0-9]+)\.bak$/", $filename, $m)) {
				$fileid = str_replace('.bak', '', $filename);
				$baks[$fileid]['fileid'] = $fileid;
				$baks[$fileid]['filename'] = $filename;
				$baks[$fileid]['filesize'] = round(filesize($v)/1024, 2);
				$baks[$fileid]['number'] = $m[2];
				$baks[$fileid]['type'] = $m[1];
				$baks[$fileid]['mtime'] = date('Y-m-d H:i', filemtime($v));
			}
		}
		if($skins) ksort($skins);
		if($baks) ksort($baks);
		include tpl('skin');
	break;
}
?>