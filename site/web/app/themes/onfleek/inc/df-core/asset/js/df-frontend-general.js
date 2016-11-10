/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1||b[0]>2)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.6",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.6",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),a(c.target).is('input[type="radio"]')||a(c.target).is('input[type="checkbox"]')||c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.6",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",f)))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.6",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger(a.Event("shown.bs.dropdown",h))}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),c.isInStateTrue()?void 0:(clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide())},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.getPosition(this.$viewport);h="bottom"==h&&k.bottom+m>o.bottom?"top":"top"==h&&k.top-m<o.top?"bottom":"right"==h&&k.right+l>o.width?"left":"left"==h&&k.left-l<o.left?"right":h,f.removeClass(n).addClass(h)}var p=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(p,h);var q=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",q).emulateTransitionEnd(c.TRANSITION_DURATION):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top+=g,b.left+=h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=a(this.$tip),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.right&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){if(!this.$tip&&(this.$tip=a(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),b?(c.inState.click=!c.inState.click,c.isInStateTrue()?c.enter(c):c.leave(c)):c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type),a.$tip&&a.$tip.detach(),a.$tip=null,a.$arrow=null,a.$viewport=null})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.6",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){this.$body=a(document.body),this.$scrollElement=a(a(c).is(document.body)?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",a.proxy(this.process,this)),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.6",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b=this,c="offset",d=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),a.isWindow(this.$scrollElement[0])||(c="position",d=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var b=a(this),e=b.data("target")||b.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[c]().top+d,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){b.offsets.push(this[0]),b.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(void 0===e[a+1]||b<e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");
d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu").length&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.6",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=e?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=Math.max(a(document).height(),a(document.body).height());"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);

/*!
 * Isotope PACKAGED v2.2.2
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * http://isotope.metafizzy.co
 * Copyright 2015 Metafizzy
 */

!function(a){function b(){}function c(a){function c(b){b.prototype.option||(b.prototype.option=function(b){a.isPlainObject(b)&&(this.options=a.extend(!0,this.options,b))})}function e(b,c){a.fn[b]=function(e){if("string"==typeof e){for(var g=d.call(arguments,1),h=0,i=this.length;i>h;h++){var j=this[h],k=a.data(j,b);if(k)if(a.isFunction(k[e])&&"_"!==e.charAt(0)){var l=k[e].apply(k,g);if(void 0!==l)return l}else f("no such method '"+e+"' for "+b+" instance");else f("cannot call methods on "+b+" prior to initialization; attempted to call '"+e+"'")}return this}return this.each(function(){var d=a.data(this,b);d?(d.option(e),d._init()):(d=new c(this,e),a.data(this,b,d))})}}if(a){var f="undefined"==typeof console?b:function(a){console.error(a)};return a.bridget=function(a,b){c(b),e(a,b)},a.bridget}}var d=Array.prototype.slice;"function"==typeof define&&define.amd?define("jquery-bridget/jquery.bridget",["jquery"],c):c("object"==typeof exports?require("jquery"):a.jQuery)}(window),function(a){function b(b){var c=a.event;return c.target=c.target||c.srcElement||b,c}var c=document.documentElement,d=function(){};c.addEventListener?d=function(a,b,c){a.addEventListener(b,c,!1)}:c.attachEvent&&(d=function(a,c,d){a[c+d]=d.handleEvent?function(){var c=b(a);d.handleEvent.call(d,c)}:function(){var c=b(a);d.call(a,c)},a.attachEvent("on"+c,a[c+d])});var e=function(){};c.removeEventListener?e=function(a,b,c){a.removeEventListener(b,c,!1)}:c.detachEvent&&(e=function(a,b,c){a.detachEvent("on"+b,a[b+c]);try{delete a[b+c]}catch(d){a[b+c]=void 0}});var f={bind:d,unbind:e};"function"==typeof define&&define.amd?define("eventie/eventie",f):"object"==typeof exports?module.exports=f:a.eventie=f}(window),function(){"use strict";function a(){}function b(a,b){for(var c=a.length;c--;)if(a[c].listener===b)return c;return-1}function c(a){return function(){return this[a].apply(this,arguments)}}var d=a.prototype,e=this,f=e.EventEmitter;d.getListeners=function(a){var b,c,d=this._getEvents();if(a instanceof RegExp){b={};for(c in d)d.hasOwnProperty(c)&&a.test(c)&&(b[c]=d[c])}else b=d[a]||(d[a]=[]);return b},d.flattenListeners=function(a){var b,c=[];for(b=0;b<a.length;b+=1)c.push(a[b].listener);return c},d.getListenersAsObject=function(a){var b,c=this.getListeners(a);return c instanceof Array&&(b={},b[a]=c),b||c},d.addListener=function(a,c){var d,e=this.getListenersAsObject(a),f="object"==typeof c;for(d in e)e.hasOwnProperty(d)&&-1===b(e[d],c)&&e[d].push(f?c:{listener:c,once:!1});return this},d.on=c("addListener"),d.addOnceListener=function(a,b){return this.addListener(a,{listener:b,once:!0})},d.once=c("addOnceListener"),d.defineEvent=function(a){return this.getListeners(a),this},d.defineEvents=function(a){for(var b=0;b<a.length;b+=1)this.defineEvent(a[b]);return this},d.removeListener=function(a,c){var d,e,f=this.getListenersAsObject(a);for(e in f)f.hasOwnProperty(e)&&(d=b(f[e],c),-1!==d&&f[e].splice(d,1));return this},d.off=c("removeListener"),d.addListeners=function(a,b){return this.manipulateListeners(!1,a,b)},d.removeListeners=function(a,b){return this.manipulateListeners(!0,a,b)},d.manipulateListeners=function(a,b,c){var d,e,f=a?this.removeListener:this.addListener,g=a?this.removeListeners:this.addListeners;if("object"!=typeof b||b instanceof RegExp)for(d=c.length;d--;)f.call(this,b,c[d]);else for(d in b)b.hasOwnProperty(d)&&(e=b[d])&&("function"==typeof e?f.call(this,d,e):g.call(this,d,e));return this},d.removeEvent=function(a){var b,c=typeof a,d=this._getEvents();if("string"===c)delete d[a];else if(a instanceof RegExp)for(b in d)d.hasOwnProperty(b)&&a.test(b)&&delete d[b];else delete this._events;return this},d.removeAllListeners=c("removeEvent"),d.emitEvent=function(a,b){var c,d,e,f,g=this.getListenersAsObject(a);for(e in g)if(g.hasOwnProperty(e))for(d=g[e].length;d--;)c=g[e][d],c.once===!0&&this.removeListener(a,c.listener),f=c.listener.apply(this,b||[]),f===this._getOnceReturnValue()&&this.removeListener(a,c.listener);return this},d.trigger=c("emitEvent"),d.emit=function(a){var b=Array.prototype.slice.call(arguments,1);return this.emitEvent(a,b)},d.setOnceReturnValue=function(a){return this._onceReturnValue=a,this},d._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},d._getEvents=function(){return this._events||(this._events={})},a.noConflict=function(){return e.EventEmitter=f,a},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return a}):"object"==typeof module&&module.exports?module.exports=a:e.EventEmitter=a}.call(this),function(a){function b(a){if(a){if("string"==typeof d[a])return a;a=a.charAt(0).toUpperCase()+a.slice(1);for(var b,e=0,f=c.length;f>e;e++)if(b=c[e]+a,"string"==typeof d[b])return b}}var c="Webkit Moz ms Ms O".split(" "),d=document.documentElement.style;"function"==typeof define&&define.amd?define("get-style-property/get-style-property",[],function(){return b}):"object"==typeof exports?module.exports=b:a.getStyleProperty=b}(window),function(a,b){function c(a){var b=parseFloat(a),c=-1===a.indexOf("%")&&!isNaN(b);return c&&b}function d(){}function e(){for(var a={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},b=0,c=h.length;c>b;b++){var d=h[b];a[d]=0}return a}function f(b){function d(){if(!m){m=!0;var d=a.getComputedStyle;if(j=function(){var a=d?function(a){return d(a,null)}:function(a){return a.currentStyle};return function(b){var c=a(b);return c||g("Style returned "+c+". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"),c}}(),k=b("boxSizing")){var e=document.createElement("div");e.style.width="200px",e.style.padding="1px 2px 3px 4px",e.style.borderStyle="solid",e.style.borderWidth="1px 2px 3px 4px",e.style[k]="border-box";var f=document.body||document.documentElement;f.appendChild(e);var h=j(e);l=200===c(h.width),f.removeChild(e)}}}function f(a){if(d(),"string"==typeof a&&(a=document.querySelector(a)),a&&"object"==typeof a&&a.nodeType){var b=j(a);if("none"===b.display)return e();var f={};f.width=a.offsetWidth,f.height=a.offsetHeight;for(var g=f.isBorderBox=!(!k||!b[k]||"border-box"!==b[k]),m=0,n=h.length;n>m;m++){var o=h[m],p=b[o];p=i(a,p);var q=parseFloat(p);f[o]=isNaN(q)?0:q}var r=f.paddingLeft+f.paddingRight,s=f.paddingTop+f.paddingBottom,t=f.marginLeft+f.marginRight,u=f.marginTop+f.marginBottom,v=f.borderLeftWidth+f.borderRightWidth,w=f.borderTopWidth+f.borderBottomWidth,x=g&&l,y=c(b.width);y!==!1&&(f.width=y+(x?0:r+v));var z=c(b.height);return z!==!1&&(f.height=z+(x?0:s+w)),f.innerWidth=f.width-(r+v),f.innerHeight=f.height-(s+w),f.outerWidth=f.width+t,f.outerHeight=f.height+u,f}}function i(b,c){if(a.getComputedStyle||-1===c.indexOf("%"))return c;var d=b.style,e=d.left,f=b.runtimeStyle,g=f&&f.left;return g&&(f.left=b.currentStyle.left),d.left=c,c=d.pixelLeft,d.left=e,g&&(f.left=g),c}var j,k,l,m=!1;return f}var g="undefined"==typeof console?d:function(a){console.error(a)},h=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"];"function"==typeof define&&define.amd?define("get-size/get-size",["get-style-property/get-style-property"],f):"object"==typeof exports?module.exports=f(require("desandro-get-style-property")):a.getSize=f(a.getStyleProperty)}(window),function(a){function b(a){"function"==typeof a&&(b.isReady?a():g.push(a))}function c(a){var c="readystatechange"===a.type&&"complete"!==f.readyState;b.isReady||c||d()}function d(){b.isReady=!0;for(var a=0,c=g.length;c>a;a++){var d=g[a];d()}}function e(e){return"complete"===f.readyState?d():(e.bind(f,"DOMContentLoaded",c),e.bind(f,"readystatechange",c),e.bind(a,"load",c)),b}var f=a.document,g=[];b.isReady=!1,"function"==typeof define&&define.amd?define("doc-ready/doc-ready",["eventie/eventie"],e):"object"==typeof exports?module.exports=e(require("eventie")):a.docReady=e(a.eventie)}(window),function(a){"use strict";function b(a,b){return a[g](b)}function c(a){if(!a.parentNode){var b=document.createDocumentFragment();b.appendChild(a)}}function d(a,b){c(a);for(var d=a.parentNode.querySelectorAll(b),e=0,f=d.length;f>e;e++)if(d[e]===a)return!0;return!1}function e(a,d){return c(a),b(a,d)}var f,g=function(){if(a.matches)return"matches";if(a.matchesSelector)return"matchesSelector";for(var b=["webkit","moz","ms","o"],c=0,d=b.length;d>c;c++){var e=b[c],f=e+"MatchesSelector";if(a[f])return f}}();if(g){var h=document.createElement("div"),i=b(h,"div");f=i?b:e}else f=d;"function"==typeof define&&define.amd?define("matches-selector/matches-selector",[],function(){return f}):"object"==typeof exports?module.exports=f:window.matchesSelector=f}(Element.prototype),function(a,b){"use strict";"function"==typeof define&&define.amd?define("fizzy-ui-utils/utils",["doc-ready/doc-ready","matches-selector/matches-selector"],function(c,d){return b(a,c,d)}):"object"==typeof exports?module.exports=b(a,require("doc-ready"),require("desandro-matches-selector")):a.fizzyUIUtils=b(a,a.docReady,a.matchesSelector)}(window,function(a,b,c){var d={};d.extend=function(a,b){for(var c in b)a[c]=b[c];return a},d.modulo=function(a,b){return(a%b+b)%b};var e=Object.prototype.toString;d.isArray=function(a){return"[object Array]"==e.call(a)},d.makeArray=function(a){var b=[];if(d.isArray(a))b=a;else if(a&&"number"==typeof a.length)for(var c=0,e=a.length;e>c;c++)b.push(a[c]);else b.push(a);return b},d.indexOf=Array.prototype.indexOf?function(a,b){return a.indexOf(b)}:function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},d.removeFrom=function(a,b){var c=d.indexOf(a,b);-1!=c&&a.splice(c,1)},d.isElement="function"==typeof HTMLElement||"object"==typeof HTMLElement?function(a){return a instanceof HTMLElement}:function(a){return a&&"object"==typeof a&&1==a.nodeType&&"string"==typeof a.nodeName},d.setText=function(){function a(a,c){b=b||(void 0!==document.documentElement.textContent?"textContent":"innerText"),a[b]=c}var b;return a}(),d.getParent=function(a,b){for(;a!=document.body;)if(a=a.parentNode,c(a,b))return a},d.getQueryElement=function(a){return"string"==typeof a?document.querySelector(a):a},d.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},d.filterFindElements=function(a,b){a=d.makeArray(a);for(var e=[],f=0,g=a.length;g>f;f++){var h=a[f];if(d.isElement(h))if(b){c(h,b)&&e.push(h);for(var i=h.querySelectorAll(b),j=0,k=i.length;k>j;j++)e.push(i[j])}else e.push(h)}return e},d.debounceMethod=function(a,b,c){var d=a.prototype[b],e=b+"Timeout";a.prototype[b]=function(){var a=this[e];a&&clearTimeout(a);var b=arguments,f=this;this[e]=setTimeout(function(){d.apply(f,b),delete f[e]},c||100)}},d.toDashed=function(a){return a.replace(/(.)([A-Z])/g,function(a,b,c){return b+"-"+c}).toLowerCase()};var f=a.console;return d.htmlInit=function(c,e){b(function(){for(var b=d.toDashed(e),g=document.querySelectorAll(".js-"+b),h="data-"+b+"-options",i=0,j=g.length;j>i;i++){var k,l=g[i],m=l.getAttribute(h);try{k=m&&JSON.parse(m)}catch(n){f&&f.error("Error parsing "+h+" on "+l.nodeName.toLowerCase()+(l.id?"#"+l.id:"")+": "+n);continue}var o=new c(l,k),p=a.jQuery;p&&p.data(l,e,o)}})},d}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("outlayer/item",["eventEmitter/EventEmitter","get-size/get-size","get-style-property/get-style-property","fizzy-ui-utils/utils"],function(c,d,e,f){return b(a,c,d,e,f)}):"object"==typeof exports?module.exports=b(a,require("wolfy87-eventemitter"),require("get-size"),require("desandro-get-style-property"),require("fizzy-ui-utils")):(a.Outlayer={},a.Outlayer.Item=b(a,a.EventEmitter,a.getSize,a.getStyleProperty,a.fizzyUIUtils))}(window,function(a,b,c,d,e){"use strict";function f(a){for(var b in a)return!1;return b=null,!0}function g(a,b){a&&(this.element=a,this.layout=b,this.position={x:0,y:0},this._create())}function h(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}var i=a.getComputedStyle,j=i?function(a){return i(a,null)}:function(a){return a.currentStyle},k=d("transition"),l=d("transform"),m=k&&l,n=!!d("perspective"),o={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"otransitionend",transition:"transitionend"}[k],p=["transform","transition","transitionDuration","transitionProperty"],q=function(){for(var a={},b=0,c=p.length;c>b;b++){var e=p[b],f=d(e);f&&f!==e&&(a[e]=f)}return a}();e.extend(g.prototype,b.prototype),g.prototype._create=function(){this._transn={ingProperties:{},clean:{},onEnd:{}},this.css({position:"absolute"})},g.prototype.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},g.prototype.getSize=function(){this.size=c(this.element)},g.prototype.css=function(a){var b=this.element.style;for(var c in a){var d=q[c]||c;b[d]=a[c]}},g.prototype.getPosition=function(){var a=j(this.element),b=this.layout.options,c=b.isOriginLeft,d=b.isOriginTop,e=a[c?"left":"right"],f=a[d?"top":"bottom"],g=this.layout.size,h=-1!=e.indexOf("%")?parseFloat(e)/100*g.width:parseInt(e,10),i=-1!=f.indexOf("%")?parseFloat(f)/100*g.height:parseInt(f,10);h=isNaN(h)?0:h,i=isNaN(i)?0:i,h-=c?g.paddingLeft:g.paddingRight,i-=d?g.paddingTop:g.paddingBottom,this.position.x=h,this.position.y=i},g.prototype.layoutPosition=function(){var a=this.layout.size,b=this.layout.options,c={},d=b.isOriginLeft?"paddingLeft":"paddingRight",e=b.isOriginLeft?"left":"right",f=b.isOriginLeft?"right":"left",g=this.position.x+a[d];c[e]=this.getXValue(g),c[f]="";var h=b.isOriginTop?"paddingTop":"paddingBottom",i=b.isOriginTop?"top":"bottom",j=b.isOriginTop?"bottom":"top",k=this.position.y+a[h];c[i]=this.getYValue(k),c[j]="",this.css(c),this.emitEvent("layout",[this])},g.prototype.getXValue=function(a){var b=this.layout.options;return b.percentPosition&&!b.isHorizontal?a/this.layout.size.width*100+"%":a+"px"},g.prototype.getYValue=function(a){var b=this.layout.options;return b.percentPosition&&b.isHorizontal?a/this.layout.size.height*100+"%":a+"px"},g.prototype._transitionTo=function(a,b){this.getPosition();var c=this.position.x,d=this.position.y,e=parseInt(a,10),f=parseInt(b,10),g=e===this.position.x&&f===this.position.y;if(this.setPosition(a,b),g&&!this.isTransitioning)return void this.layoutPosition();var h=a-c,i=b-d,j={};j.transform=this.getTranslate(h,i),this.transition({to:j,onTransitionEnd:{transform:this.layoutPosition},isCleaning:!0})},g.prototype.getTranslate=function(a,b){var c=this.layout.options;return a=c.isOriginLeft?a:-a,b=c.isOriginTop?b:-b,n?"translate3d("+a+"px, "+b+"px, 0)":"translate("+a+"px, "+b+"px)"},g.prototype.goTo=function(a,b){this.setPosition(a,b),this.layoutPosition()},g.prototype.moveTo=m?g.prototype._transitionTo:g.prototype.goTo,g.prototype.setPosition=function(a,b){this.position.x=parseInt(a,10),this.position.y=parseInt(b,10)},g.prototype._nonTransition=function(a){this.css(a.to),a.isCleaning&&this._removeStyles(a.to);for(var b in a.onTransitionEnd)a.onTransitionEnd[b].call(this)},g.prototype._transition=function(a){if(!parseFloat(this.layout.options.transitionDuration))return void this._nonTransition(a);var b=this._transn;for(var c in a.onTransitionEnd)b.onEnd[c]=a.onTransitionEnd[c];for(c in a.to)b.ingProperties[c]=!0,a.isCleaning&&(b.clean[c]=!0);if(a.from){this.css(a.from);var d=this.element.offsetHeight;d=null}this.enableTransition(a.to),this.css(a.to),this.isTransitioning=!0};var r="opacity,"+h(q.transform||"transform");g.prototype.enableTransition=function(){this.isTransitioning||(this.css({transitionProperty:r,transitionDuration:this.layout.options.transitionDuration}),this.element.addEventListener(o,this,!1))},g.prototype.transition=g.prototype[k?"_transition":"_nonTransition"],g.prototype.onwebkitTransitionEnd=function(a){this.ontransitionend(a)},g.prototype.onotransitionend=function(a){this.ontransitionend(a)};var s={"-webkit-transform":"transform","-moz-transform":"transform","-o-transform":"transform"};g.prototype.ontransitionend=function(a){if(a.target===this.element){var b=this._transn,c=s[a.propertyName]||a.propertyName;if(delete b.ingProperties[c],f(b.ingProperties)&&this.disableTransition(),c in b.clean&&(this.element.style[a.propertyName]="",delete b.clean[c]),c in b.onEnd){var d=b.onEnd[c];d.call(this),delete b.onEnd[c]}this.emitEvent("transitionEnd",[this])}},g.prototype.disableTransition=function(){this.removeTransitionStyles(),this.element.removeEventListener(o,this,!1),this.isTransitioning=!1},g.prototype._removeStyles=function(a){var b={};for(var c in a)b[c]="";this.css(b)};var t={transitionProperty:"",transitionDuration:""};return g.prototype.removeTransitionStyles=function(){this.css(t)},g.prototype.removeElem=function(){this.element.parentNode.removeChild(this.element),this.css({display:""}),this.emitEvent("remove",[this])},g.prototype.remove=function(){if(!k||!parseFloat(this.layout.options.transitionDuration))return void this.removeElem();var a=this;this.once("transitionEnd",function(){a.removeElem()}),this.hide()},g.prototype.reveal=function(){delete this.isHidden,this.css({display:""});var a=this.layout.options,b={},c=this.getHideRevealTransitionEndProperty("visibleStyle");b[c]=this.onRevealTransitionEnd,this.transition({from:a.hiddenStyle,to:a.visibleStyle,isCleaning:!0,onTransitionEnd:b})},g.prototype.onRevealTransitionEnd=function(){this.isHidden||this.emitEvent("reveal")},g.prototype.getHideRevealTransitionEndProperty=function(a){var b=this.layout.options[a];if(b.opacity)return"opacity";for(var c in b)return c},g.prototype.hide=function(){this.isHidden=!0,this.css({display:""});var a=this.layout.options,b={},c=this.getHideRevealTransitionEndProperty("hiddenStyle");b[c]=this.onHideTransitionEnd,this.transition({from:a.visibleStyle,to:a.hiddenStyle,isCleaning:!0,onTransitionEnd:b})},g.prototype.onHideTransitionEnd=function(){this.isHidden&&(this.css({display:"none"}),this.emitEvent("hide"))},g.prototype.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},g}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("outlayer/outlayer",["eventie/eventie","eventEmitter/EventEmitter","get-size/get-size","fizzy-ui-utils/utils","./item"],function(c,d,e,f,g){return b(a,c,d,e,f,g)}):"object"==typeof exports?module.exports=b(a,require("eventie"),require("wolfy87-eventemitter"),require("get-size"),require("fizzy-ui-utils"),require("./item")):a.Outlayer=b(a,a.eventie,a.EventEmitter,a.getSize,a.fizzyUIUtils,a.Outlayer.Item)}(window,function(a,b,c,d,e,f){"use strict";function g(a,b){var c=e.getQueryElement(a);if(!c)return void(h&&h.error("Bad element for "+this.constructor.namespace+": "+(c||a)));this.element=c,i&&(this.$element=i(this.element)),this.options=e.extend({},this.constructor.defaults),this.option(b);var d=++k;this.element.outlayerGUID=d,l[d]=this,this._create(),this.options.isInitLayout&&this.layout()}var h=a.console,i=a.jQuery,j=function(){},k=0,l={};return g.namespace="outlayer",g.Item=f,g.defaults={containerStyle:{position:"relative"},isInitLayout:!0,isOriginLeft:!0,isOriginTop:!0,isResizeBound:!0,isResizingContainer:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}},e.extend(g.prototype,c.prototype),g.prototype.option=function(a){e.extend(this.options,a)},g.prototype._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),e.extend(this.element.style,this.options.containerStyle),this.options.isResizeBound&&this.bindResize()},g.prototype.reloadItems=function(){this.items=this._itemize(this.element.children)},g.prototype._itemize=function(a){for(var b=this._filterFindItemElements(a),c=this.constructor.Item,d=[],e=0,f=b.length;f>e;e++){var g=b[e],h=new c(g,this);d.push(h)}return d},g.prototype._filterFindItemElements=function(a){return e.filterFindElements(a,this.options.itemSelector)},g.prototype.getItemElements=function(){for(var a=[],b=0,c=this.items.length;c>b;b++)a.push(this.items[b].element);return a},g.prototype.layout=function(){this._resetLayout(),this._manageStamps();var a=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;this.layoutItems(this.items,a),this._isLayoutInited=!0},g.prototype._init=g.prototype.layout,g.prototype._resetLayout=function(){this.getSize()},g.prototype.getSize=function(){this.size=d(this.element)},g.prototype._getMeasurement=function(a,b){var c,f=this.options[a];f?("string"==typeof f?c=this.element.querySelector(f):e.isElement(f)&&(c=f),this[a]=c?d(c)[b]:f):this[a]=0},g.prototype.layoutItems=function(a,b){a=this._getItemsForLayout(a),this._layoutItems(a,b),this._postLayout()},g.prototype._getItemsForLayout=function(a){for(var b=[],c=0,d=a.length;d>c;c++){var e=a[c];e.isIgnored||b.push(e)}return b},g.prototype._layoutItems=function(a,b){if(this._emitCompleteOnItems("layout",a),a&&a.length){for(var c=[],d=0,e=a.length;e>d;d++){var f=a[d],g=this._getItemLayoutPosition(f);g.item=f,g.isInstant=b||f.isLayoutInstant,c.push(g)}this._processLayoutQueue(c)}},g.prototype._getItemLayoutPosition=function(){return{x:0,y:0}},g.prototype._processLayoutQueue=function(a){for(var b=0,c=a.length;c>b;b++){var d=a[b];this._positionItem(d.item,d.x,d.y,d.isInstant)}},g.prototype._positionItem=function(a,b,c,d){d?a.goTo(b,c):a.moveTo(b,c)},g.prototype._postLayout=function(){this.resizeContainer()},g.prototype.resizeContainer=function(){if(this.options.isResizingContainer){var a=this._getContainerSize();a&&(this._setContainerMeasure(a.width,!0),this._setContainerMeasure(a.height,!1))}},g.prototype._getContainerSize=j,g.prototype._setContainerMeasure=function(a,b){if(void 0!==a){var c=this.size;c.isBorderBox&&(a+=b?c.paddingLeft+c.paddingRight+c.borderLeftWidth+c.borderRightWidth:c.paddingBottom+c.paddingTop+c.borderTopWidth+c.borderBottomWidth),a=Math.max(a,0),this.element.style[b?"width":"height"]=a+"px"}},g.prototype._emitCompleteOnItems=function(a,b){function c(){e.dispatchEvent(a+"Complete",null,[b])}function d(){g++,g===f&&c()}var e=this,f=b.length;if(!b||!f)return void c();for(var g=0,h=0,i=b.length;i>h;h++){var j=b[h];j.once(a,d)}},g.prototype.dispatchEvent=function(a,b,c){var d=b?[b].concat(c):c;if(this.emitEvent(a,d),i)if(this.$element=this.$element||i(this.element),b){var e=i.Event(b);e.type=a,this.$element.trigger(e,c)}else this.$element.trigger(a,c)},g.prototype.ignore=function(a){var b=this.getItem(a);b&&(b.isIgnored=!0)},g.prototype.unignore=function(a){var b=this.getItem(a);b&&delete b.isIgnored},g.prototype.stamp=function(a){if(a=this._find(a)){this.stamps=this.stamps.concat(a);for(var b=0,c=a.length;c>b;b++){var d=a[b];this.ignore(d)}}},g.prototype.unstamp=function(a){if(a=this._find(a))for(var b=0,c=a.length;c>b;b++){var d=a[b];e.removeFrom(this.stamps,d),this.unignore(d)}},g.prototype._find=function(a){return a?("string"==typeof a&&(a=this.element.querySelectorAll(a)),a=e.makeArray(a)):void 0},g.prototype._manageStamps=function(){if(this.stamps&&this.stamps.length){this._getBoundingRect();for(var a=0,b=this.stamps.length;b>a;a++){var c=this.stamps[a];this._manageStamp(c)}}},g.prototype._getBoundingRect=function(){var a=this.element.getBoundingClientRect(),b=this.size;this._boundingRect={left:a.left+b.paddingLeft+b.borderLeftWidth,top:a.top+b.paddingTop+b.borderTopWidth,right:a.right-(b.paddingRight+b.borderRightWidth),bottom:a.bottom-(b.paddingBottom+b.borderBottomWidth)}},g.prototype._manageStamp=j,g.prototype._getElementOffset=function(a){var b=a.getBoundingClientRect(),c=this._boundingRect,e=d(a),f={left:b.left-c.left-e.marginLeft,top:b.top-c.top-e.marginTop,right:c.right-b.right-e.marginRight,bottom:c.bottom-b.bottom-e.marginBottom};return f},g.prototype.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},g.prototype.bindResize=function(){this.isResizeBound||(b.bind(a,"resize",this),this.isResizeBound=!0)},g.prototype.unbindResize=function(){this.isResizeBound&&b.unbind(a,"resize",this),this.isResizeBound=!1},g.prototype.onresize=function(){function a(){b.resize(),delete b.resizeTimeout}this.resizeTimeout&&clearTimeout(this.resizeTimeout);var b=this;this.resizeTimeout=setTimeout(a,100)},g.prototype.resize=function(){this.isResizeBound&&this.needsResizeLayout()&&this.layout()},g.prototype.needsResizeLayout=function(){var a=d(this.element),b=this.size&&a;return b&&a.innerWidth!==this.size.innerWidth},g.prototype.addItems=function(a){var b=this._itemize(a);return b.length&&(this.items=this.items.concat(b)),b},g.prototype.appended=function(a){var b=this.addItems(a);b.length&&(this.layoutItems(b,!0),this.reveal(b))},g.prototype.prepended=function(a){var b=this._itemize(a);if(b.length){var c=this.items.slice(0);this.items=b.concat(c),this._resetLayout(),this._manageStamps(),this.layoutItems(b,!0),this.reveal(b),this.layoutItems(c)}},g.prototype.reveal=function(a){this._emitCompleteOnItems("reveal",a);for(var b=a&&a.length,c=0;b&&b>c;c++){var d=a[c];d.reveal()}},g.prototype.hide=function(a){this._emitCompleteOnItems("hide",a);for(var b=a&&a.length,c=0;b&&b>c;c++){var d=a[c];d.hide()}},g.prototype.revealItemElements=function(a){var b=this.getItems(a);this.reveal(b)},g.prototype.hideItemElements=function(a){var b=this.getItems(a);this.hide(b)},g.prototype.getItem=function(a){for(var b=0,c=this.items.length;c>b;b++){var d=this.items[b];if(d.element===a)return d}},g.prototype.getItems=function(a){a=e.makeArray(a);for(var b=[],c=0,d=a.length;d>c;c++){var f=a[c],g=this.getItem(f);g&&b.push(g)}return b},g.prototype.remove=function(a){var b=this.getItems(a);if(this._emitCompleteOnItems("remove",b),b&&b.length)for(var c=0,d=b.length;d>c;c++){var f=b[c];f.remove(),e.removeFrom(this.items,f)}},g.prototype.destroy=function(){var a=this.element.style;a.height="",a.position="",a.width="";for(var b=0,c=this.items.length;c>b;b++){var d=this.items[b];d.destroy()}this.unbindResize();var e=this.element.outlayerGUID;delete l[e],delete this.element.outlayerGUID,i&&i.removeData(this.element,this.constructor.namespace)},g.data=function(a){a=e.getQueryElement(a);var b=a&&a.outlayerGUID;return b&&l[b]},g.create=function(a,b){function c(){g.apply(this,arguments)}return Object.create?c.prototype=Object.create(g.prototype):e.extend(c.prototype,g.prototype),c.prototype.constructor=c,c.defaults=e.extend({},g.defaults),e.extend(c.defaults,b),c.prototype.settings={},c.namespace=a,c.data=g.data,c.Item=function(){f.apply(this,arguments)},c.Item.prototype=new f,e.htmlInit(c,a),i&&i.bridget&&i.bridget(a,c),c},g.Item=f,g}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("isotope/js/item",["outlayer/outlayer"],b):"object"==typeof exports?module.exports=b(require("outlayer")):(a.Isotope=a.Isotope||{},a.Isotope.Item=b(a.Outlayer))}(window,function(a){"use strict";function b(){a.Item.apply(this,arguments)}b.prototype=new a.Item,b.prototype._create=function(){this.id=this.layout.itemGUID++,a.Item.prototype._create.call(this),this.sortData={}},b.prototype.updateSortData=function(){if(!this.isIgnored){this.sortData.id=this.id,this.sortData["original-order"]=this.id,this.sortData.random=Math.random();var a=this.layout.options.getSortData,b=this.layout._sorters;for(var c in a){var d=b[c];this.sortData[c]=d(this.element,this)}}};var c=b.prototype.destroy;return b.prototype.destroy=function(){c.apply(this,arguments),this.css({display:""})},b}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("isotope/js/layout-mode",["get-size/get-size","outlayer/outlayer"],b):"object"==typeof exports?module.exports=b(require("get-size"),require("outlayer")):(a.Isotope=a.Isotope||{},a.Isotope.LayoutMode=b(a.getSize,a.Outlayer))}(window,function(a,b){"use strict";function c(a){this.isotope=a,a&&(this.options=a.options[this.namespace],this.element=a.element,this.items=a.filteredItems,this.size=a.size)}return function(){function a(a){return function(){return b.prototype[a].apply(this.isotope,arguments)}}for(var d=["_resetLayout","_getItemLayoutPosition","_manageStamp","_getContainerSize","_getElementOffset","needsResizeLayout"],e=0,f=d.length;f>e;e++){var g=d[e];c.prototype[g]=a(g)}}(),c.prototype.needsVerticalResizeLayout=function(){var b=a(this.isotope.element),c=this.isotope.size&&b;return c&&b.innerHeight!=this.isotope.size.innerHeight},c.prototype._getMeasurement=function(){this.isotope._getMeasurement.apply(this,arguments)},c.prototype.getColumnWidth=function(){this.getSegmentSize("column","Width")},c.prototype.getRowHeight=function(){this.getSegmentSize("row","Height")},c.prototype.getSegmentSize=function(a,b){var c=a+b,d="outer"+b;if(this._getMeasurement(c,d),!this[c]){var e=this.getFirstItemSize();this[c]=e&&e[d]||this.isotope.size["inner"+b]}},c.prototype.getFirstItemSize=function(){var b=this.isotope.filteredItems[0];return b&&b.element&&a(b.element)},c.prototype.layout=function(){this.isotope.layout.apply(this.isotope,arguments)},c.prototype.getSize=function(){this.isotope.getSize(),this.size=this.isotope.size},c.modes={},c.create=function(a,b){function d(){c.apply(this,arguments)}return d.prototype=new c,b&&(d.options=b),d.prototype.namespace=a,c.modes[a]=d,d},c}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("masonry/masonry",["outlayer/outlayer","get-size/get-size","fizzy-ui-utils/utils"],b):"object"==typeof exports?module.exports=b(require("outlayer"),require("get-size"),require("fizzy-ui-utils")):a.Masonry=b(a.Outlayer,a.getSize,a.fizzyUIUtils)}(window,function(a,b,c){var d=a.create("masonry");return d.prototype._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns();var a=this.cols;for(this.colYs=[];a--;)this.colYs.push(0);this.maxY=0},d.prototype.measureColumns=function(){if(this.getContainerWidth(),!this.columnWidth){var a=this.items[0],c=a&&a.element;this.columnWidth=c&&b(c).outerWidth||this.containerWidth}var d=this.columnWidth+=this.gutter,e=this.containerWidth+this.gutter,f=e/d,g=d-e%d,h=g&&1>g?"round":"floor";f=Math[h](f),this.cols=Math.max(f,1)},d.prototype.getContainerWidth=function(){var a=this.options.isFitWidth?this.element.parentNode:this.element,c=b(a);this.containerWidth=c&&c.innerWidth},d.prototype._getItemLayoutPosition=function(a){a.getSize();var b=a.size.outerWidth%this.columnWidth,d=b&&1>b?"round":"ceil",e=Math[d](a.size.outerWidth/this.columnWidth);e=Math.min(e,this.cols);for(var f=this._getColGroup(e),g=Math.min.apply(Math,f),h=c.indexOf(f,g),i={x:this.columnWidth*h,y:g},j=g+a.size.outerHeight,k=this.cols+1-f.length,l=0;k>l;l++)this.colYs[h+l]=j;return i},d.prototype._getColGroup=function(a){if(2>a)return this.colYs;for(var b=[],c=this.cols+1-a,d=0;c>d;d++){var e=this.colYs.slice(d,d+a);b[d]=Math.max.apply(Math,e)}return b},d.prototype._manageStamp=function(a){var c=b(a),d=this._getElementOffset(a),e=this.options.isOriginLeft?d.left:d.right,f=e+c.outerWidth,g=Math.floor(e/this.columnWidth);g=Math.max(0,g);var h=Math.floor(f/this.columnWidth);h-=f%this.columnWidth?0:1,h=Math.min(this.cols-1,h);for(var i=(this.options.isOriginTop?d.top:d.bottom)+c.outerHeight,j=g;h>=j;j++)this.colYs[j]=Math.max(i,this.colYs[j])},d.prototype._getContainerSize=function(){this.maxY=Math.max.apply(Math,this.colYs);var a={height:this.maxY};return this.options.isFitWidth&&(a.width=this._getContainerFitWidth()),a},d.prototype._getContainerFitWidth=function(){for(var a=0,b=this.cols;--b&&0===this.colYs[b];)a++;return(this.cols-a)*this.columnWidth-this.gutter},d.prototype.needsResizeLayout=function(){var a=this.containerWidth;return this.getContainerWidth(),a!==this.containerWidth},d}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("isotope/js/layout-modes/masonry",["../layout-mode","masonry/masonry"],b):"object"==typeof exports?module.exports=b(require("../layout-mode"),require("masonry-layout")):b(a.Isotope.LayoutMode,a.Masonry)}(window,function(a,b){"use strict";function c(a,b){for(var c in b)a[c]=b[c];return a}var d=a.create("masonry"),e=d.prototype._getElementOffset,f=d.prototype.layout,g=d.prototype._getMeasurement;
c(d.prototype,b.prototype),d.prototype._getElementOffset=e,d.prototype.layout=f,d.prototype._getMeasurement=g;var h=d.prototype.measureColumns;d.prototype.measureColumns=function(){this.items=this.isotope.filteredItems,h.call(this)};var i=d.prototype._manageStamp;return d.prototype._manageStamp=function(){this.options.isOriginLeft=this.isotope.options.isOriginLeft,this.options.isOriginTop=this.isotope.options.isOriginTop,i.apply(this,arguments)},d}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("isotope/js/layout-modes/fit-rows",["../layout-mode"],b):"object"==typeof exports?module.exports=b(require("../layout-mode")):b(a.Isotope.LayoutMode)}(window,function(a){"use strict";var b=a.create("fitRows");return b.prototype._resetLayout=function(){this.x=0,this.y=0,this.maxY=0,this._getMeasurement("gutter","outerWidth")},b.prototype._getItemLayoutPosition=function(a){a.getSize();var b=a.size.outerWidth+this.gutter,c=this.isotope.size.innerWidth+this.gutter;0!==this.x&&b+this.x>c&&(this.x=0,this.y=this.maxY);var d={x:this.x,y:this.y};return this.maxY=Math.max(this.maxY,this.y+a.size.outerHeight),this.x+=b,d},b.prototype._getContainerSize=function(){return{height:this.maxY}},b}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("isotope/js/layout-modes/vertical",["../layout-mode"],b):"object"==typeof exports?module.exports=b(require("../layout-mode")):b(a.Isotope.LayoutMode)}(window,function(a){"use strict";var b=a.create("vertical",{horizontalAlignment:0});return b.prototype._resetLayout=function(){this.y=0},b.prototype._getItemLayoutPosition=function(a){a.getSize();var b=(this.isotope.size.innerWidth-a.size.outerWidth)*this.options.horizontalAlignment,c=this.y;return this.y+=a.size.outerHeight,{x:b,y:c}},b.prototype._getContainerSize=function(){return{height:this.y}},b}),function(a,b){"use strict";"function"==typeof define&&define.amd?define(["outlayer/outlayer","get-size/get-size","matches-selector/matches-selector","fizzy-ui-utils/utils","isotope/js/item","isotope/js/layout-mode","isotope/js/layout-modes/masonry","isotope/js/layout-modes/fit-rows","isotope/js/layout-modes/vertical"],function(c,d,e,f,g,h){return b(a,c,d,e,f,g,h)}):"object"==typeof exports?module.exports=b(a,require("outlayer"),require("get-size"),require("desandro-matches-selector"),require("fizzy-ui-utils"),require("./item"),require("./layout-mode"),require("./layout-modes/masonry"),require("./layout-modes/fit-rows"),require("./layout-modes/vertical")):a.Isotope=b(a,a.Outlayer,a.getSize,a.matchesSelector,a.fizzyUIUtils,a.Isotope.Item,a.Isotope.LayoutMode)}(window,function(a,b,c,d,e,f,g){function h(a,b){return function(c,d){for(var e=0,f=a.length;f>e;e++){var g=a[e],h=c.sortData[g],i=d.sortData[g];if(h>i||i>h){var j=void 0!==b[g]?b[g]:b,k=j?1:-1;return(h>i?1:-1)*k}}return 0}}var i=a.jQuery,j=String.prototype.trim?function(a){return a.trim()}:function(a){return a.replace(/^\s+|\s+$/g,"")},k=document.documentElement,l=k.textContent?function(a){return a.textContent}:function(a){return a.innerText},m=b.create("isotope",{layoutMode:"masonry",isJQueryFiltering:!0,sortAscending:!0});m.Item=f,m.LayoutMode=g,m.prototype._create=function(){this.itemGUID=0,this._sorters={},this._getSorters(),b.prototype._create.call(this),this.modes={},this.filteredItems=this.items,this.sortHistory=["original-order"];for(var a in g.modes)this._initLayoutMode(a)},m.prototype.reloadItems=function(){this.itemGUID=0,b.prototype.reloadItems.call(this)},m.prototype._itemize=function(){for(var a=b.prototype._itemize.apply(this,arguments),c=0,d=a.length;d>c;c++){var e=a[c];e.id=this.itemGUID++}return this._updateItemsSortData(a),a},m.prototype._initLayoutMode=function(a){var b=g.modes[a],c=this.options[a]||{};this.options[a]=b.options?e.extend(b.options,c):c,this.modes[a]=new b(this)},m.prototype.layout=function(){return!this._isLayoutInited&&this.options.isInitLayout?void this.arrange():void this._layout()},m.prototype._layout=function(){var a=this._getIsInstant();this._resetLayout(),this._manageStamps(),this.layoutItems(this.filteredItems,a),this._isLayoutInited=!0},m.prototype.arrange=function(a){function b(){d.reveal(c.needReveal),d.hide(c.needHide)}this.option(a),this._getIsInstant();var c=this._filter(this.items);this.filteredItems=c.matches;var d=this;this._bindArrangeComplete(),this._isInstant?this._noTransition(b):b(),this._sort(),this._layout()},m.prototype._init=m.prototype.arrange,m.prototype._getIsInstant=function(){var a=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;return this._isInstant=a,a},m.prototype._bindArrangeComplete=function(){function a(){b&&c&&d&&e.dispatchEvent("arrangeComplete",null,[e.filteredItems])}var b,c,d,e=this;this.once("layoutComplete",function(){b=!0,a()}),this.once("hideComplete",function(){c=!0,a()}),this.once("revealComplete",function(){d=!0,a()})},m.prototype._filter=function(a){var b=this.options.filter;b=b||"*";for(var c=[],d=[],e=[],f=this._getFilterTest(b),g=0,h=a.length;h>g;g++){var i=a[g];if(!i.isIgnored){var j=f(i);j&&c.push(i),j&&i.isHidden?d.push(i):j||i.isHidden||e.push(i)}}return{matches:c,needReveal:d,needHide:e}},m.prototype._getFilterTest=function(a){return i&&this.options.isJQueryFiltering?function(b){return i(b.element).is(a)}:"function"==typeof a?function(b){return a(b.element)}:function(b){return d(b.element,a)}},m.prototype.updateSortData=function(a){var b;a?(a=e.makeArray(a),b=this.getItems(a)):b=this.items,this._getSorters(),this._updateItemsSortData(b)},m.prototype._getSorters=function(){var a=this.options.getSortData;for(var b in a){var c=a[b];this._sorters[b]=n(c)}},m.prototype._updateItemsSortData=function(a){for(var b=a&&a.length,c=0;b&&b>c;c++){var d=a[c];d.updateSortData()}};var n=function(){function a(a){if("string"!=typeof a)return a;var c=j(a).split(" "),d=c[0],e=d.match(/^\[(.+)\]$/),f=e&&e[1],g=b(f,d),h=m.sortDataParsers[c[1]];return a=h?function(a){return a&&h(g(a))}:function(a){return a&&g(a)}}function b(a,b){var c;return c=a?function(b){return b.getAttribute(a)}:function(a){var c=a.querySelector(b);return c&&l(c)}}return a}();m.sortDataParsers={parseInt:function(a){return parseInt(a,10)},parseFloat:function(a){return parseFloat(a)}},m.prototype._sort=function(){var a=this.options.sortBy;if(a){var b=[].concat.apply(a,this.sortHistory),c=h(b,this.options.sortAscending);this.filteredItems.sort(c),a!=this.sortHistory[0]&&this.sortHistory.unshift(a)}},m.prototype._mode=function(){var a=this.options.layoutMode,b=this.modes[a];if(!b)throw new Error("No layout mode: "+a);return b.options=this.options[a],b},m.prototype._resetLayout=function(){b.prototype._resetLayout.call(this),this._mode()._resetLayout()},m.prototype._getItemLayoutPosition=function(a){return this._mode()._getItemLayoutPosition(a)},m.prototype._manageStamp=function(a){this._mode()._manageStamp(a)},m.prototype._getContainerSize=function(){return this._mode()._getContainerSize()},m.prototype.needsResizeLayout=function(){return this._mode().needsResizeLayout()},m.prototype.appended=function(a){var b=this.addItems(a);if(b.length){var c=this._filterRevealAdded(b);this.filteredItems=this.filteredItems.concat(c)}},m.prototype.prepended=function(a){var b=this._itemize(a);if(b.length){this._resetLayout(),this._manageStamps();var c=this._filterRevealAdded(b);this.layoutItems(this.filteredItems),this.filteredItems=c.concat(this.filteredItems),this.items=b.concat(this.items)}},m.prototype._filterRevealAdded=function(a){var b=this._filter(a);return this.hide(b.needHide),this.reveal(b.matches),this.layoutItems(b.matches,!0),b.matches},m.prototype.insert=function(a){var b=this.addItems(a);if(b.length){var c,d,e=b.length;for(c=0;e>c;c++)d=b[c],this.element.appendChild(d.element);var f=this._filter(b).matches;for(c=0;e>c;c++)b[c].isLayoutInstant=!0;for(this.arrange(),c=0;e>c;c++)delete b[c].isLayoutInstant;this.reveal(f)}};var o=m.prototype.remove;return m.prototype.remove=function(a){a=e.makeArray(a);var b=this.getItems(a);o.call(this,a);var c=b&&b.length;if(c)for(var d=0;c>d;d++){var f=b[d];e.removeFrom(this.filteredItems,f)}},m.prototype.shuffle=function(){for(var a=0,b=this.items.length;b>a;a++){var c=this.items[a];c.sortData.random=Math.random()}this.options.sortBy="random",this._sort(),this._layout()},m.prototype._noTransition=function(a){var b=this.options.transitionDuration;this.options.transitionDuration=0;var c=a.call(this);return this.options.transitionDuration=b,c},m.prototype.getFilteredItemElements=function(){for(var a=[],b=0,c=this.filteredItems.length;c>b;b++)a.push(this.filteredItems[b].element);return a},m});

