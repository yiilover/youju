<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�������</div>
<form method="post" action="?" onsubmit="return Dcheck();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="area[parentid]" value="<?php echo $parentid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($parentid) {?>
<tr>
<td class="tl"><span class="f_hid">*</span> �ϼ�����</td>
<td><?php echo $AREA[$parentid]['areaname'];?></td>
</tr>
<?php }?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><textarea name="area[areaname]"  id="areaname" style="width:200px;height:100px;overflow:visible;"></textarea><?php tips('����������ӣ�һ��һ������س�����');?></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">
function Dcheck() {
	if(Dd('areaname').value == '') {
		Dtip('����д�������ơ�����������ӣ�һ��һ������س�����');
		Dd('areaname').focus();
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>