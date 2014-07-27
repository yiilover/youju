<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="post[isnew]" value="1"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="post[mycatid]" value="<?php echo $mycatid;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ����״̬</td>
<td>
<?php foreach($TYPE as $k=>$v) {?>
<input type="radio" name="post[typeid]" value="<?php echo $k;?>" <?php if($k==$typeid) echo 'checked';?> id="typeid_<?php echo $k;?>"/> <label for="typeid_<?php echo $k;?>" id="t_<?php echo $k;?>"><?php echo $v;?></label>&nbsp;
<?php } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ¥������</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '����', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��ҵ����</td>
<td><div id="catesch"></div><?php echo get_category_checkboxes('post[catid]',  $moduleid, $catid);?>

</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ¥���ص�</td>
		<td >
<input name="post[tedian]" type="text" id="title" size="35" value="<?php echo $tedian;?>"/></td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 1;
</script>
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/script/property.js"></script>
<?php if($itemid) { ?><script type="text/javascript">setTimeout("load_property()", 1000);</script><?php } ?>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>

<tr>
<td class="tl"><span class="f_hid">*</span> ���̵�ַ</td>
<td><input name="post[address]" type="text" size="30" value="<?php echo $address;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ڵ���</td>
<td ><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��&nbsp;ҵ&nbsp;��</td>
<td>
<input name="post[lp_costs]" type="text" id="title" size="15" value="<?php echo $lp_costs;?>"/>Ԫ(/�O/��)
 </td>
</tr><tr>
<td class="tl"><span class="f_hid">*</span> ��ҵ��˾</td>
<td>
<input name="post[lp_company]" type="text" id="title" size="35" value="<?php echo $lp_company;?>"/>
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ͼ��ע</td>
<td>
<?php echo include AJ_ROOT.'/api/map/baidu/post.inc.php';?>
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ͼ��ֵ</td>
<td>
<input type="text" name="post[lineprice]" value="<?php echo $lineprice;?>"  size="45"/>(��ʽ:1000,2000)
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �·�</td>
<td>
<input type="text"  name="post[linedate]" value="<?php echo $linedate;?>" size="45" />��ʽ: 201207,201208
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �۸�����</td>
<td>
<input type="text" name="post[price]" value="<?php echo $price;?>"  class="sup_input"/>Ԫ/�O
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ȩ</td>
<td>
<input type="text"  name="post[lp_year]" value="<?php echo $lp_year;?>" class="sup_input" />��
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��¥�绰</td>
<td>
<input  name="post[telephone]" type="text"  value="<?php echo $telephone;?>"  class="sup_input"/>(��ʽ:028-88888888)
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��¥��ַ</td>
<td>
<input  name="post[sell_address]" type="text" class="sup_input" value="<?php echo $sell_address;?>" size="35" />
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ������·</td>
<td>
<input  name="post[lp_bus]" type="text" value="<?php echo $lp_bus;?>"  class="sup_input"/>
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td>
<input  name="post[lp_edu]" type="text" class="sup_input" value="<?php echo $lp_edu;?>" size="35" />
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ҽԺ</td>
<td>
<input type="text" name="post[lp_hospital]" value="<?php echo $lp_hospital;?>"  class="sup_input"/>
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����</td>
<td>
<input  name="post[lp_bank]" type="text" class="sup_input" value="<?php echo $lp_bank;?>" size="30" />
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span>�滮���</td>
<td>
<input type="text" name="post[lp_totalarea]" value="<?php echo $lp_totalarea;?>"  class="sup_input"/>�O
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �������</td>
<td>
<input  name="post[lp_area]" type="text" class="sup_input" value="<?php echo $lp_area;?>" size="25" />�O
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span>�滮����</td>
<td>
<input type="text" name="post[lp_number]" value="<?php echo $lp_number;?>"  class="sup_input"/>��
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span>��λ��</td>
<td>
<input  name="post[lp_car]" type="text" class="sup_input" value="<?php echo $lp_car;?>" size="25" />
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ݻ���</td>
<td>
<input type="text" name="post[lp_volume]" value="<?php echo $lp_volume;?>"  class="sup_input"/>%
 </td>
</tr><tr>
<td class="tl"><span class="f_hid">*</span> �̻���</td>
<td>
<input  name="post[lp_green]" type="text" class="sup_input" value="<?php echo $lp_green;?>" size="25" />%
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �༭����</td>
<td>
<textarea name="post[lp_dianping]" cols="100" rows="5" ><?php echo $lp_dianping;?></textarea>
 </td>
</tr>

