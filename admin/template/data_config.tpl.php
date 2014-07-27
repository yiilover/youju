<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="type" value="<?php echo $type;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="tb" value="<?php echo $tb;?>"/>
<input type="hidden" name="data[type]" value="<?php echo $type;?>"/>
<input type="hidden" name="data[mid]" value="<?php echo $mid;?>"/>
<input type="hidden" name="data[tb]" value="<?php echo $tb;?>"/>
<input type="hidden" name="data[lasttime]" value="<?php echo $lasttime;?>"/>
<input type="hidden" name="data[lastid]" value="<?php echo $lastid;?>"/>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td>
<?php
	if($type == 0) {
		echo $MODULE[$mid]['name'];
	} else if($type == 1) {
		echo '��Ա';
	} else if($type == 2) {
		echo $tb;
	}
?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td class="f_gray">
<input type="text" name="name" size="30" value="<?php echo $name;?>" id="name"/><br/>
- �����֡���ĸ���»��ߡ��л��ߡ��� ϵͳ�����������ļ��� file/data/ Ŀ¼
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����˵��</td>
<td class="f_gray">
<input type="text" name="data[title]" size="60" value="<?php echo $title;?>"/><br/>
- ���õ�һЩ˵������ע���� ֧������
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����Դ</td>
<td>
<input type="radio" name="data[database]" value="mysql" id="d_0" <?php echo $database == 'mysql' ? 'checked' : '';?>/><label for="d_0"/> MySQL</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="data[database]" value="mssql" id="d_1" <?php echo $database == 'mssql' ? 'checked' : '';?>/><label for="d_1"/> MSSQL2000</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="data[database]" value="access" id="d_2" <?php echo $database == 'access' ? 'checked' : '';?>/><label for="d_2"/> Access</label>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������ַ</td>
<td class="f_gray">
<input type="text" name="data[db_host]" size="40" value="<?php echo $db_host;?>"/><br/>
- Access�ļ��봫����վĿ¼ ���� file/data/access.mdb Ȼ�� ��д file/data/access.mdb
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input type="text" name="data[db_user]" size="20" value="<?php echo $db_user;?>"/> </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td><input type="text" name="data[db_pass]" size="20" value="<?php echo $db_pass;?>"/> </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ݿ�</td>
<td><input type="text" name="data[db_name]" size="20" value="<?php echo $db_name;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���ݱ�</td>
<td class="f_gray">
<input type="text" name="data[db_table]" size="60" value="<?php echo $db_table;?>" id="db_table"/><br/>
- ����ǵ�������д��ȫ��������Ƕ��������д���� table_a a,table_b b<br/>
- MySQL���ݿ� �����������ݺ͵�ǰϵͳ��ͬһ�������Ĳ�ͬ���ݿ⣬����д ���ݿ���.���� ���� name.table<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �����ֶ�</td>
<td class="f_gray">
<input type="text" name="data[db_key]" size="20" value="<?php echo $db_key;?>" id="db_key"/><br/>
- ������������û�У����ȴ���һ������<br/>
- ����������������ϱ��� ���� a.id<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> Դ�����ַ���</td>
<td class="f_gray">
<input type="text" name="data[db_charset]" size="10" value="<?php echo $db_charset;?>" id="db_charset"/><br/>
- ����ַ����뵱ǰϵͳһ�£���������д��һ��ΪUTF-8��GBK��<br/>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td class="f_gray">
<input type="text" name="data[db_condition]" size="80" value="<?php echo $db_condition;?>"/><br/>
- ֧��SQL��䣬������AND��ͷ������ AND id>1000��AND a.id=b.id
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ϴε���ID</td>
<td class="f_gray">
<input type="text" name="data[lastid]" size="5" value="<?php echo $lastid ? $lastid : 0;?>"/><br/>
- ϵͳ����¼�ϴε���ID�������´ε���ʱ�ظ�����
</td>
</tr>
</table>
<div class="tt">�ֶζ�Ӧ��ϵ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl" align="center"><span class="f_hid">*</span> ��Ӧ˵��</td>
<td colspan="3" class="f_gray">
- PHP��֧��MSSQL��Access�� ntext,nvarchar..���ͣ����ڵ���ǰ�޸�Ϊtext,varchar..����<br/>
- ֵ������д���ֻ����ַ��������ֶε�Ĭ��ֵ�������Ҫ���������뽫��������Ϊ* <br/>
- �� md5(*) ��ʾ��Դ�ֶ�md5���� md5(md5(*)) ��ʾ����2��<br/>
- �� strtotime(*) ��ʾ��2010-01-01���ڸ�ʽת��ΪUnixʱ���<br/>
- �� date('Y-m-d', *) ��ʾ��Unixʱ���ת��Ϊ����2010-01-01���ڸ�ʽ<br/>
- ֵ����֧�ֱ����������ϻ����+������ϣ�Դ���ݱ����� $F ���飬��Ӧת����������� $T ����<br/>
- �� $F['a'].$F['b'] ��ʾ��������Դ�����ֶ�a��b<br/>
- �� date('Y-m-d', $F['a']) ��Դ�ֶ�aת��Ϊ���ڸ�ʽ<br/>
- ��������Ա���ݣ���Ա����Email�ظ������ݽ����Զ�����<br/>
</td>
</tr>
<tr align="center">
<th>�ֶ�</th>
<th>����(�ο�)</th>
<th>Դ�ֶ�</th>
<th>ֵ����</th>
</tr>
<?php foreach($fields as $k=>$f) { ?>
<tr align="center">
<td class="tl"><?php echo $k;?></td>
<td><?php echo isset($names[$k]) ? $names[$k] : '';?></td>
<td><input type="text" size="15" name="data[fields][<?php echo $k;?>][name]" value="<?php echo $f['name'];?>"/></td>
<td><input type="text" size="30" name="data[fields][<?php echo $k;?>][value]" value="<?php echo $f['value'];?>"/></td>
</tr>
<?php } ?>
<?php foreach($fields_d as $k=>$f) { ?>
<tr align="center">
<td class="tl"><?php echo $k;?></td>
<td><?php echo isset($names[$k]) ? $names[$k] : '';?></td>
<td><input type="text" size="15" name="data[fields][<?php echo $k;?>][name]" value="<?php echo $f['name'];?>"/></td>
<td><input type="text" size="30" name="data[fields][<?php echo $k;?>][value]" value="<?php echo $f['value'];?>"/></td>
</tr>
<?php } ?>
</table>
<div class="tt">PHP�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> PHP����</td>
<td class="f_gray">
- �����Ҫ�ڵ���������ִ��PHP���룬��FTP����PHP������ file/data/��������.inc.php<br/>
- ���뽫��Դ����ѭ������ʱִ�У�Դ���ݱ����� $F ���飬��Ӧת����������� $T ����<br/>
</td>
</tr>
<tr>
<td class="tl"> </td>
<td height="30"><input type="submit" name="submit" value="�� ��" class="btn"/>&nbsp;&nbsp;<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/></td>
</tr>
</table>
</form>
<br/>
<script type="text/javascript">
function check() {
	if(Dd('name').value.length < 1) {
		alert('����д��������');
		Dd('name').focus();
		return false;
	}
	if(Dd('db_table').value.length < 1) {
		alert('����д���ݱ�');
		Dd('db_table').focus();
		return false;
	}
	if(Dd('db_key').value.length < 1) {
		alert('����д�����ֶ�');
		Dd('db_key').focus();
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(6);</script>
<?php include tpl('footer');?>