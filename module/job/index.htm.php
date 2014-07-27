<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require_once AJ_ROOT.'/include/post.func.php';
$fileroot = AJ_ROOT.'/'.$MOD['moduledir'].'/';
$filename = $fileroot.$AJ['index'].'.'.$AJ['file_ext'];
if(!$MOD['index_html']) {
	if(is_file($filename)) unlink($filename);
	return false;
}
$maincat = get_maincat(0, $moduleid);
$seo_file = 'index';
include AJ_ROOT.'/include/seo.inc.php';
$aijiacms_task = "moduleid=$moduleid&html=index";
ob_start();
include template('index', $module);
$data = ob_get_contents();
ob_clean();
file_put($filename, $data);
return true;
?>