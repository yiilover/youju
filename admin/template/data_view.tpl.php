<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ֶ�</th>
<th>����</th>
</tr>
<?php foreach($T as $k=>$v) { ?>
<tr>
<td class="tl"><?php echo $k;?></td>
<td>&nbsp;<?php echo $v;?></td>
</tr>
<?php } ?>
</table>
<div class="tt">Դ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>�ֶ�</th>
<th>����</th>
</tr>
<?php foreach($F as $k=>$v) { ?>
<tr>
<td class="tl"><?php echo $k;?></td>
<td>&nbsp;<?php echo $v;?></td>
</tr>
<?php } ?>
</table>
<script type="text/javascript">Menuon(6);</script>
<?php include tpl('footer');?>