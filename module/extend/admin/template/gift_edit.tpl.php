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
<div class="tt"><?php echo $action == 'add' ? '���' : '�޸�';?>��Ʒ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ʒ����</td>
<td><?php echo type_select('gift', 1, 'post[typeid]', '��ѡ�����', $typeid, 'id="typeid"');?> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_add.gif" width="12" height="12" title="�������" class="c_p" onclick="Dwidget('?file=type&item=<?php echo $file;?>', '��Ʒ����');"/> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ʒ����</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '����', $level);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����ͼƬ</td>
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
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input type="text" size="10" name="post[credit]" value="<?php echo $credit;?>" id="credit"/> <?php echo $AJ['credit_name'];?> <span id="dcredit" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input type="text" size="10" name="post[amount]" value="<?php echo $amount;?>" id="amount"/> <span id="damount" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><?php echo group_checkbox('post[groupid][]', $groupid, '1,2,3,4');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ч��</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> �� <?php echo dcalendar('post[totime]', $totime);?> <?php echo tips('�����ʾ����ʱ��');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϸ˵��</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Aijiacms', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr title="�뱣��ʱ���ʽ">
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<?php if($AJ['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����(��վ)</td>
<td><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'typeid';
	l = Dd(f).value;
	if(l == 0) {
		Dmsg('��ѡ����Ʒ����', f);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	f = 'thumb';
	l = Dd(f).value.length;
	if(l < 10) {
		Dmsg('���ϴ�����ͼƬ', f);
		return false;
	}
	f = 'credit';
	l = Dd(f).value;
	if(l < 1) {
		Dmsg('����д����', f);
		return false;
	}
	f = 'amount';
	l = Dd(f).value;
	if(l < 1) {
		Dmsg('����д����', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>