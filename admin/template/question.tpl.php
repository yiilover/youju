<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">��������</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="50"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����</th>
<th>��</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['qid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['qid'];?>][question]" type="text" size="50" value="<?php echo $v['question'];?>"/></td>
<td><input name="post[<?php echo $v['qid'];?>][answer]" type="text" size="50" value="<?php echo $v['answer'];?>"/></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">����</td>
<td><textarea name="post[0][question]" rows="10" cols="50"></textarea></td>
<td><textarea name="post[0][answer]" rows="10" cols="50"></textarea></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'����֤���⣿ȷ��Ҫɾ����')) return false;" class="btn"/>&nbsp;&nbsp;<input type="submit" name="submit" value="ɾ��ѡ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'�����ȷ��Ҫɾ����')) return false;" class="btn"/></td>
</tr>
<tr>
<td colspan="4"><div class="pages"><?php echo $pages;?></div></td>
</tr>
<tr>
<td> </td>
<td colspan="3">
&nbsp;&nbsp;1���������ʱ������ʹ�һ��һ���������Ӧ<br/>
&nbsp;&nbsp;2������𰸲�Ψһ��������������д�����<br/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>