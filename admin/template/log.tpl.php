<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��־����</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="25" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> �� <?php echo dcalendar('todate', $todate);?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<div class="tt">������־</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>URL</th>
<th>ģ��</th>
<th>�ļ�</th>
<th>����</th>
<th>ID</th>
<th>IP</th>
<th>����</th>
<th>����Ա</th>
<th>ʱ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td title="<?php echo $v['qstring'];?>"><input type="text" size="30" value="<?php echo $v['qstring'];?>"/></td>
<td><?php echo $v['module'];?></td>
<td><?php echo $v['file'];?></td>
<td><?php echo $v['action'];?></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['mid'];?>&itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['itemid'];?></a></td>
<td><a href="javascript:_ip('<?php echo $v['ip'];?>');"><?php echo $v['ip'];?></a></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><a href="?file=<?php echo $file;?>&username=<?php echo $v['username'];?>"><?php echo $v['username'];?></a></td>
<td><?php echo $v['logtime'];?></td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>