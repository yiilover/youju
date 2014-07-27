<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/admin/config/collectfunction.php';
if ( empty( $config ) || !file_exists( AJ_ROOT."/admin/config/site_".$config.".php" ) )
{
		msg('�òɼ����������ļ�������');
}
include_once( AJ_ROOT."/admin/config/site_".$config.".php" );
$menus = array (
    array('��ӹ���', '?file=collectset&action=add'),
    array('�������', '?file=collectset'),
    array('������', '?file='.$file.'&action=import'),
);
$this_forward = '?file='.$file.'&config='.$config;
$AREA = cache_read('area.php');
$CATEGORY = cache_read('category-'.$myCollect['modid'].'.php');

switch($action) {
	case 'add':
				$tmpary = array( );
				$tmpary['title'] = $title;
				$tmpary['catid'] = $catid;
				$tmpary['areaid'] = $areaid;
				$tmpary['urlpage'] = $urlpage;
				$tmpary['listarea'] = my_stripslashes(trim($_REQUEST['listarea']));
				$tmpary['infoid'] = my_stripslashes(trim($_REQUEST['infoid']));
				$tmpary['nextpageid'] = my_stripslashes(trim($_REQUEST['nextpageid']));
				$tmpary['startpageid'] = $startpageid;
				if ( is_numeric( $maxpagenum ) )
				{
								$tmpary['maxpagenum'] = intval( $maxpagenum );
				}
				else
				{
								$tmpary['maxpagenum'] = 0;
				}
				$myCollect['listcollect'][] = $tmpary;
				my_setconfigs( "site_".$config, "myCollect", $myCollect );
				msg('�����ɼ�������ӳɹ�', $this_forward, 3);
	break;
	case 'edit':
		if($submit) {
				$tmpary = array( );
				$tmpary['title'] = $title;
				$tmpary['catid'] = $catid;
				$tmpary['areaid'] = $areaid;
				$tmpary['urlpage'] = $urlpage;
				$tmpary['listarea'] = my_stripslashes(trim($_REQUEST['listarea']));
				$tmpary['infoid'] = my_stripslashes(trim($_REQUEST['infoid']));
				$tmpary['nextpageid'] = my_stripslashes(trim($_REQUEST['nextpageid']));
				$tmpary['startpageid'] = $startpageid;
				if ( is_numeric( $maxpagenum ) )
				{
								$tmpary['maxpagenum'] = intval( $maxpagenum );
				}
				else
				{
								$tmpary['maxpagenum'] = 0;
				}
				$myCollect['listcollect'][$cid] = $tmpary;
				my_setconfigs( "site_".$config, "myCollect", $myCollect );
				msg('�����ɼ�����༭�ɹ�', $this_forward, 3);
		} else {
				include tpl('collectpage_edit');
		}
	break;
	case 'del':
		if(!empty($config))
		{
				if( isset($cid) && !empty($myCollect['listcollect'][$cid]) )
				{
						unset( $myCollect['listcollect'][$cid] );
						my_setconfigs( "site_".$config, "myCollect", $myCollect );
				}
		}
		msg('�����ɼ�����ɾ���ɹ�', $this_forward, 3);
	break;
	default:
		include tpl('collectpage');
	break;
}
?>