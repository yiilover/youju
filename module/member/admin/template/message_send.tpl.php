<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�����ż�</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td>
<input type="radio" name="message[type]" value="1" onclick="Dd('group').style.display='';Dd('member').style.display='none';" checked id="type_1"/><label for="type_1"> ϵͳȺ��</label>
<input type="radio" name="message[type]" value="0" onclick="Dd('group').style.display='none';Dd('member').style.display='';" id="type_0"/><label for="type_0"> ָ���ռ���</label>
</td>
</tr>
<tr id="group" style="display:;">
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><?php echo group_checkbox('message[groupids][]', '', '2,3,4');?></td>
</tr>
<tr id="member" style="display:none;">
<td class="tl"><span class="f_red">*</span> �ռ���</td>
<td><input type="text" size="50" name="message[touser]" id="touser" value="<?php echo $touser;?>"/>&nbsp;����ռ������ÿո�ָ�</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input type="text" size="50" name="message[title]" id="title"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><textarea name="message[content]" id="content" class="dsn"></textarea>
<?php echo deditor($moduleid, 'content', 'Aijiacms', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
<?php if($touser) { ?>
Dd('type_0').checked = true;
Dd('group').style.display='none';
Dd('member').style.display='';
<?php } ?>
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	f = 'content';
	l = FCKLen();
	if(l < 5) {
		Dmsg('��������5�֣���ǰ������'+l+'��', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>