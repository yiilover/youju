<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
//show_menu($menus);
?>
<div class="tt">����ͼƬ</div>
<form method="post" action="?" id="dform">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="update" value="1"/>
<input type="hidden" name="swf_upload" id="swf_upload"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
<?php foreach($lists as $k=>$v) { ?>
<div style="width:130px;float:left;">
	<input type="hidden" name="post[<?php echo $v['itemid'];?>][thumb]" id="thumb<?php echo $v['itemid'];?>" value="<?php echo $v['thumb'];?>"/>
	<table width="120">
	<tr align="center" height="110" class="c_p">
	<td width="120"><img src="<?php echo $v['thumb'];?>" width="100" height="100" id="showthumb<?php echo $v['itemid'];?>" title="Ԥ��ͼƬ" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(this.src, 1);}else{Dphoto(<?php echo $v['itemid'];?>,<?php echo $moduleid;?>,100,100, Dd('thumb<?php echo $v['itemid'];?>').value, true);}"/></td>
	</tr>
	<tr align="center">
	<td height="20">
	<a href="?moduleid=<?php echo $moduleid;?>&action=item_delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="ɾ��"/></a>&nbsp;
	<span onclick="Dphoto(<?php echo $v['itemid'];?>,<?php echo $moduleid;?>,100,100, Dd('thumb<?php echo $v['itemid'];?>').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="�ϴ�"/></span>
	</td>
	</tr>
	<tr align="center" title="<?php echo $v['introduce'];?>">
	<td><textarea name="post[<?php echo $v['itemid'];?>][introduce]" style="width:90px;height:40px;" onfocus="if(this.value=='��飺')this.value='';"><?php echo $v['introduce'];?></textarea></td>
	</tr>
	<tr align="center" title="����">
	<td><input type="text" size="3" name="post[<?php echo $v['itemid'];?>][listorder]" value="<?php echo $v['listorder'];?>"/></td>
	</tr>
	</table>
</div>
<?php } ?>
<?php if($items < $MOD['maxitem']) { ?>
<div style="width:130px;float:left;">
	<input type="hidden" name="post[0][thumb]" id="thumb0"/>
	<table width="120">
	<tr align="center" height="110" class="c_p">
	<td width="120"><img src="<?php echo AJ_SKIN?>image/waitpic.gif" width="100" height="100" id="showthumb0" title="Ԥ��ͼƬ" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(this.src, 1);}else{Dphoto(0,<?php echo $moduleid;?>,100,100, Dd('thumb0').value, true);}"/></td>
	</tr>
	<tr align="center">
	<td height="20">
	<span onclick="Dphoto(0,<?php echo $moduleid;?>,100,100, Dd('thumb0').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="�ϴ�"/></span>
	</td>
	</tr>
	<tr align="center" title="���">
	<td><textarea name="post[0][introduce]" style="width:90px;height:40px;" onfocus="if(this.value=='��飺')this.value='';">��飺</textarea></td>
	</tr>
	<tr align="center" title="����">
	<td><input type="text" size="3" name="post[0][listorder]" value="0"/></td>
	</tr>
	</table>
</div>
<?php } ?>
</td>
</tr>
</table>
<br/>
<div class="t_c">
<?php echo type_select('photo', 1, 'post[typeid]', '��ѡ�����', $typeid, 'id="typeid"');?><input type="submit" value=" �� �� " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" Ԥ �� " class="btn" onclick="window.open('<?php echo $MOD['linkurl'].$item['linkurl'];?>');"/></div>
</form>
<div class="pages"><?php echo $pages;?></div>
<?php load('clear.js'); ?>
<div class="tt">�������������ϴ�ͼƬ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�����ϴ�</td> 
<td>
<link href="<?php echo AJ_PATH;?>api/swfupload/style.css" rel="stylesheet" type="text/css"/>
<form>
	<div class="swfuploadbtn">
		<span id="spanButtonPlaceholder"></span>
	</div>
