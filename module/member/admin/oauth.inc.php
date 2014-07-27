<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('һ����¼', '?moduleid='.$moduleid.'&file=online'),
    array('�ӿ�����', '?moduleid='.$moduleid.'&file=setting&tab=5'),
);
switch($action) {
	case 'delete':
		$itemid or msg('��ѡ���¼');
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$db->query("DELETE FROM {$AJ_PRE}oauth WHERE itemid IN ($itemids)");
		dmsg('����ɹ�', $forward);
	break;
	default:
		$OAUTH = cache_read('oauth.php');
		$sfields = array('������', '��Ա��', '�ǳ�', 'ƽ̨', 'ͷ��', '��ַ');
		$dfields = array('username', 'username', 'nickname', 'site', 'avatar', 'url');
		$sorder  = array('�������ʽ', '��ʱ�併��', '��ʱ������', '��¼ʱ�併��', '��¼ʱ������', '��¼��������', '��¼��������');
		$dorder  = array('itemid DESC', 'addtime DESC', 'addtime ASC', 'logintime DESC', 'logintime ASC', 'logintimes DESC', 'logintimes ASC');
		isset($fields) && isset($dfields[$fields]) or $fields = 0;
		isset($site) or $site = '';
		isset($order) && isset($dorder[$order]) or $order = 0;
		$thumb = isset($thumb) ? intval($thumb) : 0;
		$link = isset($link) ? intval($link) : 0;
		$fields_select = dselect($sfields, 'fields', '', $fields);
		$order_select  = dselect($sorder, 'order', '', $order);
		$condition = '1';
		if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
		if($site) $condition .= " AND site='$site'";		
		if($thumb) $condition .= " AND avatar<>''";
		if($link) $condition .= " AND url<>''";
		$order = $dorder[$order];
		if($page > 1 && $sum) {
			$items = $sum;
		} else {
			$r = $db->get_one("SELECT COUNT(*) AS num FROM {$AJ_PRE}oauth WHERE $condition");
			$items = $r['num'];
		}
		$pages = pages($items, $page, $pagesize);
		$members = array();
		$result = $db->query("SELECT * FROM {$AJ_PRE}oauth WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['logindate'] = timetodate($r['logintime'], 5);
			$r['avatar'] or $r['avatar'] = AJ_PATH.'api/oauth/avatar.png';
			$members[] = $r;
		}
		include tpl('oauth', $module);
	break;
}
?>