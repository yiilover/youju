<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">Ʊѡ����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $type_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $AJ['city'] ? ajax_area_select('areaid', '����(��վ)', $areaid).'&nbsp;' : '';?>
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">����Ʊѡ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>ID</th>
<th>����</th>
<th width="14"> </th>
<th>����</th>
<th>״̬</th>
<th>ѡ��</th>
<th>Ʊ��</th>
<th>���</th>
<th>���ʱ��</th>
<th>���ô���</th>
<th width="90">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="�༭:<?php echo $v['editor'];?>&#10;����ʱ��:<?php echo $v['editdate'];?>">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td><a href="<?php echo $v['typeurl'];?>" target="_blank"><?php echo $v['typename'];?></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>��" alt=""/></a><?php } ?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['title'];?></td>
<td><img src="<?php echo AJ_PATH;?>file/image/process_<?php echo get_process($v['fromtime'], $v['totime']);?>.gif"/></td>
<td class="px11"><?php echo $v['items'];?></td>
<td class="px11"><?php echo $v['polls'];?></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td><input type="text" size="15" value="<script type=&quot;text/javascript&quot; src=&quot;<?php echo $EXT['poll_url'];?>index.php?action=js&itemid=<?php echo $v['itemid'];?>&quot;></script>" onmouseover="this.select();"/></td>
<td>
<a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=item&itemid=<?php echo $v['itemid'];?>', '[<?php echo $v['alt'];?>] ͶƱѡ��');"><img src="admin/image/child.png" width="16" height="16" title="����ѡ��" alt=""/></a>&nbsp;
<a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=record&pollid=<?php echo $v['itemid'];?>', '[<?php echo $v['alt'];?>] ͶƱ��¼');"><img src="admin/image/poll.png" width="16" height="16" title="ͶƱ��¼" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��Ʊѡ�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<?php echo level_select('level', '���ü���Ϊ</option><option value="0">ȡ��', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>