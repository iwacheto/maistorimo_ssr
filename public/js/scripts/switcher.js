!function(e){var r={};function t(s){if(r[s])return r[s].exports;var c=r[s]={i:s,l:!1,exports:{}};return e[s].call(c.exports,c,c.exports,t),c.l=!0,c.exports}t.m=e,t.c=r,t.d=function(e,r,s){t.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:s})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,r){if(1&r&&(e=t(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var s=Object.create(null);if(t.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var c in e)t.d(s,c,function(r){return e[r]}.bind(null,c));return s},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},t.p="/",t(t.s=230)}({230:function(e,r,t){e.exports=t(231)},231:function(e,r){var t;window.console=window.console||((t={}).log=t.warn=t.debug=t.info=t.error=t.time=t.dir=t.profile=t.clear=t.exception=t.trace=t.assert=function(){},t),jQuery(document).ready((function(e){e("#style-switcher .main").click((function(){return e("#colors").attr("href","css/main-color.css"),!1})),e("#style-switcher .blue").click((function(){return e("#colors").attr("href","css/colors/blue.css"),!1})),e("#style-switcher .green").click((function(){return e("#colors").attr("href","css/colors/green.css"),!1})),e("#style-switcher .orange").click((function(){return e("#colors").attr("href","css/colors/orange.css"),!1})),e("#style-switcher .navy").click((function(){return e("#colors").attr("href","css/colors/navy.css"),!1})),e("#style-switcher .yellow").click((function(){return e("#colors").attr("href","css/colors/yellow.css"),!1})),e("#style-switcher .peach").click((function(){return e("#colors").attr("href","css/colors/peach.css"),!1})),e("#style-switcher .beige").click((function(){return e("#colors").attr("href","css/colors/beige.css"),!1})),e("#style-switcher .purple").click((function(){return e("#colors").attr("href","css/colors/purple.css"),!1})),e("#style-switcher .red").click((function(){return e("#colors").attr("href","css/colors/red.css"),!1})),e("#style-switcher .pink").click((function(){return e("#colors").attr("href","css/colors/pink.css"),!1})),e("#style-switcher .celadon").click((function(){return e("#colors").attr("href","css/colors/celadon.css"),!1})),e("#style-switcher .brown").click((function(){return e("#colors").attr("href","css/colors/brown.css"),!1})),e("#style-switcher .cherry").click((function(){return e("#colors").attr("href","css/colors/cherry.css"),!1})),e("#style-switcher .gray").click((function(){return e("#colors").attr("href","css/colors/gray.css"),!1})),e("#style-switcher .darkcol").click((function(){return e("#colors").attr("href","css/colors/dark.css"),!1})),e("#style-switcher .cyan").click((function(){return e("#colors").attr("href","css/colors/cyan.css"),!1})),e("#style-switcher .olive").click((function(){return e("#colors").attr("href","css/colors/olive.css"),!1})),e("#style-switcher h2 a").click((function(r){r.preventDefault();var t=e("#style-switcher");console.log(t.css("left")),"-205px"===t.css("left")?e("#style-switcher").animate({left:"0px"}):e("#style-switcher").animate({left:"-205px"})})),e("#layout-style").change((function(r){1==e(this).val()?(e("body").addClass("boxed"),e("body").removeClass("fullwidth"),e(window).resize()):(e("body").removeClass("boxed"),e("body").addClass("fullwidth"),e(window).resize())})),e("#layout-switcher").on("change",(function(){e("#layout").attr("href",e(this).val()+".css")})),e(".colors li a").click((function(r){r.preventDefault(),e(this).parent().parent().find("a").removeClass("active"),e(this).addClass("active")})),e(".bg li a").click((function(){if("1"==e("#style-switcher select[id=layout-style]").find("option:selected").val()){var r=e(this).css("backgroundImage");e("body").css("backgroundImage",r)}else alert("Please select boxed layout")})),e(".bgsolid li a").click((function(){if("1"==e("#style-switcher select[id=layout-style]").find("option:selected").val()){var r=e(this).css("backgroundColor");e("body").css("backgroundColor",r).css("backgroundImage","none")}else alert("Please select boxed layout")})),e("#reset a").click((function(r){r.preventDefault(),e("body").removeClass("boxed"),e("header").removeClass("alternative"),e("header").removeClass("full-width"),e(".colors li a").removeClass("active"),e("#colors").attr("href","css/main-color.css"),e(window).resize()}))}))}});