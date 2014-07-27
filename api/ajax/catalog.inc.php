<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$mid = isset($mid) ? intval($mid) : 0;
$mid or exit;
isset($MODULE[$mid]) or exit;
include template('catalog', 'chip');
?>