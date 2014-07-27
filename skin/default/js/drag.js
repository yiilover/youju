define(function(require, exports, module) {
	var $=require('jquery');
	$.fn.drag=function(opt){
		opt=opt?opt:this;
		$(this).each(function(){
			this.onselectstart=function(){return false};
			if($.browser.mozilla)
				this.addEventListener('DOMMouseScroll',function(e){e.preventDefault()},false);
			else
				this.onmousewheel=function(){return false};
			var $drag=$(opt);
			var w=$(window).width()-$drag.width()-12;
			var c=$drag.offset().top-$(window).scrollTop();
			var scroll=function(){$drag.stop(true,false).animate({top:c+$(window).scrollTop()})};
			$(this).css('cursor','move').mousedown(function(e){
				var st=$(window).scrollTop();
				var t=st+4;
				var u=st+$(window).height()-$drag.height()-12;
				var x=e.pageX-$drag.fadeTo('fast',0.6).offset().left;
				var y=e.pageY-$drag.offset().top-st; 
				$(document).mousemove(function(e){
					var cx=e.clientX-x;
					var cy=e.clientY-y;
					c=$drag.css({left:cx<4?4:(cx>w?w:cx),top:cy>u?u:(cy<t?t:cy)}).offset().top-$(window).scrollTop();
				}).mouseup(function(){
					$drag.fadeTo('fast',1);
					$(this).unbind('mousemove').unbind('mouseup');
				});
				return false;
			})
			$(window).bind('scroll',scroll)
		});
		return $(this);
	}
});