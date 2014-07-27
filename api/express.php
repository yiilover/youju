<?php
/*
	[Aijiacms house System] Copyright (c) 2008-2013 Aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
define('AJ_NONUSER', true);
require '../common.inc.php';
function get_express_code($name) {
	#http://code.google.com/p/kuaidi-api/wiki/Open_API_Chaxun_URL
	$name = strtolower($name);
	if(strpos($name, 'ems') !== false) return 'ems';
	if(strpos($name, '˳��') !== false) return 'sf';
	if(strpos($name, '��ͨ') !== false) return 'st';
	if(strpos($name, 'Բͨ') !== false) return 'yt';
	if(strpos($name, '��ͨ') !== false) return 'zt';
	if(strpos($name, 'լ����') !== false) return 'zjs';
	if(strpos($name, '�ϴ�') !== false) return 'yd';
	if(strpos($name, '����') !== false) return 'tt';
	if(strpos($name, '����') !== false) return 'fedex';
	if(strpos($name, '��ͨ') !== false) return 'huitong';
	if(strpos($name, '��ǿ') !== false) return 'huitong';
	return '';
}
$e = isset($e) ? trim($e) : '';
$n = isset($n) ? trim($n) : '';
if($e && $n) {
	$c = get_express_code($e);
	if($c) dheader('http://www.kuaidi100.com/chaxun?com='.$c.'&nu='.$n);
}
dheader('http://www.kuaidi100.com/?nu='.$n);
?>