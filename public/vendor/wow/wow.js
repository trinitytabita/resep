/*! WOW - v1.1.3 - 2016-05-06
 * Copyright (c) 2016 Matthieu Aussaguel;
 */
(function() {
    var a, b, c, d, e,
        f = function(a, b) {
            return function() {
                return a.apply(b, arguments);
            };
        },
        g = [].indexOf || function(a) {
            for (var b = 0, c = this.length; c > b; b++)
                if (b in this && this[b] === a) return b;
            return -1;
        };

    b = function() {
        function a() {}
        a.prototype.extend = function(a, b) {
            var c, d;
            for (c in b) d = b[c], null == a[c] && (a[c] = d);
            return a;
        };
        a.prototype.isMobile = function(a) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a);
        };
        a.prototype.createEvent = function(a, b, c, d) {
            var e;
            return null == b && (b = !1), null == c && (c = !1), null == d && (d = null), null != document.createEvent ? (e = document.createEvent("CustomEvent"), e.initCustomEvent(a, b, c, d)) : null != document.createEventObject ? (e = document.createEventObject(), e.eventType = a) : e.eventName = a, e;
        };
        a.prototype.emitEvent = function(a, b) {
            return null != a.dispatchEvent ? a.dispatchEvent(b) : b in (null != a) ? a[b]() : "on" + b in (null != a) ? a["on" + b]() : void 0;
        };
        a.prototype.addEvent = function(a, b, c) {
            return null != a.addEventListener ? a.addEventListener(b, c, !1) : null != a.attachEvent ? a.attachEvent("on" + b, c) : a[b] = c;
        };
        a.prototype.removeEvent = function(a, b, c) {
            return null != a.removeEventListener ? a.removeEventListener(b, c, !1) : null != a.detachEvent ? a.detachEvent("on" + b, c) : delete a[b];
        };
        a.prototype.innerHeight = function() {
            return "innerHeight" in window ? window.innerHeight : document.documentElement.clientHeight;
        };
        return a;
    }();

    c = this.WeakMap || this.MozWeakMap || (c = function() {
        function a() {
            this.keys = [], this.values = [];
        }
        a.prototype.get = function(a) {
            var b, c, d, e, f;
            for (f = this.keys, b = d = 0, e = f.length; e > d; b = ++d)
                if (c = f[b], c === a) return this.values[b];
        };
        a.prototype.set = function(a, b) {
            var c, d, e, f, g;
            for (g = this.keys, c = e = 0, f = g.length; f > e; c = ++e)
                if (d = g[c], d === a) return void(this.values[c] = b);
            return this.keys.push(a), this.values.push(b);
        };
        return a;
    }());

    a = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver || (a = function() {
        function a() {
            "undefined" != typeof console && null !== console && console.warn("MutationObserver is not supported by your browser."), "undefined" != typeof console && null !== console && console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content.");
        }
        a.notSupported = !0;
        a.prototype.observe = function() {};
        return a;
    }());

    d = this.getComputedStyle || function(a, b) {
        return this.getPropertyValue = function(b) {
            var c;
            return "float" === b && (b = "styleFloat"), e.test(b) && b.replace(e, function(a, b) {
                return b.toUpperCase();
            }), (null != (c = a.currentStyle) ? c[b] : void 0) || null;
        }, this;
    };

    e = /(\-([a-z]){1})/g;

    this.WOW = function() {
        function e(a) {
            null == a && (a = {}), this.scrollCallback = f(this.scrollCallback, this), this.scrollHandler = f(this.scrollHandler, this), this.resetAnimation = f(this.resetAnimation, this), this.start = f(this.start, this), this.scrolled = !0, this.config = this.util().extend(a, this.defaults), null != a.scrollContainer && (this.config.scrollContainer = document.querySelector(a.scrollContainer)), this.animationNameCache = new c, this.wowEvent = this.util().createEvent(this.config.boxClass);
        }
        e.prototype.defaults = {
            boxClass: "wow",
            animateClass: "animated",
            offset: 0,
            mobile: !0,
            live: !0,
            callback: null,
            scrollContainer: null
        };
        e.prototype.init = function() {
            var a;
            return this.element = window.document.documentElement, "interactive" === (a = document.readyState) || "complete" === a ? this.start() : this.util().addEvent(document, "DOMContentLoaded", this.start), this.finished = [];
        };
        e.prototype.start = function() {
            var b, c, d, e;
            if (this.stopped = !1, this.boxes = function() {
                    var a, c, d, e;
                    for (d = this.element.querySelectorAll("." + this.config.boxClass), e = [], a = 0, c = d.length; c > a; a++) b = d[a], e.push(b);
                    return e;
                }.call(this), this.all = function() {
                    var a, c, d, e;
                    for (d = this.boxes, e = [], a = 0, c = d.length; c > a; a++) b = d[a], e.push(b);
                    return e;
                }.call(this), this.boxes.length)
                if (this.disabled()) this.resetStyle();
                else
                    for (e = this.boxes, c = 0, d = e.length; d > c; c++) b = e[c], this.applyStyle(b, !0);
            return this.disabled() || (this.util().addEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().addEvent(window, "resize", this.scrollHandler), this.interval = setInterval(this.scrollCallback, 50)), this.config.live ? new a(function(a) {
                return function(b) {
                    var c, d, e, f, g;
                    for (g = [], c = 0, d = b.length; d > c; c++) f = b[c], g.push(function() {
                        var a, b, c, d;
                        for (c = f.addedNodes || [], d = [], a = 0, b = c.length; b > a; a++) e = c[a], d.push(this.doSync(e));
                        return d;
                    }.call(a));
                    return g;
                };
            }(this)).observe(document.body, {
                childList: !0,
                subtree: !0
            }) : void 0;
        };
        e.prototype.stop = function() {
            return this.stopped = !0, this.util().removeEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().removeEvent(window, "resize", this.scrollHandler), null != this.interval ? clearInterval(this.interval) : void 0;
        };
        e.prototype.sync = function(b) {
            return a.notSupported ? this.doSync(this.element) : void 0;
        };
        e.prototype.doSync = function(a) {
            var b, c, d, e, f;
            if (null == a && (a = this.element), 1 === a.nodeType) {
                for (a = a.parentNode || a, e = a.querySelectorAll("." + this.config.boxClass), f = [], c = 0, d = e.length; d > c; c++) b = e[c], g.call(this.all, b) < 0 ? (this.boxes.push(b), this.all.push(b), this.stopped || this.disabled() ? this.resetStyle() : this.applyStyle(b, !0), f.push(this.scrolled = !0)) : f.push(void 0);
                return f;
            }
        };
        e.prototype.show = function(a) {
            return this.applyStyle(a), a.className = a.className + " " + this.config.animateClass, null != this.config.callback && this.config.callback(a), this.util().emitEvent(a, this.wowEvent), this.util().addEvent(a, "animationend", this.resetAnimation), this.util().addEvent(a, "oanimationend", this.resetAnimation), this.util().addEvent(a, "webkitAnimationEnd", this.resetAnimation), this.util().addEvent(a, "MSAnimationEnd", this.resetAnimation[_{{{CITATION{{{_1{](https://github.com/aksisoftsby/demowebaksisoft/tree/b905275adf26fc4375e5256a0c142eacbe874621/furni%2Flezada%2Fhtmldemo.hasthemes.com%2Flezada-preview%2Flezada%2Fassets%2Fjs%2Fplugins.js)[_{{{CITATION{{{_2{](https://github.com/saaspect/mppljobs.com/tree/2172c9297bf96a1f528c27c15226215e87439c3b/www.mppljobs.com%2Fpublic%2Fjs%2Fwow.min.js)[_{{{CITATION{{{_3{](https://github.com/rodrigoh01/codigo/tree/37f2e06d96c716a16e1b24002f21657eae2add4f/src%2Fpublic%2Fjs%2Fplugins.js)[_{{{CITATION{{{_4{](https://github.com/marknotbatman/dttw-old/tree/cfd1b414fee81617df35617b308814cab317162d/wp-content%2Fplugins%2Fzero-spam%2Fjs%2Fcharts.js)[_{{{CITATION{{{_5{](https://github.com/gel00/portfolio_site/tree/ceca0996143ed299105a9961060e0e1e85b47e6a/js%2Fdist%2Fwow.min.dev.js)[_{{{CITATION{{{_6{](https://github.com/danis24/wsa-laravel/tree/e456e7059c82beb66c2568e12b5dbcb4988ae834/public%2Fjs%2Fplugin%2Fwow.min.js)[_{{{CITATION{{{_7{](https://github.com/tuyandre/jlms/tree/3a67da8fdf6bda32797cd5940b57237b03e5a751/public%2Fcustomization%2Ffrontend%2Fjs%2Fwelcome.js)[_{{{CITATION{{{_8{](https://github.com/oshri12127/FinalProjectASE/tree/0fe6e5611fb62e94e41186d92da2cdf566af1d15/public%2Fjs%2Fplugins%2Fplugins.js)[_{{{CITATION{{{_9{](https://github.com/sergiogimenosanz/q2b-mimweb/tree/52e9fb2f2ec2e07f18f152c8df4910c99316edb4/js%2Fwow.min.js)[_{{{CITATION{{{_10{](https://github.com/sliu353/backup/tree/b1b5e41ff424b32b3938c2a11c7b4474110dfce4/_generated%2Fassets%2Fjs%2Findex_v.js)[_{{{CITATION{{{_11{](https://github.com/mab001/immobimax/tree/94d646cfac7e4b41af8971a846334d626c430739/public%2Fjs%2Fplugins.js)[_{{{CITATION{{{_12{](https://github.com/afayezbanantec/diamond-partner/tree/ff2009ab422cbe63f02a8336ffe1ff8a0c9d8121/resources%2Fthemes%2Fv1%2Fjs%2Fplugins.js)[_{{{CITATION{{{_13{](https://github.com/jhan-old/restaurant-template/tree/2da2011288bec5fda2e953f0e441a277b9e37877/public%2Fdist%2Fjs%2Fvendor.min.js)[_{{{CITATION{{{_14{](https://github.com/tapann285/Air-Flight-Prediction/tree/0c8108a1e5ed28b453f101776658dd759bc73c14/static%2Fjs%2Fcore.min.js)