<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��¼����</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
<?php echo $fields_select;?>
&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>
&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>
&nbsp;
<select name="action">
<option value="">��֤����</option>
<?php foreach($V as $k=>$v) { ?>
<option value="<?php echo $k;?>"<?php echo $k == $action ? ' selected' : '';?>><?php echo $v;?></option>
<?php } ?>
</select>&nbsp;
<select name="status">
<option value="0">״̬</option>
<option value="3"<?php echo $status == 3 ? ' selected' : '';?>>����֤</option>
<option value="2"<?php echo $status == 2 ? ' selected' : '';?>>δ��֤</option>
</select>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��֤��¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����</th>
<th>��֤����</th>
<th>֤��1</th>
<th>֤��2</th>
<th>֤��3</th>
<th>��Ա</th>
<th>IP</th>
<th width="120">�ύʱ��</th>
<th>������</th>
<th>״̬</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $V[$v['type']];?></td>
<td><?php echo $v['title'];?></td>
<td><?php if($v['thumb']) {?> <a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="admin/image/img.gif" width="10" height="10" alt=""/></a><?php } ?></td>
<td><?php if($v['thumb1']) {?> <a href="javascript:_preview('<?php echo $v['thumb1'];?>');"><img src="admin/image/img.gif" width="10" height="10" alt=""/></a><?php } ?></td>
<td><?php if($v['thumb2']) {?> <a href="javascript:_preview('<?php echo $v['thumb2'];?>');"><img src="admin/image/img.gif" width="10" height="10" alt=""/></a><?php } ?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><a href="javascript:_ip('<?php echo $v['ip'];?>');" title="��ʾIP���ڵ�"><?php echo $v['ip'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td title="<?php echo timetodate($v['edittime']);?>"><?php echo $v['editor'];?></td>
<td><?php echo $v['status'] == 3 ? '<span class="f_green">����֤</span>' : '<span class="f_red">δ��֤</span>';?></td>
</tr>
<?php }?>
</table>
<table>
<tr>
<td>
&nbsp;<textarea style="width:300px;height:40px;" name="reason" id="reason" onfocus="if(this.value=='')this.value='����ԭ��';"/>����ԭ��</textarea> 
</td>
<td>
<input type="checkbox" name="msg" id="msg" value="1" checked/> ��Ϣ֪ͨ
<input type="checkbox" name="sms" id="sms" value="1"/> ����֪ͨ
</td>
</tr>
</table>
<div class="btns">
<input type="submit" value=" ͨ����֤ " class="btn" onclick="if(_check()){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check';}else{return false;}"/>&nbsp;
<input type="submit" value=" �ܾ���֤ " class="btn" onclick="if(_reject()){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=reject';}else{return false;}"/>&nbsp;
<input type="submit" value=" ȡ����֤ " class="btn" onclick="if(_cancel()){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=cancel';}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">
Menuon(<?php echo $menuid;?>);
function is_reason() {
	return Dd('reason').value.length > 2 && Dd('reason').value != '����ԭ��';
}
function _check() {
	return true;
}
function _reject() {
	if((Dd('msg').checked || Dd('sms').checked) && !is_reason()) {
		alert('����д����ԭ�����ȡ��֪ͨ');
		return false;
	}
	if(is_reason() && (!Dd('msg').checked && !Dd('sms').checked)) {
		alert('������Ҫѡ��һ��֪ͨ��ʽ');
		return false;
	}
	return true;
}
function _cancel() {
	if((Dd('msg').checked || Dd('sms').checked) && !is_reason()) {
		alert('����д����ԭ�����ȡ��֪ͨ');
		return false;
	}
	if(is_reason() && (!Dd('msg').checked && !Dd('sms').checked)) {
		alert('������Ҫѡ��һ��֪ͨ��ʽ');
		return false;
	}
	return confirm('�˲������ɳ�����ȷ��Ҫ������');
}
</script>
<br/>
<?php include tpl('footer');?>