<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">��Ʒ����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;��Ʒ����
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">��Ʒ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">ɾ��</th>
<th>��ƷID</th>
<th>����</th>
<th>��Ʒ����</th>
<th>������λ</th>
<th>����ID</th>
<th>��������</th>
<th>��������</th>
<th>���Բ���</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['pid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><?php echo $v['pid'];?></td>
<td><input name="post[<?php echo $v['pid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][title]" type="text" size="20" value="<?php echo $v['title'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][unit]" type="text" size="5" value="<?php echo $v['unit'];?>"/></td>
<td><input name="post[<?php echo $v['pid'];?>][catid]" type="text" size="5" value="<?php echo $v['catid'];?>"/></td>
<td><?php echo cat_pos($v['catid'], ' ', 1);?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $v['pid'];?>&action=manage"><?php echo $v['items'];?></a></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $v['pid'];?>&action=add"><img src="admin/image/new.png" width="16" height="16" title="�������" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&pid=<?php echo $v['pid'];?>&action=manage"><img src="admin/image/child.png" width="16" height="16" title="��������" alt=""/></a>&nbsp;
</td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">����</td>
<td></td>
<td><input name="post[0][listorder]" type="text" size="3" value=""/></td>
<td><input name="post[0][title]" type="text" size="20" value=""/></td>
<td><input name="post[0][unit]" type="text" size="5" value=""/></td>
<td colspan="5" align="left">&nbsp;&nbsp;<?php echo ajax_category_select('post[0][catid]', 'ѡ�����', $catid, $moduleid);?></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="8">
&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value=" �� �� " onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'����Ʒ���ͣ�ȷ��Ҫɾ����')) return false;" class="btn"/>
</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<form action="?" method="post" onsubmit="return check();">
<div class="tt">ͬ������</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="copy"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;Դ��ƷID��<input type="text" size="5" name="fpid" id="fpid"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Ŀ���ƷID��<input type="text" size="20" name="tpid" id="tpid"/>&nbsp;
<input type="submit" value="ȷ��" class="btn"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;<strong>ʹ��˵��</strong></td>
</tr>
<tr>
<td style="padding:10px;color:#666666;">
1�����һ����Ʒ���ڶ�����࣬���Ȱ���������Ӵ˲�Ʒ��Ȼ��������һ��ͬ����Ʒ�½������ԣ����Խ���֮�󣬿�����ΪԴ��ƷID������ͬ��������ָ����Ŀ���Ʒ��<br/>
2��Ŀ���ƷID����ж��������Ӣ�Ķ���(,)�ָ��Ŀ���Ʒû�ж�Դ��Ʒ�е����ԣ�����������Ŀ���Ʒ��Դ��Ʒͬ�������ԣ��������¡�
</td>
</tr>
</table>
</form>
<script type="text/javascript">
function check() {
	if(Dd('fpid').value == '') {
		alert('����дԴ��ƷID');
		Dd('fpid').focus();
		return false;
	}
	if(Dd('tpid').value == '') {
		alert('����дĿ���ƷID');
		Dd('tpid').focus();
		return false;
	}
	return confirm('ȷ��Ҫͬ�������𣿴˲��������ɳ���');
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>