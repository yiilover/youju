<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��ǩ������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><input type="text" name="setting[moduleid]" size="20" id="moduleid" value="<?php echo $mid;?>"/>
<select onchange="mod(this.value);">
<option value="">��ѡ��</option>
<?php foreach($MODULE as $k=>$v) {
	if($k > 4 && !$v['islink']) echo '<option value="'.$k.'"'.($k == $mid ? ' selected' : '').'>'.$v['name'].'</option>';
}
?>
<option value="$moduleid" style="background:blue;">����</option>
</select>
</td>
<td width="100">moduleid</td>
</tr>
<tr id="tr_table" style="display:<?php echo $mid ? 'none' : '';?>">
<td class="tl"><span class="f_hid">*</span> ���ݱ�</td>
<td><input type="text" name="setting[table]" size="20" id="table"/>
<span id="stable"><select onchange="Dd('table').value=this.value;">
<option value="">ѡ���</option>
<?php echo $table_select;?>
</select></span>
<a href="###" onclick="Dict();" class="t">[�����ֵ�]</a>&nbsp;
<a href="###" onclick="Dd('stable').innerHTML=Dd('alltable').value;void(0);" class="t">[��ʾ����]</a>
<?php tips('���ݱ��ǵ������ݵ���Դ<br>ϵͳ�������ͬ���ݿ������������');?>
<textarea style="display:none;" id="alltable">
<select onchange="Dd('table').value=this.value">
<option value="">ѡ���</option>
<?php echo $all_select;?>
</select>
</textarea>
</td>
<td>table</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" name="setting[condition]" size="50" value="1" id="condition"/>
<select onchange="Dd('condition').value=this.value">
<option value="">���õ�������</option>
<option value="1">��������</option>
<option value="status=3">�ѷ�������Ϣ</option>
<option value="status=3 and thumb<>''">��ͼ����Ϣ</option>
<option value="status=3 and vip>0"><?php echo VIP;?>��Ϣ</option>
</select>
<?php tips('SQL����WHERE֮���������䣬1��ʾ��������<br>������Ҫ��MySQL�﷨��һ���˽�');?>
</td>
<td>condition</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input type="text" name="setting[pagesize]" size="10" value="10" id="pagesize"/></td>
<td>pagesize</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ʽ</td>
<td><input type="text" name="setting[order]" size="30" id="order"/>
<select onchange="Dd('order').value=this.value">
<option value="">��������ʽ</option>
<option value="itemid desc">����ϢID����</option>
<option value="edittime desc">���޸�ʱ������</option>
<option value="addtime desc">�����ʱ������</option>
<option value="vip desc">��VIP����</option>
<option value="hits desc">�������������</option>
<option value="rand() desc">���������</option>
</select>
</td>
<td>order</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" name="setting[catid]" size="30" id="catid"/>
<?php if($mid) { ?>
<?php echo ajax_category_select('catids', '���޷���', 0, $mid);?>
<a href="javascript:cat();" class="t">&larr;���</a>
<?php } else { ?>
<span id="scatid"><select onchange="Dd('catid').value=this.value;">
<option value="">���޷���</option>
<option value="$catid">����</option>
</select></span>
<?php } ?>
</td>
<td>catid</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����ӷ���</td>
<td>
<input type="radio" name="setting[child]" value="1" checked/> ��&nbsp;&nbsp;
<input type="radio" name="setting[child]" value="0" id="child"/> ��
</td>
<td>child</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" name="setting[areaid]" size="30" id="areaid"/>
<?php echo ajax_area_select('areaids', '���޵���');?>
<a href="javascript:are();" class="t">&larr;���</a>
</td>
<td>areaid</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����ӵ���</td>
<td>
<input type="radio" name="setting[areachild]" value="1" checked/> ��&nbsp;&nbsp;
<input type="radio" name="setting[areachild]" value="0" id="areachild"/> ��
</td>
<td>areachild</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ʱ��</td>
<td><input type="text" name="setting[expires]" size="10" id="expires"/>
<select onchange="Dd('expires').value=this.value">
<option value="">Ĭ�ϻ���</option>
<option value="-1">������</option>
<option value="-2">SQL����</option>
<option value="600">�Զ���ʱ��(��)</option>
</select>
</td>
<td>expires</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ǩģ��</td>
<td>
<?php echo tpl_select('', 'tag', 'setting[template]', '��ѡ��', '0', 'id="template"');?>
</td>
<td>template</td>
</tr>
<tr>
<td class="tl" height="40">

