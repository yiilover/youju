<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo AJ_CHARSET; ?>" />
<meta name="robots" content="noindex,nofollow"/>
<title>��ʾ��Ϣ - Powered By aijiacms <?php echo AJ_VERSION; ?></title>
<link rel="stylesheet" href="admin/image/msg.css" type="text/css" />
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/script/config.js"></script>
<script type="text/javascript">try {document.execCommand("BackgroundImageCache", false, true);} catch(e) {}</script>
</head>
<body onkeydown="if(event.keyCode==13) window.history.back();">
<table cellpadding="0" cellspacing="0" width="400"  align="center">
<tr>
<td height="150"></td>
</tr>
<tr>
<td>
	<div class="msg">
		<div class="head"><div class="mr">&nbsp;</div><div class="ml">��ʾ��Ϣ</div></div>
		<div class="content">
		<?php echo $msg; ?>
		<div>
		<?php if($forward == "goback") { ?>
		<a href="javascript:window.history.back();">[ �����ﷵ����һҳ ]</a><br/>
		<?php  } elseif ($forward) {?>
		<a href="<?php echo $forward;?>">������������û���Զ���ת����������</a><br/>
		<meta http-equiv="refresh" content="<?php echo $time;?>;URL=<?php echo $forward;?>">
		<?php } ?>
		</div>
		</div>
	</div>
</td>
</tr>
</table>
<?php include tpl('footer');?>