<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require MD_ROOT.'/company.class.php';
$do = new company;
$menus = array (
    array($MOD['name'].'�б�', '?moduleid='.$moduleid),
    array('�ƶ�����', '?moduleid='.$moduleid.'&action=move'),
    array(VIP.'����', '?moduleid='.$moduleid.'&file=vip'),
    array('��Ա�б�', '?moduleid=2'),
);
$this_forward = '?moduleid='.$moduleid.'&file='.$file;

if($_catids || $_areaids) {
	if(isset($userid)) $itemid = $userid;
	if(isset($member['areaid'])) $post['areaid'] = $member['areaid'];
	require AJ_ROOT.'/admin/admin_check.inc.php';
}

switch($action) {
	case 'update':
		is_array($userid) or msg('��ѡ��'.$MOD['name']);
		foreach($userid as $v) {
			$do->update($v);
		}
		dmsg('���³ɹ�', $forward);
	break;
	case 'move':
		if($submit) {
			$fromids or msg('����д��ԴID');
			if($toareaid) {
				$db->query("UPDATE {$table} SET areaid=$toareaid WHERE `{$fromtype}` IN ($fromids)");
				$db->query("UPDATE {$AJ_PRE}member SET areaid=$toareaid WHERE `{$fromtype}` IN ($fromids)");
			}
			dmsg('�ƶ��ɹ�', $forward);
		} else {
			$userid = isset($userid) ? implode(',', $userid) : '';
			$menuid = 1;
			include tpl($action, $module);
		}
	break;
	case 'level':
		$userid or msg('��ѡ��'.$MOD['name']);
		$level = intval($level);
		$do->level($userid, $level);
		dmsg('�������óɹ�', $forward);
	break;
	default:
		$sfields = array('������', '��˾��', '��Ա��', '��˾����', '��˾��ģ', '����', '�ɹ�', '��Ӫ��ҵ', '��Ӫģʽ', '�绰', '����',  'Email',  '��ַ',  '�ʱ�', '��ҳ', '���Ŀ¼', 'ģ��Ŀ¼', '��������');
		$dfields = array('keyword', 'company', 'username', 'type', 'size', 'sell', 'buy', 'business', 'mode', 'telephone', 'fax', 'mail', 'address', 'postcode', 'homepage', 'skin', 'template', 'domain');
		$sorder  = array('�������ʽ', VIP.'ָ������', VIP.'ָ������', 'ע����ݽ���', 'ע���������', 'ע���ʱ�����', 'ע���ʱ�����', '����ʼ����', '����ʼ����', '�����������', '�����������','�����������','�����������');
		$dorder  = array('userid DESC', 'vip DESC', 'vip ASC', 'regyear DESC', 'regyear ASC', 'capital DESC', 'capital ASC', 'fromtime DESC', 'fromtime ASC', 'totime DESC', 'totime ASC', 'hits DESC', 'hits ASC');
		$svalid = array('��֤', '��ͨ��' , 'δͨ��');
		$MS = cache_read('module-2.php');
		$modes = explode('|', '��Ӫģʽ|'.$MS['com_mode']);
		$types = explode('|', '��˾����|'.$MS['com_type']);
		$sizes = explode('|', '��˾��ģ|'.$MS['com_size']);
		
		$thumb = isset($thumb) ? intval($thumb) : 0;
		$mincapital = isset($mincapital) ? dround($mincapital) : '';
		$mincapital or $mincapital = '';
		$maxcapital = isset($maxcapital) ? dround($maxcapital) : '';
		$maxcapital or $maxcapital = '';
		$areaid = isset($areaid) ? intval($areaid) : 0;
		isset($mode) && isset($modes[$mode]) or $mode = 0;
		isset($type) && isset($types[$type]) or $type = 0;
		isset($size) && isset($sizes[$size]) or $size = 0;

		$vip = isset($vip) ? ($vip === '' ? -1 : intval($vip)) : -1;
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($order) && isset($dorder[$order]) or $order = 0;
		$groupid = isset($groupid) ? intval($groupid) : 0;
		$valid = isset($valid) ? intval($valid) : 0;
		$level = isset($level) ? intval($level) : 0;
		$uid = isset($uid) ? intval($uid) : '';
		$username = isset($username) ? trim($username) : '';
		isset($fromtime) or $fromtime = '';
		isset($totime) or $totime = '';
		isset($timetype) or $timetype = 'totime';
	
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$level_select = level_select('level', '����', $level);
		$order_select  = dselect($sorder, 'order', '', $order);
		$valid_select = dselect($svalid, 'valid', '', $valid);
		$group_select = group_select('groupid', '��Ա��', $groupid);
		$mode_select = dselect($modes, 'mode', '', $mode);
		$type_select = dselect($types, 'type', '', $type);
		$size_select = dselect($sizes, 'size', '', $size);
	
		$condition = 'groupid>5';
		if($_areaids) $condition .= " AND areaid IN (".$_areaids.")";//CITY
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($groupid) $condition .= " AND groupid=$groupid";
		if($vip > -1) $condition .= " AND vip=$vip";
		if($level) $condition .= " AND level=$level";
		if($valid) $condition .= $valid == 1 ? " AND validated=1" : " AND validated=0";
		if($catid) $condition .= " AND catids LIKE '%,".$catid.",%'";
		if($areaid) $condition .= ($ARE['child']) ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
		if($mode) $condition .= " AND mode LIKE '%$modes[$mode]%'";
		if($type) $condition .= " AND type='$types[$type]'";
		if($size) $condition .= " AND size='$sizes[$size]'";
		if($mincapital) $condition .= " AND capital>$mincapital";
		if($maxcapital) $condition .= " AND capital<$maxcapital";
		if($thumb)  $condition .= " AND thumb<>''";
		if($uid) $condition .= " AND userid=$uid";
		if($username) $condition .= " AND username='$username'";
		if($fromtime) $condition .= " AND $timetype>".(strtotime($fromtime.' 00:00:00'));
		if($totime) $condition .= " AND $timetype<".(strtotime($totime.' 23:59:59'));
		$lists = $do->get_list($condition, $dorder[$order]);
		include tpl('index', $module);
	break;
}
?>