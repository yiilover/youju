<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
define('MANAGE_ADMIN', true);
$AREA or $AREA = cache_read('area.php');
require AJ_ROOT.'/admin/admin.class.php';
$do = new admin;
$menus = array (
    array('��ӹ���Ա', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('����Ա����', '?moduleid='.$moduleid.'&file='.$file),
);
$this_forward = '?file='.$file;
switch($action) {
	case 'add':
		if($submit) {
			$admin = $admin == 1 ? 1 : 2;
			if($do->set_admin($username, $admin, $role, $aid)) {
				$r = $do->get_one($username);
				$userid = $r['userid'];
				if($r['admin'] == 2) {
					foreach($MODULE as $m) {
						if(isset($roles[$m['moduleid']])) {
							$right = array();
							$right['title'] = $m['name'].'����';
							$right['url'] = '?moduleid='.$m['moduleid'];
							$do->add($userid, $right, $admin);
						}
					}
					if(isset($roles['database'])) {
						$right = array();
						$right['title'] = '���ݿ����';
						$right['url'] = '?file=database';
						$do->add($userid, $right, $admin);
					}
					if(isset($roles['template'])) {
						$right = array();
						$right['title'] = 'ģ�����';
						$right['url'] = '?file=template';
						$do->add($userid, $right, $admin);
						$right = array();
						$right['title'] = '������';
						$right['url'] = '?file=skin';
						$do->add($userid, $right, $admin);
						$right = array();
						$right['title'] = '��ǩ��';
						$right['url'] = '?file=tag';
						$do->add($userid, $right, $admin);
					}
					$do->cache_right($userid);
					$do->cache_menu($userid);
				}
				msg('����Ա��ӳɹ�����һ�������Ȩ�޺͹������', '?file='.$file.'&id='.$userid.'&tm='.($AJ_TIME+5));
			}
			msg($do->errmsg);
		} else {
			isset($username) or $username = '';
			include tpl('admin_add');
		}
	break;
	case 'edit':
		if($submit) {
			$admin = $admin == 1 ? 1 : 2;
			if($do->set_admin($username, $admin, $role, $aid)) {
				$r = $do->get_one($username);
				$userid = $r['userid'];
				if($r['admin'] == 2) {
					$do->cache_right($userid);
					$do->cache_menu($userid);
				}
				dmsg('�޸ĳɹ�', '?file='.$file);
			}
			msg($do->errmsg);
		} else {
			if(!$userid) msg();
			$user = $do->get_one($userid, 0);
			include tpl('admin_edit');
		}
	break;
	case 'delete':
		if($do->delete_admin($username)) dmsg('�����ɹ�', $this_forward);
		msg($do->errmsg);
	break;
	case 'right':
		if(!$userid) msg();
		$user = $do->get_one($userid, 0);
		if($submit) {
			$right[0]['action'] = $right[0]['action'] ? implode('|', $right[0]['action']) : '';
			$right[0]['catid'] = $right[0]['catid'] ? implode('|', $right[0]['catid']) : '';
			if($do->update($userid, $right, $user['admin'])) {
				dmsg('���³ɹ�', '?file='.$file.'&action=right&userid='.$userid);
			}
			msg($do->errmsg);
		} else {
			$username = $user['username'];
			$drights = $do->get_right($userid);
			$dmenus = $do->get_menu($userid);
			include tpl('admin_right');
		}
	break;
	case 'ajax':
		@include AJ_ROOT.'/'.($mid == 1 ? 'admin' : 'module/'.$MODULE[$mid]['module'].'/admin').'/config.inc.php';
		if(isset($fi)) {
			if(isset($RT) && isset($RT['action'][$fi])) {
				$action_select = '<select name="right[0][action][]" size="2" multiple  style="height:200px;width:150px;"><option value="">ѡ����[��Ctrl����ѡ]</option>';
				foreach($RT['action'][$fi] as $k=>$v) {
					$action_select .= '<option value="'.$k.'">'.$v.'['.$k.']</option>';
				}
				$action_select .= '</select>';
				echo $action_select;
			} else {
				echo '0';
			}
		} else {
			if(isset($RT)) {
				$file_select = '<select name="right[0][file]" size="2" style="height:200px;width:150px;" onchange="get_action(this.value, '.$mid.');"><option value="">ѡ���ļ�[��ѡ]</option>';
				foreach($RT['file'] as $k=>$v) {
					$file_select .= '<option value="'.$k.'">'.$v.'['.$k.']</option>';
				}
				$file_select .= '</select>';
				echo $file_select.'|';
				if($CT) {
					$CATEGORY = cache_read('category-'.$mid.'.php');
					echo '<select name="right[0][catid][]" size="2" multiple style="height:200px;width:300px;">';
					echo '<option>ѡ������ѡ[��Ctrl����ѡ]</option>';
					foreach($CATEGORY as $c) {
						if($c['parentid'] == 0) echo '<option value="'.$c['catid'].'">'.$c['catname'].'</option>';
					}
					echo '</select>';
				} else {
					echo '0';
				}
			} else {
				echo '0|0';
			}
		}
	break;
	default:
		$sfields = array('������', '�û���', '����', '��ɫ');
		$dfields = array('username', 'username', 'truename', 'role');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$type = isset($type) ? intval($type) : 0;
		$areaid = isset($areaid) ? intval($areaid) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = 'groupid=1 AND admin>0';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($type) $condition .= " AND admin=$type";
		if($areaid) $condition .= ($AREA[$areaid]['child']) ? " AND aid IN (".$AREA[$areaid]['arrchildid'].")" : " AND aid=$areaid";
		$lists = $do->get_list($condition);
		include tpl('admin');
	break;
}
?>