<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">ִ��SQL</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;&nbsp;<textarea name="sql" id="sql" style="width:98%;height:150px;overflow:visible;font-family:Fixedsys,verdana;"></textarea></td>
</tr>
<tr>
<td>
&nbsp;&nbsp;<input type="submit" name="submit" value="ִ ��" class="btn"/> <span id="dsql" class="f_red"></span></td>
</tr>
</table>
</form>
<script type="text/javascript">
function check() {
	if(Dd('sql').value == '') {
		Dmsg('SQL��䲻��Ϊ��', 'sql');
		return false;
	}
	return confirm('ȷ��Ҫִ�д�����𣿴˲��������ɻָ�');
}
</script>
<script type="text/javascript">Menuon(3);</script>
<?php include tpl('footer');?>