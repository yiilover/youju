<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">���ݻ�ת</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ת������</td>
<td class="c_p">
<table cellpadding="3" cellspacing="3" width="100%">
<tr onclick="Dd('t_3').checked=true;">
<td><input type="radio" name="type" value="3" id="t_3"/></td>
<td>
<select name="afid" id="afid">
<option value="0">����</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'article') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
&rarr;
<select name="atid" id="atid" onchange="loadc(this.value);">
<option value="0">����</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'article') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
</td>
</tr>
<tr onclick="Dd('t_4').checked=true;">
<td><input type="radio" name="type" value="4" id="t_4"/></td>
<td>
<select name="ifid" id="ifid">
<option value="0">��Ϣ</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'info') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
&rarr;
<select name="itid" id="itid" onchange="loadc(this.value);">
<option value="0">��Ϣ</option>
<?php
foreach($MODULE as $m) {
	if($m['module'] == 'info') {
		echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
	}
}
?>
</select>
</td>
</tr>
<tr onclick="Dd('t_1').checked=true;loadc(6);">
<td width="20"><input type="radio" name="type" value="1" id="t_1"/></td>
<td><?php echo $MODULE[5]['name'];?> &rarr; <?php echo $MODULE[6]['name'];?></td>
</tr>
<tr onclick="Dd('t_2').checked=true;loadc(5);">
<td><input type="radio" name="type" value="2" id="t_2"/></td>
<td><?php echo $MODULE[6]['name'];?> &rarr; <?php echo $MODULE[5]['name'];?></td>
</tr>
<tr onclick="Dd('t_5').checked=true;loadc(16);">
<td width="20"><input type="radio" name="type" value="5" id="t_5" checked/></td>
<td><?php echo $MODULE[5]['name'];?> &rarr; <?php echo $MODULE[16]['name'];?></td>
</tr>
<tr onclick="Dd('t_6').checked=true;loadc(5);">
<td width="20"><input type="radio" name="type" value="6" id="t_6"/></td>
<td><?php echo $MODULE[16]['name'];?> &rarr; <?php echo $MODULE[5]['name'];?></td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ת������</td>
<td class="f_gray">&nbsp;
<input type="text" name="condition" value="" size="80" id="condition"/>
<br/>
&nbsp;- ���ת�Ƶ�����Ϣ����ֱ����д��ϢID������ <span class="f_blue">123</span><br/>
&nbsp;- ���ת�ƶ�����Ϣ��������,�ָ���ϢID������ <span class="f_blue">123,124,125</span> (��β�Ϳ�ͷ����Ҫ,)<br/>
&nbsp;- ��ֱ��дSQL����������������and��ͷ<br/>
&nbsp;&nbsp;���� <span class="f_blue">and catid=123</span> ��ʾ���÷���IDΪ123����Ϣ<br/>
&nbsp;&nbsp;���� <span class="f_blue">and itemid>0</span> ��ʾ����Դģ��������Ϣ<br/>
&nbsp;&nbsp;���� <span class="f_blue">and price>0</span> ��ʾ�����м۸����Ϣ(һ��Ϊ��Ӧ)<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �·���</td>
<td>&nbsp;
<?php echo ajax_category_select('catid', '��ѡ��', 0, 16, 'size="2" style="height:120px;width:180px;"');?>
<?php tips('���ݽ���ת�Ƶ��˷�����');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ɾ��Դ����</td>
<td>&nbsp;
<input type="radio" name="delete" value="1" id="d_1"/> ��&nbsp;&nbsp;&nbsp;
<input type="radio" name="delete" value="0" id="d_0" checked/> ��
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ע������</td>
<td class="f_gray">
&nbsp;- ת�Ƴɹ��������Ŀ��ģ�͹���������ת�Ƶ���Ϣ�����ģ��������������HTML����Ҫ����һ��<br/>
&nbsp;- ������Ҫ����ϢID���������ſ��Կ�����ת�Ƶ���Ϣ<br/>
&nbsp;- �����ת�Ƶ����ݽ϶࣬��������������ת�ƣ�����ת�Ƴ�����<br/>
</td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td>&nbsp;<input type="submit" name="submit" value="ִ ��" class="btn"/></td> 
</tr>
</table>
</form>
<script type="text/javascript">
function loadc(i) {
	if(i) {
		category_moduleid[1] = i;
		load_category(0, 1);
	}
}
function getid() {
	var mid;
	if(Dd('t_1').checked) {
		mid = 6;
	} else if(Dd('t_2').checked) {
		mid = 5;
	} else if(Dd('t_5').checked) {
		mid = 16;
	} else if(Dd('t_6').checked) {
		mid = 5;
	} else if(Dd('t_3').checked) {
		mid = Dd('atid').value;
		if(mid == 0) {
			alert('��ѡ������Ŀ��ģ��');
			Dd('atid').focus();
			return;
		}
	} else if(Dd('t_4').checked) {
		mid = Dd('itid').value;
		if(mid == 0) {
			alert('��ѡ����ϢĿ��ģ��');
			Dd('itid').focus();
			return;
		}
	} else {
		alert('��ѡ��ת������');
		return;
	}
	window.open('?file=category&mid='+mid);
}
function check() {
	if(Dd('t_1').checked) {
		//
	} else if(Dd('t_2').checked) {
		//
	} else if(Dd('t_5').checked) {
		//
	} else if(Dd('t_6').checked) {
		//
	} else if(Dd('t_3').checked) {
		if(Dd('afid').value == 0) {
			alert('��ѡ��������Դģ��');
			Dd('afid').focus();
			return false;
		}
		if(Dd('atid').value == 0) {
			alert('��ѡ������Ŀ��ģ��');
			Dd('atid').focus();
			return false;
		}
		if(Dd('afid').value == Dd('atid').value) {
			alert('������Դģ�ͺ�Ŀ��ģ�Ͳ�����ͬ');
			Dd('atid').focus();
			return false;
		}
	} else if(Dd('t_4').checked) {
		if(Dd('ifid').value == 0) {
			alert('��ѡ����Ϣ��Դģ��');
			Dd('ifid').focus();
			return false;
		}
		if(Dd('itid').value == 0) {
			alert('��ѡ����ϢĿ��ģ��');
			Dd('itid').focus();
			return false;
		}
		if(Dd('ifid').value == Dd('itid').value) {
			alert('��Ϣ��Դģ�ͺ�Ŀ��ģ�Ͳ�����ͬ');
			Dd('itid').focus();
			return false;
		}
	} else {
		alert('��ѡ��ת������');
		return false;
	}
	if(Dd('condition').value.length < 1) {		
		alert('����дת������');
		Dd('condition').focus();
		return false;
	}
	if(Dd('catid_1').value == 0) {		
		alert('��ѡ���·���');
		return false;
	}
	return confirm('ȷ��Ҫת���𣿴˲��������ɻָ�');
}
</script>
<script type="text/javascript">Menuon(5);</script>
<?php include tpl('footer');?>