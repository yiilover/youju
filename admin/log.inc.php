<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('������־', '?file='.$file),
    array('��־����', '?file='.$file.'&action=delete', 'onclick="if(!confirm(\'Ϊ��ϵͳ��ȫ,ϵͳ��ɾ��90��֮ǰ����־\')) return false"'),
);
switch($action) {
	case 'delete':
		$time = $today_endtime - 90*86400;
		$db->query("DELETE FROM {$AJ_PRE}admin_log WHERE logtime<$time");
		dmsg('����ɹ�', '?file='.$file);
	break;
	default:
		$sfields = array('������', '��ַ', '����Ա', 'IP');
		$dfields = array('qstring', 'qstring', 'username', 'ip');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		$ip = isset($ip) ? $ip : '';
		$username = isset($username) ? $username : '';
		$fromdate = isset($fromdate) ? $fromdate : '';
		$fromtime = is_date($fromdate) ? strtotime($fromdate.' 0:0:0') : 0;
		$todate = isset($todate) ? $todate : '';
		$totime = is_date($todate) ? strtotime($todate.' 23:59:59') : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($fromtime) $condition .= " AND logtime>$fromtime";
		if($totime) $condition .= " AND logtime<$totime";
		if($ip) $condition .= " AND ip='$ip'";
		if($username) $condition .= " AND username='$username'";
		if($page > 1 && $sum) {
			$items = $sum;
		} else {	
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}admin_log WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);		
		$lists = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}admin_log WHERE $condition ORDER BY logid DESC LIMIT $offset,$pagesize");
		$F = array(
			'index' => '�б�',
			'setting' => '����',
			'category' => '��Ŀ����',
			'type' => '�������',
			'keylink' => '��������',
			'split' => '���ݲ��',
			'html' => '��������',
			'mymenu' => '�������',
			'module' => 'ģ�����',
			'area' => '��������',
			'admin' => '����Ա����',
			'html' => '����ȫվ',
			'database' => '���ݿ�',
			'template' => 'ģ�����',
			'tag' => '��ǩ��',
			'skin' => '������',
			'scan' => 'ľ��ɨ��',
			'log' => '��̨��־',
			'upload' => '�ϴ���¼',
			'404' => '404��־',
			'keyword' => '������¼',
			'question' => '������֤',
			'banword' => '�������',
			'repeat' => '�������',
			'banip' => '��ֹIP',
			'fetch' => '��ҳ�ɱ�',
			'contact' => '��ϵ��Ա',
			'grade' => '��Ա����',
			'group' => '��Ա��',
			'vip' => VIP.'����',
			'credit' => '��������',
			'news' => '��˾����',
			'link' => '��������',
			'style' => '��˾ģ��',
			'record' => '�ʽ����',
			'credits' => '���ֹ���',
			'charge' => '��ֵ��¼',
			'trade' => '���׼�¼',
			'cash' => '���ּ�¼',
			'pay' => '��Ϣ֧��',
			'card' => '��ֵ��',
			'promo' => '�Ż���',
			'ask' => '�ͷ�����',
			'validate' => '������֤',
			'sendmail' => '�����ʼ�',
			'sms' => '�ֻ�����',
			'alert' => 'ó������',
			'mail' => '�ʼ�����',
			'message' => 'վ���ż�',
			'favorite' => '�̻��ղ�',
			'friend' => '��Ա����',
			'loginlog' => '��¼��־',
			'spread' => '�����ƹ�',
			'ad' => '������',
			'announce' => '�������',
			'webpage' => '��ҳ����',
			'comment' => '���۹���',
			'guestbook' => '���Թ���',
			'vote' => 'ͶƱ����',
		);
		$A = array(
			'add' => '���',
			'edit' => '�޸�',
			'delete' => '<span class="f_red">ɾ��</span>',
			'check' => '���',
			'level' => '����',
			'order' => '����',
			'update' => '����',
			'send' => '����',
		);
		while($r = $db->fetch_array($result)) {
			parse_str($r['qstring'], $t);
			$m = isset($t['moduleid']) ? $t['moduleid'] : 1;
			$r['mid'] = $m;
			$r['module'] = $MODULE[$m]['name'];
			$f = isset($t['file']) ? $t['file'] : 'index';
			if(isset($F[$f])) $f = $F[$f];
			$r['file'] = $f;
			$a = isset($t['action']) ? $t['action'] : '';
			if(isset($A[$a])) $a = $A[$a];
			$r['action'] = $a;
			$i = isset($t['itemid']) ? $t['itemid'] : (isset($t['userid']) ? $t['userid'] : '');
			$r['itemid'] = $i;
			$r['logtime'] = timetodate($r['logtime'], 6);
			$lists[] = $r;
		}
		include tpl('log');
	break;
}
?>