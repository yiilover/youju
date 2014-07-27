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
<div class="tt"><?php echo $action == 'add' ? '���' : '�޸�';?>����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ����ģ��</td>
<td>
<input type="radio" name="post[mid]" value="6" id="m_6"<?php if($mid == 6) echo ' checked';?>/><label for="m_5"> �·�</label>

<input type="radio" name="post[mid]" value="5" id="m_5"<?php if($mid == 5) echo ' checked';?>/><label for="m_5"> �۷�</label>
<input type="radio" name="post[mid]" value="7" id="m_7"<?php if($mid == 7) echo ' checked';?>/><label for="m_5"> �ⷿ</label>
<input type="radio" name="post[mid]" value="6" id="m_6"<?php if($mid == 16) echo ' checked';?>/><label for="m_6"> ��</label>
<input type="radio" name="post[mid]" value="4" id="m_4"<?php if($mid == 4) echo ' checked';?>/><label for="m_4"> ��˾</label>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ؼ���</td>
<td><input type="text" size="20" name="post[word]" id="word" value="<?php echo $word;?>"/> <span id="dword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input type="text" size="20" name="post[price]" id="price" value="<?php echo $price;?>"/> <span id="dprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��λ</td>
<td>
<input type="radio" name="post[currency]" value="money" <?php if($currency == 'money') echo 'checked';?>/> <?php echo $AJ['money_name'];?>&nbsp;
<input type="radio" name="post[currency]" value="credit" <?php if($currency == 'credit') echo 'checked';?>/> <?php echo $AJ['credit_name'];?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ϢID</td>
<td><input type="text" size="10" name="post[tid]" id="key_id" value="<?php echo $tid;?>" onfocus="Sid();"/> <a href="javascript:Sid();" class="t">ѡ��..</a> <span id="dkey_id" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> Ͷ��ʱ��</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> �� <?php echo dcalendar('post[totime]', $totime);?> <span id="dtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա����</td>
<td><input type="text" size="20" name="post[username]" id="username" value="<?php echo $username;?>"/> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> ͨ��&nbsp;
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> ����
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ע����</td>
<td><input type="text" size="60" name="post[note]" value="<?php echo $note;?>"/></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function Sid() {
	if(Dd('m_4').checked) {
		select_item('4&itemid='+Dd('key_id').value);
	} else if(Dd('m_5').checked) {
		select_item('5&itemid='+Dd('key_id').value);
	} else if(Dd('m_6').checked) {
		select_item('6&itemid='+Dd('key_id').value);
	}
}
function check() {
	var l;
	var f;
	f = 'word';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('������ؼ���', f);
		return false;
	}
	f = 'price';
	l = Dd(f).value.length;
	if(l < 1) {
		Dmsg('����д����', f);
		return false;
	}
	f = 'key_id';
	l = Dd(f).value.length;
	if(l < 1) {
		Dmsg('����д��ϢID', f);
		return false;
	}	
	if(Dd('postfromtime').value.length != 10 || Dd('posttotime').value.length != 10) {
		Dmsg('��ѡ��Ͷ��ʱ��', 'time');
		return false;
	}
	f = 'username';
	l = Dd(f).value.length;
	if(l < 3) {
		Dmsg('����д��Ա����', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>