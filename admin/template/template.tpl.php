<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">ģ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ļ���</th>
<th width="120">ģ������</th>
<th width="120">ģ��ϵ��</th>
<th width="80">�ļ���С</th>
<th width="130">�޸�ʱ��</th>
<th width="50">����</th>
<th width="110">����</th>
</tr>
<?php foreach($dirs as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;<img src="admin/image/folder.gif" alt="" align="absmiddle"/> <a href="?file=<?php echo $file;?>&dir=<?php echo $v['dirname'];?>" title="�޸�"><?php echo $v['dirname'];?></a></td>
<td><input type="text" style="width:130px;" value="<?php echo $v['name'];?>" onblur="template_name('<?php echo $v['dirname'];?>', this.value);"/></td>
<td>&lt;Ŀ¼&gt;</td>
<td>&lt;Ŀ¼&gt;</td>
<td><?php echo $v['mtime'];?></td>
<td><?php echo $v['mod'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=add&dir=<?php echo $v['dirname'];?>"><img src="admin/image/new.png" width="16" height="16" title="�½�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&dir=<?php echo $v['dirname'];?>"><img src="admin/image/edit.png" width="16" height="16" title="����" alt=""/></a>
</td>
</tr>
<?php }?>

<?php foreach($templates as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;<a href="<?php echo $template_path.$v['filename'];?>" title="�鿴" target="_blank"><img src="admin/image/htm.gif" width="16" height="16" alt="" align="absmiddle"/></a> <a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>" title="�޸�"><?php echo $v['filename'];?></a></td>
<td><input type="text" style="width:130px;" value="<?php echo $v['name'];?>" onblur="template_name('<?php echo $v['fileid'];?>', this.value);"/></td>
<td>&nbsp;<a href="?file=<?php echo $file;?>&action=add&type=<?php echo $v['type'];?>&dir=<?php echo $dir;?>" title="�½�"><?php echo $v['type'];?></a></td>
<td><?php echo $v['filesize'];?> Kb</td>
<td><?php echo $v['mtime'];?></td>
<td><?php echo $v['mod'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=add&type=<?php echo $v['type'];?>&dir=<?php echo $dir;?>"><img src="admin/image/new.png" width="16" height="16" title="�½�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php if($baks) { ?>
<div class="tt"><? echo $dirS[$dir]['name']?>ģ�屸�ݹ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ļ���</th>
<th width="120">����ģ��</th>
<th width="100">���ݱ��</th>
<th width="80">�ļ���С</th>
<th width="130">����ʱ��</th>
<th width="50">����</th>
<th width="110">����</th>
</tr>
<?php foreach($baks as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;<img src="admin/image/unknow.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php echo $template_path.$v['filename'];?>" title="�鿴" target="_blank"><?php echo $v['filename'];?></a></td>
<td>&nbsp;<?php echo $v['type'];?>.htm</td>
<td>&nbsp;<?php echo $v['number'];?></td>
<td><?php echo $v['filesize'];?> Kb</td>
<td><?php echo $v['mtime'];?></td>
<td><?php echo $v['mod'];?></td>
<td>
<a href="javascript:Dconfirm('ȷ��Ҫ�ָ�<?php echo $v['fileid'];?>�����𣿴˲��������ɳ���<br/>�ļ�<?php echo $v['type'];?>.htm�����ݽ���<?php echo $v['filename'];?>����', '?file=<?php echo $file;?>&action=import&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>&dir=<?php echo $dir;?>');"><img src="admin/image/import.png" width="16" height="16" title="�ָ�" alt=""/></a>&nbsp;
<a href="<?php echo $template_path.$v['filename'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16" title="�鿴" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>&dir=<?php echo $dir;?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&fileid=<?php echo $v['type'];?>&bakid=<?php echo $v['number'];?>&dir=<?php echo $dir;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<?php }?>
<script type="text/javascript">
function template_name(fileid, name) {
	makeRequest('file=<?php echo $file;?>&dir=<?php echo $dir;?>&action=template_name&fileid='+fileid+'&name='+name, '?', '_template_name');
}
function _template_name() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) showmsg('ģ�����޸ĳɹ�');
	}
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>