<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="page" value="<?php echo $page;?>"/>
<div class="tt">���۽�ֹ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">ɾ��</th>
<th>ģ��ID</th>
<th>��ϢID</th>
<th>ģ��</th>
<th>��ֹʱ��</th>
<th>������</th>
<th>ԭ��</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['bid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>

<td><input name="post[<?php echo $v['bid'];?>][moduleid]" type="text" size="10" value="<?php echo $v['moduleid'];?>"/></td>
<td><input name="post[<?php echo $v['bid'];?>][itemid]" type="text" size="10" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&mid=<?php echo $v['moduleid'];?>"><?php echo isset($MODULE[$v['moduleid']]) ? $MODULE[$v['moduleid']]['name'] : '����';?></a></td>
<td class="px11"><?php echo $v['edittime'];?></td>
<td><?php echo $v['editor'];?></td>
<td><a href="<?php echo $EXT['linkurl'];?>redirect.php?itemid=<?php echo $v['itemid'];?>&mid=<?php echo $v['moduleid'];?>" target="_blank">�����</a></td>
</td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">����</td>
<td><?php echo module_select('post[0][moduleid]', 'ģ��');?></td>
<td><input name="post[0][itemid]" type="text" size="10" value=""/></td>
<td colspan="4"> </td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value=" �� �� " onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'����ֹ��Ŀ��ȷ��Ҫɾ����')) return false;" class="btn"/></td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>