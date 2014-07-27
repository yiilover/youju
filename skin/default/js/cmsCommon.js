Array.prototype.indexOf || (Array.prototype.indexOf = function(i, k) {
    k || (k = 0);
    var t = this.length;
    if (k < 0) k = t + k;
    for (; k < t; k++) if (this[k] === i) return k;
    return - 1
}); (function(i, k, t) {
    function l(a, c) {
        var b;
        if (w) {
            b = w[0];
            var d = w.data("timer");
            w.stop();
            d && (clearTimeout(d), clearInterval(d))
        } else {
            b = m.createElement("div");
            w = i(b).appendTo(m.body)
        }
        b.className = a;
        b.style.cssText = "position:fixed;visibility:hidden;z-index:10000;";
        w.html(c);
        return w
    }
    var m = k.document,
    p = i(m),
    A = m.documentElement,
    B = navigator.userAgent.toLowerCase(),
    y = /opera/.test(B) ? 0 : parseInt((/.+msie[\/: ]([\d.]+)/.exec(B) || {
        1 : 0
    })[1]),
    D = y > 7 ? m.documentMode: 0;
    B = y == 7 || D == 7;
    y = D == 8 && y > 7;
    var C = 1,
    q = null,
    w = null,
    I = /^http[s]?\:\/\//i,
    z = function() {
        this.bubble = i('<div class="bubble"><div class="corner tl"></div><div class="corner tr"></div><div class="corner bl"></div><div class="corner br"></div><div class="top"></div><div class="cnt"></div><div class="bot"></div><div class="point"></div></div>').appendTo(m.body);
        this.pointer = this.bubble.find(".point");
        this.cnt = this.bubble.find(".cnt")
    };
    z.prototype = {
        pointTo: function(a) {
            var c, b;
            if (a.nodeType == 1 ? a = i(a) : a.jquery) {
                var d = a.offset();
                c = d.left + parseInt(a[0].offsetWidth / 2);
                b = d.top + parseInt(a[0].offsetHeight / 2)
            } else if (a.originalEvent) {
                c = a.pageX;
                b = a.pageY
            } else return;
            d = A.clientWidth;
            var e = A.clientHeight,
            h = p.scrollLeft(),
            f = p.scrollTop();
            a = this.bubble;
            var g = a[0],
            j,
            r;
            g.style.cssText = "";
            j = g.offsetWidth;
            r = g.offsetHeight;
            if (!j || !r) {
                g.style.display = "block";
                j = g.offsetWidth;
                r = g.offsetHeight
            }
            g.style.width = j + "px";
            if (e / 2 > b - f) {
                e = b + parseInt(this.pointer.height()) + 13;
                b = "S"
            } else {
                e = b - r - parseInt(this.pointer.height()) - 2;
                b = "N"
            }
            if (d / 2 > c - h) {
                c = c - 13;
                b += "W"
            } else {
                c = c - j + 10;
                b += "E"
            }
            this.pointer[0].className = "point " + b;
            a.css({
                left: c,
                top: e
            });
            return this
        },
        setYellow: function(a) {
            this.bubble[a ? "addClass": "removeClass"]("yellow");
            return this
        },
        html: function(a) {
            this.cnt.html(a);
            return this
        },
        get: function() {
            return this.bubble
        }
    };
    var o = {
        IE7: B,
        IE8: y,
        pos: function(a, c, b) {
            a || (a = "right");
            var d = p.scrollLeft(),
            e = p.scrollTop(),
            h = A.clientHeight,
            f = A.clientWidth,
            g = {},
            j;
            if (a == "top") {
                g.top = 2;
                g.left = (f - c) / 2
            } else if (a == "right") {
                g.top = 2;
                g.right = 2
            } else if (a == "center") {
                g.top = (h - b) * 0.382;
                g.left = (f - c) / 2
            } else if (a.nodeType == 1 ? a = i(a) : a.jquery) {
                j = a.offset();
                j.left -= d;
                j.top -= e;
                g.left = j.left + c > f ? j.left - c + a.outerWidth() : j.left;
                c = a.outerHeight();
                g.top = j.top + b + c > h ? j.top - b: j.top + a.outerHeight()
            } else if (a.originalEvent) {
                j = {
                    left: a.pageX - d,
                    top: a.pageY - e
                };
                g.left = j.left + c > f ? j.left - c: j.left;
                g.top = j.top + b > h ? j.top - b: j.top
            }
            return g
        },
        func: function(a, c) {
            if (typeof a == "function") return a;
            if (typeof a == "string") {
                a = a.split(".");
                var b = (c || k)[a[0]],
                d = null;
                if (!b) return null;
                for (var e = 1,
                h; h = a[e++];) {
                    if (!b[h]) return null;
                    d = b;
                    b = b[h]
                }
                return b &&
                function() {
                    return b.apply(d, arguments)
                }
            }
            return null
        },
        listenAjax: function() {
            i().ajaxStart(function() {
                C && o.startLoading();
                C = 1
            }).ajaxStop(function() {
                o.endLoading()
            }).ajaxError(function() {
                o.endLoading()
            })
        },
        stopListenOnce: function() {
            C = 0
        },
        startLoading: function(a, c, b) {
            if (q) return q;
            c || (c = "\u8f7d\u5165\u4e2d\u2026\u2026");
            q = i('<div class="loading" style="position:fixed;visibility:hidden"><sub></sub> ' + c + "</div>").appendTo(m.body);
            if (!isNaN(b = parseFloat(b)) && b) q.css("width", b);
            a = o.pos(a, q.outerWidth(true), q.outerHeight(true));
            a.visibility = "visible";
            q.css(a);
            return q
        },
        endLoading: function() {
            q && q.remove();
            q = null
        },
        tips: function(a, c, b, d) { (!c || c == "ok") && (c = "success");
            var e = l("ct_tips " + c, "<sub></sub> " + a),
            h;
            i('<a style="margin-left:10px;color:#000080;text-decoration:underline;" href="close">\u77e5\u9053\u4e86</a>').click(function(f) {
                f.stopPropagation();
                f.preventDefault();
                e.fadeOut("fast");
                h && clearTimeout(h);
                h = null
            }).appendTo(e);
            b || (b = "center");
            a = o.pos(b, e.outerWidth(true), e.outerHeight(true));
            a.visibility = "visible";
            e.css(a);
            d === t && (d = 3);
            d && (h = setTimeout(function() {
                e.fadeOut("fast")
            },
            d * 1E3), e.data("timer", h));
            return e
        },
        timer: function(a, c, b, d, e) {
            b || (b = "success");
            a = a.replace("%s", '<b class="timer">' + c + "</b>");
            var h = l("ct_tips " + b, "<sub></sub> " + a),
            f = h.find("b.timer");
            a = h.find(".clause");
            e || (e = "center");
            e = o.pos(e, h.outerWidth(true), h.outerHeight(true));
            e.visibility = "visible";
            h.css(e);
            var g = setInterval(function() {
                f.text(--c);
                c < 1 && j()
            },
            1E3);
            h.data("timer", g);
            var j = function() {
                g && clearInterval(g);
                g = null;
                h.hide();
                d();
                return false
            };
            a.click(j);
            return h
        },
        alert: function(a, c) {
            return this.tips(a, c, "center", 0)
        },
        ok: function(a, c, b) {
            return this.tips(a, "success", c, b)
        },
        error: function(a, c, b) {
            return this.tips(a, "error", c, b)
        },
        warn: function(a, c, b) {
            return this.tips(a, "warning", c, b)
        },
        confirm: function(a, c, b, d) {
            var e = l("ct_tips confirm", "<sub></sub> " + a + "<br/>");
            i('<button type="button" class="button_style_1">\u786e\u5b9a</button>').click(function() {
                c && c(e);
                e.hide()
            }).appendTo(e);
            cancelBtn = i('<button type="button" class="button_style_1">\u53d6\u6d88</button>').click(function() {
                b && b();
                e.hide()
            }).appendTo(e);
            d || (d = "center");
            a = o.pos(d, e.outerWidth(true), e.outerHeight(true));
            a.visibility = "visible";
            e.css(a);
            return e
        },
        iframe: function(a, c, b) {
            function d() {
                g.show();
                p.mouseup(e)
            }
            function e() {
                p.unbind("mouseup", e);
                g.hide()
            }
            typeof a == "object" || (a = {
                url: a ? a.toString() : ""
            });
            a = i.extend({
                width: 450,
                height: "auto",
                maxHeight: 500,
                resizable: false,
                modal: true
            },
            a, {
                close: function() {
                    j ? f.trigger("close") : h.dialog("destroy").remove()
                }
            });
            var h = i(m.createElement("div")),
            f = i('<iframe frameborder="0" scrolling="auto" src="' + (a.url || a.title) + '" width="100%" height="100%" ></iframe>').appendTo(h),
            g = i('<div class="masker"></div>').insertBefore(f),
            j = 0;
            h.dialog(a);
            var r = h.prev().mousedown(d).children("span:first"),
            u;
            h.nextAll(".ui-resizable-handle").mousedown(d);
            h.css("overflow", "hidden");
            f.bind("load",
            function() {
                u && clearTimeout(u);
                try {
                    var s = this.contentDocument || this.contentWindow.document,
                    v = s.documentElement,
                    x = this.contentWindow || this;
                    if (!j) {
                        f.bind("close",
                        function() {
                            f.unbind().bind("load",
                            function() {
                                h.dialog("destroy").remove()
                            });
                            x.location = "about:blank"
                        });
                        u && clearTimeout(u);
                        j = 1
                    }
                    if (a.width == "auto" || a.height == "auto") {
                        a.width == "auto" && f.width(v.scrollWidth);
                        a.height == "auto" && f.height(v.scrollHeight);
                        u = setInterval(function() {
                            a.width == "auto" && f.width(v.scrollWidth);
                            a.height == "auto" && f.height(v.scrollHeight)
                        },
                        600)
                    }
                    h.dialog("option", "position", "center");
                    x.getDialog = function() {
                        return h
                    };
                    c && (x.dialogCallback = c);
                    if (s.title && s.title.length) r.text(s.title);
                    else throw "no title";
                } catch(E) {
                    r.text(this.src)
                }
                typeof b == "function" && b(f)
            });
            return h
        },
        ajaxDialog: function(a, c, b, d, e) {
            var h = {};
            if (typeof d == "function") h["\u786e\u5b9a"] = function() {
                d(f) && f.dialog("close")
            };
            if (typeof e == "function") h["\u53d6\u6d88"] = function() {
                e(f) && f.dialog("close")
            };
            typeof a == "object" || (a = {
                title: a ? a.toString() : ""
            });
            a = i.extend({
                width: 450,
                height: "auto",
                maxHeight: 500,
                resizable: false,
                modal: true
            },
            a, {
                autoOpen: false,
                buttons: h,
                close: function() {
                    f.dialog("destroy").remove()
                }
            });
            var f = i(m.createElement("div"));
            f.dialog(a).load(c,
            function() {
                f.dialog("open");
                typeof b == "function" && b(f)
            }).bind("ajaxload",
            function() {
                typeof b == "function" && b(f)
            }).css("position", "relative");
            return f
        },
        formDialog: function(a, c, b, d, e, h) {
            var f = null;
            return ct.ajaxDialog(a, c,
            function(g) {
                f = i("form:first", g);
                var j = g.parent(),
                r,
                u = g.nextAll("div.btn_area"),
                s,
                v = null;
                if (f.length) {
                    r = i('<div class="masker"></div>').insertBefore(g);
                    typeof d == "function" && d(f, g);
                    var x = function(n, F) {
                        if (n) {
                            s || (s = i(m.createElement("div")).prependTo(g));
                            s[0].className = F;
                            clearTimeout(v);
                            v = null;
                            s.show().html(n);
                            v = setTimeout(function() {
                                s.slideUp()
                            },
                            3E3)
                        }
                    },
                    E = function(n) {
                        if (n && "state" in n) x(n.msg || (n.state ? n.info: n.error), n.state ? "success": "error");
                        if (typeof b == "function") b(n) && g.dialog("destroy").remove();
                        else n && "state" in n && n.state && g.dialog("destroy").remove();
                        return false
                    },
                    G = function() {
                        r.hide();
                        u.children("button").attr("disabled", false).removeAttr("disabled")
                    },
                    K = function(n, F, J) {
                        u.children("button").attr("disabled", "disabled");
                        r.css({
                            height: j.height(),
                            width: j.width()
                        }).show();
                        if (typeof e == "function" && e(f, g, J) === false) {
                            G();
                            return false
                        }
                        return true
                    },
                    H = function() {
                        f.ajaxSubmit({
                            dataType: "json",
                            type: "post",
                            success: E,
                            error: function() {
                                x("\u8bf7\u6c42\u5f02\u5e38", "error")
                            },
                            complete: G,
                            beforeSubmit: K,
                            beforeSerialize: h
                        })
                    };
                    if (f[0].getAttribute("name")) f.validate({
                        submitHandler: H
                    });
                    else {
                        f.find("input,textarea,select").not(":button,:submit,:image,:reset,:hidden,[disabled],[readonly]").eq(0).focus();
                        f.submit(function() {
                            H();
                            return false
                        })
                    }
                }
            },
            function() {
                f && f.submit();
                return false
            },
            function() {
                return true
            })
        },
        template: function(a) {
            a.jquery || (a = i(a));
            var c = a.val(),
            b = ct.iframe({
                title: "?app=system&controller=template&action=selector&path=" + c,
                width: 600,
                height: "auto"
            },
            {
                ok: function(d) {
                    a.val(d);
                    b.dialog("close")
                }
            })
        },
        getCookie: function(a) {
            var c = null;
            if (m.cookie && m.cookie != "") for (var b = m.cookie.split(";"), d = 0; d < b.length; d++) {
                var e = jQuery.trim(b[d]);
                if (e.substring(0, a.length + 1) == a + "=") {
                    c = decodeURIComponent(e.substring(a.length + 1));
                    break
                }
            }
            return c
        },
        setCookie: function(a, c, b) {
            b = b || {};
            if (c === null) {
                c = "";
                b = i.extend({},
                b);
                b.expires = -1
            }
            if (!b.expires) b.expires = 1;
            var d = "";
            if (b.expires && (typeof b.expires == "number" || b.expires.toUTCString)) {
                if (typeof b.expires == "number") {
                    d = new Date;
                    d.setTime(d.getTime() + b.expires * 24 * 60 * 60 * 1E3)
                } else d = b.expires;
                d = "; expires=" + d.toUTCString()
            }
            var e = b.path ? "; path=" + b.path: "",
            h = b.domain ? "; domain=" + b.domain: "";
            b = b.secure ? "; secure": "";
            m.cookie = [a, "=", encodeURIComponent(c), d, e, h, b].join("")
        }
    };
    k.ct = k.cmstop = o;
    o.assoc = {
        refresh: function() {
            top != self && top.superAssoc.refresh()
        },
        open: function(a, c, b) {
            if (top != self) k.__ASSOC_TABID__ = top.superAssoc.open(a, c, b)
        },
        get: function(a) {
            return top != self ? top.superAssoc.get(a) : null
        },
        close: function(a) {
            top != self && top.superAssoc.close(a)
        },
        opener: function() {
            return top != self ? k.__ASSOC_TABID__ && top.superAssoc.get(k.__ASSOC_TABID__) : null
        },
        call: function(a) {
            if (top != self) {
                var c = Array.prototype.slice.call(arguments, 1);
                return top.superAssoc[a].apply(null, c)
            }
        }
    };
    i.fn.extend({
        ajaxSubmit: function(a) {
            if (!this.length) return this;
            if (typeof a == "function") a = {
                success: a
            };
            var c = i.trim(this.attr("action"));
            if (c) c = (/^([^#]+)/.exec(c) || {})[1];
            c = c || k.location.href || "";
            a = i.extend({
                url: c,
                type: this.attr("method") || "GET"
            },
            a || {});
            if (a.beforeSerialize && a.beforeSerialize(this, a) === false) return this;
            c = this.serializeArray();
            if (a.data) {
                a.extraData = a.data;
                for (var b in a.data) if (a.data[b] instanceof Array) for (var d in a.data[b]) c.push({
                    name: b,
                    value: a.data[b][d]
                });
                else c.push({
                    name: b,
                    value: a.data[b]
                })
            }
            if (a.beforeSubmit && a.beforeSubmit(c, this, a) === false) return this;
            a.data = c;
            i.ajax(a);
            this.trigger("form-submit-notify", [this, a]);
            return this
        },
        ajaxForm: function(a, c, b) {
            var d = this,
            e = this.attr("action"),
            h = this.attr("method") || "POST";
            a = o.func(a) ||
            function(g) {
                g.state ? o.ok("\u4fdd\u5b58\u6210\u529f") : o.error(g.error)
            };
            b = o.func(b) ||
            function() {};
            var f = function() {
                if (!d.data("lock")) if (b(d) !== false) {
                    var g = d.find("*").filter(":button,:submit,:reset").attr("disabled", "disabled");
                    d.data("lock", true);
                    i.ajax({
                        dataType: "json",
                        url: e,
                        type: h,
                        data: d.serialize(),
                        success: a,
                        complete: function() {
                            d.data("lock", false);
                            g.attr("disabled", "").removeAttr("disabled")
                        },
                        error: function() {
                            o.error("\u8bf7\u6c42\u5f02\u5e38")
                        }
                    })
                }
            };
            i().bind("keydown.ajaxForm",
            function(g) {
                if (g.ctrlKey && (g.keyCode == 13 || g.keyCode == 83)) {
                    g.stopPropagation();
                    g.preventDefault();
                    d.submit()
                }
            });
            this.attr("name") ? this.validate({
                submitHandler: f,
                infoHandler: c
            }) : this.submit(function(g) {
                g.stopPropagation();
                g.preventDefault();
                f()
            });
            return this
        },
        floatImg: function(a) {
            var c = i.extend({
                url: "",
                width: null,
                height: null
            },
            a || {}),
            b = i(m.createElement("div"));
            i.extend(b[0].style, {
                position: "absolute",
                overflow: "hidden",
                display: "none",
                padding: "4px",
                background: "#ccc",
                border: "1px solid #fff",
                width: c.width,
                height: c.height,
                zIndex: 8888
            });
            i(m.body).append(b);
            this.bind("mouseover",
            function(d) {
                var e = this.value || this.getAttribute("thumb");
                if (e) {
                    var h = d.pageX + 10;
                    d = d.pageY + 10;
                    e = I.test(e) ? e: c.url + e;
                    e = e.replace(/\?[0-9\.]*$/, "") + "?" + Math.random(9);
                    e = ['<img src="' + e + '"'];
                    c.width && e.push(' width="' + c.width + '"');
                    c.height && e.push(' height="' + c.height + '"');
                    e.push(" />");
                    b.html(e.join("")).css({
                        top: d,
                        left: h,
                        display: "block"
                    })
                }
            }).bind("mousemove",
            function(d) {
                b.css({
                    top: d.pageY + 10,
                    left: d.pageX + 10
                })
            }).bind("mouseout",
            function() {
                b.hide()
            });
            return this
        },
        attrTips: function(a, c) {
            var b, d, e = function() {
                var f = d.data("delay");
                f && clearTimeout(f);
                d.data("delay", null);
                d.stop(1).css({
                    opacity: "",
                    display: "none"
                })
            };
            if (z.inst) b = z.inst;
            else {
                b = new z;
                z.inst = b
            }
            d = b.get();
            var h = null;
            this.bind("mouseover",
            function(f) {
                h = f;
                var g = this,
                j = this.getAttribute(a); (f = d.data("delay")) && clearTimeout(f);
                if (j) {
                    f = setTimeout(function() {
                        d.data("point", g);
                        b.setYellow(c != "tips_green");
                        b.html(j);
                        b.pointTo(h);
                        d.fadeIn("normal")
                    },
                    200);
                    d.data("delay", f)
                }
            }).bind("mouseout", e).bind("mousemove",
            function(f) {
                h = f;
                d.data("point") == this && b.pointTo(f)
            });
            p.bind("mousedown.bubble", e);
            return this
        },
        maxLength: function() {
            this.each(function() {
                var a = this.maxLength,
                c = i('<strong class="c_green" style="margin-left:5px">0</strong>').insertAfter(this);
                i.event.add(this, "keyup",
                function() {
                    i.textLength(this, c, a)
                })
            }).keyup();
            return this
        }
    });
    i.textLength = function(a, c, b) {
        if (b) {
            var d = a.value.length;
            c.html(d);
            d > b && c.addClass("c_red")
        } else c.html(a.value.length);
        if (a.tagName == "TEXTAREA" && a.scrollHeight > 70) a.style.height = a.scrollHeight + "px"
    };
    i.ajaxSetup({
        beforeSend: function(a) {
            a.setRequestHeader("If-Modified-Since", "0");
            a.setRequestHeader("Cache-Control", "no-cache")
        }
    })
})(jQuery, window); (function(i) {
    function k(l) {
        var m = [].slice.call(arguments, 1),
        p = 0;
        l = i.event.fix(l || window.event);
        l.type = "mousewheel";
        if (l.wheelDelta) p = l.wheelDelta / 120;
        if (l.detail) p = -l.detail / 3;
        m.unshift(l, p);
        return i.event.handle.apply(this, m)
    }
    var t = ["DOMMouseScroll", "mousewheel"];
    i.fn.mousewheel = function(l) {
        return l ? this.bind("mousewheel", l) : this.trigger("mousewheel")
    };
    i.event.special.mousewheel = {
        setup: function() {
            if (this.addEventListener) for (var l = t.length; l;) this.addEventListener(t[--l], k, false);
            else this.onmousewheel = k
        },
        teardown: function() {
            if (this.removeEventListener) for (var l = t.length; l;) this.removeEventListener(t[--l], k, false);
            else this.onmousewheel = null
        }
    }
})(jQuery);
var url = {
    member: function(i) {
        ct.assoc.open("?app=member&controller=index&action=profile&userid=" + i, "newtab")
    },
    ip: function(i) {
        ct.assoc.open("?app=system&controller=ip&action=show&ip=" + i, "newtab")
    }
};