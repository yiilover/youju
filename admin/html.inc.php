<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
switch($action) {
	case 'cache':
		cache_clear_tag(1);
		//cache_clear_sql(0);
		cache_clear('php', 'dir', 'tpl');
		cache_clear('cat');
		cache_category();
		cache_clear('area');
		cache_area();
		msg('������³ɹ�', '?file='.$file.'&action=module');
	break;
	case 'all':
		msg('ȫվ���³ɹ�');
	break;
	case 'index':
		tohtml('index');
		msg('��վ��ҳ���ɳɹ�', '?file='.$file.'&action=all');
	break;
	case 'back':
		$moduleids = 0;
		unset($MODULE[1]);
		unset($MODULE[2]);
		$KEYS = array_keys($MODULE);
		foreach($KEYS as $k => $v) {
			if($v == $mid) { $moduleids = $k; break; }
		}
		msg('['.$MODULE[$mid]['name'].'] ���³ɹ�', '?file='.$file.'&action=module&moduleids='.($moduleids+1));
	break;
	case 'module':
		if(isset($moduleids)) {
			unset($MODULE[1]);
			unset($MODULE[2]);
			$KEYS = array_keys($MODULE);
			if(isset($KEYS[$moduleids])) {
				$bmoduleid = $moduleid = $KEYS[$moduleids];
				if(is_file(AJ_ROOT.'/module/'.$MODULE[$moduleid]['module'].'/admin/html.inc.php')) {	
					msg('', '?moduleid='.$moduleid.'&file='.$file.'&action=all&one=1');
				} else {
					msg('['.$MODULE[$bmoduleid]['name'].'] ���³ɹ�', '?file='.$file.'&action='.$action.'&moduleids='.($moduleids+1));
				}
			} else {
				msg('ģ����³ɹ�', '?file='.$file.'&action=index');
			}		
		} else {
			$moduleids = 0;
			msg('��ʼ����ģ��', '?file='.$file.'&action='.$action.'&moduleids='.$moduleids);
		}
	break;
	default:
		msg('���ڿ�ʼ����ȫվ', '?file='.$file.'&action=cache');
	break;
}
?>