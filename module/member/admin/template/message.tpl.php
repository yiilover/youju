<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��Ա�ż�����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $status_select;?>&nbsp;
<select name="typeid">
<option value="-1">����</option>
<?php foreach($NAME as $k=>$v) { ?>
<option value="<?php echo $k;?>"<?php echo $k==$typeid ? ' selected' : '';?>><?php echo $v;?></option>
<?php } ?>
</select>&nbsp;
<select name="read">
<option value="-1">�Ķ�</option>
<option value="1"<?php echo $read==1 ? ' selected' : '';?>>�Ѷ�</option>
<option value="0"<?php echo $read==0 ? ' selected' : '';?>>δ��</option>
</select>&nbsp;
<select name="send">
<option value="-1">ת��</option>
<option value="1"<?php echo $send==1 ? ' selected' : '';?>>�ѷ�</option>
<option value="0"<?php echo $send==0 ? ' selected' : '';?>>δ��</option>
</select>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��Ա�ż�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="35">����</th>
<th width="60">״̬</th>
<th>����</th>
<th>�ռ���</th>
<th>������</th>
<th>����ʱ��</th>
<th width="30">�Ѷ�</th>
<th width="30">�ѷ�</th>
<th width="100">����IP</th>
<th width="30">ɾ</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&typeid=<?php echo $v['typeid'];?>"><img src="<?php echo $MODULE[2]['linkurl'];?>image/message_<?php echo $v['typeid'];?>.gif" width="16" height="16" title="<?php echo $NAME[$v['typeid']];?>" alt=""/></a></td>
<td><?php echo $S[$v['status']];?></td>
<td align="left"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&itemid=<?php echo $v['itemid'];?>" title="<?php echo $v['title'];?>">&nbsp;<?php echo dsubstr($v['title'], 50, '...');?></a></td>
<td><a href="javascript:_user('<?php echo $v['touser'];?>');"><?php echo $v['touser'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['fromuser'];?>');"><?php echo $v['fromuser'];?></a></td>
<td class="px11"><?php echo timetodate($v['addtime'], 6);?></td>
<td><?php echo $v['isread'] ? '��' : '��';?></td>
<td><?php echo $v['issend'] ? '��' : '��';?></td>
<td class="px11"><a href="javascript:_ip('<?php echo $v['ip'];?>');" title="��ʾIP���ڵ�"><?php echo $v['ip'];?></a></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ���ż��𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>