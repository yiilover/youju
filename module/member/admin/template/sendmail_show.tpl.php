<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�����ʼ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">����</td>
<td class="f_b"><?php echo $title;?></td>
</tr>
<tr>
<td class="tl">�ռ���</td>
<td><a href="javascript:_user('<?php echo $email;?>', 'email');"><?php echo $email;?></a></td>
</tr>
<tr>
<td class="tl">����ʱ��</td>
<td><?php echo timetodate($addtime, 6);?></td>
</tr>
<tr>
<td class="tl">���ͽ��</td>
<td><?php echo $status == 3 ? '<span class="f_green">�ɹ�</span>' : '<span class="f_red">ʧ��</span>';?></td>
</tr>
<tr>
<td class="tl">����</td>
<td><?php echo $content;?></td>
</tr>
<tr>
<td class="tl">��ע</td>
<td><?php echo $note;?></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="button" value=" �� �� " class="btn" onclick="history.back(-1);"/></div>
<script type="text/javascript">Menuon(3);</script>
<?php include tpl('footer');?>