<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($print) { ?>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�Ż���</th>
<th>����</th>
<th>���</th>
<th>��Ч����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><?php echo $v['number'];?></td>
<td><?php echo $v['type'] ? '��Ч��' : '�ֽ��';?></td>
<td class="f_blue"><?php echo $v['amount'];?></td>
<td><?php echo $v['totime'];?></td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Dh('aijiacms_menu');</script>
<?php exit; } ?>
<div class="tt">�Ż�������</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<select name="status">
<option value="0">״̬</option>
<option value="1" <?php if($status == 1) echo 'selected';?>>��ʹ��</option>
<option value="2" <?php if($status == 2) echo 'selected';?>>�ѹ���</option>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="updatetime" <?php if($timetype == 'updatetime') echo 'selected';?>>ʹ��ʱ��</option>
<option value="totime" <?php if($timetype == 'totime') echo 'selected';?>>����ʱ��</option>
<option value="addtime" <?php if($timetype == 'addtime') echo 'selected';?>>�ƿ�ʱ��</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
��ȣ�
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> �� 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
��Ա����<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
���룺<input type="text" name="number" value="<?php echo $number;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<div class="tt">�Ż������</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>�Żݴ���</th>
<th>����</th>
<th>�Żݶ��</th>
<th>��Ч����</th>
<th>ʹ�û�Ա</th>
<th>ʹ��ʱ��/����</th>
<th>ʹ��IP</th>
<th>�ظ�</th>
<th>����ʱ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td<?php if($v['reuse']) { ?> class="f_b"<?php } ?>><?php echo $v['number'];?></td>
<td><?php echo $v['type'] ? '��Ч��' : '�ֽ��';?></td>
<td class="f_blue"><?php echo $v['amount'];?><?php echo $v['type'] ? '��' : $AJ['money_unit'];?></td>
<td><?php echo $v['totime'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $v['updatetime'];?></td>
<td><a href="javascript:_ip('<?php echo $v['ip'];?>');" title="��ʾIP���ڵ�"><?php echo $v['ip'];?></a></td>
<td><?php echo $v['reuse'] ? '<span class="f_red">��</span>' : '��';?></td>
<td title="������:<?php echo $v['editor'];?>"><?php echo $v['addtime'];?></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ���Ż����𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="button" value=" ��ӡ���� " class="btn" onclick="window.open('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&print=1');"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>