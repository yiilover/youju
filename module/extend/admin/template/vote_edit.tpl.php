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
<div class="tt"><?php echo $action == 'add' ? '���' : '�޸�';?>ͶƱ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ͶƱ����</td>
<td><?php echo type_select('vote', 1, 'post[typeid]', '��ѡ�����', $typeid, 'id="typeid"');?> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_add.gif" width="12" height="12" title="�������" class="c_p" onclick="Dwidget('?file=type&item=<?php echo $file;?>', 'ͶƱ����');"/> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ͶƱ����</td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '����', $level);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ͶƱ��Ч��</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> �� <?php echo dcalendar('post[totime]', $totime);?> <?php echo tips('�����ʾ����ʱ��');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><input name="post[linkto]" type="text" id="linkto" size="50" value="<?php echo $linkto;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ͶƱ˵��</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Aijiacms', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ͶƱ���</td>
<td>
<input type="radio" name="post[choose]" value="0" id="choose_0"<?php if(!$choose) echo ' checked';?> onclick="Dh('vote_num');"/><label for="choose_0"> ��ѡ</label>
<input type="radio" name="post[choose]" value="1" id="choose_1"<?php if($choose) echo ' checked';?> onclick="Ds('vote_num');"/><label for="choose_1"> ��ѡ</label>
</td>
</tr>

<tr id="vote_num" style="display:<?php echo $choose ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> ��ѡ����</td>
<td>
<input name="post[vote_min]" type="text" id="vote_min" size="5" value="<?php echo $vote_min;?>"/>
��
<input name="post[vote_max]" type="text" id="vote_max" size="5" value="<?php echo $vote_max;?>"/>
</td>
</tr>
<?php for($i=1;$i<11;$i++) { $s = 's'.$i; ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ͶƱ����<?php echo $i;?></td>
<td><input name="post[s<?php echo $i;?>]" type="text" id="s<?php echo $i;?>" size="50" value="<?php echo $$s;?>"/></td>
</tr>
<?php } ?>
<tr title="�뱣��ʱ���ʽ">
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ͶƱģ��</td>
<td><?php echo tpl_select('vote', 'chip', 'post[template_vote]', 'Ĭ��ģ��', $template_vote);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ģ��</td>
<td><?php echo tpl_select('vote', $module, 'post[template]', 'Ĭ��ģ��', $template);?></td>
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
		Dmsg('��ѡ��ͶƱ����', f);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>