<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $action == 'add' ? '���' : '�޸�';?>֤��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><input name="post[username]" type="text" id="username" size="20" value="<?php echo $username;?>"/> <a href="javascript:_user(Dd('username').value);" class="t">[����]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ֤������</td>
<td><input name="post[title]" type="text" id="title" size="40" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��֤����</td>
<td><input type="text" size="40" name="post[authority]" id="authority" value="<?php echo $authority;?>"/> <span id="dauthority" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��֤����</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> <span id="dpostfromtime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><?php echo dcalendar('post[totime]', $totime);?> <span id="dposttotime" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ֤��ͼƬ</td>
<td>
	<input type="hidden" name="post[thumb]" id="thumb" value="<?php echo $thumb;?>"/>
	<table width="120">
	<tr align="center" height="120" class="c_p">
	<td width="120"><img src="<?php echo $thumb ? $thumb : AJ_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb" title="Ԥ��ͼƬ" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb').src, 1);}else{Dalbum('',<?php echo $moduleid;?>,120, 90, Dd('thumb').value, true);}"/></td>
	</tr>
	<tr align="center" height="25">
	<td><span onclick="Dalbum('',<?php echo $moduleid;?>,100, 100, Dd('thumb').value, true);" class="jt">[�ϴ�]</span>&nbsp;<span onclick="delAlbum('','wait');" class="jt">[ɾ��]</span></td>
	</tr>
	</table>
	<span id="dthumb" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ֤�����</td>
<td class="tr"><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Aijiacms', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ֤��״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?> id="status_3"/><label for="status_3"> ͨ��</label>
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?> id="status_2"/><label for="status_2">  ����</label>
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';" id="status_1"/><label for="status_1">  �ܾ�</label>
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?> id="status_0"/><label for="status_0">  ɾ��</label>
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> �ܾ�����</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	if(Dd('title').value == '') {
		Dmsg('����д֤������', 'title');
		return false;
	}
	if(Dd('authority').value == '') {
		Dmsg('����д��֤����', 'authority');
		return false;
	}
	if(Dd('postfromtime').value == '') {
		Dmsg('��ѡ��֤����', 'postfromtime');
		return false;
	}
	if(Dd('thumb').value == '') {
		Dmsg('���ϴ�֤��ͼƬ', 'thumb', 1);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>