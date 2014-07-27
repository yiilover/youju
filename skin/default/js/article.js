function GetObj(objName){
	if(document.getElementById){
		return eval('document.getElementById("' + objName + '")');
	}else if(document.layers){
		return eval("document.layers['" + objName +"']");
	}else{
		return eval('document.all.' + objName);
	}
}
function Tab01(index01,flag01){
	for(var i=0;i<9;i++){/* 最多支持9个标签 */
		if(GetObj("con0" + flag01 + "-" + i)&&GetObj("m0" + flag01 + "-"+i)){
			GetObj("con0" + flag01 + "-"+i).style.display = 'none';
			GetObj("m0" + flag01 + "-"+i).className = "";
		}
	}
	if(GetObj("con0" + flag01 + "-"+index01)&&GetObj("m0" + flag01 + "-"+index01)){
		GetObj("con0" + flag01 + "-"+index01).style.display = 'block';
		GetObj("m0" + flag01 + "-"+index01).className = "on";
	}
	
	for(var i=0;i<9;i++){/* 最多支持9个标签 */
		if(GetObj("news_con0" + flag01 + "-" + i)&&GetObj("news_m0" + flag01 + "-"+i)){
			GetObj("news_con0" + flag01 + "-"+i).style.display = 'none';
			GetObj("news_m0" + flag01 + "-"+i).className = "";
		}
	}
	if(GetObj("news_con0" + flag01 + "-"+index01)&&GetObj("news_m0" + flag01 + "-"+index01)){
		GetObj("news_con0" + flag01 + "-"+index01).style.display = 'block';
		GetObj("news_m0" + flag01 + "-"+index01).className = "hover";
	}
	
		for(var i=0;i<9;i++){/* 最多支持9个标签 */
		if(GetObj("zt_con1" + flag01 + "-" + i)&&GetObj("zt_m1" + flag01 + "-"+i)){
			GetObj("zt_con1" + flag01 + "-"+i).style.display = 'none';
			GetObj("zt_m1" + flag01 + "-"+i).className = "";
		}
	}
	if(GetObj("zt_con1" + flag01 + "-"+index01)&&GetObj("zt_m1" + flag01 + "-"+index01)){
		GetObj("zt_con1" + flag01 + "-"+index01).style.display = 'block';
		GetObj("zt_m1" + flag01 + "-"+index01).className = "hover";
	}
}

//评论移上去变背景
$(document).ready(function(){
	$.getJSON(APP_URL+'?app=system&controller=content&action=stat&jsoncallback=?&contentid='+contentid);
	$(".blkContentBtmpj_frame").hover(function () {
		$(this).addClass("on_frame");
	},function () {
		$(this).removeClass("on_frame");
	});
});

var content = '';//第一页内容缓存
var context = '';//全文内容缓存
var isfulltext = false;
$(function(){
	content = $('#ctrlfscont').html();
});
function fulltext(){  //单页阅读
		if(context =='')
		$.getJSON(APP_URL+'?app=article&controller=article&action=fulltext&jsoncallback=?&contentid='+contentid,function(data){
			context = data.content;
			$('#ctrlfscont').html(data.content);
			$('#show-all-cont').html('分页阅读').parent().siblings().hide();
			$('.bor-ccc').hide();
			isfulltext = true;
			holdpic();
		});
		else{
			$('#ctrlfscont').html(isfulltext?content:context);
			$('#show-all-cont').html(isfulltext?'单页阅读':'分页阅读').parent().siblings().toggle(isfulltext === true);
			isfulltext = (isfulltext === false);
			$('.bor-ccc').show();
			holdpic();
		}
}


function holdpic(){//控制内容区域的的图片大小并为过大的图片添加查看原图
	var options = {
		imageLoading:IMG_URL+'js/lib/lightBox/lightbox-ico-loading.gif',
		imageBtnPrev:IMG_URL+'js/lib/lightBox/lightbox-btn-prev.gif',
		imageBtnNext:IMG_URL+'js/lib/lightBox/lightbox-btn-next.gif',
		imageBtnClose:IMG_URL+'js/lib/lightBox/lightbox-btn-close.gif',
		imageBlank:IMG_URL+'js/lib/lightBox/lightbox-blank.gif'
	};
	$('#ctrlfscont').find('img').each(function(){
		var img = this;
		if (img.width>580) {
			img.style.width = '580px';
			$(img).removeAttr('height');
			/*var aTag = document.createElement('a');
			aTag.href = img.src;
			$(aTag).addClass('bPic')
			.insertAfter(img).append(img)
			.lightBox(options);*/
		}
	});
}

$(function(){
	var font = $.cookie(COOKIE_PRE+'font');//根据cookie设置字体大小并初始化按钮
	if(font){
		$('#ctrlfssummary,#ctrlfscont').addClass(font);
		if(font == 'fs-big'){
		 	$('#fontBig').addClass('cor-current');
			$('#fontSmall').removeClass('cor-current');
		}
	}
	$("#fontBig,#fontSmall").click(function(){
		var tosmall = ($(this).attr("class")=='small') ? true : false;
		if(tosmall&&$(this).hasClass('cor-current')) return;
		$('.cor-current').removeClass('cor-current');
		$(this).addClass('cor-current');
		$.cookie(COOKIE_PRE+'font',tosmall?'fs-small':'fs-big',{domain:COOKIE_DOMAIN,path:COOKIE_PATH,expires:300});
		$('#ctrlfssummary,#ctrlfscont').removeClass(tosmall?'fs-big':'fs-small').addClass(tosmall?'fs-small':'fs-big');
	});
})