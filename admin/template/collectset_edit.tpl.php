<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�༭�ɼ�����</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" id="action" value="edit" />
<input type="hidden" name="config" id="config" value="<?php echo $config;?>" />
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�ɼ�����ʶ</td>
<td><?php echo $config;?></td>
</tr>
<tr>
<td class="tl">ѡ��ģ��</td>
<td>
	<select name="modid" id="modid">
	<option value="0">ѡ��ģ��</option>
	<?php foreach($modules as $k=>$v) {?>
	<option value="<?php echo $v['moduleid'];?>"<?php if($myCollect['modid']==$v['moduleid']) echo ' selected="selected"';?>><?php echo $v['modulename'];?></option>
	<?php }?> 
	</select> 
	<span id="dmodid" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">�ɼ�������</td>
<td><input name="sitename" type="text" id="sitename" size="30" value="<?php echo $myCollect['sitename'];?>" /> <?php tips('�ɼ������ƣ���������д');?> <span id="dsitename" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">��վ��ַ</td>
<td><input name="siteurl" type="text" id="siteurl" size="30" value="<?php echo $myCollect['siteurl'];?>" /> <?php tips('Ŀ����վ��ַ');?> <span id="dsiteurl" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">���ݲɼ����ӿ�</td>
<td><input name="apiname" type="text" id="apiname" size="30" value="<?php echo $myCollect['apiname'];?>" /> <?php tips('���Զ������ݲɼ����ӿڣ�����֪��ģ�飬�ӿ��ļ��ϴ���admin/config/Ŀ¼��Ĭ��Ϊ��ʱ����Աģ�����API_user�ӿ��ļ�������ģ�����APIͨ�ýӿ��ļ�');?> </td>
</tr>
<tr>
<td class="tl">�����������ַ</td>
<td><input name="proxy_host" type="text" id="proxy_host" size="30" value="<?php echo $myCollect['proxy_host'];?>" /> <?php tips('��ʹ�ô��������������');?></td>
</tr>
<tr>
<td class="tl">����������˿�</td>
<td><input name="proxy_port" type="text" id="proxy_port" size="30" value="<?php echo $myCollect['proxy_port'];?>" /> </td>
</tr>
<tr>
<td class="tl">�����֤ģʽ</td>
<td>
	<input type="radio" class="radio" name="verify_mode" value="1"<?php if($myCollect['verify_mode']==1) echo ' checked="checked"';?> />��ʼ��   
	<input type="radio" class="radio" name="verify_mode" value="2"<?php if($myCollect['verify_mode']==2) echo ' checked="checked"';?> />��֤��Կ  
	<input type="radio" class="radio" name="verify_mode" value="3"<?php if($myCollect['verify_mode']==3) echo ' checked="checked"';?> />��֤IP 
	<input type="radio" class="radio" name="verify_mode" value="4"<?php if($myCollect['verify_mode']==4) echo ' checked="checked"';?> />�ر�
	<?php tips('�����֤ģʽ��<BR>1 ��֤�Ƿ�Ϊ��ʼ�ˣ���Ҫ��¼<BR>2 ��֤��Կ���������Ϊ2����������� �����Կ[�Ƽ�]<BR>3 ��֤IP���������Ϊ3����������� �����IP<BR>4 �رսӿ�');?></span> 
</td>
</tr>
<tr>
<td class="tl">�����Կ</td>
<td><input name="spider_auth" type="text" id="spider_auth" size="30" value="<?php echo $myCollect['spider_auth'];?>" /> <?php tips('�����Կ ����6λ�������֤ģʽΪ 2 ʱ����');?> <span id="dsitename" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">�����IP</td>
<td><input name="spider_ip" type="text" id="spider_ip" size="30" value="<?php echo $myCollect['spider_ip'];?>" /> <?php tips('�����IP�������֤ģʽΪ 3 ʱ����');?> <span id="dsitename" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">�������ģʽ</td>
<td>
	
	<input type="radio" class="radio" name="spider_mode" value="1"<?php if($myCollect['spider_mode']==1) echo ' checked="checked"';?> />�����Զ���  
	<input type="radio" class="radio" name="spider_mode" value="0"<?php if($myCollect['spider_mode']==0) echo ' checked="checked"';?> />ϵͳ���
	<?php tips('�������ģʽΪ��ϵͳ��⡱ʱϵͳ�������õ����ļ���⣬�Զ����������ֶ�<BR>�������ģʽΪ�������Զ��塱ʱ��ϵͳ���ݷ��͵����ݹ���SQL�����⣬���Է��͵��ֶν��д����ֶ��������ݱ���һ�£����緢��&title=���Ա���&catid=����ID������(title, catid) VALUES (\'���Ա���\', \'����ID\') �Ĳ������');?>
