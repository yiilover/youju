<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('IP��ֹ', '?file='.$file),
    array('��չ���', '?file='.$file.'&action=clear'),
    array('��¼����', '?file='.$file.'&action=ban'),
);
switch($action) {
	case 'add':
		if(!$ip) msg('����дIP��ַ��IP��');
		$ip = trim($ip);
		if(!preg_match("/^[0-9]{1,3}\.[0-9\*]{1,3}\.[0-9\*]{1,3}\.[0-9\*]{1,3}$/", $ip)) msg('IP��ַ��IP�θ�ʽ����');
		$totime = $todate ? strtotime($todate.' 00:00:00') : 0;
		$db->query("INSERT INTO {$AJ_PRE}banip (ip,editor,addtime,totime) VALUES ('$ip','$_username','$AJ_TIME','$totime')");
		dmsg('��ӳɹ�', '?file='.$file);
	break;
	case 'delete':
		$itemid or msg();
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$AJ_PRE}banip WHERE itemid IN ($itemids)");
		dmsg('ɾ���ɹ�', '?file='.$file);
	break;
	case 'clear':
		$db->query("DELETE FROM {$AJ_PRE}banip WHERE totime>0 and totime<$AJ_TIME");
		dmsg('��ճɹ�', '?file='.$file);
	break;
	case 'unban':
		$ip or msg('IP����Ϊ��');
		if(is_array($ip)) {
			foreach($ip as $v) {
				file_del(AJ_CACHE.'/ban/'.$v.'.php');
			}
		} else {
			file_del(AJ_CACHE.'/ban/'.$ip.'.php');
		}
		dmsg('ɾ���ɹ�', '?file='.$file.'&action=ban');
	break;
	case 'ban':
		$ips = glob(AJ_CACHE.'/ban/*.php');
		$lists = array();
		if($ips) {
			foreach($ips as $k=>$v) {
				$lists[$k]['ip'] = basename($v, '.php');
				$lists[$k]['addtime'] = timetodate(filemtime($v), 5);
			}
		}
		include tpl('banip_ban');
	break;
	default:
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}banip");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);
		$lists = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}banip ORDER BY itemid DESC LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$r['status'] = ($r['totime'] && $AJ_TIME >  $r['totime']) ? '<span style="color:red;">����</span>' : '<span style="color:blue;">��Ч</span>';
			$r['totime'] = $r['totime'] ? timetodate($r['totime'], 3) : '����';
			$lists[] = $r;
		}
		cache_banip();
		include tpl('banip');
	break;
}
?>