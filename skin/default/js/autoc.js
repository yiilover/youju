define(function(require, exports, module) {
	var $=require('jquery');
	require('');
	$.fn.autoC=function(url,callback){
		$("body").append('<ul id="autoc" class="autopop"></ul>');
		var $t=$(this),$pop=$("#autoc"),l=0,delay;
		var resize=function(){
			var $t=$($pop.data("bindElm"));
			var offset=$t.offset();
			$pop.css({left:offset.left,top:offset.top+$t.outerHeight()+2,width:$t.outerWidth()});
		}
		$pop.on("mouseover","li",function(){
			$pop.find(".pop").removeClass("pop");
			$(this).addClass("pop");
		}).on("mousedown","li",function(){
			$($pop.data("bindElm")).val($pop.find(".pop b").text()).closest("form").submit();
			$pop.hide();
		});
		return $t.attr("autocomplete","off").focus(function(){
			$pop.data("bindElm","#"+$(this).attr("id"));
			resize();
			$(window).bind("resize",resize);
		}).keydown(function(e){
			switch(e.which){
				case 13:
					$(this).val($pop.hide().find(".pop b").text()).closest("form").submit();
				break;
				case 38:
					var $p=$pop.find(".pop").attr("class","");
					if($p.index()>0)
						$p.prev().attr("class","pop");
					else
						$pop.find("li:last").attr("class","pop");
					return false;
				break;
				case 40:
					var $p=$pop.find(".pop").attr("class","");
					if($p.index()<l)
						$p.next().attr("class","pop");
					else
						$pop.find("li:first").attr("class","pop");
					return false;
				break;
			}
		}).keyup(function(e){
			if(e.which!=13&&e.which!=38&&e.which!=40){
				var $t=$(this);str="<li class='pop'><b>"+$t.val()+"</b></li>";
				if($t.val()==""){
					$pop.hide();
					return false;
				}
				$pop.html(str);
				if(delay)
					clearTimeout(delay);
				setTimeout(function(){
					$.ajax({
						url:url,
						dataType:'jsonp',
						data:{
							key:$t.val()
						}
					}).done(function(data){
						if(data.length>0){
							var i=0,html=str;
							l=data.length;
							for(;i<l;i++){
								html+="<li><b>"+data[i].name+"</b> "+data[i].address+"</li>";
							}
							$pop.html(html).show();
						}else{
							$pop.hide();
						}
					});
				},400)
			}
		}).blur(function(){
			$pop.hide();
			$(window).unbind("resize",resize);
		})
	}
});