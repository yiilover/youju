<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">�ʼ�����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $type_select;?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<div class="tt">�ʼ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>&nbsp;ID&nbsp;</th>
<th>�� ��</th>
<th>�� ��</th>
<th>���ʱ��</th>
<th>����ʱ��</th>
<th>��������</th>
<th width="80">����</th>
</tr>
<?php foreach($mails as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><?php echo $v['itemid'];?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&typeid=<?php echo $v['typeid'];?>"><?php echo $v['type'];?></a></td>
<td align="left"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><?php echo $v['title'];?></a></td>
<td><?php echo $v['addtime'];?></td>
<td><?php echo $v['sendtime'];?></td>
<td title="����鿴���Ļ�Ա�б�"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list&typeid=<?php echo $v['typeid'];?>"><?php echo $v['num'];?></a></td>
<td title="�༭:<?php echo $v['editor'];?>,�ϴ��޸�:<?php echo $v['edittime'];?>">
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=send&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/child.png" width="16" height="16" title="�����ʼ�" alt=""/></a>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<?php if(!$TYPE) { ?>
<script type="text/javascript">Dwidget('?file=type&item=<?php echo $file;?>', '�����ʼ����ģ�������Ӷ��ķ���');</script>
<?php } ?>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>