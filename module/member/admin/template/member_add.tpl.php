<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
load('profile.js');
?>
<div class="tt">��Ա���</div>
<form method="post" action="?" onsubmit="return Dcheck();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td>
<input type="radio" name="member[regid]" value="6" id="g_6"onclick="reg(1);" checked/><label for="g_6"> <?php echo $GROUP['6']['groupname'];?></label>&nbsp;&nbsp;&nbsp;&nbsp;
<?php if(is_array($GROUP)) { foreach($GROUP as $k => $v) { ?>
<?php if($k>6 && $v['vip']==0) { ?><input type="radio" name="member[regid]" value="<?php echo $k;?>" id="g_<?php echo $k;?>"onclick="reg(1);"/><label for="g_<?php echo $k;?>"> <?php echo $GROUP[$k]['groupname'];?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
<?php } } ?>
<input type="radio" name="member[regid]" value="5" id="g_5"onclick="reg(0);"/><label for="g_5"> <?php echo $GROUP['5']['groupname'];?></label>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��¼��</td>
<td><input type="text" size="20" name="member[username]" id="username" onblur="validator('username');"/>&nbsp;<span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ͨ��֤�û���</td>
<td><input type="text" size="20" name="member[passport]" id="passport" onblur="validator('passport');"/>&nbsp;<span id="dpassport" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��¼����</td>
<td><input type="password" size="20" name="member[password]" id="password" onblur="validator('password');" autocomplete="off"/>&nbsp;<span id="dpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ظ���������</td>
<td><input type="password" size="20" name="member[cpassword]" id="cpassword" autocomplete="off"/>&nbsp;<span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> Email</td>
<td><input type="text" size="30" name="member[email]" id="email" onblur="validator('email');"/>&nbsp;<span id="demail" class="f_red"></span> <span class="f_gray">[������]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ʵ����</td>
<td><input type="text" size="20" name="member[truename]" id="truename"/>&nbsp;<span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �Ա�</td>
<td>
<input type="radio" name="member[gender]" value="1" checked="checked"/> ����
<input type="radio" name="member[gender]" value="2"/> Ůʿ
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���ڵ���</td>
<td><?php echo ajax_area_select('member[areaid]', '��ѡ��', 0, '', 2);?>&nbsp;<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input type="text" size="20" name="member[department]" id="department"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ְλ</td>
<td><input type="text" size="20" name="member[career]" id="career"/></td>
</tr><tr>
<td class="tl"><span class="f_hid">*</span> �ֻ�����</td>
<td><input type="text" size="20" name="member[mobile]" id="mobile"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td><input type="text" size="20" name="member[qq]" id="qq"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" size="20" name="member[ali]" id="ali"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td><input type="text" size="30" name="member[msn]" id="msn"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td><input type="text" size="20" name="member[skype]" id="skype"/></td>
</tr>
<?php echo $MFD ? fields_html('<td class="tl">', '<td>', array(), $MFD) : '';?>
</table>
<div id="company_detail">
<div class="tt">��˾����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��˾����</td>
<td><input type="text" size="60" name="member[company]" id="company" onblur="validator('company');"/>&nbsp;<span id="dcompany" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��˾����</td>
<td><?php echo dselect($COM_TYPE, 'member[type]', '��ѡ��', '', 'id="type"', 0);?>&nbsp;<span id="dtype" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ͼƬ</td>
<td><input name="member[thumb]" type="text" size="60" id="thumb"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[ɾ��]</span><br/>
<span class="f_gray">����ʹ��LOGO���칫�����ȱ�־��ͼƬ����Ѵ�СΪ<?php echo $MOD['thumb_width'];?>px*<?php echo $MOD['thumb_height'];?>px</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ӫ��ҵ</td>
<td>
<div id="catesch"></div><div id="cate"><?php echo ajax_category_select('', '', 0, 4, 'size="2" style="height:80px;width:160px;"');?></div>
<input type="button" value=" ��ӡ� " class="btn" onclick="addcate(<?php echo $MOD['cate_max'];?>);"/>
<input type="button" value=" ��ɾ�� " class="btn" onclick="delcate();"/>
<?php if($AJ['schcate_limit']) { ?><input type="button" class="btn" value=" ���� " onclick="schcate(4);"/><?php } ?>
&nbsp;������� <strong class="f_red"><?php echo $MOD['cate_max'];?></strong> ����Ӫ��ҵ
<br/><select name="cates" id="cates" size="2" style="height:100px;width:380px;margin-top:5px;">
</select>
<input type="hidden" name="member[catid]" value="" id="catid"/><br/>
<span id="dcatid" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ҫ��Ӫ��Χ</td>
<td><input type="text" size="80" name="member[business]" id="business"/>&nbsp;<span id="dbusiness" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ӫģʽ</td>
<td>
<span id="com_mode"><?php echo dcheckbox($COM_MODE, 'member[mode][]', '', 'onclick="check_mode(this,'.$MOD['mode_max'].');"', 0);?></span> <span class="f_gray">(����ѡ<?php echo $MOD['mode_max'];?>��)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾��ģ</td>
<td><?php echo dselect($COM_SIZE, 'member[size]', '��ѡ���ģ', '', '', 0);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ע���ʱ�</td>
<td><?php echo dselect($MONEY_UNIT, 'member[regunit]', '', '', '', 0);?> <input type="text" size="6" name="member[capital]" id="capital"/> ��</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��˾�������</td>
<td><input type="text" size="15" name="member[regyear]" id="regyear"/>&nbsp;<span id="dregyear" class="f_red"></span> <span class="f_gray">(��ݣ��磺2004)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��˾��ַ</td>
<td><input type="text" size="60" name="member[address]" id="address"/>&nbsp;<span id="daddress" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" size="8" name="member[postcode]" id="postcode"/></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��˾�绰</td>
<td><input type="text" size="20" name="member[telephone]" id="telephone"/>&nbsp;<span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾����</td>
<td><input type="text" size="20" name="member[fax]" id="fax"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾Email</td>
<td><input type="text" size="30" name="member[mail]" id="mail"/> <span class="f_gray">[����]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾��ַ</td>
<td><input type="text" size="30" name="member[homepage]" id="homepage"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���۵Ĳ�Ʒ������</td>
<td><input type="text" size="50" name="member[sell]" id="sell"/> <span class="f_gray">�����Ʒ���������'|'�Ÿ���</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ɹ��Ĳ�Ʒ������</td>
<td><input type="text" size="50" name="member[buy]" id="buy"/> <span class="f_gray">�����Ʒ���������'|'�Ÿ���</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��˾����</td>
<td><textarea name="member[introduce]" id="introduce" class="dsn"></textarea>
<?php echo deditor($moduleid, 'introduce', $MOD['editor'], '95%', 300);?><br/><span id="dintroduce" class="f_red"></span></td>
</tr>
<?php echo $CFD ? fields_html('<td class="tl">', '<td>', array(), $CFD) : '';?>
</table>
</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա�����Ƿ�����</td>
<td>
<input type="radio" name="member[edittime]" value="1"  checked/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[edittime]" value="0"/> ��&nbsp;&nbsp;
<span class="f_gray">���ѡ���ǣ�ϵͳ��������ʾ��Ա��������</span>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
var vid = '';
function validator(id) {
	if(!Dd(id).value) return false;
	vid = id;
	makeRequest('moduleid=<?php echo $moduleid;?>&action=member&job='+id+'&value='+Dd(id).value, AJPath, '_validator');
}

function _validator() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		Dd('d'+vid).innerHTML = xmlHttp.responseText ? '<img src="'+SKPath+'image/check_error.gif" align="absmiddle"/> '+xmlHttp.responseText : '';
	}
}

