<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/module/'.$module.'/common.inc.php';
$head_title = lang($L['faq_title'], array($MOD['name']));
include template('faq', $module);
?>