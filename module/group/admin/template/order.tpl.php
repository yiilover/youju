<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
if(!$gid) show_menu($menus);
?>
<script type="text/javascript">var errimg = '<?php echo AJ_SKIN;?>image/nopic50.gif';</script>
<div class="tt">��¼����</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<?php echo $status_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<select name="logistic">
<option value="-1">����</option>
<option value="0" <?php if($logistic == 0) echo 'selected';?>>����Ҫ</option>
<option value="1" <?php if($logistic == 1) echo 'selected';?>>��Ҫ</option>
</select>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="addtime" <?php if($timetype == 'addtime') echo 'selected';?>>�µ�ʱ��</option>
<option value="updatetime" <?php if($timetype == 'updatetime') echo 'selected';?>>����ʱ��</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="mtype">
<option value="money" <?php if($mtype == 'money') echo 'selected';?>>�����ܶ�</option>
<option value="amount" <?php if($mtype == 'amount') echo 'selected';?>>�µ����</option>
<option value="price" <?php if($mtype == 'price') echo 'selected';?>>��Ʒ����</option>
<option value="number" <?php if($mtype == 'number') echo 'selected';?>>��������</option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> �� 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
�������ţ�<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/>&nbsp;
��Ʒ���ţ�<input type="text" name="gid" value="<?php echo $gid;?>" size="10"/>&nbsp;
���ң�<input type="text" name="seller" value="<?php echo $seller;?>" size="10"/>&nbsp;
��ң�<input type="text" name="buyer" value="<?php echo $buyer;?>" size="10"/>&nbsp;

</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">���׼�¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="20"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="60">����ͼ</th>
<th>��Ʒ�����</th>
<th>�����ܶ�</th>
<th>����</th>
<th>����</th>
<th>���</th>
<th width="75">�µ�ʱ��</th>
<th width="75">����ʱ��</th>
<th>״̬</th>
<th>����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><img src="<?php if($v['thumb']) { ?><?php echo $v['thumb'];?><?php } else { ?><?php echo AJ_SKIN;?>image/nopic50.gif<?php } ?>" width="50" height="50" onerror="this.src=errimg;" style="padding:5px;"/></a></td>
<td align="left" class="f_gray">
&nbsp;
<a href="<?php echo $v['linkurl'];?>" target="_blank" class="t px14 f_b"><?php echo $v['title'];?></a><br/>&nbsp;
<strong>���ţ�</strong><?php echo $v['itemid'];?>&nbsp;
<strong>���ۣ�</strong><?php echo $v['price'];?>&nbsp;
<strong>���룺</strong><?php echo $v['password'];?>
</td>
<td class="f_red px11"><?php echo $v['money'];?></td>
<td class="px11"><?php echo $v['number'];?></td>
<td class="px11">
<a href="javascript:_user('<?php echo $v['seller'];?>');"><?php echo $v['seller'];?></a>
</td>
<td class="px11">
<a href="javascript:_user('<?php echo $v['buyer'];?>');"><?php echo $v['buyer'];?></a>
</td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td class="px11"><?php echo $v['updatetime'];?></td>
<td><?php echo $v['dstatus'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/view.png" width="16" height="16" title="�鿴" alt=""/></a>
</td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>С��</strong></td>
<td></td>
<td class="f_red f_b"><?php echo $money;?></td>
<td colspan="7">&nbsp;</td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼�������!�˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" �����˿� " class="btn" onclick="if(confirm('ȷ��Ҫ�˿�ѡ�м�¼�������!�˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=refund'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>