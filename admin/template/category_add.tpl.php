<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<div class="tt">�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> �ϼ�����</td>
<td><?php echo category_select('category[parentid]', '��ѡ��', $parentid, $mid);?><?php tips('�����ѡ����Ϊ��������');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><textarea name="category[catname]"  id="catname" style="width:200px;height:100px;overflow:visible;" onblur="get_letter(this.value);"></textarea><?php tips('����������ӣ�һ��һ������س�����');?><br/><span id="dcatname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����Ŀ¼[Ӣ����]</td>
<td><input name="category[catdir]" type="text" id="catdir" size="20" /> <input type="button" class="btn" value="Ŀ¼���" onclick="ckDir();"><?php tips('��[a-z]��[A-z]��[0-9]��_��- ��/<br/>�÷�����ص�html�ļ��������ڴ�Ŀ¼<br/>�����Ҫ���ɶ༶Ŀ¼������ / �ָ�Ŀ¼<br/>�������д���Զ�������id��ΪĿ¼');?> <span id="dcatdir" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ĸ����</td>
<td><input name="category[letter]" type="text" id="letter" size="2" /><?php tips('��д�������ƺ�ϵͳ���Զ���ȡ ���û�л�ȡ�ɹ�����д<br/>���� ��������Ϊ �ο� ����д j');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input name="category[level]" type="text" size="2" value="1"/><?php tips('0 - ������ҳ��ʾ 1 - ������ʾ 2 - ��ҳ���ϼ����ಢ����ʾ');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('list', $MODULE[$mid]['module'], 'category[template]', 'Ĭ��ģ��');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('show', $MODULE[$mid]['module'], 'category[show_template]', 'Ĭ��ģ��');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO����)</td>
<td><input name="category[seo_title]" type="text" size="61"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br/>&nbsp; (��ҳ�ؼ���)</td>
<td><textarea name="category[seo_keywords]" cols="60" rows="3" id="seo_keywords"></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br/>&nbsp; (��ҳ����)</td>
<td><textarea name="category[seo_description]" cols="60" rows="3" id="seo_description"></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Ȩ������</td>
<td class="f_blue">���û��������Ҫ������ѡ���Ҫ���ã�ȫѡ��ȫ��ѡ������ӵ�ж�ӦȨ��</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����������</td>
<td><?php echo group_checkbox('category[group_list][]');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �������������Ϣ����</td>
<td><?php echo group_checkbox('category[group_show][]');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������Ϣ</td>
<td><?php echo group_checkbox('category[group_add][]');?></td>
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
	return true;
}
function get_letter(catname) {
	makeRequest('file=<?php echo $file;?>&mid=<?php echo $mid;?>&action=letter&catname='+catname, '?', '_get_letter');
}
function _get_letter() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			if(Dd('catdir').value == '') Dd('catdir').value = xmlHttp.responseText;
			if(Dd('letter').value == '') Dd('letter').value = xmlHttp.responseText.substr(0,1);
		}
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>