<?php
defined('IN_AIJIACMS') or exit('Access Denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo AJ_CHARSET;?>"/>
<title>�������� - <?php echo $AJ['sitename']; ?> - Powered By aijiacms V<?php echo AJ_VERSION; ?> R<?php echo AJ_RELEASE;?></title>
<meta name="generator" content="aijiacms,www.aijiacms.com"/>
<link rel="stylesheet" href="admin/image/style.css" type="text/css"/>
<?php if(!AJ_DEBUG) { ?><script type="text/javascript">window.onerror= function(){return true;}</script><?php } ?>
<script type="text/javascript" src="lang/<?php echo AJ_LANG;?>/lang.js"></script>
<script type="text/javascript" src="file/script/config.js"></script>
<script type="text/javascript" src="file/script/common.js"></script>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
<td class="side" title="����ر�/�򿪲���" onclick="s();">
<div id="side" class="side_on">&nbsp;</div>
</td>
</tr>
</table>
<script type="text/javascript">
function s() {
	if(Dd('side').className == 'side_on') {
		Dd('side').className = 'side_off';
		top.document.getElementsByName("fra")[0].cols = '0,7,*';
	} else {
		Dd('side').className = 'side_on';
		top.document.getElementsByName("fra")[0].cols = '<?php echo $AJ['admin_left'];?>,7,*';
	}
}
</script>
<?php if($_admin == 1 && !is_file(AJ_ROOT.'/file/md5/'.AJ_VERSION.'.php')) { ?>
<script type="text/javascript" src="?file=md5&action=add&js=1"></script>
<?php } ?>
</body>
</html>