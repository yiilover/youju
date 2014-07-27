<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript" src="<?php echo AJ_SKIN;?>/js/Autocompleter/lib/jquery.js"></script>
<script type='text/javascript' src='<?php echo AJ_SKIN;?>/js/Autocompleter/jquery.autocomplete.js'></script>
<script type='text/javascript' src='<?php echo AJ_SKIN;?>/js/FormValid.js'></script>
<script type='text/javascript' src='<?php echo AJ_SKIN;?>/js/FV_onBlur.js'></script>
<script type='text/javascript' src='<?php echo AJ_SKIN;?>/js/thickbox.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo AJ_SKIN;?>/js/Autocompleter/lib/thickbox.css" />
<link rel="stylesheet" type="text/css" href="<?php echo AJ_SKIN;?>/js/Autocompleter/jquery.autocomplete.css" />

<script type="text/javascript">
FormValid.showError = function(errMsg,errName,formName) {
	if (formName=='dataForm') {
		for (key in FormValid.allName) {
			//document.getElementById('errMsg_'+FormValid.allName[key]).innerHTML = '';
			//document.getElementById('errMsg_'+FormValid.allName[key]).style.display = 'none';
			
		}
		for (key in errMsg) {
			document.getElementById('errMsg_'+errName[key]).innerHTML = errMsg[key];
			document.getElementById('errMsg_'+errName[key]).style.display = '';
			
		}
	}
}
function addToBoroughItem(bid,bname,b_addr,b_area){
	$("#itemid").val(bid);
	$("#titles").val(bname);
	$("#borough_addr").val(b_addr);
	$("#borough_area").val(b_area);
	$("#borough_addr_tr").css("display","");
	$("#borough_areaid_tr").css("display",""); 
}
$().ready(function() {
	$("#titles").autocomplete("<?php echo AJ_PATH;?>member/ajaxs.php?action=getnewhouseList", {
		minChars: 2,
		width: 260,
		delay:0,
		mustMatch:true,
		matchContains: false,
		scrollHeight: 220,
		selectFirst:true,
		scroll: true,
		formatItem: function(data, i, total) {
			if(data[1]=="addBorough"){
				return '<strong>'+data[0]+'</strong>';
			}
			return data[0];
		}
	});
	
	$("#titles").result(function(event, data, formatted) {
		if(data[1]=="addBorough"){
			//TB_show('����С��','#TB_inline?height=155&width=400&inlineId=modalWindow',false);
			
			$(this).val('');
		}else{
			$("#itemid").val(data[1]);
			$("#borough_addr").val(data[2]);
			
			$("#borough_addr_tr").css("display",""); 
			$("#borough_areaid_tr").css("display","");
		}
		
		/*if (data)
			$(this).parent().next().find("input").val(data[1]);*/
	});
});

</script>
<form action="?" target="_blank" id="check_title">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="kw" value="" id="kw"/>
</form>
<form method="post" action="?" id="dform" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��������</td>
<td><?php echo $_admin == 1 ? category_select('post[catid]', 'ѡ�����', $catid, $moduleid) : ajax_category_select('post[catid]', 'ѡ�����', $catid, $moduleid);?>&nbsp;&nbsp;<input type="checkbox" name="post[islink]" value="1" id="islink" onclick="_islink();" <?php if($islink) echo 'checked';?>/> �ⲿ���� <span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
            <td class="tl"><span class="f_hid">*</span>¥������</td>
            <td><input type="hidden" id="itemid" name="post[houseid]" value="<?php echo $houseid;?>" >
							<input id="titles" class="txt" name="post[housename]" type="text" size="30" value="<?php echo $housename;?>"  errmsg="������¥������!"  />
			<span class="gray">������¥�����ƣ��磺�����ҷ�������ajfc����Ȼ��������򿪵��б���ѡ�񼴿ɡ�</span><br>
						       
								    <div id="errMsg_borough_name" style="display: none;" class="community_pop_box">
							            <div id="borough_addr_tr" class="divshow">
										<input id="borough_addr" type="hidden" class="input" name="post[address]"  size="30" value="<?php echo $address;?>" />
										</div>
										
									</div>
									</td>
          </tr>

