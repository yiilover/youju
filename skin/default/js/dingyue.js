define(function(require, exports, module) {
	var $=require('jquery');
	var alertM=require('alert');
	var arr=[
		'<ul id="pricechange">',
		'<li><b>免费订阅',
		'的最新楼盘消息和价格变动通知服务</b></li>',
		'<li>留下您的手机或邮箱, 如果',
		'有最新楼盘消息或价格变动, 我们会第一时间通知您.</li>',
		'<li><b>发送',
		'的楼盘信息到您的手机</b></li><li>您将会收到如下信息：</li><li class="gray9">',
		'</li>',
		'<li>请选择订阅服务:</li><li><input name="flagprice" id="flagprice" type="checkbox" style="width:20px;" value="1"><label for="flagprice">价格变动通知</label><input name="flaginfo" id="flaginfo" type="checkbox" value="2"><label for="flaginfo">楼盘最新消息</label></li>',
		'<li>请输入您的Email地址:（<a href="javascript:void(0)" id="contact_tel">我要用手机订阅</a>）</li><li><input type="text" name="email" id="email"></li>',
		'<li>请输入您的手机号码:</li><li><input type="text" name="mobile" id="dymobile"></li>',
		'<li>请输入您收到的验证码:</li><li><input type="text" name="mobile" id="dyencode" style="width:50px">&nbsp;<a href="javascript:void(0)" class="dycheck">点击免费获取验证码</a></li>',
		'<li id="dyinfo"></li></ul>'
	]
	return {
		drawInfoToM:function(name,info){
			return arr[0]+arr[5]+name+arr[6]+info+arr[7]+arr[10]+arr[11]+arr[12];
		},
		infoToM:function(name,info,hid,checkurl,murl){
			var str=module.exports.drawInfoToM(name,info);
			alertM(str,{title:"发送楼盘信息到手机",time:"y",width:400,btnN:1,btnYT:'发送',yf:function(){
				var $m=$("#dymobile");
				var $e=$("#dyencode");
				var $i=$("#dyinfo");
				if(!/^1[3458]\d{9}$/.test($m.val())){
					$i.html("请填写正确的手机号码格式");
					$m.focus();
				}else if($e.val()==""){
					$i.html("请填写验证码");
					$e.focus();
				}else{
					$.ajax({
						url:murl,
						dataType:'json',
						data:{
							id:hid,
							mobile:$m.val(),
							encode:$e.val()
						}
					}).done(function(data){
						if(data.suc){
							alertM(data.alert)
						}else
							$i.html(data.alert);
					}).fail(function(){$i.html("发送失败，请检查网络连接是否已断开"); });
				}
				return false;
			}})
			var $m=$("#dymobile");
			var $i=$("#dyinfo");
			$("#pricechange").on("click","a.dycheck",function(){
				var $t=$(this);
				if(!/^1[3458]\d{9}$/.test($m.val())){
					$i.html("请填写正确的手机号码格式");
					$m.focus();
				}else{
					$.ajax({
						url:checkurl,
						dataType:'json',
						data:{
							mobile:$m.val()
						}
					}).done(function(data){
						if(data.suc){
							$t.attr("class","dywaite").html("等待120秒后再次点击");
							var i=119;
							var setin=setInterval(function(){
								$t.html("等待"+i+"秒后再次点击")
								if(--i<0){
									$t.attr("class","dycheck").html("点击免费获取验证码");
									clearInterval(setin);
								}
							},999)
						}
						$i.html(data.alert);
					}).fail(function(){$i.html("验证码发送失败，请检查网络连接是否已断开"); });
				}
			})
		},
		draw3:function(){

		},
		reInit:function(reurl,durl){
			
		},
		formInit:function(url,id,se){
			
		}
	}
})