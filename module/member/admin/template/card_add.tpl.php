<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">���ɳ�ֵ��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ���</td>
<td><input name="amount" id="amount" type="text" size="10" value="100"/> <span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ǰ׺ </td>
<td><input name="prefix" id="prefix" type="text" size="20" value="<?php echo $prefix;?>"/> <a href="javascript:" onclick="window.location.reload();" class="t">[ˢ��]</a> <span id="dprefix" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �������</td>
<td><input name="number_part" id="number_part" type="text" size="50" value="0123456789"/>
<select onchange="Dd('number_part').value=this.value">
<option value="0123456789">����</option>
<option value="abcdefghijklmnopqrstuvwxyz">Сд��ĸ</option>
<option value="ABCDEFGHIJKLMNOPQRSTUVWXYZ">��д��ĸ</option>
<option value="0123456789abcdefghijklmnopqrstuvwxyz">���ֺ�Сд��ĸ</option>
<option value="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ">���ֺʹ�д��ĸ</option>
</select>
<span id="dnumber_part" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���ų���</td>
<td><input name="number_length" id="number_length" type="text" size="20" value="10"/> �Ƽ�8-15λ֮�� <span id="dnumber_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���볤��</td>
<td><input name="password_length" id="password_length" type="text" size="20" value="8"/> 6λ���� <span id="dpassword_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ч����</td>
<td><?php echo dcalendar('totime', $totime);?>  <span id="dtotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input name="total" id="total" type="text" size="10" value="100"/> <span id="dtotal" class="f_red"></span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	return confirm('ȷ��Ҫ������');
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>