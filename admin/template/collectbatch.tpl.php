<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);

if ($action == 'show')
{
?>
<div class="tt">��ҳ�������ɼ�</div>
<form method="get" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="collect"/>
<input type="hidden" name="siteid" value="<?php echo $siteid;?>" />
<input type="hidden" name="auth" value="<?php echo $myCollect['spider_auth'];?>" />
<input type="hidden" name="moduleid" value="<?php echo $myCollect['modid'];?>" />
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�ɼ�������</td>
<td><?php echo $myCollect['sitename'];?></td>
</tr>
<tr>
<td class="tl">ѡ���б�ɼ�</td>
<td>
<select class="select" size="1" name="collectname" id="collectname">
<?php foreach($myCollect['listcollect'] as $k=>$v) {?>
<option value="<?php echo $k;?>"><?php echo $v['title'];?></option>
<?php }?>
</select>
</td>
</tr>
<tr>
<td class="tl">��ʼҳ���</td>
<td><input name="startpageid" type="text" id="startpageid" size="30" /> <?php tips('������Ĭ�Ϸ�ʽ�ɼ�');?> </td>
</tr>
<tr>
<td class="tl">���ɼ�ҳ��</td>
<td><input name="maxpagenum" type="text" id="maxpagenum" size="30" /> <?php tips('����ʼҳ��š��͡����ɼ�ҳ����һ�㲻���ϵͳ�ᰴĬ�����õķ�ʽ���С�ֻ������Ҫ����Ĭ�Ϸ�ʽ����ʱ�����ã��������д��ʽҪ���ɼ��������������һ�¡�');?> </td>
</tr>
<?php if($myCollect['modid']==2) {?>
<tr>
<td class="tl">��˾��Ϣ�б�ɼ�URL</td>
<td><input name="compinfolisturl" type="text" id="compinfolisturl" size="80" value="" />  <?php tips('����˾��������Ϣ�б�ɼ���Ϣ���˴���д��˾��Ϣ�б�Ĳɼ�URL�������б�������ҳ���ȡ');?> </td>
</tr>
<?php }?>
<tr>
<td class="tl">�ɼ�����</td>
<td><input name="collecttest" type="checkbox" id="collecttest" /> <?php tips('ѡ�����ʱ���ɼ���һ�����ݲ��ԣ������');?> </td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<?php } else {?>
<div class="tt">��ҳ�������ɼ�</div>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="show" />
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ѡ��ɼ���</td>
<td>
<select class="select" size="1" name="siteid" id="siteid">
<?php foreach($Collectsite as $k=>$v) {?>
<option value="<?php echo $k;?>"><?php echo $v['name'];?></option>
<?php }?>
</select>
<span id="dsiteid" class="f_red"></span>
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<?php }?>
<script type="text/javascript">Menuon(0);</script>
</body>
</html>