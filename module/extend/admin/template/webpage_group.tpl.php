<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><input name="name" type="text" size="20" value="<?php echo $name;?>"/> <span class="f_gray">�������ƣ����� ��������</span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �����ʶ</td>
<td><input name="item" type="text" size="20" value="<?php echo $item;?>"/> <span class="f_gray">���ֺ���ĸ��ϣ����� aboutus</span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>