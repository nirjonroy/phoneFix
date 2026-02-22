/**
 * Minified by jsDelivr using Terser v5.17.1.
 * Original file: /gh/jitbit/HtmlSanitizer@master/HtmlSanitizer.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
"use strict";
var HtmlSanitizer = new function() {
    var e = {
            A: !0,
            ABBR: !0,
            B: !0,
            BLOCKQUOTE: !0,
            BODY: !0,
            BR: !0,
            CENTER: !0,
            CODE: !0,
            DD: !0,
            DIV: !0,
            DL: !0,
            DT: !0,
            EM: !0,
            FONT: !0,
            H1: !0,
            H2: !0,
            H3: !0,
            H4: !0,
            H5: !0,
            H6: !0,
            HR: !0,
            I: !0,
            IMG: !0,
            LABEL: !0,
            LI: !0,
            OL: !0,
            P: !0,
            PRE: !0,
            SMALL: !0,
            SOURCE: !0,
            SPAN: !0,
            STRONG: !0,
            SUB: !0,
            SUP: !0,
            TABLE: !0,
            TBODY: !0,
            TR: !0,
            TD: !0,
            TH: !0,
            THEAD: !0,
            UL: !0,
            U: !0,
            VIDEO: !0
        },
        t = {
            FORM: !0,
            "GOOGLE-SHEETS-HTML-ORIGIN": !0
        },
        n = {
            align: !0,
            color: !0,
            controls: !0,
            height: !0,
            href: !0,
            id: !0,
            src: !0,
            style: !0,
            target: !0,
            title: !0,
            type: !0,
            width: !0
        },
        r = {
            "background-color": !0,
            color: !0,
            "font-size": !0,
            "font-weight": !0,
            "text-align": !0,
            "text-decoration": !0,
            width: !0
        },
        l = ["http:", "https:", "data:", "m-files:", "file:", "ftp:", "mailto:", "pw:"],
        i = {
            href: !0,
            action: !0
        },
        a = new DOMParser;

    function o(e, t) {
        for (var n = 0; n < t.length; n++)
            if (0 == e.indexOf(t[n])) return !0;
        return !1
    }
    this.SanitizeHtml = function(s, d) {
        if ("" == (s = s.trim())) return "";
        if ("<br>" == s) return ""; - 1 == s.indexOf("<body") && (s = "<body>" + s + "</body>");
        var m = a.parseFromString(s, "text/html");
        "BODY" !== m.body.tagName && m.body.remove(), "function" != typeof m.createElement && m.createElement.remove();
        var c = function a(s) {
            var c;
            if (s.nodeType == Node.TEXT_NODE) c = s.cloneNode(!0);
            else if (s.nodeType == Node.ELEMENT_NODE && (e[s.tagName] || t[s.tagName] || d && s.matches(d))) {
                c = t[s.tagName] ? m.createElement("DIV") : m.createElement(s.tagName);
                for (var n = 0; n < s.attributes.length; n++) {
                    var r = s.attributes[n];
                    if (n[r.name])
                        if ("style" == r.name)
                            for (var l = 0; l < s.style.length; l++) {
                                var u = s.style[l];
                                n[u] && c.style.setProperty(u, s.style.getPropertyValue(u))
                            } else {
                                if (i[r.name] && r.value.indexOf(":") > -1 && !o(r.value, l)) continue;
                                c.setAttribute(r.name, r.value)
                            }
                }
                for (var f = 0; f < s.childNodes.length; f++) {
                    var v = a(s.childNodes[f]);
                    c.appendChild(v, !1)
                }
                if (("SPAN" == c.tagName || "B" == c.tagName || "I" == c.tagName || "U" == c.tagName) && "" == c.innerHTML.trim()) return m.createDocumentFragment()
            } else c = m.createDocumentFragment();
            return c
        }(m.body);
        return c.innerHTML.replace(/<br[^>]*>(\S)/g, "<br>\n$1").replace(/div><div/g, "div>\n<div")
    }, this.AllowedTags = e, this.AllowedAttributes = n, this.AllowedCssStyles = r, this.AllowedSchemas = l
};