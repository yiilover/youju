<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">���Ͷ���</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<input type="hidden" name="preview" id="preview" value="0"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ������</td>
<td>
	<input type="radio" name="sendtype" value="1" id="s1" onclick="ck(1);"<?php echo $sendtype == 1 ? ' checked' : '';?>/> <label for="s1">��������</label>
	<input type="radio" name="sendtype" value="2" id="s2" onclick="ck(2);"<?php echo $sendtype == 2 ? ' checked' : '';?>/> <label for="s2">��������</label>
	<input type="radio" name="sendtype" value="3" id="s3" onclick="ck(3);"<?php echo $sendtype == 3 ? ' checked' : '';?>/> <label for="s3">�б�Ⱥ��</label>
</td>
</tr>
<tbody id="t1" style="display:;">
<tr>
<td class="tl"><span class="f_red">*</span> ���պ���</td>
<td><input type="text" size="35" name="mobile" value=""/></td>
</tr>
</tbody>
<tbody id="t2" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> ���պ���</td>
<td class="f_gray"><textarea name="mobiles" rows="4" cols="35"><?php echo $mobiles;?></textarea><br/>[һ��һ�����պ���]</td>
</tr>
</tbody>
<tbody id="t3" style="display:none;">
<tr>
<td class="tl"><span class="f_red">*</span> �����б�</td>
<td class="f_red">
<?php
	echo '<select name="mobilelist" id="mobilelist"><option value="0">��ѡ������б�</option>';
	$mails = glob(AJ_ROOT.'/file/mobile/*.txt');
	if($mails) {
		foreach($mails as $m) {
			$tmp = basename($m);
			echo '<option value="'.$tmp.'">'.$tmp.'</option>';
		}
	} else {
		echo '<option value="">�޺����б�</option>';
	}
	echo '</select>';
?>
&nbsp;&nbsp;<a href="javascript:" onclick="if(Dd('mobilelist').value != 0){window.open('file/mobile/'+Dd('mobilelist').value);}else{alert('����ѡ������б�');Dd('mobilelist').focus();}" class="t">[�鿴ѡ��]</a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=make" class="t">[��ȡ�б�]</a>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ÿ�ַ��Ͷ�����</td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" width="250"><textarea name="content" id="content" rows="15" cols="35" onkeyup="S();" onblur="S();"></textarea></td>
<td valign="top" class="f_gray"><br/>
- ��ǰ������<strong id="len1">0</strong>�֣�ǩ��<strong id="len2">0</strong>�֣���<strong id="len3" class="f_red">0</strong>�֣���<strong id="len4" class="f_blue">0</strong>������ (<?php echo $AJ['sms_len'];?>��/��)<br/>
- ���Ϸ�����Ϊϵͳ���㣬ʵ�ʷ�������Ӫ�̷�������Ϊ׼<br/>
- ����֧�ֱ�������Ա���ϱ�����$user����<br/>
- �� {$user[username]} ��ʾ��Ա��<br/>
- �� {$user[company]} ��ʾ��˾��<br/>
- ����Ǹ��ǻ�Ա���Ͷ��ţ��벻Ҫʹ�ñ���<br/>
<?php if(!$AJ['sms'] || !$AJ['sms_uid'] || !$AJ['sms_key']) { ?>
<span class="f_red">- ע�⣺�޷����ͣ�δ���÷��Ͳ���</span> <a href="?file=setting" class="t">�������</a><br/>
<?php } ?>
<span id="dcontent" class="f_red"></span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ǩ��</td>
<td><input type="text" size="35" name="sign" id="sign" value="<?php echo $AJ['sms_sign'];?>" onkeyup="S();" onblur="S();"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn" onclick="Dd('preview').value=0;this.form.target='';"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value=" Ԥ �� " class="btn" onclick="Dd('preview').value=1;this.form.target='_blank';"/></div>
</form>
<script type="text/javascript">
var sms_len = <?php echo $AJ['sms_len'];?>;
function S() {
	var sms_sign = Dd('sign').value;
	var len_1 = Dd('content').value.length;
	var len_2 = sms_sign.length;
	Dd('len1').innerHTML = len_1;
	Dd('len2').innerHTML = len_2;
	Dd('len3').innerHTML = len_1+len_2;
	Dd('len4').innerHTML = Math.ceil((len_1+len_2)/sms_len);
}
S();
var i = 1;
function ck(id) {
	Dd('t'+i).style.display='none';
	Dd('t'+id).style.display='';
	i = id;
}
ck(<?php echo $sendtype;?>);
function check() {
	var l;
	var f;
	f = 'content';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('���ݲ���Ϊ��', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>