<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt">�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><textarea name="post[username]" id="username" style="width:200px;height:100px;overflow:visible;"><?php echo $username;?></textarea><?php tips('����������ӣ�һ��һ������س�����');?><br/><span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Դ����</td>
<td>
<select name="post[mid]" onchange="ch_mid(this.value);">
<?php foreach($mids as $v) { ?>
<option value="<?php echo $v;?>"<?php echo $mid == $v ? ' selected' : '';?>><?php echo $MODULE[$v]['name'];?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ؼ���</td>
<td><input type="text" name="post[word]" id="word" size="30" value="<?php echo $word;?>" maxlength="30"/><span id="dword" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ҵ����</td>
<td><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '��ѡ��', $catid, $mid, 'size="2" style="height:120px;width:180px;"');?><span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ڵ���</td>
<td><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����Ƶ��</td>
<td>
<select name="post[rate]">
<option value="0"<?php if($rate==0) { ?> selected<?php } ?>>����</option>
<option value="1"<?php if($rate==1) { ?> selected<?php } ?>>1��</option>
<option value="3"<?php if($rate==3) { ?> selected<?php } ?>>3��</option>
<option value="7"<?php if($rate==7) { ?> selected<?php } ?>>7��</option>
<option value="15"<?php if($rate==15) { ?> selected<?php } ?>>15��</option>
<option value="30"<?php if($rate==30) { ?> selected<?php } ?>>30��</option>
</select>
</td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> ����״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?> id="status_3"/><label for="status_3"> ͨ��</label>
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?> id="status_2"/><label for="status_2"> ����</label>
</td>
</tr>

</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'username';
	if(Dd(f).value == '') {
		Dmsg('����д��Ա��', f);
		return false;
	}
	return true;
}
function ch_mid(i) {
	category_moduleid[1] = i;
	load_category(0, 1);
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>