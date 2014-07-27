$(document).ready(function(){
	//下拉选择层
	$(".s_Box").hide();
	$(".none").click(
		function () {		 
			if(!$(this).children(".s_Box").is(":animated")){//判断是否处于动画
				$(this).children(".s_Box").fadeIn();
				$(".s_Box").not($(this).children(".s_Box")).fadeOut(0);
				return false;
			}			 
		});
	$(".s_Box span").click(function(event){
		var text = $(this).text()
		var svalue = $(this).attr('val')
		$(this).parent().parent().parent().children(".select").children("em").text(text);
		$(this).parent().parent().parent().children("input[type=hidden]").val(svalue);
		$(this).parent().parent().fadeOut();	
	     var select_id = $(this).attr('id');
		 for(var i=1;i<5;i++){
		$("#select_"+i).css('display',"none");	 
		}
		$("#select_"+select_id).css('display',"block");
		return false;
	});
	$(".s_Box span a").click(function(event){
		var text = $(this).text()
		var svalue = $(this).attr('val')
		$(this).parent().parent().parent().parent().children(".select").children("em").text(text);
		$(this).parent().parent().parent().parent().children("input[type=hidden]").val(svalue);
		$(this).parent().parent().parent().fadeOut();	
		return false;
	});
	$(".s_Box #priceset").click(function(event){
		var low_price = $("#low_price").val();
		var top_price = $("#top_price").val();
		if (low_price>0 || top_price>0)
		{
			$(this).parent().parent().parent().parent().children(".select").children("em").text(low_price+"-"+top_price);
			$(this).parent().parent().parent().parent().children("input[type=hidden]").val(low_price+"-"+top_price);
		} else {
			$(this).parent().parent().parent().parent().children(".select").children("em").text("不限");
			$(this).parent().parent().parent().parent().children("input[type=hidden]").val('');
		}
		$(this).parent().parent().parent().fadeOut();	
		return false;
	});
	$(document).click(function(event){
		$(".s_Box").fadeOut(200);
	});
	
	$(".title01 em").hover(
		function () {
			$(this).children(".s_Box_1").addClass("show");
			$(this).children(".s_Box_1").removeClass("hidden");
			 return false;
		},
		function () {
			$(this).children(".s_Box_1").addClass("hidden");
			$(this).children(".s_Box_1").removeClass("show");
			 return false;
		}
	);
	
});

/**---------------------------------tab---------------------------------**/
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
		GetObj("m0" + flag01 + "-"+index01).className = "tab01active";
	}
}
/*---------------------------------------新房中心轮换------------------------------------------*/
