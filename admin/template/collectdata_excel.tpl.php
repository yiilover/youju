<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();" enctype="multipart/form-data">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="excelimport"/>
<div class="tt">��EXCEL���е�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr id="p_0">
<td class="tl">ѡ��ģ��</td>
<td>
<select name="moduleid" id="moduleid">
<option value="0">��ѡ��</option>
<?php foreach($modules as $v) {?>
<option value="<?php echo $v['moduleid'];?>"><?php echo $v['modulename'];?></option>
<?php }?>
</select>
<span id="dmoduleid" class="f_red"></span>
</td>
</tr>
<tr id="p_0">
<td class="tl">EXCEL��</td>
<td>
<input type="file" name="excel" id="excel" size="60" value="" />
<span id="dexcel" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"> </td>
<td height="30"><input type="submit" value="�ύ" class="btn"/></td>
</tr>
</table>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'moduleid';
	l = $(f).value;
	if(l == 0) {
		Dmsg('��ѡ��һ��ģ��', f);
		return false;
	}
	f = 'excel';
	l = $(f).value;
	if(l == 0) {
		Dmsg('��ѡ��һ��EXCEL�ļ�', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $m;?>);</script>
</body>
</html>