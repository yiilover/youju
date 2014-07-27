<?php
define('AJ_NONUSER', true);
require 'common.inc.php';
if($AJ_BOT) dhttp(403);
require AJ_ROOT.'/include/post.func.php';
if(preg_match("/^[a-z0-9]{1}[a-z0-9_\-]{0,}[a-z0-9]{1}$/", $action)) @include AJ_ROOT.'/api/ajax/'.$action.'.inc.php';
?>