</form>
<div id="divFileProgressContainer"></div>
<div id="thumbnails"></div>
<script type="text/javascript" src="<?php echo AJ_PATH;?>api/swfupload/swfupload.js"></script>
<script type="text/javascript">var swfu_max = 0;</script>
<script type="text/javascript" src="<?php echo AJ_PATH;?>api/swfupload/handlers_photo.js"></script>
<script type="text/javascript">
	var swfu;
	//window.onload = function () {
		swfu = new SWFUpload({
			// Backend Settings
			upload_url: "<?php echo AJ_PATH;?>upload.php",
			post_params: {"from": "photo", "width": "100", "height": "100", "swf_userid": "<?php echo $_userid;?>", "swf_username": "<?php echo $_username;?>", "swf_groupid": "<?php echo $_groupid;?>", "swf_company": "<?php echo $_company;?>", "swf_auth": "<?php echo md5($_userid.$_username.$_groupid.$_company.AJ_KEY.$AJ_IP);?>", "swfupload": "1"},

			// File Upload Settings
			file_size_limit : "32 MB",	// 32MB
			file_types : "*.jpg;*.gif;*.png",
			file_types_description : "Images",
			file_upload_limit : swfu_max,

			// Event Handler Settings - these functions as defined in Handlers.js
			//  The handlers are not part of SWFUpload but are part of my website and control how
			//  my website reacts to the SWFUpload events.
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,

			// Button Settings
			button_image_url : "<?php echo AJ_PATH;?>api/swfupload/upload3.png",
			button_placeholder_id : "spanButtonPlaceholder",
			button_width: 195,
			button_height: 25,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// Flash Settings
			flash_url : "<?php echo AJ_PATH;?>api/swfupload/swfupload.swf",

			custom_settings : {
				upload_target : "divFileProgressContainer"
			},
			
			// Debug Settings
			debug: false
		});
	//};
</script>
</td>
</tr>
<tr>
<td class="tl">��ʾ��Ϣ</td>
<td class="f_gray">&nbsp;��������ϴ�ͼƬ��ť����Ctrl�����϶�����ѡ���ͼƬ</td>
</tr>
</table>
<div class="tt">���������ϴ�zipѹ���ļ�</div>
<form method="post" action="?" enctype="multipart/form-data">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="zip"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ѡ���ļ�</td>
<td>
&nbsp;<input name="uploadfile" type="file" size="25"/>&nbsp;&nbsp;
<input type="submit" value=" �� �� " class="btn"/>
</td>
</tr>
<tr>
<td class="tl">��ʾ��Ϣ</td>
<td class="f_gray">&nbsp;���ͬʱ�ϴ�����ͼƬ�����Խ�ͼƬѹ��Ϊzip��ʽ�ϴ���Ŀ¼�ṹ����</td>
</tr>
</table>
</form>
<div class="tt">�����ġ�FTP�ϴ�Ŀ¼����zipѹ����</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="dir"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��ѡ��</td>
<td>
&nbsp;<select name="name">
<option>��ѡ��Ŀ¼����zip�ļ�</option>
<?php
foreach(glob(AJ_ROOT.'/file/temp/*') as $v) {
	if(is_dir($v)) {
		$v = basename($v);
		echo '<option value="'.$v.'">/'.$v.'/</option>';
	} else if(file_ext($v) == 'zip') {
		$v = basename($v);		
		echo '<option value="'.$v.'">/'.$v.'</option>';
	}
}
?>
</select>
&nbsp;
<input type="button" value=" ˢ �� " class="btn" onclick="window.location.reload();"/>&nbsp;&nbsp;
<input type="submit" value=" �� ȡ " class="btn"/>
</td>
</tr>
<tr>
<td class="tl">��ʾ��Ϣ</td>
<td class="f_gray">&nbsp;���Դ���Ŀ¼���ͼƬ����FTP�ϴ�Ŀ¼�� file/temp/ Ŀ¼������ֱ�Ӵ��Ϊzip��ʽ�ϴ��� file/temp/ Ŀ¼</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>