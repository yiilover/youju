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
<div class="tt"><?php echo $action == 'add' ? '���' : '�޸�';?>Ʊѡ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> Ʊѡ����</td>
<td><?php echo type_select('poll', 1, 'post[typeid]', '��ѡ�����', $typeid, 'id="typeid"');?> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_add.gif" width="12" height="12" title="�������" class="c_p" onclick="Dwidget('?file=type&item=<?php echo $file;?>', 'Ʊѡ����');"/> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> Ʊѡ����</td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '����', $level);?> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Ʊѡ��Ч��</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> �� <?php echo dcalendar('post[totime]', $totime);?> <?php echo tips('�����ʾ����ʱ��');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Ʊѡ˵��</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Aijiacms', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ͶƱѡ������</td>
<td>
<input name="post[poll_max]" type="text" id="poll_max" size="5" value="<?php echo $poll_max;?>"/> <?php echo tips('��0��ʾ������Ŀ������ͶƱһ�Σ������ֱ�ʾ�����Զ�N����ĿͶƱһ��');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ÿҳ��ʾ��Ŀ</td>
<td>
<input name="post[poll_page]" type="text" id="poll_page" size="5" value="<?php echo $poll_page;?>"/> <?php echo tips('ǰ̨��ʾʱ��ÿҳ��ʾ����Ŀ����');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ÿ����ʾ��Ŀ</td>
<td>
<input name="post[poll_cols]" type="text" id="poll_cols" size="5" value="<?php echo $poll_cols;?>"/> <?php echo tips('ǰ̨��ʾʱ��ÿ����ʾ����Ŀ����');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ǰ̨����ʽ</td>
<td>
<select name="post[poll_order]">
<option value="0">Ĭ������</option>
<option value="1"<?php echo $poll_order == 1 ? ' selected' : '';?>>ͶƱ��������</option>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ͼƬ��С</td>
<td>
<input name="post[thumb_width]" type="text" id="thumb_width" size="5" value="<?php echo $thumb_width;?>"/> X <input name="post[thumb_height]" type="text" id="thumb_height" size="5" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>
<tr title="�뱣��ʱ���ʽ">
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO����</td>
<td><input name="post[seo_title]" type="text" size="60" value="<?php echo $seo_title;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO�ؼ���</td>
<td><input name="post[seo_keywords]" type="text" size="60" value="<?php echo $seo_keywords;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> SEO����</td>
<td><input name="post[seo_description]" type="text" size="60" value="<?php echo $seo_description;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Ʊѡģ��</td>
<td><?php echo tpl_select('poll', 'chip', 'post[template_poll]', 'Ĭ��ģ��', $template_poll);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ģ��</td>
<td><?php echo tpl_select('poll', $module, 'post[template]', 'Ĭ��ģ��', $template);?></td>
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
		Dmsg('��ѡ��Ʊѡ����', f);
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