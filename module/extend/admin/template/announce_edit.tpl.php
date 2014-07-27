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
<div class="tt"><?php echo $action == 'add' ? '���' : '�޸�';?>����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> �������</td>
<td><?php echo type_select('announce', 1, 'post[typeid]', '��ѡ�����', $typeid, 'id="typeid"');?> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_add.gif" width="12" height="12" title="�������" class="c_p" onclick="Dwidget('?file=type&item=<?php echo $file;?>', '�������');"/> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �������</td>
<td><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <?php echo dstyle('post[style]', $style);?>&nbsp; <?php echo level_select('post[level]', '����', $level);?> &nbsp;<input type="checkbox" name="post[islink]" value="1" id="islink" onclick="_islink();"  <?php if($islink) echo 'checked';?>/> �ⲿ���� <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������Ч��</td>
<td><?php echo dcalendar('post[fromtime]', $fromtime);?> �� <?php echo dcalendar('post[totime]', $totime);?></td>
</tr>
<tr id="link" style="display:<?php echo $islink ? '' : 'none';?>;">
<td class="tl"><span class="f_red">*</span> ���ӵ�ַ</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="50" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<tbody id="basic" style="display:<?php echo $islink ? 'none' : '';?>;">
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Aijiacms', '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<?php if($AJ['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����(��վ)</td>
<td><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?></td>
</tr>
<?php } ?>
<tr title="�뱣��ʱ���ʽ">
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('announce', $module, 'post[template]', 'Ĭ��ģ��', $template);?></td>
</tr>
</tbody>
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
		Dmsg('��ѡ�񹫸����', f);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	if(Dd('islink').checked) {
		f = 'linkurl';
		l = Dd(f).value.length;
		if(l < 12) {
			Dmsg('��������ȷ�����ӵ�ַ', f);
			return false;
		}
	} else {
		f = 'content';
		l = FCKLen();
		if(l < 5) {
			Dmsg('��������5�֣���ǰ������'+l+'��', f);
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>