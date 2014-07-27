var tagclass=""; //标签的class名称
var conclass=""; //内容的class名称
var hoverclass=""; //标签切换的class名称
function tagchange(tagclass,conclass,hoverclass){
	$("."+tagclass).eq(0).addClass(hoverclass);
	$("."+conclass).not($("."+conclass).eq(0)).hide();
	
	$("."+tagclass).hover(function(){
		var listnum = $("."+tagclass).index($(this));
		$("."+tagclass).removeClass(hoverclass);
		$(this).addClass(hoverclass);
		$("."+conclass).not($("."+conclass).eq(listnum)).hide();
		$("."+conclass).eq(listnum).show();
	});

}