$(function(){
	$(".resetinput").val("");
	$("#xf_search_bt").click(function(){
		var goto = '';
		goto += "areaid=" + $("#xf_place").val();
		goto += "&p=" +  $("#xf_price").val();
		goto +="&catid=" +  $("#xf_project").val();
		goto += $("#xf_circle").val();
		var xf_key = $("#xf_key").val();
		if(xf_key != ""){
			goto += "&kw=" + xf_key;
			
		}
		window.open(xf_url + "search.php?" + goto + "");
	});
	$("#xf_key").keydown(function(e){
		if (e.which == 13)
			$("#xf_search_bt").click()
	})
	$("#search_content").val("1");
	$("#srchtxt").keydown(function(e){
		var search_content = $("#search_content").val();
		if (e.which == 13 && search_content != "9") {
			$("#all_search_bt").click();
			return false;
		}
	})
	$("#all_search_bt").click(function(){
		var search_content = $("#search_content").val();
		var keyword = $("#srchtxt").val();
		keyword = keyword == "请输入搜索关键字" ? "" : keyword;
		if(search_content == 1){
			window.open(xf_url + "search.php?kw=" + keyword);
		}else if(search_content == 2){
			if(keyword != ""){
				keyword = "kw=" + keyword;
			}
			
			window.open(esf_url + "search.php?" + keyword + "");
		}else if(search_content == 3){
			if(keyword != ""){
				keyword = "kw=" + keyword;
			}
			
			window.open(rent_url + "search.php?" + keyword + "");
		}else if(search_content == 4){
			if(keyword != ""){
				keyword = "kw=" + keyword;
			}
			window.open(news_url + "search.php?" + keyword + "");
		}else if(search_content == 5){
			if(keyword != ""){
				keyword = "-m" + keyword;
			}
			window.open(office_url + "zu" + keyword + ".html");
		}else if(search_content == 6){
			if(keyword != ""){
				keyword = "-m" + keyword;
			}
			window.open(office_url + "shou" + keyword + ".html");
		}else if(search_content == 7){
			if(keyword != ""){
				keyword = "-m" + keyword;
			}
			window.open(shop_url + "zu" + keyword + ".html");
		}else if(search_content == 8){
			if(keyword != ""){
				keyword = "-m" + keyword;
			}
			window.open(shop_url + "shou" + keyword + ".html");
		}else if(search_content == 9){
			$("#search_form").click();
		}
	});
})

function search_esf_rent(type){
	$(".s_Box").hide();
	$(".esf_rent_key").val("");
	if(type == 1){
		$("#type_show_rent").html("出租");
		$("#search_esf").hide();
		$("#search_rent").show();
		$("#type_show_esf").html("出售");
	}else{
		$("#type_show_esf").html("出售");
		$("#search_rent").hide();
		$("#search_esf").show();
		$("#type_show_rent").html("出租");
	}
}

function search_office_shop(type){
	$(".s_Box").hide();
	$(".office_shop_key").val("");
	
	$("#type_office_rent").html("写字楼出租");
	$("#type_office_sell").html("写字楼出售");
	$("#type_shop_rent").html("商铺出租");
	$("#type_shop_sell").html("商铺出售");
	$(".office_shop_box").hide();
	$("#office_shop_box" + type).show();
}
