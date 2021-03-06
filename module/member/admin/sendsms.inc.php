<?php
defined('IN_AIJIACMS') or exit('Access Denied');
isset($username) or $username = '';
$menus = array (
    array('发送短信', '?moduleid='.$moduleid.'&file='.$file.'&username='.$username),
    array('发送记录', '?moduleid='.$moduleid.'&file='.$file.'&username='.$username.'&action=record'),
    array('获取列表', '?moduleid='.$moduleid.'&file='.$file.'&action=make'),
    array('号码列表', '?moduleid='.$moduleid.'&file='.$file.'&action=list'),
);
function _userinfo($mobile) {
	global $db;
	return $db->get_one("SELECT * FROM {$db->pre}member m,{$db->pre}company c WHERE m.userid=c.userid AND m.mobile='$mobile'");
}
switch($action) {
	case 'list':		 
		$others = array();
		$mailfiles = glob(AJ_ROOT.'/file/mobile/*.txt');
		$mail = $mails = array();
		if(is_array($mailfiles)) {
			$class = 1;
			foreach($mailfiles as $id=>$mailfile)	{
				$tmp = basename($mailfile);
					$mail['filename'] = $tmp;
					$mail['filesize'] = round(filesize($mailfile)/(1024), 2);
					$mail['mtime'] = timetodate(filemtime($mailfile), 5);
					$mail['count'] = substr_count(file_get($mailfile), "\n") + 1;	
					$mails[] = $mail;
			}
		}
		include tpl('sendsms_list', $module);
	break;
	case 'make':
		if(isset($make)) {
			$tb or $tb = $AJ_PRE.'member';
			$field or $field = 'mobile';
			$sql or $sql = 'groupid>4';
			$sql = stripslashes($sql);
			$num or $num = 1000;
			$pagesize = $num;
			$offset = ($page-1)*$pagesize;
			if($page == 1) $random = $title ? $title : mt_rand(1000, 9999);
			$result = $db->query("SELECT $field FROM $tb WHERE $sql LIMIT $offset,$pagesize");
			$mail = '';
			while($r = $db->fetch_array($result)) {
				if($r[$field]) $mail .= $r[$field]."\r\n";
			}
			if($mail) {
				$filename = timetodate($AJ_TIME, 'Ymd').'_'.$random.'_'.$page.'.txt';
				file_put(AJ_ROOT.'/file/mobile/'.$filename, trim($mail));
				$page++;
				msg('文件'.$filename.'获取成功。<br/>请稍候，程序将自动继续...', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&tb='.urlencode($tb).'&field='.urlencode($field).'&sql='.urlencode($sql).'&num='.$num.'&page='.$page.'&random='.urlencode($random).'&make=1');
			} else {
				msg('列表获取成功', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
			}
		} else {
			include tpl('sendsms_make', $module);
		}
	break;
	case 'download':
		$file_ext = file_ext($filename);
		if($file_ext != 'txt') msg('只能下载TxT文件');
		file_down(AJ_ROOT.'/file/mobile/'.$filename);
	break;
	case 'upload':
		require AJ_ROOT.'/include/upload.class.php';
		$do = new upload($_FILES, 'file/mobile/', $uploadfile_name, 'txt');	
		$do->adduserid = false;
		if($do->save()) msg('上传成功', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
		msg($do->errmsg);
	break;
	case 'delete':
		 if(is_array($filenames)) {
			 foreach($filenames as $filename) {
				 if(file_ext($filename) == 'txt') @unlink(AJ_ROOT.'/file/mobile/'.$filename);
			 }
		 } else {
			 if(file_ext($filenames) == 'txt') @unlink(AJ_ROOT.'/file/mobile/'.$filenames);
		 }
		 dmsg('删除成功', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
	break;
	case 'delete_record':
		$itemid or msg('未选择记录');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$AJ_PRE}sms WHERE itemid IN ($itemids)");
		dmsg('删除成功', $forward);
	break;
	case 'clear':
		$time = $today_endtime - 30*86400;
		$db->query("DELETE FROM {$AJ_PRE}sms WHERE sendtime<$time");
		dmsg('清理成功', $forward);
	break;
	case 'record':
		$sfields = array('按条件', '短信内容', '发送结果', '手机号', '操作人');
		$dfields = array('message', 'message', 'code', 'mobile', 'editor');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= $fields < 3 ? " AND $dfields[$fields] LIKE '%$keyword%'" : " AND $dfields[$fields]='$keyword'";
		if($fromtime) $condition .= " AND sendtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND sendtime<".(strtotime($totime.' 23:59:59'));
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}sms WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$lists = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}sms WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['sendtime'] = str_replace(' ', '<br/>', timetodate($r['sendtime'], 6));
			$r['num'] = ceil($r['word']/$AJ['sms_len']);
			$lists[] = $r;
		}
		include tpl('sendsms_record', $module);
	break;
	default:
		if(isset($send)) {
			if(isset($preview) && $preview) {
				if($sendtype == 2) {
					$mobiles = explode("\n", $mobiles);
					$mobile = trim($mobiles[0]);
				} else if($sendtype == 3) {
					$mobiles = explode("\n", file_get(AJ_ROOT.'/file/mobile/'.$mobilelist));
					$mobile = trim($mobiles[0]);
				}
				$user = _userinfo($mobile);
				if($user) eval("\$content = \"$content\";");
				exit($content.$sign);
			}
			if($sendtype == 1) {
				$content or msg('请填写短信内容');
				$mobile or msg('请填写接收号码');
				$mobile = trim($mobile);
				$AJ['sms_sign'] = $sign;
				$s = 0;
				if(is_mobile($mobile)) {
					$user = _userinfo($mobile);
					if($user) eval("\$content = \"$content\";");
					$content = strip_sms($content);
					$sms_code = send_sms($mobile, $content);
					if(strpos($sms_code, $AJ['sms_ok']) !== false) $s++;
				}
				dmsg($s ? '短信发送成功' : '短信发送失败', $forward);
			} else if($sendtype == 2) {
				$content or msg('请填写短信内容');
				$mobiles or msg('请填写接收号码');
				$mobiles = explode("\n", $mobiles);
				$_content = $content;
				$AJ['sms_sign'] = $sign;
				$s = $f = 0;
				foreach($mobiles as $mobile) {
					$mobile = trim($mobile);
					if(is_mobile($mobile)) {
						$user = _userinfo($mobile);
						$content = $_content;
						if($user) eval("\$content = \"$content\";");
						$content = strip_sms($content);
						$sms_code = send_sms($mobile, $content);
						if(strpos($sms_code, $AJ['sms_ok']) !== false) {
							$s++;
						} else {
							$f++;
						}
					}
				}
				dmsg('发送成功('.$s.'),发送失败('.$f.')', $forward);
			} else if($sendtype == 3) {
				if(isset($id)) {
					$data = cache_read($_username.'_sendsms.php');
					$content = $data['content'];
					$mobilelist = $data['mobilelist'];
					$sign = $data['sign'];
				} else {
					$id = $s = $f = 0;
					$content or msg('请填写短信内容');
					$mobilelist or msg('请选择号码列表');
					$data = array();
					$data['mobilelist'] = $mobilelist;
					$data['content'] = $content;
					$data['sign'] = $sign;
					cache_write($_username.'_sendsms.php', $data);
				}
				$_content = $content;
				$AJ['sms_sign'] = $sign;
				$pernum = intval($pernum);
				if(!$pernum) $pernum = 10;
				$mobiles = file_get(AJ_ROOT.'/file/mobile/'.$mobilelist);
				$mobiles = explode("\n", $mobiles);
				for($i = 1; $i <= $pernum; $i++) {
					$mobile = trim($mobiles[$id++]);
					if(is_mobile($mobile)) {
						$user = _userinfo($mobile);
						$content = $_content;
						if($user) eval("\$content = \"$content\";");
						$content = strip_sms($content);
						$sms_code = send_sms($mobile, $content);
						if(strpos($sms_code, $AJ['sms_ok']) !== false) {
							$s++;
						} else {
							$f++;
						}
					}
				}
				if($id < count($mobiles)) {
					msg('已发送('.$id.')条短信，('.$s.')成功('.$f.')失败，系统将自动继续，请稍候...', '?moduleid='.$moduleid.'&file='.$file.'&sendtype=3&id='.$id.'&s='.$s.'&f='.$f.'&pernum='.$pernum.'&send=1');
				}
				cache_delete($_username.'_sendsms.php');
				dmsg('发送成功('.$s.'),发送失败('.$f.')', '?moduleid='.$moduleid.'&file='.$file);
			}
		} else {
			$sendtype = isset($sendtype) ? intval($sendtype) : 1;
			isset($mobile) or $mobile = '';
			$mobiles = '';
			if(isset($userid)) {
				if($userid) {
					$userids = is_array($userid) ? implode(',', $userid) : $userid;					
					$result = $db->query("SELECT mobile FROM {$AJ_PRE}member WHERE userid IN ($userids)");
					while($r = $db->fetch_array($result)) {
						if($r['mobile']) $mobiles .= $r['mobile']."\n";
					}
				}
			}
			if($mobile) {
				if(strpos($mobile, ',') !== false) $mobile = explode(',', $mobile);
				$mobiles .= is_array($mobile) ? implode("\n", $mobile) : $mobile."\n";
			}
			if($mobiles) $sendtype = 2;
			include tpl('sendsms', $module);
		}
	break;
}
?>