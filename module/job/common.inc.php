<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
define('MD_ROOT', AJ_ROOT.'/module/'.$module);
require AJ_ROOT.'/include/module.func.php';
require MD_ROOT.'/global.func.php';
$table = $AJ_PRE.$module;
$table_data = $AJ_PRE.$module.'_data';
$CATEGORY = cache_read('category-'.$moduleid.'.php');
$AREA = cache_read('area.php');
$TYPE = explode('|', trim($MOD['type']));
$GENDER = explode('|', trim($MOD['gender']));
$MARRIAGE = explode('|', trim($MOD['marriage']));
$EDUCATION = explode('|', trim($MOD['education']));
$SITUATION = explode('|', trim($MOD['situation']));
?>