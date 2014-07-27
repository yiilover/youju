define(function(require, exports, module) {
	var $=require('jquery');
	$.fn.autab=function(menu,list,time){
		return $(this).each(function(){
			var $t=$(this),$m=$t.find(menu);
			$m.on("mouseover",function(){
				$m.removeClass("on");
				$t.find(list).hide().eq($(this).addClass("on").index()).show()
			})
			if(time>0){
				var l=$m.length,i=1;
				setInterval(function(){
					if(i==l)
						i=0;
					$m.eq(i++).trigger("mouseover");
				},time*1000)
			}
		})
	}
});