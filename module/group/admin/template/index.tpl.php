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
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="25" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $level_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>
&nbsp;<select name="datetype">
<option value="edittime" <?php if($datetype == 'edittime') echo 'selected';?>>��������</option>
<option value="addtime" <?php if($datetype == 'addtime') echo 'selected';?>>��������</option>
<option value="totime" <?php if($datetype == 'totime') echo 'selected';?>>��������</option>
<option value="totime" <?php if($datetype == 'endtime') echo 'selected';?>>��������</option>
</select>&nbsp;
<?php echo dcalendar('fromdate', $fromdate, '');?> �� <?php echo dcalendar('todate', $todate, '');?>&nbsp;
<?php echo category_select('catid', '������ҵ', $catid, $moduleid);?>&nbsp;
<?php echo ajax_area_select('areaid', '���ڵ���', $areaid);?>&nbsp;
<select name="logistic">
<option value="-1">����</option>
<option value="0" <?php if($logistic == 0) echo 'selected';?>>����Ҫ</option>
<option value="1" <?php if($logistic == 1) echo 'selected';?>>��Ҫ</option>
</select>&nbsp;
<select name="process">
<option value="-1">״̬</option>
<option value="0" <?php if($process == 0) echo 'selected';?>>������</option>
<option value="1" <?php if($process == 1) echo 'selected';?>>�Ź���</option>
<option value="2" <?php if($process == 2) echo 'selected';?>>�ѽ���</option>
</select>&nbsp;
ID��<input type="text" size="4" name="itemid" value="<?php echo $itemid;?>"/>
</td>
</tr>
<tr>
<td>
&nbsp;�Ź��ۣ�<input type="text" size="4" name="minprice" value="<?php echo $minprice;?>"/> ~ <input type="text" size="4" name="maxprice" value="<?php echo $maxprice;?>"/>&nbsp;
�г��ۣ�<input type="text" size="4" name="minmarketprice" value="<?php echo $minmarketprice;?>"/> ~ <input type="text" size="4" name="maxmarketprice" value="<?php echo $maxmarketprice;?>"/>&nbsp;
���������<input type="text" size="4" name="minminamount" value="<?php echo $minminamount;?>"/> ~ <input type="text" size="4" name="maxminamount" value="<?php echo $maxminamount;?>"/>&nbsp;
���������<input type="text" size="4" name="minamount" value="<?php echo $minamount;?>"/> ~ <input type="text" size="4" name="maxamount" value="<?php echo $maxamount;?>"/>&nbsp;
�ۿۣ�<input type="text" size="2" name="mindiscount" value="<?php echo $mindiscount;?>"/> ~ <input type="text" size="2" name="maxdiscount" value="<?php echo $maxdiscount;?>"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo $menus[$menuid][0];?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ҵ</th>
<th width="14"> </th>
<th width="70">ͼƬ</th>
<th>�� ��</th>
<th>��Ա</th>
<th>�Ź���</th>
<th>�ۿ�</th>
<th>����</th>
<th>����</th>
<th>����</th>
<th width="70">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="<?php echo $v['caturl'];?>" target="_blank"><?php echo $v['catname'];?></a></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>��" alt=""/></a><?php } ?></td>
<td><a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="<?php echo $v['thumb'] ? $v['thumb'] : AJ_SKIN.'image/nopic60.gif';?>" width="60" style="padding:5px;"/></a></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank" class="t f_b"><?php echo $v['title'];?></a><?php if($v['vip']) {?> <img src="<?php echo AJ_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif" title="<?php echo VIP;?>:<?php echo $v['vip'];?>" align="absmiddle"/><?php } ?><br/>
<span class="f_gray">
&nbsp;����:<span class="px11"><?php echo timetodate($v['edittime'], 6);?></span> <?php echo $_process[$v['process']];?> <br/>
&nbsp;���:<span class="px11"><?php echo timetodate($v['addtime'], 6);?></span>
</span>
</td>
<td>
<?php if($v['username']) { ?>
<a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a>
<?php } else { ?>
	<a href="javascript:_ip('<?php echo $v['ip'];?>');" title="�ο�"><?php echo $v['ip'];?></a>
<?php } ?>
</td>
<td class="f_price" title="�г��ۣ�<?php echo $v['marketprice'];?> ��ʡ��<?php echo $v['savemoney'];?> �ۿۣ�<?php echo $v['discount'];?>"><?php echo $v['price'];?></td>
<td class="px11"><?php echo $v['discount'];?></td>
<td class="px11"><?php echo $v['orders'];?></td>
<td class="px11"><?php echo $v['sales'];?></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td>
<a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&file=order&gid=<?php echo $v['itemid'];?>', '[<?php echo $v['alt'];?>] �����б�');"><img src="admin/image/order.gif" width="16" height="16" title="������" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php } ?>
</table>
<div class="btns">

<?php if($action == 'check') { ?>

<input type="submit" value=" ͨ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check';"/>&nbsp;
<input type="submit" value=" �� �� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=reject';"/>&nbsp;
<input type="submit" value=" �ƶ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=move';"/>&nbsp;
<input type="submit" value=" ����վ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��<?php echo $MOD['name'];?>�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;

<?php } else if($action == 'expire') { ?>

<span class="f_red f_r">
�����ӳ�����ʱ�� <input type="text" size="3" name="days" id="days" value="60"/> 
�� <input type="submit" value=" ȷ �� " class="btn" onclick="if(Dd('days').value==''){alert('����д����');return false;}if(confirm('ȷ��Ҫ�ӳ�'+Dd('days').value+'����')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=expire&refresh=1&extend=1'}else{return false;}"/>
</span>

<input type="submit" value="ˢ�¹���" class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=expire&refresh=1';"/>&nbsp;
<input type="submit" value=" ����վ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��<?php echo $MOD['name'];?>�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;

<?php } else if($action == 'reject') { ?>

<input type="submit" value=" ����վ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��<?php echo $MOD['name'];?>�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;

<?php } else if($action == 'recycle') { ?>

<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��<?php echo $MOD['name'];?>�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" �� ԭ " class="btn" onclick="if(confirm('ȷ��Ҫ��ԭѡ��<?php echo $MOD['name'];?>��״̬��������Ϊ��ͨ��')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=restore'}else{return false;}"/>&nbsp;
<input type="submit" value=" �� �� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=clear';"/>

<?php } else { ?>

<input type="submit" value=" ������Ϣ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=update';"/>&nbsp;
<?php if($MOD['show_html']) { ?><input type="submit" value=" ������ҳ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=tohtml';"/>&nbsp;<?php } ?>
<input type="submit" value=" ����վ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��<?php echo $MOD['name'];?>�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" �ƶ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=move';"/>&nbsp;
<?php echo level_select('level', '���ü���Ϊ</option><option value="0">ȡ��', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>
<?php } ?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>