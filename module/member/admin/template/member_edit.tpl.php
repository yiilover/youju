<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
load('profile.js');
?>
<div class="tt">��Ա�����޸�</div>
<form method="post" action="?" onsubmit="return Dcheck();" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="username" value="<?php echo $username;?>"/>
<input type="hidden" name="gid" value="<?php echo $groupid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="member[regid]" value="<?php echo $regid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��Աͷ��</td>
<td><img src="<?php echo useravatar($username, 'large');?>" style="margin:6px;"/></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��¼��</td>
<td><strong><?php echo $username;?></strong>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&username=<?php echo urlencode($username);?>&catid=1#editusername" class="t">[�޸Ļ�Ա��]</a></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ͨ��֤����</td>
<td><input type="text" size="30" name="member[passport]" id="passport" value="<?php echo $passport;?>"/>&nbsp;<span id="dpassport" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><?php echo group_select('member[groupid]', '��Ա��', $groupid, 'id="groupid"');?>&nbsp;<span id="dgroupid" class="f_red"></span></td>
</tr>
<?php if($userid != $_userid || $_founder) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��¼����</td>
<td><input type="password" size="20" name="member[password]" id="password" onblur="validator('password');" autocomplete="off"/>&nbsp;<span id="dpassword" class="f_red"></span> <span class="f_gray">�粻����,������</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ظ���������</td>
<td><input type="password" size="20" name="member[cpassword]" id="cpassword" autocomplete="off"/>&nbsp;<span id="dcpassword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ֧������</td>
<td><input type="password" size="20" name="member[payword]" id="payword" onblur="validator('payword');" autocomplete="off"/>&nbsp;<span id="dpayword" class="f_red"></span> <span class="f_gray">�粻����,������</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ظ�֧������</td>
<td><input type="password" size="20" name="member[cpayword]" id="cpayword" autocomplete="off"/>&nbsp;<span id="dcpayword" class="f_red"></span></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> Email</td>
<td><input type="text" size="30" name="member[email]" id="email" value="<?php echo $email;?>" onblur="validator('email');"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vemail ? 'v' : 'u';?>_email.gif" width="16" height="16" title="<?php echo $vemail ? '��ͨ��' : 'δͨ��';?>�ʼ���֤" align="absmiddle"/></a>&nbsp;<span id="demail" class="f_red"></span> <span class="f_gray">[������]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ʵ����</td>
<td><input type="text" size="10" name="member[truename]" id="truename" value="<?php echo $truename;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vtruename ? 'v' : 'u';?>_truename.gif" width="16" height="16" title="<?php echo $vtruename ? '��ͨ��' : 'δͨ��';?>ʵ����֤" align="absmiddle"/></a>&nbsp;<span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �Ա�</td>
<td>
<input type="radio" name="member[gender]" value="1" <?php if($gender == 1) echo 'checked="checked"';?>/> ����
<input type="radio" name="member[gender]" value="2" <?php if($gender == 2) echo 'checked="checked"';?>/> Ůʿ
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���ڵ���</td>
<td><?php echo ajax_area_select('member[areaid]', '��ѡ��', $areaid);?>&nbsp;<span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input type="text" size="20" name="member[department]" id="department" value="<?php echo $department;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ְλ</td>
<td><input type="text" size="20" name="member[career]" id="career" value="<?php echo $career;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ֻ�����</td>
<td><input type="text" size="20" name="member[mobile]" id="mobile" value="<?php echo $mobile;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vmobile ? 'v' : 'u';?>_mobile.gif" width="16" height="16" title="<?php echo $vmobile ? '��ͨ��' : 'δͨ��';?>�ֻ���֤" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td><input type="text" size="20" name="member[qq]" id="qq" value="<?php echo $qq;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" size="20" name="member[ali]" id="ali" value="<?php echo $ali;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td><input type="text" size="30" name="member[msn]" id="msn" value="<?php echo $msn;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td><input type="text" size="20" name="member[skype]" id="skype" value="<?php echo $skype;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> վ������ʾ��</td>
<td class="tr">
<div id="audition"></div>
<input type="radio" name="member[sound]" value="0" <?php if($sound==0) { ?>checked="checked"<?php } ?> id="sound_0"/><label for="sound_0"> ��</label>&nbsp;&nbsp;
<input type="radio" name="member[sound]" value="1" <?php if($sound==1) { ?>checked="checked"<?php } ?> id="sound_1"/> <a href="javascript:Inner('audition', sound('message_1'));Dd('sound_1').checked=true;void(0);" title="�������">��ʾ��1</a>&nbsp;&nbsp;
<input type="radio" name="member[sound]" value="2" <?php if($sound==2) { ?>checked="checked"<?php } ?> id="sound_2"/> <a href="javascript:Inner('audition', sound('message_2'));Dd('sound_2').checked=true;void(0);" title="�������">��ʾ��2</a>&nbsp;&nbsp;
<input type="radio" name="member[sound]" value="3" <?php if($sound==3) { ?>checked="checked"<?php } ?> id="sound_3"/> <a href="javascript:Inner('audition', sound('message_3'));Dd('sound_3').checked=true;void(0);" title="�������">��ʾ��3</a>&nbsp;&nbsp;
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �տ�����</td>
<td>
<select name="member[bank]">
<option value="">�տʽ</option>
<?php foreach($BANKS as $v) { ?>
<option value="<?php echo $v;?>" <?php if($bank == $v) { ?>selected<?php } ?>><?php echo $v;?></option>;
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �տ��ʺ�</td>
<td><input type="text" size="30" name="member[account]" id="account" value="<?php echo $account;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vbank ? 'v' : 'u';?>_bank.gif" width="16" height="16" title="<?php echo $vbank ? '��ͨ��' : 'δͨ��';?>�����ʺ���֤" align="absmiddle"/></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $AJ['trade_nm'];?>�ʺ�</td>
<td><input type="text" size="30" name="member[trade]" id="trade" value="<?php echo $trade;?>"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vbank ? 'v' : 'u';?>_trade.gif" width="16" height="16" title="<?php echo $vbank ? '��ͨ��' : 'δͨ��';?><?php echo $AJ['trade_nm'];?>�ʺ���֤" align="absmiddle"/></a></td>
</tr>
<?php echo $MFD ? fields_html('<td class="tl">', '<td>', $user, $MFD) : '';?>
</table>
<div class="tt"><span class="f_hid">*</span> ��˾����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��˾����</td>
<td><input type="text" size="60" name="member[company]" id="company" value="<?php echo $company;?>" onblur="validator('company');"/>&nbsp;<a href="#vv"><img src="<?php echo $MOD['linkurl'];?>image/<?php echo $vcompany ? 'v' : 'u';?>_company.gif" width="16" height="16" title="<?php echo $vcompany ? '��ͨ��' : 'δͨ��';?>������֤" align="absmiddle"/></a></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����ͼƬ</td>
<td><input name="member[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[ɾ��]</span><br/>
<span class="f_gray">����ʹ��LOGO���칫�����ȱ�־��ͼƬ����Ѵ�СΪ<?php echo $MOD['thumb_width'];?>px*<?php echo $MOD['thumb_height'];?>px</span></td>
</tr>


<tr>
<td class="tl"><span class="f_red">*</span> ��˾��ַ</td>
<td><input type="text" size="60" name="member[address]" id="address" value="<?php echo $address;?>"/>&nbsp;<span id="daddress" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><input type="text" size="8" name="member[postcode]" id="postcode" value="<?php echo $postcode;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��˾�绰</td>
<td><input type="text" size="20" name="member[telephone]" id="telephone" value="<?php echo $telephone;?>"/>&nbsp;<span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾����</td>
<td><input type="text" size="20" name="member[fax]" id="fax" value="<?php echo $fax;?>"/></td>
</tr><tr>
<td class="tl"><span class="f_hid">*</span> ��˾Email</td>
<td><input type="text" size="30" name="member[mail]" id="mail" value="<?php echo $mail;?>"/> <span class="f_gray">[����]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾��ַ</td>
<td><input type="text" size="30" name="member[homepage]" id="homepage" value="<?php echo $homepage;?>"/></td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��˾����</td>
<td><textarea name="member[introduce]" id="introduce" class="dsn"><?php echo $introduce;?></textarea>
<?php echo deditor($moduleid, 'introduce', $MOD['editor'], '95%', 300);?><br/><span id="dintroduce" class="f_red"></span></td>
</tr>
<?php echo $CFD ? fields_html('<td class="tl">', '<td>', $user, $CFD) : '';?>
</table>
<div class="tt">������֤</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��ҵ�����Ƿ�ͨ����֤</td>
<td>
<input type="radio" name="member[validated]" value="1" <?php if($validated) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[validated]" value="0" <?php if(!$validated) echo 'checked';?>/> ��
<?php tips('һ���ɵ�������֤��������վ�Ի�Ա�������ϵ���֤');?><a name="vv"></a>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֤���ƻ����</td>
<td><input type="text" name="member[validator]" size="30" value="<?php echo $validator;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֤����</td>
<td><?php echo dcalendar('member[validtime]', $validtime);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ʼ���֤</td>
<td>
<input type="radio" name="member[vemail]" value="1" <?php if($vemail) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vemail]" value="0" <?php if(!$vemail) echo 'checked';?>/> ��
<?php tips('�����ʼ����ͺ󣬴����ɻ�Ա������֤');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ֻ���֤</td>
<td>
<input type="radio" name="member[vmobile]" value="1" <?php if($vmobile) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vmobile]" value="0" <?php if(!$vmobile) echo 'checked';?>/> ��
<?php tips('�������ŷ��ͺ󣬴����ɻ�Ա������֤');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������֤</td>
<td>
<input type="radio" name="member[vbank]" value="1" <?php if($vbank) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vbank]" value="0" <?php if(!$vbank) echo 'checked';?>/> ��
<?php tips('һ���ڻ�Ա����֮������վ���и�����֤����֤֮���Ա���տ���Ϣ�������޸�');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $AJ['trade_nm'];?>�ʺ���֤</td>
<td>
<input type="radio" name="member[vtrade]" value="1" <?php if($vtrade) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vtrade]" value="0" <?php if(!$vtrade) echo 'checked';?>/> ��
<?php tips('��Աͨ��֧������������֮��ϵͳ�Զ���֤');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ʵ����֤</td>
<td>
<input type="radio" name="member[vtruename]" value="1" <?php if($vtruename) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vtruename]" value="0" <?php if(!$vtruename) echo 'checked';?>/> ��
<?php tips('һ���ɻ�Ա�����ύ���֤������֤�������ĵ������������վ������֤');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾��֤</td>
<td>
<input type="radio" name="member[vcompany]" value="1" <?php if($vcompany) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[vcompany]" value="0" <?php if(!$vcompany) echo 'checked';?>/> ��
<?php tips('һ���ɻ�Ա�����ύӪҵִ�ա���֯��������֤�ȵ����ĵ������������վ������֤');?>
</td>
</tr>
</table>
<div class="tt">�߼�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��ҳ���Ŀ¼</td>
<td><input type="text" size="20" name="member[skin]" value="<?php echo $skin;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ҳģ��Ŀ¼</td>
<td><input type="text" size="20" name="member[template]" value="<?php echo $template;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><input type="text" size="30" name="member[domain]" id="domain" value="<?php echo $domain;?>"/><?php tips('���� www.aijiacms.com ����http<br/>ͬʱ��Ҫ��Ա��������IPָ��վ������');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ICP������</td>
<td><input type="text" size="30" name="member[icp]" id="icp" value="<?php echo $icp;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> վ���ź�����</td>
<td><input type="text" size="60" name="member[black]" id="black" value="<?php echo $black;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ͷ�רԱ</td>
<td><input type="text" size="20" name="member[support]" id="support" value="<?php echo $support;?>"/> <a href="javascript:_user(Dd('support').value);" class="t">[����]</a> <?php tips('��д�ͷ���Ա������д���Ա���Կ����˿ͷ�����ϵ��ʽ���Ա��ṩһ��һ����');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �Ƽ�ע���� </td>
<td><input type="text" size="20" name="member[inviter]" id="inviter" value="<?php echo $inviter;?>"/> <a href="javascript:_user(Dd('inviter').value);" class="t">[����]</a> <?php tips('�Ƽ��˻�Աע��Ļ�Ա����ϵͳ�Զ���¼��һ��������д');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա�����Ƿ�����</td>
<td>
<input type="radio" name="member[edittime]" value="1"<?php if($edittime) echo ' checked';?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="member[edittime]" value="0"<?php if(!$edittime) echo ' checked';?>/> ��&nbsp;&nbsp;
<span class="f_gray">���ѡ���ǣ�ϵͳ��������ʾ��Ա��������</span>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;<input type="button" value=" ǰ ̨ " class="btn" onclick="window.open('?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $userid;?>');"/>&nbsp;&nbsp;<input type="button" value=" �� �� " class="btn" onclick="history.back(-1);"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
var vid = '';
function validator(id) {
	if(!Dd(id).value) return false;
	vid = id;
	makeRequest('moduleid=<?php echo $moduleid;?>&action=member&job='+id+'&value='+Dd(id).value+'&userid=<?php echo $userid;?>', AJPath, 'dvalidator')
}
function dvalidator() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		Dd('d'+vid).innerHTML = xmlHttp.responseText ? xmlHttp.responseText : '';
	}
}
function Dcheck() {
	if(Dd('groupid').value == 0) {
		Dmsg('��ѡ���Ա��', 'groupid');
		return false;
	}
	<?php if($userid != $_userid) { ?>
	if(Dd('password').value != '') {
		if(Dd('cpassword').value == '') {
			Dmsg('���ظ���������', 'cpassword');
			return false;
		}
		if(Dd('password').value != Dd('cpassword').value) {
			Dmsg('������������벻һ��', 'password');
			return false;
		}
	}
	if(Dd('payword').value != '') {
		if(Dd('cpayword').value == '') {
			Dmsg('���ظ�����֧������', 'cpayword');
			return false;
		}
		if(Dd('payword').value != Dd('cpayword').value) {
			Dmsg('���������֧�����벻һ��', 'payword');
			return false;
		}
	}
	<?php } ?>
	if(Dd('passport').value == '') {
		Dmsg('����дͨ��֤', 'passport');
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
	<?php if($groupid > 5) { ?>
	<?php echo $CFD ? fields_js($CFD) : '';?>
	if(Dd('company').value == '') {
		Dmsg('����д��˾����', 'company');
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
	<?php } ?>
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>