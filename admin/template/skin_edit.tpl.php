<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="dfileid" value="<?php echo $fileid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">����޸�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;���·��</td>
<td><?php echo $skin_path.$fileid;?>.css</td>
</tr>
<tr>
<td>&nbsp;�ļ���</td>
<td><input type="text" size="20" name="fileid" value="<?php echo $fileid;?>"/>.css ��֧������</td>
</tr>
<tr>
<td colspan="2">
<textarea name="content" style="width:98%;height:300px;font-family:Fixedsys,verdana;overflow:visible;"><?php echo $content;?></textarea>
</td>
</tr>
<tr>
<td colspan="2"><input type="checkbox" name="backup" value="1"/> ����ʱ����һ������&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="history.back(-1);"/>&nbsp;&nbsp;<input type="reset" value="�� ��" class="btn"/>&nbsp;&nbsp;<span id="FR" style="display:none;"><input type="button" value="�� ��" class="btn" onclick="RP();"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="FD();"/></span></td>
</tr>
</table>
</form>
<br/><script type="text/javascript">
if(isIE) Ds('FR');
function FD(ff) {
	var f = ff ? ff : prompt('����д��Ҫ���ҵ��ַ�', '');
	if(f) {
		var r = Dd('content').createTextRange();
		var b = r.findText(f);
		if(b) { 
			r.select(); return b; 
		} else {
			if(!ff) confirm('û�в��ҵ� '+f);
		}
	}
}
function RP() {
	var f = prompt('����д��Ҫ���ҵ��ַ�', '');
	var p = prompt('����д��Ҫ�滻���ַ�', '');
	if(f && p) {
		while(FD(f)) {
			Dd('content').focus();
			var r = document.selection.createRange(); 
			if(r.text.length <= 0) continue;
			r.text = p;
		}
		confirm(f+'�Ѿ��滻Ϊ'+p);
		FD(p);
	}
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>