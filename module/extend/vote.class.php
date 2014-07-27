<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
class vote {
	var $itemid;
	var $db;
	var $table;
	var $table_record;
	var $fields;
	var $errmsg = errmsg;

    function vote() {
		global $db, $AJ_PRE;
		$this->table = $AJ_PRE.'vote';
		$this->table_record = $AJ_PRE.'vote_record';
		$this->db = &$db;
		$this->fields = array('typeid','areaid', 'title','style','level','linkto','content','addtime','fromtime','totime','editor','edittime','template_vote','template', 'vote_min', 'vote_max', 'linkurl', 'choose', 's1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 's9', 's10');
    }

	function pass($post) {
		global $L;
		if(!is_array($post)) return false;
		if(!$post['typeid']) return $this->_($L['vote_pass_type']);
		if(!$post['title']) return $this->_($L['vote_pass_title']);
		return true;
	}

	function set($post) {
		global $MOD, $AJ_TIME, $_username, $_userid;
		$post['addtime'] = (isset($post['addtime']) && $post['addtime']) ? strtotime($post['addtime']) : $AJ_TIME;
		$post['edittime'] = $AJ_TIME;
		$post['editor'] = $_username;
		$post['content'] = addslashes(save_remote(save_local(stripslashes($post['content']))));
		clear_upload($post['content']);
		if($this->itemid) {
			$new = $post['content'];
			$r = $this->get_one();
			$old = $r['content'];
			delete_diff($new, $old);
		}
		if($post['fromtime']) $post['fromtime'] = strtotime($post['fromtime'].' 0:0:0');
		if($post['totime']) $post['totime'] = strtotime($post['totime'].' 23:59:59');
		return array_map("trim", $post);
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid='$this->itemid'");
	}

	function get_list($condition = '1', $order = 'addtime DESC') {
		global $MOD, $TYPE, $pages, $page, $pagesize, $offset, $L, $sum;
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['alt'] = $r['title'];
			$r['title'] = set_style($r['title'], $r['style']);
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['fromdate'] = $r['fromtime'] ? timetodate($r['fromtime'], 3) : $L['timeless'];
			$r['todate'] = $r['totime'] ? timetodate($r['totime'], 3) : $L['timeless'];
			$r['typename'] = $TYPE[$r['typeid']]['typename'];
			$r['typeurl'] = $MOD['vote_url'].rewrite('index.php?typeid='.$r['typeid']);
			$lists[] = $r;
		}
		return $lists;
	}

	function get_list_record($condition = '1', $order = 'rid DESC') {
		global $MOD, $TYPE, $pages, $page, $pagesize, $offset, $sum;
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table_record} WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table_record} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $this->db->fetch_array($result)) {
			$r['votedate'] = timetodate($r['votetime'], 6);
			$lists[] = $r;
		}
		return $lists;
	}

	function add($post) {
		global $AJ, $MOD, $module;
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		$this->itemid = $this->db->insert_id();
		if(!$post['islink']) {
			$linkurl = $this->linkurl($this->itemid);
			$this->db->query("UPDATE {$this->table} SET linkurl='$linkurl' WHERE itemid=$this->itemid");
			tohtml('vote', $module, "itemid=$this->itemid");
		}
		return $this->itemid;
	}

	function edit($post) {
		global $AJ, $MOD, $module;
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		if(!$post['islink']) {
			$linkurl = $this->linkurl($this->itemid);
			$this->db->query("UPDATE {$this->table} SET linkurl='$linkurl' WHERE itemid=$this->itemid");
			tohtml('vote', $module, "itemid=$this->itemid");
		}
		return true;
	}

	function update() {
		$result = $this->db->query("SELECT * FROM {$this->table}");
		while($r = $this->db->fetch_array($result)) {
			$itemid = $r['itemid'];
			$linkurl = $this->linkurl($itemid);
			$this->db->query("UPDATE {$this->table} SET linkurl='$linkurl' WHERE itemid=$itemid");
		}
		return true;
	}

	function linkurl($itemid) {
		global $MOD;
		$linkurl = rewrite('index.php?itemid='.$itemid);
		return $MOD['vote_url'].$linkurl;
	}

	function delete($itemid) {
		if(is_array($itemid)) {
			foreach($itemid as $v) { 
				$this->delete($v, $all); 
			}
		} else {
			$this->itemid = $itemid;
			$r = $this->get_one();
			$userid = get_user($r['editor']);
			if($r['content']) delete_local($r['content'], $userid);
			$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
			$this->db->query("DELETE FROM {$this->table_record} WHERE itemid=$itemid");
			unlink(AJ_CACHE.'/htm/vote_'.$r['itemid'].'.htm');
		}
	}

	function level($itemid, $level) {
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$this->db->query("UPDATE {$this->table} SET level=$level WHERE itemid IN ($itemids)");
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>