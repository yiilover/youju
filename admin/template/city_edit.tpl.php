<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">��վ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ���ڵ���</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��վ����</td>
<td><input name="post[name]" type="text" id="name" size="20" value="<?php echo $name;?>"/> <?php echo dstyle('post[style]', $style);?> <span id="dname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><input name="post[domain]" type="text" size="40" value="<?php echo $domain;?>"/><?php tips('����http://xian.destoon.com/,�� / ��β<br/>ͬʱ�ڷ������˰󶨴���������վ��Ŀ¼���������������д');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> IP��ַ����</td>
<td><input name="post[iparea]" type="text" size="60" value="<?php echo $iparea;?>"/><?php tips('һ��Ϊ�����������ƣ����������|�ָ���翪ͨ���ǹ㶫��վ��������д����|����|��ɽ�ȣ�ϵͳ��������Щ���ư�IP��ַ�Զ���ת��վ');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ĸ����</td>
<td><input name="post[letter]" type="text" id="letter" size="4" value="<?php echo $letter;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input name="post[listorder]" type="text" id="listorder" size="4" value="<?php echo $listorder;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��վ��ҳģ��</td>
<td><?php echo tpl_select('index', 'city', 'post[template]', 'Ĭ��ģ��', $template);?><?php tips('����ģ��Ŀ¼cityĿ¼�ｨ��index-xxx.htm�����ģ�壬Ȼ���ڴ�ѡ��ģ��������ο���վ��ҳģ�塣�����ѡ��ϵͳĬ��ʹ����վ��ҳģ�塣');?></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> Title(SEO����)</td>
<td><input name="post[seo_title]" type="text" id="seo_title" value="<?php echo $seo_title;?>" size="61"></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Keywords<br/>&nbsp;&nbsp;(��ҳ�ؼ���)</td>
<td><textarea name="post[seo_keywords]" cols="60" rows="3" id="seo_keywords"><?php echo $seo_keywords;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Meta Description<br/>&nbsp;&nbsp;(��ҳ����)</td>
<td><textarea name="post[seo_description]" cols="60" rows="3" id="seo_description"><?php echo $seo_description;?></textarea></td>
</tr>
</table>


<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	if(Dd('areaid_1').value == 0) {
		Dmsg('��ѡ�����ڵ���', 'areaid', 1);
		return false;
	}
	if(Dd('name').value == '') {
		Dmsg('����д��վ����', 'name');
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>