!function(l){"use strict";var a;function n(){l(".custom-row .video-wrap").each(function(a){var e=1280/720,t=l(this).closest(".custom-row").outerWidth()+20,i=l(this).closest(".custom-row").outerHeight(),o=t,s=t;l(this).removeClass("center");var n=Math.ceil(t/e);n<i&&(s=(n=i)*e),t<s&&(o=s,l(this).addClass("center")),l(this).find("video").width(Math.ceil(o)).height(n)})}function r(e){l("body").hasClass("compose-mode")&&"resize"==e&&l(".vc_row-parent > .row-shape-wrap").remove(),l(".vc_column_container .row-shape-wrap").each(function(){var a=l(this);"load"!=e||l("body").hasClass("compose-mode")?l("body").hasClass("compose-mode")&&"resize"==e&&a.addClass("clone").clone().insertBefore(l(this).parents(".vc_row-parent *:last")):l(this).insertAfter(l(this).parents(".vc_row-parent *:last"))})}function t(){var e,t=l(window).height(),a=l(window).width(),i=0;a<=1024&&l(".dock-panel-wrap").length&&(t-=l(".dock-panel-wrap").height()),l("#header-wrap").hasClass("header_float")&&l(".header-float-wrap").height(),l("#header-wrap").length&&!l("#container").hasClass("header_float")&&(i+=l("#header-wrap").height()),1025<=a&&l("#wpadminbar").length&&(t-=l("#wpadminbar").height()),l(".row.full_row_height").not(".acoda-page-animate .custom-row.full_row_height").each(function(a){l(this).is(":first-child")&&0<i&&(e=l(this).outerHeight()<=t-i?t-i:"auto",l(this).css({"min-height":e,height:e}))})}function c(a,e){a=l(a);var t=l("#header").height();if(jQuery("#container").hasClass("sticky-header")&&(t=70),l("#container").unbind("touchmove"),l("body").removeClass("dock-active"),l(".dock-panel,.dock-tab").removeClass("inactive"),l(".dock-tab-wrapper").removeClass("show"),(a=a.length?a:l("[name="+e+"]")).length)return l("html,body").stop().animate({scrollTop:a.offset().top-t},1e3),!1;l(".row.link_anchor").each(function(){if(l(this).attr("data-anchor-link")===e)return l("html,body").stop().animate({scrollTop:l(this).offset().top-t},1e3),!1})}function d(){if(!l("#container").hasClass("acoda-page-animate")){var a=l(window).height(),e=l(".site-inwrap").outerHeight(),t=l("#footer-wrap"),i=t.outerHeight(),o="";e<a&&t.length?(o=a-e,t.css("min-height",o+i)):a<e&&t.length&&(o=a-e,t.css("min-height",o+i))}}function h(){if(l("#container").hasClass("sidebar-pinned")){var a,e,t=l("#main-wrap").outerWidth(),i=l(".acoda-sidebar"),o=l("#content"),s=l(".content-wrap").width(),n=0;l(".acoda-sidebar").each(function(){n+=l(this).outerWidth(!0)}),a=l("#content").width()+2*n,s<t&&a<t&&i.length?(e=(t-s)/2,l("#content.columns").addClass("pinned"),i.each(function(){l(this).hasClass("right")?i.css({right:"-"+e+"px",position:"absolute"}):i.css({left:"-"+e+"px",position:"absolute"})}),(o.hasClass("layout_four")||o.hasClass("layout_two"))&&(l("#header-wrap").hasClass("layout_left")||o.css({"margin-left":n/2+"px"}))):(l("#content.columns").removeClass("pinned"),i.css({left:"auto",right:"auto",position:"relative"}),o.css({margin:0}))}}function p(){var a=l(window).width(),e=l(".header_left #header-wrap.sticky_menu_logo");768<a?l(window).scroll(function(){e.stop().css({marginTop:l(window).scrollTop()+"px"})}):e.stop().css({marginTop:"0px"})}function u(){l(".sticky-wrapper").length&&l(".sticky-wrapper").css("min-height",l("#header").height()),l(".layout_top #acoda-tabs ul li.mega-menu").not(".layout_top #acoda-tabs .dock-tab-wrapper ul li.mega-menu").each(function(){var a=l(this),e=l("#header > .inner-wrap").width(),t=l("#acoda-tabs").width(),i=l(window).width(),o=(i-e)/2,s=a.width(),n=0,r=l(this).position();768<i?(l(a).find("ul.sub-menu:first").css({"max-width":e,width:e}),n=l(a).find("ul.sub-menu:first > li").size(),l(a).find("ul.sub-menu:first li").not("ul.sub-menu:first li li").css({"max-width":(e-2)/n,width:"100%"}),l(a).find("ul.sub-menu:first").offset({left:o}),l(a).find("ul.sub-menu:first .pointer").length||l(a).find("ul.sub-menu:first").prepend('<span class="pointer"></span>'),l(a).find("span.pointer").css("left",e-t+r.left+s/2-9)):(l(a).find("ul.sub-menu:first li").not("ul.sub-menu:first li li").css({"max-width":"none",width:"100%"}),l(a).find("ul.sub-menu:first").css({left:0}))})}function w(){var a,e=0,t=0,i=l(window).width();l("#container").hasClass("header_float")&&!l("#header-wrap").hasClass("height_100")&&(l(".header-float-wrap").children().each(function(){l(this).hasClass("sticky-wrapper")?e+=l(this).find("#header-wrap").height():e+=l(this).height()}),i<1025&&!l(".dock-panel-wrap").hasClass("dock_layout_1")&&(t=l(".dock-panel-wrap").not("#header-wrap .dock-panel-wrap").height()),a=e+t,l(".main-wrap.header_float .entry > .wpb_row:first-child > .vc_column_container > .vc_column-inner > .wpb_wrapper").is(":empty")||(a+=30),l(".main-wrap.header_float .entry > .wpb_row:first-child").css({"padding-top":a}),l(".intro-wrap").length&&(a=l(".intro-wrap").height(),l(".main-wrap.header_float .entry > .wpb_row:first-child").css({"padding-bottom":a}))),i<1025&&l(".dock-panel-wrap").hasClass("dock_float")?(t=l(".dock-panel-wrap").height(),l("#header-wrap").css({"margin-top":t})):1025<=i&&l(".dock-panel-wrap").hasClass("dock_float")&&l("#header-wrap").css({"margin-top":"auto"})}function f(a,e){var n=l(window).width(),r=l(window).innerHeight();l(window).scrollTop();if(e){var t,i,o=l(e+" .pointer"),s=a.parent(".dock-tab").position(),c=(a.offset(),a.width());t=l(e).parents(".dock-panel-wrap").hasClass("main_nav")?l(".dock-panel-wrap.main_nav "+e).width()-(c+8):l(".dock-panel-wrap.top_bar "+e).width()-(c+8),1025<=n?(l(e).find(".infodock-innerwrap").css({"max-height":r-(s.top+55)}),l(".dock-panel-wrap").hasClass("dockpanel_type_2")||l(".dock-panel-wrap").hasClass("dockpanel_type_3")?(l(e).css({width:n,height:r}),i=l(window).scrollTop(),l(".dock-panel-wrap").hasClass("dockpanel_type_2")?l(e).offset({top:i,left:-l(e).width()}):l(e).offset({top:i,left:0})):l("#header-wrap").hasClass("layout_left")?l(e).css({left:s.left,top:"100%"}):(l(e).css({left:s.left,top:"100%","margin-left":-t}),l(o).css({left:"auto"}))):(l(e).find(".infodock-innerwrap").css({"max-height":r}),l(e).css({width:n,height:r}),i=l("#wpadminbar").length?l("#wpadminbar").height():0,i=l(window).scrollTop(),l(e).offset({top:i,left:-l(e).width()}))}else l(".dock-tab-trigger").each(function(){var a,e,t=".dock-tab-wrapper."+l(this).attr("data-show-dock"),i=(l(t+" .pointer"),l(this)),o=l(this).parent(".dock-tab").position(),s=(l(this).offset(),i.outerWidth());e=l(t).parents(".dock-panel-wrap").hasClass("main_nav")?l(".dock-panel-wrap.main_nav "+t).width()-(s+8):l(".dock-panel-wrap.top_bar "+t).width()-(s+8),1025<=n?(l(t).find(".infodock-innerwrap").css({"max-height":r-(o.top+55)}),l(".dock-panel-wrap").hasClass("dockpanel_type_2")||l(".dock-panel-wrap").hasClass("dockpanel_type_3")?(l(t).css({width:n,height:r}),a=l("#wpadminbar").length?l("#wpadminbar").height():0,a=l(window).scrollTop(),console.log(a),l(".dock-panel-wrap").hasClass("dockpanel_type_2")?l(t).offset({top:a,left:-l(t).width()}):l(t).offset({top:a,left:0})):l("#header-wrap").hasClass("layout_left")?l(t).css({left:o.left,top:"100%"}):l(t).css({left:o.left,top:"100%","margin-left":-e})):(l(t).find(".infodock-innerwrap").css({"max-height":r}),l(t).css({width:n,height:r}),a=l("#wpadminbar").length?l("#wpadminbar").height():0,a=l(window).scrollTop(),l(t).offset({top:a,left:-l(t).width()}))})}l.fn.hoverFlow=function(e,t,a,i,o){if(-1==l.inArray(e,["mouseover","mouseenter","mouseout","mouseleave"]))return this;var s="object"==typeof a?a:{complete:o||!o&&i||l.isFunction(a)&&a,duration:a,easing:o&&i||i&&!l.isFunction(i)&&i};s.queue=!1;var n=s.complete;return s.complete=function(){l(this).dequeue(),l.isFunction(n)&&n.call(this)},this.each(function(){var a=l(this);"mouseover"==e||"mouseenter"==e?a.data("jQuery.hoverFlow",!0):a.removeData("jQuery.hoverFlow"),a.queue(function(){("mouseover"==e||"mouseenter"==e?void 0!==a.data("jQuery.hoverFlow"):void 0===a.data("jQuery.hoverFlow"))?a.animate(t,s):a.queue([])})})},l.support.transition=void 0!==(a=(document.body||document.documentElement).style).transition||void 0!==a.WebkitTransition||void 0!==a.MozTransition||void 0!==a.MsTransition||void 0!==a.OTransition,!1===l.support.transition&&l("body").addClass("non_CSS3"),jQuery(document).ready(function(s){n(),u(),p(),f(),w(),l(".dynamic-frame .columns.acoda-animate-in").not(".dynamic-frame .columns.acoda-animate-in.loaded").each(function(t){if(jQuery.isFunction(jQuery.fn.waypoint))jQuery(this).waypoint(function(a){var e=l(this);setTimeout(function(){e.addClass("loaded")},20*t)},{offset:"100%"});else{var a=l(this);setTimeout(function(){a.addClass("loaded")},50*t)}}),function(){if(l("#header-wrap").hasClass("middle")){var a=l("#acoda_dropmenu > li").length/2,e=parseInt(a-1);l("#acoda_dropmenu").children(":eq("+e+")").after('<li class="menu-middle-logo"></li>'),l("#header-logo").appendTo(".menu-middle-logo")}}(),d(),h(),r("load"),s("#panelsearchsubmit").click(function(){s("#panelsearchform").hasClass("disabled")?s("#panelsearchform").switchClass("disabled","active"):s("#panelsearchform").hasClass("active")&&(""!=s("#panelsearchform #drops").val()?s("#panelsearchform").submit():s("#panelsearchform").switchClass("active","disabled"))}),s("#acoda-tabs ul li").not("#acoda-tabs #megaMenu ul li,.layout_top #acoda-tabs ul li.mega-menu ul li").hover(function(a){if(s(this).addClass("not-edge").removeClass("edge"),s("ul",this).length){var e=s("ul:first",this),t=e.offset().left,i=e.width();s("#container").height();t+i<=s("#container").width()?s(this).removeClass("edge").addClass("not-edge"):s(this).addClass("edge").removeClass("not-edge")}s("body").hasClass("non_CSS3")?(s(this).addClass("visible"),s(this).find("ul:first").delay(200).hoverFlow(a.type,{height:"show",opacity:1},400,function(){s(this).css("overflow","visible")})):(clearTimeout(o),s(this).addClass("visible").find("ul:first").addClass("active"))},function(a){s("body").hasClass("non_CSS3")?s(this).find("ul:first").delay(400).hoverFlow(a.type,{height:"hide",opacity:0},250,function(){s(this).hide()}):(e(s(this)),s(this).find("ul:first").removeClass("active"))});var o=setTimeout(e,500);function e(a){a?setTimeout(function(){a.removeClass("visible")},200):s("#acoda-tabs").find("li.hasdropmenu").removeClass("visible")}if(s("#acoda-tabs").mouseleave(function(){o=setTimeout(e,500)}),s(".target_blank a").each(function(){s(this).click(function(a){a.preventDefault(),a.stopPropagation(),window.open(this.href,"_blank")})}),s(".hozbreak-top a,.autototop i").click(function(){return s("html, body").animate({scrollTop:"0px"},600),!1}),s(function(){var a,e=!1,t=s("div.autototop a").not(".acoda-page-animate div.autototop a"),i=s(window),o=s(document.body).children(0).position().top;i.scroll(function(){window.clearTimeout(a),a=window.setTimeout(function(){i.scrollTop()<=o?(e=!1,t.removeClass("show")):!1===e&&(e=!0,t.stop(!0,!0).addClass("show").click(function(){t.removeClass("show")}))},100)})}),window.location.hash){var a=window.location.hash,t=window.location.hash.substring(1);window.location.hash="",window.setTimeout(function(){c(a,t)},500)}s('a[href*="#"]:not([href="#"])').not(".ui-tabs-nav a, a.vc_carousel-control,.vc_tta-panel-heading a,.vc_tta-tab a,.vc_pagination-item a").on("click",function(){location.pathname.replace(/^\//,"")===this.pathname.replace(/^\//,"")&&location.hostname===this.hostname&&c(s(this.hash),this.hash.slice(1))}),s("a.socialinit").on("click",function(a){return s(this).hasClass("socialhide")?s("div.socialicons").not("div.socialicons.display,div.socialicons.init").fadeOut("slow"):s("div.socialicons").not("div.socialicons.display,div.socialicons.init").fadeIn("slow"),s(this).toggleClass("socialhide"),!1}),s("#container").bind("click",function(a){s(a.target).parents().is(".dock-tab")||s(a.target).parents().is("#acoda-tabs")||s(a.target).parents().is(".dock-tab-wrapper")||s(a.target).parents().is(".trigger-dock-menu")||(s(".dock-panel > li,ul.dock-panel").removeClass("inactive"),s("body").removeClass("dock-active"),s(".dock-tab-wrapper,#acoda-tabs").removeClass("show",200,function(){s(".dock-tab-wrapper").hasClass("show")||s("#acoda-tabs").hasClass("show")||s("#header-wrap").removeClass("active",200)}))}),s(".dock-tab-wrapper .pointer").bind("click",function(){s("#container").unbind("touchmove"),s(".dock-panel > li,ul.dock-panel").removeClass("inactive"),s("body").removeClass("dock-active"),s(".dock-tab-wrapper.show").addClass("hide"),setTimeout(function(){s(".dock-tab-wrapper,#acoda-tabs").removeClass("show hide")},300)}),s(document).keyup(function(a){27===a.keyCode&&(s("#container").unbind("touchmove"),s(".dock-panel > li,ul.dock-panel").removeClass("inactive"),s("body").removeClass("dock-active"),s(".dock-tab-wrapper.show").addClass("hide"),setTimeout(function(){s(".dock-tab-wrapper,#acoda-tabs").removeClass("show hide")},300))}),s(".dock-tab-trigger").bind("click",function(a){a.preventDefault(),s(".dock-tab-wrapper").hasClass("show")?s("body").removeClass("dock-active"):s("body").addClass("dock-active"),s(".dock-panel-wrap").hasClass("dockpanel_type_1")?s(this).parent("li").hasClass("inactive")?s(".dock-panel > li").removeClass("inactive"):(s(".dock-panel > li").removeClass("inactive"),s(this).parent("li").addClass("inactive")):s(".dock-panel-wrap").find("ul.dock-panel").toggleClass("inactive");var e=s(this).attr("data-show-dock");f(s(this),".dock-tab-wrapper."+e),s(".dock-tab-wrapper,#acoda-tabs").not(".dock-tab-wrapper."+e).removeClass("show",200),s(".dock-tab-wrapper."+e).toggleClass("show",200).promise().done(function(){s(this).hasClass("show")&&(s(this).find(".infodock-innerwrap").prop("scrollHeight")<=s(this).height()&&s("#container").bind("touchmove",function(a){a.preventDefault()}),s(".dock-tab-wrapper."+e).find("input").delay(400).queue(function(a){s(this).focus(),a()})),"dock-menu"===e&&s(this).hasClass("show")?(s(".dock-tab-wrapper."+e).find(".dock_menu li").removeClass("show"),s(".dock-tab-wrapper."+e).find(".dock_menu li").each(function(a){var e=s(this);setTimeout(function(){e.addClass("show")},100*a)})):s(".dock-tab-wrapper").find(".dock_menu li").delay(300).queue(function(a){s(this).removeClass("show"),a()})})}),s("#searchsubmit,#panelsearchsubmit").hover(function(){s.browser.msie&&s.browser.version<9||s(this).animate({opacity:.6},100)}),s("#searchsubmit,#panelsearchsubmit").mouseout(function(){s.browser.msie&&s.browser.version<9||s(this).animate({opacity:1},170)}),s(window).scroll(function(){s(".intro-text,.parallax-fade .vc_column_container").css("opacity",1-s(window).scrollTop()/350)}),s(document).on({mouseenter:function(){s(this);!1===s.support.transition?(s(this).find("a.action-icons i").animate({opacity:1},500),s(this).find("span.action-hover").animate({opacity:.8},500)):(s(this).find(".lightbox-wrap").length?s(this).delay(200).queue(function(a){s(this).find("a.action-icons i").addClass("display"),a()}):s(this).find("a.action-icons i").addClass("display"),s(this).find("span.action-hover").addClass("display"))},mouseleave:function(){!1===s.support.transition?(s(this).find("a.action-icons i").animate({opacity:0},500),s(this).find("span.action-hover").animate({opacity:0},500)):(s(this).find("a.action-icons i").removeClass("display"),s(this).find("span.action-hover").removeClass("display"))}},".gridimg-wrap,ul.products > .product"),s(".gallery-wrap.nav-arrowhover,.gallery-wrap.nav-bulletarrowhover").hover(function(){1024<s(window).width()&&s(this).find(".slidernav-left,.slidernav-right").fadeTo(500,1)},function(){1024<s(window).width()&&s(this).find(".slidernav-left,.slidernav-right").fadeTo(200,0)}),s(".button.add_to_cart_button").click(function(a){s(".dock-tab .items-count").addClass("animate").delay(3e3).queue(function(){s(this).removeClass("animate")})}),clearTimeout(i);var i=setTimeout(function(){s("body").addClass("loaded")},1200)}),l(window).load(function(){t(),l("body").addClass("loaded");var a=l(".dock-panel-wrap").height()+70;l(".menu-sidebar-panel").css("padding-bottom",a),l(".custom-row .video-wrap").addClass("active"),f(),w(),function(){if(l("#container").hasClass("anchorlink-nav")){var a="";l(".row.link_anchor").each(function(){void 0!==l(this)&&(a+='<li><a href="#'+l(this).attr("data-anchor-link")+'">&nbsp;</a></li>')}),""!==a&&(l("#container .main-wrap .content-wrap").append('<nav class="anchorlink-nav"><ul>'+a+"</ul></nav>"),l("nav.anchorlink-nav a").on("click",function(){c(l(this.hash),this.hash.slice(1))}))}}(),u();var e=0;jQuery("#container").hasClass("sticky-header")&&l("#header-wrap .header-wrap-inner").children().each(function(){e+=l(this).height()}),jQuery(".row.link_anchor").each(function(){var e=jQuery(this).attr("data-anchor-link"),a=".row.link_anchor.anchor-"+e;l(".acoda-page-animate").length||(jQuery(a).waypoint(function(a){"up"===a&&jQuery("#acoda-tabs a,nav.anchorlink-nav a").each(function(){jQuery(this).removeClass("waypoint_active"),jQuery(this).attr("href")==="#"+e&&jQuery(this).addClass("waypoint_active")})},{offset:"-75%"}),jQuery(a).waypoint(function(a){"down"===a&&jQuery("#acoda-tabs a,nav.anchorlink-nav a").each(function(){jQuery(this).removeClass("waypoint_active"),jQuery(this).attr("href")==="#"+e&&jQuery(this).addClass("waypoint_active")})},{offset:"25%"}))})}),l(window).resize(function(){clearTimeout(a);var a=setTimeout(function(){d()},500);if(l("body").hasClass("compose-mode")&&l(".vc_row-parent").each(function(a,e){1<l(this).find(".overlay-wrap").length&&l(this).find(".overlay-wrap:last").remove(),1<l(this).find(".vc_general.vc_parallax").length&&l(this).find(".vc_general.vc_parallax:last").remove(),1<l(this).find(".row-slider-wrap").length&&l(this).find(".row-slider-wrap:last").remove()}),l("body").hasClass("compose-mode"))setTimeout(r("resize"),500);n(),u(),p(),f(),w(),t(),h()})}(jQuery);