<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">ģ������</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $type_select;?>&nbsp;
<select name="groupid">
<option value="0">��Ա��</option>
<?php foreach($GROUP as $v) { if($v['groupid'] < 5) continue; ?>
<option value="<?php echo $v['groupid'];?>"<?php echo $v['groupid'] == $groupid ? ' selected' : '';?>><?php echo $v['groupname'];?></option>
<?php } ?>
</select>
�۸�:<input type="text" size="3" name="minfee" value="<?php echo $minfee;?>"/>~
<input type="text" size="3" name="maxfee" value="<?php echo $maxfee;?>" />&nbsp;
<select name="currency">
<option value="">��λ</option>
<option value="money"<?php echo $currency == 'money' ? ' selected' : '';?>><?php echo $AJ['money_name'];?></option>
<option value="credit"<?php echo $currency == 'credit' ? ' selected' : '';?>><?php echo $AJ['credit_name'];?></option>
<option value="free"<?php echo $currency == 'free' ? ' selected' : '';?>>���</option>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">����ģ��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="50">����</th>
<th width="220">Ԥ��ͼ</th>
<th>���Ŀ¼</th>
<th>ģ��Ŀ¼</th>
<th>��ϸ��Ϣ</th>
<th>��Ա��</th>
<th width="50">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><input name="listorder[<?php echo $v['itemid'];?>]" type="text" size="2" value="<?php echo $v['listorder'];?>"/></td>
<td style="padding:5px 0 5px 0;" title="���Ԥ��"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>" target="_blank"><img src="<?php echo $v['thumb'];?>" style="margin:0 0 5px 0;"/><br/>
<strong><?php echo $v['title'];?></strong></a>
</td>
<td><?php echo $v['skin'];?></td>
<td><a href="?file=template&dir=<?php echo $v['template'];?>"><?php echo $v['template'];?></a></td>
<td align="left">
<div style="line-height:22px;padding:0 8px 0 8px;">
���ࣺ<?php echo $v['typeid'] ? $TYPE[$v['typeid']]['typename'] : 'δ����';?><br/>
�۸�<?php echo $v['fee'] ? ($v['currency'] == 'money' ? '<span class="f_red">'.$v['fee'].$AJ['money_unit'].'/��</span>' : '<span class="f_blue">'.$v['fee'].$AJ['credit_unit'].'/��</span>') : '<span class="f_green">���</span>';?><br/>
������<?php echo $v['hits'];?><br/>
���棺<span class="f_red"><?php echo $v['money'].$AJ['money_unit'];?></span>&nbsp;&nbsp;<span class="f_blue"><?php echo $v['credit'].$AJ['credit_unit'];?></span><br/>
���ߣ�<?php echo $v['author'];?><br/>
���ڣ�<?php echo $v['adddate'];?>
</div>
</td>
<td><?php echo $v['group'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=order';"/>&nbsp;
<input type="submit" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��ģ���𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>