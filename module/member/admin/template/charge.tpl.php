<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��¼����</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<select name="bank">
<option value="">֧��ƽ̨</option>
<?php
foreach($PAY as $k=>$v) {
	echo '<option value="'.$k.'" '.($bank == $k ? 'selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>&nbsp;
<?php echo $status_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="sendtime" <?php if($timetype == 'sendtime') echo 'selected';?>>�µ�ʱ��</option>
<option value="receivetime" <?php if($timetype == 'receivetime') echo 'selected';?>>֧��ʱ��</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="mtype">
<option value="amount" <?php if($mtype == 'amount') echo 'selected';?>>��ֵ���</option>
<option value="fee" <?php if($mtype == 'fee') echo 'selected';?>>������</option>
<option value="money" <?php if($mtype == 'money') echo 'selected';?>>ʵ�ս��</option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> �� 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
��Ա����<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
��ˮ�ţ�<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<div class="tt">��ֵ��¼</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ˮ��</th>
<th>��ֵ���</th>
<th>������</th>
<th>ʵ�ս��</th>
<th>��Ա����</th>
<th>֧��ƽ̨</th>
<th width="110">�µ�ʱ��</th>
<th width="110">֧��ʱ��</th>
<th>������</th>
<th>״̬</th>
<th>��ע</th>
</tr>
<?php foreach($charges as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td><?php echo $v['amount'];?></td>
<td><?php echo $v['fee'];?></td>
<td class="f_blue"><?php echo $v['money'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $PAY[$v['bank']]['name'];?></td>
<td class="px11"><?php echo $v['sendtime'];?></td>
<td class="px11"><?php echo $v['receivetime'];?></td>
<td><?php echo $v['editor'];?></td>
<td><?php echo $v['dstatus'];?></td>
<td title="<?php echo $v['note'];?>"><input type="text" size="10" value="<?php echo $v['note'];?>"/></td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>С��</strong></td>
<td><?php echo $amount;?></td>
<td><?php echo $fee;?></td>
<td class="f_blue"><?php echo $money;?></td>
<td colspan="7"></td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" �˹���� " class="btn" onclick="if(confirm('ȷ��Ҫͨ��ѡ�м�¼״̬�𣿴˲��������ɳ���\n\n������δ���ʻ������������д˲���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check'}else{return false;}"/>&nbsp;
<input type="submit" value=" �� �� " class="btn" onclick="if(confirm('ȷ��Ҫ����ѡ��(��δ֪)��¼״̬�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=recycle'}else{return false;}"/>&nbsp;
<input type="submit" value=" ɾ����¼ " class="btn" onclick="if(confirm('���棺ȷ��Ҫɾ��ѡ��(��δ֪)��¼�𣿴˲��������ɳ���\n\n���������ԭ�򣬽��鲻Ҫɾ����¼���Ա��ѯ����')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<br/>
<?php include tpl('footer');?>