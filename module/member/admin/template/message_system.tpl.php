<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">ϵͳ�ż�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">ID</th>
<th>����</th>
<th>��Ա��</th>
<th>ʱ��</th>
<th width="50">����</th>
</tr>
<?php foreach($messages as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><?php echo $v['itemid'];?></td>
<td align="left"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>">&nbsp;<?php echo $v['title'];?></a></td>
<td><?php echo $v['group'];?></td>
<td><?php echo $v['addtime'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=system_delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(2);</script>
<br/>
<?php include tpl('footer');?>