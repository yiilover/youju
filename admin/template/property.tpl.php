<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post">
<input type="hidden" name="forward" value="<?php echo $AJ_URL;?>"/>
<input type="hidden" name="catid" value="<?php echo $catid;?>"/>
<div class="tt">���Բ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">����</th>
<th>ID</th>
<th>��������</th>
<th>����</th>
<th>����</th>
<th>��ӷ�ʽ</th>
<th>Ĭ��(��ѡ)ֵ</th>
<th width="50">����</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="text" size="2" name="listorder[<?php echo $v['oid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['oid'];?></td>
<td><?php echo $v['name'];?></td>
<td><?php echo $v['required'] ? '<span class="f_red">��</span>' : '��';?></td>
<td><?php echo $v['search'] ? '<span class="f_red">��</span>' : '��';?></td>
<td><?php echo $TYPE[$v['type']];?></td>
<td><?php echo $v['value'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=edit&catid=<?php echo $v['catid'];?>&oid=<?php echo $v['oid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&catid=<?php echo $v['catid'];?>&oid=<?php echo $v['oid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php } ?>
</table>
<div class="btns">
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?file=<?php echo $file;?>&catid=<?php echo $catid;?>&action=order';"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value=" �� �� " class="btn" onclick="window.parent.location.reload();"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>