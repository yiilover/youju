<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
<input type="hidden" name="dfileid" value="<?php echo $fileid;?>"/>
<div class="tt">ģ���޸�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;ģ��·��</td>
<td><?php echo $template_path.$fileid;?>.htm</td>
</tr>
<tr>
<td>&nbsp;ģ������</td>
<td><input type="text" size="20" name="name" value="<?php echo $name;?>"/> <span class="f_gray">����Ϊ����</span></td>
</tr>
<tr>
<td>&nbsp;�ļ���</td>
<td><input type="text" size="20" name="fileid" value="<?php echo $fileid;?>"/>.htm <span class="f_gray">ֻ��ΪСд��ĸ�����֡��л��ߡ��»���</span></td>
</tr>
<tr>
<td colspan="2">
<textarea name="content" id="content" style="width:98%;height:300px;font-family:Fixedsys,verdana;overflow:visible;"><?php echo $content;?></textarea>
</td>
</tr>
<tr>
<td colspan="2"><input type="checkbox" name="backup" value="1"/> ����ʱ������һ�������ļ�&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="Ԥ ��" class="btn" onclick="Preview();"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="if(window.parent.location.href.indexOf('&')==-1){window.history.go(-1);}else{window.parent.cDialog();}"/>&nbsp;&nbsp;<input type="reset" value="�� ��" class="btn"/>&nbsp;&nbsp;<span id="FR" style="display:none;"><input type="button" value="�� ��" class="btn" onclick="RP();"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="FD();"/></span></td>
</tr>
</table>
</form>
<br/>
<form method="post" action="?file=<?php echo $file;?>&action=preview&dir=<?php echo $dir;?>" target="_blank" id="p">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="preview"/>
<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
<input type="hidden" id="pcontent" name="content" value=""/>
</form>
<script type="text/javascript">
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
function Preview() {
	if(Dd('content').value == '') {
		Dtip('ģ������Ϊ��');
	} else {
		Dd('pcontent').value = Dd('content').value;
		Dd('p').submit();
	}
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>