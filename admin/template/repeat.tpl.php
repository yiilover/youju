<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�������</div>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ģ��</td>
<td>
<select name="mid">
<option value="0">��ѡ��</option>
<?php foreach($MODULE as $m) { if(!$m['islink'] && $m['moduleid']>4) { ?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : '';?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ֶ�</td>
<td><input type="text" size="10" name="key" value="<?php echo $key;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����</td>
<td><input type="text" size="10" name="num" value="<?php echo $num;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ؼ���</td>
<td><input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ״̬</td>
<td>
<select name="status">
<option value="0"<?php echo $status==0 ? ' selected' : '';?>>����վ</option>
<option value="1"<?php echo $status==1 ? ' selected' : '';?>>�Ѿܾ�</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>�����</option>
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>��ͨ��</option>
<option value="4"<?php echo $status==4 ? ' selected' : '';?>>�ѹ���</option>
</select>
</td>
</tr>
<tr>
<td class="tl"></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="��ʼ���" class="btn" onclick="this.value='�����..';this.blur();this.className='btn f_gray';"/>&nbsp;
<input type="button" value="���¼��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<?php if($submit) { ?>
<div class="tt">�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>����</th>
<th>�ظ�����</th>
<th width="60">�鿴</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;&nbsp;<img src="admin/image/htm.gif" align="absmiddle"/> <a href="?moduleid=<?php echo $mid;?>&action=<?php echo $act;?>&kw=<?php echo $v['kw'];?>" target="_blank"><?php echo $v[$key];?></a></td>
<td><?php echo $v['num'];?></td>
<td><a href="?moduleid=<?php echo $mid;?>&action=<?php echo $act;?>&kw=<?php echo $v['kw'];?>" target="_blank"><img src="admin/image/view.png" width="16" height="16"/></a></td>
</tr>
<?php }?>
<?php } else { ?>
<tr>
<td class="f_blue" height="40">&nbsp;- ָ����Χû�м�⵽�ظ���Ϣ&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[���¼��]</a></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>