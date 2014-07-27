<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��������</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="type">
<option value="0">ʱ������</option>
<option value="1" <?php if($type == 1) echo 'selected';?>>��ʼʱ��</option>
<option value="2" <?php if($type == 2) echo 'selected';?>>����ʱ��</option>
<option value="3" <?php if($type == 3) echo 'selected';?>>���ʱ��</option>
</select>&nbsp;
<select name="mid">
<option value="0"<?php if($mid == 0) echo ' selected';?>>ģ��</option>
<option value="5"<?php if($mid == 5) echo ' selected';?>>���ַ�</option>
<option value="6"<?php if($mid == 6) echo ' selected';?>>��</option>
<option value="4"<?php if($mid == 4) echo ' selected';?>>��˾</option>
</select>&nbsp;
<?php echo $order_select;?>
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>ģ��</th>
<th>�ؼ���</th>
<th>����</th>
<th>��λ</th>
<th>��˾</th>
<th>��ϢID</th>
<th>��ʼʱ��</th>
<th>����ʱ��</th>
<th>ʣ��(��)</th>
<th>״̬</th>
<th>���ʱ��</th>
<th width="50">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $MODULE[$v['mid']]['name'];?></td>
<td>&nbsp;<a href="<?php echo $MODULE[$v['mid']]['linkurl'];?>search.php?kw=<?php echo urlencode($v['word']);?>" target="_blank"><?php echo $v['word'];?></td>
<td><?php echo $v['price'];?></td>
<td><?php echo $v['currency'] == 'money' ? $AJ['money_unit'] : $AJ['credit_unit'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['company'];?></a></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['mid'];?>&itemid=<?php echo $v['tid'];?>" target="_blank"><?php echo $v['tid'];?></a></td>
<td class="px11"><?php echo $v['fromdate'];?></td>
<td class="px11"><?php echo $v['todate'];?></td>
<td<?php if($v['days']<5) echo ' class="f_red"';?>><?php echo $v['days'];?></td>
<td><?php echo $v['process'];?></td>
<td class="px11" title="�༭:<?php echo $v['editor'];?>&#10;����ʱ��:<?php echo $v['editdate'];?>"><?php echo $v['adddate'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�������𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<?php if($action == 'check') { ?>
<input type="submit" value=" ͨ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check&status=3';"/>&nbsp;
<?php } else { ?>
<input type="submit" value=" ȡ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check&status=2';"/>&nbsp;
<?php } ?>
&nbsp;&nbsp;
��ʾ��ϵͳ�ᶨ���Զ����������������Ҫ��������Ч���������������
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>