</td>
<td>
<input type="button" value="���ɱ�ǩ" class="btn" onclick="mk_tag();"/>&nbsp;&nbsp;
<input type="button" value="��������" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
<td> </td>
</table>
<form method="post" action="?" target="aijiacms_tag" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="preview"/>
<input type="hidden" id="tag_expires" name="tag_expires"/>
<div class="tt">��ǩ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> �Զ���CSS</td>
<td><textarea name="tag_css" id="tag_css"  style="width:98%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:green;"></textarea> 
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> HTML��ʼ��ǩ</td>
<td><input type="text" name="tag_html_s" id="tag_html_s" size="30" value="" style="font-family:Fixedsys,verdana;"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ǩ����</td>
<td><textarea name="tag_code" id="tag_code"  style="width:98%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:blue;"></textarea> 
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> JS����</td>
<td><textarea name="tag_js" id="tag_js"  style="width:98%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:#800000;"></textarea> 
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> HTML������ǩ</td>
<td><input type="text" name="tag_html_e" id="tag_html_e" size="10" value="" style="font-family:Fixedsys,verdana;"/></td>
</tr>
<tr>
<td class="tl"></td>
<td>
<input type="submit" name="submit" value="Ԥ����ǩ" class="btn"/>
<input type="button" value="���Ʊ�ǩ" class="btn" onclick="copy_tag();"/>
<input type="button" value="��ձ�ǩ" class="btn" onclick="Dd('tag_code').value='';Dd('tag_js').value='';"/>
<input type="button" value="���CSS" class="btn" onclick="Dd('tag_css').value='';"/>
<input type="button" value="���HTML" class="btn" onclick="Dd('tag_html_s').value='';Dd('tag_html_e').value='';"/>
</td>
</tr>
</table>
</form>
<div class="tt">�����ֲ�</div>
<table cellpadding="2" cellspacing="1" class="tb" style="line-height:200%;">
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><a href="http://help.aijiacms.com/faq/tag.php?tc=client" target="_blank" class="t">http://help.aijiacms.com/faq/tag.php</a><br/>
</td>
</table>
</div>
<script type="text/javascript">
function mk_tag() {
	var tag = js = '';
	if(Dd('moduleid').value == '' && Dd('table').value == '') {
		alert('����ģ�� �� ���ݱ� ����ָ��һ��');
		return false;
	}
	if(Dd('moduleid').value != '') tag += '&moduleid='+Dd('moduleid').value;
	if(Dd('table').value != '') tag += '&table='+Dd('table').value;
	if(Dd('catid').value != '') tag += '&catid='+Dd('catid').value;
	if(Dd('catid').value != '' && Dd('child').checked) tag += '&child=0';
	if(Dd('areaid').value != '') tag += '&areaid='+Dd('areaid').value;
	if(Dd('areaid').value != '' && Dd('areachild').checked) tag += '&areachild=0';
	if(Dd('condition').value != '' && Dd('condition').value != '1') tag += '&condition='+Dd('condition').value;
	if(Dd('pagesize').value == '') {
		alert('����д��������');
		Dd('pagesize').focus();
		return;
	} else {
		tag += '&pagesize='+Dd('pagesize').value;
	}
	if(Dd('order').value != '') tag += '&order='+Dd('order').value;
	if(Dd('template').value != 0) tag += '&template='+Dd('template').value;
	tag = tag.substr(1);
	var rp = false;
	for(var i=0;i<tag.length;i++) {
		if(tag.charAt(i) == '$') {
			js += '{$'
			rp = true;
		} else if(rp && tag.charAt(i) == '&') {
			js += '}&';
			rp = false;
		} else {
			js += tag.charAt(i);
		}
	}
	js = '<script type="text/javascript" charset="<?php echo AJ_CHARSET;?>" src="<?php echo AJ_PATH;?>api/js.php?'+js;
	tag = '<!--{tag("'+tag+'"';
	if(Dd('expires').value != '') {
		tag += ', '+Dd('expires').value;
		js += '&tag_expires='+Dd('expires').value;
	}
	js = js+'"><\/script>';
	tag = tag+')}-->';
	Dd('tag_code').value = tag;
	Dd('tag_js').value = js;
}
function copy_tag() {
	if(!Dd('tag_code').value) return;
	Dd('tag_code').select();
	if(isIE) {
		clipboardData.setData('text', Dd('tag_code').value);
	} else {
		prompt('Press Ctrl+C Copy to Clipboard', Dd('tag_code').value);
	}
}
function check() {
	if(Dd('expires').value != '') Dd('tag_expires').value = Dd('expires').value
	if(Dd('tag_code').value == '') {
		if(confirm('��ǩ������δ���ɣ�����������')) mk_tag();
		return false;
	}
}
function mod(m) {
	if(m == '$moduleid') {
		Dd('moduleid').value = m;
		Dh('tr_table');
		return false;
	}
	if(m == '') {
		Dd('moduleid').value = m;
		Ds('tr_table');
		return false;
	}
	Go('?file=<?php echo $file;?>&mid='+m);
}
function cat() {
	if(Dd('catid_1').value > 0) {
		stoinp(Dd('catid_1').value, 'catid');
	} else {
		Dd('catid').value = '';
	}
}
function are() {
	if(Dd('areaid_1').value > 0) {
		stoinp(Dd('areaid_1').value, 'areaid');
	} else {
		Dd('areaid').value = '';
	}
}
function Dict() {
	if(Dd('moduleid').value == '' && Dd('table').value == '') {
		alert('����ģ�� �� ���ݱ� ����ָ��һ��');
		return false;
	}
	mkDialog('', '<iframe src="?file=tag&action=find&mid='+Dd('moduleid').value+'&tb='+Dd('table').value+'" width="600" height=300" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '�����ֵ�', 620, 0, 0);
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>