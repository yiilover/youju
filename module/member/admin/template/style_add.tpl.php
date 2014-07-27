<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">��װģ��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ģ�����</td>
<td><?php echo type_select('style', 1, 'post[typeid]', '��ѡ�����', 0, 'id="typeid"');?> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ģ������</td>
<td><input name="post[title]" type="text" id="title" size="30" /> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���Ŀ¼</td>
<td>
<select name="post[skin]" id="skin" onchange="if(this.value){Dskin(this.value);}">
<option value="">��ѡ��</option>
<?php
$d = AJ_ROOT.'/'.$MODULE[4]['moduledir'].'/skin/';
foreach(glob($d.'*') as $v) {
	if(is_dir($v) && is_file($v.'/style.css')) {
		$n = basename($v);
		echo '<option value="'.$n.'">'.$n.'</option>';
	}
}
?>
</select>
<?php tips('���ϴ�Ŀ¼�� ./'.$MODULE[4]['moduledir'].'/skin/ ����Ϊ���֡���ĸ���');?> <span id="dskin" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ģ��Ŀ¼</td>
<td>
<select name="post[template]" id="template">
<option value="">��ѡ��</option>
<?php
$d = AJ_ROOT.'/template/'.$CFG['template'].'/';
foreach(glob($d.'*') as $v) {
	if(is_dir($v) && is_file($v.'/side_search.htm')) {
		$n = basename($v);
		echo '<option value="'.$n.'">'.$n.'</option>';
	}
}
?>
</select>
<?php tips('���ϴ�Ŀ¼�� ./template/'.$CFG['template'].'/ ����Ϊ���֡���ĸ���');?> <span id="dtemplate" class="f_red"></span></td>
</tr> 
<tr>
<td class="tl"><span class="f_hid">*</span> Ԥ��</td>
<td id="preview"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ģ������</td>
<td><input name="post[author]" type="text" size="20" /></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><?php echo group_checkbox('post[groupid][]', '6,7', '1,2,3,4');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �۸�(/��)</td>
<td>
<input name="post[fee]" type="text" size="5" value="0"/>&nbsp;&nbsp;
<input type="radio" name="post[currency]" value="money" checked/> <?php echo $AJ['money_name'];?>&nbsp;&nbsp;
<input type="radio" name="post[currency]" value="credit"/> <?php echo $AJ['credit_name'];?> 
</td>
</tr>
<tr title="�뱣��ʱ���ʽ">
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
function Dskin(i) {
	var nopic = '<?php echo $MODULE[4]['linkurl'];?>image/nothumb.gif';
	Dd('preview').innerHTML = '<img src="<?php echo $MODULE[4]['linkurl'];?>skin/'+i+'/thumb.gif" onerror="this.src=\''+nopic+'\';"/>';
}
Dskin('?');
function check() {
	var f;
	f = 'title';
	if(Dd(f).value == '') {
		Dmsg('����дģ������', f);
		return false;
	}
	f = 'skin';
	if(Dd(f).value == '') {
		Dmsg('��ѡ����', f);
		return false;
	}
	f = 'template';
	if(Dd(f).value == '') {
		Dmsg('��ѡ��ģ��', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>