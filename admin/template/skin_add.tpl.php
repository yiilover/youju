<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;���Ŀ¼</td>
<td><?php echo $skin_path;?></td>
</tr>
<tr>
<td>&nbsp;�ļ���</td>
<td><input type="text" size="20" name="fileid" value=""/>.css ��֧������</td>
</tr>
<tr>
<td colspan="2">
<textarea name="content" style="width:98%;height:300px;font-family:Fixedsys,verdana;overflow:visible;"></textarea>
</td>
</tr>
<tr>
<td colspan="2"><input type="checkbox" name="nowrite" value="1" checked/> �������Ѿ�����,�벻Ҫ����&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="window.history.back(-1);"/>&nbsp;&nbsp;<input type="reset" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="�� С" class="btn" onclick="Zoom('-');"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="Zoom('+');"/></td>
</tr>
</table>
</form>
<br/>
<script type="text/javascript">
function Zoom(t) {
	var h = Dd('content').style.height ? Dd('content').style.height : '300px';
	var n = Number(h.replace('px', ''));
	n = t == '+' ? n+100 : n-100;
	if(n > 100) Dd('content').style.height = n+'px';
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>