</td>
</tr>
<tr>
<td class="tl">��Ϣ����״̬</td>
<td>
	<input type="radio" class="radio" name="spider_status" value="0"<?php if($myCollect['spider_status']==0) echo ' checked="checked"';?> />�������  
	<input type="radio" class="radio" name="spider_status" value="2"<?php if($myCollect['spider_status']==2) echo ' checked="checked"';?> />����� 
	<input type="radio" class="radio" name="spider_status" value="3"<?php if($myCollect['spider_status']==3) echo ' checked="checked"';?> />ͨ��    
	<?php tips('����HTTP_REFERER��־������ͻ�Ʒ��ɼ�����');?>
</td>
</tr>
<tr>
<td class="tl">������־</td>
<td>
	<input type="radio" class="radio" name="spider_errlog" value="1"<?php if($myCollect['spider_errlog']==1) echo ' checked="checked"';?> />����   
	<input type="radio" class="radio" name="spider_errlog" value="0"<?php if($myCollect['spider_errlog']==0) echo ' checked="checked"';?> />�ر�  
	<?php tips('������ϵͳ����¼������־��admin/config/spider/Ŀ¼,�Ա���ԣ�spiderĿ¼��Ҫ��д�룩');?>
</td>
</tr>
<tr>
<td class="tl">����REFERER</td>
<td>
	<input type="radio" class="radio" name="referer" value="1"<?php if($myCollect['referer']==1) echo ' checked="checked"';?> />��   
	<input type="radio" class="radio" name="referer" value="0"<?php if($myCollect['referer']==0) echo ' checked="checked"';?> />��  
	<?php tips('����HTTP_REFERER��־������ͻ�Ʒ��ɼ�����');?>
</td>
</tr>
<tr>
<td class="tl">�Է���ҳ����</td>
<td>
<select class="select" size="1" name="pagecharset" id="pagecharset">
<option value="auto"<?php if($myCollect['pagecharset']=='auto') echo ' selected="selected"';?>>�Զ����</option>
<option value="gbk"<?php if($myCollect['pagecharset']=='gbk') echo ' selected="selected"';?>>GB2312</option>
<option value="utf8"<?php if($myCollect['pagecharset']=='utf8') echo ' selected="selected"';?>>UTF8</option>
<option value="big5"<?php if($myCollect['pagecharset']=='big5') echo ' selected="selected"';?>>BIG5</option>
</select>
<?php tips('�����뱾վ��ͬ���Զ�����ת��');?>
</td>
</tr>
<tr>
<td class="tl">��������ظ�</td>
<td>
	<input type="radio" class="radio" name="titlerepeat" value="1"<?php if($myCollect['titlerepeat']==1) echo ' checked="checked"';?> />�������ظ�   
	<input type="radio" class="radio" name="titlerepeat" value="0"<?php if($myCollect['titlerepeat']==0) echo ' checked="checked"';?> />�����ظ�  
	<?php tips('���ô�����Ϣ���ⲻ�����ظ����������ݿ�ĸ���');?>
</td>
</tr>
<tr>
<td class="tl">��ϸ�����Ƿ��ʽ��</td>
<td>
	<input type="radio" class="radio" name="formatcontent" value="1"<?php if($myCollect['formatcontent']==1) echo ' checked="checked"';?> />��ʽ��
	<input type="radio" class="radio" name="formatcontent" value="0"<?php if($myCollect['formatcontent']==0) echo ' checked="checked"';?> />����ʽ��
	<?php tips('��ʽ�����ݽ�ȥ�����ݵ�HTML��ǩ��ָ�ɼ���Ϣ����ϸ���ݣ���ָ���вɼ���ǩ���ݣ�');?>
</td>
</tr>
<tr>
<td class="tl">��Ϣ���������</td>
<td>
	<input type="radio" class="radio" name="collectuser" value="1"<?php if($myCollect['collectuser']==1) echo ' checked="checked"';?> />���������
	<input type="radio" class="radio" name="collectuser" value="0"<?php if($myCollect['collectuser']==0) echo ' checked="checked"';?> />�����˲����
	<?php tips('���÷�������⣬�ɼ�����������Ϣ��������ݿ⣬����ֻ��¼�������û���������ɼ�������������Ϣ����ʹ�õ�ǰ��½�û���Ϊ�����ˡ���������������ݿ�ĸ��أ�����������ɼ���ǩuid�����滻��Ա����ҳURL��ַ�ı���<{infoid}>��uidΪ��ʱʹ��usernameֵ');?>
