<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$edition = edition(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<title>�������� - <?php echo $AJ['sitename']; ?> - Powered By ���ҷ���<?php echo $edition;?> V<?php echo AJ_VERSION; ?> R<?php echo AJ_RELEASE;?> <?php echo strtoupper(AJ_CHARSET);?> <?php echo strtoupper(AJ_LANG);?></title>
</head>
<frameset rows="96,*,4" frameborder="no" border="0" framespacing="0">
	<frame src="?action=top" noresize="noresize" id="topFrame" frameborder="0" 
name="topFrame" marginwidth="0" marginheight="0" scrolling="no">
	<frameset rows="*" cols="185,*" id="frame" framespacing="0" frameborder="no" border="0">
		<frame name="left" noresize scrolling="yes" src="?action=left">
		<frame name="main" noresize scrolling="yes" src="?action=main">
	</frameset>
	<frame src="admin/template/bottom.html" noresize="noresize" id="bottomFrame" frameborder="0" name="bottomFrame" marginwidth="0" marginheight="0" scrolling="no">
<noframes>
	<body>��ǰ�������֧�ֿ��!</body>
</noframes>
</frameset>
</html>
