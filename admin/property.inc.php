<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$CAT or msg('��ָ������ID');
$menus = array (
    array('�������', '?file='.$file.'&catid='.$catid.'&action=add'),
    array('���Բ���', '?file='.$file.'&catid='.$catid),
);
$TYPE = array('�����ı�(text)', '�����ı�(textarea)', '�б�ѡ��(select)', '��ѡ��(checkbox)');
$do = new property;
$do->catid = $catid;
switch($action) {
	case 'add':
		if($submit) {
			if($do->pass($post)) {
				$do->add($post);
				dmsg('��ӳɹ�', '?file='.$file.'&catid='.$catid);
			} else {
				msg($do->errmsg);
			}
		} else {
			$type = 2;
			$required = $search = 0;
			$name = $value = $extend = '';
			include tpl('property_edit');
		}
	break;
	case 'edit':
		$oid or msg();
		$do->oid = $oid;
		if($submit) {
			if($do->pass($post)) {
				$do->edit($post);
				dmsg('�޸ĳɹ�', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			extract($do->get_one($oid));
			include tpl('property_edit');
		}
	break;
	case 'order':
		$do->order($listorder, $pid);
		dmsg('����ɹ�', $forward);
	break;
	case 'delete':
		$oid or msg();
		$do->oid = $oid;
		$do->delete($pid);
		dmsg('ɾ���ɹ�', '?file='.$file.'&catid='.$catid);
	break;
	default:
		$lists = $do->get_list();
		include tpl('property');
	break;
}
class property {
	var $db;
	var $oid;
	var $catid;
	var $table;
	var $errmsg = errmsg;

	function property() {
		global $db, $AJ_PRE;
		$this->table = $AJ_PRE.'category_option';
		$this->db = &$db;
	}

	function pass($post) {
		if(!is_array($post)) return false;
		//if(!$post['pid']) return $this->_(lang('message->pass_property_op_pid'));
		if(!$post['name']) return $this->_('����д��������');
		if($post['type'] == 3) {
			if(!$post['value']) return $this->_('����д��ѡֵ');
			if(strpos($post['value'], '|') === false) return $this->_('������Ҫ�趨2����ѡֵ');
		}
		return true;
	}

	function set($post) {
		$post['value'] = $post['type'] ? trim($post['value']) : '';
		if($post['type'] < 2) $post['search'] = 0;
		return $post;
	}

	function add($post) {
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			$sqlk .= ','.$k; $sqlv .= ",'$v'";
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		return true;
	}

	function edit($post) {
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			$sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE oid=$this->oid");
		return true;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE oid=$this->oid");
	}

	function delete($pid) {
		$this->db->query("DELETE FROM {$this->table} WHERE oid=$this->oid");
	}

	function order($listorder) {
		if(!is_array($listorder)) return false;
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$this->db->query("UPDATE {$this->table} SET listorder=$v WHERE oid=$k");
		}
		return true;
	}

	function get_list() {
		global $pages, $page, $pagesize, $offset, $pagesize, $CAT, $sum;
		$condition = "catid=$this->catid";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {			
			$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
			$items = $r['num'];
		}
		if($items != $CAT['property']) $this->db->query("UPDATE {$this->db->pre}category SET property=$r[num] WHERE catid=$this->catid");
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY listorder ASC,oid ASC LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>