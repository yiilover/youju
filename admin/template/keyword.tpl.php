<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<div class="tt">�ؼ�������</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<select name="mid">
<option value="0">ģ��</option>
<?php 
foreach($MODULE as $v) {
	if(($v['moduleid'] > 0 && $v['moduleid'] < 4) || $v['islink']) continue;
	echo '<option value="'.$v['moduleid'].'"'.($mid == $v['moduleid'] ? ' selected' : '').'>'.$v['name'].'</option>';
} 
?>
</select>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
<div class="tt">�ؼ��ʹ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>ģ��</th>
<th>�ؼ���</th>
<th>��ش�</th>
<th>ƴ��</th>
<th>���</th>
<th>������</th>
<th>����</th>
<th>����</th>
<th>����</th>
<th>״̬</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['itemid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><a href="?file=<?php echo $file;?>&mid=<?php echo $v['moduleid'];?>&status=<?php echo $status;?>"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><input name="post[<?php echo $v['itemid'];?>][word]" type="text" size="15" value="<?php echo $v['word'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][keyword]" type="text" size="20" value="<?php echo $v['keyword'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][letter]" type="text" size="15" value="<?php echo $v['letter'];?>"/></td>
<td><?php echo $v['items'];?></td>
<td><input name="post[<?php echo $v['itemid'];?>][total_search]" type="text" size="5" value="<?php echo $v['total_search'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][month_search]" type="text" size="5" value="<?php echo $v['month_search'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][week_search]" type="text" size="4" value="<?php echo $v['week_search'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][today_search]" type="text" size="3" value="<?php echo $v['today_search'];?>"/></td>
<td>
<select name="post[<?php echo $v['itemid'];?>][status]">
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>����</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>����</option>
</select>
</td>
</tr>
<?php } ?>

<tr>
<th> </th>
<th>ģ��</th>
<th>�ؼ���</th>
<th>��ش�</th>
<th>ƴ��</th>
<th>���</th>
<th>������</th>
<th>����</th>
<th>����</th>
<th>����</th>
<th>״̬</th>
</tr>

<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">����</td>
<td>
<select name="post[0][moduleid]">
<?php 
foreach($MODULE as $v) {
	if(($v['moduleid'] > 0 && $v['moduleid'] < 4) || $v['islink']) continue;
	echo '<option value="'.$v['moduleid'].'">'.$v['name'].'</option>';
} 
?>
</select>&nbsp;
</td>
<td><input name="post[0][word]" type="text" size="15" value="" onblur="get_letter(this.value);" onkeyup="Dd('keyword').value=this.value;"/></td>
<td><input name="post[0][keyword]" type="text" size="20" id="keyword"/></td>
<td><input name="post[0][letter]" id="letter" type="text" size="15" value=""/></td>
<td><input name="post[0][items]" type="text" size="3" value="0"/></td>
<td><input name="post[0][total_search]" type="text" size="5" value="1"/></td>
<td><input name="post[0][month_search]" type="text" size="5" value="1"/></td>
<td><input name="post[0][week_search]" type="text" size="4" value="1"/></td>
<td><input name="post[0][today_search]" type="text" size="3" value="1"/></td>
<td>
<select name="post[0][status]">
<option value="3"<?php echo $status==3 ? ' selected' : '';?>>����</option>
<option value="2"<?php echo $status==2 ? ' selected' : '';?>>����</option>
</select>
</td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="10">&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'���ؼ��ʣ�ȷ��Ҫɾ����')) return false;" class="btn"/>
</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">��ش�˵��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="f_gray">
- ������شʿ���ʹ��ʾ������������������� ����ؼ��ʡ�IBM�������á�IBM,�ʼǱ���������IBM�ͱʼǱ�������ʾIBM�������<br/>
- �����ش�����Ӣ��,�ָΪ��ϵͳ����Ч�ʣ����������200����
</td>
</tr>
</table>

<script type="text/javascript">
function get_letter(word) {
	makeRequest('file=<?php echo $file;?>&action=letter&word='+word, '?', '_get_letter');
}
function _get_letter() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			if(Dd('letter').value == '') Dd('letter').value = xmlHttp.responseText;
		}
	}
}
</script>
<script type="text/javascript">Menuon(<?php echo $status==3 ? '0' : '1';?>);</script>
<?php include tpl('footer');?>