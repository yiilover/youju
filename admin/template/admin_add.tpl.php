<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">��ӹ���Ա</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td>
<input type="text" size="20" name="username" id="username" value="<?php echo $username;?>"/>
&nbsp;&nbsp;<a href="javascript:if(Dd('username').value)_user(Dd('username').value);" class="t" title="����鿴��д��Ա����ϸ����">[����]</a>
&nbsp;&nbsp;<a href="?moduleid=2&action=add" class="t" target="_blank" title="�����Ա��û��ע�ᣬ����������">[���]</a>
<span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����Ա���</td>
<td>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="1" id="admin_1" onclick="Dh('ro');" checked/><label for="admin_1"> ��������Ա</label> <span class="f_gray">ӵ�г���ʼ����Ȩ�������Ȩ��</span>
<div class="b10">&nbsp;</div>
<input type="radio" name="admin" value="2" id="admin_2" onclick="Ds('ro');"/><label for="admin_2"> ��ͨ����Ա</label> <span class="f_gray">ӵ��ϵͳ�����Ȩ��</span>
<div class="b10">&nbsp;</div>
<style type="text/css">
#ro {padding:5px 10px 10px 10px;border-top:#FFFFFF 1px solid;}
#ro div {width:25%;float:left;height:30px;}
#ro p {margin:2px;color:#FF6600;}
</style>
<div id="ro" style="display:none;">
<p>�����ѡ��һ�������ɫ(�Ǳ�ѡ)</p>
<?php 
foreach($MODULE as $m) {
	if($m['moduleid'] == 1 || $m['moduleid'] == 3 || $m['islink']) continue;
?>
<div><input type="checkbox" name="roles[<?php echo $m['moduleid'];?>]" value="1" id="ro_<?php echo $m['moduleid'];?>"/><label for="ro_<?php echo $m['moduleid'];?>"> <?php echo $m['name'];?>ģ�����Ա</label></div>
<?php } ?>
<div><input type="checkbox" name="roles[template]" value="1" id="ro_template"/><label for="ro_template"> ģ�������Ա</label></div>
<div><input type="checkbox" name="roles[database]" value="1" id="ro_database"/><label for="ro_database"> ���ݿ����Ա</label></div>
<div><input type="checkbox" onclick="checkall(this.form);" id="ro_all"/><label for="ro_all"> ȫѡ/��ѡ</label></div>
<p><?php echo ajax_area_select('aid', '��վȨ��');?></p>
</div>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ɫ����</td>
<td><input type="text" size="20" name="role" id="role"/> <span class="f_gray">����Ϊ��ɫ���ƣ�����༭��������ĳ��վ�༭�ȣ�Ҳ����Ϊ�ù���Ա�ı�ע</span></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value="��һ��" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	l = Dd(f).value;
	if(l == '') {
		Dmsg('����д��Ա��', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>