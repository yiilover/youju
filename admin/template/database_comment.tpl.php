<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="table" value="<?php echo $table;?>"/>
<input type="hidden" name="submit" value="1"/>
<div class="tt">�޸ı�ע��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ������</td>
<td class="f_b">&nbsp;<?php echo $table;?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ע��</td>
<td>&nbsp;<input type="text" name="name" value="<?php echo $note;?>" size="10"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value=" �� �� " class="btn" onclick="window.history.back(-1);"/></div>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>