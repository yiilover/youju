<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
?>
<form action="?">
<div class="tt">��Դ����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<input type="text" size="60" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="parent.cDialog();"/>
</td>
</tr>
</table>
</form>
<div class="tt">��Դ�б�</div>
<table cellpadding="3" cellspacing="1" class="tb">
<tr>
<th>��Դ</th>
<th>��ַ</th>
<th width="40">ѡ��</th>
</tr> 
<?php foreach($lists as $k=>$v) { ?>
<tr>
<td>&nbsp;<a href="javascript:TopUseBack('<?php echo $v['copyfrom'];?>','<?php echo $v['fromurl'];?>');"><?php echo $v['copyfrom'];?></a></td>
<td>&nbsp;<a href="<?php echo $EXT['linkurl'];?>redirect.php?url=<?php echo urlencode(fix_link($v['fromurl']));?>" target="_blank"><?php echo $v['fromurl'];?></a></td>
<td align="center"><a href="javascript:TopUseBack('<?php echo $v['copyfrom'];?>','<?php echo $v['fromurl'];?>');" class="t">[ѡ��]</a></td>
</tr>
<?php } ?>
</table>
<script type="text/javascript">
function TopUseBack(v, u) {
	parent.Dd('copyfrom').value = v;
	parent.Dd('fromurl').value = u;
	parent.cDialog();
}
</script>
<?php include tpl('footer');?>