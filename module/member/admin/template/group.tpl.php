<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��Ա�����</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="120">����</th>
<th width="120">ID</th>
<th>��Ա��</th>
<th width="120">����</th>
<th width="120"><?php echo VIP;?>ָ��</th>
<th width="150">����</th>
</tr>
<?php foreach($groups as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<?php if($k > 5) { ?>
<td>&nbsp;<input type="text" size="2" name="listorder[<?php echo $v['groupid'];?>]" value="<?php echo $v['listorder'];?>"/></td>
<?php } else { ?>
<td>&nbsp;<?php echo $v['listorder'];?></td>
<?php } ?>
<td>&nbsp;<?php echo $v['groupid'];?></td>
<td><?php echo $v['groupname'];?></td>
<td>&nbsp;<?php echo $v['type'];?></td>
<td>&nbsp;<?php echo $v['vip'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&groupid=<?php echo $v['groupid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<?php if($v['groupid'] > 7) { ?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&groupid=<?php echo $v['groupid'];?>"  onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
<?php } else {?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php } ?>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order';"/>
</div>
</form>
<div class="tt">ע������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="f_gray">
&nbsp;&nbsp;- IDΪ5��6�Ļ�Ա������ǿ۷�ģʽ��������ܵ��»�Ա�޷�����ע��<br/>
&nbsp;&nbsp;- ��Ա���밴����ķ�Χ(���񼶱�)�ɵ͵����������򣬷���Ӱ���Ա������<br/>
&nbsp;&nbsp;- �۷�ģʽ��Ա�����ע��ʱѡ�񣬰���ģʽ��Ҫ��Ա��������<br/>
</td>
</tr>
</table>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>