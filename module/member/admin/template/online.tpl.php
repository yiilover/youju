<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��Ա����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="40" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<select name="online">
<option value="2"<?php if($online==2) echo ' selected';?>>״̬</option>
<option value="1"<?php if($online==1) echo ' selected';?>>����</option>
<option value="0"<?php if($online==0) echo ' selected';?>>����</option>
</select>&nbsp;
<?php echo module_select('mid', 'ģ��', $mid);?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<div class="tt">���߻�Ա</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="60">ͷ��</th>
<th>��Ա��</th>
<th>״̬</th>
<th>����ģ��</th>
<th>IP</th>
<th>IP���ڵ�</th>
<th>����ʱ��</th>
<th width="50">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><img src="<?php echo useravatar($v['username']);?>" style="padding:5px;"/></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>')"><?php echo $v['username'];?></a></td>
<td><?php echo $v['online'] ? '<span class="f_green">����</span>' : '<span class="f_gray">����</span>';?></td>
<td><a href="<?php echo $MODULE[$v['moduleid']]['linkurl'];?>" target="_blank"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['lasttime'];?></td>
<td>
<a href="javascript:_user('<?php echo $v['username'];?>')"><img src="admin/image/view.png" width="16" height="16" title="��Ա[<?php echo $v['username'];?>]��ϸ����" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="�����Ա��Ա����" alt=""/></a> 
</td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>