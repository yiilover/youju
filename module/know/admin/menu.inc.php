<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menu = array(
	array("���".$name, "?moduleid=$moduleid&action=add"),
	array($name."�б�", "?moduleid=$moduleid"),
	array("���".$name, "?moduleid=$moduleid&action=check"),
	array("���б�", "?moduleid=$moduleid&file=answer"),
	array("�������", "?file=category&mid=$moduleid"),
	array("��������", "?moduleid=$moduleid&file=html"),
	array("ģ������", "?moduleid=$moduleid&file=setting"),
);
?>