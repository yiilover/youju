<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
<div class="tt">ģ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;ģ��Ŀ¼</td>
<td><?php echo $template_path;?></td>
</tr>
<tr>
<td>&nbsp;ģ������</td>
<td><input type="text" size="20" name="name" value="<?php if(isset($type)) echo $type;?>"/> <span class="f_gray">����Ϊ����</span></td>
</tr>
<tr>
<td>&nbsp;�ļ���</td>
<td><input type="text" size="20" name="fileid" value="<?php if(isset($type)) echo $type.'-';?>"/>.htm <span class="f_gray">ֻ��ΪСд��ĸ�����֡��л��ߡ��»���</span></td>
</tr>
<tr>
<td colspan="2">
<textarea name="content" id="content"  style="width:98%;height:300px;font-family:Fixedsys,verdana;overflow:visible;"><?php echo $content;?></textarea>
</td>
</tr>
<tr>
<td colspan="2"><input type="checkbox" name="nowrite" value="1" checked/> ���ģ���Ѿ�����,�벻Ҫ����&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="Ԥ ��" class="btn" onclick="Preview();"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="window.history.go(-1);"/>&nbsp;&nbsp;<input type="reset" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="�� С" class="btn" onclick="Zoom('-');"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="Zoom('+');"/></td>
</tr>
</table>
</form>
<br/>
<form method="post" action="?" target="_blank" id="p">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="preview"/>
<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
<input type="hidden" id="pcontent" name="content" value=""/>
</form>
<script type="text/javascript">
function Zoom(t) {
	var h = Dd('content').style.height ? Dd('content').style.height : '300px';
	var n = Number(h.replace('px', ''));
	n = t == '+' ? n+100 : n-100;
	if(n > 100) Dd('content').style.height = n+'px';
}
function Preview() {
	if(Dd('content').value == '') {
		Dtip('ģ������Ϊ��');
	} else {
		Dd('pcontent').value = Dd('content').value;
		Dd('p').submit();
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>