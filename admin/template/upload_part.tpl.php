<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�ϴ��ֱ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="60">����</th>
<th>����</th>
<th>����</th>
<th>��¼</th>
<th width="60">�鿴</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr align="center">
<td><?php echo $k;?></td>
<td><a href="javascript:Dwidget('?file=<?php echo $file;?>&id=<?php echo $k;?>', '�ϴ���¼[<?php echo $k;?>]');"><?php echo $v['name'];?></a></td>
<td><a href="javascript:Dwidget('?file=<?php echo $file;?>&id=<?php echo $k;?>', '�ϴ���¼[<?php echo $k;?>]');"><?php echo $v['table'];?></a></td>
<td><?php echo $v['rows'];?></td>
<td><a href="javascript:Dwidget('?file=<?php echo $file;?>&id=<?php echo $k;?>', '�ϴ���¼[<?php echo $k;?>]');" class="t">�鿴</a></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>