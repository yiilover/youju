<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="backup" value="1"/>
<div class="tt">AIJIACMSϵͳ��[��<?php echo $dtotalsize;?>M,<?php echo count($dtables);?>����]</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>�� ��</th>
<th width="120">��ע��</th>
<th width="300" colspan="2">��С(M)</th>
<th width="100">��¼��</th>
<th width="120">�� ��</th>
</tr>
<?php foreach($dtables as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td>
<input type="checkbox" name="tables[]" value="<?php echo $v['name'];?>" checked/>
<input type="hidden" name="sizes[<?php echo $v['name'];?>]" value="<?php echo $v['tsize'];?>"/>
</td>
<td align="left">&nbsp;<?php echo $v['name'];?></td>
<td><a href="?file=<?php echo $file;?>&action=comment&table=<?php echo $v['name'];?>&note=<?php echo urlencode($v['note']);?>" title="����޸ı�ע��"><?php echo $v['note'] ? $v['note'] : '--';?></a></td>
<td width="200"><script type="text/javascript">perc(<?php echo $v['tsize'];?>,<?php echo $dtotalsize;?>,'150px');</script></td>
<td width="100" title="����:<?php echo $v['size'];?> ����:<?php echo $v['index'];?> ��Ƭ:<?php echo $v['chip'];?>"><?php echo $v['tsize'];?></td>
<td><?php echo $v['rows'];?></td>
<td><a href="?file=<?php echo $file;?>&action=repair&table=<?php echo $v['name'];?>">�޸�</a> | <a href="?file=<?php echo $file;?>&action=optimize&table=<?php echo $v['name'];?>">�Ż�</a> | <a href="###" onclick="Dict('<?php echo $v['name'];?>','<?php echo urlencode($v['note']);?>');">�ֵ�</a></td>
</tr>
<?php }?>
</table>
<?php if($tables) {?>
<div class="tt">����ϵͳ��[��<?php echo $totalsize;?>M,<?php echo count($tables);?>����]</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25">-</th>
<th>�� ��</th>
<th width="120">��ע��</th>
<th width="300" colspan="2">��С(M)</th>
<th width="100">��¼��</th>
<th width="120">�� ��</th>
</tr>
<?php foreach($tables as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td>
<input type="checkbox" name="tables[]" value="<?php echo $v['name'];?>"/>
<input type="hidden" name="sizes[<?php echo $v['name'];?>]" value="<?php echo $v['tsize'];?>"/>
</td>
<td align="left">&nbsp;<?php echo $v['name'];?></td>
<td><a href="?file=<?php echo $file;?>&action=comment&table=<?php echo $v['name'];?>&note=<?php echo urlencode($v['note']);?>" title="����޸ı�ע��"><?php echo $v['note'] ? $v['note'] : '--';?></a></td>
<td width="200"><script type="text/javascript">perc(<?php echo $v['tsize'];?>,<?php echo $totalsize;?>,'150px');</script></td>
<td width="100" title="����:<?php echo $v['size'];?> ����:<?php echo $v['index'];?> ��Ƭ:<?php echo $v['chip'];?>"><?php echo $v['tsize'];?></td>
<td><?php echo $v['rows'];?></td>
<td><a href="?file=<?php echo $file;?>&action=repair&table=<?php echo $v['name'];?>">�޸�</a> | <a href="?file=<?php echo $file;?>&action=optimize&table=<?php echo $v['name'];?>">�Ż�</a> | <a href="###" onclick="Dict('<?php echo $v['name'];?>','<?php echo urlencode($v['note']);?>');">�ֵ�</a></td>
</tr>
<?php }?>
</table>
<?php } ?>
<div class="tt">����ѡ�б�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="120">&nbsp;&nbsp;&nbsp;�־��ļ���С</td>
<td>
<span class="f_r">
<a href="javascript:" onclick="checkall(Dd('dform'), 1);" class="t">��ѡ</a>&nbsp;&nbsp;
<a href="javascript:" onclick="checkall(Dd('dform'), 2);" class="t">ȫѡ</a>&nbsp;&nbsp;
<a href="javascript:" onclick="checkall(Dd('dform'), 3);" class="t">ȫ��ѡ</a>&nbsp;&nbsp;
</span>
&nbsp;<input type="text" name="sizelimit" value="2048" size="5"/> K</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;��������ʽ</td>
<td>&nbsp;<input type="radio" name="sqlcompat" value="" checked="checked"/> Ĭ�� &nbsp; <input type="radio" name="sqlcompat" value="MYSQL40"/> MySQL 3.23/4.0.x &nbsp; <input type="radio" name="sqlcompat" value="MYSQL41"/> MySQL 4.1.x/5.x &nbsp;</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;ǿ���ַ���</td>
<td>&nbsp;<input type="radio" name="sqlcharset" value="" checked/> Ĭ�� &nbsp; <input type="radio" name="sqlcharset" value="utf8"/> UTF-8 &nbsp; <input type="radio" name="sqlcharset" value="gbk"/> GBK &nbsp; <input type="radio" name="sqlcharset" value="latin1"/> LATIN1</td>
</tr>
</table>
<div class="btns">
<input type="submit" name="submit" value="��ʼ����" class="btn"/>&nbsp;
<input type="submit" value="�ؽ�ע��" class="btn" onclick="if(confirm('ȷ��Ҫ�ؽ���ע����')){this.form.action='?file=<?php echo $file;?>&action=comments';}else{return false;}"/>&nbsp;
<input type="submit" value="ɾ����" class="btn" onclick="if(confirm('���棡ȷ��Ҫɾ���б��𣿴˲��������ɻָ�\n\nΪ��ϵͳ��ȫ��ϵͳ��ɾ����aijiacmsϵͳ��')){this.form.action='?file=<?php echo $file;?>&action=drop';}else{return false;}"/>
</div>
</form>
<br/>
<script type="text/javascript">
function Dict(t, n) {
	Dwidget('?file=tag&action=dict&table='+t+'&note='+n, '�����ֵ�');
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>