/*!
 * imagesLoaded PACKAGED v4.1.0
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}(this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||[];return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter")):t.imagesLoaded=e(t,t.EvEmitter)}(window,function(t,e){function i(t,e){for(var i in e)t[i]=e[i];return t}function n(t){var e=[];if(Array.isArray(t))e=t;else if("number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e}function o(t,e,r){return this instanceof o?("string"==typeof t&&(t=document.querySelectorAll(t)),this.elements=n(t),this.options=i({},this.options),"function"==typeof e?r=e:i(this.options,e),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(t,e,r)}function r(t){this.img=t}function s(t,e){this.url=t,this.element=e,this.img=new Image}var h=t.jQuery,a=t.console;o.prototype=Object.create(e.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),this.options.background===!0&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&d[e]){for(var i=t.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(e.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,t),n=i.exec(e.backgroundImage)}},o.prototype.addImage=function(t){var e=new r(t);this.images.push(e)},o.prototype.addBackground=function(t,e){var i=new s(t,e);this.images.push(i)},o.prototype.check=function(){function t(t,i,n){setTimeout(function(){e.progress(t,i,n)})}var e=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(e){e.once("progress",t),e.check()}):void this.complete()},o.prototype.progress=function(t,e,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,t,e)},o.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},r.prototype=Object.create(e.prototype),r.prototype.check=function(){var t=this.getIsImageComplete();return t?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var t=this.getIsImageComplete();t&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},o.makeJQueryPlugin=function(e){e=e||t.jQuery,e&&(h=e,h.fn.imagesLoaded=function(t,e){var i=new o(this,t,e);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

/**
Slick
*/
!function(i){"use strict";"function"==typeof define&&define.amd?define(["jquery"],i):"undefined"!=typeof exports?module.exports=i(require("jquery")):i(jQuery)}(function(i){"use strict";var e=window.Slick||{};e=function(){function e(e,o){var s,n=this;n.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:i(e),appendDots:i(e),arrows:!0,asNavFor:null,prevArrow:'<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><span class="ion-ios-arrow-left"></span></button>',nextArrow:'<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><span class="ion-ios-arrow-right"></span></button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(i,e){return'<button type="button" data-role="none" role="button" aria-required="false" tabindex="0">'+(e+1)+"</button>"},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",edgeFriction:.35,fade:!1,focusOnSelect:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",mobileFirst:!1,pauseOnHover:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rows:1,rtl:!1,slide:"",slidesPerRow:1,slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,useTransform:!1,variableWidth:!1,vertical:!1,verticalSwiping:!1,waitForAnimate:!0,zIndex:1e3},n.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,$list:null,touchObject:{},transformsEnabled:!1,unslicked:!1},i.extend(n,n.initials),n.activeBreakpoint=null,n.animType=null,n.animProp=null,n.breakpoints=[],n.breakpointSettings=[],n.cssTransitions=!1,n.hidden="hidden",n.paused=!1,n.positionProp=null,n.respondTo=null,n.rowCount=1,n.shouldClick=!0,n.$slider=i(e),n.$slidesCache=null,n.transformType=null,n.transitionType=null,n.visibilityChange="visibilitychange",n.windowWidth=0,n.windowTimer=null,s=i(e).data("slick")||{},n.options=i.extend({},n.defaults,s,o),n.currentSlide=n.options.initialSlide,n.originalSettings=n.options,"undefined"!=typeof document.mozHidden?(n.hidden="mozHidden",n.visibilityChange="mozvisibilitychange"):"undefined"!=typeof document.webkitHidden&&(n.hidden="webkitHidden",n.visibilityChange="webkitvisibilitychange"),n.autoPlay=i.proxy(n.autoPlay,n),n.autoPlayClear=i.proxy(n.autoPlayClear,n),n.changeSlide=i.proxy(n.changeSlide,n),n.clickHandler=i.proxy(n.clickHandler,n),n.selectHandler=i.proxy(n.selectHandler,n),n.setPosition=i.proxy(n.setPosition,n),n.swipeHandler=i.proxy(n.swipeHandler,n),n.dragHandler=i.proxy(n.dragHandler,n),n.keyHandler=i.proxy(n.keyHandler,n),n.autoPlayIterator=i.proxy(n.autoPlayIterator,n),n.instanceUid=t++,n.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,n.registerBreakpoints(),n.init(!0),n.checkResponsive(!0)}var t=0;return e}(),e.prototype.addSlide=e.prototype.slickAdd=function(e,t,o){var s=this;if("boolean"==typeof t)o=t,t=null;else if(0>t||t>=s.slideCount)return!1;s.unload(),"number"==typeof t?0===t&&0===s.$slides.length?i(e).appendTo(s.$slideTrack):o?i(e).insertBefore(s.$slides.eq(t)):i(e).insertAfter(s.$slides.eq(t)):o===!0?i(e).prependTo(s.$slideTrack):i(e).appendTo(s.$slideTrack),s.$slides=s.$slideTrack.children(this.options.slide),s.$slideTrack.children(this.options.slide).detach(),s.$slideTrack.append(s.$slides),s.$slides.each(function(e,t){i(t).attr("data-slick-index",e)}),s.$slidesCache=s.$slides,s.reinit()},e.prototype.animateHeight=function(){var i=this;if(1===i.options.slidesToShow&&i.options.adaptiveHeight===!0&&i.options.vertical===!1){var e=i.$slides.eq(i.currentSlide).outerHeight(!0);i.$list.animate({height:e},i.options.speed)}},e.prototype.animateSlide=function(e,t){var o={},s=this;s.animateHeight(),s.options.rtl===!0&&s.options.vertical===!1&&(e=-e),s.transformsEnabled===!1?s.options.vertical===!1?s.$slideTrack.animate({left:e},s.options.speed,s.options.easing,t):s.$slideTrack.animate({top:e},s.options.speed,s.options.easing,t):s.cssTransitions===!1?(s.options.rtl===!0&&(s.currentLeft=-s.currentLeft),i({animStart:s.currentLeft}).animate({animStart:e},{duration:s.options.speed,easing:s.options.easing,step:function(i){i=Math.ceil(i),s.options.vertical===!1?(o[s.animType]="translate("+i+"px, 0px)",s.$slideTrack.css(o)):(o[s.animType]="translate(0px,"+i+"px)",s.$slideTrack.css(o))},complete:function(){t&&t.call()}})):(s.applyTransition(),e=Math.ceil(e),s.options.vertical===!1?o[s.animType]="translate3d("+e+"px, 0px, 0px)":o[s.animType]="translate3d(0px,"+e+"px, 0px)",s.$slideTrack.css(o),t&&setTimeout(function(){s.disableTransition(),t.call()},s.options.speed))},e.prototype.asNavFor=function(e){var t=this,o=t.options.asNavFor;o&&null!==o&&(o=i(o).not(t.$slider)),null!==o&&"object"==typeof o&&o.each(function(){var t=i(this).slick("getSlick");t.unslicked||t.slideHandler(e,!0)})},e.prototype.applyTransition=function(i){var e=this,t={};e.options.fade===!1?t[e.transitionType]=e.transformType+" "+e.options.speed+"ms "+e.options.cssEase:t[e.transitionType]="opacity "+e.options.speed+"ms "+e.options.cssEase,e.options.fade===!1?e.$slideTrack.css(t):e.$slides.eq(i).css(t)},e.prototype.autoPlay=function(){var i=this;i.autoPlayTimer&&clearInterval(i.autoPlayTimer),i.slideCount>i.options.slidesToShow&&i.paused!==!0&&(i.autoPlayTimer=setInterval(i.autoPlayIterator,i.options.autoplaySpeed))},e.prototype.autoPlayClear=function(){var i=this;i.autoPlayTimer&&clearInterval(i.autoPlayTimer)},e.prototype.autoPlayIterator=function(){var i=this;i.options.infinite===!1?1===i.direction?(i.currentSlide+1===i.slideCount-1&&(i.direction=0),i.slideHandler(i.currentSlide+i.options.slidesToScroll)):(i.currentSlide-1===0&&(i.direction=1),i.slideHandler(i.currentSlide-i.options.slidesToScroll)):i.slideHandler(i.currentSlide+i.options.slidesToScroll)},e.prototype.buildArrows=function(){var e=this;e.options.arrows===!0&&(e.$prevArrow=i(e.options.prevArrow).addClass("slick-arrow"),e.$nextArrow=i(e.options.nextArrow).addClass("slick-arrow"),e.slideCount>e.options.slidesToShow?(e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),e.htmlExpr.test(e.options.prevArrow)&&e.$prevArrow.prependTo(e.options.appendArrows),e.htmlExpr.test(e.options.nextArrow)&&e.$nextArrow.appendTo(e.options.appendArrows),e.options.infinite!==!0&&e.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true")):e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({"aria-disabled":"true",tabindex:"-1"}))},e.prototype.buildDots=function(){var e,t,o=this;if(o.options.dots===!0&&o.slideCount>o.options.slidesToShow){for(t='<ul class="'+o.options.dotsClass+'">',e=0;e<=o.getDotCount();e+=1)t+="<li>"+o.options.customPaging.call(this,o,e)+"</li>";t+="</ul>",o.$dots=i(t).appendTo(o.options.appendDots),o.$dots.find("li").first().addClass("slick-active").attr("aria-hidden","false")}},e.prototype.buildOut=function(){var e=this;e.$slides=e.$slider.children(e.options.slide+":not(.slick-cloned)").addClass("slick-slide"),e.slideCount=e.$slides.length,e.$slides.each(function(e,t){i(t).attr("data-slick-index",e).data("originalStyling",i(t).attr("style")||"")}),e.$slider.addClass("slick-slider"),e.$slideTrack=0===e.slideCount?i('<div class="slick-track"/>').appendTo(e.$slider):e.$slides.wrapAll('<div class="slick-track"/>').parent(),e.$list=e.$slideTrack.wrap('<div aria-live="polite" class="slick-list"/>').parent(),e.$slideTrack.css("opacity",0),(e.options.centerMode===!0||e.options.swipeToSlide===!0)&&(e.options.slidesToScroll=1),i("img[data-original]",e.$slider).not("[src]").addClass("slick-loading"),e.setupInfinite(),e.buildArrows(),e.buildDots(),e.updateDots(),e.setSlideClasses("number"==typeof e.currentSlide?e.currentSlide:0),e.options.draggable===!0&&e.$list.addClass("draggable")},e.prototype.buildRows=function(){var i,e,t,o,s,n,r,l=this;if(o=document.createDocumentFragment(),n=l.$slider.children(),l.options.rows>1){for(r=l.options.slidesPerRow*l.options.rows,s=Math.ceil(n.length/r),i=0;s>i;i++){var a=document.createElement("div");for(e=0;e<l.options.rows;e++){var d=document.createElement("div");for(t=0;t<l.options.slidesPerRow;t++){var c=i*r+(e*l.options.slidesPerRow+t);n.get(c)&&d.appendChild(n.get(c))}a.appendChild(d)}o.appendChild(a)}l.$slider.html(o),l.$slider.children().children().children().css({width:100/l.options.slidesPerRow+"%",display:"inline-block"})}},e.prototype.checkResponsive=function(e,t){var o,s,n,r=this,l=!1,a=r.$slider.width(),d=window.innerWidth||i(window).width();if("window"===r.respondTo?n=d:"slider"===r.respondTo?n=a:"min"===r.respondTo&&(n=Math.min(d,a)),r.options.responsive&&r.options.responsive.length&&null!==r.options.responsive){s=null;for(o in r.breakpoints)r.breakpoints.hasOwnProperty(o)&&(r.originalSettings.mobileFirst===!1?n<r.breakpoints[o]&&(s=r.breakpoints[o]):n>r.breakpoints[o]&&(s=r.breakpoints[o]));null!==s?null!==r.activeBreakpoint?(s!==r.activeBreakpoint||t)&&(r.activeBreakpoint=s,"unslick"===r.breakpointSettings[s]?r.unslick(s):(r.options=i.extend({},r.originalSettings,r.breakpointSettings[s]),e===!0&&(r.currentSlide=r.options.initialSlide),r.refresh(e)),l=s):(r.activeBreakpoint=s,"unslick"===r.breakpointSettings[s]?r.unslick(s):(r.options=i.extend({},r.originalSettings,r.breakpointSettings[s]),e===!0&&(r.currentSlide=r.options.initialSlide),r.refresh(e)),l=s):null!==r.activeBreakpoint&&(r.activeBreakpoint=null,r.options=r.originalSettings,e===!0&&(r.currentSlide=r.options.initialSlide),r.refresh(e),l=s),e||l===!1||r.$slider.trigger("breakpoint",[r,l])}},e.prototype.changeSlide=function(e,t){var o,s,n,r=this,l=i(e.target);switch(l.is("a")&&e.preventDefault(),l.is("li")||(l=l.closest("li")),n=r.slideCount%r.options.slidesToScroll!==0,o=n?0:(r.slideCount-r.currentSlide)%r.options.slidesToScroll,e.data.message){case"previous":s=0===o?r.options.slidesToScroll:r.options.slidesToShow-o,r.slideCount>r.options.slidesToShow&&r.slideHandler(r.currentSlide-s,!1,t);break;case"next":s=0===o?r.options.slidesToScroll:o,r.slideCount>r.options.slidesToShow&&r.slideHandler(r.currentSlide+s,!1,t);break;case"index":var a=0===e.data.index?0:e.data.index||l.index()*r.options.slidesToScroll;r.slideHandler(r.checkNavigable(a),!1,t),l.children().trigger("focus");break;default:return}},e.prototype.checkNavigable=function(i){var e,t,o=this;if(e=o.getNavigableIndexes(),t=0,i>e[e.length-1])i=e[e.length-1];else for(var s in e){if(i<e[s]){i=t;break}t=e[s]}return i},e.prototype.cleanUpEvents=function(){var e=this;e.options.dots&&null!==e.$dots&&(i("li",e.$dots).off("click.slick",e.changeSlide),e.options.pauseOnDotsHover===!0&&e.options.autoplay===!0&&i("li",e.$dots).off("mouseenter.slick",i.proxy(e.setPaused,e,!0)).off("mouseleave.slick",i.proxy(e.setPaused,e,!1))),e.options.arrows===!0&&e.slideCount>e.options.slidesToShow&&(e.$prevArrow&&e.$prevArrow.off("click.slick",e.changeSlide),e.$nextArrow&&e.$nextArrow.off("click.slick",e.changeSlide)),e.$list.off("touchstart.slick mousedown.slick",e.swipeHandler),e.$list.off("touchmove.slick mousemove.slick",e.swipeHandler),e.$list.off("touchend.slick mouseup.slick",e.swipeHandler),e.$list.off("touchcancel.slick mouseleave.slick",e.swipeHandler),e.$list.off("click.slick",e.clickHandler),i(document).off(e.visibilityChange,e.visibility),e.$list.off("mouseenter.slick",i.proxy(e.setPaused,e,!0)),e.$list.off("mouseleave.slick",i.proxy(e.setPaused,e,!1)),e.options.accessibility===!0&&e.$list.off("keydown.slick",e.keyHandler),e.options.focusOnSelect===!0&&i(e.$slideTrack).children().off("click.slick",e.selectHandler),i(window).off("orientationchange.slick.slick-"+e.instanceUid,e.orientationChange),i(window).off("resize.slick.slick-"+e.instanceUid,e.resize),i("[draggable!=true]",e.$slideTrack).off("dragstart",e.preventDefault),i(window).off("load.slick.slick-"+e.instanceUid,e.setPosition),i(document).off("ready.slick.slick-"+e.instanceUid,e.setPosition)},e.prototype.cleanUpRows=function(){var i,e=this;e.options.rows>1&&(i=e.$slides.children().children(),i.removeAttr("style"),e.$slider.html(i))},e.prototype.clickHandler=function(i){var e=this;e.shouldClick===!1&&(i.stopImmediatePropagation(),i.stopPropagation(),i.preventDefault())},e.prototype.destroy=function(e){var t=this;t.autoPlayClear(),t.touchObject={},t.cleanUpEvents(),i(".slick-cloned",t.$slider).detach(),t.$dots&&t.$dots.remove(),t.$prevArrow&&t.$prevArrow.length&&(t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),t.htmlExpr.test(t.options.prevArrow)&&t.$prevArrow.remove()),t.$nextArrow&&t.$nextArrow.length&&(t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),t.htmlExpr.test(t.options.nextArrow)&&t.$nextArrow.remove()),t.$slides&&(t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function(){i(this).attr("style",i(this).data("originalStyling"))}),t.$slideTrack.children(this.options.slide).detach(),t.$slideTrack.detach(),t.$list.detach(),t.$slider.append(t.$slides)),t.cleanUpRows(),t.$slider.removeClass("slick-slider"),t.$slider.removeClass("slick-initialized"),t.unslicked=!0,e||t.$slider.trigger("destroy",[t])},e.prototype.disableTransition=function(i){var e=this,t={};t[e.transitionType]="",e.options.fade===!1?e.$slideTrack.css(t):e.$slides.eq(i).css(t)},e.prototype.fadeSlide=function(i,e){var t=this;t.cssTransitions===!1?(t.$slides.eq(i).css({zIndex:t.options.zIndex}),t.$slides.eq(i).animate({opacity:1},t.options.speed,t.options.easing,e)):(t.applyTransition(i),t.$slides.eq(i).css({opacity:1,zIndex:t.options.zIndex}),e&&setTimeout(function(){t.disableTransition(i),e.call()},t.options.speed))},e.prototype.fadeSlideOut=function(i){var e=this;e.cssTransitions===!1?e.$slides.eq(i).animate({opacity:0,zIndex:e.options.zIndex-2},e.options.speed,e.options.easing):(e.applyTransition(i),e.$slides.eq(i).css({opacity:0,zIndex:e.options.zIndex-2}))},e.prototype.filterSlides=e.prototype.slickFilter=function(i){var e=this;null!==i&&(e.$slidesCache=e.$slides,e.unload(),e.$slideTrack.children(this.options.slide).detach(),e.$slidesCache.filter(i).appendTo(e.$slideTrack),e.reinit())},e.prototype.getCurrent=e.prototype.slickCurrentSlide=function(){var i=this;return i.currentSlide},e.prototype.getDotCount=function(){var i=this,e=0,t=0,o=0;if(i.options.infinite===!0)for(;e<i.slideCount;)++o,e=t+i.options.slidesToScroll,t+=i.options.slidesToScroll<=i.options.slidesToShow?i.options.slidesToScroll:i.options.slidesToShow;else if(i.options.centerMode===!0)o=i.slideCount;else for(;e<i.slideCount;)++o,e=t+i.options.slidesToScroll,t+=i.options.slidesToScroll<=i.options.slidesToShow?i.options.slidesToScroll:i.options.slidesToShow;return o-1},e.prototype.getLeft=function(i){var e,t,o,s=this,n=0;return s.slideOffset=0,t=s.$slides.first().outerHeight(!0),s.options.infinite===!0?(s.slideCount>s.options.slidesToShow&&(s.slideOffset=s.slideWidth*s.options.slidesToShow*-1,n=t*s.options.slidesToShow*-1),s.slideCount%s.options.slidesToScroll!==0&&i+s.options.slidesToScroll>s.slideCount&&s.slideCount>s.options.slidesToShow&&(i>s.slideCount?(s.slideOffset=(s.options.slidesToShow-(i-s.slideCount))*s.slideWidth*-1,n=(s.options.slidesToShow-(i-s.slideCount))*t*-1):(s.slideOffset=s.slideCount%s.options.slidesToScroll*s.slideWidth*-1,n=s.slideCount%s.options.slidesToScroll*t*-1))):i+s.options.slidesToShow>s.slideCount&&(s.slideOffset=(i+s.options.slidesToShow-s.slideCount)*s.slideWidth,n=(i+s.options.slidesToShow-s.slideCount)*t),s.slideCount<=s.options.slidesToShow&&(s.slideOffset=0,n=0),s.options.centerMode===!0&&s.options.infinite===!0?s.slideOffset+=s.slideWidth*Math.floor(s.options.slidesToShow/2)-s.slideWidth:s.options.centerMode===!0&&(s.slideOffset=0,s.slideOffset+=s.slideWidth*Math.floor(s.options.slidesToShow/2)),e=s.options.vertical===!1?i*s.slideWidth*-1+s.slideOffset:i*t*-1+n,s.options.variableWidth===!0&&(o=s.slideCount<=s.options.slidesToShow||s.options.infinite===!1?s.$slideTrack.children(".slick-slide").eq(i):s.$slideTrack.children(".slick-slide").eq(i+s.options.slidesToShow),e=s.options.rtl===!0?o[0]?-1*(s.$slideTrack.width()-o[0].offsetLeft-o.width()):0:o[0]?-1*o[0].offsetLeft:0,s.options.centerMode===!0&&(o=s.slideCount<=s.options.slidesToShow||s.options.infinite===!1?s.$slideTrack.children(".slick-slide").eq(i):s.$slideTrack.children(".slick-slide").eq(i+s.options.slidesToShow+1),e=s.options.rtl===!0?o[0]?-1*(s.$slideTrack.width()-o[0].offsetLeft-o.width()):0:o[0]?-1*o[0].offsetLeft:0,e+=(s.$list.width()-o.outerWidth())/2)),e},e.prototype.getOption=e.prototype.slickGetOption=function(i){var e=this;return e.options[i]},e.prototype.getNavigableIndexes=function(){var i,e=this,t=0,o=0,s=[];for(e.options.infinite===!1?i=e.slideCount:(t=-1*e.options.slidesToScroll,o=-1*e.options.slidesToScroll,i=2*e.slideCount);i>t;)s.push(t),t=o+e.options.slidesToScroll,o+=e.options.slidesToScroll<=e.options.slidesToShow?e.options.slidesToScroll:e.options.slidesToShow;return s},e.prototype.getSlick=function(){return this},e.prototype.getSlideCount=function(){var e,t,o,s=this;return o=s.options.centerMode===!0?s.slideWidth*Math.floor(s.options.slidesToShow/2):0,s.options.swipeToSlide===!0?(s.$slideTrack.find(".slick-slide").each(function(e,n){return n.offsetLeft-o+i(n).outerWidth()/2>-1*s.swipeLeft?(t=n,!1):void 0}),e=Math.abs(i(t).attr("data-slick-index")-s.currentSlide)||1):s.options.slidesToScroll},e.prototype.goTo=e.prototype.slickGoTo=function(i,e){var t=this;t.changeSlide({data:{message:"index",index:parseInt(i)}},e)},e.prototype.init=function(e){var t=this;i(t.$slider).hasClass("slick-initialized")||(i(t.$slider).addClass("slick-initialized"),t.buildRows(),t.buildOut(),t.setProps(),t.startLoad(),t.loadSlider(),t.initializeEvents(),t.updateArrows(),t.updateDots()),e&&t.$slider.trigger("init",[t]),t.options.accessibility===!0&&t.initADA()},e.prototype.initArrowEvents=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.on("click.slick",{message:"previous"},i.changeSlide),i.$nextArrow.on("click.slick",{message:"next"},i.changeSlide))},e.prototype.initDotEvents=function(){var e=this;e.options.dots===!0&&e.slideCount>e.options.slidesToShow&&i("li",e.$dots).on("click.slick",{message:"index"},e.changeSlide),e.options.dots===!0&&e.options.pauseOnDotsHover===!0&&e.options.autoplay===!0&&i("li",e.$dots).on("mouseenter.slick",i.proxy(e.setPaused,e,!0)).on("mouseleave.slick",i.proxy(e.setPaused,e,!1))},e.prototype.initializeEvents=function(){var e=this;e.initArrowEvents(),e.initDotEvents(),e.$list.on("touchstart.slick mousedown.slick",{action:"start"},e.swipeHandler),e.$list.on("touchmove.slick mousemove.slick",{action:"move"},e.swipeHandler),e.$list.on("touchend.slick mouseup.slick",{action:"end"},e.swipeHandler),e.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},e.swipeHandler),e.$list.on("click.slick",e.clickHandler),i(document).on(e.visibilityChange,i.proxy(e.visibility,e)),e.$list.on("mouseenter.slick",i.proxy(e.setPaused,e,!0)),e.$list.on("mouseleave.slick",i.proxy(e.setPaused,e,!1)),e.options.accessibility===!0&&e.$list.on("keydown.slick",e.keyHandler),e.options.focusOnSelect===!0&&i(e.$slideTrack).children().on("click.slick",e.selectHandler),i(window).on("orientationchange.slick.slick-"+e.instanceUid,i.proxy(e.orientationChange,e)),i(window).on("resize.slick.slick-"+e.instanceUid,i.proxy(e.resize,e)),i("[draggable!=true]",e.$slideTrack).on("dragstart",e.preventDefault),i(window).on("load.slick.slick-"+e.instanceUid,e.setPosition),i(document).on("ready.slick.slick-"+e.instanceUid,e.setPosition)},e.prototype.initUI=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.show(),i.$nextArrow.show()),i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&i.$dots.show(),i.options.autoplay===!0&&i.autoPlay()},e.prototype.keyHandler=function(i){var e=this;i.target.tagName.match("TEXTAREA|INPUT|SELECT")||(37===i.keyCode&&e.options.accessibility===!0?e.changeSlide({data:{message:"previous"}}):39===i.keyCode&&e.options.accessibility===!0&&e.changeSlide({data:{message:"next"}}))},e.prototype.lazyLoad=function(){function e(e){i("img[data-original]",e).each(function(){var e=i(this),t=i(this).attr("data-original"),o=document.createElement("img");o.onload=function(){e.animate({opacity:0},100,function(){e.attr("src",t).animate({opacity:1},200,function(){e.removeAttr("data-original").removeClass("slick-loading")})})},o.src=t})}var t,o,s,n,r=this;r.options.centerMode===!0?r.options.infinite===!0?(s=r.currentSlide+(r.options.slidesToShow/2+1),n=s+r.options.slidesToShow+2):(s=Math.max(0,r.currentSlide-(r.options.slidesToShow/2+1)),n=2+(r.options.slidesToShow/2+1)+r.currentSlide):(s=r.options.infinite?r.options.slidesToShow+r.currentSlide:r.currentSlide,n=s+r.options.slidesToShow,r.options.fade===!0&&(s>0&&s--,n<=r.slideCount&&n++)),t=r.$slider.find(".slick-slide").slice(s,n),e(t),r.slideCount<=r.options.slidesToShow?(o=r.$slider.find(".slick-slide"),e(o)):r.currentSlide>=r.slideCount-r.options.slidesToShow?(o=r.$slider.find(".slick-cloned").slice(0,r.options.slidesToShow),e(o)):0===r.currentSlide&&(o=r.$slider.find(".slick-cloned").slice(-1*r.options.slidesToShow),e(o))},e.prototype.loadSlider=function(){var i=this;i.setPosition(),i.$slideTrack.css({opacity:1}),i.$slider.removeClass("slick-loading"),i.initUI(),"progressive"===i.options.lazyLoad&&i.progressiveLazyLoad()},e.prototype.next=e.prototype.slickNext=function(){var i=this;i.changeSlide({data:{message:"next"}})},e.prototype.orientationChange=function(){var i=this;i.checkResponsive(),i.setPosition()},e.prototype.pause=e.prototype.slickPause=function(){var i=this;i.autoPlayClear(),i.paused=!0},e.prototype.play=e.prototype.slickPlay=function(){var i=this;i.paused=!1,i.autoPlay()},e.prototype.postSlide=function(i){var e=this;e.$slider.trigger("afterChange",[e,i]),e.animating=!1,e.setPosition(),e.swipeLeft=null,e.options.autoplay===!0&&e.paused===!1&&e.autoPlay(),e.options.accessibility===!0&&e.initADA()},e.prototype.prev=e.prototype.slickPrev=function(){var i=this;i.changeSlide({data:{message:"previous"}})},e.prototype.preventDefault=function(i){i.preventDefault()},e.prototype.progressiveLazyLoad=function(){var e,t,o=this;e=i("img[data-original]",o.$slider).length,e>0&&(t=i("img[data-original]",o.$slider).first(),t.attr("src",null),t.attr("src",t.attr("data-original")).removeClass("slick-loading").load(function(){t.removeAttr("data-original"),o.progressiveLazyLoad(),o.options.adaptiveHeight===!0&&o.setPosition()}).error(function(){t.removeAttr("data-original"),o.progressiveLazyLoad()}))},e.prototype.refresh=function(e){var t,o,s=this;o=s.slideCount-s.options.slidesToShow,s.options.infinite||(s.slideCount<=s.options.slidesToShow?s.currentSlide=0:s.currentSlide>o&&(s.currentSlide=o)),t=s.currentSlide,s.destroy(!0),i.extend(s,s.initials,{currentSlide:t}),s.init(),e||s.changeSlide({data:{message:"index",index:t}},!1)},e.prototype.registerBreakpoints=function(){var e,t,o,s=this,n=s.options.responsive||null;if("array"===i.type(n)&&n.length){s.respondTo=s.options.respondTo||"window";for(e in n)if(o=s.breakpoints.length-1,t=n[e].breakpoint,n.hasOwnProperty(e)){for(;o>=0;)s.breakpoints[o]&&s.breakpoints[o]===t&&s.breakpoints.splice(o,1),o--;s.breakpoints.push(t),s.breakpointSettings[t]=n[e].settings}s.breakpoints.sort(function(i,e){return s.options.mobileFirst?i-e:e-i})}},e.prototype.reinit=function(){var e=this;e.$slides=e.$slideTrack.children(e.options.slide).addClass("slick-slide"),e.slideCount=e.$slides.length,e.currentSlide>=e.slideCount&&0!==e.currentSlide&&(e.currentSlide=e.currentSlide-e.options.slidesToScroll),e.slideCount<=e.options.slidesToShow&&(e.currentSlide=0),e.registerBreakpoints(),e.setProps(),e.setupInfinite(),e.buildArrows(),e.updateArrows(),e.initArrowEvents(),e.buildDots(),e.updateDots(),e.initDotEvents(),e.checkResponsive(!1,!0),e.options.focusOnSelect===!0&&i(e.$slideTrack).children().on("click.slick",e.selectHandler),e.setSlideClasses(0),e.setPosition(),e.$slider.trigger("reInit",[e]),e.options.autoplay===!0&&e.focusHandler()},e.prototype.resize=function(){var e=this;i(window).width()!==e.windowWidth&&(clearTimeout(e.windowDelay),e.windowDelay=window.setTimeout(function(){e.windowWidth=i(window).width(),e.checkResponsive(),e.unslicked||e.setPosition()},50))},e.prototype.removeSlide=e.prototype.slickRemove=function(i,e,t){var o=this;return"boolean"==typeof i?(e=i,i=e===!0?0:o.slideCount-1):i=e===!0?--i:i,o.slideCount<1||0>i||i>o.slideCount-1?!1:(o.unload(),t===!0?o.$slideTrack.children().remove():o.$slideTrack.children(this.options.slide).eq(i).remove(),o.$slides=o.$slideTrack.children(this.options.slide),o.$slideTrack.children(this.options.slide).detach(),o.$slideTrack.append(o.$slides),o.$slidesCache=o.$slides,void o.reinit())},e.prototype.setCSS=function(i){var e,t,o=this,s={};o.options.rtl===!0&&(i=-i),e="left"==o.positionProp?Math.ceil(i)+"px":"0px",t="top"==o.positionProp?Math.ceil(i)+"px":"0px",s[o.positionProp]=i,o.transformsEnabled===!1?o.$slideTrack.css(s):(s={},o.cssTransitions===!1?(s[o.animType]="translate("+e+", "+t+")",o.$slideTrack.css(s)):(s[o.animType]="translate3d("+e+", "+t+", 0px)",o.$slideTrack.css(s)))},e.prototype.setDimensions=function(){var i=this;i.options.vertical===!1?i.options.centerMode===!0&&i.$list.css({padding:"0px "+i.options.centerPadding}):(i.$list.height(i.$slides.first().outerHeight(!0)*i.options.slidesToShow),i.options.centerMode===!0&&i.$list.css({padding:i.options.centerPadding+" 0px"})),i.listWidth=i.$list.width(),i.listHeight=i.$list.height(),i.options.vertical===!1&&i.options.variableWidth===!1?(i.slideWidth=Math.ceil(i.listWidth/i.options.slidesToShow),i.$slideTrack.width(Math.ceil(i.slideWidth*i.$slideTrack.children(".slick-slide").length))):i.options.variableWidth===!0?i.$slideTrack.width(5e3*i.slideCount):(i.slideWidth=Math.ceil(i.listWidth),i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0)*i.$slideTrack.children(".slick-slide").length)));var e=i.$slides.first().outerWidth(!0)-i.$slides.first().width();i.options.variableWidth===!1&&i.$slideTrack.children(".slick-slide").width(i.slideWidth-e)},e.prototype.setFade=function(){var e,t=this;t.$slides.each(function(o,s){e=t.slideWidth*o*-1,t.options.rtl===!0?i(s).css({position:"relative",right:e,top:0,zIndex:t.options.zIndex-2,opacity:0}):i(s).css({position:"relative",left:e,top:0,zIndex:t.options.zIndex-2,opacity:0})}),t.$slides.eq(t.currentSlide).css({zIndex:t.options.zIndex-1,opacity:1})},e.prototype.setHeight=function(){var i=this;if(1===i.options.slidesToShow&&i.options.adaptiveHeight===!0&&i.options.vertical===!1){var e=i.$slides.eq(i.currentSlide).outerHeight(!0);i.$list.css("height",e)}},e.prototype.setOption=e.prototype.slickSetOption=function(e,t,o){var s,n,r=this;if("responsive"===e&&"array"===i.type(t))for(n in t)if("array"!==i.type(r.options.responsive))r.options.responsive=[t[n]];else{for(s=r.options.responsive.length-1;s>=0;)r.options.responsive[s].breakpoint===t[n].breakpoint&&r.options.responsive.splice(s,1),s--;r.options.responsive.push(t[n])}else r.options[e]=t;o===!0&&(r.unload(),r.reinit())},e.prototype.setPosition=function(){var i=this;i.setDimensions(),i.setHeight(),i.options.fade===!1?i.setCSS(i.getLeft(i.currentSlide)):i.setFade(),i.$slider.trigger("setPosition",[i])},e.prototype.setProps=function(){var i=this,e=document.body.style;i.positionProp=i.options.vertical===!0?"top":"left","top"===i.positionProp?i.$slider.addClass("slick-vertical"):i.$slider.removeClass("slick-vertical"),(void 0!==e.WebkitTransition||void 0!==e.MozTransition||void 0!==e.msTransition)&&i.options.useCSS===!0&&(i.cssTransitions=!0),i.options.fade&&("number"==typeof i.options.zIndex?i.options.zIndex<3&&(i.options.zIndex=3):i.options.zIndex=i.defaults.zIndex),void 0!==e.OTransform&&(i.animType="OTransform",i.transformType="-o-transform",i.transitionType="OTransition",void 0===e.perspectiveProperty&&void 0===e.webkitPerspective&&(i.animType=!1)),void 0!==e.MozTransform&&(i.animType="MozTransform",i.transformType="-moz-transform",i.transitionType="MozTransition",void 0===e.perspectiveProperty&&void 0===e.MozPerspective&&(i.animType=!1)),void 0!==e.webkitTransform&&(i.animType="webkitTransform",i.transformType="-webkit-transform",i.transitionType="webkitTransition",void 0===e.perspectiveProperty&&void 0===e.webkitPerspective&&(i.animType=!1)),void 0!==e.msTransform&&(i.animType="msTransform",i.transformType="-ms-transform",i.transitionType="msTransition",void 0===e.msTransform&&(i.animType=!1)),void 0!==e.transform&&i.animType!==!1&&(i.animType="transform",i.transformType="transform",i.transitionType="transition"),i.transformsEnabled=i.options.useTransform&&null!==i.animType&&i.animType!==!1},e.prototype.setSlideClasses=function(i){var e,t,o,s,n=this;t=n.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden","true"),n.$slides.eq(i).addClass("slick-current"),n.options.centerMode===!0?(e=Math.floor(n.options.slidesToShow/2),n.options.infinite===!0&&(i>=e&&i<=n.slideCount-1-e?n.$slides.slice(i-e,i+e+1).addClass("slick-active").attr("aria-hidden","false"):(o=n.options.slidesToShow+i,t.slice(o-e+1,o+e+2).addClass("slick-active").attr("aria-hidden","false")),0===i?t.eq(t.length-1-n.options.slidesToShow).addClass("slick-center"):i===n.slideCount-1&&t.eq(n.options.slidesToShow).addClass("slick-center")),n.$slides.eq(i).addClass("slick-center")):i>=0&&i<=n.slideCount-n.options.slidesToShow?n.$slides.slice(i,i+n.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false"):t.length<=n.options.slidesToShow?t.addClass("slick-active").attr("aria-hidden","false"):(s=n.slideCount%n.options.slidesToShow,o=n.options.infinite===!0?n.options.slidesToShow+i:i,n.options.slidesToShow==n.options.slidesToScroll&&n.slideCount-i<n.options.slidesToShow?t.slice(o-(n.options.slidesToShow-s),o+s).addClass("slick-active").attr("aria-hidden","false"):t.slice(o,o+n.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false")),"ondemand"===n.options.lazyLoad&&n.lazyLoad()},e.prototype.setupInfinite=function(){var e,t,o,s=this;if(s.options.fade===!0&&(s.options.centerMode=!1),s.options.infinite===!0&&s.options.fade===!1&&(t=null,s.slideCount>s.options.slidesToShow)){for(o=s.options.centerMode===!0?s.options.slidesToShow+1:s.options.slidesToShow,e=s.slideCount;e>s.slideCount-o;e-=1)t=e-1,i(s.$slides[t]).clone(!0).attr("id","").attr("data-slick-index",t-s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");for(e=0;o>e;e+=1)t=e,i(s.$slides[t]).clone(!0).attr("id","").attr("data-slick-index",t+s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");s.$slideTrack.find(".slick-cloned").find("[id]").each(function(){i(this).attr("id","")})}},e.prototype.setPaused=function(i){var e=this;e.options.autoplay===!0&&e.options.pauseOnHover===!0&&(e.paused=i,i?e.autoPlayClear():e.autoPlay())},e.prototype.selectHandler=function(e){var t=this,o=i(e.target).is(".slick-slide")?i(e.target):i(e.target).parents(".slick-slide"),s=parseInt(o.attr("data-slick-index"));return s||(s=0),t.slideCount<=t.options.slidesToShow?(t.setSlideClasses(s),void t.asNavFor(s)):void t.slideHandler(s)},e.prototype.slideHandler=function(i,e,t){var o,s,n,r,l=null,a=this;return e=e||!1,a.animating===!0&&a.options.waitForAnimate===!0||a.options.fade===!0&&a.currentSlide===i||a.slideCount<=a.options.slidesToShow?void 0:(e===!1&&a.asNavFor(i),o=i,l=a.getLeft(o),r=a.getLeft(a.currentSlide),a.currentLeft=null===a.swipeLeft?r:a.swipeLeft,a.options.infinite===!1&&a.options.centerMode===!1&&(0>i||i>a.getDotCount()*a.options.slidesToScroll)?void(a.options.fade===!1&&(o=a.currentSlide,
t!==!0?a.animateSlide(r,function(){a.postSlide(o)}):a.postSlide(o))):a.options.infinite===!1&&a.options.centerMode===!0&&(0>i||i>a.slideCount-a.options.slidesToScroll)?void(a.options.fade===!1&&(o=a.currentSlide,t!==!0?a.animateSlide(r,function(){a.postSlide(o)}):a.postSlide(o))):(a.options.autoplay===!0&&clearInterval(a.autoPlayTimer),s=0>o?a.slideCount%a.options.slidesToScroll!==0?a.slideCount-a.slideCount%a.options.slidesToScroll:a.slideCount+o:o>=a.slideCount?a.slideCount%a.options.slidesToScroll!==0?0:o-a.slideCount:o,a.animating=!0,a.$slider.trigger("beforeChange",[a,a.currentSlide,s]),n=a.currentSlide,a.currentSlide=s,a.setSlideClasses(a.currentSlide),a.updateDots(),a.updateArrows(),a.options.fade===!0?(t!==!0?(a.fadeSlideOut(n),a.fadeSlide(s,function(){a.postSlide(s)})):a.postSlide(s),void a.animateHeight()):void(t!==!0?a.animateSlide(l,function(){a.postSlide(s)}):a.postSlide(s))))},e.prototype.startLoad=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.hide(),i.$nextArrow.hide()),i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&i.$dots.hide(),i.$slider.addClass("slick-loading")},e.prototype.swipeDirection=function(){var i,e,t,o,s=this;return i=s.touchObject.startX-s.touchObject.curX,e=s.touchObject.startY-s.touchObject.curY,t=Math.atan2(e,i),o=Math.round(180*t/Math.PI),0>o&&(o=360-Math.abs(o)),45>=o&&o>=0?s.options.rtl===!1?"left":"right":360>=o&&o>=315?s.options.rtl===!1?"left":"right":o>=135&&225>=o?s.options.rtl===!1?"right":"left":s.options.verticalSwiping===!0?o>=35&&135>=o?"left":"right":"vertical"},e.prototype.swipeEnd=function(i){var e,t=this;if(t.dragging=!1,t.shouldClick=t.touchObject.swipeLength>10?!1:!0,void 0===t.touchObject.curX)return!1;if(t.touchObject.edgeHit===!0&&t.$slider.trigger("edge",[t,t.swipeDirection()]),t.touchObject.swipeLength>=t.touchObject.minSwipe)switch(t.swipeDirection()){case"left":e=t.options.swipeToSlide?t.checkNavigable(t.currentSlide+t.getSlideCount()):t.currentSlide+t.getSlideCount(),t.slideHandler(e),t.currentDirection=0,t.touchObject={},t.$slider.trigger("swipe",[t,"left"]);break;case"right":e=t.options.swipeToSlide?t.checkNavigable(t.currentSlide-t.getSlideCount()):t.currentSlide-t.getSlideCount(),t.slideHandler(e),t.currentDirection=1,t.touchObject={},t.$slider.trigger("swipe",[t,"right"])}else t.touchObject.startX!==t.touchObject.curX&&(t.slideHandler(t.currentSlide),t.touchObject={})},e.prototype.swipeHandler=function(i){var e=this;if(!(e.options.swipe===!1||"ontouchend"in document&&e.options.swipe===!1||e.options.draggable===!1&&-1!==i.type.indexOf("mouse")))switch(e.touchObject.fingerCount=i.originalEvent&&void 0!==i.originalEvent.touches?i.originalEvent.touches.length:1,e.touchObject.minSwipe=e.listWidth/e.options.touchThreshold,e.options.verticalSwiping===!0&&(e.touchObject.minSwipe=e.listHeight/e.options.touchThreshold),i.data.action){case"start":e.swipeStart(i);break;case"move":e.swipeMove(i);break;case"end":e.swipeEnd(i)}},e.prototype.swipeMove=function(i){var e,t,o,s,n,r=this;return n=void 0!==i.originalEvent?i.originalEvent.touches:null,!r.dragging||n&&1!==n.length?!1:(e=r.getLeft(r.currentSlide),r.touchObject.curX=void 0!==n?n[0].pageX:i.clientX,r.touchObject.curY=void 0!==n?n[0].pageY:i.clientY,r.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(r.touchObject.curX-r.touchObject.startX,2))),r.options.verticalSwiping===!0&&(r.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(r.touchObject.curY-r.touchObject.startY,2)))),t=r.swipeDirection(),"vertical"!==t?(void 0!==i.originalEvent&&r.touchObject.swipeLength>4&&i.preventDefault(),s=(r.options.rtl===!1?1:-1)*(r.touchObject.curX>r.touchObject.startX?1:-1),r.options.verticalSwiping===!0&&(s=r.touchObject.curY>r.touchObject.startY?1:-1),o=r.touchObject.swipeLength,r.touchObject.edgeHit=!1,r.options.infinite===!1&&(0===r.currentSlide&&"right"===t||r.currentSlide>=r.getDotCount()&&"left"===t)&&(o=r.touchObject.swipeLength*r.options.edgeFriction,r.touchObject.edgeHit=!0),r.options.vertical===!1?r.swipeLeft=e+o*s:r.swipeLeft=e+o*(r.$list.height()/r.listWidth)*s,r.options.verticalSwiping===!0&&(r.swipeLeft=e+o*s),r.options.fade===!0||r.options.touchMove===!1?!1:r.animating===!0?(r.swipeLeft=null,!1):void r.setCSS(r.swipeLeft)):void 0)},e.prototype.swipeStart=function(i){var e,t=this;return 1!==t.touchObject.fingerCount||t.slideCount<=t.options.slidesToShow?(t.touchObject={},!1):(void 0!==i.originalEvent&&void 0!==i.originalEvent.touches&&(e=i.originalEvent.touches[0]),t.touchObject.startX=t.touchObject.curX=void 0!==e?e.pageX:i.clientX,t.touchObject.startY=t.touchObject.curY=void 0!==e?e.pageY:i.clientY,void(t.dragging=!0))},e.prototype.unfilterSlides=e.prototype.slickUnfilter=function(){var i=this;null!==i.$slidesCache&&(i.unload(),i.$slideTrack.children(this.options.slide).detach(),i.$slidesCache.appendTo(i.$slideTrack),i.reinit())},e.prototype.unload=function(){var e=this;i(".slick-cloned",e.$slider).remove(),e.$dots&&e.$dots.remove(),e.$prevArrow&&e.htmlExpr.test(e.options.prevArrow)&&e.$prevArrow.remove(),e.$nextArrow&&e.htmlExpr.test(e.options.nextArrow)&&e.$nextArrow.remove(),e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden","true").css("width","")},e.prototype.unslick=function(i){var e=this;e.$slider.trigger("unslick",[e,i]),e.destroy()},e.prototype.updateArrows=function(){var i,e=this;i=Math.floor(e.options.slidesToShow/2),e.options.arrows===!0&&e.slideCount>e.options.slidesToShow&&!e.options.infinite&&(e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false"),e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false"),0===e.currentSlide?(e.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true"),e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false")):e.currentSlide>=e.slideCount-e.options.slidesToShow&&e.options.centerMode===!1?(e.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")):e.currentSlide>=e.slideCount-1&&e.options.centerMode===!0&&(e.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")))},e.prototype.updateDots=function(){var i=this;null!==i.$dots&&(i.$dots.find("li").removeClass("slick-active").attr("aria-hidden","true"),i.$dots.find("li").eq(Math.floor(i.currentSlide/i.options.slidesToScroll)).addClass("slick-active").attr("aria-hidden","false"))},e.prototype.visibility=function(){var i=this;document[i.hidden]?(i.paused=!0,i.autoPlayClear()):i.options.autoplay===!0&&(i.paused=!1,i.autoPlay())},e.prototype.initADA=function(){var e=this;e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({"aria-hidden":"true",tabindex:"-1"}).find("a, input, button, select").attr({tabindex:"-1"}),e.$slideTrack.attr("role","listbox"),e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function(t){i(this).attr({role:"option","aria-describedby":"slick-slide"+e.instanceUid+t})}),null!==e.$dots&&e.$dots.attr("role","tablist").find("li").each(function(t){i(this).attr({role:"presentation","aria-selected":"false","aria-controls":"navigation"+e.instanceUid+t,id:"slick-slide"+e.instanceUid+t})}).first().attr("aria-selected","true").end().find("button").attr("role","button").end().closest("div").attr("role","toolbar"),e.activateADA()},e.prototype.activateADA=function(){var i=this;i.$slideTrack.find(".slick-active").attr({"aria-hidden":"false"}).find("a, input, button, select").attr({tabindex:"0"})},e.prototype.focusHandler=function(){var e=this;e.$slider.on("focus.slick blur.slick","*",function(t){t.stopImmediatePropagation();var o=i(this);setTimeout(function(){e.isPlay&&(o.is(":focus")?(e.autoPlayClear(),e.paused=!0):(e.paused=!1,e.autoPlay()))},0)})},i.fn.slick=function(){var i,t,o=this,s=arguments[0],n=Array.prototype.slice.call(arguments,1),r=o.length;for(i=0;r>i;i++)if("object"==typeof s||"undefined"==typeof s?o[i].slick=new e(o[i],s):t=o[i].slick[s].apply(o[i].slick,n),"undefined"!=typeof t)return t;return o}});


/**
Lazy Load
*/
/*! lazyload 1.5.8 by Andrea "verlok" Verlicchi*/
!function(t,e,r,o){var i=t(e);t.fn.lazyload=function(n){function a(){var e=0;l.each(function(){var r=t(this);if(!s.skip_invisible||r.is(":visible"))if(t.abovethetop(this,s)||t.leftofbegin(this,s));else if(t.belowthefold(this,s)||t.rightoffold(this,s)){if(++e>s.failure_limit)return!1}else r.trigger("appear"),e=0})}var f,l=this,s={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:e,data_attribute:"original",data_src_set:"srcset",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return n&&(o!==n.failurelimit&&(n.failure_limit=n.failurelimit,delete n.failurelimit),o!==n.effectspeed&&(n.effect_speed=n.effectspeed,delete n.effectspeed),t.extend(s,n)),f=s.container===o||s.container===e?i:t(s.container),0===s.event.indexOf("scroll")&&f.bind(s.event,function(){return a()}),this.each(function(){var e=this,r=t(e);e.loaded=!1,(r.attr("src")===o||r.attr("src")===!1)&&r.is("img"),r.one("appear",function(){if(!this.loaded){if(s.appear){var o=l.length;s.appear.call(e,o,s)}t("<img />").bind("load",function(){var o=r.attr("data-"+s.data_attribute),i=r.attr("data-"+s.data_src_set);r.hide(),r.is("img")?(r.attr("src",o),r.attr("srcset",i),r.removeAttr("data-"+s.data_attribute),r.removeAttr("data-"+s.data_src_set),r.removeClass("lazy"),r.removeAttr("style")):r.css("background-image","url('"+o+"')"),r[s.effect](s.effect_speed),e.loaded=!0;var n=t.grep(l,function(t){return!t.loaded});if(l=t(n),s.load){var a=l.length;s.load.call(e,a,s)}}).attr("src",r.attr("data-"+s.data_attribute))}}),0!==s.event.indexOf("scroll")&&r.bind(s.event,function(){e.loaded||r.trigger("appear")})}),i.bind("resize",function(){a()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&i.bind("pageshow",function(e){e.originalEvent&&e.originalEvent.persisted&&l.each(function(){t(this).trigger("appear")})}),t(r).ready(function(){a()}),this},t.belowthefold=function(r,n){var a;return a=n.container===o||n.container===e?(e.innerHeight?e.innerHeight:i.height())+i.scrollTop():t(n.container).offset().top+t(n.container).height(),a<=t(r).offset().top+n.threshold},t.rightoffold=function(r,n){var a;return a=n.container===o||n.container===e?i.width()+i.scrollLeft():t(n.container).offset().left+t(n.container).width(),a<=t(r).offset().left-n.threshold},t.abovethetop=function(r,n){var a;return a=n.container===o||n.container===e?i.scrollTop():t(n.container).offset().top,a>=t(r).offset().top+n.threshold+t(r).height()},t.leftofbegin=function(r,n){var a;return a=n.container===o||n.container===e?i.scrollLeft():t(n.container).offset().left,a>=t(r).offset().left+n.threshold+t(r).width()},t.inviewport=function(e,r){return!(t.rightoffold(e,r)||t.leftofbegin(e,r)||t.belowthefold(e,r)||t.abovethetop(e,r))},t.extend(t.expr[":"],{"below-the-fold":function(e){return t.belowthefold(e,{threshold:0})},"above-the-top":function(e){return!t.belowthefold(e,{threshold:0})},"right-of-screen":function(e){return t.rightoffold(e,{threshold:0})},"left-of-screen":function(e){return!t.rightoffold(e,{threshold:0})},"in-viewport":function(e){return t.inviewport(e,{threshold:0})},"above-the-fold":function(e){return!t.belowthefold(e,{threshold:0})},"right-of-fold":function(e){return t.rightoffold(e,{threshold:0})},"left-of-fold":function(e){return!t.rightoffold(e,{threshold:0})}})}(jQuery,window,document);

//# sourceMappingURL=lazyload.min.js.map
/*
 Retina
 */
 (function(){var c=(typeof exports==="undefined"?window:exports);var d={retinaImageSuffix:"@2x",check_mime_type:true,force_original_dimensions:true};function b(){}c.Retina=b;b.configure=function(h){if(h===null){h={}}for(var i in h){if(h.hasOwnProperty(i)){d[i]=h[i]}}};b.init=function(h){if(h===null){h=c}var i=h.onload||function(){};h.onload=function(){var j=document.querySelectorAll("img.df-header-logo"),m=[],n,o;for(n=0;n<j.length;n+=1){o=j[n];if(!!!o.getAttributeNode("data-no-retina")){m.push(new e(o))}}var k=document.querySelectorAll("img.df-footer-logo-img"),m=[],n,l;for(n=0;n<k.length;n+=1){l=k[n];if(!!!l.getAttributeNode("data-no-retina")){m.push(new e(l))}}i()}};b.isRetina=function(){var h="(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)";if(c.devicePixelRatio>1){return true}if(c.matchMedia&&c.matchMedia(h).matches){return true}return false};var g=/\.\w+$/;function a(h){return d.retinaImageSuffix+h}function f(k,i){this.path=k||"";if(typeof i!=="undefined"&&i!==null){this.at_2x_path=i;this.perform_check=false}else{if(undefined!==document.createElement){var h=document.createElement("a");h.href=this.path;h.pathname=h.pathname.replace(g,a);this.at_2x_path=h.href}else{var j=this.path.split("?");j[0]=j[0].replace(g,a);this.at_2x_path=j.join("?")}this.perform_check=true}}c.RetinaImagePath=f;f.confirmed_paths=[];f.prototype.is_external=function(){return !!(this.path.match(/^https?\:/i)&&!this.path.match("//"+document.domain))};f.prototype.check_2x_variant=function(j){var h,i=this;if(this.is_external()){return j(false)}else{if(!this.perform_check&&typeof this.at_2x_path!=="undefined"&&this.at_2x_path!==null){return j(true)}else{if(this.at_2x_path in f.confirmed_paths){return j(true)}else{h=new XMLHttpRequest();h.open("HEAD",this.at_2x_path);h.onreadystatechange=function(){if(h.readyState!==4){return j(false)}if(h.status>=200&&h.status<=399){if(d.check_mime_type){var k=h.getResponseHeader("Content-Type");if(k===null||!k.match(/^image/i)){return j(false)}}f.confirmed_paths.push(i.at_2x_path);console.log(i.at_2x_path);return j(true)}else{return j(false)}};h.send()}}}};function e(h){this.el=h;this.path=new f(this.el.getAttribute("src"),this.el.getAttribute("data-at2x"));var i=this;this.path.check_2x_variant(function(j){if(j){i.swap()}})}c.RetinaImage=e;e.prototype.swap=function(j){if(typeof j==="undefined"){j=this.path.at_2x_path}var h=this;function i(){if(!h.el.complete){setTimeout(i,5)}else{if(d.force_original_dimensions){h.el.setAttribute("width",h.el.offsetWidth);h.el.setAttribute("height",h.el.offsetHeight)}h.el.setAttribute("src",j)}}i()};if(b.isRetina()){b.init(c)}})();

// !function(t,e,r,o){var i=t(e);t.fn.lazyload=function(n){function a(){var e=0;l.each(function(){var r=t(this);if(!s.skip_invisible||r.is(":visible"))if(t.abovethetop(this,s)||t.leftofbegin(this,s));else if(t.belowthefold(this,s)||t.rightoffold(this,s)){if(++e>s.failure_limit)return console.log(e),!1}else r.trigger("appear"),e=0})}var f,l=this,s={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:e,data_attribute:"original",data_src_set:"srcset",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return n&&(o!==n.failurelimit&&(n.failure_limit=n.failurelimit,delete n.failurelimit),o!==n.effectspeed&&(n.effect_speed=n.effectspeed,delete n.effectspeed),t.extend(s,n)),f=s.container===o||s.container===e?i:t(s.container),0===s.event.indexOf("scroll")&&f.bind(s.event,function(){return a()}),this.each(function(){var e=this,r=t(e);e.loaded=!1,(r.attr("src")===o||r.attr("src")===!1)&&r.is("img")&&(r.attr("src",s.placeholder),r.attr("height")!==o&&r.attr("style","height : "+r.attr("height")+"px!important;")),r.one("appear",function(){if(!this.loaded){if(s.appear){var o=l.length;s.appear.call(e,o,s)}t("<img />").bind("load",function(){var o=r.attr("data-"+s.data_attribute),i=r.attr("data-"+s.data_src_set);r.hide(),r.is("img")?(r.attr("src",o),r.attr("srcset",i),r.removeAttr("data-"+s.data_attribute),r.removeAttr("data-"+s.data_src_set),r.removeClass("lazy"),r.removeAttr("style")):r.css("background-image","url('"+o+"')"),r[s.effect](s.effect_speed),e.loaded=!0;var n=t.grep(l,function(t){return!t.loaded});if(l=t(n),s.load){var a=l.length;s.load.call(e,a,s)}}).attr("src",r.attr("data-"+s.data_attribute)).attr("srcset",r.attr("data-"+s.data_src_set))}}),0!==s.event.indexOf("scroll")&&r.bind(s.event,function(){e.loaded||r.trigger("appear")})}),i.bind("resize",function(){a()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&i.bind("pageshow",function(e){e.originalEvent&&e.originalEvent.persisted&&l.each(function(){t(this).trigger("appear")})}),t(r).ready(function(){a()}),this},t.belowthefold=function(r,n){var a;return a=n.container===o||n.container===e?(e.innerHeight?e.innerHeight:i.height())+i.scrollTop():t(n.container).offset().top+t(n.container).height(),a<=t(r).offset().top+n.threshold},t.rightoffold=function(r,n){var a;return a=n.container===o||n.container===e?i.width()+i.scrollLeft():t(n.container).offset().left+t(n.container).width(),a<=t(r).offset().left-n.threshold},t.abovethetop=function(r,n){var a;return a=n.container===o||n.container===e?i.scrollTop():t(n.container).offset().top,a>=t(r).offset().top+n.threshold+t(r).height()},t.leftofbegin=function(r,n){var a;return a=n.container===o||n.container===e?i.scrollLeft():t(n.container).offset().left,a>=t(r).offset().left+n.threshold+t(r).width()},t.inviewport=function(e,r){return!(t.rightoffold(e,r)||t.leftofbegin(e,r)||t.belowthefold(e,r)||t.abovethetop(e,r))},t.extend(t.expr[":"],{"below-the-fold":function(e){return t.belowthefold(e,{threshold:0})},"above-the-top":function(e){return!t.belowthefold(e,{threshold:0})},"right-of-screen":function(e){return t.rightoffold(e,{threshold:0})},"left-of-screen":function(e){return!t.rightoffold(e,{threshold:0})},"in-viewport":function(e){return t.inviewport(e,{threshold:0})},"above-the-fold":function(e){return!t.belowthefold(e,{threshold:0})},"right-of-fold":function(e){return t.rightoffold(e,{threshold:0})},"left-of-fold":function(e){return!t.rightoffold(e,{threshold:0})}})}(jQuery,window,document);

/*!
 * animsition v4.0.1
 * A simple and easy jQuery plugin for CSS animated page transitions.
 * http://blivesta.github.io/animsition
 * License : MIT
 * Author : blivesta (http://blivesta.com/)
 */
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){"use strict";var n="animsition",i={init:function(a){a=t.extend({inClass:"fade-in",outClass:"fade-out",inDuration:1500,outDuration:800,linkElement:".animsition-link",loading:!0,loadingParentElement:"body",loadingClass:"animsition-loading",loadingInner:"",timeout:!1,timeoutCountdown:5e3,onLoadEvent:!0,browser:["animation-duration","-webkit-animation-duration"],overlay:!1,overlayClass:"animsition-overlay-slide",overlayParentElement:"body",transition:function(t){window.location.href=t}},a),i.settings={timer:!1,data:{inClass:"animsition-in-class",inDuration:"animsition-in-duration",outClass:"animsition-out-class",outDuration:"animsition-out-duration",overlay:"animsition-overlay"},events:{inStart:"animsition.inStart",inEnd:"animsition.inEnd",outStart:"animsition.outStart",outEnd:"animsition.outEnd"}};var o=i.supportCheck.call(this,a);if(!o&&a.browser.length>0&&(!o||!this.length))return"console"in window||(window.console={},window.console.log=function(t){return t}),this.length||console.log("Animsition: Element does not exist on page."),o||console.log("Animsition: Does not support this browser."),i.destroy.call(this);var e=i.optionCheck.call(this,a);return e&&i.addOverlay.call(this,a),a.loading&&i.addLoading.call(this,a),this.each(function(){var o=this,e=t(this),s=t(window),r=t(document),l=e.data(n);l||(a=t.extend({},a),e.data(n,{options:a}),a.timeout&&i.addTimer.call(o),a.onLoadEvent&&s.on("load."+n,function(){i.settings.timer&&clearTimeout(i.settings.timer),i["in"].call(o)}),s.on("pageshow."+n,function(t){t.originalEvent.persisted&&i["in"].call(o)}),s.on("unload."+n,function(){}),r.on("click."+n,a.linkElement,function(n){n.preventDefault();var a=t(this),e=a.attr("href");2===n.which||n.metaKey||n.shiftKey||-1!==navigator.platform.toUpperCase().indexOf("WIN")&&n.ctrlKey?window.open(e,"_blank"):i.out.call(o,a,e)}))})},addOverlay:function(n){t(n.overlayParentElement).prepend('<div class="'+n.overlayClass+'"></div>')},addLoading:function(n){t(n.loadingParentElement).append('<div class="'+n.loadingClass+'">'+n.loadingInner+"</div>")},removeLoading:function(){var i=t(this),a=i.data(n).options,o=t(a.loadingParentElement).children("."+a.loadingClass);o.fadeOut().remove()},addTimer:function(){var a=this,o=t(this),e=o.data(n).options;i.settings.timer=setTimeout(function(){i["in"].call(a),t(window).off("load."+n)},e.timeoutCountdown)},supportCheck:function(n){var i=t(this),a=n.browser,o=a.length,e=!1;0===o&&(e=!0);for(var s=0;o>s;s++)if("string"==typeof i.css(a[s])){e=!0;break}return e},optionCheck:function(n){var a,o=t(this);return a=n.overlay||o.data(i.settings.data.overlay)?!0:!1},animationCheck:function(i,a,o){var e=t(this),s=e.data(n).options,r=typeof i,l=!a&&"number"===r,d=a&&"string"===r&&i.length>0;return l||d?i=i:a&&o?i=s.inClass:!a&&o?i=s.inDuration:a&&!o?i=s.outClass:a||o||(i=s.outDuration),i},"in":function(){var a=this,o=t(this),e=o.data(n).options,s=o.data(i.settings.data.inDuration),r=o.data(i.settings.data.inClass),l=i.animationCheck.call(a,s,!1,!0),d=i.animationCheck.call(a,r,!0,!0),u=i.optionCheck.call(a,e),c=o.data(n).outClass;e.loading&&i.removeLoading.call(a),c&&o.removeClass(c),u?i.inOverlay.call(a,d,l):i.inDefault.call(a,d,l)},inDefault:function(n,a){var o=t(this);o.css({"animation-duration":a+"ms"}).addClass(n).trigger(i.settings.events.inStart).animateCallback(function(){o.removeClass(n).css({opacity:1}).trigger(i.settings.events.inEnd)})},inOverlay:function(a,o){var e=t(this),s=e.data(n).options;e.css({opacity:1}).trigger(i.settings.events.inStart),t(s.overlayParentElement).children("."+s.overlayClass).css({"animation-duration":o+"ms"}).addClass(a).animateCallback(function(){e.trigger(i.settings.events.inEnd)})},out:function(a,o){var e=this,s=t(this),r=s.data(n).options,l=a.data(i.settings.data.outClass),d=s.data(i.settings.data.outClass),u=a.data(i.settings.data.outDuration),c=s.data(i.settings.data.outDuration),m=l?l:d,g=u?u:c,f=i.animationCheck.call(e,m,!0,!1),v=i.animationCheck.call(e,g,!1,!1),h=i.optionCheck.call(e,r);s.data(n).outClass=f,h?i.outOverlay.call(e,f,v,o):i.outDefault.call(e,f,v,o)},outDefault:function(a,o,e){var s=t(this),r=s.data(n).options;s.css({"animation-duration":o+1+"ms"}).addClass(a).trigger(i.settings.events.outStart).animateCallback(function(){s.trigger(i.settings.events.outEnd),r.transition(e)})},outOverlay:function(a,o,e){var s=this,r=t(this),l=r.data(n).options,d=r.data(i.settings.data.inClass),u=i.animationCheck.call(s,d,!0,!0);t(l.overlayParentElement).children("."+l.overlayClass).css({"animation-duration":o+1+"ms"}).removeClass(u).addClass(a).trigger(i.settings.events.outStart).animateCallback(function(){r.trigger(i.settings.events.outEnd),l.transition(e)})},destroy:function(){return this.each(function(){var i=t(this);t(window).off("."+n),i.css({opacity:1}).removeData(n)})}};t.fn.animateCallback=function(n){var i="animationend webkitAnimationEnd";return this.each(function(){var a=t(this);a.on(i,function(){return a.off(i),n.call(this)})})},t.fn.animsition=function(a){return i[a]?i[a].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof a&&a?void t.error("Method "+a+" does not exist on jQuery."+n):i.init.apply(this,arguments)}});

/*
	By André Rinas, www.andreknieriem.de
	Available for use under the MIT License
*/

!function(e,t,n,i){"use strict";e.fn.simpleLightbox=function(i){var i=e.extend({overlay:!0,spinner:!0,nav:!0,navText:['<i class="ion-chevron-left"></i>','<i class="ion-chevron-right"></i>'],captions:!0,captionDelay:0,captionSelector:"img",captionType:"attr",captionsData:"title",captionPosition:"bottom",close:!0,closeText:"×",showCounter:!0,fileExt:"png|jpg|jpeg|gif",animationSlide:!0,animationSpeed:250,preloading:!0,enableKeyboard:!0,loop:!0,docClose:!0,swipeTolerance:50,className:"simple-lightbox",widthRatio:1,heightRatio:1,disableRightClick:!1,disableScroll:!0,alertError:!0,alertErrorMessage:"Image not found, next image will be loaded"},i);console.log(i);var a=(t.navigator.pointerEnabled||t.navigator.msPointerEnabled,0),o=e(),l=function(){var e=n.body||n.documentElement,e=e.style;return""==e.WebkitTransition?"-webkit-":""==e.MozTransition?"-moz-":""==e.OTransition?"-o-":""==e.transition?"":!1},s=!1,r=e(this.selector,this.context),l=l(),d=l!==!1?!0:!1,c="simplelb",p=e("<div>").addClass("sl-overlay"),g=e("<button>").addClass("sl-close").html(i.closeText),h=e("<div>").addClass("sl-spinner").html("<div></div>"),f=e("<div>").addClass("sl-navigation").html('<button class="sl-prev">'+i.navText[0]+'</button><button class="sl-next">'+i.navText[1]+"</button>"),u=e("<div>").addClass("sl-counter").html('<span class="sl-current"></span> of <span class="sl-total"></span>'),m=!1,v=0,x=e(),b=e("<div>").addClass("sl-caption pos-"+i.captionPosition),y=e("<div>").addClass("sl-wrapper").addClass(i.className).html('<div class="sl-image"></div>'),w=function(t){return i.fileExt?"a"==e(t).prop("tagName").toLowerCase()&&new RegExp(".("+i.fileExt+")$","i").test(e(t).attr("href")):!0},E=function(){x=e(".sl-image"),i.close&&g.appendTo(y),i.showCounter&&r.length>1&&(u.appendTo(y),u.find(".sl-total").text(r.length)),i.nav&&f.appendTo(y),i.spinner&&h.appendTo(y)},T=function(t){t.trigger(e.Event("show.simplelightbox")),i.disableScroll&&M("hide"),y.appendTo("body"),i.overlay&&p.appendTo(e("body")),m=!0,v=r.index(t),o=e("<img/>").hide().attr("src",t.attr("href")),e(".sl-image").html("").attr("style",""),o.appendTo(e(".sl-image")),p.fadeIn("fast"),e(".sl-close").fadeIn("fast"),h.show(),f.fadeIn("fast"),e(".sl-wrapper .sl-counter .sl-current").text(v+1),u.fadeIn("fast"),S(),i.preloading&&I(),setTimeout(function(){t.trigger(e.Event("shown.simplelightbox"))},i.animationSpeed)},S=function(n){if(o.length){var a=new Image,l=e(t).width()*i.widthRatio,c=e(t).height()*i.heightRatio;a.src=o.attr("src"),e(a).bind("error",function(t){return r.eq(v).trigger(e.Event("error.simplelightbox")),m=!1,s=!0,h.hide(),i.alertError?(alert(i.alertErrorMessage),void D(1==n||-1==n?n:1)):void 0}),a.onload=function(){"undefined"!=typeof n&&r.eq(v).trigger(e.Event("changed.simplelightbox")).trigger(e.Event((1===n?"nextDone":"prevDone")+".simplelightbox"));var p=a.width,g=a.height;if(p>l||g>c){var f=p/g>l/c?p/l:g/c;p/=f,g/=f}e(".sl-image").css({top:(e(t).height()*i.heightRatio-g)/2+"px",left:(e(t).width()*i.widthRatio-p)/2+"px"}),h.hide(),o.css({width:p+"px",height:g+"px"}).fadeIn("fast"),s=!0;var u="self"==i.captionSelector?r.eq(v):r.eq(v).find(i.captionSelector);if("data"==i.captionType)var x=u.data(i.captionsData);else if("text"==i.captionType)var x=u.html();else var x=u.prop(i.captionsData);if(i.loop||(0==v&&e(".sl-prev").hide(),v>=r.length-1&&e(".sl-next").hide(),v>0&&v<r.length-1&&e(".sl-prev, .sl-next").show()),1==r.length&&e(".sl-prev, .sl-next").hide(),1==n||-1==n){var b={opacity:1};i.animationSlide&&(d?(k(0,100*n+"px"),setTimeout(function(){k(i.animationSpeed/1e3,"0px"),50})):b.left=parseInt(e(".sl-image").css("left"))+100*n+"px"),e(".sl-image").animate(b,i.animationSpeed,function(){m=!1,C(x)})}else m=!1,C(x)}}},C=function(t){""!=t&&"undefined"!=typeof t&&i.captions&&b.html(t).hide().appendTo(e(".df-lightbox-article-description")).delay(i.captionDelay).fadeIn("fast")},k=function(t,n){var i={};i[l+"transform"]="translateX("+n+")",i[l+"transition"]=l+"transform "+t+"s linear",e(".sl-image").css(i)},I=function(){var t=0>v+1?r.length-1:v+1>=r.length-1?0:v+1,n=0>v-1?r.length-1:v-1>=r.length-1?0:v-1;e("<img />").attr("src",r.eq(t).attr("href")).load(function(){r.eq(v).trigger(e.Event("nextImageLoaded.simplelightbox"))}),e("<img />").attr("src",r.eq(n).attr("href")).load(function(){r.eq(v).trigger(e.Event("prevImageLoaded.simplelightbox"))})},D=function(t){r.eq(v).trigger(e.Event("change.simplelightbox")).trigger(e.Event((1===t?"next":"prev")+".simplelightbox")),h.show();var n=v+t;if(!(m||(0>n||n>=r.length)&&0==i.loop)){v=0>n?r.length-1:n>r.length-1?0:n,e(".sl-wrapper .sl-counter .sl-current").text(v+1);var l={opacity:0};i.animationSlide&&(d?k(i.animationSpeed/1e3,-100*t-a+"px"):l.left=parseInt(e(".sl-image").css("left"))+-100*t+"px"),e(".sl-image").animate(l,i.animationSpeed,function(){setTimeout(function(){var n=r.eq(v);o.attr("src",n.attr("href")),e(".sl-caption").remove(),S(t),i.preloading&&I()},100)})}},q=function(){if(!m){var t=r.eq(v),n=!1;t.trigger(e.Event("close.simplelightbox")),e(".sl-image img, .sl-overlay, .sl-close, .sl-navigation, .sl-image .sl-caption, .sl-counter").fadeOut("fast",function(){i.disableScroll&&M("show"),e(".sl-wrapper, .sl-overlay").remove(),n||t.trigger(e.Event("closed.simplelightbox")),n=!0}),o=e(),s=!1,m=!1}},M=function(i){if("hide"==i){var a=t.innerWidth;if(!a){var o=n.documentElement.getBoundingClientRect();a=o.right-Math.abs(o.left)}if(n.body.clientWidth<a){var l=n.createElement("div"),s=parseInt(e("body").css("padding-right"),10);l.className="sl-scrollbar-measure",e("body").append(l);var r=l.offsetWidth-l.clientWidth;e(n.body)[0].removeChild(l),e("body").data("padding",s),r>0&&e("body").css({"padding-right":s+r,overflow:"hidden"})}}else e("body").css({"padding-right":e("body").data("padding"),overflow:"auto"})};E(),e(t).on("resize",S),r.on("click."+c,function(t){if(w(this)){if(t.preventDefault(),m)return!1;T(e(this))}}),e(n).on("click",".sl-close",function(e){e.preventDefault(),s&&q()}),e(n).click(function(t){s&&i.docClose&&0==e(t.target).closest(".sl-image").length&&0==e(t.target).closest(".sl-navigation").length&&q()}),i.disableRightClick&&e(n).on("contextmenu",".sl-image img",function(e){return!1}),e(n).on("click",".sl-navigation button",function(t){t.preventDefault(),a=0,D(e(this).hasClass("sl-next")?1:-1)}),i.enableKeyboard&&e(n).on("keyup."+c,function(e){if(e.preventDefault(),a=0,s){var t=e.keyCode;27==t&&q(),(37==t||39==e.keyCode)&&D(39==e.keyCode?1:-1)}});var R=0,P=0,W=!1,X=0;return e(n).on("touchstart mousedown pointerdown MSPointerDown",".sl-image",function(e){return W?!0:(d&&(X=parseInt(x.css("left"))),W=!0,R=e.originalEvent.pageX||e.originalEvent.touches[0].pageX,!1)}).on("touchmove mousemove pointermove MSPointerMove",function(e){return W?(e.preventDefault(),P=e.originalEvent.pageX||e.originalEvent.touches[0].pageX,a=R-P,void(i.animationSlide&&(d?k(0,-a+"px"):x.css("left",X-a+"px")))):!0}).on("touchend mouseup touchcancel pointerup pointercancel MSPointerUp MSPointerCancel",function(e){W&&(W=!1,Math.abs(a)>i.swipeTolerance?D(a>0?1:-1):i.animationSlide&&(d?k(i.animationSpeed/1e3,"0px"):x.animate({left:X+"px"},i.animationSpeed/2)))}),this.open=function(t){t=t||e(this[0]),T(t)},this.next=function(){D(1)},this.prev=function(){D(-1)},this.close=function(){q()},this.destroy=function(){e(n).unbind("click."+c).unbind("keyup."+c),q(),e(".sl-overlay, .sl-wrapper").remove()},this}}(jQuery,window,document);!function(e,t,n,i){"use strict";e.fn.simpleLightbox=function(i){var i=e.extend({overlay:!0,spinner:!0,nav:!0,navText:['<i class="ion-chevron-left"></i>','<i class="ion-chevron-right"></i>'],captions:!0,captionDelay:0,captionSelector:"img",captionType:"attr",captionsData:"title",captionPosition:"bottom",close:!0,closeText:"×",showCounter:!0,fileExt:"png|jpg|jpeg|gif",animationSlide:!0,animationSpeed:250,preloading:!0,enableKeyboard:!0,loop:!0,docClose:!0,swipeTolerance:50,className:"simple-lightbox",widthRatio:1,heightRatio:1,disableRightClick:!1,disableScroll:!0,alertError:!0,alertErrorMessage:"Image not found, next image will be loaded"},i);console.log(i);var a=(t.navigator.pointerEnabled||t.navigator.msPointerEnabled,0),o=e(),l=function(){var e=n.body||n.documentElement,e=e.style;return""==e.WebkitTransition?"-webkit-":""==e.MozTransition?"-moz-":""==e.OTransition?"-o-":""==e.transition?"":!1},s=!1,r=e(this.selector,this.context),l=l(),d=l!==!1?!0:!1,c="simplelb",p=e("<div>").addClass("sl-overlay"),g=e("<button>").addClass("sl-close").html(i.closeText),h=e("<div>").addClass("sl-spinner").html("<div></div>"),f=e("<div>").addClass("sl-navigation").html('<button class="sl-prev">'+i.navText[0]+'</button><button class="sl-next">'+i.navText[1]+"</button>"),u=e("<div>").addClass("sl-counter").html('<span class="sl-current"></span> of <span class="sl-total"></span>'),m=!1,v=0,x=e(),b=e("<div>").addClass("sl-caption pos-"+i.captionPosition),y=e("<div>").addClass("sl-wrapper").addClass(i.className).html('<div class="sl-image"></div>'),w=function(t){return i.fileExt?"a"==e(t).prop("tagName").toLowerCase()&&new RegExp(".("+i.fileExt+")$","i").test(e(t).attr("href")):!0},E=function(){x=e(".sl-image"),i.close&&g.appendTo(y),i.showCounter&&r.length>1&&(u.appendTo(y),u.find(".sl-total").text(r.length)),i.nav&&f.appendTo(y),i.spinner&&h.appendTo(y)},T=function(t){t.trigger(e.Event("show.simplelightbox")),i.disableScroll&&M("hide"),y.appendTo("body"),i.overlay&&p.appendTo(e("body")),m=!0,v=r.index(t),o=e("<img/>").hide().attr("src",t.attr("href")),e(".sl-image").html("").attr("style",""),o.appendTo(e(".sl-image")),p.fadeIn("fast"),e(".sl-close").fadeIn("fast"),h.show(),f.fadeIn("fast"),e(".sl-wrapper .sl-counter .sl-current").text(v+1),u.fadeIn("fast"),S(),i.preloading&&I(),setTimeout(function(){t.trigger(e.Event("shown.simplelightbox"))},i.animationSpeed)},S=function(n){if(o.length){var a=new Image,l=e(t).width()*i.widthRatio,c=e(t).height()*i.heightRatio;a.src=o.attr("src"),e(a).bind("error",function(t){return r.eq(v).trigger(e.Event("error.simplelightbox")),m=!1,s=!0,h.hide(),i.alertError?(alert(i.alertErrorMessage),void D(1==n||-1==n?n:1)):void 0}),a.onload=function(){"undefined"!=typeof n&&r.eq(v).trigger(e.Event("changed.simplelightbox")).trigger(e.Event((1===n?"nextDone":"prevDone")+".simplelightbox"));var p=a.width,g=a.height;if(p>l||g>c){var f=p/g>l/c?p/l:g/c;p/=f,g/=f}e(".sl-image").css({top:(e(t).height()*i.heightRatio-g)/2+"px",left:(e(t).width()*i.widthRatio-p)/2+"px"}),h.hide(),o.css({width:p+"px",height:g+"px"}).fadeIn("fast"),s=!0;var u="self"==i.captionSelector?r.eq(v):r.eq(v).find(i.captionSelector);if("data"==i.captionType)var x=u.data(i.captionsData);else if("text"==i.captionType)var x=u.html();else var x=u.prop(i.captionsData);if(i.loop||(0==v&&e(".sl-prev").hide(),v>=r.length-1&&e(".sl-next").hide(),v>0&&v<r.length-1&&e(".sl-prev, .sl-next").show()),1==r.length&&e(".sl-prev, .sl-next").hide(),1==n||-1==n){var b={opacity:1};i.animationSlide&&(d?(k(0,100*n+"px"),setTimeout(function(){k(i.animationSpeed/1e3,"0px"),50})):b.left=parseInt(e(".sl-image").css("left"))+100*n+"px"),e(".sl-image").animate(b,i.animationSpeed,function(){m=!1,C(x)})}else m=!1,C(x)}}},C=function(t){""!=t&&"undefined"!=typeof t&&i.captions&&b.html(t).hide().appendTo(e(".df-lightbox-article-description")).delay(i.captionDelay).fadeIn("fast")},k=function(t,n){var i={};i[l+"transform"]="translateX("+n+")",i[l+"transition"]=l+"transform "+t+"s linear",e(".sl-image").css(i)},I=function(){var t=0>v+1?r.length-1:v+1>=r.length-1?0:v+1,n=0>v-1?r.length-1:v-1>=r.length-1?0:v-1;e("<img />").attr("src",r.eq(t).attr("href")).load(function(){r.eq(v).trigger(e.Event("nextImageLoaded.simplelightbox"))}),e("<img />").attr("src",r.eq(n).attr("href")).load(function(){r.eq(v).trigger(e.Event("prevImageLoaded.simplelightbox"))})},D=function(t){r.eq(v).trigger(e.Event("change.simplelightbox")).trigger(e.Event((1===t?"next":"prev")+".simplelightbox")),h.show();var n=v+t;if(!(m||(0>n||n>=r.length)&&0==i.loop)){v=0>n?r.length-1:n>r.length-1?0:n,e(".sl-wrapper .sl-counter .sl-current").text(v+1);var l={opacity:0};i.animationSlide&&(d?k(i.animationSpeed/1e3,-100*t-a+"px"):l.left=parseInt(e(".sl-image").css("left"))+-100*t+"px"),e(".sl-image").animate(l,i.animationSpeed,function(){setTimeout(function(){var n=r.eq(v);o.attr("src",n.attr("href")),e(".sl-caption").remove(),S(t),i.preloading&&I()},100)})}},q=function(){if(!m){var t=r.eq(v),n=!1;t.trigger(e.Event("close.simplelightbox")),e(".sl-image img, .sl-overlay, .sl-close, .sl-navigation, .sl-image .sl-caption, .sl-counter").fadeOut("fast",function(){i.disableScroll&&M("show"),e(".sl-wrapper, .sl-overlay").remove(),n||t.trigger(e.Event("closed.simplelightbox")),n=!0}),o=e(),s=!1,m=!1}},M=function(i){if("hide"==i){var a=t.innerWidth;if(!a){var o=n.documentElement.getBoundingClientRect();a=o.right-Math.abs(o.left)}if(n.body.clientWidth<a){var l=n.createElement("div"),s=parseInt(e("body").css("padding-right"),10);l.className="sl-scrollbar-measure",e("body").append(l);var r=l.offsetWidth-l.clientWidth;e(n.body)[0].removeChild(l),e("body").data("padding",s),r>0&&e("body").css({"padding-right":s+r,overflow:"hidden"})}}else e("body").css({"padding-right":e("body").data("padding"),overflow:"auto"})};E(),e(t).on("resize",S),r.on("click."+c,function(t){if(w(this)){if(t.preventDefault(),m)return!1;T(e(this))}}),e(n).on("click",".sl-close",function(e){e.preventDefault(),s&&q()}),e(n).click(function(t){s&&i.docClose&&0==e(t.target).closest(".sl-image").length&&0==e(t.target).closest(".sl-navigation").length&&q()}),i.disableRightClick&&e(n).on("contextmenu",".sl-image img",function(e){return!1}),e(n).on("click",".sl-navigation button",function(t){t.preventDefault(),a=0,D(e(this).hasClass("sl-next")?1:-1)}),i.enableKeyboard&&e(n).on("keyup."+c,function(e){if(e.preventDefault(),a=0,s){var t=e.keyCode;27==t&&q(),(37==t||39==e.keyCode)&&D(39==e.keyCode?1:-1)}});var R=0,P=0,W=!1,X=0;return e(n).on("touchstart mousedown pointerdown MSPointerDown",".sl-image",function(e){return W?!0:(d&&(X=parseInt(x.css("left"))),W=!0,R=e.originalEvent.pageX||e.originalEvent.touches[0].pageX,!1)}).on("touchmove mousemove pointermove MSPointerMove",function(e){return W?(e.preventDefault(),P=e.originalEvent.pageX||e.originalEvent.touches[0].pageX,a=R-P,void(i.animationSlide&&(d?k(0,-a+"px"):x.css("left",X-a+"px")))):!0}).on("touchend mouseup touchcancel pointerup pointercancel MSPointerUp MSPointerCancel",function(e){W&&(W=!1,Math.abs(a)>i.swipeTolerance?D(a>0?1:-1):i.animationSlide&&(d?k(i.animationSpeed/1e3,"0px"):x.animate({left:X+"px"},i.animationSpeed/2)))}),this.open=function(t){t=t||e(this[0]),T(t)},this.next=function(){D(1)},this.prev=function(){D(-1)},this.close=function(){q()},this.destroy=function(){e(n).unbind("click."+c).unbind("keyup."+c),q(),e(".sl-overlay, .sl-wrapper").remove()},this}}(jQuery,window,document);

/*! modernizr 3.3.1 (Custom Build) | MIT *
 * http://modernizr.com/download/?-csstransforms3d-setclasses !*/
!function(e,n,t){function r(e,n){return typeof e===n}function s(){var e,n,t,s,o,i,a;for(var f in C)if(C.hasOwnProperty(f)){if(e=[],n=C[f],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(s=r(n.fn,"function")?n.fn():n.fn,o=0;o<e.length;o++)i=e[o],a=i.split("."),1===a.length?Modernizr[a[0]]=s:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=s),y.push((s?"":"no-")+a.join("-"))}}function o(e){var n=S.className,t=Modernizr._config.classPrefix||"";if(x&&(n=n.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(r,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),x?S.className.baseVal=n:S.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):x?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function a(){var e=n.body;return e||(e=i(x?"svg":"body"),e.fake=!0),e}function f(e,t,r,s){var o,f,l,u,p="modernizr",d=i("div"),c=a();if(parseInt(r,10))for(;r--;)l=i("div"),l.id=s?s[r]:p+(r+1),d.appendChild(l);return o=i("style"),o.type="text/css",o.id="s"+p,(c.fake?c:d).appendChild(o),c.appendChild(d),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(n.createTextNode(e)),d.id=p,c.fake&&(c.style.background="",c.style.overflow="hidden",u=S.style.overflow,S.style.overflow="hidden",S.appendChild(c)),f=t(d,e),c.fake?(c.parentNode.removeChild(c),S.style.overflow=u,S.offsetHeight):d.parentNode.removeChild(d),!!f}function l(e,n){return!!~(""+e).indexOf(n)}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function p(e,n){return function(){return e.apply(n,arguments)}}function d(e,n,t){var s;for(var o in e)if(e[o]in n)return t===!1?e[o]:(s=n[e[o]],r(s,"function")?p(s,t||n):s);return!1}function c(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(n,r){var s=n.length;if("CSS"in e&&"supports"in e.CSS){for(;s--;)if(e.CSS.supports(c(n[s]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var o=[];s--;)o.push("("+c(n[s])+":"+r+")");return o=o.join(" or "),f("@supports ("+o+") { #modernizr { position: absolute; } }",function(e){return"absolute"==getComputedStyle(e,null).position})}return t}function h(e,n,s,o){function a(){p&&(delete k.style,delete k.modElem)}if(o=r(o,"undefined")?!1:o,!r(s,"undefined")){var f=m(e,s);if(!r(f,"undefined"))return f}for(var p,d,c,h,v,g=["modernizr","tspan"];!k.style;)p=!0,k.modElem=i(g.shift()),k.style=k.modElem.style;for(c=e.length,d=0;c>d;d++)if(h=e[d],v=k.style[h],l(h,"-")&&(h=u(h)),k.style[h]!==t){if(o||r(s,"undefined"))return a(),"pfx"==n?h:!0;try{k.style[h]=s}catch(y){}if(k.style[h]!=v)return a(),"pfx"==n?h:!0}return a(),!1}function v(e,n,t,s,o){var i=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+E.join(i+" ")+i).split(" ");return r(n,"string")||r(n,"undefined")?h(a,n,s,o):(a=(e+" "+N.join(i+" ")+i).split(" "),d(a,n,t))}function g(e,n,r){return v(e,t,t,n,r)}var y=[],C=[],w={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){C.push({name:e,fn:n,options:t})},addAsyncTest:function(e){C.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=w,Modernizr=new Modernizr;var S=n.documentElement,x="svg"===S.nodeName.toLowerCase(),_="CSS"in e&&"supports"in e.CSS,b="supportsCSS"in e;Modernizr.addTest("supports",_||b);var P=w.testStyles=f,z="Moz O ms Webkit",E=w._config.usePrefixes?z.split(" "):[];w._cssomPrefixes=E;var N=w._config.usePrefixes?z.toLowerCase().split(" "):[];w._domPrefixes=N;var T={elem:i("modernizr")};Modernizr._q.push(function(){delete T.elem});var k={style:T.elem.style};Modernizr._q.unshift(function(){delete k.style}),w.testAllProps=v,w.testAllProps=g,Modernizr.addTest("csstransforms3d",function(){var e=!!g("perspective","1px",!0),n=Modernizr._config.usePrefixes;if(e&&(!n||"webkitPerspective"in S.style)){var t,r="#modernizr{width:0;height:0}";Modernizr.supports?t="@supports (perspective: 1px)":(t="@media (transform-3d)",n&&(t+=",(-webkit-transform-3d)")),t+="{#modernizr{width:7px;height:18px;margin:0;padding:0;border:0}}",P(r+t,function(n){e=7===n.offsetWidth&&18===n.offsetHeight})}return e}),s(),o(y),delete w.addTest,delete w.addAsyncTest;for(var j=0;j<Modernizr._q.length;j++)Modernizr._q[j]();e.Modernizr=Modernizr}(window,document);


/*! nanoScrollerJS - v0.8.7 - (c) 2015 James Florentino; Licensed MIT */

!function(a){return"function"==typeof define&&define.amd?define(["jquery"],function(b){return a(b,window,document)}):"object"==typeof exports?module.exports=a(require("jquery"),window,document):a(jQuery,window,document)}(function(a,b,c){"use strict";var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H;z={paneClass:"nano-pane",sliderClass:"nano-slider",contentClass:"nano-content",enabledClass:"has-scrollbar",flashedClass:"flashed",activeClass:"active",iOSNativeScrolling:!1,preventPageScrolling:!1,disableResize:!1,alwaysVisible:!1,flashDelay:1500,sliderMinHeight:20,sliderMaxHeight:null,documentContext:null,windowContext:null},u="scrollbar",t="scroll",l="mousedown",m="mouseenter",n="mousemove",p="mousewheel",o="mouseup",s="resize",h="drag",i="enter",w="up",r="panedown",f="DOMMouseScroll",g="down",x="wheel",j="keydown",k="keyup",v="touchmove",d="Microsoft Internet Explorer"===b.navigator.appName&&/msie 7./i.test(b.navigator.appVersion)&&b.ActiveXObject,e=null,D=b.requestAnimationFrame,y=b.cancelAnimationFrame,F=c.createElement("div").style,H=function(){var a,b,c,d,e,f;for(d=["t","webkitT","MozT","msT","OT"],a=e=0,f=d.length;f>e;a=++e)if(c=d[a],b=d[a]+"ransform",b in F)return d[a].substr(0,d[a].length-1);return!1}(),G=function(a){return H===!1?!1:""===H?a:H+a.charAt(0).toUpperCase()+a.substr(1)},E=G("transform"),B=E!==!1,A=function(){var a,b,d;return a=c.createElement("div"),b=a.style,b.position="absolute",b.width="100px",b.height="100px",b.overflow=t,b.top="-9999px",c.body.appendChild(a),d=a.offsetWidth-a.clientWidth,c.body.removeChild(a),d},C=function(){var a,c,d;return c=b.navigator.userAgent,(a=/(?=.+Mac OS X)(?=.+Firefox)/.test(c))?(d=/Firefox\/\d{2}\./.exec(c),d&&(d=d[0].replace(/\D+/g,"")),a&&+d>23):!1},q=function(){function j(d,f){this.el=d,this.options=f,e||(e=A()),this.$el=a(this.el),this.doc=a(this.options.documentContext||c),this.win=a(this.options.windowContext||b),this.body=this.doc.find("body"),this.$content=this.$el.children("."+this.options.contentClass),this.$content.attr("tabindex",this.options.tabIndex||0),this.content=this.$content[0],this.previousPosition=0,this.options.iOSNativeScrolling&&null!=this.el.style.WebkitOverflowScrolling?this.nativeScrolling():this.generate(),this.createEvents(),this.addEvents(),this.reset()}return j.prototype.preventScrolling=function(a,b){if(this.isActive)if(a.type===f)(b===g&&a.originalEvent.detail>0||b===w&&a.originalEvent.detail<0)&&a.preventDefault();else if(a.type===p){if(!a.originalEvent||!a.originalEvent.wheelDelta)return;(b===g&&a.originalEvent.wheelDelta<0||b===w&&a.originalEvent.wheelDelta>0)&&a.preventDefault()}},j.prototype.nativeScrolling=function(){this.$content.css({WebkitOverflowScrolling:"touch"}),this.iOSNativeScrolling=!0,this.isActive=!0},j.prototype.updateScrollValues=function(){var a,b;a=this.content,this.maxScrollTop=a.scrollHeight-a.clientHeight,this.prevScrollTop=this.contentScrollTop||0,this.contentScrollTop=a.scrollTop,b=this.contentScrollTop>this.previousPosition?"down":this.contentScrollTop<this.previousPosition?"up":"same",this.previousPosition=this.contentScrollTop,"same"!==b&&this.$el.trigger("update",{position:this.contentScrollTop,maximum:this.maxScrollTop,direction:b}),this.iOSNativeScrolling||(this.maxSliderTop=this.paneHeight-this.sliderHeight,this.sliderTop=0===this.maxScrollTop?0:this.contentScrollTop*this.maxSliderTop/this.maxScrollTop)},j.prototype.setOnScrollStyles=function(){var a;B?(a={},a[E]="translate(0, "+this.sliderTop+"px)"):a={top:this.sliderTop},D?(y&&this.scrollRAF&&y(this.scrollRAF),this.scrollRAF=D(function(b){return function(){return b.scrollRAF=null,b.slider.css(a)}}(this))):this.slider.css(a)},j.prototype.createEvents=function(){this.events={down:function(a){return function(b){return a.isBeingDragged=!0,a.offsetY=b.pageY-a.slider.offset().top,a.slider.is(b.target)||(a.offsetY=0),a.pane.addClass(a.options.activeClass),a.doc.bind(n,a.events[h]).bind(o,a.events[w]),a.body.bind(m,a.events[i]),!1}}(this),drag:function(a){return function(b){return a.sliderY=b.pageY-a.$el.offset().top-a.paneTop-(a.offsetY||.5*a.sliderHeight),a.scroll(),a.contentScrollTop>=a.maxScrollTop&&a.prevScrollTop!==a.maxScrollTop?a.$el.trigger("scrollend"):0===a.contentScrollTop&&0!==a.prevScrollTop&&a.$el.trigger("scrolltop"),!1}}(this),up:function(a){return function(b){return a.isBeingDragged=!1,a.pane.removeClass(a.options.activeClass),a.doc.unbind(n,a.events[h]).unbind(o,a.events[w]),a.body.unbind(m,a.events[i]),!1}}(this),resize:function(a){return function(b){a.reset()}}(this),panedown:function(a){return function(b){return a.sliderY=(b.offsetY||b.originalEvent.layerY)-.5*a.sliderHeight,a.scroll(),a.events.down(b),!1}}(this),scroll:function(a){return function(b){a.updateScrollValues(),a.isBeingDragged||(a.iOSNativeScrolling||(a.sliderY=a.sliderTop,a.setOnScrollStyles()),null!=b&&(a.contentScrollTop>=a.maxScrollTop?(a.options.preventPageScrolling&&a.preventScrolling(b,g),a.prevScrollTop!==a.maxScrollTop&&a.$el.trigger("scrollend")):0===a.contentScrollTop&&(a.options.preventPageScrolling&&a.preventScrolling(b,w),0!==a.prevScrollTop&&a.$el.trigger("scrolltop"))))}}(this),wheel:function(a){return function(b){var c;if(null!=b)return c=b.delta||b.wheelDelta||b.originalEvent&&b.originalEvent.wheelDelta||-b.detail||b.originalEvent&&-b.originalEvent.detail,c&&(a.sliderY+=-c/3),a.scroll(),!1}}(this),enter:function(a){return function(b){var c;if(a.isBeingDragged)return 1!==(b.buttons||b.which)?(c=a.events)[w].apply(c,arguments):void 0}}(this)}},j.prototype.addEvents=function(){var a;this.removeEvents(),a=this.events,this.options.disableResize||this.win.bind(s,a[s]),this.iOSNativeScrolling||(this.slider.bind(l,a[g]),this.pane.bind(l,a[r]).bind(""+p+" "+f,a[x])),this.$content.bind(""+t+" "+p+" "+f+" "+v,a[t])},j.prototype.removeEvents=function(){var a;a=this.events,this.win.unbind(s,a[s]),this.iOSNativeScrolling||(this.slider.unbind(),this.pane.unbind()),this.$content.unbind(""+t+" "+p+" "+f+" "+v,a[t])},j.prototype.generate=function(){var a,c,d,f,g,h,i;return f=this.options,h=f.paneClass,i=f.sliderClass,a=f.contentClass,(g=this.$el.children("."+h)).length||g.children("."+i).length||this.$el.append('<div class="'+h+'"><div class="'+i+'" /></div>'),this.pane=this.$el.children("."+h),this.slider=this.pane.find("."+i),0===e&&C()?(d=b.getComputedStyle(this.content,null).getPropertyValue("padding-right").replace(/[^0-9.]+/g,""),c={right:-14,paddingRight:+d+14}):e&&(c={right:-e},this.$el.addClass(f.enabledClass)),null!=c&&this.$content.css(c),this},j.prototype.restore=function(){this.stopped=!1,this.iOSNativeScrolling||this.pane.show(),this.addEvents()},j.prototype.reset=function(){var a,b,c,f,g,h,i,j,k,l,m,n;return this.iOSNativeScrolling?void(this.contentHeight=this.content.scrollHeight):(this.$el.find("."+this.options.paneClass).length||this.generate().stop(),this.stopped&&this.restore(),a=this.content,f=a.style,g=f.overflowY,d&&this.$content.css({height:this.$content.height()}),b=a.scrollHeight+e,l=parseInt(this.$el.css("max-height"),10),l>0&&(this.$el.height(""),this.$el.height(a.scrollHeight>l?l:a.scrollHeight)),i=this.pane.outerHeight(!1),k=parseInt(this.pane.css("top"),10),h=parseInt(this.pane.css("bottom"),10),j=i+k+h,n=Math.round(j/b*i),n<this.options.sliderMinHeight?n=this.options.sliderMinHeight:null!=this.options.sliderMaxHeight&&n>this.options.sliderMaxHeight&&(n=this.options.sliderMaxHeight),g===t&&f.overflowX!==t&&(n+=e),this.maxSliderTop=j-n,this.contentHeight=b,this.paneHeight=i,this.paneOuterHeight=j,this.sliderHeight=n,this.paneTop=k,this.slider.height(n),this.events.scroll(),this.pane.show(),this.isActive=!0,a.scrollHeight===a.clientHeight||this.pane.outerHeight(!0)>=a.scrollHeight&&g!==t?(this.pane.hide(),this.isActive=!1):this.el.clientHeight===a.scrollHeight&&g===t?this.slider.hide():this.slider.show(),this.pane.css({opacity:this.options.alwaysVisible?1:"",visibility:this.options.alwaysVisible?"visible":""}),c=this.$content.css("position"),("static"===c||"relative"===c)&&(m=parseInt(this.$content.css("right"),10),m&&this.$content.css({right:"",marginRight:m})),this)},j.prototype.scroll=function(){return this.isActive?(this.sliderY=Math.max(0,this.sliderY),this.sliderY=Math.min(this.maxSliderTop,this.sliderY),this.$content.scrollTop(this.maxScrollTop*this.sliderY/this.maxSliderTop),this.iOSNativeScrolling||(this.updateScrollValues(),this.setOnScrollStyles()),this):void 0},j.prototype.scrollBottom=function(a){return this.isActive?(this.$content.scrollTop(this.contentHeight-this.$content.height()-a).trigger(p),this.stop().restore(),this):void 0},j.prototype.scrollTop=function(a){return this.isActive?(this.$content.scrollTop(+a).trigger(p),this.stop().restore(),this):void 0},j.prototype.scrollTo=function(a){return this.isActive?(this.scrollTop(this.$el.find(a).get(0).offsetTop),this):void 0},j.prototype.stop=function(){return y&&this.scrollRAF&&(y(this.scrollRAF),this.scrollRAF=null),this.stopped=!0,this.removeEvents(),this.iOSNativeScrolling||this.pane.hide(),this},j.prototype.destroy=function(){return this.stopped||this.stop(),!this.iOSNativeScrolling&&this.pane.length&&this.pane.remove(),d&&this.$content.height(""),this.$content.removeAttr("tabindex"),this.$el.hasClass(this.options.enabledClass)&&(this.$el.removeClass(this.options.enabledClass),this.$content.css({right:""})),this},j.prototype.flash=function(){return!this.iOSNativeScrolling&&this.isActive?(this.reset(),this.pane.addClass(this.options.flashedClass),setTimeout(function(a){return function(){a.pane.removeClass(a.options.flashedClass)}}(this),this.options.flashDelay),this):void 0},j}(),a.fn.nanoScroller=function(b){return this.each(function(){var c,d;if((d=this.nanoscroller)||(c=a.extend({},z,b),this.nanoscroller=d=new q(this,c)),b&&"object"==typeof b){if(a.extend(d.options,b),null!=b.scrollBottom)return d.scrollBottom(b.scrollBottom);if(null!=b.scrollTop)return d.scrollTop(b.scrollTop);if(b.scrollTo)return d.scrollTo(b.scrollTo);if("bottom"===b.scroll)return d.scrollBottom(0);if("top"===b.scroll)return d.scrollTop(0);if(b.scroll&&b.scroll instanceof a)return d.scrollTo(b.scroll);if(b.stop)return d.stop();if(b.destroy)return d.destroy();if(b.flash)return d.flash()}return d.reset()})},a.fn.nanoScroller.Constructor=q});
//# sourceMappingURL=jquery.nanoscroller.min.js.map

/*! thiea sticky Sidebar */
!function(i){i.fn.theiaStickySidebar=function(t){function o(t,o){var a=e(t,o);a||(console.log("TST: Body width smaller than options.minWidth. Init is delayed."),i(document).scroll(function(t,o){return function(a){var n=e(t,o);n&&i(this).unbind(a)}}(t,o)),i(window).resize(function(t,o){return function(a){var n=e(t,o);n&&i(this).unbind(a)}}(t,o)))}function e(t,o){return t.initialized===!0?!0:i("body").width()<t.minWidth?!1:(a(t,o),!0)}function a(t,o){t.initialized=!0,i("head").append(i('<style>.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>')),o.each(function(){function o(){a.fixedScrollTop=0,a.sidebar.css({"min-height":"1px"}),a.stickySidebar.css({position:"static",width:""})}function e(t){var o=t.height();return t.children().each(function(){o=Math.max(o,i(this).height())}),o}var a={};a.sidebar=i(this),a.options=t||{},a.container=i(a.options.containerSelector),0==a.container.size()&&(a.container=a.sidebar.parent()),a.sidebar.parents().css("-webkit-transform","none"),a.sidebar.css({position:"relative",overflow:"visible","-webkit-box-sizing":"border-box","-moz-box-sizing":"border-box","box-sizing":"border-box"}),a.stickySidebar=a.sidebar.find(".theiaStickySidebar"),0==a.stickySidebar.length&&(a.sidebar.find("script").remove(),a.stickySidebar=i("<div>").addClass("theiaStickySidebar").append(a.sidebar.children()),a.sidebar.append(a.stickySidebar)),a.marginTop=parseInt(a.sidebar.css("margin-top")),a.marginBottom=parseInt(a.sidebar.css("margin-bottom")),a.paddingTop=parseInt(a.sidebar.css("padding-top")),a.paddingBottom=parseInt(a.sidebar.css("padding-bottom"));var n=a.stickySidebar.offset().top,d=a.stickySidebar.outerHeight();a.stickySidebar.css("padding-top",1),a.stickySidebar.css("padding-bottom",1),n-=a.stickySidebar.offset().top,d=a.stickySidebar.outerHeight()-d-n,0==n?(a.stickySidebar.css("padding-top",0),a.stickySidebarPaddingTop=0):a.stickySidebarPaddingTop=1,0==d?(a.stickySidebar.css("padding-bottom",0),a.stickySidebarPaddingBottom=0):a.stickySidebarPaddingBottom=1,a.previousScrollTop=null,a.fixedScrollTop=0,o(),a.onScroll=function(a){if(a.stickySidebar.is(":visible")){if(i("body").width()<a.options.minWidth)return void o();if(a.options.disableOnResponsiveLayouts&&a.sidebar.outerWidth(!0)+50>a.container.width())return void o();var n=i(document).scrollTop(),d="static";if(n>=a.container.offset().top+(a.paddingTop+a.marginTop-a.options.additionalMarginTop)){var r,s=a.paddingTop+a.marginTop+t.additionalMarginTop,c=a.paddingBottom+a.marginBottom+t.additionalMarginBottom,p=a.container.offset().top,b=a.container.offset().top+e(a.container),l=0+t.additionalMarginTop,g=a.stickySidebar.outerHeight()+s+c<i(window).height();r=g?l+a.stickySidebar.outerHeight():i(window).height()-a.marginBottom-a.paddingBottom-t.additionalMarginBottom;var h=p-n+a.paddingTop+a.marginTop,f=b-n-a.paddingBottom-a.marginBottom,S=a.stickySidebar.offset().top-n,u=a.previousScrollTop-n;"fixed"==a.stickySidebar.css("position")&&"modern"==a.options.sidebarBehavior&&(S+=u),"legacy"==a.options.sidebarBehavior&&(S=r-a.stickySidebar.outerHeight(),S=Math.max(S,r-a.stickySidebar.outerHeight())),S=u>0?Math.min(S,l):Math.max(S,r-a.stickySidebar.outerHeight()),S=Math.max(S,h),S=Math.min(S,f-a.stickySidebar.outerHeight());var m=a.container.height()==a.stickySidebar.outerHeight();d=(m||S!=l)&&(m||S!=r-a.stickySidebar.outerHeight())?n+S-a.sidebar.offset().top-a.paddingTop<=t.additionalMarginTop?"static":"absolute":"fixed"}if("fixed"==d)a.stickySidebar.css({position:"fixed",width:a.sidebar.width(),top:S,left:a.sidebar.offset().left+parseInt(a.sidebar.css("padding-left"))});else if("absolute"==d){var y={};"absolute"!=a.stickySidebar.css("position")&&(y.position="absolute",y.top=n+S-a.sidebar.offset().top-a.stickySidebarPaddingTop-a.stickySidebarPaddingBottom),y.width=a.sidebar.width(),y.left="",a.stickySidebar.css(y)}else"static"==d&&o();"static"!=d&&1==a.options.updateSidebarHeight&&a.sidebar.css({"min-height":a.stickySidebar.outerHeight()+a.stickySidebar.offset().top-a.sidebar.offset().top+a.paddingBottom}),a.previousScrollTop=n}},a.onScroll(a),i(document).scroll(function(i){return function(){i.onScroll(i)}}(a)),i(window).resize(function(i){return function(){i.stickySidebar.css({position:"static"}),i.onScroll(i)}}(a))})}var n={containerSelector:"",additionalMarginTop:0,additionalMarginBottom:0,updateSidebarHeight:!0,minWidth:0,disableOnResponsiveLayouts:!0,sidebarBehavior:"modern"};t=i.extend(n,t),t.additionalMarginTop=parseInt(t.additionalMarginTop)||0,t.additionalMarginBottom=parseInt(t.additionalMarginBottom)||0,o(t,this)}}(jQuery);


var Chain = function() {

	var _listeners = {},
		_resultOfPreviousFunc = null,
		_self = this,
		_api = {},
		_funcs = [],
		_errors = [];

	var on = function(type, listener) {
		if(!_listeners[type]) _listeners[type] = [];
		_listeners[type].push(listener);
		return _api;
	};
	var off = function(type, listener) {
		if(_listeners[type]) {
			var arr = [];
			for(var i=0; f=_listeners[type][i]; i++) {
				if(f !== listener) {
					arr.push(f);
				}
			}
			_listeners[type] = arr;
		}
		return _api;
	};
	var dispatch = function(type, param) {
		if(_listeners[type]) {
			for(var i=0; f=_listeners[type][i]; i++) {
				f(param, _api);
			}
		}
	};
	var run = function() {
		if(arguments.length > 0) {
			_funcs = [];
			for(var i=0; f=arguments[i]; i++) _funcs.push(f);
			var element = _funcs.shift();
			if(typeof element === 'function') {
				element(_resultOfPreviousFunc, _api);
			} else if(typeof element === 'object' && element.length > 0) {
				var f = element.shift();
				f.apply(f, element.concat([_api.next]));
			}
			
		} else {
			dispatch("done", _resultOfPreviousFunc);
		}
		return _api;
	};
	var next = function(res) {
		_resultOfPreviousFunc = res;
		run.apply(_self, _funcs);
	};
	var error = function(err) {
		if(typeof err != 'undefined') {
			_errors.push(err);
			return _api;
		} else {
			return _errors;
		}		
	};
	var process = function() {
		if(arguments.length > 0) {
			if(arguments.length === 2 && typeof arguments[0] === 'string' && typeof arguments[1] === 'function') {
				on.apply(self, arguments);
			} else {
				run.apply(self, arguments);
			}
		}
		return process;
	};

	_api = {
		on: on,
		off: off,
		next: next,
		error: error
	};
	
	return process;

};
var df = df || {};

( function ( $ ){ 'use strict';
	df = {
		videoEmbed : function(){},
		dfNewsTicker : function(){
		},
		stickyContent : function(element1,element2){
			var _this = this;
			_this.isAllow  = false;
			_this.element1 = element1;
			_this.element2 = element2;
			_this.elements = [];
		},
		dfSearchAjax : function(){	
		},
		dfPagination : function(){
			var _this = this;
			_this.currentPage = 1;
			_this.maxNumPage = 0;
			_this.paginationType = '';
		},
		dfFramework : function(){
			var _this = this;
			 _this.stickyContent = new df.stickyContent('.df-content-sticky','.sidebar');
			 _this.dfSearchAjax = new df.dfSearchAjax();
			 _this.dfPagination = typeof $("#df-archive-content").data('pagination') !== 'undefined' || typeof $("#df-content-render").data('pagination') !== 'undefined' ? new df.dfPagination(): false;
			 _this.dfAnimsition = options.animationTransition.is_page_transition == 'yes' ? new df.dfAnimsition() : false;
			 _this.dfNewsTicker = new df.dfNewsTicker();
			 _this.dfComment = $('body').hasClass('single') || $('body').hasClass('page') ? new df.dfComment() : false;
			 _this.dfLazyLoad = options.is_lazy_loading === 'yes' ? new df.dfLazyLoad() : false ;
			 _this.dfLightBox = $('body').hasClass('single') ? new df.dfLightBox() : false;
			 _this.dfSmartList = $('body').hasClass('single') ? new df.dfSmartList() : false;
			 _this.videoEmbed = $('body').hasClass('single') ? new df.videoEmbed() : false;
			 _this.dfSlick = new df.dfSlick();
			 _this.dfHeader = new df.dfHeader();
			 _this.dfVideoPlaylist = new df.dfVideoPlaylist();
			_this.stickyHeader = options.isStickyHeader == 'yes' ? new df.stickyHeader() : false;
			_this.dfSocialShare = new df.dfSocialShare();
			_this.dfReadyState = new df.dfReadyState();
			_this.dfMegaMenu = $('.row_next_prev').length >=1 ? new df.dfMegaMenu() : false;
			_this.dfPaginationShortcode = new df.dfPaginationShortcode();
			_this.dfCategoryTabShortcode = new df.dfCategoryTabShortcode();
		},
		dfAnimsition : function(){	
		},
		dfComment : function() {
		},
		dfLazyLoad : function(){	
		},
		dfLightBox : function(){
		},
		dfSmartList : function(){	
		},
		dfSlick : function(){
		},
		dfVideoPlaylist : function(){
		},
		dfHeader : function(){
			var _this = this;
			_this.offCanvasButton = $('.df-navigator');
			_this.container = document.querySelector('#df-off-canvas-wrap');
			_this.container2 = document.querySelector('#df-sticky-nav');
			_this.container3 = document.querySelector('#df-side-menu');
			_this.main = document.querySelector('#df-off-canvas-wrap');
			_this.mobileClose = $('.mobile-close');
			_this.element = [];
			_this.sidebarLeftTemp = 0;
		},
		wrapRow : function(){
			var _this = this ;
			_this.divs = [];
		},
		stickyHeader : function (){
			var _this = this;
			_this.scrollTimer=null;
			_this.lastScrollTop=0;
			_this.tempLogoNonSingle = '';
			_this.tempLogoSingle = '';
			_this.stickyLogo = options.stickyLogo;
			_this.distance = 400;
			_this.scrollTop = 0;
			_this.siteUrl = '';
		},
		dfSocialShare : function() {
		},
		dfMegaMenu : function () {
			var _this = this;
			_this.history = {};
			_this.megamenuType = '';
			_this.isEmptyHistory = false ;
		},
		dfPaginationShortcode : function(){
			
		},
		dfCategoryTabShortcode : function(){

		},
		dfReadyState : function(){
		}
	};
	df.dfNewsTicker.prototype.init = function(){
		$("#slide-wrap li:first-child").addClass("displayed");
		$("#slide-wrap li:not(.displayed)").hide();
		var current = '',
			next ='',
			parentWrapNews = '',
			autoSlideElement = [],
			slideNewsTicker,
			timer,
			dataIndex;
			
		$("#slide-wrap.auto-slide").each(function(i){
			var _this = this;
			var element={};
			$(this).attr('data-index',i);
			element.slideNewsTicker = function() {
					current = $(_this).find("li.displayed");
					if( current.is(":last-child") ){
						current.hide();
						current.removeClass('displayed');
						next = $(_this).find("li:first-child");
						next.addClass('displayed');
						next.fadeIn(500);
					} else {
						current.hide();
						current.removeClass('displayed');
						next = current.next();
						next.addClass('displayed');
						next.fadeIn(500);
					}
					return false;
				};
			element.timer = setInterval(element.slideNewsTicker, 3000);
			autoSlideElement.push(element);
		})
		$("#slide-wrap.auto-slide li").mouseover(function(){
			dataIndex = $(this).parent().attr('data-index');
			if(typeof dataIndex !== "undefined"){
				clearInterval(autoSlideElement[dataIndex].timer);
			}
		});
		$("#slide-wrap.auto-slide li").mouseleave(function(){
			dataIndex = $(this).parent().attr('data-index');
			if(typeof dataIndex !== "undefined"){
				autoSlideElement[dataIndex].timer = setInterval(autoSlideElement[dataIndex].slideNewsTicker, 3000);
			}
		});

		$(".next-news").click(function(e){
      e.preventDefault();
			parentWrapNews = $(this).parent().parent().parent().parent();
			dataIndex = parentWrapNews.find("#slide-wrap").attr('data-index');
			if(typeof dataIndex !== "undefined"){
				clearInterval(autoSlideElement[dataIndex].timer);
			}
			current = parentWrapNews.find("#slide-wrap li.displayed");
			if( current.is(":last-child") ){
				current.hide();
				current.removeClass('displayed');
				next = parentWrapNews.find("#slide-wrap li:first-child");
				next.addClass('displayed');
				next.fadeIn(500);
			} else {
				current.hide();
				current.removeClass('displayed');
				next = current.next();
				next.addClass('displayed');
				next.fadeIn(500);
			}
			if(typeof dataIndex !== "undefined"){
				autoSlideElement[dataIndex].timer = setInterval(autoSlideElement[dataIndex].slideNewsTicker, 3000);
			}
			return false;
		});
		$(".prev-news").click(function(e){
      e.preventDefault();
			parentWrapNews = $(this).parent().parent().parent().parent();
			dataIndex = parentWrapNews.find("#slide-wrap").attr('data-index');
			if(typeof dataIndex !== "undefined"){
				clearInterval(autoSlideElement[dataIndex].timer);
			}
			current = parentWrapNews.find("#slide-wrap li.displayed");
			if( current.is(":first-child") ){
				current.hide();
				current.removeClass('displayed');
				next = parentWrapNews.find("#slide-wrap li:last-child");
				next.addClass('displayed');
				next.fadeIn(500);
			} else {
				current.hide();
				current.removeClass('displayed');
				next = current.prev();
				next.addClass('displayed');
				next.fadeIn(500);
			}
			if(typeof dataIndex !== "undefined"){
				autoSlideElement[dataIndex].timer = setInterval(autoSlideElement[dataIndex].slideNewsTicker, 3000);
			}
			return false;
		});
	};
	df.videoEmbed.prototype.init = function(){
		var $all_oembed_videos = $(".df-single-post iframe[src*='youtube'], .df-single-post iframe[src*='vimeo']");
		$all_oembed_videos.each(function() {
			$(this).removeAttr('height').removeAttr('width').wrap( "<div class='df-video-container'></div>" );
		});
	};
	df.dfVideoPlaylist.prototype.initVideo = function(){
		var $current = '',     
			$video = '',
			$heightVideo = '',
			$heightCurrent = '',
			$height = '';
		$('.df-video-playlist-wrap').each(function(i){
			$current = $(this).find('.df-current-play');     
			$video = $(this).find(".df-video");
			$heightVideo = $video.outerHeight();
			$heightCurrent = $current.outerHeight();
			$height = $heightVideo - $heightCurrent;

			$(this).find(".df-video-list-wrap.full").css("height", $heightVideo);
			$(this).find(".df-video-list.full").css("height", $height);
		});
		var _this = this,
			videoListWrap = $('.df-video-list'),
			videoListInner = $('.df-video-list-inner'),
			dataSource = '',
			videoCurrentPlay = $('.df-current-play h5'),
			title = '',
			videoUrl = '';
		videoListInner.each(function(){
			var selectedVideo = this;
			$(selectedVideo).click(function(){
				$('.df-video-list-inner').removeClass('active');
				var parentWrap = $(this).parent().parent().parent(),
					parentListInner = $(this).parent().parent();

				videoUrl = $(this).attr('data-url');
				dataSource =  $(this).attr('data-source');
				var frame = parentWrap.find('iframe.embed-responsive-item.'+ dataSource);
				frame.attr('src',videoUrl);
				title = $(this).find('.df-video-desc.'+dataSource+' h5').attr('data-title');
				videoCurrentPlay = parentListInner.find('.df-current-play.'+dataSource+' h5');
				videoCurrentPlay.html(title);
				$(this).addClass('active');
			});
		});
	}
	df.stickyContent.prototype.init = function(){
		var _this = this;
		_this.checkIsAllowed();
		if(_this.isAllow){
			$(_this.element1+', '+_this.element2).theiaStickySidebar({
				additionalMarginTop: 30,
				updateSidebarHeight: true
			});
		}
	};
	df.stickyContent.prototype.checkIsAllowed = function(){
		var _this = this;
		if( options.isStickySidebar == 'yes' && options.isMobile == 'no' && $(_this.element1).length >=1 && $(_this.element2).length >=1 ){
			_this.isAllow = true ;
		} else {
			_this.isAllow = false ;
		}
	};

	df.dfSearchAjax.prototype.init = function(){
		var _this = this;
		var dfSiteURL = options.site_url;
		var urlWP = ajax_call.ajaxurl;
		var searchElement = document.getElementById("df-search-input");
		var searchResult = document.querySelector(".search-result-wraper-main");
		searchElement.addEventListener('keyup',function( event ){
			var that=this;
			var searchParam = $(that).val(); 
			if( event.which == 13 ){
				window.location.href = dfSiteURL+"?s="+searchParam+"&post_type=post";
			}
			$.ajax({
				type	: "POST",
				url 	: urlWP,
				data	: { action: 'df_search', search_param: searchParam },
				beforeSend: function(){

				},
				success: function(data){
							searchResult.innerHTML = '';
							searchResult.innerHTML += data;
				},
				complete: function(){
					dfFramework.reInit()
				}
			});
		});
		
	};
	df.dfPagination.prototype.init = function(){
		var _this = this,paginationType;
		paginationType=$("#df-archive-content").data('pagination');
		switch(paginationType){
			case 'normal-pagination':
				_this.numericPagination();
				_this.paginationType = 'numeric';
				break;
			case 'load-more-infinite-scroll':
				_this.infiniteScroll();
				_this.paginationType = 'infinite';
				break;
		}
		paginationType=$("#df-content-render").data('pagination');
		switch(paginationType){
			case 'normal-pagination':
				_this.customPaginationNumeric();
				_this.paginationType = 'numeric';
				break;
			case 'load-more-infinite-scroll':
				_this.customPaginationInfiniteScroll();
				_this.paginationType = 'infinite';
				break;
		}
	};
	df.dfPagination.prototype.ajaxCustomPagination=function(action,params,type,handleFunction){
		var contentRender = $('#df-content-render');
		$.ajax({
			type: 'POST',
			url	:options.pagination.ajaxurl,
			data: {'action': action,'page' : params.link,'post_id':params.postID },
			success:function(response){
				if(type == 'numeric'){
					$('.pre-loader').remove();
				} else {
					$('.infinite-pre-loader').remove();
				}
				handleFunction(response);
			},
			beforeSend:function(){
				var loaderType='';
				if(type == 'numeric'){
					loaderType='pre-loader show-loader';
				} else {
					loaderType='infinite-pre-loader show-loader';
				}
				contentRender.append('<div class="'+loaderType+'"><div class="item-loader-container"><div class="la la-ball-pulse"><div></div><div></div><div></div></div></div>');
			}
		});
	};
	df.dfPagination.prototype.numericPagination=function(){
		var 
			preLoader = $('.pre-loader'),
			contentRender = $('#df-content-render'),
			pageNumbers = $("ul.page-numbers"),
			currentSpan = $("span.current"),
			paginationLinks = $('#df-pagination a'),
			activePage = '',
			activePageSpan = '';
		pageNumbers.addClass('list-inline df-pagination-list');
		currentSpan.parents("li").addClass('active');
		activePage = $('#df-pagination ul li.active');
		activePageSpan = $('#df-pagination ul li.active span');
		paginationLinks.unbind();
		for(var i=0, length = paginationLinks.length;i<length;i++){
			paginationLinks.eq(i).html('<p>'+paginationLinks.eq(i).html()+'</p>');
		}
		activePage.html('<p>' + activePageSpan.html() + '</p>');

		paginationLinks.on('click', function(e){
			e.preventDefault();
			var that = this,
				link = $(that).attr('href'),
				contenHeight = parseFloat(contentRender.outerHeight(true)),
				contentOffsetTop=parseFloat(contentRender.offset().top),
				windowElement=$(window);
			windowElement.scrollTop((contenHeight + contentOffsetTop)/2 );
			contentRender.append('<div class="pre-loader show-loader"><div class="item-loader-container"><div class="la la-ball-pulse"><div></div><div></div><div></div></div></div>');
			$('<div>').load(link+' #df-content-render',function(){
				var content = $(this).find('#df-content-render');
				contentRender.html(content.html());
				windowElement.scrollTop(contentOffsetTop);
				preLoader.remove();
				dfFramework.reInit();
			});
		});
	};
	df.dfPagination.prototype.customPaginationNumeric=function(){
		var _this = this,
			contentRender = $('#df-content-render'),
			paginationLinks = $('.df-custom-pagination a');
		paginationLinks.unbind();
		paginationLinks.on('click', function(e){
			e.preventDefault();
			var that = this,
				link = $(that).data('page'),
				params = {'link':link,'postID':options.pagination.postID},
				contenHeight = parseFloat(contentRender.outerHeight(true)),
				contentOffsetTop = parseFloat(contentRender.offset().top),
				windowElement = $(window);
			windowElement.scrollTop((contenHeight + contentOffsetTop)/2);
			_this.ajaxCustomPagination('df_archive_custom_loop_ajax',params,'numeric',function(response){
				windowElement.scrollTop(contentOffsetTop);
				var content=$(response).find('#df-content-render');
				contentRender.html($(content).html());
				dfFramework.reInit();
			});
		});
	};
	df.dfPagination.prototype.customPaginationInfiniteScroll=function(){
		var _this = this,
			contentRender = $('#df-content-render'),
			maxNum=parseInt(contentRender.data('max-num-pagination')),
			page=0,
			totalPage=0,
			params={},
			content=[],
			scrollCount=0,
			wrapper=$('#df-archive-content'),
			offsetTop=parseInt(wrapper.offset().top),
			height=parseInt(wrapper.height()),
			boundary=(offsetTop + height),
			windowElement = $(window),
			stickyContent = [];
		_this.maxNumPage=maxNum;
		windowElement.scroll(function(){
			scrollCount = windowElement.scrollTop() + windowElement.innerHeight();
			if (scrollCount > parseInt(boundary) ){
				page = parseInt(_this.currentPage)+1;
				totalPage=parseInt(_this.maxNumPage);
				if(page<=totalPage){
					
					windowElement.unbind('scroll');
					params={'link':page,'postID':options.pagination.postID};
					_this.ajaxCustomPagination('df_archive_custom_loop_ajax',params,'infinite',function(response){
						_this.currentPage=page;
						content = $(response).find('#df-content-render');
						
						content.find('.archive-header-title').remove();
						stickyContent = $('#df-content-render .theiaStickySidebar');
						if( stickyContent.length >=1 ){
							if($(response).find('.masonry-grid').length){
								content = $(response).find('.grid-item');
								contentRender = $('#df-content-render .masonry-grid');
								$('.masonry-grid').append( content );
								// add and lay out newly appended items
								$('.masonry-grid').imagesLoaded(function(){
									$('.masonry-grid').isotope( 'appended', content );
								});
								
							}else {
								stickyContent.append($(content).html());
							}
						} else {
							if($(response).find('.masonry-grid').length){
								content = $(response).find('.grid-item');
								contentRender = $('#df-content-render .masonry-grid');
								$('.masonry-grid').append( content );
								// add and lay out newly appended items
								$('.masonry-grid').imagesLoaded(function(){
									$('.masonry-grid').isotope( 'appended', content );
								});
								
							}else {
								contentRender.append($(content).html());
							}
						}

						dfFramework.reInit();

					});					
				}
			}
			
		});
	};
	df.dfPagination.prototype.infiniteScroll=function(){
		var link='',
			page=0,
			totalPage=0,
			formatLink='',
			nextLink='',
			contentRender = $('#df-content-render'),
			content=[],
			scrollCount=0,
			wrapper=$('#df-archive-content'),
			offsetTop=parseInt(wrapper.offset().top),
			height=parseInt(wrapper.height()),
			boundary=(offsetTop + height),
			windowElement = $(window),
			stickyContent = [];
			
		windowElement.scroll(function(){
			scrollCount = windowElement.scrollTop() + windowElement.innerHeight();
			if  ( scrollCount > boundary ){
				page = parseInt(options.pagination.currentPage)+1;
				totalPage = parseInt(options.pagination.totalPages);
				if( page <= totalPage ){
					windowElement.unbind('scroll');
					link = options.pagination.link;
					formatLink = options.pagination.format;
					nextLink = link+formatLink+page+'/';
					contentRender.append('<div class="infinite-pre-loader show-loader"><div class="item-loader-container"><div class="la la-ball-pulse"><div></div><div></div><div></div></div></div></div>');
					$('<div>').load(nextLink+' #df-content-render',function(){
						$('.infinite-pre-loader').remove();
						options.pagination.currentPage=page;
						content = $(this).find('#df-content-render');

						stickyContent = $('#df-content-render .theiaStickySidebar');
						if( stickyContent.length >=1 ){
							if($(content).find('.masonry-grid').length){
								content = $(content).find('.grid-item');
								contentRender = $('#df-content-render .masonry-grid');
								$('.masonry-grid').append( content );
								// add and lay out newly appended items
								$('.masonry-grid').imagesLoaded(function(){
									$('.masonry-grid').isotope( 'appended', content );
								});
								
							}else {
								stickyContent.append($(content).html());
							}
						} else {
							if($(content).find('.masonry-grid').length){
								content = $(content).find('.grid-item');
								contentRender = $('#df-content-render .masonry-grid');
								$('.masonry-grid').append( content );
								// add and lay out newly appended items
								$('.masonry-grid').imagesLoaded(function(){
									$('.masonry-grid').isotope( 'appended', content );
								});
								
							}else {
								contentRender.append($(content).html());
							}
						}

						// $('.masonry-grid').append( $items )
						// // add and lay out newly appended items
						// .isotope( 'appended', $items );
						dfFramework.reInit();

					});
					
				}
			}
		});
	};
	df.dfAnimsition.prototype.init = function () {
		var _this = this,
				simpleLightBox = $('a.simplelightbox'),
				animsition = $(".animsition"),
				animsitionColor = $('.df-animation-color'),
				animsitionCss = '';
		switch(options.animationTransition.preloader_style){
			case 'image' :
				simpleLightBox.removeClass('animsition-link');
				animsition.animsition({
					inClass: options.animationTransition.animation_transition,
					inDuration: 1500,
					outDuration: 800,

					linkElement: '.animsition-link',
					loading: true,
					loadingParentElement: 'body', //animsition wrapper element
					loadingClass: 'df-animation-css',
					loadingInner: '<div class="df-animation-css-image"><div class="item-loader-container"><img src="'+options.animationTransition.image.loader_image+'"/></div></div>',
					timeout: false,
					timeoutCountdown: 5000,
					onLoadEvent: true,
					overlay : false,
					overlayClass : 'animsition-overlay-slide',
					overlayInner: '',
					overlayParentElement : 'body',
					transition: function(url){ window.location.href = url;}
				});
				$('.df-animation-color').css('color', options.animationTransition.css_animation.loader_color );
				$('.df-animation-css').css('background', options.animationTransition.preloader_bg_color );
				break;
			case 'css-animation' :
				var loadingType = '';
					
				switch(options.animationTransition.css_animation.loader_style){
					case 'style-1' :
						loadingType = "<div class='la-timer la-2x df-animation-color'><div></div></div>";
						break;
					case 'style-2' :
						loadingType = "<div class='la-ball-triangle-path la-2x df-animation-color'><div></div><div></div><div></div></div>";
						break;
					case 'style-3' :
						loadingType = "<div class='la-ball-scale-ripple-multiple la-2x df-animation-color'><div></div><div></div><div></div></div></div>";
						break;
					case 'style-4' :
						loadingType = "<div class='la-ball-fussion la-2x df-animation-color'><div></div><div></div><div></div><div></div></div></div>";
						break;
					case 'style-5' :
						loadingType = "<div class='la-ball-clip-rotate la-2x df-animation-color'><div></div></div>";
						break;
					case 'style-6' :
						loadingType = "<div class='la-ball-fall la-2x df-animation-color'><div></div><div></div><div></div></div>";
						break;
				}
				simpleLightBox.removeClass('animsition-link');
				animsition.animsition({
					inClass: options.animationTransition.animation_transition,
					inDuration: 1500,
					outDuration: 800,
					linkElement: '.animsition-link',
					loading: true,
					loadingParentElement: 'body', //animsition wrapper element
					loadingClass: 'df-animation-css',
					loadingInner: "<div class='df-animation-css-inner'><div class='item-loader-container'>"+loadingType+"</div></div>",
					timeout: false,
					timeoutCountdown: 5000,
					onLoadEvent: true,
					overlay : false,
					overlayClass : 'animsition-overlay-slide',
					overlayInner: '',
					overlayParentElement : 'body',
					transition: function(url){ window.location.href = url; }
				});
				$('.df-animation-color').css('color', options.animationTransition.css_animation.loader_color );
				$('.df-animation-css').css('background', options.animationTransition.preloader_bg_color );
				break;
			default :
				simpleLightBox.removeClass('animsition-link');
				animsition.animsition({
					inClass: options.animationTransition.animation_transition,
					inDuration: 1500,
					outDuration: 800,
					linkElement: '.animsition-link',
					loading: false,
					overlay : false,
					transition: function(url){ window.location.href = url;}
				});
				$('.df-animation-color').css('color', options.animationTransition.css_animation.loader_color );
					$('.df-animation-css').css('background', options.animationTransition.preloader_bg_color );
				break;
		}

	};
	df.dfComment.prototype.init = function(){
		$('.comments-show').unbind('click');
		$('.df-comments-wrap').each( function(i){
			var index=i;
			$('.df-comments-area-title:eq('+index+') .comments-show').click(function(){
				$('.df-comments-wrap:eq('+index+') .df-comments-inner').toggleClass('is-visible');
				$(document).scroll();
				$('.df-content-sticky').css('min-height',1);
			});
			
		});
	};
	df.dfLazyLoad.prototype.init = function () {
		var numbOfImages = $('body img:not(.lazyload-loaded)').length,
			lazyImage = $("body img.lazy:not(.lazyload-loaded)");
			lazyImage.removeClass('img-responsive');
			lazyImage.each(function() {
				var imgLoader = $(this).parent();
				var oh = $(this).attr('height');
				var ow = $(this).attr('width');
				var pw = $(this).width();
				if ( pw < 0 ) {
					pw = $(this).parent().parent().width();
				}
				
				var ratio = ( oh/ow ) * pw;
				$(this).attr( 'style' , 'width : ' + pw + 'px; height : ' + ratio + 'px;');
			});
		lazyImage.lazyload({
			effect : "fadeIn",
			threshold       : 10,
			failure_limit   : numbOfImages,
			event           : "scroll",
			load			: function(a,b,c){
								var _that = this;
								$(this).addClass('lazyload-loaded img-responsive');
								$(this).removeAttr( 'style');
								if($(_that).parent().parent().hasClass('feature-image-wrapper')){
									if(options.isFeatureImageLightbox == 'yes'){
										$('.feature-image-wrapper a').each(function(){
											if(typeof $(this).attr('href') == 'undefined'){
												$(this).attr('href',$(this).find('img').attr('src'));
											}
										});
									}
								}
							  },
		});
	};
	df.dfLightBox.prototype.init = function () {
		if(options.isFeatureImageLightbox == 'yes'){
			if(options.is_lazy_loading === 'yes'){
				$('.feature-image-wrapper img').each(function(){
					
					if(!$(this).parent().hasClass('simplelightbox')){
						if($(this).siblings().hasClass('overlay')){
							$(this).siblings().andSelf().wrapAll('<a class="simplelightbox"></a>');
						} else {
							$(this).wrap('<a class="simplelightbox"></a>');
						}
					}
				})
			} else {
				$('.feature-image-wrapper img').each(function(){
					if(!$(this).parent().hasClass('simplelightbox')){
						if($(this).siblings().hasClass('overlay')){
							$(this).siblings().andSelf().wrapAll('<a class="simplelightbox" href="'+$(this).attr('src')+'"></a>');
						} else {
							$(this).wrap('<a class="simplelightbox" href="'+$(this).attr('src')+'"></a>');
						}
					}
				})
			}
			
		}
		
		var imageFilter = $('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]'),
			mq = window.matchMedia( "(max-width: 769px)" ),
			widthRatioCustom = 0,
			heightRatioCustom = 0,
			lightBoxOptions = [],
			simplelightbox = [],
			lightboxDetail = [],
			simplelightboxElement = [],
			slWrapper = [];
		imageFilter.addClass('simplelightbox');
		simplelightboxElement = $('a.simplelightbox');
		if (mq.matches) {
			widthRatioCustom = 1;
			heightRatioCustom = 0.75;
		} else {
			widthRatioCustom = 0.75;
			heightRatioCustom = 1;
		}
		lightBoxOptions = { widthRatio: widthRatioCustom, heightRatio: heightRatioCustom };
		if(simplelightboxElement.length ) {
			simplelightbox = simplelightboxElement.simpleLightbox(lightBoxOptions);
			simplelightbox.on('shown.simplelightbox', function(){
			slWrapper = $(".sl-overlay");
				var urlWP = ajax_call.ajaxurl;
					$.ajax({
						type	: "POST",
						url 	: urlWP,
						data	: { action: 'df_lightbox_detail' , postURL : window.location.href },
						success: function(data){
							slWrapper.html( data );
							$('.lightbox').fadeIn();
							$(window).resize();
							var title = $('.td-post-tittle h1.entry-title').html();
							$('.df-lightbox-article-title').html( title );
							var popup = {
							  width: 600,
							  height: 450
							},
							popupLinkSticky = $('.df-lightbox-article-share .popup a');
							popupLinkSticky.unbind('click');


							popupLinkSticky.on('click', function () {

							popup.top = screen.height / 2 - popup.height / 2;
							popup.left = screen.width / 2 - popup.width / 2;
								window.open( this.href, 'targetWindow', "\n          toolbar=no,\n          location=no,\n          status=no,\n          menubar=no,\n          scrollbars=yes,\n          resizable=yes,\n          left=" + popup.left + ",\n          top=" + popup.top + ",\n          width=" + popup.width + ",\n          height=" + popup.height + "\n        ");
							return false;
							});
						},

					});
			});
		}
	};

	df.dfSmartList.prototype.init = function () {
		var _this = this;
		_this.initProgressBar();
		_this.initSlider();
	};
	df.dfSmartList.prototype.initProgressBar = function () {
		var smartListPercent = $(".progress-bar.percent"),
			smartListPoint = $(".progress-bar.point"),
			each_bar_width = 0,
			that=[],
			i,
			length;
		for(i = 0,length = smartListPercent.length;i<length;i++){
			that = smartListPercent.eq(i);
			each_bar_width = that.attr('aria-valuenow');
			that.width(each_bar_width + '%');
		}
		for(i = 0,length = smartListPoint.length;i<length;i++){
			that = smartListPoint.eq(i);
			each_bar_width = that.attr('aria-valuenow');
			that.width( ( each_bar_width * 10 ) + '%');
		}
	};
	df.dfSmartList.prototype.initSlider = function () {
		var smartListSlider = $('.smartlist-slider:not(.slick-initialized)');
		smartListSlider
		.addClass('slicked')
		.slick({
			dots: false,
			prevArrow: '.custom-smartlist-prev-arrow',
			nextArrow: '.custom-smartlist-next-arrow',
			infinite: false,
			arrows: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			focusOnSelect: false,
			adaptiveHeight: true,

		});
	};
	df.dfSlick.prototype.init = function () {
		var dfPostImageSlider = $('.slider-df-post-image:not(.slick-initialized)'),
			widgetSlideTrack = $('.widget-slide-track:not(.slick-initialized)'),
			categoryTopPost1 = $('.df-category-top-post.layout-1:not(.slick-initialized)'),
			categoryTopPost2 = $('.df-category-top-post.layout-2:not(.slick-initialized)'),
			categoryTopPost3 = $('.df-category-top-post.layout-3:not(.slick-initialized)'),
			categoryTopPost4 = $('.df-category-top-post.layout-4:not(.slick-initialized)'),
			categoryTopPost6 = $('.df-category-top-post.layout-6:not(.slick-initialized)'),
			topPostNavBtn = $('.top-post-nav-btn:not(.slick-initialized)'),
			shortcodeGrid = $('.grid-slide-wrap:not(.slick-initialized)'),
			scCarousel1Full = $('.df-shortcode-blocks.main-carousel.layout-1.full-column:not(.slick-initialized)'),
			scCarousel1TwoThirds = $('.df-shortcode-blocks.main-carousel.layout-1.two-thirds-column:not(.slick-initialized)'),
			scCarousel1OneThirds = $('.df-shortcode-blocks.main-carousel.layout-1.one-thirds-column:not(.slick-initialized)'),
			scCarousel2Full = $('.df-shortcode-blocks.main-carousel.layout-2.full-column:not(.slick-initialized)'),
			scCarousel2TwoThirds = $('.df-shortcode-blocks.main-carousel.layout-2.two-thirds-column:not(.slick-initialized)'),
			scCarousel2OneThirds = $('.df-shortcode-blocks.main-carousel.layout-2.one-thirds-column:not(.slick-initialized)'),
			scCarousel3Full = $('.df-shortcode-blocks.main-carousel.layout-3.full-column:not(.slick-initialized)'),
			scCarousel3TwoThirds = $('.df-shortcode-blocks.main-carousel.layout-3.two-thirds-column:not(.slick-initialized)'),
			scCarousel3OneThirds = $('.df-shortcode-blocks.main-carousel.layout-3.one-thirds-column:not(.slick-initialized)'),
			scCarousel4Full = $('.df-shortcode-blocks.main-carousel.layout-4.full-column:not(.slick-initialized)'),
			scCarousel4TwoThirds = $('.df-shortcode-blocks.main-carousel.layout-4.two-thirds-column:not(.slick-initialized)'),
			scCarousel4OneThirds = $('.df-shortcode-blocks.main-carousel.layout-4.one-thirds-column:not(.slick-initialized)'),
			scCarousel5 = $('.df-shortcode-blocks.main-carousel.layout-5:not(.slick-initialized)'),
			scCarousel7Full = $('.df-shortcode-blocks.main-carousel.layout-7.full-column:not(.slick-initialized)'),
			scCarousel7TwoThirds = $('.df-shortcode-blocks.main-carousel.layout-7.two-thirds-column:not(.slick-initialized)'),
			scCarousel7OneThirds = $('.df-shortcode-blocks.main-carousel.layout-7.one-thirds-column:not(.slick-initialized)'),
			scCarousel7NavFull = $('.df-shortcode-blocks.nav-carousel.layout-7.full-column:not(.slick-initialized)'),
			scCarousel7NavTwoThirds = $('.df-shortcode-blocks.nav-carousel.layout-7.two-thirds-column:not(.slick-initialized)'),
			scCarousel7NavOneThirds = $('.df-shortcode-blocks.nav-carousel.layout-7.one-thirds-column:not(.slick-initialized)'),
			shortcodeCarousel8 = $('.carousel-layout-8-wrap:not(.slick-initialized)'),
			responsivePostImage = [{
										breakpoint: 1024,
										settings: {
										  infinite: true,
										  slidesToShow: 1,
										  slidesToScroll: 1
										}
									},
									{
										breakpoint: 801,
										settings: {
										  infinite: true,
										  slidesToShow: 1,
										  slidesToScroll: 1
										}
									},
									{
										breakpoint: 480,
										settings: {
										  infinite: true,
										  slidesToShow: 1,
										  slidesToScroll: 1
										}
									}],
			responsiveCategoryTopPost = [{
											breakpoint: 1024,
											settings: {
											  infinite: true,
											  slidesToShow: 3,
											  slidesToScroll: 1
											}
										},
										{
											breakpoint: 801,
											settings: {
											  infinite: true,
											  slidesToShow: 2,
											  slidesToScroll: 1
											}
										},
										{
											breakpoint: 480,
											settings: {
											  infinite: true,
											  slidesToShow: 1,
											  slidesToScroll: 1
											}
										}],
			responsiveCarouselFull = [{
											breakpoint: 1025,
											settings: {
											  infinite: true,
											  slidesToShow: 3,
											  slidesToScroll: 1
											}
										},
										{
											breakpoint: 801,
											settings: {
											  infinite: true,
											  slidesToShow: 2,
											  slidesToScroll: 1
											}
										},
										{
											breakpoint: 480,
											settings: {
											  infinite: true,
											  slidesToShow: 1,
											  slidesToScroll: 1
											}
										}],
			responsiveCarouselTwoThirds = [{
											breakpoint: 1025,
											settings: {
											  infinite: true,
											  slidesToShow: 2,
											  slidesToScroll: 1
											}
										},
										{
											breakpoint: 801,
											settings: {
											  infinite: true,
											  slidesToShow: 1,
											  slidesToScroll: 1
											}
										},
										{
											breakpoint: 480,
											settings: {
											  infinite: true,
											  slidesToShow: 1,
											  slidesToScroll: 1
											}
										}];
		if(dfPostImageSlider.length >= 1){
			dfPostImageSlider.slick({
				lazyLoad: 'ondemand',
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				nextArrow: '.custom-slider-next-arrow',
				prevArrow: '.custom-slider-prev-arrow',
				responsive: responsivePostImage
			});
		}


		if(widgetSlideTrack.length >= 1){
			widgetSlideTrack.slick({
				infinite: true,
				adaptiveHeight: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
			});
		} 

		if(categoryTopPost1.length >= 1 ) {
			var autoplay = categoryTopPost1.data('autoplay');
			var autoplaySpeed = categoryTopPost1.data('autoplay-speed');
			categoryTopPost1.slick({
			  lazyLoad: 'ondemand',
			  infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCategoryTopPost,
				autoplay: autoplay,
				autoplaySpeed: autoplaySpeed,

			});
		}

		if(categoryTopPost2.length >= 1){
			var autoplay = categoryTopPost2.data('autoplay');
			var autoplaySpeed = categoryTopPost2.data('autoplay-speed');
			categoryTopPost2.slick({
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCategoryTopPost,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(categoryTopPost3.length >= 1){
			var autoplay = categoryTopPost3.data('autoplay');
			var autoplaySpeed = categoryTopPost3.data('autoplay-speed');
			categoryTopPost3.slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCategoryTopPost,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(categoryTopPost4.length >= 1){
			var autoplay = categoryTopPost4.data('autoplay');
			var autoplaySpeed = categoryTopPost4.data('autoplay-speed');
			categoryTopPost4.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',	
				centerMode: true,
				variableWidth: true,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(categoryTopPost6.length >= 1){
			var autoplay = categoryTopPost6.data('autoplay');
			var autoplaySpeed = categoryTopPost6.data('autoplay-speed');
			categoryTopPost6.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 
		if(topPostNavBtn.length >= 1){
			topPostNavBtn.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.df-category-top-post',
				arrows: false,
				dots: false,
				centerMode: true,
				focusOnSelect: true,
				infinite: false
			});
		}

		if(shortcodeGrid.length >= 1){
			shortcodeGrid.slick({
				dots: true,
				dotsClass: 'slick-dots df-slick-bullet',
				adaptiveHeight: true,
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',	
			});
		} 

		if(scCarousel1Full.length >= 1 ) {
			var autoplay = scCarousel1Full.data('autoplay');
			var autoplaySpeed = scCarousel1Full.data('autoplay-speed');
			scCarousel1Full.slick({
			  lazyLoad: 'ondemand',
			  infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselFull,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,

			});
		}

		if(scCarousel1TwoThirds.length >= 1 ) {
			var autoplay = scCarousel1TwoThirds.data('autoplay');
			var autoplaySpeed = scCarousel1TwoThirds.data('autoplay-speed');
			scCarousel1TwoThirds.slick({
			  lazyLoad: 'ondemand',
			  infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselTwoThirds,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		}

		if(scCarousel1OneThirds.length >= 1 ) {
			var autoplay = scCarousel1OneThirds.data('autoplay');
			var autoplaySpeed = scCarousel1OneThirds.data('autoplay-speed');
			scCarousel1OneThirds.slick({
			  lazyLoad: 'ondemand',
			  infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		}

		if(scCarousel2Full.length >= 1){
			var autoplay = scCarousel2Full.data('autoplay');
			var autoplaySpeed = scCarousel2Full.data('autoplay-speed');
			scCarousel2Full.slick({
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselFull,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel2TwoThirds.length >= 1){
			var autoplay = scCarousel2TwoThirds.data('autoplay');
			var autoplaySpeed = scCarousel2TwoThirds.data('autoplay-speed');
			scCarousel2TwoThirds.slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselTwoThirds,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel2OneThirds.length >= 1){
			var autoplay = scCarousel2OneThirds.data('autoplay');
			var autoplaySpeed = scCarousel2OneThirds.data('autoplay-speed');
			scCarousel2OneThirds.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel3Full.length >= 1){
			var autoplay = scCarousel3Full.data('autoplay');
			var autoplaySpeed = scCarousel3Full.data('autoplay-speed');
			scCarousel3Full.slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselFull,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,

			});
		} 

		if(scCarousel3TwoThirds.length >= 1){
			var autoplay = scCarousel3TwoThirds.data('autoplay');
			var autoplaySpeed = scCarousel3TwoThirds.data('autoplay-speed');
			scCarousel3TwoThirds.slick({
				infinite: true,
				slidesToShow: 2,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselTwoThirds,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel3OneThirds.length >= 1){
			var autoplay = scCarousel3OneThirds.data('autoplay');
			var autoplaySpeed = scCarousel3OneThirds.data('autoplay-speed');
			scCarousel3OneThirds.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel4Full.length >= 1){
			var autoplay = scCarousel4Full.data('autoplay');
			var autoplaySpeed = scCarousel4Full.data('autoplay-speed');
			scCarousel4Full.slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselFull,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel4TwoThirds.length >= 1){
			var autoplay = scCarousel4TwoThirds.data('autoplay');
			var autoplaySpeed = scCarousel4TwoThirds.data('autoplay-speed');
			scCarousel4TwoThirds.slick({
				infinite: true,
				slidesToShow: 2,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				responsive: responsiveCarouselTwoThirds,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel4OneThirds.length >= 1){
			var autoplay = scCarousel4OneThirds.data('autoplay');
			var autoplaySpeed = scCarousel4OneThirds.data('autoplay-speed');
			scCarousel4OneThirds.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel5.length >= 1){
			var autoplay = scCarousel5.data('autoplay');
			var autoplaySpeed = scCarousel5.data('autoplay-speed');
			scCarousel5.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				centerMode: true,
				variableWidth: true,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel7Full.length >= 1){
			var autoplay = scCarousel7Full.data('autoplay');
			var autoplaySpeed = scCarousel7Full.data('autoplay-speed');
			scCarousel7Full.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.df-shortcode-blocks.nav-carousel.layout-7.full-column',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel7TwoThirds.length >= 1){
			var autoplay = scCarousel7TwoThirds.data('autoplay');
			var autoplaySpeed = scCarousel7TwoThirds.data('autoplay-speed');
			scCarousel7TwoThirds.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.df-shortcode-blocks.nav-carousel.layout-7.two-thirds-column',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 

		if(scCarousel7OneThirds.length >= 1){
			var autoplay = scCarousel7OneThirds.data('autoplay');
			var autoplaySpeed = scCarousel7OneThirds.data('autoplay-speed');
			scCarousel7OneThirds.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.df-shortcode-blocks.nav-carousel.layout-7.one-thirds-column',
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 
		if(scCarousel7NavFull.length >= 1){
			var autoplay = scCarousel7NavFull.data('autoplay');
			var autoplaySpeed = scCarousel7NavFull.data('autoplay-speed');
			scCarousel7NavFull.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.df-shortcode-blocks.main-carousel.layout-7.full-column',
				arrows: false,
				dots: false,
				centerMode: true,
				focusOnSelect: true,
				infinite: false,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		}
		if(scCarousel7NavTwoThirds.length >= 1){
			var autoplay = scCarousel7NavTwoThirds.data('autoplay');
			var autoplaySpeed = scCarousel7NavTwoThirds.data('autoplay-speed');
			scCarousel7NavTwoThirds.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.df-shortcode-blocks.main-carousel.layout-7.two-thirds-column',
				arrows: false,
				dots: false,
				centerMode: true,
				focusOnSelect: true,
				infinite: false,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		}
		if(scCarousel7NavOneThirds.length >= 1){
			var autoplay = scCarousel7NavOneThirds.data('autoplay');
			var autoplaySpeed = scCarousel7NavOneThirds.data('autoplay-speed');
			scCarousel7NavOneThirds.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.df-shortcode-blocks.main-carousel.layout-7.one-thirds-column',
				arrows: false,
				dots: false,
				centerMode: true,
				focusOnSelect: true,
				infinite: false,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		}

		if(shortcodeCarousel8.length >= 1){
			var autoplay = shortcodeCarousel8.data('autoplay');
			var autoplaySpeed = shortcodeCarousel8.data('autoplay-speed');
			shortcodeCarousel8.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<button type="button" data-role="none" class="slick-prev df-prev-button custom-carousel-8" aria-label="Previous" tabindex="0" role="button"><i class="ion-ios-arrow-left"></i></button>',
				nextArrow: '<button type="button" data-role="none" class="slick-next df-next-button custom-carousel-8" aria-label="Next" tabindex="0" role="button"><i class="ion-ios-arrow-right"></i></button>',
				centerMode: true,
				variableWidth: true,
				autoplay: autoplay,
			  	autoplaySpeed: autoplaySpeed,
			});
		} 
	};
	df.dfHeader.prototype.init = function () {
		var _this = this;
		if(options.isEnableSideArea == 'yes'){
			_this.offCanvasInit();
		}
		var search = $('a[href="#search"]'),
			login = $('a[href="#login-modal"]'),
			modalClose = $('#search, #search .modal-close, .df-modal-dialog, .df-modal-dialog-inner .modal-close ');
		search.on('click', function(event) {
			event.preventDefault();
			$('#search').fadeIn();
			$('#df-search-input').focus();
		});

		login.on('click', function(event) {
			event.preventDefault();
			$('.df-modal-dialog').fadeIn();
		});
		
		modalClose.on('click keyup', function(event) {
			if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
				$('.df-modal').fadeOut();
			}
		});
	};

	df.dfHeader.prototype.offCanvasInit = function(){
		var _this = this;
		_this.offCanvasButton.click(function(event) {
			event.preventDefault();
			
			if(_this.container.classList.contains('show-nav')){
				_this.hideSidebar();
			} else {
				_this.showSidebar();
			}
		});
		
		_this.container.addEventListener('click', function(e){
			
			if(_this.container.classList.contains('show-nav') && _this.main.contains(e.target) && !$(e.target).is('.df-navigator') && !$(e.target).is('.df-navigator a') && !$(e.target).is('.df-navigator a i')){
				e.preventDefault();
				_this.hideSidebar();
			}
		}, false);
		
		_this.mobileClose.click(function(event){
			_this.hideSidebar();
		});
	};
	df.dfHeader.prototype.showSidebar = function(){
		var _this = this;
		_this.container.classList.add('show-nav');
		if ( $("#df-sticky-nav").length > 0 ) {
			_this.container2.classList.add('show-nav');
		}
		
		_this.container3.classList.add('active');
		if(dfFramework.stickyContent.isAllow){
			_this.element = dfStickyTheia.checkSidebar();
			_this.sidebarLeftTemp = $(_this.element ).css('left');
			$(_this.element).css('left', (parseInt( _this.sidebarLeftTemp ) + 412 ) );
			$(_this.element).css('transition', '500ms ease all' );
			setTimeout(function () {
				$(_this.element).css('transition', '' );
			}, 500);
		}
		var stickyNav = $('#df-sticky-nav');
		var stickyNavLeft = stickyNav.css('left');
			stickyNav.css('left', (parseInt( stickyNavLeft ) + 412 ) );
			stickyNav.css('transition', '500ms ease all' );
			setTimeout(function () {
				stickyNav.css('transition', '' );
			}, 500);
	};
	df.dfHeader.prototype.hideSidebar = function(){
		var _this = this;
		_this.container.classList.remove('show-nav');
		if ( $("#df-sticky-nav") > 0 ) {
			_this.container2.classList.remove('show-nav');
		}
		
		_this.container3.classList.remove('active');
		dfFramework.stickyContent.checkIsAllowed();
		if(dfFramework.stickyContent.isAllow){
			_this.element = dfStickyTheia.checkSidebar();
			_this.sidebarLeftTemp = $(_this.element ).css('left');
			$(_this.element).css('left', (parseInt( _this.sidebarLeftTemp ) - 412 ) );
			$(_this.element).css('transition', '500ms ease all' );
			setTimeout(function () {
				$(_this.element).css('transition', '' );
			}, 500);
		}
		var stickyNav = $('#df-sticky-nav');
		var stickyNavLeft = stickyNav.css('left');
			stickyNav.css('left', (parseInt( stickyNavLeft ) - 412 ) );
			stickyNav.css('transition', '500ms ease all' );
			setTimeout(function () {
				stickyNav.css('transition', '' );
			}, 500);
	};
	df.wrapRow.prototype.WrapContent = 	function ( element, length){
		var _this = this;
		_this.divs = $(element);
		for(var i = 0; i < _this.divs.length; i+=length) {
			_this.divs.slice(i, i+length).wrapAll("<div class='wrap-row clearfix'></div>");
		}
	};
	df.wrapRow.prototype.init = function (){
		var _this = this;
		var hasSidebar = $('.has-sidebar--yes .wrapped-item'),
			hasSidebarArchivePost = $('.has-sidebar-yes .archive-post-wrap .wrapped-item'),
			hasSidebar9 = $('.has-sidebar-yes .wrapped-item'),
			hasSidebarNot9 = $('.has-sidebar-yes:not(.block-9) .wrapped-item'),
			notHasSidebar = $('.has-sidebar--no .wrapped-item'),
			notHasSidebar9 = $('.has-sidebar-no.block-9 .wrapped-item'),
			notHasSidebarNot9 = $('.has-sidebar-no:not(.block-9) .wrapped-item'),
			notHasSidebarArchivePost = $('.has-sidebar-no.archive-post-wrap .wrapped-item'),
			wrapBlock9 = $('.wrap-block-9-small .wrapped-item'),
			relatedPost = $('.related-post-wrap .wrapped-item');

		if(hasSidebar.length > 2){
			_this.WrapContent('.has-sidebar--yes .wrapped-item', 2);
		}
		if(hasSidebarNot9.length > 2){
			_this.WrapContent('.has-sidebar-yes:not(.block-9) .wrapped-item', 2);
		}
		if(hasSidebar9.length > 4){
			_this.WrapContent('.has-sidebar-yes.block-9 .wrapped-item', 4);
		}
		if(notHasSidebar9.length > 4){
			_this.WrapContent('.has-sidebar-no.block-9 .wrapped-item', 4);
		}
		if(notHasSidebar9.length > 4){
			_this.WrapContent('.has-sidebar-no.block-9 .wrapped-item', 4);
		}
		if(wrapBlock9.length > 2){
			_this.WrapContent('.wrap-block-9-small .wrapped-item', 2);
		}
		if (window.matchMedia("(min-width: 769px)").matches) {
			if(relatedPost.length > 3){ _this.WrapContent('.related-post-wrap .wrapped-item', 3);}
			if(notHasSidebar.length > 3){ _this.WrapContent('.has-sidebar--no .wrapped-item', 3);}
			if(notHasSidebarNot9.length > 3){ _this.WrapContent('.has-sidebar-no:not(.block-9) .wrapped-item', 3);}
			if(notHasSidebarArchivePost.length > 3){ _this.WrapContent('.has-sidebar-no.archive-post-wrap .wrapped-item', 3);}
		} else {
			if(relatedPost.length > 2){ _this.WrapContent('.related-post-wrap .wrapped-item', 2);}
			if(notHasSidebar.length > 2){ _this.WrapContent('.has-sidebar--no .wrapped-item', 2);}
			if(notHasSidebarNot9.length > 3){ _this.WrapContent('.has-sidebar-no:not(.block-9) .wrapped-item', 2);}
			if(notHasSidebarArchivePost.length > 3 ){ _this.WrapContent('.has-sidebar-no.archive-post-wrap .wrapped-item', 2);}
		}
		if(hasSidebarArchivePost.length > 2){ _this.WrapContent('.has-sidebar-yes.archive-post-wrap .wrapped-item', 2);}
		var paginationType=$("#df-archive-content").data('pagination');
		if ( 'normal-pagination' == paginationType ) {
			var wrapCount = $('.wrap-row').length;
			$('.wrap-row:eq(' + (wrapCount - 1) + ')').css('margin-bottom', '30px');
			$('.archive-wraper-3.main-wraper:eq(' + (wrapCount - 1) + ')').css('margin-bottom', '60px');
			$('.archive-wraper.grid-item:eq(' + (wrapCount - 1) + ')').css('margin-bottom', '60px');
			$('.archive-wraper-6.main-wraper:eq(' + (wrapCount - 1) + ')').css('margin-bottom', '60px');	
		}
		
	};
	df.stickyHeader.prototype.init=function(){
		var _this = this;
		$(window).scroll(function(){
			if (_this.scrollTimer) {
				clearTimeout(_this.scrollTimer);
			}
			_this.scrollTimer = setTimeout(_this.handlerScrollSticky($(this).scrollTop()), 1000);
		});
	};
	df.stickyHeader.prototype.handlerScrollSticky=function(st){
		var _this = this;
		_this.scrollTimer = null;
		_this.scrollTop = $(window).scrollTop();
		if (_this.scrollTop >= _this.distance) {
			if (st > _this.lastScrollTop) {
				$('#df-sticky-nav').addClass('sticky-animation');
				$('#df-title-sticky').addClass('show-this').removeClass('hide-this');
				$('#df-menu-sticky.sticky-single').addClass('hide-this').removeClass('show-this');

				if( !$('.sticky-non-single #wraper-outer-sticky #df-primary-menu-megadropdown').hasClass('df-sticky-navbar-center') ){
					$('.sticky-non-single #wraper-outer-sticky #df-primary-menu-megadropdown').addClass('df-sticky-navbar-center');	
				}

				if( $('#container-menu #wraper-mainmenu ul.df-navbar-left li').hasClass('df-navbar-brand') ){
					_this.tempLogoNonSingle = $('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src');
					_this.tempLogoSingle = $('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src');
				}

				if( $('#wraper-outer-sticky').hasClass('sticky-non-single')){
					$('#wraper-mainmenu').prependTo('#wraper-outer-sticky.sticky-non-single');
				}
				if( $('#wraper-outer-sticky').hasClass('sticky-single')){
					$('#wraper-mainmenu').prependTo('#wraper-outer-sticky.sticky-single');
				}

				$('#wraper-mainmenu').prependTo('#wraper-outer-sticky.sticky-non-single');
				if( $('#wraper-outer-sticky.sticky-non-single ul.df-navbar-left li').hasClass('df-navbar-brand') ){
					$('#wraper-outer-sticky.sticky-non-single ul.df-navbar-left li.df-navbar-brand a img').attr('src', _this.stickyLogo );
				}else{
					$('#wraper-outer-sticky.sticky-non-single ul.df-navbar-left').append('<li class="df-navbar-brand no-brand"><a href=""><img src="'+_this.stickyLogo+'"></a></li>');
					if( $('div').hasClass('df-logo-with-ads') ) {
						_this.siteUrl = $('.df-logo-with-ads a').attr('href');
						$('.df-navbar-brand a').attr('href', _this.siteUrl );
					}
					if( $('div').hasClass('df-logo-inner') ){
						_this.siteUrl = $('.df-logo-inner a').attr('href');
						$('.df-navbar-brand a').attr('href', _this.siteUrl );
					}
				}

				if( $('.wrapped-menu').hasClass('boxed') ){
					$('.wrapped-menu').removeClass('boxed').addClass('outer-before-has-boxed');
				}
				if( !$('.df-wraper-box-megamenu').hasClass('boxed') ){
					$('.df-wraper-box-megamenu').addClass('boxed no-padding inner-before-no-boxed');
					if( !$('.row-nav-no-subcat').hasClass('boxed') ){
						$('.row-nav-no-subcat').addClass('boxed rownav-before-no-boxed');
					}
				}

				$('#df-title-sticky').find('.nav .df-navbar-brand a').css('padding-top', 10+"px" );
				$('#df-title-sticky').find('.nav .df-navbar-brand a').css('padding-right', 0+"px" );
				$('#df-title-sticky').find('.nav .df-navbar-brand a').css('padding-left', 0+"px" );
				$('#df-title-sticky .nav .df-navbar-brand a img').css('height', 30+"px" );
				$('#df-menu-sticky .nav .df-navbar-brand a img').css('height', 30+"px" );
				$('.df-header-trans.df-header-overlap').hide();
			} else {
				$('#df-title-sticky').removeClass('show-this').addClass('hide-this');
				$('#df-menu-sticky.sticky-single').removeClass('hide-this').addClass('show-this');
				$('#df-sticky-nav').addClass('sticky-animation');

				if( $('#container-menu #wraper-mainmenu ul.df-navbar-left li').hasClass('df-navbar-brand') ){
					_this.tempLogoSingle = $('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src');
				}

				$('#wraper-mainmenu').prependTo('#wraper-outer-sticky.sticky-single');

				if( $('#wraper-outer-sticky.sticky-single ul.df-navbar-left li').hasClass('df-navbar-brand') ){
					$('#wraper-outer-sticky.sticky-single ul.df-navbar-left li.df-navbar-brand a img').attr('src', _this.stickyLogo);
				}else{
					$('#wraper-outer-sticky.sticky-single ul.df-navbar-left').append('<li class="df-navbar-brand no-brand"><a href=""><img src="'+_this.stickyLogo+'"></a></li>');

					if( $('div').hasClass('df-logo-with-ads') ) {
						_this.siteUrl = $('.df-logo-with-ads a').attr('href');
						$('.df-navbar-brand a').attr('href', _this.siteUrl );
					}
					if( $('div').hasClass('df-logo-inner') ){
						_this.siteUrl = $('.df-logo-inner a').attr('href');
						$('.df-navbar-brand a').attr('href', _this.siteUrl );
					}
				}

				if( $('.wrapped-menu').hasClass('boxed') ){
					$('.wrapped-menu').removeClass('boxed').addClass('outer-before-has-boxed');
				}
				if( !$('.df-wraper-box-megamenu').hasClass('boxed') ){
					$('.df-wraper-box-megamenu').addClass('boxed no-padding inner-before-no-boxed');
					if( !$('.row-nav-no-subcat').hasClass('boxed') ){
						$('.row-nav-no-subcat').addClass('boxed rownav-before-no-boxed');
					}
				}
				$('#df-title-sticky').find('.nav .df-navbar-brand a').css('padding-top', 10+"px" );
				$('#df-title-sticky').find('.nav .df-navbar-brand a').css('padding-right', 0+"px" );
				$('#df-title-sticky').find('.nav .df-navbar-brand a').css('padding-left', 0+"px" );
				$('#df-title-sticky .nav .df-navbar-brand a img').css('height', 30+"px" );
				$('#df-menu-sticky .nav .df-navbar-brand a img').css('height', 30+"px" );
			}
			_this.lastScrollTop = st;
			if( !$('#wraper-outer-sticky #df-primary-menu-megadropdown').hasClass('df-sticky-navbar-center') ){
				$('#wraper-outer-sticky #df-primary-menu-megadropdown').addClass('df-sticky-navbar-center');	
			}
			
		}else{
			$('#df-sticky-nav').removeClass('sticky-animation');
			if( $('#wraper-outer-sticky.sticky-single #df-primary-menu-megadropdown').hasClass('df-sticky-navbar-center') ){
				$('#wraper-outer-sticky.sticky-single #df-primary-menu-megadropdown').removeClass('df-sticky-navbar-center');
			}
			if( $('#wraper-outer-sticky.sticky-non-single #df-primary-menu-megadropdown').hasClass('df-sticky-navbar-center') ){
				$('#wraper-outer-sticky.sticky-non-single #df-primary-menu-megadropdown').removeClass('df-sticky-navbar-center');
			}
			if( $('#container-menu #wraper-mainmenu ul.df-navbar-left li').hasClass('df-navbar-brand') ){
				_this.tempLogoSingle = $('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src');
				_this.tempLogoNonSingle = $('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src');
			}

			$("#wraper-outer-sticky #wraper-mainmenu").appendTo( '#container-menu');
			if( $('#wraper-mainmenu .df-navbar-left li.df-navbar-brand' ).hasClass('no-brand') ){
				$('#wraper-mainmenu ul.df-navbar-left li.df-navbar-brand.no-brand').remove();
			}else{
				if( $('#wraper-mainmenu').hasClass('single') ){
					$('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src', _this.tempLogoSingle);
				}else{
					$('#container-menu #wraper-mainmenu ul.df-navbar-left li.df-navbar-brand a img').attr('src', _this.tempLogoNonSingle);
				}
			}

			$('.outer-before-has-boxed').addClass('boxed');
			$('.inner-before-no-boxed').removeClass('boxed');
			$('.row-nav-no-subcat.rownav-before-no-boxed').removeClass('boxed');
			$('.df-navbar-brand a img').css('height', 'auto');
			$('.df-header-trans.df-header-overlap').show();
		}
	};
	df.dfSocialShare.prototype.init = function () {
		var popup = {
					  width: 600,
					  height: 450
					},
			post_url = window.location.href,
			popupLink = $('.df-social-share .popup a'),
			popupLinkSticky = $('.df-sticky-nav-inner .popup a');
		popupLink.unbind('click');
		popupLinkSticky.unbind('click');
		popupLink.on('click', function () {
			
			popup.top = screen.height / 2 - popup.height / 2;
			popup.left = screen.width / 2 - popup.width / 2;
			window.open( this.href, 'targetWindow', "\n          toolbar=no,\n          location=no,\n          status=no,\n          menubar=no,\n          scrollbars=yes,\n          resizable=yes,\n          left=" + popup.left + ",\n          top=" + popup.top + ",\n          width=" + popup.width + ",\n          height=" + popup.height + "\n        ");
			return false;
		});
		if(options.isStickyShare == 'yes'){
			popupLinkSticky.on('click', function () {
				popup.top = screen.height / 2 - popup.height / 2;
				popup.left = screen.width / 2 - popup.width / 2;
				window.open( this.href, 'targetWindow', "\n          toolbar=no,\n          location=no,\n          status=no,\n          menubar=no,\n          scrollbars=yes,\n          resizable=yes,\n          left=" + popup.left + ",\n          top=" + popup.top + ",\n          width=" + popup.width + ",\n          height=" + popup.height + "\n        ");
				return false;
			});
		}
		
		if ( $( window ).width() < 1025 ){
			$('.df-post-sharing').addClass('mobile-fluid');
		} else {
			$('.df-post-sharing').removeClass('mobile-fluid');
		};
		var urlWP = ajax_call.ajaxurl;
		$.ajax({
			type	: "POST",
			url 	: urlWP,
			data	: { action: 'df_get_all_social_media_counter', url: post_url, method : 'set' },
			success: function(data){
			$('.social-sharing-count:not(.rendered) h3').html( data );
			$('.social-sharing-count:not(.rendered)').addClass('rendered');
			},

		});
	};
	df.dfMegaMenu.prototype.megaMenuAjaxHandler = function(dataParam,index,successHandle){
		var _this = this;
		var urlWP = ajax_call.ajaxurl;
		var linkType = '';
		if(dataParam.type == 'next'){
			linkType = $("#next-"+dataParam.category_id+"-"+dataParam.no_item);
		} else {
			linkType = $("#prev-"+dataParam.category_id+"-"+dataParam.no_item);
		}
		$.ajax({
			type: 'POST',
			url: urlWP,
			data:dataParam,
			beforeSend: function(){
				linkType.css("pointer-events", 'none');
				linkType.css("cursor", 'default');
				linkType.css("color", '#ccc');
				$(".df-block-inner-megamenu-"+dataParam.category_id+"-"+dataParam.no_item).fadeOut().remove();
				
				$(".df-loading-"+dataParam.category_id+"-"+dataParam.no_item).show();
			},
			success: function(data){
				_this.history["megamenu-history-"+dataParam.category_id+"-"+dataParam.no_item] = _this.history["megamenu-history-"+dataParam.category_id+"-"+dataParam.no_item] || {};
				_this.history["megamenu-history-"+dataParam.category_id+"-"+dataParam.no_item][index]=data;
				successHandle(data);
			}
		});
	};
	df.dfMegaMenu.prototype.init = function () {
		var _this = this;
		var 
			//megamenuNavSub = $('.df-megamenu-nav-sub'),
			numItem,  
			categoryId,
			totalPages,
			postsPerPage,
			currentPage,
			hasSubCat,
			megaStyle,
			nextIndex,
			cPage,
			tPages,
			tabContentSelector;
		//for(var i =0,length = megamenuNavSub.length;i<length;i++){
			$('.df-megamenu-nav-sub a').hover(function(e){
				e.preventDefault();
				$('.tab-content .tab-pane').removeClass('active');
				tabContentSelector = $(this).data('target');
				$(this).tab('show');
				$(tabContentSelector).addClass('active');
			});
		//}
		$(".df-loading").hide();

			

		$('.next_megamenu').click(function(e){
			e.preventDefault();
			var that = this;
			numItem = $(this).data('item');  
			categoryId = $(this).data('cat');
			totalPages = $(".df-total-pages-"+categoryId+"-"+numItem).val();
			postsPerPage = $(".df-posts-per-page-"+categoryId+"-"+numItem).val();
			currentPage = $(".df-current-page-"+categoryId+"-"+numItem).val();
			hasSubCat = $(".df-has-sub-cat-"+categoryId+"-"+numItem).val();
			megaStyle = $(".df-mega-style-"+categoryId+"-"+numItem).val();
			if(hasSubCat == 'false'){
				_this.megamenuType = $(".df-block-megamenu-"+categoryId+"-"+numItem+" .row");
			} else {
				_this.megamenuType = $(".df-tab-content-inner-"+categoryId+"-"+numItem+" .row-inner");
			}
			nextIndex = parseInt(currentPage) + 1;
			
			var dataParam = {
								action: 'getNextPage', 
								no_item: numItem,
								category_id: categoryId,
								total_pages: totalPages,
								posts_per_page: postsPerPage,
								current_page: currentPage,
								has_sub_cat: hasSubCat,
								type: 'next',
								mega_style: megaStyle
							};
			if(typeof _this.history["megamenu-history-"+categoryId+"-"+numItem] !== 'undefined'){
				if(typeof _this.history["megamenu-history-"+categoryId+"-"+numItem][nextIndex] !== 'undefined'){
					_this.isEmptyHistory = false;
				} else {
					_this.isEmptyHistory = true;
				}
			} else {
				_this.isEmptyHistory = true;
			}
			if(_this.isEmptyHistory){
				_this.megaMenuAjaxHandler(dataParam,nextIndex,function(data){
					$("#prev-"+categoryId+"-"+numItem).removeAttr( "style" );
					$('.df-loading-'+categoryId+"-"+numItem).hide(function(){
						_this.megamenuType.prepend(data).fadeIn('slow', function(){
							cPage = $(".df-current-page-"+categoryId+"-"+numItem).val();
							tPages = $(".df-total-pages-"+categoryId+"-"+numItem).val();
							
							if(cPage >= tPages){
								$(that).css("pointer-events", 'none');
								$(that).css("cursor", 'default');
								$(that).css("color", '#ccc');
							} else {
								$(that).removeAttr( "style" );
							}
						});  
						dfFramework.dfLazyLoad ? dfFramework.dfLazyLoad.init() : false;
						
					});
				});
			} else {
				$(".df-block-inner-megamenu-"+categoryId+"-"+numItem).fadeOut().remove();
				$('.df-loading-'+categoryId+"-"+numItem).hide();
				$("#prev-"+categoryId+"-"+numItem).removeAttr( "style" );
				_this.megamenuType.prepend(_this.history["megamenu-history-"+categoryId+"-"+numItem][nextIndex]).fadeIn('slow', function(){
					cPage = $(".df-current-page-"+categoryId+"-"+numItem).val();
					tPages = $(".df-total-pages-"+categoryId+"-"+numItem).val();
					if(cPage == tPages){
						$(that).css("pointer-events", 'none');
						$(that).css("cursor", 'default');
						$(that).css("color", '#ccc');
					} else {
						$(that).removeAttr( "style" );
					}
				}); 
			}
		});

		$('.prev_megamenu').click(function(e){
			e.preventDefault();
			var that = this;
			numItem = $(this).data('item');  
			categoryId = $(this).data('cat');
			totalPages = $(".df-total-pages-"+categoryId+"-"+numItem).val();
			postsPerPage = $(".df-posts-per-page-"+categoryId+"-"+numItem).val();
			currentPage = $(".df-current-page-"+categoryId+"-"+numItem).val();
			hasSubCat = $(".df-has-sub-cat-"+categoryId+"-"+numItem).val();
			megaStyle = $(".df-mega-style-"+categoryId+"-"+numItem).val();
			if(hasSubCat == 'false'){
				_this.megamenuType = $(".df-block-megamenu-"+categoryId+"-"+numItem+" .row");
			} else {
				_this.megamenuType = $(".df-tab-content-inner-"+categoryId+"-"+numItem+" .row-inner");
			}
			nextIndex = parseInt(currentPage) - 1;
			var dataParam = {
								action: 'getPrevPage', 
								no_item: numItem,
								category_id: categoryId,
								total_pages: totalPages,
								posts_per_page: postsPerPage,
								current_page: currentPage,
								has_sub_cat: hasSubCat,
								type: 'prev',
								mega_style: megaStyle
							};
			if(typeof _this.history["megamenu-history-"+categoryId+"-"+numItem] !== 'undefined'){
				if(typeof _this.history["megamenu-history-"+categoryId+"-"+numItem][nextIndex] !== 'undefined'){
					_this.isEmptyHistory = false;
				} else {
					_this.isEmptyHistory = true;
					
				}
			} else {
				_this.isEmptyHistory = true;
			}
			
			if(_this.isEmptyHistory){
				_this.megaMenuAjaxHandler(dataParam,nextIndex,function(data){
					$("#next-"+categoryId+"-"+numItem).removeAttr( "style" );
					$('.df-loading-'+categoryId+"-"+numItem).hide(function(){
						_this.megamenuType.prepend(data).fadeIn('slow', function(){
							cPage = $(".df-current-page-"+categoryId+"-"+numItem).val();
							tPages = $(".df-total-pages-"+categoryId+"-"+numItem).val();
							$("#next-"+categoryId+"-"+numItem).removeAttr( "style" );
							if(cPage == '1'){
								$(that).css("pointer-events", 'none');
								$(that).css("cursor", 'default');
								$(that).css("color", '#ccc');
							} else {
								$(that).removeAttr( "style" );
							}
						});  
						dfFramework.dfLazyLoad ? dfFramework.dfLazyLoad.init() : false;
					});
				});
			} else {
				$(".df-block-inner-megamenu-"+categoryId+"-"+numItem).fadeOut().remove();
				$('.df-loading-'+categoryId+"-"+numItem).hide();
				$("#next-"+categoryId+"-"+numItem).removeAttr( "style" );
				_this.megamenuType.prepend(_this.history["megamenu-history-"+categoryId+"-"+numItem][nextIndex]).fadeIn('slow', function(){
					cPage = $(".df-current-page-"+categoryId+"-"+numItem).val();
					tPages = $(".df-total-pages-"+categoryId+"-"+numItem).val();
					$("#next-"+categoryId+"-"+numItem).removeAttr( "style" );
					if(cPage == '1'){
						$(that).css("pointer-events", 'none');
						$(that).css("cursor", 'default');
						$(that).css("color", '#ccc');
					} else {
						$(that).removeAttr( "style" );
					}
				}); 
			}
			
		});
	};
	df.dfReadyState.prototype.init = function(){
		if(options.isBackToTopButton == 'yes') {
		 // browser window scroll (in pixels) after which the "back to top" link is shown
		var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 1000,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

		//hide or show the "back to top" link
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('cd-fade-out');
			}
		});

		//smooth scroll to top
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
				}, scroll_top_duration
			);
		});

		}


		var navToggle = $('.nav-toggle'),
			menuWrap = $('.menu-wrap'),
			mobileMenu = $('.mobile-menu'),
			mobileHeader = $('.mobile-menu-wrap .navbar-header'),
			logoMenu = $('.logo-menu'),
			moreButton = $('span.ion-ios-more'),
			navClose = $('.nav-close'),
			body = $('body'),
			mobileClose = $('.mobile-close'),
			menuTopbar = $("#menu-top-bar"),
			socialShare = $( '.df-social-share' ),
			mobileDropdownToggle = $( '.mobile-dropdown-toggle' ),
			dfSideMenu = $('#df-side-menu'),
			socialSharingButton = $(".df-social-sharing-buttons"),
			navTabLink = $(".df-nav-tab a"),
			showSocialButton = $(".show-social"),
			masonryGrid = $('.masonry-grid'),
			archiveWrapper2 = $('.archive-wraper-2'),
			nano = $('.nano'),
			dfNavTab = $('.df-widget-popular.style-tab .df-nav-tab');

		
		navToggle.on('click', function(){
			menuWrap.fadeIn('slow');
			menuWrap.css('display','block');
			moreButton.fadeOut('slow');
			body.addClass('noscroll');	
			menuWrap.addClass("show");
			mobileMenu.addClass("show");				
		});

		navClose.on('click keyup', function(event) {
		  if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
			menuWrap.fadeOut('slow');
			moreButton.fadeIn('slow');
			menuWrap.removeClass("show");
			mobileMenu.removeClass("show");
			body.removeClass('noscroll');
		  }
		});
		
		navTabLink.click(function(event){
			event.preventDefault();
			$(this).tab('show');
		});
		navTabLink.click(function(event){
			event.preventDefault();
			$(this).tab('show');
		});
		showSocialButton.click(function(){
			$(this).next('.more-social, .more-social-sticky').fadeToggle("slow");
		});

		socialSharingButton.click(function(){
			$(this).toggleClass('focus');
		});
		
		$(window).resize(function(){
			if ( $( window ).width() < 800 ) {
				logoMenu.css("height", mobileHeader.outerHeight());
				if ( $('body').hasClass('page') ){
				   $('.sidebar').addClass('mobile-page');
				};
				$('#slide-wrap').addClass('auto');
			} else {
				$('.sidebar').removeClass('mobile-page');
				$('#slide-wrap').removeClass('auto');
			}
		})
		if ( $( window ).width() < 800 ) {
			logoMenu.css("height", mobileHeader.outerHeight());
			menuTopbar.appendTo(".menu-wrap .container").insertAfter('.df-mobile-menu-wraper');
			socialShare.addClass('mobile');
			menuWrap.find( '#menu-top-bar' ).removeClass( 'df-top-bar-left pull-left no-padding' );
			menuWrap.find( '#menu-top-bar' ).addClass( 'mobile-top-bar' );
			$( '.menu-item-has-children .sub-menu' ).hide();
			
		
			$('<span class="mobile-dropdown-toggle"><i class="ion-chevron-down"></i></span>').insertBefore('.df-mobile-menu-inner li.menu-item-has-children ul.sub-menu');
			mobileDropdownToggle = $( '.mobile-dropdown-toggle' );
			mobileDropdownToggle.click(function(){
				var child=$( this ).parent('li').find('ul.sub-menu').first();
				var _this=$( this );
				if(!_this.hasClass('on')){
					child.slideDown();
					_this.addClass('on');
				} else {
					child.slideUp();
					_this.removeClass('on');
				}
				
				
			});
		}
		
		$(window).resize();
		archiveWrapper2.imagesLoaded();
		for(var i=0,length=dfNavTab.length;i<length;i++){
			var $self = $(dfNavTab).eq(i);
			var tabCount = $self.children('li').length;
			var tabWidth = ((100/tabCount));
			$self.children('li').width(tabWidth+'%');
		}
		
		dfSideMenu.height( $(window).height() );
		dfSideMenu.css( 'position', 'fixed' );
		nano.nanoScroller();
		masonryGrid.imagesLoaded(function(){
			masonryGrid.isotope({
			  itemSelector: '.grid-item',
			});
		});
	};

	df.dfCategoryTabShortcode.prototype.init = function(){
		var blockTabCats = $('.block-tab-cats');
		var shortcodeDisablePagination = 'shortcode-disable-pagination';
		var blockTabPane = '.block-tab-pane';


		blockTabCats.find('a').click(function(e) {
			e.preventDefault();
			$(this).addClass( shortcodeDisablePagination );
				
			var targetTab, sortOrder, column, blockID, blockType, source, sourceParams, totalPages, currentPage, postsPerPage, postIDPage, pageTemplate, paginationStatus, action, thisWrapperBlock;
			
			targetTab = $(this).data('target');
			sortOrder = $(this).data('sortorder');
			column = $(this).data('column');
			blockID = $(this).data('id');
			blockType = $(this).data('block');
			source = $(this).data('source');
			sourceParams = $(this).data('sourceparams');
			totalPages = $(this).data('totalpages');
			currentPage = $(this).attr('data-current');
			postsPerPage = $(this).data('postsperpage');
			postIDPage = $(this).data('postidpage');
			pageTemplate = $(this).data('pagetemplate');
			paginationStatus = $(this).data('paginationstatus');
			action = "currentPosts";
			thisWrapperBlock = $(".df-wrapper-block-"+blockID);

			thisWrapperBlock.css("min-height", 250+"px");

			var blockListOffset = $('#block-list-'+blockID ).offset();
			$("html, body").animate({ scrollTop: blockListOffset.top-100 }, 800);
			
			$.ajax({
				type: 'POST',
				url : ajax_call.ajaxurl,
				data:{
					action: action,
					block_id: blockID,
					column: column,
					sort_order: sortOrder,
					block_type: blockType,
					source: source,
					source_params: sourceParams,
					total_pages: totalPages,
					current_page: currentPage,
					posts_per_page: postsPerPage,
					post_id_page: postIDPage,
					page_template: pageTemplate,
					pagination_status: paginationStatus
				},
				beforeSend: function(){
					thisWrapperBlock.html('<div class="df-loading"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>');
				},
				success: function( response ){
					thisWrapperBlock.hide().html(response).fadeIn();
					// dfFramework.reInit();
					dfFramework.dfPaginationShortcode.init();
				}
			});

			$( targetTab ).siblings( blockTabPane ).removeClass('active');
			$( targetTab ).siblings( blockTabPane ).hide();
			if( $(this).hasClass('first-lvl') ){
				console.log("first-lvl");
				$( this ).parent().parent().siblings('li').find('p a').removeClass( shortcodeDisablePagination );
				$( this ).parent().parent().siblings('li').find('ul li a').removeClass( shortcodeDisablePagination );
			}
			if( $(this).hasClass('second-lvl') ){
				console.log("second-lvl");
				$(this).parent().siblings('li').find('a').removeClass( shortcodeDisablePagination );
				$(this).parent().parent().parent().siblings('li').find('p a').removeClass( shortcodeDisablePagination );
			}
			$( targetTab ).fadeIn();
			$( targetTab ).addClass('active');

		});
	};

	df.dfPaginationShortcode.prototype.init = function(){
		var shortcodeBlock = $('.df-shortcode-blocks');

		var actionType, blockID, blockType, source, sourceParams, 
		totalPages, currentPage, customPostPerPage, limit, sortOrder, 
		sidebar, thisBlock, offset, curr, _that, postsPerPage, column,
		postIDPage, pageTemplate, pagination, tempHeight, thisBlock;

		var paginateLink = $('.shortcode-pagination li a');
		paginateLink.unbind('click');
		paginateLink.click(function(e){
			_that = this;
			e.preventDefault();
			actionType = $(_that).data('action');
			blockID = $(_that).data('id');
			blockType = $(_that).data('block');
			source = $(_that).data('source');
			sourceParams = $(_that).data('sourceparams');
			totalPages = $(_that).data('totalpages');
			currentPage = $(_that).attr('data-current');
			postsPerPage = $(_that).data('postsperpage');
			sortOrder = $(_that).data('sortorder');
			sidebar = $(_that).data('sidebar');
			column = $(_that).data('column');
			postIDPage = $(this).data('postidpage');
			pagination = $(this).data('pagination');
			pageTemplate = $(this).data('pagetemplate');

			thisBlock = $( ".df-block-"+blockID );

			tempHeight = thisBlock.height();
			thisBlock.css('min-height', 300+"px");

			var offset = thisBlock.offset();
			curr;
			$("html, body").animate({ scrollTop: offset.top-100 }, 800);
			var thisPagination = $(".df-page-block-"+blockID+" .shortcode-pagination");
			
			$.ajax({
				type: 'POST',
				url	:  ajax_call.ajaxurl,
				data: { 
					action: actionType,
					block_id : blockID,
					block_type : blockType,
					source : source,
					source_param : sourceParams,
					total_pages : totalPages,
					current_page : currentPage,
					posts_per_page : postsPerPage,
					sort_order : sortOrder,
					sidebar: sidebar,
					column: column,
					post_id_page: postIDPage,
					pagination: pagination,
					page_template: pageTemplate
				},
				beforeSend: function(){
					thisBlock.html('<div class="df-loading"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div>');
					thisPagination.find(".previous-posts a").addClass('shortcode-disable-pagination');
					thisPagination.find(".next-posts a").addClass('shortcode-disable-pagination');
				},
				success:function( response ){
					if( actionType == 'nextPostsBlock' ){
						curr = parseInt(currentPage)+1;
						if( curr > 1 ){
							thisPagination.find(".previous-posts a").removeClass('shortcode-disable-pagination');
							thisPagination.find(".next-posts a").removeClass('shortcode-disable-pagination');
						}
						if( curr == totalPages ){
							thisPagination.find(".next-posts a").addClass('shortcode-disable-pagination');
						}
						$('#block-list-'+blockID ).attr("data-current", curr );
					}else if( actionType == 'prevPostsBlock' ){
						curr = parseInt(currentPage)-1;
						if( curr == 1 ){
							thisPagination.find(".previous-posts a").addClass('shortcode-disable-pagination');
							thisPagination.find(".next-posts a").removeClass('shortcode-disable-pagination');
						}
						if( curr > 1 && curr < totalPages ){
							thisPagination.find(".previous-posts a").removeClass('shortcode-disable-pagination');
							thisPagination.find(".next-posts a").removeClass('shortcode-disable-pagination');
						}
						$('#block-list-'+blockID ).attr("data-current", curr );
					}
					thisBlock.hide().html(response).fadeIn();
					thisPagination.find(".previous-posts a").attr("data-current", curr );
					thisPagination.find(".next-posts a").attr("data-current", curr );
					// dfFramework.reInit();
				}
			});
		});

		var Slider14BlockLength = $('.df-shortcode-blocks-slider:not(.has-initialized-block)').length;
		var blockSlide = $('.df-shortcode-blocks-slider:not(.has-initialized-block)');
		for(var i=0,length=blockSlide.length;i<length;i++){
			var $self = blockSlide.eq(i);
			var slidesToShowsMD = 3;
			var slidesToShowsSM = 2;
			var slidesToShowsXS = 1;
			if( $self.hasClass( 'column-used-2' ) ){
				slidesToShowsMD = 2;
				slidesToShowsSM = 2;
				slidesToShowsXS = 1;
			}else if( $self.hasClass( 'column-used-1' ) ){
				slidesToShowsMD = 1;
				slidesToShowsSM = 1;
				slidesToShowsXS = 1;
			}
			var randomClass = Math.random().toString(36).substring(4);
			$self.parents().prev().find( '.custom-prev-arrow:not(.has-initialized-block)').addClass( 'has-initialized-block custom-prev-arrow-' + randomClass);
			$self.parents().prev().find( '.custom-next-arrow:not(.has-initialized-block)').addClass( 'has-initialized-block custom-next-arrow-' + randomClass );
			var nextbutton = '.custom-next-arrow-' + randomClass ;
			var prevbutton = '.custom-prev-arrow-' + randomClass ;
			$self.slick({
				infinite: true,
				slidesToShow: slidesToShowsMD,
				slidesToScroll: 1,
				arrows: true,
				prevArrow: prevbutton,
				nextArrow: nextbutton,
				responsive: [{
					breakpoint: 1025,
					settings: {
						infinite: true,
						slidesToShow: slidesToShowsMD,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 801,
					settings: {
						infinite: true,
						slidesToShow: slidesToShowsSM,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						infinite: true,
						slidesToShow: slidesToShowsXS,
						slidesToScroll: 1
					}
				}]
			});
			$self.addClass( 'has-initialized-block' );
		}

	};
	df.dfFramework.prototype.init = function () {
		var _this = this;
		 Chain()(
			_this.dfAnimsition ? _this.dfAnimsition.init() : function(){$('.animsition').removeClass('animsition')},
			_this.dfReadyState.init(),
			_this.dfHeader.init(),
			_this.dfMegaMenu ? _this.dfMegaMenu.init() : false,
			_this.stickyHeader ? _this.stickyHeader.init() : false,
			_this.dfNewsTicker.init(),
			_this.dfVideoPlaylist.initVideo(),
			_this.dfLazyLoad ? _this.dfLazyLoad.init() : false,
			_this.dfLightBox ? _this.dfLightBox.init() : false,
			_this.dfSocialShare.init(),
			_this.dfPaginationShortcode.init(),
			_this.dfCategoryTabShortcode.init(),
			_this.dfSlick.init(),
			_this.dfPagination ? _this.dfPagination.init() : false,
			_this.stickyContent.init(),
			_this.dfComment ? _this.dfComment.init() : false,
			_this.dfSearchAjax.init(),
			_this.dfSmartList ? _this.dfSmartList.init() : false,
			_this.videoEmbed ? _this.videoEmbed.init() : false
		);
	};
	df.dfFramework.prototype.reInit = function(){
		var _this = this;
		var paginationType = _this.dfPagination ? _this.dfPagination.paginationType : false;
		Chain()(
			_this.dfLazyLoad ? _this.dfLazyLoad.init() : false,
			_this.stickyHeader && paginationType === 'infinite' ? _this.stickyHeader.init() : false,
			_this.dfPagination ? _this.dfPagination.init() : false,
			_this.dfSlick.init(),
			_this.dfSmartList ? _this.dfSmartList.init() : false,
			_this.dfLightBox ? _this.dfLightBox.init() : false,
			_this.stickyContent.init(),
			_this.dfComment ? _this.dfComment.init() : false,
			_this.dfSocialShare.init(),
			_this.videoEmbed ? _this.videoEmbed.init() : false
		);
	};
	var dfStickyTheia = new function () {
		this.elements = [];
		this.checkSidebar = function () {
			var sticked = jQuery('.theiaStickySidebar').filter(function () { 
				return jQuery(this).css('position') == 'fixed';
			});
			return sticked;
		};
	};
	
}) ( jQuery );
var dfFramework = new df.dfFramework();
dfFramework.init();	