<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>����</td>
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '����', $level, 'id="level"');?> <?php echo dstyle('post[style]', $style);?>&nbsp;&nbsp;<input type="button" value="������" onclick="check_title();" class="btn"/><br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ͼƬ</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,Dd('level').value==2 ? 320 : <?php echo $MOD['thumb_width'];?>,Dd('level').value==2 ? 200 : <?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[ɾ��]</span></td>
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
<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr id="link" style="display:<?php echo $islink ? '' : 'none';?>;">
<td class="tl"><span class="f_red">*</span> ���ӵ�ַ</td>
<td><input name="post[linkurl]" type="text" id="linkurl" size="60" value="<?php echo $linkurl;?>"/> <span id="dlinkurl" class="f_red"></span></td>
</tr>
<tbody id="basic" style="display:<?php echo $islink ? 'none' : '';?>;">
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>����</td>
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
<td class="tl" height="30"><span class="f_hid">*</span> ����ѡ��</td>
<td>
<a href="javascript:pagebreak();Ds('subtitle');"><img src="admin/image/pagebreak.gif" align="absmiddle"/> �����ҳ��</a>&nbsp;&nbsp;
<input type="checkbox" name="post[save_remotepic]" value="1"<?php if($MOD['save_remotepic']) echo 'checked';?>/>����Զ��ͼƬ&nbsp;&nbsp;
<input type="checkbox" name="post[clear_link]" value="1"<?php if($MOD['clear_link']) echo 'checked';?>/>�������&nbsp;&nbsp;
��ȡ���� <input name="post[introduce_length]" type="text" size="2" value="<?php echo $MOD['introduce_length']?>"/> �ַ������&nbsp;&nbsp;
�������ݵ� <input name="post[thumb_no]" type="text" size="2" value=""/> ��ͼƬΪ����ͼ
</td>
</tr>
<tbody id="subtitle" style="display:<?php echo $pagebreak ? '' : 'none';?>;">
<td class="tl"><span class="f_hid">*</span> ��ҳ����</td>
<td>
<textarea name="post[subtitle]" style="width:90%;height:45px;"><?php echo $subtitle;?></textarea>
<br/>1��һ����ҳ���⣬���س�����
</td>
</tr>
</tbody>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>���</td>
<td><textarea name="post[introduce]" style="width:90%;height:45px;"><?php echo $introduce;?></textarea></td>
</tr>
<tr height="30">
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>����</td>
<td><input type="text" size="10" name="post[author]" value="<?php echo $author;?>" id="author"/> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="ѡ��������" class="c_p" onclick="TopUse('author');"/>&nbsp;&nbsp;<?php echo $MOD['name'];?>��Դ <input type="text" size="12" name="post[copyfrom]" value="<?php echo $copyfrom;?>" id="copyfrom"/>&nbsp;&nbsp;��Դ���� <input type="text" size="25" name="post[fromurl]" value="<?php echo $fromurl;?>" id="fromurl"/> <img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="ѡ������Դ" class="c_p" onclick="TopUse('from');"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> �ؼ���(Tag)</td>
<td><input name="post[tag]" type="text" size="60" value="<?php echo $tag;?>"/><?php tips('����ؼ������ÿո����');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ����ͶƱ</td>
<td><input name="post[voteid]" type="text" size="10" value="<?php echo $voteid;?>"/><?php tips('����дͶƱID�����ID���ÿո����');?></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>״̬</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?> id="status_3"/><label for="status_3"> ͨ��</label>
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?> id="status_2"/><label for="status_2">  ����</label>
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';" id="status_1"/><label for="status_1">  �ܾ�</label>
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?> id="status_0"/><label for="status_0">  ɾ��</label>
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
<td class="tl"><span class="f_hid">*</span> ���ڵ���</td>
<td><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?></td>
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
<input type="hidden" name="catid" value="<?php echo $catid;?>"/>
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
function check_title() {
	if(Dd('title').value.length < 2) {
		alert('����д����');
	} else {
		Dd('kw').value = Dd('title').value;
		Dd('check_title').submit();
	}
}
function TopUse(a) {
	mkDialog('', '<iframe src="?moduleid=<?php echo $moduleid;?>&action='+a+'" width="650" height=250" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" framespacing="0" frameborder="0" scrolling="yes"></iframe>', '��ѡ��', 675, 0, 0);
}

function check() {
	var l;
	var f;
	f = 'catid_1';
	if(Dd(f).value == 0) {
		Dmsg('��ѡ����������', 'catid', 1);
		return false;
	}
	f = 'title';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('��������2�֣���ǰ������'+l+'��', f);
		return false;
	}
	if(Dd('islink').checked) {
		f = 'linkurl';
		l = Dd(f).value.length;
		if(l < 12) {
			Dmsg('��������ȷ�����ӵ�ַ', f);
			return false;
		}
	} else {
		f = 'content';
		l = FCKLen();
		if(l < 5) {
			Dmsg('��������5�֣���ǰ������'+l+'��', f);
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