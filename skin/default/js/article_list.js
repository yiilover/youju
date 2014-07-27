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
		GetObj("m0" + flag01 + "-"+index01).className = "on";
	}
	
	for(var i=0;i<9;i++){/* 最多支持9个标签 */
		if(GetObj("news_con0" + flag01 + "-" + i)&&GetObj("news_m0" + flag01 + "-"+i)){
			GetObj("news_con0" + flag01 + "-"+i).style.display = 'none';
			GetObj("news_m0" + flag01 + "-"+i).className = "";
		}
	}
	if(GetObj("news_con0" + flag01 + "-"+index01)&&GetObj("news_m0" + flag01 + "-"+index01)){
		GetObj("news_con0" + flag01 + "-"+index01).style.display = 'block';
		GetObj("news_m0" + flag01 + "-"+index01).className = "hover";
	}
	
		for(var i=0;i<9;i++){/* 最多支持9个标签 */
		if(GetObj("zt_con1" + flag01 + "-" + i)&&GetObj("zt_m1" + flag01 + "-"+i)){
			GetObj("zt_con1" + flag01 + "-"+i).style.display = 'none';
			GetObj("zt_m1" + flag01 + "-"+i).className = "";
		}
	}
	if(GetObj("zt_con1" + flag01 + "-"+index01)&&GetObj("zt_m1" + flag01 + "-"+index01)){
		GetObj("zt_con1" + flag01 + "-"+index01).style.display = 'block';
		GetObj("zt_m1" + flag01 + "-"+index01).className = "hover";
	}
}
