<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�޸�<?php echo VIP;?></div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><input type="text" size="20" name="vip[username]" id="username" value="<?php echo $username;?>"/> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td>
<?php foreach($GROUP as $g) {
	if($g['vip'] > 0) echo '<input type="radio" name="vip[groupid]" value="'.$g['groupid'].'" '.($groupid == $g['groupid'] ? 'checked' : '').'/> '.$g['groupname'].'&nbsp;';
}
?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ������Ч��</td>
<td><?php echo dcalendar('vip[fromtime]', $fromtime);?> �� <?php echo dcalendar('vip[totime]', $totime);?> <span id="dtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ҵ�����Ƿ�ͨ����֤</td>
<td>
<input type="radio" name="vip[validated]" value="1" <?php if($validated) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="vip[validated]" value="0" <?php if(!$validated) echo 'checked';?>/> ��
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֤���ƻ����</td>
<td><input type="text" name="vip[validator]" size="30" value="<?php echo $validator;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֤����</td>
<td><?php echo dcalendar('vip[validtime]', $validtime);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo VIP;?>ָ������ֵ</td>
<td><input type="text" name="vip[vipr]" size="2" value="<?php echo $vipr;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	if(Dd(f).value == '') {
		Dmsg('����д��Ա��', f);
		return false;
	}
	if(Dd('vipfromtime').value.length != 10 || Dd('viptotime').value.length != 10) {
		Dmsg('��ѡ�������Ч��', 'time', 1);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>