<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>

<div class="tt">�༭�����ɼ�����</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="edit"/>
<input type="hidden" name="cid" value="<?php echo $cid;?>"/>
<input type="hidden" name="config" id="config" value="<?php echo $config;?>" />
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�ɼ���վ</td>
<td><?php echo $myCollect['sitename'];?></td>
</tr>
<tr>
<td class="tl">�ɼ���������</td>
<td><input name="title" type="text" id="title" size="30" value="<?php echo $myCollect['listcollect'][$cid]['title'];?>" />  <span id="dtitle" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">Ĭ�Ϸ���</td>
<td><?php echo ajax_category_select('catid', '', $myCollect['listcollect'][$cid]['catid'], $myCollect['modid'] == 2 ? 4 : $myCollect['modid']);?></td>
</tr>
<tr>
<td class="tl">Ĭ�ϵ���</td>
<td><?php echo ajax_area_select('areaid', '��ѡ��', $myCollect['listcollect'][$cid]['areaid']);?></td>
</tr>
<tr>
<td class="tl">�б�ҳ��URL</td>
<td><input name="urlpage" type="text" id="urlpage" size="60" value="<?php echo $myCollect['listcollect'][$cid]['urlpage'];?>" /> <?php tips('Ŀ����վ�б�ҳ��ַ�����Ҫ�ɼ���ҳ������<{pageid}>����ҳ��');?> <span id="durlpage" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">�б�����ʶ�����</td>
<td><textarea class="textarea" name="listarea" id="listarea" rows="5" cols="60"><?php echo my_echorule( $myCollect['listcollect'][$cid]['listarea'], 'textarea' );?></textarea>  <BR><span id="dlistarea" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">��Ϣ��Ųɼ�����</td>
<td><textarea class="textarea" name="infoid" id="infoid" rows="5" cols="60"><?php echo my_echorule( $myCollect['listcollect'][$cid]['infoid'], 'textarea' );?></textarea> <BR><span id="dinfoid" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">��һҳ��ҳ��ɼ�����</td>
<td><textarea class="textarea" name="nextpageid" id="nextpageid" rows="5" cols="60"><?php echo my_echorule( $myCollect['listcollect'][$cid]['nextpageid'], 'textarea' );?></textarea> <?php tips('�������ձ�ʾû�еڶ�ҳ������ ++ ���ʾҳ������Ǽ�1��ʽ�����ģ���������ҳ��Ĳɼ�����');?></td>
</tr>
<tr>
<td class="tl">��ʼҳҳ��</td>
<td><input name="startpageid" type="text" id="startpageid" size="30" value="<?php echo $myCollect['listcollect'][$cid]['startpageid'];?>" /> </td>
</tr>
<tr>
<td class="tl">���ɼ�ҳ��</td>
<td><input name="maxpagenum" type="text" id="maxpagenum" size="30" value="<?php echo $myCollect['listcollect'][$cid]['maxpagenum'];?>" /> <?php tips('��0�����ձ�ʶ������');?> </td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д�ɼ���������', f);
		return false;
	}
	f = 'urlpage';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д�ɼ�ҳ���ַ', f);
		return false;
	}
	f = 'infoid';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д��Ϣ��Ųɼ�����', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>