<td class="tl"><span class="f_hid">*</span> ����ʱ��</td>
<td>
<?php echo dcalendar('post[selltime]', $selltime);?>
 </td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span>����ʱ��</td>
<td>
<?php echo dcalendar('post[completion]', $completion);?>
 </td>
</tr>


<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��ϸ˵��</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<?php
if($MOD['swfu']) { 
	include AJ_ROOT.'/file/swfupload/editor.inc.php';
}
?>
<tr>
<td class="tl"><span class="f_hid">*</span> ��������ͼ</td>
<td>
	<input type="hidden" name="post[thumb]" id="thumb" value="<?php echo $thumb;?>"/>
	
	<table width="360">
	<tr align="center" height="120" class="c_p">
	<td width="120"><img src="<?php echo $thumb ? $thumb : AJ_SKIN.'image/waitpic.gif';?>" id="showthumb" title="Ԥ��ͼƬ" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb').src, 1);}else{Dalbum('',<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);}"/></td>
	
	</tr>
	<tr align="center" class="c_p">
	<td><span onclick="Dalbum('',<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="�ϴ�"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="ѡ��" onclick="selAlbum('');"/>&nbsp;&nbsp;<span onclick="delAlbum('', 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="ɾ��"/></span></td>
	
	</tr>
	</table>
</td>
</tr>


<tbody id="d_member" style="display:<?php echo $username ? '' : 'none';?>">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[����]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ա�Ƽ���Դ</td>
<td>
<input type="radio" name="post[elite]" value="1" <?php if($elite == 1) echo 'checked';?>/> ��&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[elite]" value="0" <?php if($elite == 0) echo 'checked';?>/> ��
</td>
</tr>
</tbody>

<tr>
<td class="tl"><span class="f_hid">*</span> ��Ϣ״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> ͨ��
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> ����
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';"/> �ܾ�
<input type="radio" name="post[status]" value="4" <?php if($status == 4) echo 'checked';?>/> ����
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?>/> ɾ��
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> �ܾ�����</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ���ʱ��</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �������</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �����շ�</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('�������0��ʾ�̳�ģ�����ü۸�-1��ʾ���շ�<br/>����0�����ֱ�ʾ�����շѼ۸�');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ģ��</td>
<td><?php echo tpl_select('show', $module, 'post[template]', 'Ĭ��ģ��', $template, 'id="template"');?><?php tips('���û��������Ҫ��һ�㲻��Ҫѡ��<br/>ϵͳ���Զ��̳з����ģ������');?></td>
</tr>
<?php if($MOD['show_html']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> �Զ����ļ�·��</td>
<td><input type="text" size="50" name="post[filepath]" value="<?php echo $filepath;?>" id="filepath"/>&nbsp;<input type="button" value="�������" onclick="ckpath(<?php echo $moduleid;?>, <?php echo $itemid;?>);" class="btn"/>&nbsp;<?php tips('���԰���Ŀ¼���ļ� ���� aijiacms/house.html<br/>��ȷ��Ŀ¼���ļ����Ϸ��ҿ�д�룬�����������ʧ��');?>&nbsp; <span id="dfilepath" class="f_red"></span></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">��ҳ�ɱ�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> Ŀ����ַ</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" �� ȡ " class="btn"/>&nbsp;&nbsp;<input type="button" value=" ������� " class="btn" onclick="window.open('?file=fetch');"/></td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">
function _p() {
	if(Dd('tag').value) {
		Ds('reccate');
	}
}
function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('��ѡ��������ҵ', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	if(Dd('ismember_1').checked) {
		f = 'username';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('����д��Ա��', f);
			return false;
		}
	} else {
		f = 'company';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('����д��˾����', f);
			return false;
		}
		if(Dd('areaid_1').value == 0) {
			Dmsg('��ѡ�����ڵ���', 'areaid', 1);
			return false;
		}
		f = 'truename';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('����д��ϵ��', f);
			return false;
		}
		f = 'mobile';
		l = Dd(f).value.length;
		if(l < 7) {
			Dmsg('����д�ֻ�', f);
			return false;
		}
	}
	<?php echo $FD ? fields_js() : '';?>
	if(Dd('property_require') != null) {
		var ptrs = Dd('property_require').getElementsByTagName('option');
		for(var i = 0; i < ptrs.length; i++) {		
			f = 'property-'+ptrs[i].value;
			if(Dd(f).value == 0 || Dd(f).value == '') {
				Dmsg('����д��ѡ��'+ptrs[i].innerHTML, f);
				return false;
			}
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>