function reg(type) {
	if(type) {
		Ds('company_detail');
	} else {
		Dh('company_detail');
	}
}
function Dcheck() {
	if(Dd('username').value == '') {
		Dmsg('����д��Ա��¼��', 'username');
		return false;
	}
	if(Dd('password').value == '') {
		Dmsg('����д��Ա��¼����', 'password');
		return false;
	}
	if(Dd('cpassword').value == '') {
		Dmsg('���ظ���������', 'cpassword');
		return false;
	}
	if(Dd('password').value != Dd('cpassword').value) {
		Dmsg('������������벻һ��', 'password');
		return false;
	}
	if(Dd('email').value == '') {
		Dmsg('����д��������', 'email');
		return false;
	}
	if(Dd('truename').value == '') {
		Dmsg('����д��ʵ����', 'truename');
		return false;
	}
	if(Dd('areaid_1').value == 0) {
		Dmsg('��ѡ�����ڵ�', 'areaid');
		return false;
	}
	<?php echo $MFD ? fields_js($MFD) : '';?>
	if(Dd('g_5').checked == false) {
		<?php echo $CFD ? fields_js($CFD) : '';?>
		if(Dd('company').value == '') {
			Dmsg('����д��˾����', 'company');
			return false;
		}
		if(Dd('type').value == '') {
			Dmsg('��ѡ��˾����', 'type');
			return false;
		}
		if(Dd('catid').value.length < 2) {
			Dmsg('��ѡ��˾��Ӫ��ҵ', 'catid');
			return false;
		}
		if(Dd('business').value.length < 2) {
			Dmsg('����д��Ҫ��Ӫ��Χ', 'business');
			return false;
		}
		if(Dd('regyear').value.length < 4) {
			Dmsg('����д��˾�������', 'regyear');
			return false;
		}
		if(Dd('address').value.length < 2) {
			Dmsg('����д��˾��ַ', 'address');
			return false;
		}
		if(Dd('telephone').value.length < 6) {
			Dmsg('����д��˾�绰', 'telephone');
			return false;
		}
		if(FCKLen('introduce') < 5) {
			Dmsg('��˾���ܲ�������5�֣���ǰ�Ѿ�����'+FCKLen('introduce')+'��', 'introduce');
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>