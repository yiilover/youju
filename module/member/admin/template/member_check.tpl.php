<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt"><?php echo $MOD['name'];?>����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $gender_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��Ա���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ԱID</th>
<th>��Ա����</th>
<th>��˾����</th>
<th>�Ա�</th>
<th>�����Ա��</th>
<th>ע��ʱ��</th>
<th>ע��IP</th>
<th width="80">����</th>
</tr>
<?php foreach($members as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td><?php echo $v['userid'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');" title="<?php echo $v['truename'];?>"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<a href="<?php echo userurl($v['username']);?>" target="_blank"><?php echo $v['company'];?></a></td>
<td><?php echo $v['gender'] == 1 ? '����' : 'Ůʿ';?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&groupid=<?php echo $v['regid'];?>"><?php echo $GROUP[$v['regid']]['groupname'];?></a></td>
<td class="px11"><?php echo $v['regdate'];?></td>
<td class="px11"><a href="javascript:_ip('<?php echo $v['regip'];?>');"><?php echo $v['regip'];?></a></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a> 
<a href="?moduleid=2&action=show&userid=<?php echo $v['userid'];?>"><img src="admin/image/view.png" width="16" height="16" title="��Ա[<?php echo $v['username'];?>]��ϸ����" alt=""/></a> 
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="�����Ա��Ա����" alt=""/></a> 
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&userid=<?php echo $v['userid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ͨ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&action=check';"/>&nbsp;
<input type="submit" value=" ɾ��<?php echo $MOD['name'];?> " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��<?php echo $MOD['name'];?>�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" ��ֹ���� " class="btn" onclick="if(confirm('ȷ��Ҫ��ֹѡ�л�Ա������')){this.form.action='?moduleid=<?php echo $moduleid;?>&action=move&groupids=2'}else{return false;}"/>&nbsp;
<input type="submit" value=" ���Ͷ��� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=sendsms';"/>&nbsp;
<input type="submit" value=" �����ʼ� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=sendmail';"/>&nbsp;
<input type="submit" value=" ������Ϣ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=message&action=send';"/>&nbsp;
<input type="submit" value=" �ƶ��� " class="btn" onclick="if(Dd('mgroupid').value==0){alert('��ѡ���Ա��');Dd('mgroupid').focus();return false;}this.form.action='?moduleid=<?php echo $moduleid;?>&action=move';"/> <?php echo group_select('groupid', '��Ա��', 0, 'id="mgroupid"');?> 
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(2);</script>
<br/>
<?php include tpl('footer');?>