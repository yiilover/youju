<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post">
<div class="tt">�����ֶ� [<?php echo $tb;?>]</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����</th>
<th>�ֶ�</th>
<th>�ֶ�����</th>
<th>�ֶ�����</th>
<th>������</th>
<th>��name</th>
<th>������</th>
<th>��ǩ����</th>
<th>���ݵ���</th>
<th>��ʾ</th>
<th>ǰ̨</th>
<th width="50">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><input name="listorder[<?php echo $v['itemid'];?>]" type="text" size="2" value="<?php echo $v['listorder'];?>"/></td>
<td><?php echo $v['name'];?></td>
<td><?php echo $v['title'];?></td>
<td><?php echo $v['type'];?><?php echo $v['length'] ? '('.$v['length'].')' : '';?></td>
<td><?php echo $v['html'];?></td>
<td>post_fields[<?php echo $v['name'];?>]</td>
<td>{fields_show(<?php echo $v['itemid'];?>)}</td>
<td>{$t[<?php echo $v['name'];?>]}</td>
<td>{$<?php echo $v['name'];?>}</td>
<td><?php echo $v['display'] ? '��' : '��';?></td>
<td><?php echo $v['front'] ? '��' : '��';?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&tb=<?php echo $tb;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&tb=<?php echo $tb;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value="��������" class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&tb=<?php echo $tb;?>&action=order';"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>