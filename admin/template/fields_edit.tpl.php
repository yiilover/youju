<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="tb" value="<?php echo $tb;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="post[cname]" value="<?php echo $name;?>"/>
<div class="tt">�޸��ֶ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> �ֶ�</td>
<td><input name="post[name]" type="text" id="name" size="20" value="<?php echo $name;?>"/>
<span id="dname" class="f_red"></span>
Сд��ĸ(a-z),����(0-9) �Ƽ�ʹ����ĸ,���������ֿ�ͷ
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ֶ�����</td>
<td><input name="post[title]" type="text" id="title" size="20" value="<?php echo $title;?>"/> <?php tips('����ʹ������');?> 
<span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ʾ��Ϣ</td>
<td><input name="post[note]" type="text" id="note" size="50" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ֶ�����</td>
<td>
<select name="post[type]" onchange="dtype(this.value)">
<option value="varchar"<?php echo $type == 'varchar' ? ' selected' : '';?>>�ַ�(Varchar)</option>
<option value="int"<?php echo $type == 'int' ? ' selected' : '';?>>����(Int)</option>
<option value="float"<?php echo $type == 'float' ? ' selected' : '';?>>С��(Float)</option>
<option value="text"<?php echo $type == 'text' ? ' selected' : '';?>>�ı�(Text)</option>
</select>
</td>
</tr>
<tr id="tr_length" style="display:">
<td class="tl"><span class="f_hid">*</span> �ֶγ���</td>
<td><input name="post[length]" type="text" id="length" size="20" value="<?php echo $length;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ������</td>
<td>
<select name="post[html]" onchange="dhtml(this.value)">
<option value="text"<?php echo $html == 'text' ? ' selected' : '';?>>�����ı�(text)</option>
<option value="textarea"<?php echo $html == 'textarea' ? ' selected' : '';?>>�����ı�(textarea)</option>
<option value="select"<?php echo $html == 'select' ? ' selected' : '';?>>������(select)</option>
<option value="radio"<?php echo $html == 'radio' ? ' selected' : '';?>>��ѡ��(radio)</option>
<option value="checkbox"<?php echo $html == 'checkbox' ? ' selected' : '';?>>��ѡ��(checkbox)</option>
<option value="hidden"<?php echo $html == 'hidden' ? ' selected' : '';?>>������(hidden)</option>
<option value="date"<?php echo $html == 'date' ? ' selected' : '';?>>����ѡ��</option>
<option value="thumb"<?php echo $html == 'thumb' ? ' selected' : '';?>>����ͼ�ϴ�</option>
<option value="file"<?php echo $html == 'file' ? ' selected' : '';?>>�ļ��ϴ�</option>
<option value="editor"<?php echo $html == 'editor' ? ' selected' : '';?>>��ҳ�༭��</option>
<option value="area"<?php echo $html == 'area' ? ' selected' : '';?>>����ѡ��</option>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Ĭ��ֵ</td>
<td>
<textarea name="post[default_value]" style="width:250px;height:40px;overflow:visible;"><?php echo $default_value;?></textarea>
<br/>֧��PHP���������� $_username
</td>
</tr>
<tr id="tr_option" style="display:<?php echo in_array($html, array('select', 'radio', 'checkbox')) ? '' : 'none';?>">
<td class="tl"><span class="f_hid">*</span> ѡ��ֵ</td>
<td>
<textarea name="post[option_value]" style="width:250px;height:80px;overflow:visible;"><?php echo $option_value;?></textarea><br/>
һ��һ�� ѡ��ֵ|ѡ������* ע��*Ϊ��β��־��
</td>
</tr>
<tr id="tr_wh" style="display:<?php echo in_array($html, array('thumb', 'editor')) ? '' : 'none';?>">
<td class="tl"><span class="f_hid">*</span> Ĭ�Ͽ��</td>
<td><input name="post[width]" type="text" id="width" size="5" value="<?php echo $width;?>"/> X <input name="post[height]" type="text" id="height" size="5" value="<?php echo $height;?>"/> </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input name="post[input_limit]" type="text" id="input_limit" size="40" value="<?php echo $input_limit;?>"/>
<select onchange="dlimit(this.value)">
<option value="">������</option>
<option value="notnull">����Ϊ��</option>
<option value="numeric">������</option>
<option value="letter">����ĸ</option>
<option value="nl">�����ֺ���ĸ</option>
<option value="email">��E-mail��ַ</option>
<option value="date">�����ڸ�ʽ</option>
</select><br/>
ֱ�������ֱ�ʾ������С����,���Ҫ���Ƴ��ȷ�Χ����6��20֮��,����д 6-20<br/>
����ֱ����д����js��php��������ʽ<br/>
���ڵ�ѡ��(radio),���0���ֱ�ʾ��ѡ<br/>
���ڶ�ѡ��(checkbox),���0���ֱ�ʾ��ѡ���� ��ȷ�Χ��ʾ��ѡ������Χ<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td>
<input name="post[addition]" type="text" size="60" value="<?php echo $addition;?>" id="addition"/> <?php tips('������ӱ����ԡ�JS�¼���CSS��ʽ ����е�������� \\');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ֱ����ʾ</td>
<td>
<input type="radio" name="post[display]" value="1"<?php echo $display ? ' checked' : '';?>/> ��
<input type="radio" name="post[display]" value="0"<?php echo !$display ? ' checked' : '';?>/> �� <?php tips('���ѡ��񣬿����ֶ������ֶμ��뵽��Ӧ��ģ���ļ��ϵͳ����ֱ����ʾ');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ǰ̨��ʾ</td>
<td>
<input type="radio" name="post[front]" value="1"<?php echo $front ? ' checked' : '';?>/> ��
<input type="radio" name="post[front]" value="0"<?php echo !$front ? ' checked' : '';?>/> �� <?php tips('���ѡ���ǣ������ǰ̨��ʾ����Ա�����޸�');?>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"/></div>
</form>
<script type="text/javascript">
function dhtml(id) {
	if(id == 'select' || id == 'radio' || id == 'checkbox') {
		Dd('tr_option').style.display = '';
		Dd('tr_wh').style.display = 'none';		
	} else if(id == 'thumb' || id == 'editor') {
		Dd('tr_option').style.display = 'none';
		Dd('tr_wh').style.display = '';
	} else {
		Dd('tr_option').style.display = 'none';
		Dd('tr_wh').style.display = 'none';
	}
	if(id == 'text') {
		Dd('addition').value = 'size="30"';
	} else if(id == 'textarea') {
		Dd('addition').value = 'rows="5" cols="80"';
	} else {
		Dd('addition').value = '';
	}
}
Dd('addition').value = '<?php echo $addition;?>';
function dtype(id) {
	if(id == 'varchar') {
		Dd('tr_length').style.display = '';
		Dd('length').value = '255';
	} else if(id == 'int') {
		Dd('tr_length').style.display = '';
		Dd('length').value = '10';
	} else if(id == 'float') {
		Dd('tr_length').style.display = 'none';
		Dd('length').value = '';
	} else if(id == 'text') {
		Dd('tr_length').style.display = 'none';
		Dd('length').value = '';
	}
}
function dlimit(id) {
	if(id == 'notnull') {
		Dd('input_limit').value = '1';
	} else if(id == 'numeric') {
		Dd('input_limit').value = '[0-9]{1,}';
	} else if(id == 'letter') {
		Dd('input_limit').value = '[a-z]{1,}';
	} else if(id == 'nl') {
		Dd('input_limit').value = '[a-z0-9]{1,}';
	} else if(id == 'email') {
		Dd('input_limit').value = 'is_email';
	} else if(id == 'date') {
		Dd('input_limit').value = 'is_date';
	} else {
		Dd('input_limit').value = '';
	}
}
function check() {
	if(Dd('name').value == '') {
		Dmsg('����д�ֶ�', 'name');
		return false;
	}
	if(Dd('title').value == '') {
		Dmsg('����д�ֶ�����', 'title');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>