define(function(require, exports, module) {
	var $=require('jquery');
	$(function(){
		var $list=$("img[data-src]").attr("src","{AJ_SKIN}images/common/lazy.gif").css("background","url({AJ_SKIN}images/common/loading.gif) no-repeat 50% 50%");
		if($list.length>0){
			var $w=$(window),delay=0;
			var scrollLoad=function(){
				if(delay)
					clearTimeout(delay);
				setTimeout(function(){
					var h=$w.height()+$w.scrollTop();
					$list.each(function(){
						var $t=$(this);
						if($t.offset().top<h){
							$list=$list.not($t.attr("src",$t.attr("data-src")));
						}
					})
				},400)
			}
			scrollLoad();
			$(window).bind('scroll resize',scrollLoad);
		}
	})
});