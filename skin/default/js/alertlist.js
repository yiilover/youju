define(function(require, exports, module) {
	var $ = require('jquery');
	var alertM = require('alert');
	var arr = ['<ul id="pricechange">', '<li><b>免费订阅', '的最新楼盘消息和价格变动通知服务</b></li>', '<li>留下您的手机或邮箱, 如果', '有最新楼盘消息或价格变动, 我们会第一时间通知您.</li>', '<li><b>发送', '的房源信息到您的手机</b></li><li>您将会收到如下信息：</li><li class="gray9">', '</li>', '<li>请选择订阅服务:</li><li><input name="flagprice" id="flagprice" type="checkbox" style="width:20px;" value="1"><label for="flagprice">价格变动通知</label><input name="flaginfo" id="flaginfo" type="checkbox" value="2"><label for="flaginfo">楼盘最新消息</label></li>', '<li>请输入您的Email地址:（<a href="javascript:void(0)" id="contact_tel">我要用手机订阅</a>）</li><li><input type="text" name="email" id="email"></li>', '<li>请输入您的手机号码:</li><li><input type="text" name="mobile" id="dymobile"></li>', '<li>请输入您收到的验证码:</li><li><input type="text" name="mobile" id="dyencode" style="width:50px">&nbsp;<a href="javascript:void(0)" class="dycheck">点击免费获取验证码</a></li>', '<li id="dyinfo"></li></ul>'];
	var mobileArr = ['<ul id="mobilea"></li><li>系统先呼叫您，再接通<b class="red">', '</b>电话</li><li class="red">本次通话免费</li><li>您的电话将显示号码 010-**** 的来电</li><li>若未成功，请稍后重试。</li><li>请输入您的电话号码:</li><li><input type="text" name="mobile" id="mpH"></li><li id="minfo">电话格式如0311********或138********</li></ul>'];
	var messageArr = ['<ul><li><span></span>向 <b class="red">', '</b> 发送站内短消息</li><li><span>姓名：</span><input type="text" id="uname"></li> <li><span>联系方式：</span><input type="text" id="ucon"></li> <li><span>消息内容：</span><textarea id="utext"></textarea></li> <li id="minfo"></li>'];
	var favoriteArr = ['<ul> <li><span></span><a target="_blank" href="', '" id="saveToDesk">保存到桌面</a></li> <li><span></span><a href="javascript:void(0)" id="saveToFav">添加到浏览器收藏夹</a></li> <li><span></span><a href="javascript:void(0)" id="saveToCopy">复制当前页面链接</a></li><li id="minfo"></li></ul>']
	var reportArr = ['<form> <input type="hidden" name="hid" value="', '" /> <ul style="padding:0 32px"> <li> <input type="radio" value="1" name="slt" id="slt_1" class="radio"> <label for="slt_1">该房源已售或不存在</label> </li> <li> <input type="radio" value="2" name="slt" id="slt_2" class="radio"> <label for="slt_2">该房源售价与实际价格严重不符</label> </li> <li> <input type="radio" value="3" name="slt" id="slt_3" class="radio"> <label for="slt_3">该房源信息描述或照片与实际不符</label> </li> <li> <b>其他：（选填）</b> </li> <li> <input type="text" name="wronginfo" id="wronginfo"></li> <li id="minfo"></li> </ul></form>']
	return {
		sendToMobile: function(name, info, hid, checkurl, murl) {
			alertM(arr[0] + arr[5] + name + arr[6] + info + arr[7] + arr[10] + arr[11] + arr[12], {
				title: "发送房源信息到手机",
				time: "y",
				width: 400,
				btnN: 1,
				btnYT: '发送',
				yf: function() {
					var $m = $("#dymobile");
					var $e = $("#dyencode");
					var $i = $("#dyinfo");
					if(!/^1[3458]\d{9}$/.test($m.val())) {
						$i.html("请填写正确的手机号码格式");
						$m.focus();
					} else if($e.val() == "") {
						$i.html("请填写验证码");
						$e.focus();
					} else {
						$.ajax({
							url: murl,
							dataType: 'jsonp',
							data: {
								id: hid,
								mobile: $m.val(),
								encode: $e.val()
							}
						}).done(function(data) {
							if(data.suc) {
								alertM(data.alert,{cName:"yes",btnY:0})
							} else $i.html(data.alert);
						}).fail(function() {
							$i.html("发送失败，请检查网络连接是否已断开");
						});
					}
					return false;
				}
			})
			var $m = $("#dymobile");
			var $i = $("#dyinfo");
			$("#pricechange").on("click", "a.dycheck", function() {
				var $t = $(this);
				if(!/^1[3458]\d{9}$/.test($m.val())) {
					$i.html("请填写正确的手机号码格式");
					$m.focus();
				} else {
					$.ajax({
						url: checkurl,
						dataType: 'jsonp',
						data: {
							mobile: $m.val()
						}
					}).done(function(data) {
						if(data.suc) {
							$t.attr("class", "dywaite").html("等待120秒后再次点击");
							var i = 119;
							var setin = setInterval(function() {
								$t.html("等待" + i + "秒后再次点击")
								if(--i < 0) {
									$t.attr("class", "dycheck").html("点击免费获取验证码");
									clearInterval(setin);
								}
							}, 999)
						}
						$i.html(data.alert);
					}).fail(function() {
						$i.html("验证码发送失败，请检查网络连接是否已断开");
					});
				}
			})
			$m.keydown(function(e) {
				if(e.which == 9 || e.which == 8) return;
				if(e.which < 48 || e.which > 105 || (e.which > 57 && e.which < 96)) return false;
			})
		},
		callMobile: function(name, hid, url) {
			alertM(mobileArr[0] + name + mobileArr[1], {
				title: '欢迎致电<b class="red">' + name + "</b>",
				width: 400,
				time: "y",
				btnYT: '拨打',
				btnN: 1,
				yf: function() {
					var $mph = $("#mpH");
					var $i = $("#minfo");
					if(/^1[3458]\d{9}$|^0\d{2,3}\d{7,8}?$/.test($mph.val())) {
						$.ajax({
							url: url,
							dataType: 'text',
							data: {
								hid: hid,
								phone: $mph.val()
							}
						}).done(function(data) {
							$i.html(data);
						}).fail(function() {
							$i.html("电话转接失败，请检查网络连接是否已断开");
						});
					} else $i.html("电话格式错误，格式如0311********或138********，请重新输入")
					return 0
				}
			});
			$("#mpH").keydown(function(e) {
				if(e.which == 9 || e.which == 8) return;
				if(e.which < 48 || e.which > 105 || (e.which > 57 && e.which < 96)) return false;
			})
		},
		sendMessage: function(name, uid, url) {
			alertM(messageArr[0] + name + messageArr[1], {
				width: 420,
				title: "发送站内短消息",
				time: "y",
				btnN: 1,
				yf: function() {
					var $n = $("#uname"),
						$c = $("#ucon"),
						$t = $("#utext"),
						$i = $("#minfo");
					$("#alertM").on("focus", "input,textarea", function() {
						$i.html("")
					})
					if($n.val() == "") $i.html("姓名不得为空");
					else if($c.val() == "") $i.html("联系方式不得为空");
					else if($t.val() == "") $i.html("消息内容不得为空");
					else {
						$.ajax({
							url: url,
							type: "POST",
							dataType: 'jsonp',
							data: {
								uid: uid,
								name: $n.val(),
								contact: $c.val(),
								message: $t.val()
							}
						}).done(function(data) {
							if(data.suc) alertM(data.alert,{cName:"yes",btnY:0})
							else $i.html(data.alert);
						}).fail(function() {
							$i.html("发送消息失败，请检查网络连接是否已断开");
						});
					}
				}
			})
		},
		favorite: function(downurl) {
			require("copy");
			alertM(favoriteArr[0] + downurl + favoriteArr[1], {
				title: "收藏房源信息",
				time: "y",
				btnN: 1,
				btnY: 0
			})
			var $i = $("#minfo");
			$("#saveToFav").click(function() {
				var sURL = window.location.href;
				var sTitle = document.title;
				try {
					window.external.addFavorite(sURL, sTitle);
				} catch(e) {
					try {
						window.sidebar.addPanel(sTitle, sURL, "");
					} catch(e) {
						$i.html("加入收藏失败，<br>请使用Ctrl+D进行添加");
					}
				}
			})
			setTimeout(function() {
				$("#saveToCopy").zclip({
					copy: window.location.href,
					afterCopy: function() {
						$i.html("复制成功")
					}
				});
			}, 400)
		},
		report: function(hid, url) {
			alertM(reportArr[0] + hid + reportArr[1], {
				title: "举报该房源信息",
				time: "y",
				btnN: 1,
				width: 400,
				yf: function() {
					var $c = $("#alertM :radio"),
						$t = $("#wronginfo"),
						$i = $("#minfo");
					$("#alertM").on("focus", "input", function() {
						$i.html("")
					})
					if(!$c.is(":checked") && $t.val() == "") $i.html("请至少填写一项投诉举报内容！");
					else {
						$.ajax({
							url: url,
							type: "POST",
							dataType: 'jsonp',
							data: $("#alertM form").serialize()
						}).done(function(data) {
							if(data.suc) alertM(data.alert,{cName:"yes",btnY:0})
							else $i.html(data.alert);
						}).fail(function() {
							$i.html("发送消息失败，请检查网络连接是否已断开");
						});
					}
				}
			})
		}
	}
})