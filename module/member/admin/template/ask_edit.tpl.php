<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��������</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> �������</td>
<td><?php echo $TYPE[$typeid]['typename'];?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �������</td>
<td><?php echo $title;?></td>
</tr>
<tr class="on">
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><?php echo $content;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td><a href="javascript:_user('<?php echo $username;?>');"><?php echo $username;?></a></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ύʱ��</td>
<td><?php echo $addtime;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ظ�</td>
<td><textarea name="reply" id="reply" class="dsn"><?php echo $reply;?></textarea><?php echo deditor($moduleid, 'reply', 'Aijiacms', '98%', 300);?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����״̬</td>
<td>
<input type="radio" name="status" value="0"<?php echo $status == 0 ? ' checked' : '';?>/> ������
<input type="radio" name="status" value="1"<?php echo $status == 1 ? ' checked' : '';?>/> ������
<input type="radio" name="status" value="2"<?php echo $status == 2 ? ' checked' : '';?>/> �ѽ��
<input type="radio" name="status" value="3"<?php echo $status == 3 ? ' checked' : '';?>/> δ���
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td><?php echo $admin;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ʱ��</td>
<td><?php echo $admintime;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա����</td>
<td><?php echo $stars[$star];?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>