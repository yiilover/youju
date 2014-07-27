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
	$("#titles").autocomplete("<?php echo AJ_PATH;?>member/ajaxs.php?action=getBoroughList", {
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
			//TB_show('增加小区','#TB_inline?height=155&width=400&inlineId=modalWindow',false);
			TB_show('增加小区','<?php echo AJ_PATH;?>member/addBorough_admin.php?height=240&width=400&modal=true&rnd='+Math.random(),false);
			$(this).val('');
		}else{
			$("#itemid").val(data[1]);
			$("#borough_addr").val(data[2]);
			$("#borough_area").val(data[3]);
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
<input type="hidden" name="post[mycatid]" value="<?php echo $mycatid;?>"/>
<input type="hidden" name="swf_upload" id="swf_upload"/>
<div class="tt"><?php echo $tname;?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 信息类型</td>
<td>
<?php foreach($TYPE as $k=>$v) {?>
<input type="radio" name="post[typeid]" value="<?php echo $k;?>" <?php if($k==$typeid) echo 'checked';?> id="typeid_<?php echo $k;?>"/> <label for="typeid_<?php echo $k;?>" id="t_<?php echo $k;?>"><?php echo $v;?></label>&nbsp;
<?php } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 房源标题</td>
<td><input name="post[title]" type="text"  size="60" value="<?php echo $title;?>"/> <?php echo level_select('post[level]', '级别', $level);?> <?php echo dstyle('post[style]', $style);?> <br/><span id="dtitle" class="f_red"></span></td>
</tr>
 <tr>
            <td class="tl"><span class="f_red">*</span>小区名称：</td>
            <td><input type="hidden" id="itemid" name="post[houseid]" value="<?php echo $houseid;?>" >
							<input id="titles" class="txt" name="post[housename]" type="text" size="30" value="<?php echo $housename;?>"  errmsg="请输入小区名称!"  />
			<span class="gray">请输入小区名称，如：“爱家房产”或“ajfc”，然后在下面打开的列表中选择即可。</span><br>
						       
								    <div id="errMsg_borough_name" style="display: none;" class="community_pop_box">
							            <div id="borough_addr_tr" class="divshow">
										<input id="borough_addr" type="hidden" class="input" name="post[address]"  size="30" value="<?php echo $address;?>" />
										</div>
										 <div id="borough_areaid_tr" class="divshow">
										<input id="borough_area" type="hidden" class="input" name="post[areaid]"  size="30" value="<?php echo $areaid;?>" />
									</div>
									</td>
          </tr>
<tr>
<td class="tl"><span class="f_red">*</span> 房屋类型</td>
<td><div id="catesch"></div><?php echo category_select('post[catid]', '选择类型', $catid, $moduleid);?></td>
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
<td class="tl"><span class="f_hid">*</span> 户  型</td>
<td><select class="select" name="post[room]">
																		 						 <option value="1" <?php if($room == 1) echo 'selected';?>>1</option>
						 												 						 <option value="2" <?php if($room == 2) echo 'selected';?>>2</option>
						 												 						 <option value="3" <?php if($room == 3) echo 'selected';?>>3</option>
						 												 						 <option value="4" <?php if($room == 4) echo 'selected';?>>4</option>
						 												 						 <option value="5" <?php if($room == 5) echo 'selected';?>>5</option>
						 																		  <option value="6" <?php if($room == 6) echo 'selected';?>>5室以上</option>
						 						</select> 室<select class="select" name="post[hall]">
																		 						 <option value="0" <?php if($hall == 0) echo 'selected';?>>0</option>
						 												 						 <option value="1" <?php if($hall == 1) echo 'selected';?>>1</option>
						 												 						 <option value="2" <?php if($hall == 2) echo 'selected';?>>2</option>
						 												 						 <option value="3" <?php if($hall == 3) echo 'selected';?>>3</option>
						 												 						 <option value="4" <?php if($hall == 4) echo 'selected';?>>4</option>
						 												 						 <option value="5" <?php if($hall == 5) echo 'selected';?>>5</option>
						 												</select> 厅<select class="select" name="post[toilet]">
						 												 						 <option value="0" <?php if($toilet == 0) echo 'selected';?>>0</option>
						 												 						 <option value="1" <?php if($toilet == 1) echo 'selected';?>>1</option>
						 												 						 <option value="2" <?php if($toilet == 2) echo 'selected';?>>2</option>
						 												 						 <option value="3" <?php if($toilet == 3) echo 'selected';?>>3</option>
						 												 						 <option value="4" <?php if($toilet == 4) echo 'selected';?>>4</option>
						 												 						 <option value="5" <?php if($toilet == 5) echo 'selected';?>>5</option>
						 												 </select> 卫<select class="select" name="post[balcony]">
						 												 						 <option value="0" <?php if($balcony == 0) echo 'selected';?>>0</option>
						 												 						 <option value="1" <?php if($balcony == 1) echo 'selected';?>>1</option>
						 												 						 <option value="2" <?php if($balcony == 2) echo 'selected';?>>2</option>
						 												 						 <option value="3" <?php if($balcony == 3) echo 'selected';?>>3</option>
						 												 						 <option value="4" <?php if($balcony == 4) echo 'selected';?>>4</option>
						 												 						 <option value="5" <?php if($balcony == 5) echo 'selected';?>>5</option>
						 												 </select> 阳</td>
</tr>
<?php echo $FD ? fields_html('<td class="tl">', '<td>', $item) : '';?>
<tr>
<td class="tl"><span class="f_hid">*</span> 详细说明</td>
<td><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $MOD['editor'], '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 交通状况</td>
<td><input id="bus" type="text" class="input" name="post[bus]"  size="50" value="<?php echo $bus;?>" />			
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 地图标注</td>
<td>
<?php echo include AJ_ROOT.'/api/map/baidu/post.inc.php';?>
 </td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> 联系人</td>
<td class="tr"><input name="post[truename]" type="text" id="truename" size="20" value="<?php echo $truename;?>" /> <span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系手机</td>
<td class="tr"><input name="post[mobile]" id="mobile" type="text" size="30" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 电子邮件</td>
<td class="tr"><input name="post[email]" id="email" type="text" size="30" value="<?php echo $email;?>" /> <span id="demail" class="f_red"></span></td>
</tr>
 
<?php
if($MOD['swfu']) { 
	include AJ_ROOT.'/file/swfupload/editor.inc.php';
}
?>
<tr>
<td class="tl"><span class="f_hid">*</span> 房源图片</td>
<td>
	<input type="hidden" name="post[thumb]" id="thumb" value="<?php echo $thumb;?>"/>
	<input type="hidden" name="post[thumb1]" id="thumb1" value="<?php echo $thumb1;?>"/>
	<input type="hidden" name="post[thumb2]" id="thumb2" value="<?php echo $thumb2;?>"/>
	<input type="hidden" name="post[thumb3]" id="thumb3" value="<?php echo $thumb3;?>"/>
	<input type="hidden" name="post[thumb4]" id="thumb4" value="<?php echo $thumb4;?>"/>
	<table width="480">
	<tr align="center" height="120" class="c_p">
	<td width="120"><img src="<?php echo $thumb ? $thumb : AJ_SKIN.'image/waitpic.gif';?>" id="showthumb" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb').src, 1);}else{Dalbum('',<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);}"  width="100" height="100"/></td>
	<td width="120"><img src="<?php echo $thumb1 ? $thumb1 : AJ_SKIN.'image/waitpic.gif';?>" id="showthumb1" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb1').src, 1);}else{Dalbum(1,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb1').value, true);}"  width="100" height="100"/></td>
	<td width="120"><img src="<?php echo $thumb2 ? $thumb2 : AJ_SKIN.'image/waitpic.gif';?>" id="showthumb2" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb2').src, 1);}else{Dalbum(2,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb2').value, true);}"  width="100" height="100"/></td>
	
	<td width="120"><img src="<?php echo $thumb1 ? $thumb3 : AJ_SKIN.'image/waitpic.gif';?>" id="showthumb3" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb3').src, 1);}else{Dalbum(3,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb3').value, true);}"  width="100" height="100"/></td>
	<td width="120"><img src="<?php echo $thumb4 ? $thumb4 : AJ_SKIN.'image/waitpic.gif';?>" id="showthumb4" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb4').src, 1);}else{Dalbum(4,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb4').value, true);}"  width="100" height="100"/></td>
	</tr>
	<tr align="center" class="c_p">
	<td><span onclick="Dalbum('',<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum('');"/>&nbsp;&nbsp;<span onclick="delAlbum('', 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
	<td><span onclick="Dalbum(1,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb1').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(1);"/>&nbsp;&nbsp;<span onclick="delAlbum(1, 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
	<td><span onclick="Dalbum(2,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb2').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(2);"/>&nbsp;&nbsp;<span onclick="delAlbum(2, 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
	
	<td><span onclick="Dalbum(3,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb3').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(3);"/>&nbsp;&nbsp;<span onclick="delAlbum(3, 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
	<td><span onclick="Dalbum(4,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb4').value, true);" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE[2]['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(4);"/>&nbsp;&nbsp;<span onclick="delAlbum(4, 'wait');" class="jt"><img src="<?php echo $MODULE[2]['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 过期时间</td>
<td><?php echo dcalendar('post[totime]', $totime);?>&nbsp;
<select onchange="Dd('posttotime').value=this.value;">
<option value="">快捷选择</option>
<option value="">长期有效</option>
<option value="<?php echo timetodate($AJ_TIME+86400*3, 3);?>">3天</option>
<option value="<?php echo timetodate($AJ_TIME+86400*7, 3);?>">一周</option>
<option value="<?php echo timetodate($AJ_TIME+86400*15, 3);?>">半月</option>
<option value="<?php echo timetodate($AJ_TIME+86400*30, 3);?>">一月</option>
<option value="<?php echo timetodate($AJ_TIME+86400*182, 3);?>">半年</option>
<option value="<?php echo timetodate($AJ_TIME+86400*365, 3);?>">一年</option>
</select>&nbsp;
<span id="dposttotime" class="f_red"></span> 不选表示长期有效</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 基本信息</td>
<td>
	<table width="100%">
	<tr>
	<td width="70">价格</td>
	<td><input name="post[price]" type="text" size="10" value="<?php echo $price;?>"/></td>
	</tr>
	<tr>
	<td>建筑面积</td>
	<td><input name="post[houseearm]" type="text" size="10" value="<?php echo $houseearm;?>"/></td>
	</tr>
	<tr>
	<td>房    龄</td>
	<td><select class="select" name="post[houseyear]" valid="required" errmsg="请选择房龄！">
								<option value="">请选择</option>
<option value="1980" <?php if($houseyear == 1980) echo 'selected';?>>1980</option>
<option value="1981"  <?php if($houseyear == 1981) echo 'selected';?>>1981</option>
<option value="1982"  <?php if($houseyear == 1982) echo 'selected';?>>1982</option>
<option value="1983"  <?php if($houseyear == 1983) echo 'selected';?>>1983</option>
<option value="1984"  <?php if($houseyear == 1984) echo 'selected';?>>1984</option>
<option value="1985"  <?php if($houseyear == 1985) echo 'selected';?>>1985</option>
<option value="1986"  <?php if($houseyear == 1986) echo 'selected';?>>1986</option>
<option value="1987"  <?php if($houseyear == 1987) echo 'selected';?>>1987</option>
<option value="1988"  <?php if($houseyear == 1988) echo 'selected';?>>1988</option>
<option value="1989"  <?php if($houseyear == 1989) echo 'selected';?>>1989</option>
<option value="1990"  <?php if($houseyear == 1990) echo 'selected';?>>1990</option>
<option value="1991" <?php if($houseyear == 1991) echo 'selected';?>>1991</option>
<option value="1992" <?php if($houseyear == 1992) echo 'selected';?>>1992</option>
<option value="1993" <?php if($houseyear == 1993) echo 'selected';?>>1993</option>
<option value="1994" <?php if($houseyear == 1994) echo 'selected';?>>1994</option>
<option value="1995" <?php if($houseyear == 1995) echo 'selected';?>>1995</option>
<option value="1996" <?php if($houseyear == 1996) echo 'selected';?>>1996</option>
<option value="1997" <?php if($houseyear == 1997) echo 'selected';?>>1997</option>
<option value="1998" <?php if($houseyear == 1998) echo 'selected';?>>1998</option>
<option value="1999" <?php if($houseyear == 1999) echo 'selected';?>>1999</option>
<option value="2000" <?php if($houseyear == 2000) echo 'selected';?>>2000</option>
<option value="2001" <?php if($houseyear == 2001) echo 'selected';?>>2001</option>
<option value="2002" <?php if($houseyear == 2002) echo 'selected';?>>2002</option>
<option value="2003" <?php if($houseyear == 2003) echo 'selected';?>>2003</option>
<option value="2004" <?php if($houseyear == 2004) echo 'selected';?>>2004</option>
<option value="2005" <?php if($houseyear == 2005) echo 'selected';?>>2005</option>
<option value="2006" <?php if($houseyear == 2006) echo 'selected';?>>2006</option>
<option value="2007" <?php if($houseyear == 2007) echo 'selected';?>>2007</option>
<option value="2008" <?php if($houseyear == 2008) echo 'selected';?>>2008</option>
<option value="2009" <?php if($houseyear == 2009) echo 'selected';?>>2009</option>
<option value="2010" <?php if($houseyear == 2010) echo 'selected';?>>2010</option>
<option value="2011" <?php if($houseyear == 2011) echo 'selected';?>>2011</option>
<option value="2012" <?php if($houseyear == 2012) echo 'selected';?>>2012</option>

							</select></td>
	</tr>
	<tr>
	<td>楼    层</td>
	<td>第
  <input class="input" name="post[floor1]" type="text" size="1" value="<?php echo $floor1;?>"   /> 层 /
	  共<input class="input" name="post[floor2]" type="text" size="1" value="<?php echo $floor2;?>" valid="required|isInt" errmsg="请输入楼层总数!|请输入整数！" /> 层</td>
	</tr>
	<tr>
	<td>产    权</td>
	<td><select name="post[cqxz]" id="{$k}">
    <option value="1"  selected=<?php if($cqxz == 1) echo 'selected';?>>私产</option>
    <option value="2" <?php if($cqxz == 2) echo 'selected';?>>公产</option>
	<option value="3" <?php if($cqxz == 3) echo 'selected';?>>商品房</option>
	<option value="4" <?php if($cqxz == 4) echo 'selected';?>>期房</option>
	<option value="5" <?php if($cqxz == 5) echo 'selected';?>>经济适用房</option>
	<option value="6" <?php if($cqxz == 6) echo 'selected';?>>使用权房</option>
	<option value="7" <?php if($cqxz == 7) echo 'selected';?>>房改房</option>
  </select>			</td>
	</tr>
	
	</table>
</td>
</tr>

<tbody id="d_member" style="display:<?php echo $username ? '' : 'none';?>">
<tr>
<td class="tl"><span class="f_red">*</span> 会员名</td>
<td><input name="post[username]" type="text"  size="20" value="<?php echo $username;?>" id="username"/> <a href="javascript:_user(Dd('username').value);" class="t">[资料]</a> <span id="dusername" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 会员推荐房源</td>
<td>
<input type="radio" name="post[elite]" value="1" <?php if($elite == 1) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[elite]" value="0" <?php if($elite == 0) echo 'checked';?>/> 否
</td>
</tr>
</tbody>

<tr>
<td class="tl"><span class="f_hid">*</span> 信息状态</td>
<td>
<input type="radio" name="post[status]" value="3" <?php if($status == 3) echo 'checked';?>/> 通过
<input type="radio" name="post[status]" value="2" <?php if($status == 2) echo 'checked';?>/> 待审
<input type="radio" name="post[status]" value="1" <?php if($status == 1) echo 'checked';?> onclick="if(this.checked) Dd('note').style.display='';"/> 拒绝
<input type="radio" name="post[status]" value="4" <?php if($status == 4) echo 'checked';?>/> 过期
<input type="radio" name="post[status]" value="0" <?php if($status == 0) echo 'checked';?>/> 删除
</td>
</tr>
<tr id="note" style="display:<?php echo $status==1 ? '' : 'none';?>">
<td class="tl"><span class="f_red">*</span> 拒绝理由</td>
<td><input name="post[note]" type="text"  size="40" value="<?php echo $note;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 添加时间</td>
<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 浏览次数</td>
<td><input name="post[hits]" type="text" size="10" value="<?php echo $hits;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容收费</td>
<td><input name="post[fee]" type="text" size="5" value="<?php echo $fee;?>"/><?php tips('不填或填0表示继承模块设置价格，-1表示不收费<br/>大于0的数字表示具体收费价格');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_hid">*</span> 内容模板</td>
<td><?php echo tpl_select('show', $module, 'post[template]', '默认模板', $template, 'id="template"');?><?php tips('如果没有特殊需要，一般不需要选择<br/>系统会自动继承分类或模块设置');?></td>
</tr>
<?php if($MOD['show_html']) { ?>
<tr>
<td class="tl"><span class="f_hid">*</span> 自定义文件路径</td>
<td><input type="text" size="50" name="post[filepath]" value="<?php echo $filepath;?>" id="filepath"/>&nbsp;<input type="button" value="重名检测" onclick="ckpath(<?php echo $moduleid;?>, <?php echo $itemid;?>);" class="btn"/>&nbsp;<?php tips('可以包含目录和文件 例如 aijiacms/house.html<br/>请确保目录和文件名合法且可写入，否则可能生成失败');?>&nbsp; <span id="dfilepath" class="f_red"></span></td>
</tr>
<?php } ?>
</table>
<div class="sbt"><input type="submit" name="submit" value=" 确 定 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" 重 置 " class="btn"/></div>
</form>
<?php load('clear.js'); ?>
<?php if($action == 'add') { ?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<div class="tt">单页采编</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_hid">*</span> 目标网址</td>
<td><input name="url" type="text" size="80" value="<?php echo $url;?>"/>&nbsp;&nbsp;<input type="submit" value=" 获 取 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 管理规则 " class="btn" onclick="window.open('?file=fetch');"/></td>
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
		Dmsg('请选择所属行业', 'catid', 1);
		return false;
	}
	f = 'titles';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('标题最少2字，当前已输入'+l+'字', f);
		return false;
	}
	if(Dd('ismember_1').checked) {
		f = 'username';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写会员名', f);
			return false;
		}
	} else {
		f = 'company';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写公司名称', f);
			return false;
		}
		if(Dd('areaid_1').value == 0) {
			Dmsg('请选择所在地区', 'areaid', 1);
			return false;
		}
		f = 'truename';
		l = Dd(f).value.length;
		if(l < 2) {
			Dmsg('请填写联系人', f);
			return false;
		}
		f = 'mobile';
		l = Dd(f).value.length;
		if(l < 7) {
			Dmsg('请填写手机', f);
			return false;
		}
	}
	<?php echo $FD ? fields_js() : '';?>
	if(Dd('property_require') != null) {
		var ptrs = Dd('property_require').getElementsByTagName('option');
		for(var i = 0; i < ptrs.length; i++) {		
			f = 'property-'+ptrs[i].value;
			if(Dd(f).value == 0 || Dd(f).value == '') {
				Dmsg('请填写或选择'+ptrs[i].innerHTML, f);
				return false;
			}
		}
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>