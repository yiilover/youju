<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�޸�ģ��</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="edit"/>
<input type="hidden" name="modid" value="<?php echo $modid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ģ������</td>
<td class="f_red"><?php echo $islink ? '�ⲿ����' : '����ģ��('.$modulename.$module.')'?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ģ������</td>
<td><input name="post[name]" type="text" id="name" size="10" value="<?php echo $name;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����˵�</td>
<td><input type="radio" name="post[ismenu]" value="1"  <?php if($ismenu) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[ismenu]" value="0"  <?php if(!$ismenu) echo 'checked';?>/> ��</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �´��ڴ�</td>
<td><input type="radio" name="post[isblank]" value="1"  <?php if($isblank) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[isblank]" value="0"  <?php if(!$isblank) echo 'checked';?>/> ��</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����LOGO</td>
<td><input type="radio" name="post[logo]" value="1"  <?php if($logo) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="post[logo]" value="0"  <?php if(!$logo) echo 'checked';?>/> �� <?php tips('���ѡ���ǣ��뽫LOGOͼƬ����Ϊlogo_'.$modid.'.gif<br/>�ϴ���skin/'.$CFG['skin'].'/image/Ŀ¼');?></td>
</tr>
<?php if($islink) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ӵ�ַ</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="40" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��װĿ¼</td>
<td><input name="post[moduledir]" type="text" id="moduledir" size="30"  value="<?php echo $moduledir;?>"/> <input type="button" class="btn" value="Ŀ¼���" onclick="ckDir();"><?php tips('��Ӣ�ġ����֡��л��ߡ��»���');?> <span id="dmoduledir" class="f_red"></span>
<br/>��ʾ:�������ʮ�ֱ�Ҫ�����鲻ҪƵ�����İ�װĿ¼
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><input name="post[domain]" type="text" id="domain" size="30"  value="<?php echo $domain;?>"/><?php tips('����http://sell.aijiacms.com/,�� / ��β<br/>�������������д');?></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">
function ckDir() {
	if(Dd('moduledir').value == '') {
		Dalert('����д��װĿ¼');
		Dd('moduledir').focus();
		return false;
	}
	var url = '?file=module&action=ckdir&moduledir='+Dd('moduledir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	var l;
	var f;
	f = 'name';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('����дģ������', f);
		return false;
	}
<?php if($islink) { ?>
	f = 'linkurl';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('����д���ӵ�ַ', f);
		return false;
	}
<?php } else { ?>
	f = 'moduledir';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('����д��װĿ¼', f);
		return false;
	}
<?php } ?>
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>