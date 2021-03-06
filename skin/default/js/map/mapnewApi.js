//Document By JodJin 2011/11/07
var mapApi=function(){
	var arg=arguments;
	var cont="mapbody";
	var lng=x;//经度
	var lat=y;//纬度
	var zoom=15;//缩放级别
	var z={minZoom:10,maxZoom:18};
	for(var i=0;i<arg.length;i++){
		if(0==i){cont=arg[0];}
		else if(1==i){lng=arg[1];}
		else if(2==i){lat=arg[2];}
		else if(3==i){zoom=arg[3];}
	}
	this._map=new BMap.Map(cont,z);
	this.setCenter(lng,lat,zoom);
	this._map.addControl(new BMap.NavigationControl());
	this._map.addControl(new BMap.ScaleControl());
	this._map.addControl(new BMap.OverviewMapControl({isOpen:false}));
   	this._map.enableScrollWheelZoom();
	this._map.enableKeyboard();
	this._map.enableContinuousZoom();
	this._markerManager = new MarkerManager(this._map);
};
mapApi.prototype.setCenter=function(x,y,z){
	if(!x || !y) return;
	var z = z || this._map.getZoom();
	this._map.centerAndZoom(new BMap.Point(x,y),z);
};
mapApi.prototype.dataTrig=function(motion){
	var map=this._map;
	map.addEventListener("moveend",motion);
	map.addEventListener("zoomend",motion);
};
mapApi.prototype.getBound=function(){
	var map=this._map;
	var itBound=map.getBounds();
	var itsw=itBound.getSouthWest();
	var itne=itBound.getNorthEast();
	var pointSw=map.pointToPixel(itsw);
	var pointNe=map.pointToPixel(itne);
	var sw=map.pixelToPoint(new BMap.Pixel(pointSw.x+8,pointSw.y-8));
	var ne=map.pixelToPoint(new BMap.Pixel(pointNe.x-8,pointNe.y+8));
	return {"x1":sw.lng,"x2":ne.lng,"y1":sw.lat,"y2":ne.lat};
};
mapApi.prototype.drawMarkers=function(metaMarkers){
	var me=this;
	var map=me._map;
	var mm=me._markerManager;
	for(var i=0;i<metaMarkers.length;i++){
		var info=metaMarkers[i];
		var marker=me.createMarker(info);
		mm.addMarker(marker);
		me.markerEvents(info);
	}
};
mapApi.prototype.clearMarkers=function(){
	this._markerManager.clearMarkers();
};
mapApi.prototype.markerCls=function(itsales){
	switch(itsales){
		case "0":
			itClass="mBlue";
            break;
		case "1":
			itClass="mGreen";
            break;
		case "2":
			itClass="mPurple";
            break;
		case "3":
			itClass="mRed";
			break;
		default:
			itClass="mRed";
            break;
	}
	return itClass;
};
mapApi.prototype.createMarker=function(info){
	var me=this;
	var map=me._map;
	var mm=me._markerManager;
	var point=new BMap.Point(info.x,info.y);
	var clas=me.markerCls(info.sales);
	var text='<span class="left"></span><span class="right" id="markerInfo_'+info.cid+'">'+info.cname+'</span><span class="bottom"></span>';
	var marker=new popMarker(point,{mText:text,mClass:clas});
	return marker;
};
mapApi.prototype.markerEvents=function(info){
	var me=this;
	var mIndex=BMap.Overlay.getZIndex(info.y);
	var itMarker=$("#markerInfo_"+info.cid).parent();
	itMarker.bind("mouseover",function(){
		$("#markerInfo_"+info.cid).html(info.cname);
		$(this).removeClass().addClass("mOrange").css({"z-index":500});
	});
	itMarker.bind("mouseout",function(){
		$("#markerInfo_"+info.cid).html(info.cname);
		$(this).removeClass().addClass(me.markerCls(info.sales)).css({"z-index":mIndex});												   
	});
	itMarker.bind("click",function(e){
		me.openWin(info,e);		  
	});
}
mapApi.prototype.openWin=function(marker,e){
	var me=this;
	var node=_id("mapwin");
	if('undefined' == typeof marker.cid) return;
	if(marker.averprice==0 || !marker.averprice){var it_price='<b>待定</b>'}else{it_price='<b>'+marker.averprice+'</b> 元/平方米';}
	var winStr='';
	winStr+='<div id="winBox">';
	winStr+='<div class="wintop" onmousedown="mapPatch.drag(this.parentNode.parentNode,event,\'mapmain\');"><a href="javascript:;" onclick="mapObj.closeWin();" class="winclose" title="关闭"></a><b><a href="'+marker.href+'" target="_blank">'+marker.cname+'</a></b><span class="wini">['+marker.saletype+']</span></div><div class="clear"></div>';
	winStr+='<div class="wincont"><div class="win_c_r"><a href="'+marker.href+'" target="_blank"><img src="'+marker.imgsrc+'" width="160" height="120"></a><br /><a href="'+marker.href+'" target="_blank">查看楼盘详情?</a></div><div class="win_c_l"><ul><li>均价：'+it_price+'</li><li>物业类型：'+marker.protype+'</li><li>项目地址：'+marker.hseat+'</li><li>开发商：'+marker.emplor+'</li><li>销售电话：<b>'+marker.tel+'</b></li></ul></div></div>';
	winStr+='</div>';
	node.innerHTML=winStr;
        node.style.cssText="display:block;left:"+ (e.clientX-55) +"px;top:"+ (e.clientY-90) +"px";
};
mapApi.prototype.closeWin=function(){
	var node = _id("mapwin");
	if(node){node.style.display="none";}
};
function MarkerManager(map){
	this._markers=[];
	this._map=map;
}
MarkerManager.prototype.addMarker=function(marker){
	this._markers.push(marker);
	this._map.addOverlay(marker);
};
MarkerManager.prototype.clearMarkers=function(marker){
	while(this._markers.length>0){
		this._map.removeOverlay(this._markers.shift());
	}
};
function popMarker(point,opt_opts){
	this._point=point;
	this._text=opt_opts.mText||"";
	this._class=opt_opts.mClass||"mBlue";
	BMap.Marker.apply(this,arguments);
}
popMarker.prototype=new BMap.Marker(new BMap.Point(0,0));
popMarker.prototype.initialize=function(map){
	this._map=map;
	var div=this._div=document.createElement("div");
  	div.innerHTML=this._text;
	div.className=this._class;
  	div.style.position="absolute";
  	div.style.cursor="pointer";
	div.style.zIndex=BMap.Overlay.getZIndex(this._point.lat);
	map.getPanes().markerPane.appendChild(div);
};
popMarker.prototype.draw=function(){
  	var map=this._map;
    var pixel=map.pointToOverlayPixel(this._point);
    this._div.style.left=pixel.x-15+"px";
    this._div.style.top=pixel.y-33+"px";
};
popMarker.prototype.remove=function(){
	if(typeof(HTMLElement)!="undefined" && !window.opera){ 
    HTMLElement.prototype.__defineGetter__("outerHTML",function(){ 
        var a=this.attributes, str="<"+this.tagName, i=0;for(;i<a.length;i++) 
        if(a[i].specified) 
            str+=" "+a[i].name+'="'+a[i].value+'"'; 
        if(!this.canHaveChildren) 
            return str+" />"; 
        return str+">"+this.innerHTML+"</"+this.tagName+">"; 
    }); 
    HTMLElement.prototype.__defineSetter__("outerHTML",function(s) 
    { 
        var r = this.ownerDocument.createRange(); 
        r.setStartBefore(this); 
        var df = r.createContextualFragment(s); 
        this.parentNode.replaceChild(df, this); 
        return s; 
    }); 
    HTMLElement.prototype.__defineGetter__("canHaveChildren",function() 
    { 
        return !/^(area|base|basefont|col|frame|hr|img|br|input|isindex|link|meta|param)$/.test(this.tagName.toLowerCase()); 
    }); 
	}
	if(this._div.outerHTML){
    	this._div.outerHTML="";
  	}
	this._div=null;
  	BMap.Marker.prototype.remove.apply(this,arguments);
};