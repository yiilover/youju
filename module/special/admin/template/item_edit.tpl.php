<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="specialid" value="<?php echo $specialid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="post[specialid]" value="<?php echo $specialid;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> ѡ����ϢԴ</td>
<td><select id="s_mid" onchange="if(this.value){select_item(this.value, 'special');select_op('s_mid', 0);}">
<option value="0">��ѡ��</option>
<?php
foreach($MODULE as $m) {
	if(!$m['islink'] && $m['moduleid'] > 3 && $m['moduleid'] != $moduleid) echo '<option value="'.$m['moduleid'].'">'.$m['name'].'</option>';
}
?>
</select></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������</td>
<td><?php echo type_select($tid, 0, 'post[typeid]', '��ѡ�����', $typeid, 'id="typeid"');?> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_add.gif" width="12" height="12" title="�������" class="c_p" onclick="Dwidget('?file=type&item=<?php echo $tid;?>', '[<?php echo $special['title'];?>] ר����Ϣ����', 550, 250);"/> <span id="dtypeid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ϣ����</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '����', $level, 'id="level"');?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ���ӵ�ַ</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="60" value="<?php echo $linkurl;?>"/> <br/><span id="dlinkurl" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ͼƬ</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[ɾ��]</span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ժҪ</td>
<td>
<textarea rows="5" cols="90" name="post[introduce]" id="introduce"><?php echo $introduce;?></textarea>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>" id="addtime"/></td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;<input type="button" value=" �� �� " class="btn" onclick="history.back(-1);"/>
</div>
</form>
<?php load('clear.js'); ?>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	f = 'linkurl';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('����д���ӵ�ַ', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>