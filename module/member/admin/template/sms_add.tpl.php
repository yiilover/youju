<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><textarea name="username" id="username" style="width:200px;height:100px;overflow:visible;"><?php echo $username;?></textarea><?php tips('����������ӣ�һ��һ������س�����');?><br/><span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td>
<input name="type" type="radio" value="1" checked/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input name="type" type="radio" value="0"/> �۳�
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input name="amount" id="amount" type="text" size="10"/> �� <span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input name="reason" id="reason" type="text" size="40" value="����"/> <span id="dreason" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ע</td>
<td><input name="note" type="text" size="40" value="�ֹ�"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ע��</td>
<td class="f_red">�˱�һ���ύ�����������޸Ļ�ɾ��������ؽ�������</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	l = Dd(f).value.length;
	if(l < 3) {
		Dmsg('����д��Ա��', f);
		return false;
	}
	f = 'amount';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('����д����', f);
		return false;
	}
	f = 'reason';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('����д����', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>