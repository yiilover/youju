<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
load('player.js');
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
			//TB_show('����¥��','<?php echo AJ_PATH;?>member/addBorough_admin.php?height=240&width=400&modal=true&rnd='+Math.random(),false);
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
<td><?php echo $_admin == 1 ? category_select('post[catid]', 'ѡ�����', $catid, $moduleid) : ajax_category_select('post[catid]', 'ѡ�����', $catid, $moduleid);?> <span id="dcatid" class="f_red"></span></td>
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
<td><input name="post[title]" type="text" id="title" size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '����', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ����ͼƬ</td>
<td><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>"/>&nbsp;&nbsp;<span onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value);" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="_preview(Dd('thumb').value);" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('thumb').value='';" class="jt">[ɾ��]</span><span id="dthumb" class="f_red"></span></td>
</tr>
<?php if($MOD['swfu']) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ƶ��ַ</td>
<td>
<div style="float:left;"><input name="post[video]" id="video" type="text" size="60" value="<?php echo $video;?>"/>&nbsp;&nbsp;</div><div style="width:34px;height:20px;float:left;"><span id="spanButtonPlaceHolder"></span></div><table cellspacing="0" style="display:none;">
<tr>
	<td>Files Queued:</td>
	<td id="tdFilesQueued"></td>
</tr>			
<tr>
	<td>Files Uploaded:</td>
	<td id="tdFilesUploaded"></td>
</tr>			
<tr>
	<td>Errors:</td>
	<td id="tdErrors"></td>
</tr>
<tr>
	<td>Current Speed:</td>
	<td id="tdCurrentSpeed"></td>
</tr>			
<tr>
	<td>Average Speed:</td>
	<td id="tdAverageSpeed"></td>
</tr>			
<tr>
	<td>Moving Average Speed:</td>
	<td id="tdMovingAverageSpeed"></td>
</tr>			
<tr>
	<td>Time Remaining</td>
	<td id="tdTimeRemaining"></td>
</tr>			
<tr>
	<td>Time Elapsed</td>
	<td id="tdTimeElapsed"></td>
</tr>
<tr>
	<td>Size Uploaded</td>
	<td id="tdSizeUploaded"></td>
</tr>			
<tr>
	<td>Progress Event Count</td>
	<td id="tdProgressEventCount"></td>
</tr>	
</table><div style="float:left;">&nbsp;&nbsp;<span onclick="vs();" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="vh();Dd('video').value='';" class="jt">[ɾ��]</span>&nbsp;&nbsp; 
<span class="f_gray">���ȣ�<span id="tdPercentUploaded">0%</span></span> <span id="dvideo" class="f_red"></span></div>
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/swfupload/swfupload.js"></script>
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/swfupload/swfupload.speed.js"></script>
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/swfupload/handlers_video.js"></script>
<script type="text/javascript">
	var swfu;
	//window.onload = function() {
		var settings = {
			flash_url : "<?php echo AJ_PATH;?>file/swfupload/swfupload.swf",
			upload_url: "<?php echo AJ_PATH;?>upload.php",
			post_params: {"from": "file", "width": "100", "height": "100", "swf_userid": "<?php echo $_userid;?>", "swf_username": "<?php echo $_username;?>", "swf_groupid": "<?php echo $_groupid;?>", "swf_auth": "<?php echo md5($_userid.$_username.$_groupid.AJ_KEY.$AJ_IP);?>", "swfupload": "1"},
			file_size_limit : "1000 MB",
			//file_types : "*.*",
			file_types : "*.<?php echo str_replace('|', ';*.', $MOD['upload']);?>",
			file_types_description : "��Ƶ�ļ�",
			//file_upload_limit : 100,
			file_upload_limit : 10,
			file_queue_limit : 0,

			debug: false,

			// Button settings
			button_image_url: "<?php echo AJ_PATH;?>file/swfupload/upload1.png",
			button_width: "34",
			button_height: "20",
			button_placeholder_id: "spanButtonPlaceHolder",
			
			moving_average_history_size: 40,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_dialog_complete_handler: fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			
			custom_settings : {
				tdFilesQueued : document.getElementById("tdFilesQueued"),
				tdFilesUploaded : document.getElementById("tdFilesUploaded"),
				tdErrors : document.getElementById("tdErrors"),
				tdCurrentSpeed : document.getElementById("tdCurrentSpeed"),
				tdAverageSpeed : document.getElementById("tdAverageSpeed"),
				tdMovingAverageSpeed : document.getElementById("tdMovingAverageSpeed"),
				tdTimeRemaining : document.getElementById("tdTimeRemaining"),
				tdTimeElapsed : document.getElementById("tdTimeElapsed"),
				tdPercentUploaded : document.getElementById("tdPercentUploaded"),
				tdSizeUploaded : document.getElementById("tdSizeUploaded"),
				tdProgressEventCount : document.getElementById("tdProgressEventCount")
			}
		};
		swfu = new SWFUpload(settings);
	 //};
