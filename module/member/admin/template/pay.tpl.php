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
<?php echo $module_select;?>
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
��ϢID��<input type="text" name="itemid" value="<?php echo $itemid;?>" size="10"/> 
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<select name="currency">
<option value=""<?php echo $currency == '' ? ' selected' : '';?>>֧��</option>
<option value="money"<?php echo $currency == 'money' ? ' selected' : '';?>><?php echo $AJ['money_name'];?></option>
<option value="credit"<?php echo $currency == 'credit' ? ' selected' : '';?>><?php echo $AJ['credit_name'];?></option>
</select>&nbsp;
<input type="text" name="minamount" value="<?php echo $minamount;?>" size="5"/> �� 
<input type="text" name="maxamount" value="<?php echo $maxamount;?>" size="5"/>&nbsp;
��Ա����<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
��ˮ�ţ�<input type="text" name="pid" value="<?php echo $pid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">֧����¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ˮ��</th>
<th>���</th>
<th>��λ</th>
<th>ģ��</th>
<th>����</th>
<th>��Ա����</th>
<th>IP</th>
<th width="130">֧��ʱ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['pid'];?>"/></td>
<td><?php echo $v['pid'];?></td>
<td class="f_blue"><?php echo $v['fee'];?></td>
<td><?php echo $v['currency'] == 'money' ? $AJ['money_unit'] : $AJ['credit_unit'];?></td>
<td><?php echo $MODULE[$v['moduleid']]['name'];?></td>
<td><a href="<?php echo $EXT['linkurl'];?>redirect.php?mid=<?php echo $v['moduleid'];?>&itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['title'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><a href="javascript:_ip('<?php echo $v['ip'];?>');"><?php echo $v['ip'];?></a></td>
<td class="px11"><?php echo $v['paytime'];?></td>
</tr>
<?php }?>
<tr align="center">
<td></td>
<td><strong>С��</strong></td>
<td class="f_blue"><?php echo $fee;?></td>
<td colspan="7">&nbsp;</td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<br/>
<?php include tpl('footer');?>