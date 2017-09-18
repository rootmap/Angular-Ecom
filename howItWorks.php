<?php
include './cms/plugin.php';
$cms = new plugin();
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <script sr="map.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
        <?php
        echo $cms->pageTitle("How it works | Ticketchai.com...");
        ?>
        <?php
        echo $cms->headCss(array("how_it_works"));
        ?>
        <!--        arnav css
        -->
        <link rel="stylesheet" href="assets/css/mediaQuery.css">
        <style type="text/css">
            @media (min-width: 320px) and (max-width: 480px) { 
                  .count {
                    display: none;
                  }
                  
                  .tabText{
                      text-align: center;
                  }
                  
                  .tabTexth3{
                      text-align: center;
                  }
                  
                  .tabTextp {
                      text-align: center;
                  }
            }
             @media (min-width: 768px) and (max-width: 991px) { 
                  #smallNav .smallNavLi {
                      width: 19%;
                  }
                  
                  .count {
                    font-size: 75px;
                    margin-top: 25px;
                  }
                  
/*                   .tabText{
                      text-align: center;
                  }
                  
                  .tabTexth3{
                      text-align: center;
                  }
                  
                  .tabTextp {
                      text-align: center;
                  }*/
              }  
              
              @media (min-width: 360px) and (max-width: 640px) { 
                  #smallNav .smallNavLi {
                      width: 16% ;
                  }
                  
                  .count {
                    display: none;
                  }
                  
                  .tabText{
                      text-align: center;
                  }
                  
                  .tabTexth3{
                      text-align: center;
                  }
                  
                  .tabTextp {
                      text-align: center;
                  }
              }  
            #hitw-parent{
                overflow: hidden;
                position: relative;
                height: 500px;
                width: 100%;
                background: url(tc-merchant-template/assets/img/slider/city.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;}
            #hitw-parent:after {
                content: "";
                background: url(tc-merchant-template/assets/img/pattern.png) repeat;
                background-color: /*rgba(136, 198, 89, 0.4)*/rgba(0,0,0,0.5);
                display: block !important;
                visibility: visible !important;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                position: absolute;
                z-index: 2;}
				
            #hitw-iland {
				position: absolute;
				z-index: 3;
				top: 25%;
				left: 0; 
				  right: 0; 
				  margin-left: auto; 
				  margin-right: auto; 
				color: #ffffff;
				}
				
				.typed-cursor{
					opacity: 1;
					-webkit-animation: blink 0.7s infinite;
					-moz-animation: blink 0.7s infinite;
					animation: blink 0.7s infinite;
				}
				@keyframes blink{
					0% { opacity:1; }
					50% { opacity:0; }
					100% { opacity:1; }
				}
				@-webkit-keyframes blink{
					0% { opacity:1; }
					50% { opacity:0; }
					100% { opacity:1; }
				}
				@-moz-keyframes blink{
					0% { opacity:1; }
					50% { opacity:0; }
					100% { opacity:1; }
				}
                
             
            </style>
            <!--<![endif]-->
            <script type="text/javascript">
                        (function(f, g, c, h, e, k, i){/*! Jssor */
                        new (function(){}); var d = {id:function(a){return a}, Id:function(a){return - a * (a - 2)}}; var b = new function(){var j = this, xb = /\S+/g, F = 1, wb = 2, cb = 3, bb = 4, fb = 5, G, r = 0, l = 0, s = 0, Y = 0, A = 0, I = navigator, kb = I.appName, o = I.userAgent, p = parseFloat; function Fb(){if (!G){G = {je:"ontouchstart"in f || "createTouch"in g}; var a; if (I.pointerEnabled || (a = I.msPointerEnabled))G.ld = a?"msTouchAction":"touchAction"}return G}function v(i){if (!r){r = - 1; if (kb == "Microsoft Internet Explorer" && !!f.attachEvent && !!f.ActiveXObject){var e = o.indexOf("MSIE"); r = F; s = p(o.substring(e + 5, o.indexOf(";", e))); /*@cc_on Y=@_jscript_version@*/; l = g.documentMode || s} else if (kb == "Netscape" && !!f.addEventListener){var d = o.indexOf("Firefox"), b = o.indexOf("Safari"), h = o.indexOf("Chrome"), c = o.indexOf("AppleWebKit"); if (d >= 0){r = wb; l = p(o.substring(d + 8))} else if (b >= 0){var j = o.substring(0, b).lastIndexOf("/"); r = h >= 0?bb:cb; l = p(o.substring(j + 1, b))} else{var a = /Trident\/.*rv:([0-9]{1,}[\.0-9]{0,})/i.exec(o); if (a){r = F; l = s = p(a[1])}}if (c >= 0)A = p(o.substring(c + 12))} else{var a = /(opera)(?:.*version|)[ \/]([\w.]+)/i.exec(o); if (a){r = fb; l = p(a[2])}}}return i == r}function q(){return v(F)}function vb(){return q() && (l < 6 || g.compatMode == "BackCompat")}function ab(){return v(cb)}function eb(){return v(fb)}function rb(){return ab() && A > 534 && A < 535}function J(){v(); return A > 537 || l > 42 || r == F && l >= 11}function tb(){return q() && l < 9}function sb(a){var b, c; return function(f){if (!b){b = e; var d = a.substr(0, 1).toUpperCase() + a.substr(1); n([a].concat(["WebKit", "ms", "Moz", "O", "webkit"]), function(g, e){var b = a; if (e)b = g + d; if (f.style[b] != i)return c = b})}return c}}function qb(b){var a; return function(c){a = a || sb(b)(c) || b; return a}}var K = qb("transform"); function jb(a){return{}.toString.call(a)}var gb = {}; n(["Boolean", "Number", "String", "Function", "Array", "Date", "RegExp", "Object"], function(a){gb["[object " + a + "]"] = a.toLowerCase()}); function n(b, d){var a, c; if (jb(b) == "[object Array]"){for (a = 0; a < b.length; a++)if (c = d(b[a], a, b))return c} else for (a in b)if (c = d(b[a], a, b))return c}function D(a){return a == h?String(a):gb[jb(a)] || "object"}function hb(a){for (var b in a)return e}function B(a){try{return D(a) == "object" && !a.nodeType && a != a.window && (!a.constructor || {}.hasOwnProperty.call(a.constructor.prototype, "isPrototypeOf"))} catch (b){}}function u(a, b){return{x:a, y:b}}function nb(b, a){setTimeout(b, a || 0)}function H(b, d, c){var a = !b || b == "inherit"?"":b; n(d, function(c){var b = c.exec(a); if (b){var d = a.substr(0, b.index), e = a.substr(b.index + b[0].length + 1, a.length - 1); a = d + e}}); a = c + (!a.indexOf(" ")?"":" ") + a; return a}function pb(b, a){if (l < 9)b.style.filter = a}j.ke = Fb; j.nd = q; j.ne = ab; j.we = J; sb("transform"); j.vc = function(){return l}; j.tc = nb; function V(a){a.constructor === V.caller && a.sc && a.sc.apply(a, V.caller.arguments)}j.sc = V; j.nb = function(a){if (j.ee(a))a = g.getElementById(a); return a}; function t(a){return a || f.event}j.rc = t; j.Vb = function(b){b = t(b); var a = b.target || b.srcElement || g; if (a.nodeType == 3)a = j.pc(a); return a}; j.xc = function(a){a = t(a); return{x:a.pageX || a.clientX || 0, y:a.pageY || a.clientY || 0}}; function w(c, d, a){if (a !== i)c.style[d] = a == i?"":a; else{var b = c.currentStyle || c.style; a = b[d]; if (a == "" && f.getComputedStyle){b = c.ownerDocument.defaultView.getComputedStyle(c, h); b && (a = b.getPropertyValue(d) || b[d])}return a}}function X(b, c, a, d){if (a !== i){if (a == h)a = ""; else d && (a += "px"); w(b, c, a)} else return p(w(b, c))}function m(c, a){var d = a?X:w, b; if (a & 4)b = qb(c); return function(e, f){return d(e, b?b(e):c, f, a & 2)}}function Ab(b){if (q() && s < 9){var a = /opacity=([^)]*)/.exec(b.style.filter || ""); return a?p(a[1]) / 100:1} else return p(b.style.opacity || "1")}function Cb(b, a, f){if (q() && s < 9){var h = b.style.filter || "", i = new RegExp(/[\s]*alpha\([^\)]*\)/g), e = c.round(100 * a), d = ""; if (e < 100 || f)d = "alpha(opacity=" + e + ") "; var g = H(h, [i], d); pb(b, g)} else b.style.opacity = a == 1?"":c.round(a * 100) / 100}var L = {R:["rotate"], N:["rotateX"], O:["rotateY"], vb:["skewX"], xb:["skewY"]}; if (!J())L = C(L, {o:["scaleX", 2], s:["scaleY", 2], E:["translateZ", 1]}); function M(d, a){var c = ""; if (a){if (q() && l && l < 10){delete a.N; delete a.O; delete a.E}b.f(a, function(d, b){var a = L[b]; if (a){var e = a[1] || 0; if (N[b] != d)c += " " + a[0] + "(" + d + (["deg", "px", ""])[e] + ")"}}); if (J()){if (a.S || a.ab || a.E != i)c += " translate3d(" + (a.S || 0) + "px," + (a.ab || 0) + "px," + (a.E || 0) + "px)"; if (a.o == i)a.o = 1; if (a.s == i)a.s = 1; if (a.o != 1 || a.s != 1)c += " scale3d(" + a.o + ", " + a.s + ", 1)"}}d.style[K(d)] = c}j.Bc = m("transformOrigin", 4); j.ve = m("backfaceVisibility", 4); j.ue = m("transformStyle", 4); j.te = m("perspective", 6); j.se = m("perspectiveOrigin", 4); j.re = function(a, b){if (q() && s < 9 || s < 10 && vb())a.style.zoom = b == 1?"":b; else{var c = K(a), f = "scale(" + b + ")", e = a.style[c], g = new RegExp(/[\s]*scale\(.*?\)/g), d = H(e, [g], f); a.style[c] = d}}; j.Pb = function(b, a){return function(c){c = t(c); var e = c.type, d = c.relatedTarget || (e == "mouseout"?c.toElement:c.fromElement); (!d || d !== a && !j.qe(a, d)) && b(c)}}; j.a = function(a, d, b, c){a = j.nb(a); if (a.addEventListener){d == "mousewheel" && a.addEventListener("DOMMouseScroll", b, c); a.addEventListener(d, b, c)} else if (a.attachEvent){a.attachEvent("on" + d, b); c && a.setCapture && a.setCapture()}}; j.F = function(a, c, d, b){a = j.nb(a); if (a.removeEventListener){c == "mousewheel" && a.removeEventListener("DOMMouseScroll", d, b); a.removeEventListener(c, d, b)} else if (a.detachEvent){a.detachEvent("on" + c, d); b && a.releaseCapture && a.releaseCapture()}}; j.Eb = function(a){a = t(a); a.preventDefault && a.preventDefault(); a.cancel = e; a.returnValue = k}; j.me = function(a){a = t(a); a.stopPropagation && a.stopPropagation(); a.cancelBubble = e}; j.eb = function(d, c){var a = [].slice.call(arguments, 2), b = function(){var b = a.concat([].slice.call(arguments, 0)); return c.apply(d, b)}; return b}; j.Cb = function(d, c){for (var b = [], a = d.firstChild; a; a = a.nextSibling)(c || a.nodeType == 1) && b.push(a); return b}; function ib(a, c, e, b){b = b || "u"; for (a = a?a.firstChild:h; a; a = a.nextSibling)if (a.nodeType == 1){if (S(a, b) == c)return a; if (!e){var d = ib(a, c, e, b); if (d)return d}}}j.q = ib; function Q(a, d, f, b){b = b || "u"; var c = []; for (a = a?a.firstChild:h; a; a = a.nextSibling)if (a.nodeType == 1){S(a, b) == d && c.push(a); if (!f){var e = Q(a, d, f, b); if (e.length)c = c.concat(e)}}return c}function db(a, c, d){for (a = a?a.firstChild:h; a; a = a.nextSibling)if (a.nodeType == 1){if (a.tagName == c)return a; if (!d){var b = db(a, c, d); if (b)return b}}}j.Qe = db; j.Le = function(b, a){return b.getElementsByTagName(a)}; function C(){var e = arguments, d, c, b, a, g = 1 & e[0], f = 1 + g; d = e[f - 1] || {}; for (; f < e.length; f++)if (c = e[f])for (b in c){a = c[b]; if (a !== i){a = c[b]; var h = d[b]; d[b] = g && (B(h) || B(a))?C(g, {}, h, a):a}}return d}j.V = C; function W(f, g){var d = {}, c, a, b; for (c in f){a = f[c]; b = g[c]; if (a !== b){var e; if (B(a) && B(b)){a = W(a, b); e = !hb(a)}!e && (d[c] = a)}}return d}j.wc = function(a){return D(a) == "function"}; j.ee = function(a){return D(a) == "string"}; j.ze = function(a){return!isNaN(p(a)) && isFinite(a)}; j.f = n; function P(a){return g.createElement(a)}j.X = function(){return P("DIV")}; j.Oc = function(){}; function T(b, c, a){if (a == i)return b.getAttribute(c); b.setAttribute(c, a)}function S(a, b){return T(a, b) || T(a, "data-" + b)}j.kb = T; j.g = S; function y(b, a){if (a == i)return b.className; b.className = a}j.Lc = y; function mb(b){var a = {}; n(b, function(b){if (b != i)a[b] = b}); return a}function ob(b, a){return b.match(a || xb)}function O(b, a){return mb(ob(b || "", a))}j.sd = ob; function Z(b, c){var a = ""; n(c, function(c){a && (a += b); a += c}); return a}function E(a, c, b){y(a, Z(" ", C(W(O(y(a)), O(c)), O(b))))}j.pc = function(a){return a.parentNode}; j.K = function(a){j.M(a, "none")}; j.mb = function(a, b){j.M(a, b?"none":"")}; j.td = function(b, a){b.removeAttribute(a)}; j.vd = function(){return q() && l < 10}; j.yd = function(d, a){if (a)d.style.clip = "rect(" + c.round(a.l || a.n || 0) + "px " + c.round(a.B) + "px " + c.round(a.u) + "px " + c.round(a.k || a.p || 0) + "px)"; else if (a !== i){var g = d.style.cssText, f = [new RegExp(/[\s]*clip: rect\(.*?\)[;]?/i), new RegExp(/[\s]*cliptop: .*?[;]?/i), new RegExp(/[\s]*clipright: .*?[;]?/i), new RegExp(/[\s]*clipbottom: .*?[;]?/i), new RegExp(/[\s]*clipleft: .*?[;]?/i)], e = H(g, f, ""); b.Kb(d, e)}}; j.Q = function(){return + new Date}; j.D = function(b, a){b.appendChild(a)}; j.Jb = function(b, a, c){(c || a.parentNode).insertBefore(b, a)}; j.Bb = function(b, a){a = a || b.parentNode; a && a.removeChild(b)}; j.xd = function(a, b){n(a, function(a){j.Bb(a, b)})}; j.Fc = function(a){j.xd(j.Cb(a, e), a)}; j.wd = function(a, b){var c = j.pc(a); b & 1 && j.v(a, (j.j(c) - j.j(a)) / 2); b & 2 && j.z(a, (j.m(c) - j.m(a)) / 2)}; j.rd = function(b, a){return parseInt(b, a || 10)}; j.qd = p; j.qe = function(b, a){var c = g.body; while (a && b !== a && c !== a)try{a = a.parentNode} catch (d){return k}return b === a}; function U(d, c, b){var a = d.cloneNode(!c); !b && j.td(a, "id"); return a}j.ub = U; j.fb = function(d, f){var a = new Image; function b(e, d){j.F(a, "load", b); j.F(a, "abort", c); j.F(a, "error", c); f && f(a, d)}function c(a){b(a, e)}if (eb() && l < 11.6 || !d)b(!d); else{j.a(a, "load", b); j.a(a, "abort", c); j.a(a, "error", c); a.src = d}}; j.Bd = function(d, a, e){var c = d.length + 1; function b(b){c--; if (a && b && b.src == a.src)a = b; !c && e && e(a)}n(d, function(a){j.fb(a.src, b)}); b()}; j.Pd = function(a, g, i, h){if (h)a = U(a); var c = Q(a, g); if (!c.length)c = b.Le(a, g); for (var f = c.length - 1; f > - 1; f--){var d = c[f], e = U(i); y(e, y(d)); b.Kb(e, d.style.cssText); b.Jb(e, d); b.Bb(d)}return a}; function Db(a){var l = this, p = "", r = ["av", "pv", "ds", "dn"], e = [], q, k = 0, f = 0, d = 0; function h(){E(a, q, e[d || k || f & 2 || f]); b.J(a, "pointer-events", d?"none":"")}function c(){k = 0; h(); j.F(g, "mouseup", c); j.F(g, "touchend", c); j.F(g, "touchcancel", c)}function o(a){if (d)j.Eb(a); else{k = 4; h(); j.a(g, "mouseup", c); j.a(g, "touchend", c); j.a(g, "touchcancel", c)}}l.Dd = function(a){if (a === i)return f; f = a & 2 || a & 1; h()}; l.Dc = function(a){if (a === i)return!d; d = a?0:3; h()}; l.cb = a = j.nb(a); var m = b.sd(y(a)); if (m)p = m.shift(); n(r, function(a){e.push(p + a)}); q = Z(" ", e); e.unshift(""); j.a(a, "mousedown", o); j.a(a, "touchstart", o)}j.Yd = function(a){return new Db(a)}; j.J = w; j.rb = m("overflow"); j.z = m("top", 2); j.v = m("left", 2); j.j = m("width", 2); j.m = m("height", 2); j.Lb = m("marginLeft", 2); j.bc = m("marginTop", 2); j.C = m("position"); j.M = m("display"); j.A = m("zIndex", 1); j.Tb = function(b, a, c){if (a != i)Cb(b, a, c); else return Ab(b)}; j.Kb = function(a, b){if (b != i)a.style.cssText = b; else return a.style.cssText}; j.Sd = function(b, a){if (a === i){a = w(b, "backgroundImage") || ""; var c = /\burl\s*\(\s*["']?([^"'\r\n,]+)["']?\s*\)/gi.exec(a) || []; return c[1]}w(b, "backgroundImage", a?"url('" + a + "')":"")}; var R = {lb:j.Tb, l:j.z, k:j.v, Hb:j.j, Gb:j.m, jb:j.C, gf:j.M, hb:j.A}; function x(f, l){var e = tb(), b = J(), d = rb(), g = K(f); function k(b, d, a){var e = b.bb(u( - d / 2, - a / 2)), f = b.bb(u(d / 2, - a / 2)), g = b.bb(u(d / 2, a / 2)), h = b.bb(u( - d / 2, a / 2)); b.bb(u(300, 300)); return u(c.min(e.x, f.x, g.x, h.x) + d / 2, c.min(e.y, f.y, g.y, h.y) + a / 2)}function a(d, a){a = a || {}; var n = a.E || 0, p = (a.N || 0) % 360, q = (a.O || 0) % 360, u = (a.R || 0) % 360, l = a.o, m = a.s, f = a.ff; if (l == i)l = 1; if (m == i)m = 1; if (f == i)f = 1; if (e){n = 0; p = 0; q = 0; f = 0}var c = new zb(a.S, a.ab, n); c.N(p); c.O(q); c.Jd(u); c.Hd(a.vb, a.xb); c.uc(l, m, f); if (b){c.gb(a.p, a.n); d.style[g] = c.Ed()} else if (!Y || Y < 9){var o = "", h = {x:0, y:0}; if (a.H)h = k(c, a.H, a.Z); j.bc(d, h.y); j.Lb(d, h.x); o = c.Xd(); var s = d.style.filter, t = new RegExp(/[\s]*progid:DXImageTransform\.Microsoft\.Matrix\([^\)]*\)/g), r = H(s, [t], o); pb(d, r)}}x = function(e, c){c = c || {}; var g = c.p, k = c.n, f; n(R, function(a, b){f = c[b]; f !== i && a(e, f)}); j.yd(e, c.c); if (!b){g != i && j.v(e, (c.Pc || 0) + g); k != i && j.z(e, (c.gd || 0) + k)}if (c.Fd)if (d)nb(j.eb(h, M, e, c)); else a(e, c)}; j.sb = M; if (d)j.sb = x; if (e)j.sb = a; else if (!b)a = M; j.L = x; x(f, l)}j.sb = x; j.L = x; function zb(j, k, o){var d = this, b = [1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, j || 0, k || 0, o || 0, 1], i = c.sin, g = c.cos, l = c.tan; function f(a){return a * c.PI / 180}function n(a, b){return{x:a, y:b}}function m(c, e, l, m, o, r, t, u, w, z, A, C, E, b, f, k, a, g, i, n, p, q, s, v, x, y, B, D, F, d, h, j){return[c * a + e * p + l * x + m * F, c * g + e * q + l * y + m * d, c * i + e * s + l * B + m * h, c * n + e * v + l * D + m * j, o * a + r * p + t * x + u * F, o * g + r * q + t * y + u * d, o * i + r * s + t * B + u * h, o * n + r * v + t * D + u * j, w * a + z * p + A * x + C * F, w * g + z * q + A * y + C * d, w * i + z * s + A * B + C * h, w * n + z * v + A * D + C * j, E * a + b * p + f * x + k * F, E * g + b * q + f * y + k * d, E * i + b * s + f * B + k * h, E * n + b * v + f * D + k * j]}function e(c, a){return m.apply(h, (a || b).concat(c))}d.uc = function(a, c, d){if (a != 1 || c != 1 || d != 1)b = e([a, 0, 0, 0, 0, c, 0, 0, 0, 0, d, 0, 0, 0, 0, 1])}; d.gb = function(a, c, d){b[12] += a || 0; b[13] += c || 0; b[14] += d || 0}; d.N = function(c){if (c){a = f(c); var d = g(a), h = i(a); b = e([1, 0, 0, 0, 0, d, h, 0, 0, - h, d, 0, 0, 0, 0, 1])}}; d.O = function(c){if (c){a = f(c); var d = g(a), h = i(a); b = e([d, 0, - h, 0, 0, 1, 0, 0, h, 0, d, 0, 0, 0, 0, 1])}}; d.Jd = function(c){if (c){a = f(c); var d = g(a), h = i(a); b = e([d, h, 0, 0, - h, d, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1])}}; d.Hd = function(a, c){if (a || c){j = f(a); k = f(c); b = e([1, l(k), 0, 0, l(j), 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1])}}; d.bb = function(c){var a = e(b, [1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, c.x, c.y, 0, 1]); return n(a[12], a[13])}; d.Ed = function(){return"matrix3d(" + b.join(",") + ")"}; d.Xd = function(){return"progid:DXImageTransform.Microsoft.Matrix(M11=" + b[0] + ", M12=" + b[4] + ", M21=" + b[1] + ", M22=" + b[5] + ", SizingMethod='auto expand')"}}new function(){var a = this; function b(d, g){for (var j = d[0].length, i = d.length, h = g[0].length, f = [], c = 0; c < i; c++)for (var k = f[c] = [], b = 0; b < h; b++){for (var e = 0, a = 0; a < j; a++)e += d[c][a] * g[a][b]; k[b] = e}return f}a.o = function(b, c){return a.kd(b, c, 0)}; a.s = function(b, c){return a.kd(b, 0, c)}; a.kd = function(a, c, d){return b(a, [[c, 0], [0, d]])}; a.bb = function(d, c){var a = b(d, [[c.x], [c.y]]); return u(a[0][0], a[1][0])}}; var N = {Pc:0, gd:0, p:0, n:0, db:1, o:1, s:1, R:0, N:0, O:0, S:0, ab:0, E:0, vb:0, xb:0}; j.Ld = function(c, d){var a = c || {}; if (c)if (b.wc(c))a = {G:a}; else if (b.wc(c.c))a.c = {G:c.c}; a.G = a.G || d; if (a.c)a.c.G = a.c.G || d; return a}; j.Md = function(l, m, x, q, z, A, n){var a = m; if (l){a = {}; for (var g in m){var B = A[g] || 1, w = z[g] || [0, 1], f = (x - w[0]) / w[1]; f = c.min(c.max(f, 0), 1); f = f * B; var u = c.floor(f); if (f != u)f -= u; var j = q.G || d.id, k, C = l[g], o = m[g]; if (b.ze(o)){j = q[g] || j; var y = j(f); k = C + o * y} else{k = b.V({Fb:{}}, l[g]); var v = q[g] || {}; b.f(o.Fb || o, function(d, a){j = v[a] || v.G || j; var c = j(f), b = d * c; k.Fb[a] = b; k[a] += b})}a[g] = k}var t = b.f(m, function(b, a){return N[a] != i}); t && b.f(N, function(c, b){if (a[b] == i && l[b] !== i)a[b] = l[b]}); if (t){if (a.db)a.o = a.s = a.db; a.H = n.H; a.Z = n.Z; a.Fd = e}}if (m.c && n.gb){var p = a.c.Fb, s = (p.l || 0) + (p.u || 0), r = (p.k || 0) + (p.B || 0); a.k = (a.k || 0) + r; a.l = (a.l || 0) + s; a.c.k -= r; a.c.B -= r; a.c.l -= s; a.c.u -= s}if (a.c && b.vd() && !a.c.l && !a.c.k && !a.c.n && !a.c.p && a.c.B == n.H && a.c.u == n.Z)a.c = h; return a}}; function m(){var a = this, d = []; function i(a, b){d.push({Ub:a, Zb:b})}function h(a, c){b.f(d, function(b, e){b.Ub == a && b.Zb === c && d.splice(e, 1)})}a.pb = a.addEventListener = i; a.removeEventListener = h; a.i = function(a){var c = [].slice.call(arguments, 1); b.f(d, function(b){b.Ub == a && b.Zb.apply(f, c)})}}var l = function(z, E, g, K, N, M){z = z || 0; var a = this, q, o, p, u, B = 0, H, I, G, C, y = 0, j = 0, m = 0, F, l, i, d, n, D, w = [], x; function P(a){i += a; d += a; l += a; j += a; m += a; y += a}function t(p){var f = p; if (n)if (!D && (f >= d || f < i) || D && f >= n)f = ((f - i) % n + n) % n + i; if (!F || u || j != f){var h = c.min(f, d); h = c.max(h, i); if (!F || u || h != m){if (M){var k = (h - l) / (E || 1); if (g.Zd)k = 1 - k; var o = b.Md(N, M, k, H, G, I, g); if (x)b.f(o, function(b, a){x[a] && x[a](K, b)}); else b.L(K, o)}a.Qb(m - l, h - l); var r = m, q = m = h; b.f(w, function(b, c){var a = f <= j?w[w.length - c - 1]:b; a.P(m - y)}); j = f; F = e; a.Db(r, q)}}}function A(a, b, e){b && a.Ob(d); if (!e){i = c.min(i, a.dd() + y); d = c.max(d, a.Nb() + y)}w.push(a)}var r = f.requestAnimationFrame || f.webkitRequestAnimationFrame || f.mozRequestAnimationFrame || f.msRequestAnimationFrame; if (b.ne() && b.vc() < 7)r = h; r = r || function(a){b.tc(a, g.Sc)}; function J(){if (q){var d = b.Q(), e = c.min(d - B, g.Tc), a = j + e * p; B = d; if (a * p >= o * p)a = o; t(a); if (!u && a * p >= o * p)L(C); else r(J)}}function s(f, g, h){if (!q){q = e; u = h; C = g; f = c.max(f, i); f = c.min(f, d); o = f; p = o < j? - 1:1; a.Vc(); B = b.Q(); r(J)}}function L(b){if (q){u = q = C = k; a.Zc(); b && b()}}a.cd = function(a, b, c){s(a?j + a:d, b, c)}; a.fd = s; a.W = L; a.zd = function(a){s(a)}; a.I = function(){return j}; a.jd = function(){return o}; a.qb = function(){return m}; a.P = t; a.gb = function(a){t(j + a)}; a.Uc = function(){return q}; a.Ud = function(a){n = a}; a.Ob = P; a.bd = function(a, b){A(a, 0, b)}; a.Rb = function(a){A(a, 1)}; a.dd = function(){return i}; a.Nb = function(){return d}; a.Db = a.Vc = a.Zc = a.Qb = b.Oc; a.Wb = b.Q(); g = b.V({Sc:16, Tc:50}, g); n = g.Xb; D = g.Kd; x = g.Nd; i = l = z; d = z + E; I = g.Qd || {}; G = g.Td || {}; H = b.Ld(g.ob)}; new (function(){}); var j = function(p, fc){var o = this; function Bc(){var a = this; l.call(a, - 1e8, 2e8); a.le = function(){var b = a.qb(), d = c.floor(b), f = t(d), e = b - c.floor(b); return{T:f, ie:d, jb:e}}; a.Db = function(b, a){var d = c.floor(a); if (d != a && a > b)d++; Tb(d, e); o.i(j.he, t(a), t(b), a, b)}}function Ac(){var a = this; l.call(a, 0, 0, {Xb:r}); b.f(A, function(b){D & 1 && b.Ud(r); a.Rb(b); b.Ob(kb / bc)})}function zc(){var a = this, b = Ub.cb; l.call(a, - 1, 2, {ob:d.id, Nd:{jb:Zb}, Xb:r}, b, {jb:1}, {jb: - 2}); a.wb = b}function mc(n, m){var b = this, d, f, g, i, c; l.call(b, - 1e8, 2e8, {Tc:100}); b.Vc = function(){O = e; R = h; o.i(j.ge, t(w.I()), w.I())}; b.Zc = function(){O = k; i = k; var a = w.le(); o.i(j.fe, t(w.I()), w.I()); !a.jb && Dc(a.ie, s)}; b.Db = function(j, h){var b; if (i)b = c; else{b = f; if (g){var e = h / g; b = a.He(e) * (f - d) + d}}w.P(b)}; b.Ab = function(a, e, c, h){d = a; f = e; g = c; w.P(a); b.P(0); b.fd(c, h)}; b.Ge = function(a){i = e; c = a; b.cd(a, h, e)}; b.Ue = function(a){c = a}; w = new Bc; w.bd(n); w.bd(m)}function oc(){var c = this, a = Xb(); b.A(a, 0); b.J(a, "pointerEvents", "none"); c.cb = a; c.yb = function(){b.K(a); b.Fc(a)}}function xc(n, f){var d = this, q, N, v, i, y = [], x, C, W, H, S, F, g, w, p; l.call(d, - u, u + 1, {}); function E(a){q && q.Xc(); T(n, a, 0); F = e; q = new J.Y(n, J, b.qd(b.g(n, "idle")) || lc, !I); q.P(0)}function Z(){q.Wb < J.Wb && E()}function O(p, r, n){if (!H){H = e; if (i && n){var g = n.width, c = n.height, m = g, l = c; if (g && c && a.ib){if (a.ib & 3 && (!(a.ib & 4) || g > L || c > K)){var h = k, q = L / K * c / g; if (a.ib & 1)h = q > 1; else if (a.ib & 2)h = q < 1; m = h?g * K / c:L; l = h?K:c * L / g}b.j(i, m); b.m(i, l); b.z(i, (K - l) / 2); b.v(i, (L - m) / 2)}b.C(i, "absolute"); o.i(j.Oe, f)}}b.K(r); p && p(d)}function Y(b, c, e, g){if (g == R && s == f && I)if (!Cc){var a = t(b); B.ye(a, f, c, d, e); c.Me(); U.Ob(a - U.dd() - 1); U.P(a); z.Ab(b, b, 0)}}function bb(b){if (b == R && s == f){if (!g){var a = h; if (B)if (B.T == f)a = B.oe(); else B.yb(); Z(); g = new vc(n, f, a, q); g.Qc(p)}!g.Uc() && g.Mb()}}function G(e, i, l){if (e == f){if (e != i)A[i] && A[i].Rc(); else!l && g && g.Pe(); p && p.Dc(); var m = R = b.Q(); d.fb(b.eb(h, bb, m))} else{var k = c.min(f, e), j = c.max(f, e), o = c.min(j - k, k + r - j), n = u + a.Re - 1; (!S || o <= n) && d.fb()}}function db(){if (s == f && g){g.W(); p && p.Ie(); p && p.Ke(); g.ad()}}function eb(){s == f && g && g.W()}function ab(a){!P && o.i(j.Ne, f, a)}function Q(){p = w.pInstance; g && g.Qc(p)}d.fb = function(c, a){a = a || v; if (y.length && !H){b.mb(a); if (!W){W = e; o.i(j.Se, f); b.f(y, function(a){if (!b.kb(a, "src")){a.src = b.g(a, "src2") || ""; b.M(a, a["display-origin"])}})}b.Bd(y, i, b.eb(h, O, c, a))} else O(c, a)}; d.Te = function(){var j = f; if (a.md < 0)j -= r; var e = j + a.md * tc; if (D & 2)e = t(e); if (!(D & 1) && !ib)e = c.max(0, c.min(e, r - u)); if (e != f){if (B){var g = B.Ee(r); if (g){var k = R = b.Q(), i = A[t(e)]; return i.fb(b.eb(h, Y, e, i, g, k), v)}}cb(e)} else if (a.Yb){d.Rc(); G(f, f)}}; d.ac = function(){G(f, f, e)}; d.Rc = function(){p && p.Ie(); p && p.Ke(); d.Kc(); g && g.ce(); g = h; E()}; d.Me = function(){b.K(n)}; d.Kc = function(){b.mb(n)}; d.Je = function(){p && p.Dc()}; function T(a, c, d){if (b.kb(a, "jssor-slider"))return; if (!F){if (a.tagName == "IMG"){y.push(a); if (!b.kb(a, "src")){S = e; a["display-origin"] = b.M(a); b.K(a)}}var f = b.Sd(a); if (f){var g = new Image; b.g(g, "src2", f); y.push(g)}if (d){b.A(a, (b.A(a) || 0) + 1); b.bc(a, b.bc(a) || 0); b.Lb(a, b.Lb(a) || 0); b.sb(a, {E:0})}}var h = b.Cb(a); b.f(h, function(f){var h = f.tagName, j = b.g(f, "u"); if (j == "player" && !w){w = f; if (w.pInstance)Q(); else b.a(w, "dataavailable", Q)}if (j == "caption"){if (c){b.Bc(f, b.g(f, "to")); b.ve(f, b.g(f, "bf")); b.g(f, "3d") && b.ue(f, "preserve-3d")} else if (!b.nd()){var g = b.ub(f, k, e); b.Jb(g, f, a); b.Bb(f, a); f = g; c = e}} else if (!F && !d && !i){if (h == "A"){if (b.g(f, "u") == "image")i = b.Qe(f, "IMG"); else i = b.q(f, "image", e); if (i){x = f; b.M(x, "block"); b.L(x, V); C = b.ub(x, e); b.C(x, "relative"); b.Tb(C, 0); b.J(C, "backgroundColor", "#000")}} else if (h == "IMG" && b.g(f, "u") == "image")i = f; if (i){i.border = 0; b.L(i, V)}}T(f, c, d + 1)})}d.Qb = function(c, b){var a = u - b; Zb(N, a)}; d.T = f; m.call(d); b.te(n, b.g(n, "p")); b.se(n, b.g(n, "po")); var M = b.q(n, "thumb", e); if (M){d.Ve = b.ub(M); b.K(M)}b.mb(n); v = b.ub(gb); b.A(v, 1e3); b.a(n, "click", ab); E(e); d.Nc = i; d.Wc = C; d.wb = N = n; b.D(N, v); o.pb(203, G); o.pb(28, eb); o.pb(24, db)}function vc(y, f, p, q){var a = this, m = 0, u = 0, g, h, d, c, i, t, r, n = A[f]; l.call(a, 0, 0); function v(){b.Fc(N); cc && i && n.Wc && b.D(N, n.Wc); b.mb(N, !i && n.Nc)}function w(){a.Mb()}function x(b){r = b; a.W(); a.Mb()}a.Mb = function(){var b = a.qb(); if (!C && !O && !r && s == f){if (!b){if (g && !i){i = e; a.ad(e); o.i(j.Fe, f, m, u, g, c)}v()}var k, p = j.hd; if (b != c)if (b == d)k = c; else if (b == h)k = d; else if (!b)k = h; else k = a.jd(); o.i(p, f, b, m, h, d, c); var l = I && (!E || F); if (b == c)(d != c && !(E & 12) || l) && n.Te(); else(l || b != d) && a.fd(k, w)}}; a.Pe = function(){d == c && d == a.qb() && a.P(h)}; a.ce = function(){B && B.T == f && B.yb(); var b = a.qb(); b < c && o.i(j.hd, f, - b - 1, m, h, d, c)}; a.ad = function(a){p && b.rb(lb, a && p.oc.We?"":"hidden")}; a.Qb = function(b, a){if (i && a >= g){i = k; v(); n.Kc(); B.yb(); o.i(j.Ae, f, m, u, g, c)}o.i(j.Be, f, a, m, h, d, c)}; a.Qc = function(a){if (a && !t){t = a; a.pb($JssorPlayer$.Cd, x)}}; p && a.Rb(p); g = a.Nb(); a.Rb(q); h = g + q.qc; c = a.Nb(); d = I?g + q.yc:c}function Kb(a, c, d){b.v(a, c); b.z(a, d)}function Zb(c, b){var a = x > 0?x:fb, d = zb * b * (a & 1), e = Ab * b * (a >> 1 & 1); Kb(c, d, e)}function Pb(){qb = O; Ib = z.jd(); G = w.I()}function gc(){Pb(); if (C || !F && E & 12){z.W(); o.i(j.De)}}function ec(f){if (!C && (F || !(E & 12)) && !z.Uc()){var d = w.I(), b = c.ceil(G); if (f && c.abs(H) >= a.Mc){b = c.ceil(d); b += jb}if (!(D & 1))b = c.min(r - u, c.max(b, 0)); var e = c.abs(b - d); e = 1 - c.pow(1 - e, 5); if (!P && qb)z.zd(Ib); else if (d == b){tb.Je(); tb.ac()} else z.Ab(d, b, e * Vb)}}function Hb(a){!b.g(b.Vb(a), "nodrag") && b.Eb(a)}function rc(a){Yb(a, 1)}function Yb(a, c){a = b.rc(a); var i = b.Vb(a); if (!M && !b.g(i, "nodrag") && sc() && (!c || a.touches.length == 1)){C = e; yb = k; R = h; b.a(g, c?"touchmove":"mousemove", Bb); b.Q(); P = 0; gc(); if (!qb)x = 0; if (c){var f = a.touches[0]; ub = f.clientX; vb = f.clientY} else{var d = b.xc(a); ub = d.x; vb = d.y}H = 0; hb = 0; jb = 0; o.i(j.Ce, t(G), G, a)}}function Bb(d){if (C){d = b.rc(d); var f; if (d.type != "mousemove"){var l = d.touches[0]; f = {x:l.clientX, y:l.clientY}} else f = b.xc(d); if (f){var j = f.x - ub, k = f.y - vb; if (c.floor(G) != G)x = x || fb & M; if ((j || k) && !x){if (M == 3)if (c.abs(k) > c.abs(j))x = 2; else x = 1; else x = M; if (ob && x == 1 && c.abs(k) - c.abs(j) > 3)yb = e}if (x){var a = k, i = Ab; if (x == 1){a = j; i = zb}if (!(D & 1)){if (a > 0){var g = i * s, h = a - g; if (h > 0)a = g + c.sqrt(h) * 5}if (a < 0){var g = i * (r - u - s), h = - a - g; if (h > 0)a = - g - c.sqrt(h) * 5}}if (H - hb < - 2)jb = 0; else if (H - hb > 2)jb = - 1; hb = H; H = a; sb = G - H / i / (Y || 1); if (H && x && !yb){b.Eb(d); if (!O)z.Ge(sb); else z.Ue(sb)}}}}}function bb(){qc(); if (C){C = k; b.Q(); b.F(g, "mousemove", Bb); b.F(g, "touchmove", Bb); P = H; z.W(); var a = w.I(); o.i(j.de, t(a), a, t(G), G); E & 12 && Pb(); ec(e)}}function jc(c){if (P){b.me(c); var a = b.Vb(c); while (a && v !== a){a.tagName == "A" && b.Eb(c); try{a = a.parentNode} catch (d){break}}}}function Jb(a){A[s]; s = t(a); tb = A[s]; Tb(a); return s}function Dc(a, b){x = 0; Jb(a); o.i(j.xe, t(a), b)}function Tb(a, c){wb = a; b.f(S, function(b){b.lc(t(a), a, c)})}function sc(){var b = j.zc || 0, a = X; if (ob)a & 1 && (a &= 1); j.zc |= a; return M = a & ~b}function qc(){if (M){j.zc &= ~X; M = 0}}function Xb(){var a = b.X(); b.L(a, V); b.C(a, "absolute"); return a}function t(a){return(a % r + r) % r}function kc(b, d){if (d)if (!D){b = c.min(c.max(b + wb, 0), r - u); d = k} else if (D & 2){b = t(b + wb); d = k}cb(b, a.cc, d)}function xb(){b.f(S, function(a){a.ic(a.zb.ef <= F)})}function hc(){if (!F){F = 1; xb(); if (!C){E & 12 && ec(); E & 3 && A[s] && A[s].ac()}}}function Ec(){if (F){F = 0; xb(); C || !(E & 12) || gc()}}function ic(){V = {Hb:L, Gb:K, l:0, k:0}; b.f(T, function(a){b.L(a, V); b.C(a, "absolute"); b.rb(a, "hidden"); b.K(a)}); b.L(gb, V)}function ab(b, a){cb(b, a, e)}function cb(g, f, l){if (Rb && (!C && (F || !(E & 12)) || a.Ec)){O = e; C = k; z.W(); if (f == i)f = Vb; var d = Cb.qb(), b = g; if (l){b = d + g; if (g > 0)b = c.ceil(b); else b = c.floor(b)}if (D & 2)b = t(b); if (!(D & 1))b = c.max(0, c.min(b, r - u)); var j = (b - d) % r; b = d + j; var h = d == b?0:f * c.abs(j); h = c.min(h, f * u * 1.5); z.Ab(d, b, h || 1)}}o.pe = cb; o.cd = function(){if (!I){I = e; A[s] && A[s].ac()}}; o.od = function(){return P}; function W(){return b.j(y || p)}function nb(){return b.m(y || p)}o.H = W; o.Z = nb; function Eb(c, d){if (c == i)return b.j(p); if (!y){var a = b.X(g); b.Lc(a, b.Lc(p)); b.Kb(a, b.Kb(p)); b.M(a, "block"); b.C(a, "relative"); b.z(a, 0); b.v(a, 0); b.rb(a, "visible"); y = b.X(g); b.C(y, "absolute"); b.z(y, 0); b.v(y, 0); b.j(y, b.j(p)); b.m(y, b.m(p)); b.Bc(y, "0 0"); b.D(y, a); var h = b.Cb(p); b.D(p, y); b.J(p, "backgroundImage", ""); b.f(h, function(c){b.D(b.g(c, "noscale")?p:a, c); b.g(c, "autocenter") && Lb.push(c)})}Y = c / (d?b.m:b.j)(y); b.re(y, Y); var f = d?Y * W():c, e = d?c:Y * nb(); b.j(p, f); b.m(p, e); b.f(Lb, function(a){var c = b.rd(b.g(a, "autocenter")); b.wd(a, c)})}o.Ad = Eb; o.Jc = function(a){var d = c.ceil(t(kb / bc)), b = t(a - s + d); if (b > u){if (a - s > r / 2)a -= r; else if (a - s <= - r / 2)a += r} else a = s + b - d; return a}; m.call(o); o.cb = p = b.nb(p); var a = b.V({ib:0, Re:1, fc:1, gc:0, hc:k, Yb:1, tb:e, Ec:e, md:1, Ic:3e3, Hc:1, cc:500, He:d.Id, Mc:20, Gc:0, U:1, mc:0, pd:1, nc:1, Cc:1}, fc); a.tb = a.tb && b.we(); if (a.Wd != i)a.Ic = a.Wd; if (a.Vd != i)a.mc = a.Vd; var fb = a.nc & 3, tc = (a.nc & 4) / - 4 || 1, mb = a.Ze, J = b.V({Y:q, tb:a.tb}, a.df); J.Sb = J.Sb || J.cf; var Fb = a.bf, Z = a.af, eb = a.Rd, Q = !a.pd, y, v = b.q(p, "slides", Q), gb = b.q(p, "loading", Q) || b.X(g), Nb = b.q(p, "navigator", Q), dc = b.q(p, "arrowleft", Q), ac = b.q(p, "arrowright", Q), Mb = b.q(p, "thumbnavigator", Q), pc = b.j(v), nc = b.m(v), V, T = [], uc = b.Cb(v); b.f(uc, function(a){a.tagName == "DIV" && !b.g(a, "u") && T.push(a); b.A(a, (b.A(a) || 0) + 1)}); var s = - 1, wb, tb, r = T.length, L = a.be || pc, K = a.Od || nc, Wb = a.Gc, zb = L + Wb, Ab = K + Wb, bc = fb & 1?zb:Ab, u = c.min(a.U, r), lb, x, M, yb, S = [], Qb, Sb, Ob, cc, Cc, I, E = a.Hc, lc = a.Ic, Vb = a.cc, rb, ib, kb, Rb = u < r, D = Rb?a.Yb:0, X, P, F = 1, O, C, R, ub = 0, vb = 0, H, hb, jb, Cb, w, U, z, Ub = new oc, Y, Lb = []; if (r){if (a.tb)Kb = function(a, c, d){b.sb(a, {S:c, ab:d})}; I = a.hc; o.zb = fc; ic(); b.kb(p, "jssor-slider", e); b.A(v, b.A(v) || 0); b.C(v, "absolute"); lb = b.ub(v, e); b.Jb(lb, v); if (mb){cc = mb.Ye; rb = mb.Y; ib = u == 1 && r > 1 && rb && (!b.nd() || b.vc() >= 8)}kb = ib || u >= r || !(D & 1)?0:a.mc; X = (u > 1 || kb?fb: - 1) & a.Cc; var Gb = v, A = [], B, N, Db = b.ke(), ob = Db.je, G, qb, Ib, sb; Db.ld && b.J(Gb, Db.ld, ([h, "pan-y", "pan-x", "none"])[X] || ""); U = new zc; if (ib)B = new rb(Ub, L, K, mb, ob); b.D(lb, U.wb); b.rb(v, "hidden"); N = Xb(); b.J(N, "backgroundColor", "#000"); b.Tb(N, 0); b.Jb(N, Gb.firstChild, Gb); for (var db = 0; db < T.length; db++){var wc = T[db], yc = new xc(wc, db); A.push(yc)}b.K(gb); Cb = new Ac; z = new mc(Cb, U); b.a(v, "click", jc, e); b.a(p, "mouseout", b.Pb(hc, p)); b.a(p, "mouseover", b.Pb(Ec, p)); if (X){b.a(v, "mousedown", Yb); b.a(v, "touchstart", rc); b.a(v, "dragstart", Hb); b.a(v, "selectstart", Hb); b.a(g, "mouseup", bb); b.a(g, "touchend", bb); b.a(g, "touchcancel", bb); b.a(f, "blur", bb)}E &= ob?10:5; if (Nb && Fb){Qb = new Fb.Y(Nb, Fb, W(), nb()); S.push(Qb)}if (Z && dc && ac){Z.Yb = D; Z.U = u; Sb = new Z.Y(dc, ac, Z, W(), nb()); S.push(Sb)}if (Mb && eb){eb.gc = a.gc; Ob = new eb.Y(Mb, eb); S.push(Ob)}b.f(S, function(a){a.dc(r, A, gb); a.pb(n.Ac, kc)}); b.J(p, "visibility", "visible"); Eb(W()); xb(); a.fc && b.a(g, "keydown", function(b){if (b.keyCode == 37)ab( - a.fc); else b.keyCode == 39 && ab(a.fc)}); var pb = a.gc; if (!(D & 1))pb = c.max(0, c.min(pb, r - u)); z.Ab(pb, pb, 0)}}; j.Ne = 21; j.Ce = 22; j.de = 23; j.ge = 24; j.fe = 25; j.Se = 26; j.Oe = 27; j.De = 28; j.he = 202; j.xe = 203; j.Fe = 206; j.Ae = 207; j.Be = 208; j.hd = 209; var n = {Ac:1}; var p = function(g, B){var i = this, z, p, a, v = [], x, w, d, q, r, u, t, o, s, f, l; m.call(i); g = b.nb(g); function A(o, f){var g = this, c, m, k; function q(){m.Dd(p == f)}function j(e){if (e || !s.od()){var a = d - f % d, b = s.Jc((f + a) / d - 1), c = b * d + d - a; i.i(n.Ac, c)}}g.T = f; g.Yc = q; k = o.Ve || o.Nc || b.X(); g.wb = c = b.Pd(l, "thumbnailtemplate", k, e); m = b.Yd(c); a.kc & 1 && b.a(c, "click", b.eb(h, j, 0)); a.kc & 2 && b.a(c, "mouseover", b.Pb(b.eb(h, j, 1), c))}i.lc = function(b, e, f){var a = p; p = b; a != - 1 && v[a].Yc(); v[b].Yc(); !f && s.pe(s.Jc(c.floor(e / d)))}; i.ic = function(a){b.mb(g, a)}; var y; i.dc = function(D, C){if (!y){z = D; c.ceil(z / d); p = - 1; o = c.min(o, C.length); var h = a.Ib & 1, m = u + (u + q) * (d - 1) * (1 - h), l = t + (t + r) * (d - 1) * h, B = m + (m + q) * (o - 1) * h, n = l + (l + r) * (o - 1) * (1 - h); b.C(f, "absolute"); b.rb(f, "hidden"); a.ed & 1 && b.v(f, (x - B) / 2); a.ed & 2 && b.z(f, (w - n) / 2); b.j(f, B); b.m(f, n); var i = []; b.f(C, function(l, g){var j = new A(l, g), e = j.wb, a = c.floor(g / d), k = g % d; b.v(e, (u + q) * k * (1 - h)); b.z(e, (t + r) * k * h); if (!i[a]){i[a] = b.X(); b.D(f, i[a])}b.D(i[a], e); v.push(j)}); var E = b.V({hc:k, Ec:k, be:m, Od:l, Gc:q * h + r * (1 - h), Mc:12, cc:200, Hc:1, nc:a.Ib, Cc:a.ae || a.Xe?0:a.Ib}, a); s = new j(g, E); y = e}}; i.zb = a = b.V({jc:0, ec:0, U:1, Ib:1, ed:3, kc:1}, B); x = b.j(g); w = b.m(g); f = b.q(g, "slides", e); l = b.q(f, "prototype"); u = b.j(l); t = b.m(l); b.Bb(l, f); d = a.ud || 1; q = a.jc; r = a.ec; o = a.U; a.uc == k && b.kb(g, "noscale", e)}; function q(e, d, c){var a = this; l.call(a, 0, c); a.Xc = b.Oc; a.qc = 0; a.yc = c}jssor_1_slider_init = function(){var g = {hc:e, Rd:{Y:p, U:5, jc:1, ec:1, mc:0, ae:e}}, d = new j("jssor_1", g); function a(){var b = d.cb.parentNode.clientWidth; if (b){b = c.min(b, 600); d.Ad(b)} else f.setTimeout(a, 30)}a(); b.a(f, "load", a); b.a(f, "resize", a); b.a(f, "orientationchange", a)}})(window, document, Math, null, true, false)
            </script>
        </head>

        <body class="index-page signin" ng-app="frontEnd" ng-controller="eventClt">
        <!--page loader-->
                <!--<div class="se-pre-con"></div>-->
        <!--page loader-->
        <div growl></div>
        <?php include 'include/navbar.php';?>
        <?php echo $cms->FbSocialScript(); ?>
        <!-- Navbar -->
        <div class="wrapper">
            <!-- main content part starts here -->
            <div class="main" style="background-color: transparent; margin-top:40px;">


                <!-- Carousel Starts Here -->
                <div class="container-fluid" id="checkout_top_banner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-30 text-center" style="padding-left:0px!important; padding-right: 0px!important;">

                            <div id="hitw-parent">
                                <div id="hitw-iland">
                                	<h2 style="color:#ffffff !important;"><strong class="text-uppercase">Host
                                    <span id="magic-tags"></span></strong>
                                    <br/>
                                    <small style="color:#ffffff !important; font-weight:bolder !important;">With Ticketchai</small>
                                    
                                    </h1>
                                    
                                    <br/>
                                    <a href="<?php echo $cms->baseUrl(" ../merchant-dashboard/login.php?ref='ok'"); ?>" class="btn btn-danger btn-raised glow waves-effect waves-light">
                                        <strong style="font-size:14px; letter-spacing: 1.2px;">
                                        <!--<i class="material-icons">launch</i>-->
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Create event - it's Free
                                        </strong>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Ends Here -->
                <!-- Customers LogIn section starts here -->
                <div class="section-simple2">
                    <!-- Top image field start here -->
                    <div class="container">
                        <div class="row" style="margin-top:10px !important;">

                            <h3 class="text-center" style="margin-top: 45px;">How Ticketchai works</h3>
                            <!-- Slider start-->
                            <div class="how-itwork-content">
                                
                                
                                <!--navbar  for mobile view [start]--> 
                                <ul  class="nav nav-pills text-center nav-pills-success hidden-lg" id="smallNav" role="tablist">
                                    <li class="active smallNavLi">
                                        <a href="#createEvent" role="tab" data-toggle="tab" class="smallNavLia">
                                            <span class="label label-primary">Step 1</span>
                                        </a>
                                    </li>
                                    
                                    <li class="smallNavLi">
                                        <a href="#createTicket" role="tab" data-toggle="tab" class="smallNavLia">
                                            <span class="label label-primary">Step 2</span>
                                        </a>
                                    </li>
                                    
                                    <li class="smallNavLi">
                                        <a href="#customEvent" role="tab" data-toggle="tab" class="smallNavLia">
                                            <span class="label label-primary">Step 3</span>
                                        </a>
                                    </li>
                                    
                                    <li class="smallNavLi">
                                        <a href="#startSelling" role="tab" data-toggle="tab" class="smallNavLia">
                                            <span class="label label-primary">Step 4</span>
                                        </a>
                                    </li>
                                    
                                    <li class="smallNavLi">
                                        <a href="#manage" role="tab" data-toggle="tab" smallNavLia>
                                            <span class="label label-primary">Step 5</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--navbar  for mobile view [end]-->
                                
                                <!--<ul class="bigmenu_ul nav nav-pills text-center nav-pills-success hidden-md hidden-sm hidden-xs" role="tablist">-->
                                <ul class="nav bigmenu_ul nav-pills text-center nav-pills-success hidden-md hidden-sm hidden-xs" role="tablist">
                                    <li class="active bigmenu_ul_li">
                                        <a class="bigmenu_ul_li_a"  href="#createEvent" role="tab" data-toggle="tab">
                                            <span>01</span>
                                            <i class="fa fa-calendar-check-o"></i>
                                            CREATE EVENT
                                        </a>
                                    </li>
                                    <li class="bigmenu_ul_li">
                                        <a class="bigmenu_ul_li_a" href="#createTicket" role="tab" data-toggle="tab">
                                            <span>02</span>
                                            <i class="fa fa-ticket"></i>
                                            CREATE TICKETS
                                        </a>
                                    </li>
                                    <li class="bigmenu_ul_li">
                                        <a class="bigmenu_ul_li_a" href="#customEvent" role="tab" data-toggle="tab">
                                            <span>03</span>
                                            <i class="fa fa-paint-brush"></i>
                                            CUSTOM EVENT
                                        </a>
                                    </li>
                                    <li class="bigmenu_ul_li">
                                        <a class="bigmenu_ul_li_a" href="#startSelling" role="tab" data-toggle="tab">
                                            <span>04</span>
                                            <i class="fa fa-usd"></i>
                                            START SELLING
                                        </a>
                                    </li>
                                    <li class="bigmenu_ul_li">
                                        <a class="bigmenu_ul_li_a" href="#manage" role="tab" data-toggle="tab">
                                            <span>05</span>
                                            <i class="fa fa-users"></i>
                                            MANAGE REGISTRATION
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="createEvent">
                                        <div class="">
                                            <div class="col-sm-4 col-xs-12 padding-none">
                                                <img class="img-responsive" src="tc-merchant-template/assets/img/hw/1.png" alt="Create Event Image" title="Create Event online"/>
                                            </div>
                                            <div class="col-sm-8 col-xs-12 ">
                                                <span class="col-sm-3 col-xs-12 text-center count">01</span>
                                                <div class="col-sm-9 col-xs-12 tabText">
                                                    <h3 class="tab-content-h tabTexth3" style="color:#337ab7;">Start With Your Event</h3>
                                                    <p class="tab-content-p tabTextp">Sign up and Create event by filling in your event details under a minute.<strong>It's easy and free</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="createTicket">
                                        <div class="">
                                            <div class="col-sm-4 col-xs-12 padding-none">
                                                <img class="img-responsive" src="tc-merchant-template/assets/img/hw/2.png" alt="Create Event Image" title="Create Event online"/>
                                            </div>
                                            <div class="col-sm-8 col-xs-12 ">
                                                <span class="col-sm-3 col-xs-12 text-center count">02</span>
                                                <div class="col-sm-9 col-xs-12 tabText">
                                                    <h3 class="tab-content-h tabTexth3" style="color:#337ab7;">Tickets Come Next!</h3>
                                                    <p class="tab-content-p tabTextp">Make different types of tickets like early bird, VIP, etc. Create custom attendee forms by asking multiple questions to understand your attendee better.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="customEvent">
                                        <div class="">
                                            <div class="col-sm-4 col-xs-12 padding-none">
                                                <img class="img-responsive" src="tc-merchant-template/assets/img/hw/3.png" alt="Create Event Image" title="Create Event online"/>
                                            </div>
                                            <div class="col-sm-8 col-xs-12 ">
                                                <span class="col-sm-3 col-xs-12 text-center count">03</span>
                                                <div class="col-sm-9 col-xs-12 tabText">
                                                    <h3 class="tab-content-h tabTexth3" style="color:#337ab7;">Make it look nice with Images & Content</h3>
                                                    <p class="tab-content-p tabTextp">Add event details, upload your event cover image, add your organisers profile and add your banking details. Offer Discounts.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="startSelling">
                                        <div class="">
                                            <div class="col-sm-4 col-xs-12 padding-none">
                                                <img class="img-responsive" src="tc-merchant-template/assets/img/hw/4.png" alt="Create Event Image" title="Create Event online"/>
                                            </div>
                                            <div class="col-sm-8 col-xs-12 ">
                                                <span class="col-sm-3 col-xs-12 text-center count">04</span>
                                                <div class="col-sm-9 col-xs-12 tabText">
                                                    <h3 class="tab-content-h tabTexth3" style="color:#337ab7;">Time to Sell those Tickets!</h3>
                                                    <p class="tab-content-p tabTextp">Make your event live and Share your event link to start selling your tickets. Accept payments online via debit card, credit card and internet banking.</p>
                                                    <br/>
                                                    <p class="tab-content-p tabTextp">You can also get TS Widget on your event website to accept payments directly on your website without redirecting them to us.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="manage">
                                        <div class="">
                                            <div class="col-sm-4 col-xs-12 padding-none">
                                                <img class="img-responsive" src="tc-merchant-template/assets/img/hw/5.png" alt="Create Event Image" title="Create Event online"/>
                                            </div>
                                            <div class="col-sm-8 col-xs-12 ">
                                                <span class="col-sm-3 col-xs-12 text-center count">05</span>
                                                <div class="col-sm-9 col-xs-12 tabText">
                                                    <h3 class="tab-content-h tabTexth3" style="color:#337ab7;">Manage Attendees, Refunds & a lot more</h3>
                                                    <p class="tab-content-p">Get a comprehensive list of your attendees and check revenues upfront.</p>
                                                    <br/>
                                                    <p class="tab-content-p tabTextp">Communicate and engage with your attendees directly from the dashboard, send them emails with a single click, manage refunds and cancellations.</p>
                                                    <a href="merchant-dashboard/login.php" class=" tabTextp btn btn-danger btn-raised glow waves-effect waves-light">
                                                        <strong style="font-size:14px; letter-spacing: 1.2px;color:white;">
                                                             GET STARTED - IT'S FREE
                                                        </strong>
                                                     </a>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slider end-->


                            <div class="clearfix"></div>
                            <!--Ticketchai Features starts-->
                            <section class="tcFreatures">
                                <div class="container text-center">
                                    <h3 class="text-center hidden-xs">Ticketchai Features</h3>
                                    <div class="row" style="margin-top:5%;">
                                        <div class="feature-warp">
                                            
                                            <script>
                                              var img1 = "tc-merchant-template/assets/img/cslg/3.png";
                                              var img2 = "tc-merchant-template/assets/img/cslg/4.png";
                                              var img3 = "tc-merchant-template/assets/img/cslg/1.png";
                                              var img4 = "tc-merchant-template/assets/img/cslg/3.png";
                                              var img5 = "tc-merchant-template/assets/img/cslg/2.png";
                                              var img6 = "tc-merchant-template/assets/img/cslg/3.png";
                                              
                                              function shownImage(src){
                                                  document.getElementById("showImage").src = src;
                                              }
                                            </script>
                                            
                                            <div class="col-sm-12 col-lg-6 col-lg-push-3 feature-preview hidden-xs">
                                                <img ng-src="tc-merchant-template/assets/img/cslg/3.png" class="img-responsive " id="showImage" alt="pagePreviewImage" title="pagePreview"/>
                                            </div>

                                            <div class="col-sm-6 col-lg-3 col-lg-pull-6 hidden-xs">
                                                <div class="left-feature-col" onmouseover="shownImage(img1)">
                                                    <i class="fa fa-file-text mr" style="background: #D01C68; border: 2px solid #D01C68; color: white;"></i>
                                                    <h4>Manage Events</h4>
                                                    <p>Check attendee list and ticket sales revenue upfront in your dashboard. Offer Discounts and more.</p>
                                                </div>

                                                <div class="left-feature-col"  onmouseover="shownImage(img2)">
                                                    <i class="fa fa-users crf" style="background: #683592; border: 2px solid #683592; color: white;"></i>
                                                    <h4>Custom Registration Forms</h4>
                                                    <p>Ask more questions with checkboxes, text forms and multiple choices. Know your guests better.</p>
                                                </div>

                                                <div class="left-feature-col"  onmouseover="shownImage(img3)">
                                                    <i class="fa fa-ticket tsw" style="background: #93C73C; border: 2px solid #93C73C; color: white;"></i>
                                                    <h4>Ticket Sale Widget</h4>
                                                    <p>Use our widget to accept payments directly on your website, no redirection to other pages.</p>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-lg-3 hidden-xs">
                                                <div class="left-feature-col"  onmouseover="shownImage(img4)">
                                                    <i class="fa fa-money fmc" style="background: #F9AC2E; border: 2px solid #F9AC2E; color: white;"></i>
                                                    <h4>Fastest Money Clearance</h4>
                                                    <p>Get your ticket sales revenue in your added bank account on a daily basis. Leverage More cash flow.</p>
                                                </div>

                                                <div class="left-feature-col"  onmouseover="shownImage(img5)">
                                                    <i class="fa fa-phone-square cservice" style="background: #2BBEEF; border: 2px solid #2BBEEF; color: white;"></i>
                                                    <h4>24*7 Customer Service</h4>
                                                    <p>Our prompt customer service is available 24x7 on phone, email and socially to help you assist.</p>
                                                </div>

                                                <div class="left-feature-col"  onmouseover="shownImage(img6)">
                                                    <i class="fa fa-volume-up pye" style="background:#3782C4;border:2px solid #3782C4;color:white;"></i>
                                                    <h4>Promote your Event</h4>
                                                    <p>Your event page is socially shareable. Let your attendees spread the word.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>
                            <!--Ticketchai Features ends-->



                        </div>
                    </div>
                    <!-- Customers LogIn section ends here -->
                    <!-- ticketchai simple section starts here -->
                    <div class="section section-simple-close">
                        <div class="container">
                            <div class="row section_padd30">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                            </div>
                        </div>
                    </div>
                    <!-- ticketchai simple section ends here -->
                </div>

                <!-- main content part ends here -->
                <!-- main footer part starts here -->
                <!--Footer-->
                <?php include 'include/footer.php'; ?>
                <!-- book ticket floating widget starts here -->
                <div class="clearfix"></div>
