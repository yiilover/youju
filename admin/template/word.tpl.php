<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($submit) { ?>
<div class="tt">����ɹ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> HTML����</td>
<td><textarea name="content" id="content" style="width:600px;height:150px;margin:3px;font-family:Fixedsys,verdana;"><?php echo $content;?></textarea>
</td>
</tr>
<tr>
<td></td>
<td>
<input type="button" value="�� ��" class="btn" onclick="CopyCode();"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>&rand=<?php echo $AJ_TIME;?>');"/>&nbsp;&nbsp;
��ʾ�����ƴ���֮���л��༭����Դ����ģʽ��ճ������
</td>
</tr>
</table>
<div class="tt">Ч��Ԥ��</div>
<div style="padding:10px;background:#FFFFFF;font-size:14px;"><?php echo $content;?></div>
<script type="text/javascript">
function CopyCode() {
	Dd('content').select();
	if(isIE) {
		clipboardData.setData('text', Dd('content').value);
	} else {
		confirm('�����������֧��JS���ƣ��밴Ctrl+C����');
	}
}
</script>
<?php } else { ?>
<div class="tt">ʲô�Ǳ༭���֣�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td style="padding:3px 10px 3px 10px;line-height:22px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����ʹ��word������һƪͼ�Ĳ�ï���ĵ���ͨ����̨����ʱ�������ĵ��������ͼƬ������ֱ��ճ�����༭�������word�ļ��ܷ�ʽ���������ڲ���װ���������£�����ķ���Ŀǰ�޷���Ч�Ľ�������⡣����һ��һ�ŵ��ϴ�ռ�����������ı���ʱ�䡭��<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�༭���ֿ���ͨ�����������������ٽ�������⣺<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1������һ������word�ļ���Ȼ���޸��µ��ļ���ΪӢ�ĺ����ָ�ʽ(ע�⣺���ĵ��ļ��������޷�������ʶ��)�����硰word.doc����<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2��˫�����µ�word�ļ�������ļ���ѡ�����Ϊ����������ѡ����ҳ (*.htm��*.html)����<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3����������word�ļ���Ϊword.doc��ͨ�����󣬻�����һ��word.htm�ļ���һ��word.filesĿ¼��ѡ������ļ���Ŀ¼ѹ��Ϊ.zip��ʽ�ļ����������ϴ���<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;С��ʾ��������ͬ�����Դ����������Ļ����������htm��̬ҳ�棬ԭ������ͬ�ġ�<br/>
</td>
</tr>
</table>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<div class="tt">�ϴ�zipѹ���ļ�</div>
<form method="post" action="?" enctype="multipart/form-data" target="send" onsubmit="return Upcheck();" id="up">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="upload"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ѡ���ļ�</td>
<td>
&nbsp;<input name="uploadfile" id="uploadfile" type="file" size="25" onchange="Upcheck();Dd('up').submit();"/>&nbsp;&nbsp;
<input type="submit" value=" �� �� " class="btn" id="upbtn"/>
</td>
</tr>
</table>
</form>
<div style="display:none;" id="maindiv">
<div class="tt">�ϴ��ɹ�</div>
<form method="post" action="?" onsubmit="return WdCheck();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="word" id="word" value=""/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��ȡ�ļ�</td>
<td>
&nbsp;
<select name="wd_charset" id="wd_charset">
<option value="gbk">GBK����</option>
<option value="utf-8">UTF-8����</option>
</select>&nbsp;
<input name="wd_nr" id="wd_nr" type="checkbox" value="1" checked/> <label for="wd_nr">���˿���</label>&nbsp;
<input name="wd_note" id="wd_note" type="checkbox" value="1" checked/> <label for="wd_note">����ע��</label>&nbsp;
<input name="wd_span" id="wd_span" type="checkbox" value="1" checked/> <label for="wd_span">����span</label>&nbsp;
<input name="wd_style" id="wd_style" type="checkbox" value="1" checked/> <label for="wd_style">����style</label>&nbsp;
<input name="wd_class" id="wd_class" type="checkbox" value="1" checked/> <label for="wd_class">����class</label>&nbsp;
<input type="button" value=" �� ȡ " class="btn" onclick="ReadWord();"/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> HTML����</td>
<td><textarea name="content" id="content" style="width:600px;height:150px;margin:8px;font-family:Fixedsys,verdana;"></textarea>
</td>
</tr>
<tr>
<td></td>
<td><input type="checkbox" name="water" value="1" checked/> ͼƬ���ˮӡ&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" class="btn" id="save"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Ԥ ��" class="btn" onclick="RunCode();"/></td>
</tr>
</table>
</form>
<form method="post" action="?" id="runcode_form" target="_blank">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="run"/>
<input type="hidden" name="code" id="code" value=""/>
<input type="hidden" name="temp" id="temp" value=""/>
</form>
</div>
<script type="text/javascript">
function Upcheck() {
	Dh('maindiv');
	if(Dd('uploadfile').value=='') {
		alert('��ѡ��zip�ļ�');
		return false;
	}
	Dd('upbtn').value = '�ϴ���..';
}
function Upsuccess(s) {
	Ds('maindiv');
	Dd('word').value = s;
	Dd('up').reset();
	Dd('upbtn').value = '�� ��';
	ReadWord();
}
function ReadWord() {
	var p = 'file=<?php echo $file;?>&action=read&word='+Dd('word').value+'&charset='+Dd('wd_charset').value;
	p += '&wd_nr='+(Dd('wd_nr').checked ? 1 : 0);
	p += '&wd_note='+(Dd('wd_note').checked ? 1 : 0);
	p += '&wd_span='+(Dd('wd_span').checked ? 1 : 0);
	p += '&wd_style='+(Dd('wd_style').checked ? 1 : 0);
	p += '&wd_class='+(Dd('wd_class').checked ? 1 : 0);
	makeRequest(p, '?', '_ReadWord');
}
function _ReadWord() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Dd('content').value = xmlHttp.responseText;
		} else {
			alert('��Ǹ����ȡʧ�ܣ�����ѹ�����ڵ�htm�ļ�');
		}
	}
}
function RunCode() {
	if(Dd('content').value == '') {
		if(confirm('����û�ж�ȡ�ļ����Ƿ����ڶ�ȡ��')) ReadWord();
		return false;
	}
	Dd('code').value = Dd('content').value;
	Dd('temp').value = Dd('word').value;
	Dd('runcode_form').submit();
}
function WdCheck() {
	if(Dd('content').value == '') {
		if(confirm('����û�ж�ȡ�ļ����Ƿ����ڶ�ȡ��')) ReadWord();
		return false;
	}
	Dd('save').value = '������..';
}
</script>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>