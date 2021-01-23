! function (a, b, c, d) {
    "use strict";

    function k(a, b, c) {
        return setTimeout(q(a, c), b)
    }

    function l(a, b, c) {
        return Array.isArray(a) ? (m(a, c[b], c), !0) : !1
    }

    function m(a, b, c) {
        var e;
        if (a)
            if (a.forEach) a.forEach(b, c);
            else if (a.length !== d)
            for (e = 0; e < a.length;) b.call(c, a[e], e, a), e++;
        else
            for (e in a) a.hasOwnProperty(e) && b.call(c, a[e], e, a)
    }

    function n(a, b, c) {
        for (var e = Object.keys(b), f = 0; f < e.length;)(!c || c && a[e[f]] === d) && (a[e[f]] = b[e[f]]), f++;
        return a
    }

    function o(a, b) {
        return n(a, b, !0)
    }

    function p(a, b, c) {
        var e, d = b.prototype;
        e = a.prototype = Object.create(d), e.constructor = a, e._super = d, c && n(e, c)
    }

    function q(a, b) {
        return function () {
            return a.apply(b, arguments)
        }
    }

    function r(a, b) {
        return typeof a == g ? a.apply(b ? b[0] || d : d, b) : a
    }

    function s(a, b) {
        return a === d ? b : a
    }

    function t(a, b, c) {
        m(x(b), function (b) {
            a.addEventListener(b, c, !1)
        })
    }

    function u(a, b, c) {
        m(x(b), function (b) {
            a.removeEventListener(b, c, !1)
        })
    }

    function v(a, b) {
        for (; a;) {
            if (a == b) return !0;
            a = a.parentNode
        }
        return !1
    }

    function w(a, b) {
        return a.indexOf(b) > -1
    }

    function x(a) {
        return a.trim().split(/\s+/g)
    }

    function y(a, b, c) {
        if (a.indexOf && !c) return a.indexOf(b);
        for (var d = 0; d < a.length;) {
            if (c && a[d][c] == b || !c && a[d] === b) return d;
            d++
        }
        return -1
    }

    function z(a) {
        return Array.prototype.slice.call(a, 0)
    }

    function A(a, b, c) {
        for (var d = [], e = [], f = 0; f < a.length;) {
            var g = b ? a[f][b] : a[f];
            y(e, g) < 0 && d.push(a[f]), e[f] = g, f++
        }
        return c && (d = b ? d.sort(function (a, c) {
            return a[b] > c[b]
        }) : d.sort()), d
    }

    function B(a, b) {
        for (var c, f, g = b[0].toUpperCase() + b.slice(1), h = 0; h < e.length;) {
            if (c = e[h], f = c ? c + g : b, f in a) return f;
            h++
        }
        return d
    }

    function D() {
        return C++
    }

    function E(a) {
        var b = a.ownerDocument;
        return b.defaultView || b.parentWindow
    }

    function ab(a, b) {
        var c = this;
        this.manager = a, this.callback = b, this.element = a.element, this.target = a.options.inputTarget, this.domHandler = function (b) {
            r(a.options.enable, [a]) && c.handler(b)
        }, this.init()
    }

    function bb(a) {
        var b, c = a.options.inputClass;
        return b = c ? c : H ? wb : I ? Eb : G ? Gb : rb, new b(a, cb)
    }

    function cb(a, b, c) {
        var d = c.pointers.length,
            e = c.changedPointers.length,
            f = b & O && 0 === d - e,
            g = b & (Q | R) && 0 === d - e;
        c.isFirst = !!f, c.isFinal = !!g, f && (a.session = {}), c.eventType = b, db(a, c), a.emit("hammer.input", c), a.recognize(c), a.session.prevInput = c
    }

    function db(a, b) {
        var c = a.session,
            d = b.pointers,
            e = d.length;
        c.firstInput || (c.firstInput = gb(b)), e > 1 && !c.firstMultiple ? c.firstMultiple = gb(b) : 1 === e && (c.firstMultiple = !1);
        var f = c.firstInput,
            g = c.firstMultiple,
            h = g ? g.center : f.center,
            i = b.center = hb(d);
        b.timeStamp = j(), b.deltaTime = b.timeStamp - f.timeStamp, b.angle = lb(h, i), b.distance = kb(h, i), eb(c, b), b.offsetDirection = jb(b.deltaX, b.deltaY), b.scale = g ? nb(g.pointers, d) : 1, b.rotation = g ? mb(g.pointers, d) : 0, fb(c, b);
        var k = a.element;
        v(b.srcEvent.target, k) && (k = b.srcEvent.target), b.target = k
    }

    function eb(a, b) {
        var c = b.center,
            d = a.offsetDelta || {},
            e = a.prevDelta || {},
            f = a.prevInput || {};
        (b.eventType === O || f.eventType === Q) && (e = a.prevDelta = {
            x: f.deltaX || 0,
            y: f.deltaY || 0
        }, d = a.offsetDelta = {
            x: c.x,
            y: c.y
        }), b.deltaX = e.x + (c.x - d.x), b.deltaY = e.y + (c.y - d.y)
    }

    function fb(a, b) {
        var f, g, h, j, c = a.lastInterval || b,
            e = b.timeStamp - c.timeStamp;
        if (b.eventType != R && (e > N || c.velocity === d)) {
            var k = c.deltaX - b.deltaX,
                l = c.deltaY - b.deltaY,
                m = ib(e, k, l);
            g = m.x, h = m.y, f = i(m.x) > i(m.y) ? m.x : m.y, j = jb(k, l), a.lastInterval = b
        } else f = c.velocity, g = c.velocityX, h = c.velocityY, j = c.direction;
        b.velocity = f, b.velocityX = g, b.velocityY = h, b.direction = j
    }

    function gb(a) {
        for (var b = [], c = 0; c < a.pointers.length;) b[c] = {
            clientX: h(a.pointers[c].clientX),
            clientY: h(a.pointers[c].clientY)
        }, c++;
        return {
            timeStamp: j(),
            pointers: b,
            center: hb(b),
            deltaX: a.deltaX,
            deltaY: a.deltaY
        }
    }

    function hb(a) {
        var b = a.length;
        if (1 === b) return {
            x: h(a[0].clientX),
            y: h(a[0].clientY)
        };
        for (var c = 0, d = 0, e = 0; b > e;) c += a[e].clientX, d += a[e].clientY, e++;
        return {
            x: h(c / b),
            y: h(d / b)
        }
    }

    function ib(a, b, c) {
        return {
            x: b / a || 0,
            y: c / a || 0
        }
    }

    function jb(a, b) {
        return a === b ? S : i(a) >= i(b) ? a > 0 ? T : U : b > 0 ? V : W
    }

    function kb(a, b, c) {
        c || (c = $);
        var d = b[c[0]] - a[c[0]],
            e = b[c[1]] - a[c[1]];
        return Math.sqrt(d * d + e * e)
    }

    function lb(a, b, c) {
        c || (c = $);
        var d = b[c[0]] - a[c[0]],
            e = b[c[1]] - a[c[1]];
        return 180 * Math.atan2(e, d) / Math.PI
    }

    function mb(a, b) {
        return lb(b[1], b[0], _) - lb(a[1], a[0], _)
    }

    function nb(a, b) {
        return kb(b[0], b[1], _) / kb(a[0], a[1], _)
    }

    function rb() {
        this.evEl = pb, this.evWin = qb, this.allow = !0, this.pressed = !1, ab.apply(this, arguments)
    }

    function wb() {
        this.evEl = ub, this.evWin = vb, ab.apply(this, arguments), this.store = this.manager.session.pointerEvents = []
    }

    function Ab() {
        this.evTarget = yb, this.evWin = zb, this.started = !1, ab.apply(this, arguments)
    }

    function Bb(a, b) {
        var c = z(a.touches),
            d = z(a.changedTouches);
        return b & (Q | R) && (c = A(c.concat(d), "identifier", !0)), [c, d]
    }

    function Eb() {
        this.evTarget = Db, this.targetIds = {}, ab.apply(this, arguments)
    }

    function Fb(a, b) {
        var c = z(a.touches),
            d = this.targetIds;
        if (b & (O | P) && 1 === c.length) return d[c[0].identifier] = !0, [c, c];
        var e, f, g = z(a.changedTouches),
            h = [],
            i = this.target;
        if (f = c.filter(function (a) {
                return v(a.target, i)
            }), b === O)
            for (e = 0; e < f.length;) d[f[e].identifier] = !0, e++;
        for (e = 0; e < g.length;) d[g[e].identifier] && h.push(g[e]), b & (Q | R) && delete d[g[e].identifier], e++;
        return h.length ? [A(f.concat(h), "identifier", !0), h] : void 0
    }

    function Gb() {
        ab.apply(this, arguments);
        var a = q(this.handler, this);
        this.touch = new Eb(this.manager, a), this.mouse = new rb(this.manager, a)
    }

    function Pb(a, b) {
        this.manager = a, this.set(b)
    }

    function Qb(a) {
        if (w(a, Mb)) return Mb;
        var b = w(a, Nb),
            c = w(a, Ob);
        return b && c ? Nb + " " + Ob : b || c ? b ? Nb : Ob : w(a, Lb) ? Lb : Kb
    }

    function Yb(a) {
        this.id = D(), this.manager = null, this.options = o(a || {}, this.defaults), this.options.enable = s(this.options.enable, !0), this.state = Rb, this.simultaneous = {}, this.requireFail = []
    }

    function Zb(a) {
        return a & Wb ? "cancel" : a & Ub ? "end" : a & Tb ? "move" : a & Sb ? "start" : ""
    }

    function $b(a) {
        return a == W ? "down" : a == V ? "up" : a == T ? "left" : a == U ? "right" : ""
    }

    function _b(a, b) {
        var c = b.manager;
        return c ? c.get(a) : a
    }

    function ac() {
        Yb.apply(this, arguments)
    }

    function bc() {
        ac.apply(this, arguments), this.pX = null, this.pY = null
    }

    function cc() {
        ac.apply(this, arguments)
    }

    function dc() {
        Yb.apply(this, arguments), this._timer = null, this._input = null
    }

    function ec() {
        ac.apply(this, arguments)
    }

    function fc() {
        ac.apply(this, arguments)
    }

    function gc() {
        Yb.apply(this, arguments), this.pTime = !1, this.pCenter = !1, this._timer = null, this._input = null, this.count = 0
    }

    function hc(a, b) {
        return b = b || {}, b.recognizers = s(b.recognizers, hc.defaults.preset), new kc(a, b)
    }

    function kc(a, b) {
        b = b || {}, this.options = o(b, hc.defaults), this.options.inputTarget = this.options.inputTarget || a, this.handlers = {}, this.session = {}, this.recognizers = [], this.element = a, this.input = bb(this), this.touchAction = new Pb(this, this.options.touchAction), lc(this, !0), m(b.recognizers, function (a) {
            var b = this.add(new a[0](a[1]));
            a[2] && b.recognizeWith(a[2]), a[3] && b.requireFailure(a[3])
        }, this)
    }

    function lc(a, b) {
        var c = a.element;
        m(a.options.cssProps, function (a, d) {
            c.style[B(c.style, d)] = b ? a : ""
        })
    }

    function mc(a, c) {
        var d = b.createEvent("Event");
        d.initEvent(a, !0, !0), d.gesture = c, c.target.dispatchEvent(d)
    }
    var e = ["", "webkit", "moz", "MS", "ms", "o"],
        f = b.createElement("div"),
        g = "function",
        h = Math.round,
        i = Math.abs,
        j = Date.now,
        C = 1,
        F = /mobile|tablet|ip(ad|hone|od)|android/i,
        G = "ontouchstart" in a,
        H = B(a, "PointerEvent") !== d,
        I = G && F.test(navigator.userAgent),
        J = "touch",
        K = "pen",
        L = "mouse",
        M = "kinect",
        N = 25,
        O = 1,
        P = 2,
        Q = 4,
        R = 8,
        S = 1,
        T = 2,
        U = 4,
        V = 8,
        W = 16,
        X = T | U,
        Y = V | W,
        Z = X | Y,
        $ = ["x", "y"],
        _ = ["clientX", "clientY"];
    ab.prototype = {
        handler: function () {},
        init: function () {
            this.evEl && t(this.element, this.evEl, this.domHandler), this.evTarget && t(this.target, this.evTarget, this.domHandler), this.evWin && t(E(this.element), this.evWin, this.domHandler)
        },
        destroy: function () {
            this.evEl && u(this.element, this.evEl, this.domHandler), this.evTarget && u(this.target, this.evTarget, this.domHandler), this.evWin && u(E(this.element), this.evWin, this.domHandler)
        }
    };
    var ob = {
            mousedown: O,
            mousemove: P,
            mouseup: Q
        },
        pb = "mousedown",
        qb = "mousemove mouseup";
    p(rb, ab, {
        handler: function (a) {
            var b = ob[a.type];
            b & O && 0 === a.button && (this.pressed = !0), b & P && 1 !== a.which && (b = Q), this.pressed && this.allow && (b & Q && (this.pressed = !1), this.callback(this.manager, b, {
                pointers: [a],
                changedPointers: [a],
                pointerType: L,
                srcEvent: a
            }))
        }
    });
    var sb = {
            pointerdown: O,
            pointermove: P,
            pointerup: Q,
            pointercancel: R,
            pointerout: R
        },
        tb = {
            2: J,
            3: K,
            4: L,
            5: M
        },
        ub = "pointerdown",
        vb = "pointermove pointerup pointercancel";
    a.MSPointerEvent && (ub = "MSPointerDown", vb = "MSPointerMove MSPointerUp MSPointerCancel"), p(wb, ab, {
        handler: function (a) {
            var b = this.store,
                c = !1,
                d = a.type.toLowerCase().replace("ms", ""),
                e = sb[d],
                f = tb[a.pointerType] || a.pointerType,
                g = f == J,
                h = y(b, a.pointerId, "pointerId");
            e & O && (0 === a.button || g) ? 0 > h && (b.push(a), h = b.length - 1) : e & (Q | R) && (c = !0), 0 > h || (b[h] = a, this.callback(this.manager, e, {
                pointers: b,
                changedPointers: [a],
                pointerType: f,
                srcEvent: a
            }), c && b.splice(h, 1))
        }
    });
    var xb = {
            touchstart: O,
            touchmove: P,
            touchend: Q,
            touchcancel: R
        },
        yb = "touchstart",
        zb = "touchstart touchmove touchend touchcancel";
    p(Ab, ab, {
        handler: function (a) {
            var b = xb[a.type];
            if (b === O && (this.started = !0), this.started) {
                var c = Bb.call(this, a, b);
                b & (Q | R) && 0 === c[0].length - c[1].length && (this.started = !1), this.callback(this.manager, b, {
                    pointers: c[0],
                    changedPointers: c[1],
                    pointerType: J,
                    srcEvent: a
                })
            }
        }
    });
    var Cb = {
            touchstart: O,
            touchmove: P,
            touchend: Q,
            touchcancel: R
        },
        Db = "touchstart touchmove touchend touchcancel";
    p(Eb, ab, {
        handler: function (a) {
            var b = Cb[a.type],
                c = Fb.call(this, a, b);
            c && this.callback(this.manager, b, {
                pointers: c[0],
                changedPointers: c[1],
                pointerType: J,
                srcEvent: a
            })
        }
    }), p(Gb, ab, {
        handler: function (a, b, c) {
            var d = c.pointerType == J,
                e = c.pointerType == L;
            if (d) this.mouse.allow = !1;
            else if (e && !this.mouse.allow) return;
            b & (Q | R) && (this.mouse.allow = !0), this.callback(a, b, c)
        },
        destroy: function () {
            this.touch.destroy(), this.mouse.destroy()
        }
    });
    var Hb = B(f.style, "touchAction"),
        Ib = Hb !== d,
        Jb = "compute",
        Kb = "auto",
        Lb = "manipulation",
        Mb = "none",
        Nb = "pan-x",
        Ob = "pan-y";
    Pb.prototype = {
        set: function (a) {
            a == Jb && (a = this.compute()), Ib && (this.manager.element.style[Hb] = a), this.actions = a.toLowerCase().trim()
        },
        update: function () {
            this.set(this.manager.options.touchAction)
        },
        compute: function () {
            var a = [];
            return m(this.manager.recognizers, function (b) {
                r(b.options.enable, [b]) && (a = a.concat(b.getTouchAction()))
            }), Qb(a.join(" "))
        },
        preventDefaults: function (a) {
            if (!Ib) {
                var b = a.srcEvent,
                    c = a.offsetDirection;
                if (this.manager.session.prevented) return b.preventDefault(), void 0;
                var d = this.actions,
                    e = w(d, Mb),
                    f = w(d, Ob),
                    g = w(d, Nb);
                return e || f && c & X || g && c & Y ? this.preventSrc(b) : void 0
            }
        },
        preventSrc: function (a) {
            this.manager.session.prevented = !0, a.preventDefault()
        }
    };
    var Rb = 1,
        Sb = 2,
        Tb = 4,
        Ub = 8,
        Vb = Ub,
        Wb = 16,
        Xb = 32;
    Yb.prototype = {
        defaults: {},
        set: function (a) {
            return n(this.options, a), this.manager && this.manager.touchAction.update(), this
        },
        recognizeWith: function (a) {
            if (l(a, "recognizeWith", this)) return this;
            var b = this.simultaneous;
            return a = _b(a, this), b[a.id] || (b[a.id] = a, a.recognizeWith(this)), this
        },
        dropRecognizeWith: function (a) {
            return l(a, "dropRecognizeWith", this) ? this : (a = _b(a, this), delete this.simultaneous[a.id], this)
        },
        requireFailure: function (a) {
            if (l(a, "requireFailure", this)) return this;
            var b = this.requireFail;
            return a = _b(a, this), -1 === y(b, a) && (b.push(a), a.requireFailure(this)), this
        },
        dropRequireFailure: function (a) {
            if (l(a, "dropRequireFailure", this)) return this;
            a = _b(a, this);
            var b = y(this.requireFail, a);
            return b > -1 && this.requireFail.splice(b, 1), this
        },
        hasRequireFailures: function () {
            return this.requireFail.length > 0
        },
        canRecognizeWith: function (a) {
            return !!this.simultaneous[a.id]
        },
        emit: function (a) {
            function d(d) {
                b.manager.emit(b.options.event + (d ? Zb(c) : ""), a)
            }
            var b = this,
                c = this.state;
            Ub > c && d(!0), d(), c >= Ub && d(!0)
        },
        tryEmit: function (a) {
            return this.canEmit() ? this.emit(a) : (this.state = Xb, void 0)
        },
        canEmit: function () {
            for (var a = 0; a < this.requireFail.length;) {
                if (!(this.requireFail[a].state & (Xb | Rb))) return !1;
                a++
            }
            return !0
        },
        recognize: function (a) {
            var b = n({}, a);
            return r(this.options.enable, [this, b]) ? (this.state & (Vb | Wb | Xb) && (this.state = Rb), this.state = this.process(b), this.state & (Sb | Tb | Ub | Wb) && this.tryEmit(b), void 0) : (this.reset(), this.state = Xb, void 0)
        },
        process: function () {},
        getTouchAction: function () {},
        reset: function () {}
    }, p(ac, Yb, {
        defaults: {
            pointers: 1
        },
        attrTest: function (a) {
            var b = this.options.pointers;
            return 0 === b || a.pointers.length === b
        },
        process: function (a) {
            var b = this.state,
                c = a.eventType,
                d = b & (Sb | Tb),
                e = this.attrTest(a);
            return d && (c & R || !e) ? b | Wb : d || e ? c & Q ? b | Ub : b & Sb ? b | Tb : Sb : Xb
        }
    }), p(bc, ac, {
        defaults: {
            event: "pan",
            threshold: 10,
            pointers: 1,
            direction: Z
        },
        getTouchAction: function () {
            var a = this.options.direction,
                b = [];
            return a & X && b.push(Ob), a & Y && b.push(Nb), b
        },
        directionTest: function (a) {
            var b = this.options,
                c = !0,
                d = a.distance,
                e = a.direction,
                f = a.deltaX,
                g = a.deltaY;
            return e & b.direction || (b.direction & X ? (e = 0 === f ? S : 0 > f ? T : U, c = f != this.pX, d = Math.abs(a.deltaX)) : (e = 0 === g ? S : 0 > g ? V : W, c = g != this.pY, d = Math.abs(a.deltaY))), a.direction = e, c && d > b.threshold && e & b.direction
        },
        attrTest: function (a) {
            return ac.prototype.attrTest.call(this, a) && (this.state & Sb || !(this.state & Sb) && this.directionTest(a))
        },
        emit: function (a) {
            this.pX = a.deltaX, this.pY = a.deltaY;
            var b = $b(a.direction);
            b && this.manager.emit(this.options.event + b, a), this._super.emit.call(this, a)
        }
    }), p(cc, ac, {
        defaults: {
            event: "pinch",
            threshold: 0,
            pointers: 2
        },
        getTouchAction: function () {
            return [Mb]
        },
        attrTest: function (a) {
            return this._super.attrTest.call(this, a) && (Math.abs(a.scale - 1) > this.options.threshold || this.state & Sb)
        },
        emit: function (a) {
            if (this._super.emit.call(this, a), 1 !== a.scale) {
                var b = a.scale < 1 ? "in" : "out";
                this.manager.emit(this.options.event + b, a)
            }
        }
    }), p(dc, Yb, {
        defaults: {
            event: "press",
            pointers: 1,
            time: 500,
            threshold: 5
        },
        getTouchAction: function () {
            return [Kb]
        },
        process: function (a) {
            var b = this.options,
                c = a.pointers.length === b.pointers,
                d = a.distance < b.threshold,
                e = a.deltaTime > b.time;
            if (this._input = a, !d || !c || a.eventType & (Q | R) && !e) this.reset();
            else if (a.eventType & O) this.reset(), this._timer = k(function () {
                this.state = Vb, this.tryEmit()
            }, b.time, this);
            else if (a.eventType & Q) return Vb;
            return Xb
        },
        reset: function () {
            clearTimeout(this._timer)
        },
        emit: function (a) {
            this.state === Vb && (a && a.eventType & Q ? this.manager.emit(this.options.event + "up", a) : (this._input.timeStamp = j(), this.manager.emit(this.options.event, this._input)))
        }
    }), p(ec, ac, {
        defaults: {
            event: "rotate",
            threshold: 0,
            pointers: 2
        },
        getTouchAction: function () {
            return [Mb]
        },
        attrTest: function (a) {
            return this._super.attrTest.call(this, a) && (Math.abs(a.rotation) > this.options.threshold || this.state & Sb)
        }
    }), p(fc, ac, {
        defaults: {
            event: "swipe",
            threshold: 10,
            velocity: .65,
            direction: X | Y,
            pointers: 1
        },
        getTouchAction: function () {
            return bc.prototype.getTouchAction.call(this)
        },
        attrTest: function (a) {
            var c, b = this.options.direction;
            return b & (X | Y) ? c = a.velocity : b & X ? c = a.velocityX : b & Y && (c = a.velocityY), this._super.attrTest.call(this, a) && b & a.direction && a.distance > this.options.threshold && i(c) > this.options.velocity && a.eventType & Q
        },
        emit: function (a) {
            var b = $b(a.direction);
            b && this.manager.emit(this.options.event + b, a), this.manager.emit(this.options.event, a)
        }
    }), p(gc, Yb, {
        defaults: {
            event: "tap",
            pointers: 1,
            taps: 1,
            interval: 300,
            time: 250,
            threshold: 2,
            posThreshold: 10
        },
        getTouchAction: function () {
            return [Lb]
        },
        process: function (a) {
            var b = this.options,
                c = a.pointers.length === b.pointers,
                d = a.distance < b.threshold,
                e = a.deltaTime < b.time;
            if (this.reset(), a.eventType & O && 0 === this.count) return this.failTimeout();
            if (d && e && c) {
                if (a.eventType != Q) return this.failTimeout();
                var f = this.pTime ? a.timeStamp - this.pTime < b.interval : !0,
                    g = !this.pCenter || kb(this.pCenter, a.center) < b.posThreshold;
                this.pTime = a.timeStamp, this.pCenter = a.center, g && f ? this.count += 1 : this.count = 1, this._input = a;
                var h = this.count % b.taps;
                if (0 === h) return this.hasRequireFailures() ? (this._timer = k(function () {
                    this.state = Vb, this.tryEmit()
                }, b.interval, this), Sb) : Vb
            }
            return Xb
        },
        failTimeout: function () {
            return this._timer = k(function () {
                this.state = Xb
            }, this.options.interval, this), Xb
        },
        reset: function () {
            clearTimeout(this._timer)
        },
        emit: function () {
            this.state == Vb && (this._input.tapCount = this.count, this.manager.emit(this.options.event, this._input))
        }
    }), hc.VERSION = "2.0.4", hc.defaults = {
        domEvents: !1,
        touchAction: Jb,
        enable: !0,
        inputTarget: null,
        inputClass: null,
        preset: [[ec, {
            enable: !1
        }], [cc, {
            enable: !1
        }, ["rotate"]], [fc, {
            direction: X
        }], [bc, {
            direction: X
        }, ["swipe"]], [gc], [gc, {
            event: "doubletap",
            taps: 2
        }, ["tap"]], [dc]],
        cssProps: {
            userSelect: "default",
            touchSelect: "none",
            touchCallout: "none",
            contentZooming: "none",
            userDrag: "none",
            tapHighlightColor: "rgba(0,0,0,0)"
        }
    };
    var ic = 1,
        jc = 2;
    kc.prototype = {
        set: function (a) {
            return n(this.options, a), a.touchAction && this.touchAction.update(), a.inputTarget && (this.input.destroy(), this.input.target = a.inputTarget, this.input.init()), this
        },
        stop: function (a) {
            this.session.stopped = a ? jc : ic
        },
        recognize: function (a) {
            var b = this.session;
            if (!b.stopped) {
                this.touchAction.preventDefaults(a);
                var c, d = this.recognizers,
                    e = b.curRecognizer;
                (!e || e && e.state & Vb) && (e = b.curRecognizer = null);
                for (var f = 0; f < d.length;) c = d[f], b.stopped === jc || e && c != e && !c.canRecognizeWith(e) ? c.reset() : c.recognize(a), !e && c.state & (Sb | Tb | Ub) && (e = b.curRecognizer = c), f++
            }
        },
        get: function (a) {
            if (a instanceof Yb) return a;
            for (var b = this.recognizers, c = 0; c < b.length; c++)
                if (b[c].options.event == a) return b[c];
            return null
        },
        add: function (a) {
            if (l(a, "add", this)) return this;
            var b = this.get(a.options.event);
            return b && this.remove(b), this.recognizers.push(a), a.manager = this, this.touchAction.update(), a
        },
        remove: function (a) {
            if (l(a, "remove", this)) return this;
            var b = this.recognizers;
            return a = this.get(a), b.splice(y(b, a), 1), this.touchAction.update(), this
        },
        on: function (a, b) {
            var c = this.handlers;
            return m(x(a), function (a) {
                c[a] = c[a] || [], c[a].push(b)
            }), this
        },
        off: function (a, b) {
            var c = this.handlers;
            return m(x(a), function (a) {
                b ? c[a].splice(y(c[a], b), 1) : delete c[a]
            }), this
        },
        emit: function (a, b) {
            this.options.domEvents && mc(a, b);
            var c = this.handlers[a] && this.handlers[a].slice();
            if (c && c.length) {
                b.type = a, b.preventDefault = function () {
                    b.srcEvent.preventDefault()
                };
                for (var d = 0; d < c.length;) c[d](b), d++
            }
        },
        destroy: function () {
            this.element && lc(this, !1), this.handlers = {}, this.session = {}, this.input.destroy(), this.element = null
        }
    }, n(hc, {
        INPUT_START: O,
        INPUT_MOVE: P,
        INPUT_END: Q,
        INPUT_CANCEL: R,
        STATE_POSSIBLE: Rb,
        STATE_BEGAN: Sb,
        STATE_CHANGED: Tb,
        STATE_ENDED: Ub,
        STATE_RECOGNIZED: Vb,
        STATE_CANCELLED: Wb,
        STATE_FAILED: Xb,
        DIRECTION_NONE: S,
        DIRECTION_LEFT: T,
        DIRECTION_RIGHT: U,
        DIRECTION_UP: V,
        DIRECTION_DOWN: W,
        DIRECTION_HORIZONTAL: X,
        DIRECTION_VERTICAL: Y,
        DIRECTION_ALL: Z,
        Manager: kc,
        Input: ab,
        TouchAction: Pb,
        TouchInput: Eb,
        MouseInput: rb,
        PointerEventInput: wb,
        TouchMouseInput: Gb,
        SingleTouchInput: Ab,
        Recognizer: Yb,
        AttrRecognizer: ac,
        Tap: gc,
        Pan: bc,
        Swipe: fc,
        Pinch: cc,
        Rotate: ec,
        Press: dc,
        on: t,
        off: u,
        each: m,
        merge: o,
        extend: n,
        inherit: p,
        bindFn: q,
        prefixed: B
    }), typeof define == g && define.amd ? define(function () {
        return hc
    }) : "undefined" != typeof module && module.exports ? module.exports = hc : a[c] = hc
}(window, document, "Hammer");