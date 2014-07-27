<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$TYPE = get_type('mail', 1);
$menus = array (
    array('����ʼ�', '?moduleid='.$moduleid.'&file='.$file.'&action=add'),
    array('�ʼ�����', '?moduleid='.$moduleid.'&file='.$file),
    array('�����б�', '?moduleid='.$moduleid.'&file='.$file.'&action=list'),
    array('���ķ���', 'javascript:Dwidget(\'?file=type&item='.$file.'\', \'���ķ���\');'),
);
switch($action) {
	case 'add':
		if($submit) {
			$typeid or msg('��ѡ���ʼ�����');
			$title or msg('����д�ʼ�����');
			$content or msg('����д�ʼ�����');
			$content = addslashes(save_remote(save_local(stripslashes($content))));
			$db->query("INSERT INTO {$AJ_PRE}mail (title,typeid,content,addtime,editor,edittime) VALUES ('$title','$typeid','$content','$AJ_TIME','$_username','$AJ_TIME')");
			dmsg('��ӳɹ�', $forward);
		} else {
			include tpl('mail_add', $module);
		}
	break;
	case 'edit':
		$itemid or msg();
		if($submit) {
			$typeid or msg('��ѡ���ʼ�����');
			$title or msg('����д�ʼ�����');
			$content or msg('����д�ʼ�����');
			$content = addslashes(save_remote(save_local(stripslashes($content))));
			$db->query("UPDATE {$AJ_PRE}mail SET title='$title',typeid='$typeid',content='$content',editor='$_username',edittime='$AJ_TIME' WHERE itemid=$itemid");
			dmsg('�޸ĳɹ�', $forward);
		} else {
			$r = $db->get_one("SELECT * FROM {$AJ_PRE}mail WHERE itemid=$itemid");
			$r or msg();
			extract($r);
			include tpl('mail_edit', $module);
		}
	break;
	case 'delete':
		$itemid or msg();
		$db->query("DELETE FROM {$AJ_PRE}mail WHERE itemid=$itemid ");
		dmsg('ɾ���ɹ�', '?moduleid='.$moduleid.'&file='.$file);
	break;
	case 'list_delete':
		$itemid or msg();
		$db->query("DELETE FROM {$AJ_PRE}mail_list WHERE itemid=$itemid ");
		dmsg('ɾ���ɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=list');
	break;
	case 'list':
		$sfields = array('������', '�ʼ���ַ', '��Ա��');
		$dfields = array('email', 'email', 'username');
		$dstatus = array('������', '������', '�ѽ��', 'δ���');
		$sorder  = array('�������ʽ', '����ʱ�併��', '����ʱ������', '����ʱ�併��', '����ʱ������');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'edittime DESC', 'edittime ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$typeid = isset($typeid) ? ($typeid === '' ? -1 : intval($typeid)) : -1;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$type_select   = type_select('mail', 1, 'typeid', '��ѡ�����', $typeid);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($typeid > 0) $condition .= " AND typeids LIKE '%,$typeid,%'";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}mail_list WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$lists = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}mail_list WHERE $condition ORDER BY $dorder[$order] LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['edittime'] = timetodate($r['edittime'], 5);
			$typeids = explode(',', substr($r['typeids'], 1, -1));
			$r['type'] = '<select>';
			foreach($typeids as $t) {
				$r['type'] .= '<option'.($t == $typeid ? ' selected' : '').'>'.$TYPE[$t]['typename'].'</option>'; 
			}
			$r['type'] .= '</select>';
			$lists[] = $r;
		}
		include tpl('mail_list', $module);
	break;
	case 'send':
		$itemid or msg();
		if(isset($num)) {
			$m = cache_read($_username.'_mail.php');
		} else {
			$num = 0;
			$m = $db->get_one("SELECT title,content,typeid FROM {$AJ_PRE}mail WHERE itemid=$itemid");
			$m or msg();
			cache_write($_username.'_mail.php', $m);
		}
		$pagesize = 2;
		$offset = ($page-1)*$pagesize;
		$result = $db->query("SELECT email FROM {$AJ_PRE}mail_list WHERE typeids LIKE '%,".$m['typeid'].",%' ORDER BY itemid DESC LIMIT $offset,$pagesize");
		$i = false;
		while($r = $db->fetch_array($result)) {
			send_mail($r['email'], $m['title'], $m['content']);
			$i = true;
			$num++;
		}
		if($i) {
			$page++;
			msg('�ѷ��� '.$num.' ���ʼ���ϵͳ���Զ����������Ժ�...', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&page='.$page.'&itemid='.$itemid.'&num='.$num);
		} else {
			cache_delete($_username.'_mail.php');
			$db->query("UPDATE {$AJ_PRE}mail SET sendtime='$AJ_TIME' WHERE itemid=$itemid");
			msg('�ʼ����ͳɹ� ������ '.$num.' ���ʼ�', '?moduleid='.$moduleid.'&file='.$file, 5);
		}
	break;
	default:
		$typeid = isset($typeid) ? ($typeid === '' ? -1 : intval($typeid)) : -1;
		$type_select = type_select('mail', 1, 'typeid', '��ѡ�����', $typeid);
		$condition = '1';
		if($keyword) $condition .= " AND title LIKE '%$keyword%'";
		if($typeid > 0) $condition .= " AND typeid=$typeid";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}mail WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);	
		$mails = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}mail WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['edittime'] = timetodate($r['edittime'], 5);
			$r['sendtime'] = $r['sendtime'] ? timetodate($r['sendtime'], 5) : '<span style="color:red;">δ����</span>';
			$r['type'] = $r['typeid'] && isset($TYPE[$r['typeid']]) ? set_style($TYPE[$r['typeid']]['typename'], $TYPE[$r['typeid']]['style']) : '<span style="color:red;">δ����</span>';
			$num = $db->get_one("SELECT count(itemid) as num FROM {$AJ_PRE}mail_list WHERE typeids LIKE '%,".$r['typeid'].",%' ");
			$r['num'] = $num['num'];
			$mails[] = $r;
		}
		include tpl('mail', $module);
	break;
}
?>