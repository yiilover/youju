<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?" method="post">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="order"/>
<div class="tt">ģ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">����</th>
<th width="40">ID</th>
<th>����</th>
<th width="100">Ŀ¼</th>
<th width="60">����</th>
<th width="60">����</th>
<th width="100">ģ��</th>
<th width="100">��װ����</th>
<th width="100">����</th>
<th width="50">״̬</th>
</tr>
<?php foreach($modules as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><input type="text" size="2" name="listorder[<?php echo $v['moduleid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['moduleid'];?></td>
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo set_style($v['name'], $v['style']);?></a></td>
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['moduledir'] ? $v['moduledir'] : '--';?></a></td>
<td><?php echo $v['islink'] ? '<span class="f_red">����</span>' : '����';?></td>
<td><?php echo $v['ismenu'] ? '��' : '<span class="f_red">��</span>';?></td>
<td title="<?php echo $v['module'];?>"><?php echo $v['modulename'];?></td>
<td><?php echo $v['installdate'];?></td>
<td><a href="?file=<?php echo $file;?>&action=edit&modid=<?php echo $v['moduleid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=delete&modid=<?php echo $v['moduleid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=remkdir&modid=<?php echo $v['moduleid'];?>"><img src="admin/image/remkdir.png" width="16" height="16" title="�ؽ�Ŀ¼" alt=""/></a>&nbsp;&nbsp;<a href="?file=setting&moduleid=<?php echo $v['moduleid'];?>"><img src="admin/image/set.png" width="16" height="16" title="����" alt=""/></a></td>
<td>
<?php if($v['disabled']) {?>
<a href="?file=<?php echo $file;?>&action=disable&value=0&modid=<?php echo $v['moduleid'];?>"><img src="admin/image/stop.png" width="16" height="16" title="�ѽ���,�������" alt=""/></a>
<?php } else {?>
<a href="javascript:Dconfirm('ȷ��Ҫ����[<?php echo $v['name'];?>]ģ����?', '?file=<?php echo $file;?>&action=disable&value=1&modid=<?php echo $v['moduleid'];?>');"><img src="admin/image/start.png" width="16" height="16" title="��������,�������" alt=""/></a>
<?php } ?>
</td>
</tr>
<?php }?>
</table>
<?php if($_modules) { ?>
<div class="tt">����ģ��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">����</th>
<th width="40">ID</th>
<th>����</th>
<th width="100">Ŀ¼</th>
<th width="60">����</th>
<th width="60">����</th>
<th width="100">ģ��</th>
<th width="100">��װ����</th>
<th width="100">����</th>
<th width="50">״̬</th>
</tr>
<?php foreach($_modules as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><input type="text" size="2" name="listorder[<?php echo $v['moduleid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['moduleid'];?></td>
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo set_style($v['name'], $v['style']);?></a></td>
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['moduledir'] ? $v['moduledir'] : '--';?></a></td>
<td><?php echo $v['islink'] ? '<span class="f_red">����</span>' : '����';?></td>
<td><?php echo $v['ismenu'] ? '��' : '<span class="f_red">��</span>';?></td>
<td title="<?php echo $v['module'];?>"><?php echo $v['modulename'];?></td>
<td><?php echo $v['installdate'];?></td>
<td><a href="?file=<?php echo $file;?>&action=edit&modid=<?php echo $v['moduleid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=delete&modid=<?php echo $v['moduleid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=remkdir&modid=<?php echo $v['moduleid'];?>"><img src="admin/image/remkdir.png" width="16" height="16" title="�ؽ�Ŀ¼" alt=""/></a>&nbsp;&nbsp;<a href="?file=setting&moduleid=<?php echo $v['moduleid'];?>"><img src="admin/image/set.png" width="16" height="16" title="����" alt=""/></a></td>
<td>
<?php if($v['disabled']) {?>
<a href="?file=<?php echo $file;?>&action=disable&value=0&modid=<?php echo $v['moduleid'];?>"><img src="admin/image/stop.png" width="16" height="16" title="�ѽ���,�������" alt=""/></a>
<?php } else {?>
<a href="javascript:Dconfirm('ȷ��Ҫ����[<?php echo $v['name'];?>]ģ����?', '?file=<?php echo $file;?>&action=disable&value=1&modid=<?php echo $v['moduleid'];?>');"><img src="admin/image/start.png" width="16" height="16" title="��������,�������" alt=""/></a>
<?php } ?>
</td>
</tr>
<?php }?>
</table>
<?php } ?>
<div class="btns">
<input type="submit" value=" �������� " class="btn"/>&nbsp;
</div>
</form>


<script type="text/javascript">Menuon(1);</script>
<?php if(isset($update)) { ?>
<script type="text/javascript">window.parent.frames[0].location.reload();</script>
<?php } ?>
<?php include tpl('footer');?>