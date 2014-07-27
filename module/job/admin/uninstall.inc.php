<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$db->query("DROP TABLE IF EXISTS `".$AJ_PRE.$module."`");
$db->query("DROP TABLE IF EXISTS `".$AJ_PRE.$module."_data`");
$db->query("DROP TABLE IF EXISTS `".$AJ_PRE.$module."_apply`");
$db->query("DROP TABLE IF EXISTS `".$AJ_PRE.$module."_talent`");
$db->query("DROP TABLE IF EXISTS `".$AJ_PRE."resume`");
$db->query("DROP TABLE IF EXISTS `".$AJ_PRE."resume_data`");
?>