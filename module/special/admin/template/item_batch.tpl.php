<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��Ϣɸѡ</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="specialid" value="<?php echo $specialid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<select name="mid">
<option value="0">��ѡ��</option>
<?php
foreach($MODULE as $m) {
	if(!$m['islink'] && $m['moduleid'] > 4 && $m['moduleid'] != $moduleid) echo '<option value="'.$m['moduleid'].'"'.($mid == $m['moduleid'] ? ' selected' : '').'>'.$m['name'].'</option>';
}
?>
</select>&nbsp;
<?php if($mid) echo category_select('catid', '��ѡ�����', $catid, $mid).'&nbsp;';?>
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="ɸ ѡ" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&specialid=<?php echo $specialid;?>&mid=21');"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="specialid" value="<?php echo $specialid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th width="30"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����</th>
<th width="14"> </th>
<th>����</th>
<th width="120">���ʱ��</th>
<th>���</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="<?php echo $v['caturl'];?>" target="_blank"><?php echo $v['catname'];?></a></td>
<td><?php if($v['level']) {?><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>��" alt=""/><?php } ?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['title'];?></a></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td class="px11"><?php echo $v['hits'];?></td>
</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td colspan="6" class="f_red">&nbsp;&nbsp;û���ҵ����õ���Ϣ��������ɸѡ</td>
</tr>
<?php } ?>
<tr>
<td colspan="6">&nbsp;&nbsp;
<?php echo type_select($tid, 0, 'typeid', '��ѡ�����', 0, 'id="typeid"');?>&nbsp;&nbsp;
 <?php echo level_select('level', '����', 0, 'id="level"');?>&nbsp;&nbsp;
<input type="submit" name="submit" value=" �� �� " class="btn"/></td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>