<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt"><?php echo $menus[$menuid][0];?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr class="on">
<td>
<input type="radio" name="fromtype" value="areaid" id="f_2"/><label for="f_2">�ӵ���ID</label>&nbsp;&nbsp;
<input type="radio" name="fromtype" value="userid" <?php echo $userid ? 'checked' : '';?> id="f_3"/><label for="f_3">�ӻ�ԱID</label>
</td>
<td></td>
<td>&nbsp;Ŀ�����</td>
</tr>
<tr>
<td width="250" align="center" title="���ID��,�ֿ� ��β�Ϳ�ͷ������,">
<textarea style="height:300px;width:250px;" name="fromids"><?php echo $userid;?></textarea>
</td>
<td width="60" align="center"><strong>&rarr;</strong></td>
<td><?php echo ajax_area_select('toareaid', '', 0, 'size="2" style="height:300px;width:150px;"');?></td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;</td>
<td> </td>
<td><input type="submit" name="submit" value=" �� �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></td>
</tr>
</table>
</div>
</form>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>