</td>
</tr>
<tr>
<td class="tl">�����˹�������</td>
<td>
<select class="select" size="1" name="urluser" id="urluser">
	<option value="" selected="selected">ѡ���Ա����</option>
<?php foreach($Collectsite as $k=>$v) {if($v['modid']==2) {?>
	<option value="<?php echo $v['config'];?>"<?php if($myCollect['urluser']==$v['config']) echo ' selected="selected"';?>><?php echo $v['name'];?></option>
<?php }}?>
</select>
<?php tips('���û�Ա�ɼ����򣬱�������ӻ�Ա���򣬴˴���д��Ա�����Ӣ�ı�ʶ��');?>  <span id="durluser" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">����ҳURL��ַ</td>
<td><input name="urlinfo" type="text" id="urlinfo" size="60" value="<?php echo $myCollect['urlinfo'];?>" /> <?php tips('��Ϣ��ű�����<{infoid}>');?> <span id="durlinfo" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">�ɼ������б�</td>
<td><textarea class="textarea" name="content" id="content" rows="5" cols="60"><?php echo $content?></textarea> <?php tips('=�ź�������������������');?><BR><span id="dcontent" class="f_red"></span> </td>
</tr>
<tr>
<td class="tl">��ҳ�ɼ�����</td>
<td><textarea class="textarea" name="pagerule" id="pagerule" rows="5" cols="60"><?php echo $pagerule?></textarea></textarea> <?php tips('�����ݷ�ҳ����Ҫ��Բɼ���ǩ�ֲ��ڶ�ҳ�������������ϸ���ݲ�������ҳ�棬��˾���ܺ���ϵ��ʽ����ͬһҳ��<BR>ץȡ��ҳ���Ӱ��ɼ��ٶȣ���������ʹ��<BR>��ҳ����ʹ��pageurl=��ʾ�ɼ�ҳURL�������Ǿ�����򣬿�ʹ������ҳURL�ı���<{infoid}>�����߲ɼ������б����Ѳɼ�����');?>  </td>
</tr>
<tr>
<td class="tl">���ݷ�ҳ�ɼ�ģʽ</td>
<td>
	<input type="radio" class="radio" name="contpagemode" value="0"<?php if($myCollect['contpagemode']==0) echo ' checked="checked"';?> />����ҳ
	<input type="radio" class="radio" name="contpagemode" value="1"<?php if($myCollect['contpagemode']==1) echo ' checked="checked"';?> />��ҳ�б�
	<input type="radio" class="radio" name="contpagemode" value="2"<?php if($myCollect['contpagemode']==2) echo ' checked="checked"';?> />��һҳ
	<?php tips('������ҳ����Ĭ��Ϊ����ҳ��ѡ���ģʽ����ʱ��д�˷�ҳ����Ҳ���ɼ���ҳ<BR>����ҳ�б�����ģʽ�Ȳɼ����з�ҳURL�б��ٰ��б�ɼ���ҳ���ݣ�����д��ǩcont_listarea,cont_listurl<br>����һҳ�����ڲɼ��굱ǰҳ���ݺ��ٲɼ���һ��ҳURL��ѭ��ֱ����ҳ����������д��ǩcont_listarea,cont_nextpage���������������������ѭ����������ʹ��');?>
</td>
</tr>
<tr>
<td class="tl">���ݷ�ҳ����</td>
<td><textarea class="textarea" name="contpage" id="contpage" rows="5" cols="60"><?php echo $contpage?></textarea>  </td>
</tr>
<tr>
<td class="tl">�滻�����б�</td>
<td><textarea class="textarea" name="replacelist" id="replacelist" rows="5" cols="60"><?php echo $replacelist?></textarea> <?php tips('�ɼ��������ǩֵ������滻����ʽ��Ҫ�滻ֵ@@�滻ֵ�����ޡ�@@������˷������ݣ������滻�á�##�������֧������');?>  </td>
</tr>
<tr>
<td class="tl">Ĭ�ϳ����б�</td>
<td><textarea class="textarea" name="defaultvalue" id="defaultvalue" rows="5" cols="60"><?php echo $defaultvalue?></textarea> <?php tips('�ɼ���ǩֵΪ��ʱ��ʹ�õ�ǰĬ��ֵ����');?> </td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'modid';
	l = $(f).value;
	if(l == 0) {
		Dmsg('��ѡ��һ��ģ��', f);
		return false;
	}
	f = 'sitename';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д�ɼ�������', f);
		return false;
	}
	f = 'siteurl';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д��վ��ַ', f);
		return false;
	}
	f = 'config';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д�ɼ�����ʶ', f);
		return false;
	}
	f = 'urlinfo';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д����ҳURL��ַ', f);
		return false;
	}
	f = 'content';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д�ɼ�����', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>