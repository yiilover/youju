<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>

<form method="post" action="?" onsubmit="return fcheck();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="file_replace"/>
<div class="tt">�����ļ������滻</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ����ϵ��</td>
<td>
<select name="file_pre">
<option value="">ѡ�񱸷��ļ�ϵ��</option>
<?php echo $sql_select;?>
</select> <span id="dfile_pre" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input type="text" name="file_from" value="" size="60" id="file_from"/><br/><span id="dfile_from" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �滻Ϊ </td>
<td><input type="text" name="file_to" value="" size="60" id="file_to"/><br/><span id="dfile_to" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td><input type="submit" name="submit" value="ִ ��" class="btn"/></td> 
</tr>
</table>
</form>

<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">���ݿ������滻</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> �����ֶ�</td>
<td>
<select name="table" onchange="get_fields(this.value);">
<option value="">ѡ���</option>
<?php echo $table_select;?>
</select>
&nbsp;&nbsp;&nbsp;
<span id="fields"><select name="fields" id="fd"><option value="">ѡ���ֶ�</option></select></span> <span id="dfd" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �滻����</td>
<td>
<input name="type" type="radio" value="1" checked id="type" onclick="Dd('adds').style.display='none';Dd('replace').style.display='';"/> ֱ���滻
<input name="type" type="radio" value="2" onclick="Dd('adds').style.display='';Dd('replace').style.display='none';"/> ͷ��׷��
<input name="type" type="radio" value="3" onclick="Dd('adds').style.display='';Dd('replace').style.display='none';"/> β��׷��
</td>
</tr>
<tbody id="replace" style="display:;">
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><textarea name="from" id="from" style="width:500px;height:50px;overflow:visible;"></textarea><br/><span id="dfrom" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �滻Ϊ </td>
<td><textarea name="to" id="to" style="width:500px;height:50px;overflow:visible;"></textarea><br/><span id="dto" class="f_red"></span></td>
</tr>
</tbody>
<tbody id="adds" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> ׷������</td>
<td><textarea name="add" id="add" style="width:500px;height:50px;overflow:visible;"></textarea><br/><span id="dadd" class="f_red"></span></td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> �滻����</td>
<td><input name="conditon" type="text" size="50"/> <span class="f_gray">������MySQL������䣨AND��ͷ��</span></td> 
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td><input type="submit" name="submit" value="ִ ��" class="btn"/></td> 
</tr>
</table>
</form>

<script type="text/javascript">
var vid = '';
function get_fields(tb) {
	if(!tb) return false;
	makeRequest('file=<?php echo $file;?>&action=fields&table='+tb, '?', 'dget_fields')
}
function dget_fields() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) Dd('fields').innerHTML = xmlHttp.responseText;
	}
}
function fcheck() {
	if(Dd('file_pre').value == '') {
		Dmsg('��ѡ�񱸷�ϵ��', 'file_pre');
		return false;
	}
	if(Dd('file_from').value == '') {
		Dmsg('����д��������', 'file_from');
		return false;
	}
	return confirm('��ȷ��Ҫ��ʼ�滻��');
}
function check() {
	if(Dd('fd').value == '') {
		Dmsg('��ѡ�������ֶ�', 'fd');
		return false;
	}
	if(Dd('type').checked) {
		if(Dd('from').value == '') {
			Dmsg('����д��������', 'from');
			return false;
		}
	} else {
		if(Dd('add').value == '') {
			Dmsg('����д׷������', 'add');
			return false;
		}
	}
	return confirm('��Ҫ��ʾ:Ϊ��ֹ����ʧ��������ڲ���֮ǰ��������\n\n�˲������ɻָ�����ȷ��Ҫִ����');
}
</script>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>