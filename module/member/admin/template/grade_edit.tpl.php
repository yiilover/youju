<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($user) { ?>
<div class="tt">��Ա��Ϣ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td><a href="javascript:_user('<?php echo $username;?>');" class="t"><?php echo $username;?></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾��</td>
<td><a href="javascript:_user('<?php echo $username;?>');" class="t"><?php echo $user['company'];?></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td class="f_blue"><?php echo $GROUP[$user['groupid']]['groupname'];?></td>
</tr>
</table>
<?php } ?>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td class="f_red"><?php echo $GROUP[$groupid]['groupname'];?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��˾��</td>
<td><?php echo $company;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ��</td>
<td><?php echo $truename;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ�绰</td>
<td><?php echo $telephone;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ�ֻ�</td>
<td><?php echo $mobile;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Email</td>
<td><?php echo $email;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td><?php echo $qq ? im_qq($qq).' '.$qq : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><?php echo $ali ? im_ali($ali).' '.$ali : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td><?php echo $msn ? im_msn($msn).' '.$msn : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td><?php echo $skype ? im_skype($skype).' '.$skype : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><?php echo nl2br($content);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �Ѹ����</td>
<td class="f_b f_red"><?php echo $amount;?></td>
</tr>
<?php if($promo_code) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> �Ż���</td>
<td><?php echo $promo_code;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �Żݷ���</td>
<td class="f_blue"><?php echo $promo_amount;?> <?php echo $promo_type ? '��' : $AJ['money_unit'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ʱ��</td>
<td><?php echo $addtime;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����IP</td>
<td><?php echo $ip;?> - <?php echo ip2area($ip);?></td>
</tr>
</table>
<div class="tt"><span class="f_hid">*</span> ��������</div>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($status == 2) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����״̬</td>
<td>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="radio" name="post[status]" value="3" id="s_3" onclick="S(this.value);"/><label for="s_3"> ͨ��</label>
<input type="radio" name="post[status]" value="2" id="s_2" onclick="S(this.value);" checked/><label for="s_2"> ����</label>
<input type="radio" name="post[status]" value="1" id="s_1" onclick="S(this.value);"/><label for="s_1">  �ܾ�</label>
</td>
</tr>
<tbody id="pass" style="display:none;">
<?php if($user && $fee) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա�����</td>
<td class="f_b f_red"><?php echo $fee;?> <?php echo $AJ['money_unit'];?></td>
</tr>
<?php if($promo_amount && $promo_type == 1) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> �Żݷ���</td>
<td class="f_blue"><?php echo $promo_amount;?> ��</td>
</tr>
<?php } ?>
<?php if($promo_amount && $promo_type == 0) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> �Żݷ���</td>
<td class="f_blue"><?php echo $promo_amount;?> <?php echo $AJ['money_unit'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��֧��</td>
<td class="f_blue"><?php echo $amount;?> <?php echo $AJ['money_unit'];?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֧�����</td>
<td class="f_blue"><input type="text" name="post[pay]" size="5" value="<?php echo $pay;?>"/> <?php echo $AJ['money_unit'];?>&nbsp;&nbsp;&nbsp;<a href="?moduleid=2&file=record&action=add&username=<?php echo $username;?>" class="t" target="_blank">[<?php echo $AJ['money_name'];?>����]</a>&nbsp;&nbsp;<span class="f_gray">(��Ա��ǰ�˻����:<?php echo $user['money'];?><?php echo $AJ['money_unit'];?>)</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ������Ч��</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> �� <?php echo dcalendar('post[totime]', $totime);?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ҵ�����Ƿ�ͨ����֤</td>
<td>
<input type="radio" name="post[validated]" value="1"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[validated]" value="0" checked/> ��
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֤���ƻ����</td>
<td><input type="text" name="post[validator]" size="30"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��֤����</td>
<td><?php echo dcalendar('post[validtime]', $fromtime);?></td>
</tr>
<?php } ?>
</tbody>
<tbody id="send" style="display:none;">
<?php if($user) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����֪ͨ</td>
<td>
<input type="radio" name="post[message]" value="1"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[message]" value="0" checked/> ��
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ֪ͨ����</td>
<td>
<textarea name="post[content]" rows="4" cols="60" id="content"></textarea>
<textarea id="c_3" style="display:none;">
�𾴵�<?php echo $truename;?>:
����<?php echo $GROUP[$groupid]['groupname'];?>���������Ѿ�ͨ����
</textarea>
<textarea id="c_1" style="display:none;">
�𾴵�<?php echo $truename;?>:
����<?php echo $GROUP[$groupid]['groupname'];?>��������ʧ�ܡ�
ԭ�����£�

</textarea>
</td>
</tr>
<?php } ?>
</tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ע</td>
<td><textarea name="post[note]" rows="4" cols="60"><?php echo $note;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ע������</td>
<td class="f_gray">
- ���ͨ�����룬ϵͳ�᳢�Կ۳���֧���������Ա���㣬������ʧ��<br/>
- ����ܾ����룬ϵͳ�᷵����Ա��֧���Ľ��<br/>
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php } else { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����״̬</td>
<td><?php echo $status == 1 ? '�Ѿܾ�' : '��ͨ��';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����֪ͨ</td>
<td><?php echo $message == 1 ? '�ѷ���' : 'δ֪ͨ';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><?php echo $editor;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ʱ��</td>
<td><?php echo $edittime;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ע</td>
<td><?php echo $note;?></td>
</tr>
</table>
<?php } ?>
<script type="text/javascript">
function check() {
	return confirm('ȷ��Ҫִ�д˲�����');
}
function S(i) {
	if(i==1) {
		Dh('pass');Ds('send');
		try{Dd('content').value=Dd('c_1').value;}catch(e){}
	} else if(i==2) {
		Dh('pass');Dh('send');
	} else if(i==3) {
		Ds('pass');Ds('send');
		try{Dd('content').value=Dd('c_3').value;}catch(e){}
	}
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuon[$status];?>);</script>
<?php include tpl('footer');?>