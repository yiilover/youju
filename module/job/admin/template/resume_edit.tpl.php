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
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '����', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>


<tr>
<td class="tl"><span class="f_red">*</span> ��ҵ/ְλ</td>
<td><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '', $catid, $moduleid, 'size="2" style="height:120px;width:180px;"');?><br/><input type="button" value="��������" onclick="schcate(<?php echo $moduleid;?>);" class="btn"/> <span id="dcatid" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��ʵ����</td>
<td><input name="post[truename]" type="text" id="truename" size="20" value="<?php echo $truename;?>"/> <br/><span id="dtruename" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> �����Ƭ</td>
<td><input name="post[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[ɾ��]</span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> �Ա�</td>
<td>
<?php
foreach($GENDER as $k=>$v) {
	if($k == 0) continue;
?>
<input type="radio" name="post[gender]" id="gender_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $gender ? ' checked' : '';?>/><label for="gender_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ����״��</td>
<td>
<?php
foreach($MARRIAGE as $k=>$v) {
	if($k == 0) continue;
?>
<input type="radio" name="post[marriage]" id="marriage_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $marriage ? ' checked' : '';?>/><label for="marriage_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> �־�ס��</td>
<td><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td>
<input name="post[byear]" type="text" id="byear" size="4" value="<?php echo $byear;?>"/> ��
<select name="post[bmonth]">
<?php for($i = 1; $i < 13; $i++) {
	echo '<option value="'.$i.'"'.($i == $bmonth ? ' selected' : '').'>'.$i.'</option>';
}
?>
</select>
��
<select name="post[bday]">
<?php for($i = 1; $i < 32; $i++) {
	echo '<option value="'.$i.'"'.($i == $bday ? ' selected' : '').'>'.$i.'</option>';
}
?>
</select>
��

<span id="dbyear" class="f_red"></span>
</td>
</tr>


<tr>
<td class="tl"><span class="f_hid">*</span> ���</td>
<td><input name="post[height]" type="text" id="height" size="10"  value="<?php echo $height;?>"/> cm <span id="dheight" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input name="post[weight]" type="text" id="weight" size="10" value="<?php echo $weight;?>"/> kg <span id="dweight" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ѧ��</td>
<td>
<?php
foreach($EDUCATION as $k=>$v) {
	if($k == 0) continue;
?>
<input type="radio" name="post[education]" id="education_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $education ? ' checked' : '';?>/><label for="education_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
&nbsp;&nbsp;(����)
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��ҵԺУ</td>
<td><input name="post[school]" type="text" id="school" size="30" value="<?php echo $school;?>"/> <span id="dschool" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ��ѧרҵ</td>
<td><input name="post[major]" type="text" id="major" size="30" value="<?php echo $major;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> רҵ����</td>
<td><input name="post[skill]" type="text" size="50" value="<?php echo $skill;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����ˮƽ</td>
<td><input name="post[language]" type="text"  size="50" value="<?php echo $language;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td>
<?php
foreach($TYPE as $k=>$v) {
?>
<input type="radio" name="post[type]" id="type_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $type ? ' checked' : '';?>/><label for="type_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����н��</td>
<td><input name="post[minsalary]" type="text" id="minsalary" size="6" value="<?php echo $minsalary;?>"/> �� <input name="post[maxsalary]" type="text" id="maxsalary" size="6" value="<?php echo $maxsalary;?>"/> <?php echo $AJ['money_unit'];?>/�� (���������0Ϊ����)</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td>
<input type="text" name="post[experience]"  value="<?php echo $experience;?>" size="4" id="experience"/> &nbsp;&nbsp;�� <span id="dexperience" class="f_red"></span></td>
</tr>

<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>

<tr>
<td class="tl"><span class="f_red">*</span> ���Ҽ���</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��ϵ�ֻ�</td>
<td><input name="post[mobile]" id="mobile" type="text" size="30" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �����ʼ�</td>
<td><input name="post[email]" id="email" type="text" size="30" value="<?php echo $email;?>"/> <span id="demail" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ�绰</td>
<td><input name="post[telephone]" id="telephone" type="text" size="30" value="<?php echo $telephone;?>"/> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ��ַ</td>
<td><input name="post[address]" type="text" size="60" value="<?php echo $address;?>"/></td>
</tr>
<?php if($AJ['im_qq']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td class="tr"><input name="post[qq]" type="text" size="30" value="<?php echo $qq;?>"/></td>
</tr>
<?php } ?>
<?php if($AJ['im_ali']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td class="tr"><input name="post[ali]" type="text" size="30" value="<?php echo $ali;?>"/></td>
</tr>
<?php } ?>
<?php if($AJ['im_msn']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td class="tr"><input name="post[msn]" type="text" size="30" value="<?php echo $msn;?>"/></td>
</tr>
<?php } ?>
<?php if($AJ['im_skype']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td class="tr"><input name="post[skype]" type="text" size="30" value="<?php echo $skype;?>"/></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> ��ְ״̬</td>
<td>
<select name="post[situation]">
<?php
foreach($SITUATION as $k=>$v) {
?>
<option value="<?php echo $k;?>"<?php echo $k == $situation ? ' selected' : ''?>><?php echo $v;?></option> 
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> ͨ��
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> ����
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';"/> �ܾ�
<input type="radio" name="post[status]" value="4" <?php if($status == 4) echo 'checked';?>/> ����
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?>/> ɾ��
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> �ܾ�����</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> �����̶�</td>
<td>
<input type="radio" name="post[open]" value="3" <?php if($open == 3) echo 'checked';?>/> ����
<input type="radio" name="post[open]" value="2" <?php if($open == 2) echo 'checked';?>/> ����վ�ɼ�
<input type="radio" name="post[open]" value="1" <?php if($open == 1) echo 'checked';?>/> �ر�
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> �������</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[����]</a></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> �����շ�</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('�������0��ʾ�̳�ģ�����ü۸�-1��ʾ���շ�<br/>����0�����ֱ�ʾ�����շѼ۸�');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('resume', $module, 'post[template]', 'Ĭ��ģ��', $template, 'id="template"');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">��ҳ�ɱ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> Ŀ����ַ</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" �� ȡ " class="btn"/>&nbsp;&nbsp;<input type="button" value=" ������� " class="btn" onclick="window.open('?file=fetch');"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('����д��������', f);
		return false;
	}
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('��ѡ����ְ��ҵ', 'catid', 1);
		return false;
	}
	f = 'truename';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('����д��ʵ����', f);
		return false;
	}
	f = 'areaid';
	if(Dd(f).value == 0) {
		Dmsg('��ѡ���ס����', f, 1);
		return false;
	}
	f = 'byear';
	if(Dd(f).value.length != 4) {
		Dmsg('����д����', f);
		return false;
	}
	f = 'school';
	if(Dd(f).value.length < 2) {
		Dmsg('����д��ҵԺУ', f);
		return false;
	}
	f = 'experience';
	if(Dd(f).value.length < 1) {
		Dmsg('����д��������', f);
		return false;
	}
	f = 'mobile';
	if(Dd(f).value.length < 7) {
		Dmsg('����д��ϵ�ֻ�', f);
		return false;
	}
	f = 'email';
	if(Dd(f).value.length < 6) {
		Dmsg('����д�����ʼ�', f);
		return false;
	}
	f = 'content';
	l = FCKLen();
	if(l < 5) {
		Dmsg('���Ҽ�������5�֣���ǰ������'+l+'��', f);
		return false;
	}	
	<?php echo $FD ? fields_js() : '';?>
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>