<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��������</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">
var _del = 0;
</script>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="60"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>���Ҵ���</th>
<th>�滻Ϊ</th>
<th width="120">����</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['bid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['bid'];?>][replacefrom]" type="text" size="40" value="<?php echo $v['replacefrom'];?>"/></td>
<td><input name="post[<?php echo $v['bid'];?>][replaceto]" type="text" size="40" value="<?php echo $v['replaceto'];?>"/></td>
<td>
<input name="post[<?php echo $v['bid'];?>][deny]" type="radio" value="1" <?php if($v['deny']) echo 'checked';?>/> ��
<input name="post[<?php echo $v['bid'];?>][deny]" type="radio" value="0" <?php if(!$v['deny']) echo 'checked';?>/> ��
</td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">����</td>
<td><textarea name="post[0][replacefrom]" rows="10" cols="40"></textarea></td>
<td><textarea name="post[0][replaceto]" rows="10" cols="40"></textarea></td>
<td>
<input name="post[0][deny]" type="radio" value="1"/> ��
<input name="post[0][deny]" type="radio" value="0" checked/> ��
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'�����ȷ��Ҫɾ����')) return false;" class="btn"/>&nbsp;&nbsp;<input type="submit" name="submit" value="ɾ��ѡ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'�����ȷ��Ҫɾ����')) return false;" class="btn"/></td>
</tr>
<tr>
<td colspan="4"><div class="pages"><?php echo $pages;?></div></td>
</tr>
<tr>
<td> </td>
<td colspan="3">
&nbsp;&nbsp;1���������ʱ�����Һ��滻����һ��һ���������Ӧ<br/>
&nbsp;&nbsp;2�����ѡ�����أ���ƥ�䵽���Ҵ���ʱֱ����ʾ���ܾ��ύ<br/>
&nbsp;&nbsp;3�����硰��*�á���ʽ�����滻�����á�֮��ĸ����ַ�<br/>
&nbsp;&nbsp;4��Ϊ��Ӱ�����Ч�ʣ��벻Ҫ���ù����������<br/>
&nbsp;&nbsp;5�����˽���ǰ̨��Ա�ύ��Ϣ��Ч����̨��������<br/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>