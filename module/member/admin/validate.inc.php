<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('��˾��֤', '?moduleid='.$moduleid.'&file='.$file.'&action=company'),
    array('ʵ����֤', '?moduleid='.$moduleid.'&file='.$file.'&action=truename'),
    array('�ֻ���֤', '?moduleid='.$moduleid.'&file='.$file.'&action=mobile'),
    array('�ʼ���֤', '?moduleid='.$moduleid.'&file='.$file.'&action=email'),
);
$table = $AJ_PRE.'validate';
$V = array('company'=>'��˾��֤', 'truename'=>'ʵ����֤', 'mobile'=>'�ֻ���֤', 'email'=>'�ʼ���֤');
$S = array('company'=>'0', 'truename'=>'1', 'mobile'=>'2', 'email'=>'3');
$reason = isset($reason) ? trim($reason) : '';
if($reason == '����ԭ��') $reason = '';
$msg = isset($msg) ? 1 : 0;
$sms = isset($sms) ? 1 : 0;
if(!$AJ['sms']) $sms = 0;
switch($action) {
	case 'cancel':
		$itemid or msg('��ѡ���¼');
		$i = 0;
		foreach($itemid as $id) {
			$r = $db->get_one("SELECT * FROM {$table} WHERE itemid='$id' AND status=3");
			if($r) {
				$username = $r['username'];
				$fd = $r['type'];
				$vfd = 'v'.$r['type'];
				$userid = get_user($username);
				if($r['thumb']) delete_upload($r['thumb'], $userid);
				if($r['thumb1']) delete_upload($r['thumb1'], $userid);
				if($r['thumb2']) delete_upload($r['thumb2'], $userid);
				$db->query("UPDATE {$AJ_PRE}member SET `{$vfd}`=0 WHERE username='$username'");
				$db->query("DELETE FROM {$table} WHERE itemid=$id");
				if($msg) {
					$content = $title = '����'.$V[$fd].'�Ѿ���ȡ������������֤';
					if($reason) $content .= '<br/>ȡ��ԭ��:'.nl2br($reason);
					send_message($username, $title, $content);
				}
				if($msg) {
					$t = $db->get_one("SELECT mobile FROM {$AJ_PRE}member WHERE username='$username'");
					if($t) {
						$content = '����'.$V[$fd].'�Ѿ���ȡ������������֤';
						if($reason) $content .= ',ȡ��ԭ��:'.$reason;
						send_sms($t['mobile'], $content.$AJ['sms_sign']);
					}
				}
				$i++;
			}
		}
		dmsg('ȡ����֤ '.$i.' ��', $forward);		
	break;
	case 'reject':
		$itemid or msg('��ѡ���¼');
		$i = 0;
		foreach($itemid as $id) {
			$r = $db->get_one("SELECT * FROM {$table} WHERE itemid='$id' AND status=2");
			if($r) {
				$username = $r['username'];
				$fd = $r['type'];
				$userid = get_user($username);
				if($r['thumb']) delete_upload($r['thumb'], $userid);
				if($r['thumb1']) delete_upload($r['thumb1'], $userid);
				if($r['thumb2']) delete_upload($r['thumb2'], $userid);
				$db->query("DELETE FROM {$table} WHERE itemid=$id");
				if($msg) {
					$content = $title = '����'.$V[$fd].'û��ͨ����ˣ���������֤';
					if($reason) $content .= '<br/>ʧ��ԭ��:'.nl2br($reason);
					send_message($username, $title, $content);
				}
				if($msg) {
					$t = $db->get_one("SELECT mobile FROM {$AJ_PRE}member WHERE username='$username'");
					if($t) {
						$content = '����'.$V[$fd].'û��ͨ����ˣ���������֤';
						if($reason) $content .= ',ʧ��ԭ��:'.$reason;
						send_sms($t['mobile'], $content.$AJ['sms_sign']);
					}
				}
				$i++;
			}
		}
		dmsg('�ܾ���֤ '.$i.' ��', $forward);		
	break;
	case 'check':
		$itemid or msg('��ѡ���¼');
		$i = 0;
		foreach($itemid as $id) {
			$r = $db->get_one("SELECT * FROM {$table} WHERE itemid='$id' AND status=2");
			if($r) {
				$value = $r['title'];
				$username = $r['username'];
				$fd = $r['type'];
				$vfd = 'v'.$r['type'];
				$db->query("UPDATE {$AJ_PRE}member SET `{$fd}`='$value',`{$vfd}`=1 WHERE username='$username'");
				if($fd == 'company') $db->query("UPDATE {$AJ_PRE}company SET `company`='$value' WHERE username='$username'");
				$db->query("UPDATE {$table} SET status=3,editor='$_username',edittime='$AJ_TIME' WHERE itemid='$id'");
				if($msg) {
					$content = $title = '����'.$V[$fd].'�Ѿ�ͨ�����';
					if($reason) $content .= '<br/>'.nl2br($reason);
					send_message($username, $title, $content);
				}
				if($msg) {
					$t = $db->get_one("SELECT mobile FROM {$AJ_PRE}member WHERE username='$username'");
					if($t) {
						$content = '����'.$V[$fd].'�Ѿ�ͨ�����';
						if($reason) $content .= ','.$reason;
						send_sms($t['mobile'], $content.$AJ['sms_sign']);
					}
				}
				$i++;
			}
		}
		dmsg('ͨ����֤ '.$i.' ��', $forward);		
	break;
	default:
		$action or $action = 'company';
		$menuid = $S[$action];
		$sfields = array('������', '��֤��', '��Ա��', '������');
		$dfields = array('title', 'title', 'username', 'editor');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($type) or $type = '';
		$status = isset($status) ? intval($status) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
		if($action) $condition .= " AND type='$action'";
		if($status) $condition .= " AND status=$status";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$lists = array();
		$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$lists[] = $r;
		}
		include tpl('validate', $module);
	break;
}
?>