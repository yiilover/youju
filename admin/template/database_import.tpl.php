<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="delete"/>
<div class="tt">����ϵ��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����ϵ��</th>
<th width="100">�ļ���С(M)</th>
<th width="150">����ʱ��</th>
<th width="50">�־�</th>
<th width="100">����</th>
</tr>
<?php foreach($dbaks as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><input type="checkbox" name="filenames[]" value="<?php echo $v['filename'];?>"></td>
<td align="left">&nbsp;<img src="admin/image/folder.gif" width="16" height="14" alt="" align="absmiddle"/> <a href="?file=<?php echo $file;?>&action=open&dir=<?php echo $v['filename'];?>"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td title="�޸�ʱ��:<?php echo $v['mtime'];?>"><?php echo $v['btime'];?></td>
<td><?php echo $v['number'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=<?php echo $action;?>&filepre=<?php echo $v['pre'];?>&tid=<?php echo $v['number'];?>&import=1" onclick="return confirm('ȷ��Ҫ�����ϵ���ļ����������ݽ������ǣ��˲��������ɻָ�');"><img src="admin/image/import.png" width="16" height="16" title="���뱾ϵ�б����ļ�" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=open&dir=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=delete&filenames=<?php echo $v['filename'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php if($dsqls || $sqls) {?>
<div class="tt">����SQL�ļ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">-</th>
<th>SQL�ļ�</th>
<th width="100">�ļ���С(M)</th>
<th width="150">�޸�ʱ��</th>
<th width="50">�־�</th>
<th width="100">����</th>
</tr>
<?php if($dsqls) {?>
<?php foreach($dsqls as $k=>$v) {?>
<tr align="center"<?php if($v['class']) echo ' class="on"';?>>
<td><input type="checkbox" name="filenames[]" value="<?php echo $v['filename'];?>"></td>
<td align="left">&nbsp;<img src="admin/image/sql.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php AJ_PATH;?>file/backup/<?php echo $v['filename'];?>" title="������Ҽ����Ϊ������ļ�" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td title="�޸�ʱ��:<?php echo $v['mtime'];?>"><?php echo $v['btime'];?></td>
<td><?php echo $v['number'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=<?php echo $action;?>&filepre=<?php echo $v['pre'];?>&import=1" onclick="return confirm('ȷ��Ҫ�����ϵ���ļ����������ݽ������ǣ��˲��������ɻָ�');"><img src="admin/image/import.png" width="16" height="16" title="���뱾ϵ�б����ļ�" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=download&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=delete&filenames=<?php echo $v['filename'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
<?php }?>

<?php if($sqls) {?>
<?php foreach($sqls as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><input type="checkbox" name="filenames[]" value="<?php echo $v['filename'];?>"></td>
<td align="left">&nbsp;<img src="admin/image/sql.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php AJ_PATH;?>file/backup/<?php echo $v['filename'];?>" title="������Ҽ����Ϊ������ļ�" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td><?php echo $v['mtime'];?></td>
<td> -- </td>
<td><a href="?file=<?php echo $file;?>&action=<?php echo $action;?>&filename=<?php echo $v['filename'];?>&import=1"><img src="admin/image/import.png" width="16" height="16" title="����SQL�ļ�" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=download&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=delete&filenames=<?php echo $v['filename'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
<?php }?>
</table>
<?php } ?>
<div class="btns">
<span class="f_r">
<a href="javascript:" onclick="checkall(Dd('dform'), 1);" class="t">��ѡ</a>&nbsp;&nbsp;
<a href="javascript:" onclick="checkall(Dd('dform'), 2);" class="t">ȫѡ</a>&nbsp;&nbsp;
<a href="javascript:" onclick="checkall(Dd('dform'), 0);" class="t">ȫ��ѡ</a>&nbsp;&nbsp;
</span>
&nbsp;
<input type="submit" name="submit" value="ɾ���ļ�" class="btn" onclick="return confirm('ȷ��Ҫɾ����ѡ�ļ��𣿴˲��������ɻָ�');"/>
</div>
</form>
<script type="text/javascript">Menuon(1);</script>
<?php if(count($dbaks) > 10) { ?>
<script type="text/javascript">Dalert('����ϵ�г� 10 �������������ת�ƹ��ڱ���')</script>
<?php } ?>
<?php include tpl('footer');?>