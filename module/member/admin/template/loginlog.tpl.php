<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��־����</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> �� <?php echo dcalendar('todate', $todate);?>&nbsp;
<select name="admin">
<option value="-1" <?php echo $admin == -1 ? 'selected' : '';?>>��̨</option>
<option value="1" <?php echo $admin == 1 ? 'selected' : '';?>>��</option>
<option value="0" <?php echo $admin == 0 ? 'selected' : '';?>>��</option>
</select>&nbsp;
��Ա����<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<div class="tt">��¼��־</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>��־ID</th>
<th>��Ա��</th>
<th>����[�Ѽ���]</th>
<th>ʱ��</th>
<th>��̨</th>
<th>���</th>
<th>IP</th>
<th>����</th>
<th>�ͻ���</th>
</tr>
<?php foreach($logs as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="px11"><?php echo $v['logid'];?></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&username=<?php echo $v['username'];?>"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['password'];?></td>
<td class="px11"><?php echo $v['logintime'];?></td>
<td><?php echo $v['admin'] ? '<span class="f_blue">��</span>' : '��';?></td>
<td><?php echo $v['message'];?></td>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&ip=<?php echo $v['loginip'];?>"><?php echo $v['loginip'];?></a></td>
<td><?php echo ip2area($v['loginip']);?></td>
<td title="<?php echo $v['agent'];?>"><input type="text" value="<?php echo $v['agent'];?>" size="20" onmouseover="this.select();"/></td>
</tr>
<?php }?>
</table>
<div class="tt">���빤��</div>
<form action="?">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
����(����)��<input type="text" size="15" name="password" id="password"/>
<input type="button" value="�� ��" class="btn" onclick="md();"/>
���ܽ���� <input type="text" size="40" name="md5" id="md5"/>
��־ID��<input type="text" size="5" name="logid" id="logid"/>
<input type="button" value="�� ��" class="btn" onclick="cp();"/>&nbsp;
<span id="cpr" class="f_red"></span>
</td>
</tr>
<tr>
<td>
&nbsp;&nbsp;����˵����1�����ڷ����ʺŵ�¼�쳣�����2���ػ����ƽ�IP��3����֤�û��ʺ������ṩ����ʷ�����Ƿ�ƥ��
</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">
function md() {
	if(Dd('password').value == '') {
		alert('����������(����)');
		Dd('password').focus();
		return;
	}
	makeRequest('file=<?php echo $file;?>&moduleid=<?php echo $moduleid;?>&action=md&password='+Dd('password').value, '?', '_md');
}
function _md() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Dd('md5').value = xmlHttp.responseText;
		}
	}
}
function cp() {
	Dd('cpr').innerHTML = '';
	if(Dd('md5').value == '' || Dd('logid').value == '') {
		alert('����������������Ҫ�Աȵ���־ID');
		return;
	}
	makeRequest('file=<?php echo $file;?>&moduleid=<?php echo $moduleid;?>&action=cp&password='+Dd('md5').value+'&logid='+Dd('logid').value, '?', '_cp');
}
function _cp() {    
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Dd('cpr').innerHTML = xmlHttp.responseText;
		}
	}
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>