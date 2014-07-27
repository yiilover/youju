<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menus = array (
    array('������ҳ', '?moduleid='.$moduleid.'&file='.$file),
    array('һ������', '?moduleid='.$moduleid.'&file='.$file.'&action=all'),
    array('ģ����ҳ', $MOD['linkurl'], ' target="_blank"'),
);
$all = (isset($all) && $all) ? 1 : 0;
$one = (isset($one) && $one) ? 1 : 0;
$this_forward = '?moduleid='.$moduleid.'&file='.$file;
switch($action) {
	case 'all':
		msg('', '?moduleid='.$moduleid.'&file='.$file.'&action=show&update=1&all=1&one='.$one);
	break;
	case 'index':
		tohtml('index', $module);
		$all ? msg($MOD['name'].'��ҳ���ɳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=list&all=1&one='.$one) : dmsg($MOD['name'].'��ҳ���ɳɹ�', $this_forward);
	break;
	case 'list':
		if(!$MOD['list_html']) {
			$all ? msg($MOD['name'].'�б����ɳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=show&all='.$all.'&one='.$one) : msg($MOD['name'].'�б����ɳɹ�', $this_forward);
		}
		$CATEGORY = cache_read('category-'.$moduleid.'.php');
		if(isset($catids)) {
			$KEYS = array_keys($CATEGORY);
			$sid = 0;
			$fid = $catids;
			isset($tid) or $tid = count($KEYS);
			if(isset($KEYS[$catids])) {
				$bcatid = $catid = $KEYS[$catids];
				$CAT = get_cat($catid);
				$total = max(ceil($CAT['item']/$MOD['pagesize']), 1);
				$num = 50;
				$bfid = $fid;
				isset($fpage) or $fpage = 1;
				if($fpage <= $total) {
					$fid = $fpage;
					tohtml('list', $module);
					$fid = $bfid;
					msg($MOD['name'].' ['.$CATEGORY[$bcatid]['catname'].'] ��'.$fpage.'ҳ����'.($fpage+$num-1).'ҳ���ɳɹ�'.progress($sid, $fid, $tid), '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catids='.$catids.'&tid='.$tid.'&all='.$all.'&one='.$one.'&fpage='.($fpage+$num));
				}
				msg($MOD['name'].' ['.$CATEGORY[$bcatid]['catname'].'] ���ɳɹ�'.progress($sid, $fid, $tid), '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catids='.($catids+1).'&tid='.$tid.'&all='.$all.'&one='.$one);
			} else {
				$all ? msg($MOD['name'].'�б����ɳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action=show&all='.$all.'&one='.$one) : msg($MOD['name'].'�б����ɳɹ�', $this_forward);
			}		
		} else {
			$catids = 0;
			msg('', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catids='.$catids.'&all='.$all.'&one='.$one);
		}
	break;
	case 'show':
		$update = (isset($update) && $update) ? 1 : 0;
		if(!$update && !$MOD['show_html']) {
			if($one) dheader( '?file=html&action=back&mid='.$moduleid);
			$all ? msg($MOD['name'].'���ɳɹ�', $this_forward) : dmsg($MOD['name'].'���ɳɹ�', $this_forward);
		}
		$catid = isset($catid) ? intval($catid) : '';
		$sql = $catid ? " AND catid=$catid" : '';
		if(!isset($fid)) {
			$r = $db->get_one("SELECT min(itemid) AS fid FROM {$table} WHERE status>2 AND islink=0 {$sql}");
			$fid = $r['fid'] ? $r['fid'] : 0;
		}
		isset($sid) or $sid = $fid;
		if(!isset($tid)) {
			$r = $db->get_one("SELECT max(itemid) AS tid FROM {$table} WHERE status>2 AND islink=0 {$sql}");
			$tid = $r['tid'] ? $r['tid'] : 0;
		}
		if($update) {
			require MD_ROOT.'/info.class.php';
			$do = new info($moduleid);
		}
		isset($num) or $num = 100;
		if($fid <= $tid) {
			$result = $db->query("SELECT itemid FROM {$table} WHERE status>2 AND islink=0 AND itemid>=$fid {$sql} ORDER BY itemid LIMIT 0,$num ");
			if($db->affected_rows($result)) {
				while($r = $db->fetch_array($result)) {
					$itemid = $r['itemid'];
					$update ? $do->update($itemid) : tohtml('show', $module);
				}
				$itemid += 1;
			} else {
				$itemid = $fid + $num;
			}
		} else {
			if($update) {
				$all ? msg('', '?moduleid='.$moduleid.'&file='.$file.'&action=index&all=1&one='.$one) : dmsg('���³ɹ�', $this_forward);
			} else {
				if($one) dheader( '?file=html&action=back&mid='.$moduleid);
				$all ? msg($MOD['name'].'���ɳɹ�', $this_forward) : dmsg($MOD['name'].'���ɳɹ�', $this_forward);
			}
		}
		msg('ID��'.$fid.'��'.($itemid-1).$MOD['name'].($update ? '����' : '����').'�ɹ�'.progress($sid, $fid, $tid), "?moduleid=$moduleid&file=$file&action=$action&sid=$sid&fid=$itemid&tid=$tid&num=$num&update=$update&all=$all&one=$one");
	break;
	case 'cate':
		$catid or msg('��ѡ�����');
		isset($num) or $num = 50;
		isset($fid) or $fid = 1;
		$total = max(ceil($CAT['item']/$MOD['pagesize']), 1);
		if($fpage && $tpage) {
			$fid = $fpage;
			$num = $tpage - $fpage + 1;
			tohtml('list', $module);
			dmsg('���ɳɹ�', $this_forward);
		}
		if($fid <= $total) {
			tohtml('list', $module);
			msg('��'.$fid.'ҳ����'.($fid+$num-1).'ҳ���ɳɹ�', '?moduleid='.$moduleid.'&file='.$file.'&action='.$action.'&catid='.$catid.'&fid='.($fid+$num).'&num='.$num.'&fpage='.$fpage.'&tpage='.$tpage);
		} else {
			dmsg('���ɳɹ�', $this_forward);
		}
	break;
	case 'item':
		$catid or msg('��ѡ�����');
		msg('', '?moduleid='.$moduleid.'&file='.$file.'&action=show&catid='.$catid.'&num='.$num);
	break;
	default:
		$r = $db->get_one("SELECT min(itemid) AS fid,max(itemid) AS tid FROM {$table} WHERE status=3");
		$fid = $r['fid'] ? $r['fid'] : 0;
		$tid = $r['tid'] ? $r['tid'] : 0;
		include tpl('html', $module);
	break;
}
?>