/*    imgChange 1.0 - simple object change with jQuery1.2.6+
 *    作者：ahuing  2011-10-10
 *  http://www.ahuing.com/post/2053.html
 */
; (function($) {
    $.fn.extend({
        "imgChange": function(o) {
            o = $.extend({
                thumbObj: null,
                botPrev: null,
                botNext: null,
                effect: 'fade',
                curClass: 'act',
                thumbOverEvent: true,
                speed: 400,
                autoChange: true,
                clickFalse: false,
                overStop: true,
                changeTime: 4000,
                delayTime: 300,
                showTxt: false,
                vertical: true
            },
            o || {});
            var _self = $(this);
            var _p = _self.parent();
            var thumbObj;
            var size = _self.size();
            var nowIndex = 0;
            var index;
            var startRun;
            var delayRun;
            var _img = _self.find('img');
            function fadeAB() {
                if (nowIndex != index) {
                    if (o.thumbObj) {
                        $(o.thumbObj).removeClass(o.curClass).eq(index).addClass(o.curClass)
                    }
                    if (o.showTxt && size != 0) {
                        var _txt = _img.eq(index).attr('alt');
                        var _url = _img.eq(index).parent().attr('href');
                        _p.siblings(".txt").html(_txt).attr('href', _url)
                    }
                    if (o.speed <= 0) {
                        _self.eq(nowIndex).hide();
                        _self.eq(index).show()
                    } else if (o.effect == 'fade') {
                        _self.stop(true, true).eq(nowIndex).fadeOut(o.speed);
                        _self.eq(index).fadeIn(o.speed)
                    } else if (o.effect == 'move') {
                        o.vertical ? _p.stop(true, true).animate({
                            marginTop: -((index) * h)
                        },
                        o.speed) : _p.stop(true, true).animate({
                            marginLeft: -((index) * w)
                        },
                        o.speed)
                    } else if (o.effect == 'slide1') {
                        _self.stop(true, true).eq(nowIndex).hide(o.speed);
                        _self.eq(index).show(o.speed)
                    } else {
                        _self.stop(true, true).eq(nowIndex).slideUp(o.speed);
                        _self.eq(index).slideDown(o.speed)
                    }
                    nowIndex = index
                }
            }
            function runNext() {
                index = (nowIndex + 1) % size;
                fadeAB()
            }
            if (o.showTxt) {
                _p.parent().append('<div class=\'bg\'></div><a class=\'txt\' href=\'' + _img.eq(0).parent().attr('href') + '\'>' + _img.eq(0).attr('alt') + '</a>')
            }
            if (o.effect == 'move') {
                if (o.vertical) {
                    var h = _self.height()
                } else {
                    var w = _self.css({
                        'float': 'left',
                        'display': 'block'
                    }).width();
                    _p.css({
                        'float': 'left',
                        'width': size * w
                    })
                }
            } else {
                _self.hide().eq(0).show()
            };
            if (o.thumbObj) {
                thumbObj = $(o.thumbObj);
                thumbObj.removeClass(o.curClass).eq(0).addClass(o.curClass);
                thumbObj.click(function() {
                    index = thumbObj.index($(this));
                    fadeAB();
                    if (o.clickFalse) {
                        return false
                    }
                });
                if (o.thumbOverEvent) {
                    thumbObj.hover(function() {
                        index = thumbObj.index($(this));
                        delayRun = setTimeout(fadeAB, o.delayTime)
                    },
                    function() {
                        clearTimeout(delayRun)
                    })
                }
            }
            if (o.botNext) {
                $(o.botNext).click(function() {
                    if (_self.queue().length < 1) {
                        runNext()
                    }
                    return false
                })
            }
            if (o.botPrev) {
                $(o.botPrev).click(function() {
                    if (_self.queue().length < 1) {
                        index = (nowIndex + size - 1) % size;
                        fadeAB()
                    }
                    return false
                })
            }
            if (o.autoChange) {
                startRun = setInterval(runNext, o.changeTime);
                if (o.overStop) {
                    _p.parent().parent().hover(function() {
                        clearInterval(startRun)
                    },
                    function() {
                        startRun = setInterval(runNext, o.changeTime)
                    })
                }
            }
        }
    })
})(jQuery);
/**   参数设置
 *           $('#obj').jCarouselLite({
 *              thumbObj: null,
 *                 botPrev: null, //上一个按钮id
 *                 botNext: null, //下一个按钮id
 *                 effect: 'fade', //效果fade,move,slide,slide1
 *                 curClass: 'act',//激活样式名
 *                 thumbOverEvent: true,//悬停切换
 *                 speed: 400, //切换速度
 *                 autoChange: true,//是否自动切换
 *                 clickFalse: true,//点击链接无效
 *                 overStop: true,//mouseover停止切换
 *                 changeTime: 4000,//切换时间
 *                 delayTime: 300,//延迟
 *                 showTxt: false,//是否显示文字
 *                 vertical: true //滑动方向，仅effect为move时有效
 *           })   
 */
                 
                
