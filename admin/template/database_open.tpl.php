<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">����ϵ�� <?php echo $dir;?> ��<?php echo $tid;?>���־�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ļ�����</th>
<th width="150">�ļ���С(M)</th>
<th width="200">�޸�ʱ��</th>
<th width="100">�־�</th>
<th width="100">����</th>
</tr>
<?php
for($i = 1; $i <= $tid; $i++) {
	$v = $sqls[$i];
?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td align="left">&nbsp;<img src="admin/image/sql.gif" width="16" height="16" alt="" align="absmiddle"/> <a href="<?php AJ_PATH;?>file/backup/<?php echo $dir;?>/<?php echo $v['filename'];?>" title="������Ҽ����Ϊ������ļ�" target="_blank"><?php echo $v['filename'];?></a></td>
<td><?php echo $v['filesize'];?></td>
<td title="����ʱ��:<?php echo $v['btime'];?>"><?php echo $v['mtime'];?></td>
<td><?php echo $v['number'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=import&filepre=<?php echo $v['pre'];?>&tid=<?php echo $tid;?>&import=1" onclick="return confirm('ȷ��Ҫ�����ϵ���ļ����������ݽ������ǣ��˲��������ɻָ�');"><img src="admin/image/import.png" width="16" height="16" title="���뱾ϵ�б����ļ�" alt=""/></a>&nbsp;&nbsp;<a href="?file=<?php echo $file;?>&action=download&dir=<?php echo $dir;?>&filename=<?php echo $v['filename'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>