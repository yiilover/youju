<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?">
<div class="tt">��������</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="aid" value="<?php echo $aid;?>"/>
<input type="hidden" name="ids" value="<?php echo $ids;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ����ģ��</td>
<td class="f_b">&nbsp;<?php echo $MODULE[$aid]['name'];?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ѡ�����</td>
<td>&nbsp;<?php echo category_select('catid', '��ѡ�����', 0, $aid);?></td>
</tr>
<tr>
<td class="tl">��ʾ��Ϣ</td>
<td>&nbsp;ϵͳ���Զ������Ѿ����͹�������</td>
</tr>
<tr>
<td class="tl">&nbsp;</td>
<td>&nbsp;<input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;<input type="button" value=" �� �� " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>