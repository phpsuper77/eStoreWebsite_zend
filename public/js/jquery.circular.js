/*
 * Dandelion Admin v1.2 - Circular Stat Widget JS
 *
 * This file is part of Dandelion Admin, an Admin template build for sale at ThemeForest.
 * For questions, suggestions or support request, please mail me at maimairel@yahoo.com
 *
 * Development Started:
 * March 25, 2012
 * Last Update:
 * July 25, 2012
 *
 * 'Highly configurable' mutable plugin boilerplate
 * Author: @markdalgleish
 * Further changes, comments: @addyosmani
 * Licensed under the MIT license
 *
 */

;
(function (d, b, a, e) {
    var c = function (g, f) {
        this.$elem = d(g);
        this.options = f;
        this.metadata = d.fn.metadata ? this.$elem.metadata() : {}
    };
    c.prototype = {defaults:{percent:false, value:0, maxValue:100, duration:1000, label:"", fillColor:"#e15656", decimals:0}, init:function () {
        this.config = d.extend({}, this.defaults, this.options, this.metadata);
        if (this._build()) {
            var f = d(".da-circular-progress canvas", this.$elem).get(0);
            f.width = d(".da-circular-progress", this.$elem).width();
            f.height = d(".da-circular-progress", this.$elem).height();
            this.data = {startAngle:-(Math.PI / 2), endAngle:((this.config.value / this.config.maxValue) * 2 * Math.PI) - (Math.PI / 2), startValue:0, endValue:this.config.value, centerX:f.width / 2, centerY:f.height / 2, radius:d(".da-circular-progress", this.$elem).width() / 2};
            this.canvas = f;
            this.context = f.getContext("2d");
            this.valueEl = d(".da-circular-front .da-circular-digit", this.$elem).get(0);
            this.start()
        }
        return this
    }, start:function () {
        var f = this.data.radius;
        this.context.fillStyle = this.config.fillColor;
        this._update(10, true)
    }, _build:function () {
        var g = d("<span></span>"), f = a.createElement("canvas");
        this.$elem.append(g.clone().addClass("da-circular-front").append(g.clone().addClass("da-circular-digit")).append(g.clone().addClass("da-circular-label").text(this.config.label))).append(g.clone().addClass("da-circular-progress").append(d(f))).addClass("da-circular-stat");
        if (!f.getContext) {
            if (typeof(b.G_vmlCanvasManager) !== "undefined") {
                f = b.G_vmlCanvasManager.initElement(f)
            } else {
                console.log("Your browser does not support HTML5 Canvas, or excanvas is missing on IE");
                this.$elem.hide();
                return false
            }
        }
        return true
    }, _getVal:function (f) {
        if (this.config.percent) {
            if( this.config.maxValue == 0 ){
                return 0;
            }
            return Math.ceil(Math.min(f, 1) * (this.config.value / this.config.maxValue) * 100)
        } else {
            v = f * (this.data.endValue - this.data.startValue);
            return f > 1 ? this.data.endValue : v.toFixed(this.config.decimals)
        }
    }, _update:function (h, k) {
        var j = this.data;
        if (k) {
            var f = this;
            j.startTime = new Date().getTime();
            j.timer = b.setInterval(function () {
                f._update(h, false)
            }, h)
        } else {
            var g = Math.min((new Date().getTime() - j.startTime) / this.config.duration, 1), i = this._getVal(g), j = this.data;
            if (g >= 1) {
                i = this._getVal(g);
                b.clearInterval(j.timer)
            }
            this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.context.beginPath();
            this.context.moveTo(j.centerX, j.centerY);
            this.context.lineTo(j.centerX, 0);
            this.context.arc(j.centerX, j.centerY, j.radius, j.startAngle, j.startAngle + ((j.endAngle - j.startAngle) * g), false);
            this.context.closePath();
            this.context.fill();
            this.valueEl.innerHTML = this.config.percent ? ("<span>" + i + "%</span>") : ("<span>" + i + "</span>/" + this.config.maxValue.toFixed(this.config.decimals))
        }
    }};
    c.defaults = c.prototype.defaults;
    d.fn.daCircularStat = function (f) {
        return this.each(function () {
            new c(this, f).init()
        })
    }
})(jQuery, window, document);