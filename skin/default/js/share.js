define(function(require, exports, module) {
	var $=require('jquery');
	var shareTo=function(m){
		switch(m){
		case "renren":
			void ((function(s, d, e) {
			if (/renren\.com/.test(d.location))
			return;
			var f = 'http://share.renren.com/share/buttonshare.do?link=', u =
			d.location, l = d.title, p = [
			e(u), '&title=', e(l) ].join('');
			function a() {
			if (!window.open([ f, p ].join(''),'xnshare',['toolbar=0,status=0,resizable=1,width=626,height=436,left=',(s.width - 626) / 2, ',top=',(s.height - 436) / 2 ].join('')))u.href = [ f, p ].join('');};
			if (/Firefox/.test(navigator.userAgent))
			setTimeout(a, 0);
			else
			a();
			})(screen, document, encodeURIComponent));
		break;
		case "qzone":
			window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+ encodeURIComponent(document.location), 'qzone','toolbar=0,status=0,width=900,height=760,left='+ (screen.width - 900) / 2 + ',top='+ (screen.height - 760) / 2);
		break;
		case "kaixin001":
			var kw = window.open('','kaixin001','toolbar=no,titlebar=no,status=no,menubar=no,scrollbars=no,location:no,directories:no,width=570,height=350,left='+ (screen.width - 570)/ 2+ ',top='+ (screen.height - 420) / 2);
			var tempForm = kw.document.createElement('form');
			function openPostWindow(url, data, name) {
				var tempForm = document.createElement('form');
				tempForm.id = 'tempForm1';
				tempForm.method = 'post';
				tempForm.action = url;
				tempForm.target = 'kaixin001';
				var hideInput = document.createElement('input');
				hideInput.type = 'hidden';
				hideInput.name = 'rcontent';
				hideInput.value = data;
				tempForm.appendChild(hideInput);
				document.body.appendChild(tempForm);
				tempForm.submit();
				document.body.removeChild(tempForm);
			}
			function add2Kaixin001() {
				var u = document.location.href;
				var t = document.title;
				var c=''+(document.getSelection?document.getSelection(): document.selection.createRange().text);
				var iframec='';
				var url = 'http://www.kaixin001.com/repaste/bshare.php?rtitle='+encodeURIComponent(t)+'&rurl='+encodeURIComponent(u)+'&from=maxthon';
				var data = encodeURIComponent(c);
				openPostWindow(url, c, '_blank')
			}
			add2Kaixin001();
		break;
		case "tsina":
			void ((function(s, d, e) {
				try {} catch (e) {}
				var f = 'http://v.t.sina.com.cn/share/share.php?', u = d.location.href, p = ['url=', e(u), '&title=', e(d.title), '&appkey=330242870' ].join('');
				function a() {
					if (!window.open([ f, p ].join(''),'mb',['toolbar=0,status=0,resizable=1,width=620,height=450,left=',(s.width - 620) / 2, ',top=',(s.height - 450) / 2 ].join('')))
						u.href = [ f, p ].join('');
				}
				if (/Firefox/.test(navigator.userAgent)) {setTimeout(a, 0)} else {a()}
			})(screen, document, encodeURIComponent));
		break;
		case "feixin":
			window.open('http://space.feixin.10086.cn/api/share?source=悦读通&url='+encodeURIComponent(document.location.href)+'&title='+encodeURIComponent(document.title),'feixin','toolbar=0,status=0,width=1000,height=560,left='+ (screen.width - 1000) / 2 + ',top='+ (screen.height - 600) / 2);
		break;
		case "t139":
			window.open('http://www.139.com/share/share.php?title='+ encodeURIComponent(document.title) + '&url='+ encodeURIComponent(location.href), 't139','width=490,height=340,left=' + (screen.width - 490) / 2+ ',top=' + (screen.height - 340) / 2);
		break;
		case "itieba":
			var sendT = {
				getContent : function() {
					var allPageTagss = document.getElementsByTagName("div");
					for ( var i = 0; i < allPageTagss.length; i++) {
						if (allPageTagss[i].className == 'articleContent') {
							return allPageTagss[i].getElementsByTagName("P")[0].innerHTML?allPageTagss[i].getElementsByTagName("P")[0].innerHTML:'';
						}
					}
				}
			}
			var itieba_share = 'http://tieba.baidu.com/i/sys/share?link='+ encodeURIComponent(window.location.href) + '&type='+ encodeURIComponent('text') + '&title='+ encodeURIComponent(document.title.substring(0, 76))+ '&content=' + encodeURIComponent(sendT.getContent());
			if (!window.open(itieba_share, 'itieba','toolbar=0,resizable=1,scrollbars=yes,status=1,width=626,height=436')) {
				location.href = itieba_share;
			}
		break;
		case "t163":
			(function() {
				var url = 'link=http://www.shareto.com.cn/&source='+ encodeURIComponent('悦读通') + '&info='+ encodeURIComponent(document.title) + ' '+ encodeURIComponent(document.location.href);
				window.open('http://t.163.com/article/user/checkLogin.do?'+ url + '&' + new Date().getTime(),'t163','height=330,width=550,top='+ (screen.height - 280)/ 2+ ',left='+ (screen.width - 550)/ 2+ ', toolbar=no, menubar=no, scrollbars=no,resizable=yes,location=no, status=no');
			})()
		break;
		case "douban":
			 void (function() {
				var d = document, e = encodeURIComponent, s1 = window.getSelection, s2 = d.getSelection, s3 = d.selection, s = s1 ? s1(): s2 ? s2() : s3 ? s3.createRange().text : '', r = 'http://www.douban.com/recommend/?url='+ e(d.location.href)+ '&title='+ e(d.title)+ '&sel='+ e(s) + '&v=1', x = function() {
					if (!window.open(r, 'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=355,left='+ (screen.width - 450) / 2 + ',top='+ (screen.height - 330) / 2))
						location.href = r + '&r=1'
				};
				if (/Firefox/.test(navigator.userAgent)) {setTimeout(x, 0)} else {x()}
			})();
		break;
		case "tqq":
			window.open('http://v.t.qq.com/share/share.php?title='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(document.location.href), 'tqq','toolbar=0,status=0,width=700,height=360,left='+ (screen.width - 700) / 2 + ',top='+ (screen.height - 600) / 2);
		}
		return false;
	}
	$.fn.share=function(opt){
		opt = $.extend({
			showIndex:[0,1,2,3,4,5,6,7,8,9],
			margin:'4px 0 0',
			liMargin:9,
			text:'分享到：',
			url:'1',
			imgUrl:"{AJ_SKIN}images/mod/share.gif",
			share:[{title:'人人网',click:'renren'},{title:'Qzone',click:'qzone'},{title:'开心网',click:'kaixin001'},{title:'新浪微薄',click:'tsina'},{title:'飞信',click:'feixin'},{title:'139说客',click:'t139'},{title:'i贴吧',click:'itieba'},{title:'网易微博',click:'t163'},{title:'豆瓣',click:'douban'},{title:'qq微博',click:'tqq'}]
		}, opt||{});
		var $t = $(this);
		var str=['<li style="line-height:16px;float:left">'+opt.text+'</li>'];
		$t.css({listStyle:'none',margin:opt.margin,padding:'0',height:'16',width:(16+opt.liMargin)*(opt.showIndex.length)+50+'px',overflow:'hidden'});
		for(var li=0;li<opt.showIndex.length;li++){
			str.push('<li style="float:left"><a href="javascript:void(0)" style="width: 16px;overflow:hidden; height: 16px; display: block; margin:0 0 0 '+opt.liMargin+'px; padding: 0; background: transparent url(\''+opt.imgUrl+'\') no-repeat 0 -'+16*opt.showIndex[li]+'px" title="分享到'+opt.share[opt.showIndex[li]].title+'"></a></li>');
		}
		$t.html(str.join(""));
		$t.find("a").each(function(i){
			$(this).hover(function(){
				this.style.backgroundPosition='-18px -'+16*i+'px';
			},function(){
				this.style.backgroundPosition='0 -'+16*i+'px';
			}).click(function(){
				shareTo(opt.share[opt.showIndex[i]].click)
			})
		});
		return $t;
	}	
});