<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
?>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">ɾ��</th>
<th>ID</th>
<th>����</th>
<th>����</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['typeid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><?php echo $v['typeid'];?></td>
<td><input name="post[<?php echo $v['typeid'];?>][listorder]" type="text" size="5" value="<?php echo $v['listorder'];?>" maxlength="3"/></td>
<td align="left">&nbsp;&nbsp;<input name="post[<?php echo $v['typeid'];?>][typename]" type="text" size="20" value="<?php echo $v['typename'];?>" maxlength="20" style="width:200px;color:<?php echo $v['style'];?>"/> <?php echo dstyle('post['.$v['typeid'].'][style]', $v['style']);?></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td></td>
<td class="f_red">����</td>
<td><input name="post[0][listorder]" type="text" size="5" value="" maxlength="3"/></td>
<td align="left">&nbsp;&nbsp;<input name="post[0][typename]" type="text" size="20" value="" maxlength="20" style="width:200px;"/> <?php echo dstyle('post[0][style]');?></td>
</tr>
<tr>
<td height="30"> </td>
<td> </td>
<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'�����ࣿȷ��Ҫɾ����')) return false;" class="btn"/>&nbsp;&nbsp;
<input type="button" value=" �� �� " class="btn" onclick="window.parent.location.reload();"/>
<!--<input type="button" value=" �� �� " class="btn" onclick="window.parent.cDialog();"/>--></td>
</tr>
</table>
</form>
<?php include tpl('footer');?>