<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">�����Ż���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> �Ż���ǰ׺</td>
<td><input name="prefix" id="prefix" type="text" size="20" value="<?php echo $prefix;?>"/> <a href="javascript:" onclick="window.location.reload();" class="t">[ˢ��]</a> <span id="dprefix" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �Ż������</td>
<td><input name="number_part" id="number_part" type="text" size="50" value="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"/>
<select onchange="Dd('number_part').value=this.value">
<option value="0123456789">����</option>
<option value="abcdefghijklmnopqrstuvwxyz">Сд��ĸ</option>
<option value="ABCDEFGHIJKLMNOPQRSTUVWXYZ">��д��ĸ</option>
<option value="0123456789abcdefghijklmnopqrstuvwxyz">���ֺ�Сд��ĸ</option>
<option value="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ" selected>���ֺʹ�д��ĸ</option>
</select>
<span id="dnumber_part" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �Ż��볤��</td>
<td><input name="number_length" id="number_length" type="text" size="20" value="10"/> �Ƽ�8-15λ֮�� <span id="dnumber_length" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �Ż���;</td>
<td>
<input type="radio" name="type" value="0" id="t_0" onclick="Dd('am').innerHTML='<?php echo $AJ['money_unit'];?>';" checked/><label for="t_0"> �ֽ��</label>&nbsp;&nbsp;
<input type="radio" name="type" value="1" id="t_1" onclick="Dd('am').innerHTML='�� <span class=f_gray>��ʹ��ʱ�俪ʼ����</span>';"/><label for="t_1"> ��Ч��</label>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �Żݶ��</td>
<td><input name="amount" id="amount" type="text" size="5" value="30"/> <span id="am"><?php echo $AJ['money_unit'];?></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ч����</td>
<td><?php echo dcalendar('totime', $totime);?> <span id="dtotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ظ�ʹ��</td>
<td><input type="radio" name="reuse" value="1" id="r_1"/><label for="r_1"> ��</label>&nbsp;&nbsp;
<input type="radio" name="reuse" value="0" id="r_0" checked/><label for="r_0"> ��</label></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input name="total" id="total" type="text" size="5" value="100"/> <span id="dtotal" class="f_red"></span></td>
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