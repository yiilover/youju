<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">վ���ż�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">����</td>
<td class="f_b"><?php echo $title;?></td>
</tr>
<tr>
<td class="tl">������</td>
<td><a href="<?php echo userurl($fromuser);?>" target="_blank"><?php echo $fromuser;?></a></td>
</tr>
<tr>
<td class="tl">�ռ���</td>
<td><a href="<?php echo userurl($touser);?>" target="_blank"><?php echo $touser;?></a></td>
</tr>
<tr>
<td class="tl">����ʱ��</td>
<td><?php echo timetodate($addtime, 6);?></td>
</tr>
<tr>
<td class="tl">����IP</td>
<td><?php echo $ip;?></td>
</tr>
<tr>
<td class="tl">����</td>
<td><?php echo $content;?></td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="button" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ���𣿴˲��������ɳ���')) {Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $itemid;?>&forward=<?php echo urlencode($forward);?>');}"/>&nbsp;&nbsp;<input type="button" value=" �� �� " class="btn" onclick="history.back(-1);"/></div>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>