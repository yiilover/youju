<?php
defined('IN_AIJIACMS') or exit('Access Denied');

// ��ע��������Ƿ�ͨfopen����
function  log_result($word) {
	return;
    $fp = fopen("log.txt","a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,"ִ�����ڣ�".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}



?>