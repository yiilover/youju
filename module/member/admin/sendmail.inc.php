<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('�����ʼ�', '?moduleid='.$moduleid.'&file='.$file),
    array('���ͼ�¼', '?moduleid='.$moduleid.'&file='.$file.'&action=record'),
    array('��ȡ�б�', '?moduleid='.$moduleid.'&file='.$file.'&action=make'),
    array('�ʼ��б�', '?moduleid='.$moduleid.'&file='.$file.'&action=list'),
);
function _userinfo($fields, $email) {
	global $db, $AJ_PRE;
	if($fields == 'mail') {
		return $db->get_one("SELECT * FROM {$AJ_PRE}member m,{$AJ_PRE}company c WHERE m.userid=c.userid AND c.mail='$email'");
	} else {
		return $db->get_one("SELECT * FROM {$AJ_PRE}member m,{$AJ_PRE}company c WHERE m.userid=c.userid AND m.email='$email'");
	}
}
switch($action) {
	case 'list':		 
		$others = array();
		$mailfiles = glob(AJ_ROOT.'/file/email/*.txt');
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
		include tpl('sendmail_list', $module);
	break;
	case 'make':
		if(isset($make)) {
			$tb or $tb = $AJ_PRE.'member';
			$field or $field = 'email';
			$sql or $sql = 'groupid>4';
			$sql = stripslashes($sql);
			$num or $num = 1000;
			$pagesize = $num;
			$offset = ($page-1)*$pagesize;
			if($page == 1) $random = $title ? $title : mt_rand(1000, 9999);
			$mail = '';
			$query = "SELECT $field FROM $tb WHERE $sql LIMIT $offset,$pagesize";
			$key = strpos($field, '.') === false ? $field : file_ext($field);
			$result = $db->query($query);
			while($r = $db->fetch_array($result)) {
				if($r[$key]) $mail .= $r[$key]."\r\n";
			}
			if($mail) {
				$filename = timetodate($AJ_TIME, 'Ymd').'_'.$random.'_'.$page.'.txt';
				file_put(AJ_ROOT.'/file/email/'.$filename, trim($mail));
				$page++;
				msg('�ļ�'.$filename.'��ȡ�ɹ���<br/>���Ժ򣬳����Զ�����...', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&tb='.urlencode($tb).'&field='.urlencode($field).'&sql='.urlencode($sql).'&num='.$num.'&page='.$page.'&random='.urlencode($random).'&make=1');
			} else {
				msg('�б��ȡ�ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
			}
		} else {
			include tpl('sendmail_make', $module);
		}
	break;
	case 'download':
		$file_ext = file_ext($filename);
		$file_ext == 'txt' or msg('ֻ������TxT�ļ�');
		file_down(AJ_ROOT.'/file/email/'.$filename);
	break;
	case 'upload':
		require AJ_ROOT.'/include/upload.class.php';
		$do = new upload($_FILES, 'file/email/', $uploadfile_name, 'txt');	
		$do->adduserid = false;
		if($do->save()) msg('�ϴ��ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
		msg($do->errmsg);
	break;
	case 'delete':
		 if(is_array($filenames)) {
			 foreach($filenames as $filename) {
				 if(file_ext($filename) == 'txt') @unlink(AJ_ROOT.'/file/email/'.$filename);
			 }
		 } else {
			 if(file_ext($filenames) == 'txt') @unlink(AJ_ROOT.'/file/email/'.$filenames);
		 }
		 dmsg('ɾ���ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
	break;
	case 'record':
		$table = $AJ_PRE.'mail_log';
		$sfields = array('������', '�ʼ�����', '�ʼ���ַ', '�ʼ�����', '��ע');
		$dfields = array('title', 'title', 'email', 'content', 'note');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($email) or $email = '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($dfromtime) or $dfromtime = '';
		isset($dtotime) or $dtotime = '';
		isset($type) or $type = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($type) $condition .= $type == 1 ? " AND status=3" : " AND status=2";
		if($email) $condition .= " AND email='$email'";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$records = array();
		$result = $db->query("SELECT itemid,email,title,addtime,status,note FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$records[] = $r;
		}
		include tpl('sendmail_record', $module);
	break;
	case 'show':
		$itemid or msg();
		$item = $db->get_one("SELECT * FROM {$AJ_PRE}mail_log WHERE itemid=$itemid");
		$item or msg();
		extract($item);
		include tpl('sendmail_show', $module);		
	break;
	case 'resend':
		$itemid or msg('δѡ���¼');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$AJ['mail_log'] = $i = 0;		
		$result = $db->query("SELECT * FROM {$AJ_PRE}mail_log WHERE itemid IN ($itemids)");
		while($r = $db->fetch_array($result)) {
			if($r['status'] == 3) continue;
			if(send_mail($r['email'], $r['title'], $r['content'])) {
				$db->query("UPDATE {$AJ_PRE}mail_log SET status=3,edittime='$AJ_TIME',editor='$_username',note='' WHERE itemid=$r[itemid]");
				$i++;
			}
		}
		dmsg('�ɹ�����('.$i.')��', $forward);
	break;
	case 'delete_record':
		$itemid or msg('δѡ���¼');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$AJ_PRE}mail_log WHERE itemid IN ($itemids)");
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'clear':
		$time = $today_endtime - 30*86400;
		$db->query("DELETE FROM {$AJ_PRE}mail_log WHERE addtime<$time");
		dmsg('����ɹ�', $forward);
	break;
	default:
		if(isset($send)) {
			if(isset($preview) && $preview) {
				$content = stripslashes($content);
				if($template) {
					if($sendtype == 2) {
						$emails = explode("\n", $emails);
						$email = trim($emails[0]);
					} else if($sendtype == 3) {
						$emails = explode("\n", file_get(AJ_ROOT.'/file/email/'.$mail));
						$email = trim($emails[0]);
					}
					$user = _userinfo($fields, $email);
					eval("\$title = \"$title\";");
					$content = ob_template($template, 'mail');
				}
				echo '<br/><strong>�ʼ����⣺</strong>'.$title.'<br/><br/>';
				echo '<strong>�ʼ����ģ�</strong><br/><br/>';
				echo $content;
				exit;
			}
			if($sendtype == 1) {
				$title or msg('����д�ʼ�����');
				is_email($email) or msg('����д�ʼ���ַ');
				($template || $content) or msg('����д�ʼ�����');
				$email = trim($email);
				$content = save_local(stripslashes($content));
				clear_upload($content);
				$AJ['mail_name'] = $name;
				if($template) {
					$user = _userinfo($fields, $email);
					eval("\$title = \"$title\";");
					$content = ob_template($template, 'mail');					
				}
				send_mail($email, $title, $content, $sender);
			} else if($sendtype == 2) {
				$title or msg('����д�ʼ�����');
				$emails or msg('����д�ʼ���ַ');
				($template || $content) or msg('����д�ʼ�����');
				$emails = explode("\n", $emails);
				$content = save_local(stripslashes($content));
				clear_upload($content);
				$AJ['mail_name'] = $name;
				$_content = $content;
				foreach($emails as $email) {
					$email = trim($email);
					if(is_email($email)) {
					    $content = $_content;
						if($template) {
							$user = _userinfo($fields, $email);
							eval("\$title = \"$title\";");
							$content = ob_template($template, 'mail');
						}
						send_mail($email, $title, $content, $sender);
					}
				}
			} else if($sendtype == 3) {
				if(isset($id)) {
					$data = cache_read($_username.'_sendmail.php');
					$title = $data['title'];
					$content = $data['content'];
					$sender = $data['sender'];
					$name = $data['name'];
					$template = $data['template'];
					$maillist = $data['maillist'];
					$fields = $data['fields'];
				} else {
					$id = 0;
					$title or msg('����д�ʼ�����');
					$maillist or msg('��ѡ���ʼ��б�');
					($template || $content) or msg('����д�ʼ�����');
					$content = save_local(stripslashes($content));
					clear_upload($content);
					$data = array();
					$data['title'] = $title;
					$data['content'] = $content;
					$data['sender'] = $sender;
					$data['name'] = $name;
					$data['template'] = $template;
					$data['maillist'] = $maillist;
					$data['fields'] = $fields;
					cache_write($_username.'_sendmail.php', $data);
				}
				$_content = $content;
				$pernum = intval($pernum);
				if(!$pernum) $pernum = 5;
				$pertime = intval($pertime);
				if(!$pertime) $pertime = 5;
				$AJ['mail_name'] = $name;
				$emails = file_get(AJ_ROOT.'/file/email/'.$maillist);
				$emails = explode("\n", $emails);
				for($i = 1; $i <= $pernum; $i++) {
					$email = trim($emails[$id++]);
					if(is_email($email)) {						
						$content = $_content;
						if($template) {
							$user = _userinfo($fields, $email);							
							eval("\$title = \"$title\";");
							$content = ob_template($template, 'mail');
						}
						send_mail($email, $title, $content, $sender);
					}
				}
				if($id < count($emails)) {
					msg('�ѷ��� '.$id.' ���ʼ���ϵͳ���Զ����������Ժ�...', '?moduleid='.$moduleid.'&file='.$file.'&sendtype=3&id='.$id.'&pernum='.$pernum.'&pertime='.$pertime.'&send=1', $pertime);
				}
				cache_delete($_username.'_sendmail.php');
				$forward = '?moduleid='.$moduleid.'&file='.$file;
			}
			dmsg('�ʼ����ͳɹ�', $forward);
		} else {
			$sendtype = isset($sendtype) ? intval($sendtype) : 1;
			isset($email) or $email = '';
			$emails = '';
			if(isset($userid)) {
				if($userid) {
					$userids = is_array($userid) ? implode(',', $userid) : $userid;					
					$result = $db->query("SELECT email FROM {$AJ_PRE}member WHERE userid IN ($userids)");
					while($r = $db->fetch_array($result)) {
						$emails .= $r['email']."\n";
					}
				}
			}
			if($email) {
				if(strpos($email, ',') !== false) $email = explode(',', $email);
				$emails .= is_array($email) ? implode("\n", $email) : $email."\n";
			}
			if($emails) $sendtype = 2;
			include tpl('sendmail', $module);
		}
	break;
}
?>