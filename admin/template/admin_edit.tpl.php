<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
<input type="hidden" name="username" value="<?php echo $user['username'];?>"/>
<div class="tt">�޸Ĺ���Ա</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա��</td>
<td><a href="javascript:_user('<?php echo $user['username'];?>');" class="t">[<?php echo $user['username'];?>]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����Ա���</td>
<td>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="1" id="admin_1"<?php echo $user['admin'] == 1 ? ' checked' : '';?>/><label for="admin_1"> ��������Ա</label> <span class="f_gray">ӵ�г���ʼ����Ȩ�������Ȩ��</span>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="2" id="admin_2"<?php echo $user['admin'] == 2 ? ' checked' : '';?>/><label for="admin_2"> ��ͨ����Ա</label> <span class="f_gray">ӵ��ϵͳ�����Ȩ��</span>
<div class="b10">&nbsp;</div>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��վȨ��</td>
<td><?php echo ajax_area_select('aid', '��ѡ��', $user['aid']);?> <span class="f_gray">��վȨ�޽���<span class="f_red">��ͨ����Ա</span>��Ч</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ɫ����</td>
<td><input type="text" size="20" name="role" id="role" value="<?php echo $user['role'];?>"/> <span class="f_gray">����Ϊ��ɫ���ƣ�����༭��������ĳ��վ�༭�ȣ�Ҳ����Ϊ�ù���Ա�ı�ע</span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>