<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�����б�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>��������</th>
<th>����˵��</th>
<th>���ݿ�</th>
<th width="130">�޸�ʱ��</th>
<th width="130">�ϴε���</th>
<th width="150">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr align="center">
<td><a href="?file=<?php echo $file;?>&action=config&name=<?php echo $v['name'];?>"><?php echo $v['name'];?></a></td>
<td align="left">&nbsp;<?php echo $v['title'];?></td>
<td><?php echo $v['database'];?></td>
<td class="px11"><?php echo $v['edittime'];?></td>
<td class="px11"><?php echo $v['lasttime'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=import&name=<?php echo $v['name'];?>" onclick="return confirm('ȷ��Ҫ����������ļ���\n\n�˲������ɻָ������ڵ���ǰ������ص����ݱ�');"><img src="admin/image/import.png" width="16" height="16" title="���뱾ϵ�������ļ�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=view&name=<?php echo $v['name'];?>"><img src="admin/image/view.png" width="16" height="16" title="Ч��Ԥ��" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=config&name=<?php echo $v['name'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=download&name=<?php echo $v['name'];?>"><img src="admin/image/save.png" width="16" height="16" title="����" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&name=<?php echo $v['name'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="config"/>
<div class="tt">�½�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td>
<input type="radio" name="type" value="0" id="t_0" onclick="Ds('p_0');Dh('p_2');" checked/><label for="t_0"/> ģ��</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="type" value="1" id="t_1" onclick="Dh('p_0');Dh('p_2');"/><label for="t_1"/> ��Ա</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="type" value="2" id="t_2" onclick="Dh('p_0');Ds('p_2');"/><label for="t_2"/> ����</label>
</td>
</tr>
<tr id="p_0" style="display:">
<td class="tl"><span class="f_hid">*</span> ѡ��ģ��</td>
<td>
<select name="mid" id="mid">
<option value="0">��ѡ��</option>
<?php 
foreach($MODULE as $m) {
	if($m['moduleid'] > 4 && !$m['islink']) {
?>
<option value="<?php echo $m['moduleid'];?>"><?php echo $m['name'];?></option>
<?php
	}
}
?>
</td>
</tr>
<tr id="p_2" style="display:none">
<td class="tl"><span class="f_hid">*</span> ѡ���</td>
<td>
<select name="tb" id="tb">
<option value="">��ѡ��</option>
<?php 
foreach($tables as $t) {
?>
<option value="<?php echo $t['name'];?>"><?php echo $t['name'].' ['.$t['note'].']';?></option>
<?php
}
?>
</td>
</tr>
<tr>
<td class="tl"> </td>
<td height="30"><input type="submit" value="��һ��" class="btn"/></td>
</tr>
</table>
</form>
<script type="text/javascript">
function check() {
	if(Dd('t_0').checked) {
		if(Dd('mid').value == 0) {
			alert('��ѡ��ģ��');
			Dd('mid').focus();
			return false;
		}
	}
	if(Dd('t_2').checked) {
		if(Dd('tb').value == '') {
			alert('��ѡ���');
			Dd('tb').focus();
			return false;
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(6);</script>
<?php include tpl('footer');?>