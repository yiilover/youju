<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">�޸����� </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td class="tr"><input type="text" size="20" name="post[truename]" id="truename" value="<?php echo $truename;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td class="tr"><input type="text" size="20" name="post[username]" id="username" value="<?php echo $username;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾����</td>
<td class="tr"><input type="text" size="40" name="post[company]" id="company" value="<?php echo $company;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ְλ</td>
<td class="tr"><input type="text" size="20" name="post[career]" id="career" value="<?php echo $career;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �绰</td>
<td class="tr"><input type="text" size="20" name="post[telephone]" id="telephone" value="<?php echo $telephone;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ֻ�</td>
<td class="tr"><input type="text" size="20" name="post[mobile]" id="mobile" value="<?php echo $mobile;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ҳ</td>
<td class="tr"><input type="text" size="40" name="post[homepage]" id="homepage" value="<?php echo $homepage;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Email</td>
<td class="tr"><input type="text" size="30" name="post[email]" id="email" value="<?php echo $email;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td class="tr"><input type="text" size="20" name="post[qq]" id="qq" value="<?php echo $qq;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td class="tr"><input type="text" size="20" name="post[ali]" id="ali" value="<?php echo $ali;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td class="tr"><input type="text" size="30" name="post[msn]" id="msn" value="<?php echo $msn;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td class="tr"><input type="text" size="20" name="post[skype]" id="skype" value="<?php echo $skype;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ע</td>
<td class="tr"><input type="text" size="40" name="post[note]" id="note" value="<?php echo $note;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('truename').value == '') {
		Dmsg('����д����', 'truename');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>