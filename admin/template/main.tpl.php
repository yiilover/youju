<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
?>
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理首页</title>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="stylesheet" type="text/css" href="admin/template/css/style.css" />
<script type="text/javascript" src="images/js/jquery.min.js"></script>
<script type="text/javascript" src="file/script/common.js"></script>
<script type="text/javascript" src="file/script/config.js"></script>
</head>
<body oncontextmenu="return false" ondragstart="return false" onSelectStart="return false">
<div id="tips_update">

<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td><div style="padding:20px 30px 20px 20px;" title="当前版本V<?php echo AJ_VERSION; ?> 更新时间<?php echo AJ_RELEASE;?>"><img src="admin/image/tips_update.gif" width="32" height="32" align="absmiddle"/>&nbsp;&nbsp; <span class="f_red">为了保证更好的运营程序，请经常注意升级</span>&nbsp;&nbsp;最新版本：V<span id="last_v"><?php echo AJ_VERSION; ?></span> 更新时间：<span id="last_r"><?php echo AJ_RELEASE; ?></span>&nbsp;&nbsp;
<input type="button" value="检查更新" class="btn" onclick="window.open('http://www.haoid.cn')"> </div></td>
</tr>
</table>
</div>
<div id="wrap">
	<div class="tab">
		<ul>
			<li><a href="javascript:void(0);" class="on" onclick="$('#main-lang-1').toggle();">系统信息</a></li>			
		</ul>
	</div>
	<div class="main" id="main-lang-1">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" class="mainlist">
		<tr>
			<td width="47%">管理员登录用户名：<?php echo $_username;?> </td>
			<td width="53%">登录时间： <?php echo timetodate($user['logintime'], 5); ?> </td>
		</tr>
		<tr>
			<td>服务器主机( IP )： <?php echo strtolower(substr(PHP_OS,0,3))=='win'?'Windows主机':'*unix主机';?>(<?php echo gethostbyname($_SERVER['SERVER_NAME']);?>:<?php echo $_SERVER["SERVER_PORT"];?>)</td>
			<td>当前站点物理路径： <?php echo str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);?></td>
		</tr>
		<tr>
			<td>是否支持图形处理： <?php echo extension_loaded('gd')&&function_exists('imagecreate')?'支持GD图形处理库':'不支持GD图形处理库';?></td>
			<td>服务器时间： <?php echo timetodate($AJ_TIME, 'Y-m-d H:i:s l');?></td>
		</tr>
		<tr>
			<td>服务器信息： <?php echo PHP_OS.'&nbsp;'.$_SERVER["SERVER_SOFTWARE"];?> [<?php echo gethostbyname($_SERVER['SERVER_NAME']);?>:<?php echo $_SERVER["SERVER_PORT"];?>] <a href="?action=phpinfo" target="_blank">[详细信息]</a></td>
			<td>PHP 和 MySQL版本：<?php echo 'PHP：'.PHP_VERSION.' &nbsp;/&nbsp;'.$db->version();?></td>
		</tr>
    </table> 	</div>
	<div class="tab">
		<ul>
			<li><a href="javascript:void(0);" class="on" onclick="$('#main-lang-3').toggle();">版权信息</a></li>			
		</ul>
	</div>
	<div class="main" id="main-lang-3">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" class="mainlist">
		<tr>
			<td width="14%">版本信息： </td>
			<td width="86%"><span id="copyright" style="color:#FF0000">爱家房产</span> Version <?php echo AJ_VERSION;?> Release <?php echo AJ_RELEASE;?> <?php echo strtoupper(AJ_CHARSET);?> <?php echo strtoupper(AJ_LANG);?>			
         </td>
		</tr>
		<tr>
			<td>官方网站： </td>
			<td><a href="http://www.haoid.cn" target="_blank">湛江房产网</a>  <a href="http://www.haoid.cn" target="_blank">好站长资源</a>  </td>
		</tr>
	</table>
	</div>
</div>
<script type="text/javascript">
var aijiacms_release = 20131029;
var aijiacms_version = 6.1;
if(typeof aijiacms_lastrelease != 'undefined') {
	var lastrelease = parseInt(aijiacms_lastrelease.replace('-', '').replace('-', ''));
	if(aijiacms_lastversion >= aijiacms_version && aijiacms_release < lastrelease) {
		Dd('tips_update').style.display = '';
		Dd('last_v').innerHTML = aijiacms_lastversion;
		Dd('last_r').innerHTML = aijiacms_lastrelease;
	}
}
</script>
</body>
</html>
?