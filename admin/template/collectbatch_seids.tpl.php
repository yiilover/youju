<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">����ֹ��������ɼ�</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="collect"/>
<input type="hidden" name="type" value="<?php echo $type;?>" />
<input type="hidden" id="auth" name="auth" />
<input type="hidden" id="moduleid" name="moduleid" />
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ѡ��ɼ���</td>
<td>
<select class="select" size="1" name="siteid" id="siteid" onchange="showmid(this)">
<option value="0" selected>ѡ��ɼ���</option>
<?php foreach($Collectsite as $k=>$v) {?>
<option value="<?php echo $k;?>"><?php echo $v['name'];?></option>
<?php }?>
</select>
<span id="dsiteid" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">��ʼ��Ϣ���</td>
<td><input name="startid" type="text" id="startid" size="30" />  <span id="dstartid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">������Ϣ���</td>
<td><input name="endid" type="text" id="endid" size="30" /> <?php tips('���ֲɼ�ģʽ��������Ϣ���Ϊ���ֵ����������ɼ����Ϊ1��10����Ϣ��ϵͳ�����ȥ�ɼ���');?>  <span id="dendid" class="f_red"></span></td>
</tr>
<tr id="compinfolist" style="display:none;">
<td class="tl">��˾��Ϣ�б�ɼ�URL</td>
<td><input name="compinfolisturl" type="text" id="compinfolisturl" size="80" value="" />  <?php tips('����˾��������Ϣ�б�ɼ���Ϣ���˴���д��˾��Ϣ�б�Ĳɼ�URL�������б�������ҳ���ȡ');?> </td>
</tr>
<tr>
<td class="tl">�ɼ�����</td>
<td><input name="collecttest" type="checkbox" id="collecttest" /> <?php tips('ѡ�����ʱ���ɼ���һ�����ݲ��ԣ������');?> </td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value="ȷ ��" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value="�� ��" class="btn"></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'siteid';
	l = $(f).value;
	if(l == 0) {
		Dmsg('��ѡ��ɼ���վ', f);
		return false;
	}
	f = 'startid';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д��ʼ��Ϣ���', f);
		return false;
	}
	f = 'endid';
	l = $(f).value;
	if(l == '') {
		Dmsg('����д������Ϣ���', f);
		return false;
	}
	if($('endid').value<$('startid').value) {
		Dmsg('������Ϣ��ű��������ʼ��Ϣ���', f);
		return false;
	}
	return true;
}
function showmid(obj){
	<?php foreach($Collectsite as $k=>$v) {?>
	if(obj.options[obj.selectedIndex].value == <?php echo $k;?>) {
			$('moduleid').value = '<?php echo $v['modid'];?>';
			$('auth').value = '<?php echo $v['spider_auth'];?>';
			<?php if($v['modid']==2) {?>
			$('compinfolist').style.display = '';
			<?php } else { ?>
			$('compinfolist').style.display = 'none';
			<?php } ?>
	}
	<?php }?>
}
</script>
<script type="text/javascript">Menuon(1);</script>
</body>
</html>