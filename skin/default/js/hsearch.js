define(function(require, exports, module) {
	var $=require('jquery');
	require('autoc');
	$.fn.hSearch=function(url,autoUrl){
		var $s=$("#qy,#wy,#jg");
		if($("#shx").length>0)
			$s=$s.add("#shx");
		$s.hover(function(){
			$(this).addClass("on")
		},function(){
			$(this).removeClass("on")
		}).on("click","a",function(){
			$(this).parent().parent().data("val",$(this).attr("data-val")).removeClass("on").find("span").html($(this).text())
		}).data("val","")
		var $text=$(this).find(":text").attr("id","hSearchText").autoC(autoUrl);
		var fbval=$text.val();
		$(this).on("focus","input",function(){
			if($(this).val()==fbval)
				$(this).val("")
		}).on("blur","input",function(){
			if($(this).val()=="")
				$(this).val(fbval)
		}).on("keyup","input",function(e){
			if(e.which==13)
				$(this).next().click()
		}).on("click","button",function(){
			var str="search.php?";
			$s.each(function(){
				str+=$(this).data("val");
			})
			if($text.val()!="请输入关键字（楼盘名/地名、开发商等）")
				str+="kw="+$text.val();
			setTimeout(function(){window.location.href=url+str+""},99);
		}).on("mouseover","li.more",function(){
			$(this).addClass("on")
		}).on("mouseout","li.more",function(){
			$(this).removeClass("on")
		})
	}
})