<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('���ģ��', '?file='.$file.'&action=add'),
    array('ģ�����', '?file='.$file),
    array('���»���', '?file='.$file.'&action=cache'),
);
require AJ_ROOT.'/include/sql.func.php';
$this_forward = '?update=1&file='.$file;
$modid = isset($modid) ? intval($modid) : 0;
function get_modules() {
	$moduledirs = glob(AJ_ROOT.'/module/*');
	$sysmodules = array();
	foreach($moduledirs as $k=>$v) {
		if(is_file($v.'/admin/config.inc.php')) {
			include $v.'/admin/config.inc.php';
			$sysmodules[$MCFG['module']] = $MCFG;
		}
	}
	return $sysmodules;
}
switch($action) {
	case 'add':
		if($submit) {
			if(!$post['name']) msg('����дģ������');
			if($post['islink']) {
				if(!$post['linkurl']) msg('����д���ӵ�ַ');
			} else {
				$dir = $post['moduledir'];
				$module = $post['module'];
				if(!$module) msg('��ѡ������ģ��');
				$module_cfg = AJ_ROOT.'/module/'.$module.'/admin/config.inc.php';
				if(!is_file($module_cfg)) msg('��ģ���޷���װ������');
				include $module_cfg;
				if($MCFG['uninstall'] == false) msg('��ģ���޷���װ������');
				if($MCFG['copy'] == false) {
					$r = $db->get_one("SELECT moduleid FROM {$AJ_PRE}module WHERE module='$module' AND islink=0");
					if($r) msg('��ģ���Ѿ���װ��������');
				}
				if(!$dir) msg('����д��װĿ¼');
				if(!preg_match("/^[0-9a-z_-]+$/i", $dir)) msg('Ŀ¼�����Ϸ�,�����һ������');
				$r = $db->get_one("SELECT moduleid FROM {$AJ_PRE}module WHERE moduledir='$dir' AND islink=0");
				if($r) msg('��Ŀ¼���Ѿ�������ģ��ʹ��,�����һ������');
				$sysdirs = array('admin', 'api', 'file', 'include', 'install', 'module', 'skin', 'template', 'wap');
				if(in_array($dir, $sysdirs)) msg('��װĿ¼��ϵͳĿ¼��ͻ���������װĿ¼');
				if(!dir_create(AJ_ROOT.'/'.$dir.'/')) msg('�޷�����'.$dir.'Ŀ¼������PHP�Ƿ��д���Ȩ�޻��ֶ�����');
				if(!is_write(AJ_ROOT.'/'.$dir.'/')) msg('Ŀ¼'.$dir.'�޷�д�룬�����ô�Ŀ¼��дȨ��');
				if(!file_put(AJ_ROOT.'/'.$dir.'/config.inc.php', "AIJIACMS")) msg('Ŀ¼'.$dir.'�޷�д�룬�����ô�Ŀ¼��дȨ��');
			}
			$post['linkurl'] = $post['islink'] ? $post['linkurl'] : ($post['domain'] ? $post['domain'] : linkurl($post['moduledir']."/"));
			if($post['islink']) $post['module'] = 'aijiacms';
			$post['installtime'] = $AJ_TIME;
			if($MCFG['moduleid']) {
				$db->query("DELETE FROM {$AJ_PRE}module WHERE moduleid=".$MCFG['moduleid']);
				$post['moduleid'] = $MCFG['moduleid'];
			}
			$sql1 = $sql2 = $s = "";
			foreach($post as $key=>$value) {
				$sql1 .= $s.$key;
				$sql2 .= $s."'".$value."'";
				$s = ",";
			}
			$db->query("INSERT INTO {$AJ_PRE}module ($sql1) VALUES ($sql2)");
			$moduleid = $db->insert_id();
			$db->query("UPDATE {$AJ_PRE}module SET listorder=$moduleid WHERE moduleid=$moduleid");
			if($post['islink']) {
			} else {
				$module = $post['module'];
				$dir = $post['moduledir'];
				$modulename = $post['name'];
				file_put(AJ_ROOT.'/'.$dir.'/config.inc.php', "<?php\n\$moduleid = ".$moduleid.";\n?>");
				@include AJ_ROOT.'/module/'.$module.'/admin/install.inc.php';
			}
			cache_module();
			dmsg('ģ�鰲װ�ɹ�', $this_forward);
		} else {
			$imodules = array();
			$result = $db->query("SELECT module FROM {$AJ_PRE}module");
			while($r = $db->fetch_array($result)) {
				$imodules[$r['module']] = $r['module'];
			}
			$modules = get_modules();
			$module_select = '<select name="post[module]"  id="module"><option value="0">��ѡ��</option>';
			foreach($modules as $k=>$v) {
				if($v['copy'] == false) {
					if(in_array($v['module'], $imodules)) continue;
				}
				$module_select .= '<option value="'.$v['module'].'">'.$v['name'].'</option>';
			}
			$module_select .= '</select>';
			include tpl('module_add');
		}
	break;
	case 'edit':
		if(!$modid) msg('ģ��ID����Ϊ��');
		$r = $db->get_one("SELECT * FROM {$AJ_PRE}module WHERE moduleid='$modid'");
		if(!$r) msg('ģ�鲻����');
		extract($r);
		if($submit) {
			if(!$post['name']) msg('����дģ������');
			if($islink) {
				if(!$post['linkurl']) msg('����д���ӵ�ַ');
			} else {
				if(!$post['moduledir']) msg('����д��װĿ¼');
				if(!preg_match("/^[0-9a-z_-]+$/i", $post['moduledir'])) msg('Ŀ¼�����Ϸ�,�����һ������');
				$sysdirs = array('admin', 'api', 'cache', 'editor', 'file', 'include', 'install', 'module', 'skin', 'template', 'wap');
				if(in_array($post['moduledir'], $sysdirs)) msg('��װĿ¼��ϵͳĿ¼��ͻ���������װĿ¼');
				$r = $db->get_one("SELECT moduleid FROM {$AJ_PRE}module WHERE moduledir='$post[moduledir]' AND moduleid!=$modid");
				if($r) msg('��Ŀ¼���Ѿ�������ģ��ʹ��,�����һ������');
				$post['linkurl'] = $post['domain'] ? $post['domain'] : linkurl($post['moduledir']."/");
			}			
			$sql = $s = "";
			foreach($post as $key=>$value) {
				$sql .= $s.$key."='".$value."'";
				$s = ",";
			}
			$db->query("UPDATE {$AJ_PRE}module SET $sql WHERE moduleid=$modid");
			if(!$islink && $moduledir != $post['moduledir']) {
				rename(AJ_ROOT.'/'.$moduledir, AJ_ROOT.'/'.$post['moduledir']) or msg('�޷�������Ŀ¼'.$moduledir.'Ϊ'.$post['moduledir'].',���ֶ��޸�');
			}
			cache_module();
			dmsg('ģ���޸ĳɹ�', $this_forward);
		} else {
			@include AJ_ROOT.'/module/'.$module.'/admin/config.inc.php';
			$modulename = isset($MCFG['name']) ? $MCFG['name'] : '';
			include tpl('module_edit');
		}
	break;
	case 'delete':
		if(!$modid) msg('ģ��ID����Ϊ��');	
		if($modid < 5) msg('ϵͳģ�Ͳ���ɾ��');
		#if($modid < 23) dheader('?file='.$file.'&action=disable&value=1&modid='.$modid);
		$r = $db->get_one("SELECT * FROM {$AJ_PRE}module WHERE moduleid='$modid'");
		if(!$r) msg('��ģ�鲻����');
		if(!$r['islink']) {
			$moduleid = $r['moduleid'];
			$module = $r['module'];
			$dir = $r['moduledir'];
			$module_cfg = AJ_ROOT.'/module/'.$module.'/admin/config.inc.php';
			if(!is_file($module_cfg)) msg('��ģ�Ͳ���ж�أ�����');
			include $module_cfg;
			if($MCFG['uninstall'] == false) msg('��ģ�Ͳ���ж�أ�����');
			@include AJ_ROOT.'/module/'.$module.'/admin/uninstall.inc.php';			
			$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			while($r = $db->fetch_row($result)) {
				$tb = $r[0];
				$pt = str_replace($AJ_PRE.$moduleid.'_', '', $tb);
				if(is_numeric($pt)) $db->query("DROP TABLE IF EXISTS `".$tb."`");
			}
			$db->query("DELETE FROM `".$AJ_PRE."category` WHERE moduleid=$moduleid");
			$db->query("DELETE FROM `".$AJ_PRE."keylink` WHERE item=$moduleid");
			$db->query("DELETE FROM `".$AJ_PRE."setting` WHERE item=$moduleid");
			$tb = str_replace($AJ_PRE, '', get_table($moduleid));
			$db->query("DELETE FROM `".$AJ_PRE."fields` WHERE tb='$tb'");
			dir_delete(AJ_ROOT.'/'.$dir);
		}
		$db->query("DELETE FROM {$AJ_PRE}module WHERE moduleid='$modid'");
		cache_module();
		dmsg('ģ��ɾ���ɹ�', $this_forward);
		break;
	case 'remkdir':
		if(!$modid) msg('ģ��ID����Ϊ��');
		$r = $db->get_one("SELECT * FROM {$AJ_PRE}module WHERE moduleid='$modid'");
		$remkdir = AJ_ROOT.'/module/'.$r['module'].'/admin/remkdir.inc.php';
		if(is_file($remkdir)) {
			$moduleid = $r['moduleid'];
			$module = $r['module'];
			$dir = $r['moduledir'];
			if(!dir_create(AJ_ROOT.'/'.$dir)) msg('�޷�����'.$dir.'Ŀ¼������PHP�Ƿ��д���Ȩ�޻��ֶ�����');
			if(!file_put(AJ_ROOT.'/'.$dir.'/config.inc.php', "AIJiacms Test")) msg('Ŀ¼'.$dir.'�޷�д�룬�����Linux/Unix�������������ô�Ŀ¼��дȨ��');
			file_put(AJ_ROOT.'/'.$dir.'/config.inc.php', "<?php\n\$moduleid = ".$moduleid.";\n?>");
			include $remkdir;			
			cache_module();
			dmsg('Ŀ¼�ؽ��ɹ�', '?file='.$file);
		} else {
			msg('��ģ�������ؽ�Ŀ¼', '?file='.$file);
		}
	break;
	case 'disable':
		if(!$modid) msg('ģ��ID����Ϊ��');
		if($modid < 5) msg('ϵͳģ�Ͳ��ɽ���');
		$value = $value ? 1 : 0;
		$db->query("UPDATE {$AJ_PRE}module SET disabled='$value' WHERE moduleid=$modid");
		cache_module();
		dmsg('ģ��״̬�Ѿ��޸�', $this_forward);
	break;
	case 'order':
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$db->query("UPDATE {$AJ_PRE}module SET listorder='$v' WHERE moduleid=$k");
		}
		cache_module();
		dmsg('���³ɹ�', $this_forward);
	break;
	case 'cache':
		cache_module();
		dmsg('���³ɹ�', '?file='.$file);
	break;
	case 'ckdir':
		if(!preg_match("/^[0-9a-z_-]+$/i", $moduledir)) dialog('����һ���Ϸ���Ŀ¼��,�����һ������');
		$r = $db->get_one("SELECT moduleid FROM {$AJ_PRE}module WHERE moduledir='$moduledir'");
		if($r || is_dir(AJ_ROOT.'/'.$moduledir.'/')) dialog('��Ŀ¼���Ѿ���ʹ��,�����һ������');
		dialog('Ŀ¼������ʹ��');
	break;
	default:
		$sysmodules = get_modules();
		$modules = $_modules = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}module ORDER BY listorder ASC,moduleid DESC");
		while($r = $db->fetch_array($result)) {
			if($r['moduleid'] == 1) continue;
			$r['installdate'] = timetodate($r['installtime'], 3);
			$r['modulename'] = isset($sysmodules[$r['module']]) ? $sysmodules[$r['module']]['name'] : '����';
			if($r['disabled']) {
				$_modules[] = $r;
			} else {
				$modules[] = $r;
			}
		}
		include tpl('module');
	break;
}
?>