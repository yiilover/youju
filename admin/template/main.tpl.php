<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
?>
<div id="msgbox" onmouseover="closemsg();" style="display:none;"></div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>������ҳ</title>
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
<td><div style="padding:20px 30px 20px 20px;" title="��ǰ�汾V<?php echo AJ_VERSION; ?> ����ʱ��<?php echo AJ_RELEASE;?>"><img src="admin/image/tips_update.gif" width="32" height="32" align="absmiddle"/>&nbsp;&nbsp; <span class="f_red">Ϊ�˱�֤���õ���Ӫ�����뾭��ע������</span>&nbsp;&nbsp;���°汾��V<span id="last_v"><?php echo AJ_VERSION; ?></span> ����ʱ�䣺<span id="last_r"><?php echo AJ_RELEASE; ?></span>&nbsp;&nbsp;
<input type="button" value="������" class="btn" onclick="window.open('http://www.haoid.cn')"> </div></td>
</tr>
</table>
</div>
<div id="wrap">
	<div class="tab">
		<ul>
			<li><a href="javascript:void(0);" class="on" onclick="$('#main-lang-1').toggle();">ϵͳ��Ϣ</a></li>			
		</ul>
	</div>
	<div class="main" id="main-lang-1">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" class="mainlist">
		<tr>
			<td width="47%">����Ա��¼�û�����<?php echo $_username;?> </td>
			<td width="53%">��¼ʱ�䣺 <?php echo timetodate($user['logintime'], 5); ?> </td>
		</tr>
		<tr>
			<td>����������( IP )�� <?php echo strtolower(substr(PHP_OS,0,3))=='win'?'Windows����':'*unix����';?>(<?php echo gethostbyname($_SERVER['SERVER_NAME']);?>:<?php echo $_SERVER["SERVER_PORT"];?>)</td>
			<td>��ǰվ������·���� <?php echo str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);?></td>
		</tr>
		<tr>
			<td>�Ƿ�֧��ͼ�δ��� <?php echo extension_loaded('gd')&&function_exists('imagecreate')?'֧��GDͼ�δ����':'��֧��GDͼ�δ����';?></td>
			<td>������ʱ�䣺 <?php echo timetodate($AJ_TIME, 'Y-m-d H:i:s l');?></td>
		</tr>
		<tr>
			<td>��������Ϣ�� <?php echo PHP_OS.'&nbsp;'.$_SERVER["SERVER_SOFTWARE"];?> [<?php echo gethostbyname($_SERVER['SERVER_NAME']);?>:<?php echo $_SERVER["SERVER_PORT"];?>] <a href="?action=phpinfo" target="_blank">[��ϸ��Ϣ]</a></td>
			<td>PHP �� MySQL�汾��<?php echo 'PHP��'.PHP_VERSION.' &nbsp;/&nbsp;'.$db->version();?></td>
		</tr>
    </table> 	</div>
	<div class="tab">
		<ul>
			<li><a href="javascript:void(0);" class="on" onclick="$('#main-lang-3').toggle();">��Ȩ��Ϣ</a></li>			
		</ul>
	</div>
	<div class="main" id="main-lang-3">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" class="mainlist">
		<tr>
			<td width="14%">�汾��Ϣ�� </td>
			<td width="86%"><span id="copyright" style="color:#FF0000">���ҷ���</span> Version <?php echo AJ_VERSION;?> Release <?php echo AJ_RELEASE;?> <?php echo strtoupper(AJ_CHARSET);?> <?php echo strtoupper(AJ_LANG);?>			
         </td>
		</tr>
		<tr>
			<td>�ٷ���վ�� </td>
			<td><a href="http://www.haoid.cn" target="_blank">տ��������</a>  <a href="http://www.haoid.cn" target="_blank">��վ����Դ</a>  </td>
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