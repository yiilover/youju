<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">����ļ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ļ���</th>
<th width="180">�ļ���С</th>
<th width="180">�޸�ʱ��</th>
<th width="150">����</th>
</tr>
<?php foreach($skins as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';">

<td>&nbsp;<a href="<?php echo $skin_path.$v['filename'];?>" title="�鿴" target="_blank"><img src="admin/image/css.gif" width="16" height="16" alt="" align="absmiddle"/></a> <a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>" title="�޸�"><?php echo $v['filename'];?></a></td>

<td align="center"><?php echo $v['filesize'];?> Kb</td>

<td align="center"><?php echo $v['mtime'];?></td>

<td align="center">
<a href="?file=<?php echo $file;?>&action=add"><img src="admin/image/new.png" width="16" height="16" title="�½�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['fileid'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['fileid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>

</tr>
<?php }?>
</table>
<?php if($baks) { ?>
<div class="tt">��񱸷ݹ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ļ���</th>
<th width="180">�ļ���С</th>
<th width="180">����ʱ��</th>
<th width="150">����</th>
</tr>
<?php foreach($baks as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';">

<td>&nbsp;<img src="admin/image/unknow.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php echo $skin_path.$v['filename'];?>" title="�鿴" target="_blank"><?php echo $v['filename'];?></a></td>

<td align="center"><?php echo $v['filesize'];?> Kb</td>

<td align="center"><?php echo $v['mtime'];?></td>

<td align="center">
<a href="javascript:Dconfirm('ȷ��Ҫ�ָ�<?php echo $v['fileid'];?>�����𣿴˲��������ɳ���<br/>�ļ�<?php echo $v['type'];?>.css�����ݽ���<?php echo $v['filename'];?>����', '?file=<?php echo $file;?>&action=import&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>');"><img src="admin/image/import.png" width="16" height="16" title="�ָ�" alt=""/></a>&nbsp;
<a href="<?php echo $skin_path.$v['filename'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16" title="�鿴" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;
<a href="javascript:Dconfirm('ȷ��Ҫɾ��<?php echo $v['filename'];?>�����𣿴˲������ɳ���', '?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>');"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php }?>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>