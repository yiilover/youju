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
<div class="tt">�޸��ʷ� </div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> �ʷ���</td>
<td><a href="javascript:_user('<?php echo $username;?>');" class="t"><?php echo $username ? $username : 'Guest';?></a> IP - <?php echo $ip;?> <input type="checkbox" name="post[hidden]" value="1" <?php if($hidden) echo 'checked';?>/> �����ʷ�</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ʷ�ԭ��</td>
<td><a href="<?php echo $item_linkurl;?>" target="_blank" class="t"><?php echo $item_title;?></a></td>
</tr>


<tr>
<td class="tl"><span class="f_red">*</span> �ʷ�����</td>
<td>



<textarea name="post[content]" id="content"  rows="8" cols="70"><?php echo $content;?></textarea></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> �ظ��ʷ�</td>
<td>
<textarea name="post[reply]" id="reply" rows="8" cols="70"><?php echo $reply;?></textarea>
<?php 
if($reply) echo $editor ? '<br/>����Ա '.$editor.' �� '.$replytime.' �ظ�' : '<br/>��Ա '.$replyer.' �� '.$replytime.' �ظ�';
?>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> �ʷ�״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> ͨ��
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> ����
</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(<?php echo $status == 3 ? 0 : 1;?>);</script>
<?php include tpl('footer');?>