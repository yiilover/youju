<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��Ա����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="export" id="export" value="<?php echo $export;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<select name="site">
<option value="">ƽ̨�ӿ�</option>
<?php
foreach($OAUTH as $k=>$v) {
	echo '<option value="'.$k.'" '.($site == $k ? 'selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>&nbsp;
<?php echo $order_select;?>
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>ͷ��&nbsp;
<input type="checkbox" name="link" value="1"<?php echo $link ? ' checked' : '';?>/>��ַ&nbsp;
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn" onclick="Dd('export').value=0;"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<div class="tt">�ʺŰ�</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="70">ͷ��</th>
<th>�ǳ�</th>
<th>��Ա��</th>
<th>ƽ̨</th>
<th>��ʱ��</th>
<th>�ϴε�¼</th>
<th>��¼����</th>
<th width="40">����</th>
</tr>
<?php foreach($members as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php if($v['url']) { ?><a href="<?php echo $v['url'];?>" target="_blank" class="t"><?php } ?><img src="<?php echo $v['avatar'];?>" width="50" style="margin:10px 0 10px 0;"/><?php if($v['url']) { ?></a><?php } ?></td>
<td><?php if($v['url']) { ?><a href="<?php echo $v['url'];?>" target="_blank" class="t"><?php } ?><?php echo $v['nickname'];?><?php if($v['url']) { ?></a><?php } ?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>')"><?php echo $v['username'];?></a></td>
<td title="<?php echo $OAUTH[$v['site']]['name'];?>"><img src="api/oauth/<?php echo $v['site'];?>/ico.png"/></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td class="px11"><?php echo $v['logindate'];?></td>
<td><?php echo $v['logintimes'];?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return confirm('ȷ��Ҫ�����Ա���𣿴˲��������ɳ���');"><img src="admin/image/delete.png" width="16" height="16" title="�����" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ����� " class="btn" onclick="if(confirm('ȷ��Ҫ�����Ա���𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>