<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
login();
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$MG['ask'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
require AJ_ROOT.'/include/post.func.php';
$TYPE = get_type('ask', 1);
$TYPE or message($L['feature_close']);
$forward or $forward = $MOD['linkurl'].'answers.php';
$dstatus = $L['ask_status'];
$r = $db->get_one("SELECT support FROM {$AJ_PRE}member WHERE userid=$_userid");
$support = $r['support'] ? $r['support'] : '';
switch($action) {
	case 'add':
		if($submit) {
			$typeid = intval($typeid);
			if(!$typeid || !isset($TYPE[$typeid])) message($L['pass_typeid']);
			if(empty($title)) message($L['pass_title']);
			if(empty($content)) message($L['pass_content']);
			$fields = array(
				'typeid' => $typeid,
				'title' => $title,
				);
			$fields = dhtmlspecialchars($fields);
			$fields['content'] = $content;
			$fields['houseid'] = $_POST['houseid'];
			$fields['username'] = $_username;
			$fields['addtime'] = $AJ_TIME;
			$sqlk = $sqlv = '';
			foreach($fields as $k=>$v) {
				$sqlk .= ','.$k; $sqlv .= ",'$v'";
			}
			$sqlk = substr($sqlk, 1); $sqlv = substr($sqlv, 1);
			$db->query("INSERT INTO {$AJ_PRE}ask ($sqlk) VALUES ($sqlv)");
			dmsg($L['ask_add_success'], $MOD['linkurl'].'ask.php');
		} else {
			$type_select = type_select('ask', 1, 'typeid', $L['choose_type'], 0, 'id="typeid"');
			$head_title = $L['ask_title_add'];
		}
	break;
	case 'edit':
		$itemid or message();
		$r = $db->get_one("SELECT * FROM {$AJ_PRE}ask WHERE itemid=$itemid AND tousername='$_username'");
		
		
		if($submit) {
			
			$fields = dhtmlspecialchars($fields);
			//$fields['content'] = $content;
			$fields['status'] = $status;
			$fields['reply'] = $reply;
			$fields['admintime'] = $AJ_TIME;
			$fields['admin'] = $_username;
			$sql = '';
			foreach($fields as $k=>$v) {
				$sql .= ",$k='$v'";
			}
			$sql = substr($sql, 1);
			$db->query("UPDATE {$AJ_PRE}ask SET $sql WHERE itemid=$itemid AND tousername='$_username' ");
			dmsg($L['op_edit_success'], $forward);
		} else {			
			extract($r);
			$addtime = timetodate($addtime, 5);
		$admintime = $admintime ? timetodate($admintime, 5) : '';
			$type_select = type_select('ask', 1, 'typeid', $L['choose_type'], $typeid);
			$head_title = $L['ask_title_edit'];
			$stars = $L['ask_star_type'];
		}
	break;
	case 'show':
		$itemid or message();
		$r = $db->get_one("SELECT * FROM {$AJ_PRE}ask WHERE itemid=$itemid AND tousername='$_username'");
		
		$r or message();
		extract($r);
		$addtime = timetodate($addtime, 5);
		$admintime = $admintime ? timetodate($admintime, 5) : '';
		$stars = $L['ask_star_type'];
		$head_title = $L['ask_title_show'];
	break;
	
	
	case 'delete':
		$itemid or message();
		$db->query("DELETE FROM {$AJ_PRE}ask WHERE username='$_username' AND itemid=$itemid");
		dmsg($L['op_del_success'], $forward);
	break;
	default:
		$typeid = isset($typeid) ? intval($typeid) : '';
		$condition = '';
		if($typeid) $condition .= " AND typeid=$typeid";
		$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}ask WHERE username='$_username' $condition");
		$pages = pages($r['num'], $page, $pagesize);		
		$asks = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}ask WHERE tousername='$_username' $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['dstatus'] = $dstatus[$r['status']];
			$r['type'] = $r['typeid'] && isset($TYPE[$r['typeid']]) ? set_style($TYPE[$r['typeid']]['typename'], $TYPE[$r['typeid']]['style']) : $L['default_type'];
			$asks[] = $r;
		}
		$head_title = $L['ask_title'];
	break;
}
include template('answers', $module);
?>