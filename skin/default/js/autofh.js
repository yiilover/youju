define(function(require, exports, module) {
	var $=require('jquery');
	$.fn.autofh=function(menu,list,time){
		var $ts=$(this);
		return $ts.each(function(){
			var $t=$(this),$f=$t.find("form"),$fi=$f.find("input:eq(0)"),$fs=$f.find("input:eq(1)");
			$t.on("focus","input",function(){
				$ts.removeClass("on")
				$t.addClass("on");
				$("body").click(function(){
					$t.removeClass("on");
					$(this).unbind("click")
				})
			}).on("keydown","input",function(e){
				if(e.which==13)
					$f.find("button").click();
				if(e.which==9||e.which==8)
					return;
				if(e.which<48||e.which>105||(e.which>57&&e.which<96))
					return false;
			}).on("click","button",function(){
				if($fi.val()==""||$fs.val()-0<$fi.val()){
					$fi.focus();
					return false;
				}
				if($fs.val()==""){
					$fs.focus();
					return false;
				}
				var endStr=$f.attr("data-end")?$f.attr("data-end"):"";
				endStr+="";
				setTimeout(function(){
					window.location.href=$f.attr("action")+"?minprice="+$fi.val()+"&maxprice="+$fs.val()+endStr;
				},99)
			}).click(function(){
				return false;
			})
		})
	}
});