</script>
<div id="v_player"></div>
</td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ƶ��ַ</td>
<td><input name="post[video]" id="video" type="text" size="60" value="<?php echo $video;?>"/>&nbsp;&nbsp;<span onclick="Dfile(<?php echo $moduleid;?>, Dd('video').value, 'video', '<?php echo $MOD['upload'];?>');" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="vs();" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('video').value='';" class="jt">[ɾ��]</span> <span id="dvideo" class="f_red"></span>
<div id="v_player"></div>
</td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ƶ���</td>
<td><input name="post[width]" id="width" type="text" size="5" value="<?php echo $width;?>"/> px&nbsp;&nbsp;&nbsp;�߶� <input name="post[height]" id="height" type="text" size="5" value="<?php echo $height;?>"/> px <span id="dsize" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ������</td>
<td>
<?php
foreach($PLAYER as $k=>$v) {
?>
<input type="radio" name="post[player]" id="type_<?php echo $k;?>" value="<?php echo $k;?>"<?php echo $k == $player ? ' checked' : '';?>/><label for="type_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php
}
?>
</td>
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
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ƶ˵��</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> ��Ƶϵ��</td>
<td><input name="post[tag]" id="tag" type="text" size="50" value="<?php echo $tag;?>"/> <span id="dtag" class="f_red"></span><?php tips('��дһ����Ƶ�Ĺؼ��ʻ���ϵ�����ƣ��Ա����ͬϵ�е���Ƶ');?></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա��</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[����]</a> <span id="dusername" class="f_red"></span></td>
</tr>

<tr>
<td class="tl"><span class="f_hid">*</span> <?php echo $MOD['name'];?>״̬</td>
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
<?php if($AJ['city']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> ����(��վ)</td>
<td><?php echo ajax_area_select('post[areaid]', '��ѡ��', $areaid);?></td>
</tr>
<?php } ?>
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
		Dmsg('����д��Ƶ����', f);
		return false;
	}
	f = 'thumb';
	l = Dd(f).value.length;
	if(l < 10) {
		Dmsg('���ϴ�����ͼƬ', f);
		return false;
	}
	f = 'video';
	l = Dd(f).value.length;
	if(l < 10) {
		Dmsg('����д��Ƶ��ַ', f);
		return false;
	}
	if(!Dd('width').value) {
		Dmsg('����д��Ƶ���', 'size');
		return false;
	}
	if(!Dd('height').value) {
		Dmsg('����д��Ƶ�߶�', 'size');
		return false;
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
function vs() {
	if(Dd('video').value.length > 5) {
		var p = i = 0;
		while(i < 100) {
			if(Dd('type_'+i).checked) {p = i;break}
			i++;
		}
		Ds('v_player');
		Inner('v_player', player(Dd('video').value,Dd('width').value,Dd('height').value,p,1)+'<br/><a href="javascript:" onclick="vh();" class="t">[�ر�Ԥ��]</a>');
	} else {
		vh();
	}
}
function vh() {Inner('v_player', '');Dh('v_player');}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>