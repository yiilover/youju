<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�޸�����</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> �µ�¼����</td>
<td><input type="password" name="password" size="30" id="password" autocomplete="off"/> <span id="dpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ظ�������</td>
<td><input type="password" name="cpassword" size="30" id="cpassword" autocomplete="off"/> <span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input type="password" name="oldpassword" size="30" id="oldpassword" autocomplete="off"/> <span id="doldpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> </td>
<td><input type="submit" name="submit" value="�� ��" class="btn"/></td>
</tr>
</form>
</table>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'password';
	l = Dd(f).value.length;
	if(l < 6) {
		Dmsg('�µ�¼��������6λ����ǰ������'+l+'λ', f);
		return false;
	}
	f = 'cpassword';
	l = Dd(f).value;
	if(l != Dd('password').value) {
		Dmsg('�ظ����������µ�¼���벻һ��', f);
		return false;
	}
	f = 'oldpassword';
	l = Dd(f).value.length;
	if(l < 6) {
		Dmsg('������������6λ����ǰ������'+l+'λ', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>