<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">����ɼ�������</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="import"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�����ļ�����</td>
<td><textarea class="textarea" name="importtext" id="importtext" rows="20" cols="70"></textarea>  <?php tips('�뽫�������ļ�����ճ�����ı���');?><BR><span id="dimporttext" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">�����벻ͬ�汾</td>
<td>
	<input type="radio" class="radio" name="ignoreversion" value="0" checked="checked" />�� 
	<input type="radio" class="radio" name="ignoreversion" value="1" />��  
	<?php tips('�������Ļ������ܲ��������ݴ���');?>
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'importtext';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д�ɼ��������ļ�����', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(2);</script>
</body>
</html>