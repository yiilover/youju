<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">ע������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;&nbsp;&nbsp;1�����������<span class="f_red">�޸�</span>��<span class="f_red">ɾ��</span>���������Ϊ�˱�֤�����ٶȣ�ϵͳ���Զ��޸��ṹ������<span class="f_red">�������</span>��<span class="f_red">����ʧ��</span>ʱ������»������޸�����ṹ�����¡�</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;2��<span class="f_red">ɾ������</span>�Ὣ�����µ���Ϣ��������վ�����౾������޸����ƺ��ϼ����࣬û���������������ֱ��ɾ�����ࡣ</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;3���޸��ϼ�ID���Կ����޸ķ�����ϼ����࣬�ı����ṹ��</td>
</tr>
</table>

<form method="post" action="?">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<input type="submit" name="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?mid=<?php echo $mid;?>&file=<?php echo $file;?>');"/>&nbsp;
</td>
</tr>
</table>
</div>
</form>
<div class="tt"><?php if($parentid) echo $CATEGORY[$parentid]['catname'];?>�������</div>
<form method="post">
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����</th>
<th>ID</th>
<th>�ϼ�ID</th>
<th>������</th>
<th>����Ŀ¼</th>
<th>����</th>
<th>����</th>
<th colspan="2">��Ϣ����</th>
<th>����</th>
<th>����</th>
<th width="80">����</th>
</tr>
<?php foreach($AJCAT as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="catids[]" value="<?php echo $v['catid'];?>"/></td>
<td><input name="category[<?php echo $v['catid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td>&nbsp;<a href="<?php echo $MODULE[$mid]['linkurl'].$v['linkurl'];?>" target="_blank"><?php echo $v['catid'];?></a>&nbsp;</td>
<td><input name="category[<?php echo $v['catid'];?>][parentid]" type="text" size="5" value="<?php echo $v['parentid'];?>"/></td>
<td>
<input name="category[<?php echo $v['catid'];?>][catname]" type="text" value="<?php echo $v['catname'];?>" style="width:100px;color:<?php echo $v['style'];?>"/>
<?php echo dstyle('category['.$v['catid'].'][style]', $v['style']);?>
</td>
<td><input name="category[<?php echo $v['catid'];?>][catdir]" type="text" value="<?php echo $v['catdir'];?>" size="10"/></td>
<td>
<input name="category[<?php echo $v['catid'];?>][letter]" type="text" value="<?php echo $v['letter'];?>" size="1"/>
</td>
<td>
<input name="category[<?php echo $v['catid'];?>][level]" type="text" value="<?php echo $v['level'];?>" size="1"/>
</td>
<td><script type="text/javascript">perc(<?php echo $v['item'];?>,<?php echo $total;?>,'80px');</script></td>
<td><?php echo $v['item'];?></td>
<td title="�����ӷ���"><a href="?file=<?php echo $file;?>&mid=<?php echo $mid;?>&parentid=<?php echo $v['catid'];?>"><?php echo $v['childs'];?></a></td>
<td title="��������"><a href="###" onclick="Dwidget('?file=property&catid=<?php echo $v['catid'];?>', '[<?php echo $v['catname'];?>]��չ����');"><?php echo $v['property'];?></a></td>
<td>
<a href="?file=<?php echo $file;?>&action=add&mid=<?php echo $mid;?>&parentid=<?php echo $v['catid'];?>"><img src="admin/image/add.png" width="16" height="16" title="����ӷ���" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=edit&mid=<?php echo $mid;?>&catid=<?php echo $v['catid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&mid=<?php echo $mid;?>&catid=<?php echo $v['catid'];?>&parentid=<?php echo $parentid;?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<span class="f_r">
��������:<strong class="f_red"><?php echo count($CATEGORY);?></strong>&nbsp;&nbsp;
��ǰĿ¼:<strong class="f_blue"><?php echo count($AJCAT);?></strong>&nbsp;&nbsp;
</span>
<input type="submit" name="submit" value="���·���" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=update'"/>&nbsp;
<input type="submit" value="ɾ��ѡ��" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�з����𣿴˲��������ɳ���')){this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&parentid=<?php echo $parentid;?>&action=delete'}else{return false;}"/>
<?php if($parentid) {?>&nbsp;
<input type="button" value="�ϼ�����" class="btn" onclick="Go('?file=<?php echo $file;?>&mid=<?php echo $mid;?>&parentid=<?php echo $CATEGORY[$parentid]['parentid'];?>');"/>
<?php }?>
</div>
</form>
<form method="post" action="?">
<div class="tt">��ݲ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr align="center">
<td>
<div style="float:left;padding:10px;">
<?php echo category_select('cid', '����ṹ', $parentid, $mid, 'size="2" style="width:200px;height:130px;"');?></div>
<div style="float:left;padding:10px;">
	<table>
	<tr>
	<td><input type="submit" value="�������" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&parentid='+Dd('catid_1').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="��ӷ���" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&action=add&parentid='+Dd('catid_1').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="�޸ķ���" class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&action=edit&catid='+Dd('catid_1').value;"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="ɾ������" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�з����𣿴˲��������ɳ���')){this.form.action='?mid=<?php echo $mid;?>&file=<?php echo $file;?>&action=delete&catid='+Dd('catid_1').value;}else{return false;}"/></td>
	</tr>
	</table>
</div>
</td>
</tr>
</table>
</div>
</form>
<script type="text/javascript">
function Prop(t, n) {
	mkDialog('', '<iframe src="?file=property&catid='+n+'" width="700" height=300" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '['+t+']��չ����', 720, 0, 0);
}
</script>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>