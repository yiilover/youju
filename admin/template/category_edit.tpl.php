<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="catid" value="<?php echo $catid;?>"/>
<div class="tt">�����޸�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> �ϼ�����</td>
<td><?php echo category_select('category[parentid]', '��ѡ��', $parentid, $mid);?><?php tips('�����ѡ����Ϊ��������');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input name="category[catname]" type="text" id="catname" size="20" value="<?php echo $catname;?>"/> <?php echo dstyle('category[style]', $style);?> <span id="dcatname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����Ŀ¼[Ӣ����]</td>
<td><input name="category[catdir]" type="text" id="catdir" size="20" value="<?php echo $catdir;?>"/><?php tips('��Ӣ�ġ����֡��л��ߡ��»��ߣ��÷�����ص�html�ļ��������ڴ�Ŀ¼');?> <span id="dcatdir" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ĸ����</td>
<td><input name="category[letter]" type="text" id="letter" size="2" value="<?php echo $letter;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input name="category[level]" type="text" size="2" value="<?php echo $level;?>"/><?php tips('0 - ������ҳ��ʾ 1 - ������ʾ 2 - ��ҳ���ϼ����ಢ����ʾ');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('list', $MODULE[$mid]['module'], 'category[template]', 'Ĭ��ģ��', $template);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('show', $MODULE[$mid]['module'], 'category[show_template]', 'Ĭ��ģ��', $show_template);?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO����)</td>
<td><input name="category[seo_title]" type="text" id="seo_title" value="<?php echo $seo_title;?>" size="61"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br/>&nbsp; (��ҳ�ؼ���)</td>
<td><textarea name="category[seo_keywords]" cols="60" rows="3" id="seo_keywords"><?php echo $seo_keywords;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br/>&nbsp; (��ҳ����)</td>
<td><textarea name="category[seo_description]" cols="60" rows="3" id="seo_description"><?php echo $seo_description;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Ȩ������</td>
<td class="f_blue">���û��������Ҫ������ѡ���Ҫ���ã�ȫѡ��ȫ��ѡ������ӵ�ж�ӦȨ��</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����������</td>
<td><?php echo group_checkbox('category[group_list][]', $group_list);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �������������Ϣ����</td>
<td><?php echo group_checkbox('category[group_show][]', $group_show);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������Ϣ</td>
<td><?php echo group_checkbox('category[group_add][]', $group_add);?></td>
</tr>

</table>


<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"/></div>
</form>
<script type="text/javascript">
function ckDir() {
	if(Dd('catdir').value == '') {
		Dtip('����д����Ŀ¼');
		Dd('catdir').focus();
		return false;
	}
	var url = '?file=category&action=ckdir&mid=<?php echo $mid;?>&catdir='+Dd('catdir').value;
	Diframe(url, 0, 0, 1);
}
function check() {
	if(Dd('catname').value == '') {
		Dmsg('����д��������', 'catname');
		return false;
	}
	if(Dd('catdir').value == '') {
		Dmsg('����д����Ŀ¼', 'catdir');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>