<!--                <div id="bookticket-float" class="container-fluid bookticket-widget navbar-fixed-bottom visible-xs" style="border-radius: 0px;">
                    <div class="row" style="overflow: hidden;">
                        <div class="col-xs-12">
                            <button class="btn btn-raised btn-danger btn-block bold bookticket">Book Now</button>
                        </div>
                    </div>
                </div>-->
                <div class="clearfix"></div>
                <!-- book ticket floating widget starts here -->
            </div>
        </div>
        <div class="clearfix"></div>

        <?php echo $cms->fotterJs(array('events'));?>
        <?php echo $cms->angularJs(array('events_angular'));?>
        
        <!--searchbar script-->
    <script>
            $(document).ready(function () {
    
            $('.control').keyup(function () {

    // If value is not empty
    if ($(this).val().length == 0) {
    // Hide the element
    $('.show_hide').hide();
    } else {
    // Otherwise show it
    $('.show_hide').show();
    }
    }).keyup();
    });</script>
    <!--searchbar script-->
        
        <!--stylish typing text script-->
        <script text="text/javascript" src="tc-merchant-template/plugins/typed.js-master/dist/typed.min.js"></script>
        <script>
		  $(function(){
			  $("#magic-tags").typed({
				strings: ["Fundraisings.", "Conferences.", "Entertainment Events", "Sports And Fitness Events.", "Workshop And Trainings."],
				typeSpeed: 60
			  });
		  });
		</script>
        <!--bootstrap tab javascript -->
        <script text="text/javascript">
                        $(document).ready(function () {
                $("#autoclick").click();
                        $("#autoclick1").click();
                        $(".tqv").keyup(function () {
                console.log($(this).val());
                });
                });        </script>


        <script src="tc-merchant-template/assets/js/angular-scroll.js"></script>
        <script>
                        $(document).ready(function () {
                var action = 1;
                        $(".dropdown").on("click", viewSomething);
                        function viewSomething() {
                        if (action == 1) {
                        $(".atcb-list").css("visibility", "visible");
                                action = 2;
                        } else {
                        $(".atcb-list").css("visibility", "hidden");
                                action = 1;
                        }
                        }

                });        </script>
        <script>
                            $(document).ready(function () {
                    $('#cash_on_del_buton').click(function () {
                    $('#share_detalis').toggle(1000);
                    });
                            $('#cashDbut1').click(function () {
                    $('#share_detalis').hide(1000);
                    });
                    });        </script>
        <script type="text/javascript">
                            $(document).ready(function () {
                    // the body of this function is in assets/material-kit.js
                    //materialKit.initSliders();
                    $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
                            window_width = $(window).width();
                            if (window_width >= 768) {
                    big_image = $('.wrapper > .header');
                            $(window).on('scroll', materialKitDemo.checkScrollForParallax);
                    }
                    });        </script>
        <script type="text/javascript">
                            $(document).ready(function () {
                    $('#subscription').hide();
                            //            setTimeout(function (a) {
                            //                $('#subscription').slideDown(1000);
                            //            }, 15000);
                            //            setTimeout(function (b) {
                            //                $('#subscription').slideUp(3000);
                            //            }, 30000);
                            //            $('#btn-sclose').click(function () {
                            //                $('#subscription').slideUp(1000);
                            //            });

                            $('#nav-search-btn').click(function () {
                    $('#nav-search-field').show();
                            $('#nav-search-btn').hide();
                    });
                            $('#nav-search-close').click(function () {
                    $('#nav-search-field').hide();
                            $('#rslt-div').hide();
                            $('#nav-search-btn').show();
                    });
                    });
                            setTimeout(function () {
                            $('#odometer1').html('50');
                                    $('#odometer2').html('100');
                                    $('#odometer3').html('200');
                                    $('#odometer4').html('10000');
                            }, 1000);        </script>
        <!--  Select Picker Plugin -->

    </body>

</html>