(function($) {
    $.fn.jCarouselLite = function(o) {
        o = $.extend({
            btnPrev: null,
            btnNext: null,
            btnGo: null,
            mouseWheel: false,
            auto: null,
            speed: 1000,
            easing: null,
            vertical: false,
            circular: true,
            visible: 3,
            start: 0,
            scroll: 3,
            beforeStart: null,
            afterEnd: null
        },
        o || {});
        return this.each(function() {
            var b = false,
            animCss = o.vertical ? "top": "left",
            sizeCss = o.vertical ? "height": "width";
            var c = $(this),
            ul = $("ul", c),
            tLi = $("li", ul),
            tl = tLi.size(),
            v = o.visible;
            if (o.circular) {
                ul.prepend(tLi.slice(tl - v - 1 + 1).clone()).append(tLi.slice(0, v).clone());
                o.start += v
            }
            var f = $("li", ul),            
            itemLength = f.size(),
            curr = o.start;
            c.css("visibility", "visible");
            f.css({
                overflow: "hidden",
                float: o.vertical ? "none": "left"
            });
            ul.css({
                margin: "0",
                padding: "0",
                position: "relative",
                "list-style-type": "none",
                "z-index": "1"
            });
            c.css({
                overflow: "hidden",
                position: "relative",
                "z-index": "2",
                left: "0px"
            });
            var g = 0;
           //alert(itemLength);
           if(itemLength != 0) {g = o.vertical ? height(f) : width(f);}
           //alert(g);
          //  var g = o.vertical ? height(f) : width(f);
            var h = g * itemLength;
            var j = g * v;
            f.css({
                width: f.width(),
                height: f.height()
            });
            ul.css(sizeCss, h + "px").css(animCss, -(curr * g));
            c.css(sizeCss, j + "px");
            if (o.btnPrev) $(o.btnPrev).click(function() {
                return go(curr - o.scroll)
            });
            if (o.btnNext) $(o.btnNext).click(function() {
                return go(curr + o.scroll)
            });
            if (o.btnGo) $.each(o.btnGo,
            function(i, a) {
                $(a).click(function() {
                    return go(o.circular ? o.visible + i: i)
                })
            });
            if (o.mouseWheel && c.mousewheel) c.mousewheel(function(e, d) {
                return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll)
            });
            if (o.auto) setInterval(function() {
                go(curr + o.scroll)
            },
            o.auto);
            //o.auto + o.speed);
            function vis() {
                return f.slice(curr).slice(0, v)
            };
            function go(a) {
                if (!b) {
                    if (o.beforeStart) o.beforeStart.call(this, vis());
                    if (o.circular) {
                        if (a <= o.start - v - 1) {
                            ul.css(animCss, -((itemLength - (v * 2)) * g) + "px");
                            curr = a == o.start - v - 1 ? itemLength - (v * 2) - 1 : itemLength - (v * 2) - o.scroll
                        } else if (a >= itemLength - v + 1) {
                            ul.css(animCss, -((v) * g) + "px");
                            curr = a == itemLength - v + 1 ? v + 1 : v + o.scroll
                        } else curr = a
                    } else {
                        if (a < 0 || a > itemLength - v) return;
                        else curr = a
                    }
                    b = true;
                    ul.animate(animCss == "left" ? {
                        left: -(curr * g)
                    }: {
                        top: -(curr * g)
                    },
                    o.speed, o.easing,
                    function() {
                        if (o.afterEnd) o.afterEnd.call(this, vis());
                        b = false
                    });
                    if (!o.circular) {
                        $(o.btnPrev + "," + o.btnNext).removeClass("disabled");
                        $((curr - o.scroll < 0 && o.btnPrev) || (curr + o.scroll > itemLength - v && o.btnNext) || []).addClass("disabled")
                    }
                }
                return false
            }
        })
    };
    function css(a, b) {
        return parseInt($.css(a[0], b)) || 0
    };
    function width(a) {
       return a[0].offsetWidth + css(a, 'marginLeft') + css(a, 'marginRight')
    };
    function height(a) {
       return a[0].offsetHeight + css(a, 'marginTop') + css(a, 'marginBottom')
    }
})(jQuery);
                
/**         参数设置
  *          $('#obj').jCarouselLite({
  *             btnPrev: null,//上一个按钮id
  *             btnNext: null,//下一个按钮id
  *             btnGo: null,
  *             mouseWheel: false,
  *             auto: null,//切换时间
  *             speed: 1000,//切换速度
  *             easing: null,//效果
  *             vertical: false,//滑动方向
  *             circular: true,
  *             visible: 3,//显示的数量
  *             start: 0,
  *             scroll: 3,//每次滚动的数量
  *             beforeStart: null,
  *             afterEnd: null  
  *            })
  */             
                
                
                