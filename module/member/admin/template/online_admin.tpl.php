<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">���߹���Ա</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="60">ͷ��</th>
<th>��Ա��</th>
<th>����ģ��</th>
<th>IP</th>
<th>IP���ڵ�</th>
<th>����ʱ��</th>
<th>URL</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><img src="<?php echo useravatar($v['username']);?>" style="padding:5px;"/></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>')"><span<?php echo $sid == $v['sid'] ? ' style="color:red;" title="��"' : '';?>><?php echo $v['username'];?></span></a></td>
<td><a href="<?php echo $MODULE[$v['moduleid']]['linkurl'];?>" target="_blank"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['lasttime'];?></td>
<td><input type="text" size="30" value="<?php echo $v['qstring'];?>" title="<?php echo $v['qstring'];?>"/></td>
</tr>
<?php }?>
</table>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>