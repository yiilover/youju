<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">�ļ�У��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;�����ļ�</td>
<td>
&nbsp;<input type="submit" name="submit" value="��ʼУ��" class="btn"/>
&nbsp;<input type="submit" name="submit" value="ɾ������" class="btn"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;ѡ��Ŀ¼</td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="dirs[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?>/>&nbsp;<img src="admin/image/dir.gif" width="16" height="16" alt="" align="absmiddle"/> <?php echo $d;?></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;�ļ�����</td>
<td>&nbsp;<input type="text" size="50" name="fileext" value="php|js|htm"/></td>
</tr>
<tr>
<td></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="��������" class="btn"/></td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>