	var myzbj=$("#tl_myzbj");
	var	myzbjc=$("#tl_myzbj .more_con");
	var	fuwu=$("#tl_fuwu");
	var	fuwuc=$("#tl_fuwu .more_fuwu");
	var	tl_nav=$("#tl_nav");
	var	tl_navlist=$("#tl_nav .more_nav");
		//time_good=$("#time_good");
	myzbj.hover(function(){
		myzbjc.show();
	},function () {
		myzbjc.hide();
	});
	fuwu.hover(function(){
		fuwuc.show();
	},function () {
		fuwuc.hide();
	});
	tl_nav.hover(function(){
		tl_navlist.show();
	},function () {
		tl_navlist.hide();
	});

$(function(){
<!--底部滚动-->
	$('#marquee_box').kxbdSuperMarquee({
			isAuto:true,
			distance:130,
			time:10,
			btnGo:{up:'#goD',down:'#goU'},
			direction:'up',
			currentpage:'gobox_page'
	});	
<!--论坛左右滚动-->
	$('#marquee_row').kxbdSuperMarquee({
			isAuto:false,
			distance:600,
			time:10,
			btnGo:{left:'#goL',right:'#goR'},
			direction:'right',
			currentpage:'gobox_page'
	});	
	
});

//焦点图
jQuery(function() {
	var len_1  = jQuery(".f dt i").length;
	var index_1 = 1;
	if(len_1!=0){
		jQuery(".f dt i").click(function(){
			index_1  =   jQuery(".f dt i").index(this);
			showImg(index_1);
		});	
		jQuery('.f').hover(function(){
			if(MyTime){
				clearInterval(MyTime);
			}
		},function(){
			  MyTime = setInterval(function(){
				showImg(index_1)
				index_1++;
				if(index_1==len_1){index_1=0;}
			  } , 3000);
		});
		var MyTime = setInterval(function(){
			showImg(index_1)
			index_1++;
			if(index_1==len_1){index_1=0;}
		}, 3000);
	}
  function showImg(i){
		jQuery(".f dd").hide();
		jQuery(".f dd").stop(true,true).eq(i).fadeIn(600);
		jQuery(".f dt i").removeClass("cur");
		jQuery(".f dt i").eq(i).addClass("cur")
  };

//新房小焦点图270*125
	var len_2  = jQuery(".f2 dt i").length;
	var index_2 = 1;
	if(len_2!=0){
		jQuery(".f2 dt i").click(function(){
			index_2  =   jQuery(".f2 dt i").index(this);
			showImg2(index_2);
		});	
		jQuery('.f2').hover(function(){
			if(MyTime2){
				clearInterval(MyTime2);
			}
		},function(){
			  MyTime2 = setInterval(function(){
				showImg2(index_2)
				index_2++;
				if(index_2==len_2){index_2=0;}
			  } , 3000);
		});
		var MyTime2 = setInterval(function(){
			showImg2(index_2)
			index_2++;
			if(index_2==len_2){index_2=0;}
		}, 3000);
	}
  function showImg2(i){
		jQuery(".f2 dd").hide();
		jQuery(".f2 dd").stop(true,true).eq(i).fadeIn(600);
		jQuery(".f2 dt i").removeClass("cur");
		jQuery(".f2 dt i").eq(i).addClass("cur")
  };
  
  
  /*论坛字母搜索*/
  $(".bbs_letters").click(function(){
	   $("#bbs_srchtxt").val($(this).html());
	   $("#bbs_srchtxt_form").submit();
  });
});