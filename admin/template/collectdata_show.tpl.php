<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��Ϣ�鿴</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="200">��ǩ</th>
<th>����</th>
</tr>
<?php foreach($info as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><?php echo  $k.'��'.$names[$k].'��';?></td>
<td><?php echo $v;?></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(<?php echo $m;?>);</script>
</body>
</html>