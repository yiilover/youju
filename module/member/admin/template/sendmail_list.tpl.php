<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�ʼ��б�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ļ�</th>
<th>�ļ���С(Kb)</th>
<th>��¼��</th>
<th width="150">��ȡʱ��</th>
<th width="50">����</th>
</tr>
<?php foreach($mails as $k=>$v) {?>
<tr align="center">
<td align="left">&nbsp;&nbsp;<a href="<?php AJ_PATH;?>file/email/<?php echo $v['filename'];?>" title="������Ҽ����Ϊ������ļ�" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td><?php echo $v['count'];?></td>
<td><?php echo $v['mtime'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=download&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;&nbsp;<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&filenames=<?php echo $v['filename'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<table cellpadding="2" cellspacing="1" width="100%" bgcolor="#F1F2F3">
<tr>
<td height="50">
<form method="post" action="?" enctype="multipart/form-data">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="upload"/>
<td title="�ϴ��ɹ����ļ����Զ����ļ��б�����ʾ">
<input name="uploadfile" type="file" size="25"/>
<input type="submit" name="submit" value=" �� �� " class="btn"/>&nbsp;
</form>
</td>
</tr>
</table>
<br/>
<br/>
<script type="text/javascript">Menuon(3);</script>
<?php include tpl('footer');?>