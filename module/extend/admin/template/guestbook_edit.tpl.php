<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">�޸����� </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><a href="javascript:_user('<?php echo $username;?>');" class="t"><?php echo $username ? $username : 'Guest';?></a>&nbsp; IP:<?php echo $ip;?> ���� <?php echo ip2area($ip);?> <input type="checkbox" name="post[hidden]" value="1" <?php if($hidden) echo 'checked';?>/> ��������</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><textarea name="post[content]" id="content"  rows="8" cols="70"><?php echo $content;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ��</td>
<td><?php echo $truename;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϵ�绰</td>
<td><?php echo $telephone;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����ʼ�</td>
<td><?php echo $email;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> QQ</td>
<td><?php echo $qq ? im_qq($qq).' '.$qq : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><?php echo $ali ? im_ali($ali).' '.$ali : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> MSN</td>
<td><?php echo $msn ? im_msn($msn).' '.$msn : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Skype</td>
<td><?php echo $skype ? im_skype($skype).' '.$skype : '';?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ظ�����</td>
<td><textarea name="post[reply]" id="reply" rows="8" cols="70"><?php echo $reply;?></textarea></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ǰ̨��ʾ</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> ��
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> ��
</td>
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
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>