<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��¼����</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="type">
<option value="0">���</option>
<option value="1" <?php if($type == 1) echo 'selected';?>>�ɹ�</option>
<option value="2" <?php if($type == 2) echo 'selected';?>>ʧ��</option>
</select>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">���ͼ�¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ˮ��</th>
<th>�ռ���ַ</th>
<th>����</th>
<th width="110">����ʱ��</th>
<th>���</th>
<th>��ע</th>
<th width="40">�ط�</th>
</tr>
<?php foreach($records as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td align="left"><a href="javascript:_user('<?php echo $v['email'];?>', 'email');"><?php echo $v['email'];?></a></td>
<td align="left"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>"><?php echo $v['title'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td><?php echo $v['status'] == 3 ? '<span class="f_green">�ɹ�</span>' : '<span class="f_red">ʧ��</span>';?></td>
<td title="<?php echo $v['note'];?>"><input type="text" size="15" value="<?php echo $v['note'];?>"/></td>
<td>
<?php if($v['status'] == 3) { ?>
--
<?php } else { ?>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=resend&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/start.png" width="16" height="16" title="�ط�" alt=""/></a>
<?php } ?>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete_record'}else{return false;}"/>&nbsp;
<input type="submit" value=" �����¼ " class="btn" onclick="if(confirm('Ϊ��ϵͳ��ȫ,ϵͳ��ɾ��30��֮ǰ�ļ�¼\n�˲������ɳ��������������')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=clear'}else{return false;}"/>&nbsp;
<input type="submit" value=" �����ط� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=resend';"/>&nbsp;

</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>