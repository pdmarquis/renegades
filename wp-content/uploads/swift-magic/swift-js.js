
/* Masonry trigger */
jQuery(document).ready(function($) {
	if( Modernizr.mq('(min-width: 580px)') && Modernizr.mq('(max-width: 840px)')){
        $(function(){
            $('#sidebar').masonry({
			    // options
			    itemSelector : '.widget-mas',
			    gutterWidth:0
			  });
		});
        $(function(){
            $('#footer').masonry({
			    // options
			    itemSelector : '.footer-widgets',
			    gutterWidth:0
			  });
		});
	}
    $(window).resize(function() {
        $('#sidebar,#footer').masonry().masonry('reloadItems');
		if( Modernizr.mq('(min-width: 840px)')){
            $('.widget-mas,.footer-widgets').removeAttr('style');
			
		}
	});
});
(function(e,t){var n=function(){function r(t,r){if(t=="dot"){r='<ol class="dots">';e.each(n.li,function(e){r+='<li class="'+(e==n.i?t+" active":t)+'">'+ ++e+"</li>"});r+="</ol>"}else{r='<div class="';r=r+t+'s">'+r+t+' prev">'+n.o.prev+"</div>"+r+t+' next">'+n.o.next+"</div></div>"}n.el.addClass("has-"+t+"s").append(r).find("."+t).click(function(){var t=e(this);t.hasClass("dot")?n.stop().to(t.index()):t.hasClass("prev")?n.prev():n.next()})}var n=this;n.o={speed:500,delay:3e3,init:0,pause:!t,loop:!t,keys:t,dots:t,arrows:t,prev:"&larr;",next:"&rarr;",fluid:t,starting:t,complete:t,items:">ul",item:">li",easing:"swing",autoplay:true};n.init=function(t,i){n.o=e.extend(n.o,i);n.el=t;n.ul=t.find(n.o.items);n.max=[t.outerWidth()|0,t.outerHeight()|0];n.li=n.ul.find(n.o.item).each(function(t){var r=e(this),i=r.outerWidth(),s=r.outerHeight();if(i>n.max[0])n.max[0]=i;if(s>n.max[1])n.max[1]=s});var i=n.o,s=n.ul,o=n.li,u=o.length;n.i=0;t.css({width:n.max[0],height:o.first().outerHeight(),overflow:"hidden"});s.css({position:"relative",left:0,width:u*100+"%"});o.css({"float":"left",width:n.max[0]+"px"});i.autoplay&&setTimeout(function(){if(i.delay|0){n.play();if(i.pause){t.on("mouseover mouseout",function(e){n.stop();e.type=="mouseout"&&n.play()})}}},i.init|0);if(i.keys){e(document).keydown(function(e){var t=e.which;if(t==37)n.prev();else if(t==39)n.next();else if(t==27)n.stop()})}i.dots&&r("dot");i.arrows&&r("arrow");if(i.fluid){e(window).resize(function(){n.r&&clearTimeout(n.r);n.r=setTimeout(function(){var e={height:o.eq(n.i).outerHeight()},r=t.outerWidth();s.css(e);e["width"]=Math.min(Math.round(r/t.parent().width()*100),100)+"%";t.css(e)},50)}).resize()}if(e.event.special["swipe"]||e.Event("swipe")){t.on("swipeleft swiperight swipeLeft swipeRight",function(e){e.type.toLowerCase()=="swipeleft"?n.next():n.prev()})}return n};n.to=function(r,i){if(n.t){n.stop();n.play()}var s=n.o,o=n.el,u=n.ul,a=n.li,l=n.i,c=a.eq(r);e.isFunction(s.starting)&&!i&&s.starting(o,a.eq(l));if((!c.length||r<0)&&s.loop==t)return;if(!c.length)r=0;if(r<0)r=a.length-1;c=a.eq(r);var h=i?5:s.speed|0,p=s.easing,d={height:c.outerHeight()};if(!u.queue("fx").length){o.find(".dot").eq(r).addClass("active").siblings().removeClass("active");o.animate(d,h,p)&&u.animate(e.extend({left:"-"+r+"00%"},d),h,p,function(t){n.i=r;e.isFunction(s.complete)&&!i&&s.complete(o,c)})}};n.play=function(){n.t=setInterval(function(){n.to(n.i+1)},n.o.delay|0)};n.stop=function(){n.t=clearInterval(n.t);return n};n.next=function(){return n.stop().to(n.i+1)};n.prev=function(){return n.stop().to(n.i-1)};};e.fn.unslider=function(t){var r=this.length;return this.each(function(i){var s=e(this),u="unslider"+(r>1?"-"+ ++i:""),a=(new n).init(s,t);s.data(u,a).data("key",u)})};n.version="1.0.0"})(jQuery,false)
jQuery(function($) {
    $('.unslider').unslider({
        speed: 500,
        delay:12000,
        keys: true,
        dots: true,
        fluid: true,
        pause:true,
        arrows:false,
        prev: '&larr;',
        next: '&rarr;',
    });
});
(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery)

jQuery(window).scroll(function() {
        if(! jQuery("#post_end").length){
        	return false;
        }
        
        if (typeof(rp_loaded) == 'undefined'  && jQuery('#post_end').visible()) {
            rp_loaded = true;

            jQuery("#related-posts .rp-thumb").each(function(){
            	jQuery(this).attr('src',jQuery(this).data('src'));
            });
            
        }

});


function swift_load_stylish_widget_images(){
    if(!jQuery('.image-list').length){
        return false;
    }
    if (typeof(stylish_widget_loaded) == 'undefined'  && jQuery('.image-list').visible(true)) {
        stylish_widget_loaded = true;
        jQuery(".image-list .stylish-thumb").each(function(){
            jQuery(this).attr('src',jQuery(this).data('src'));
        });

    }
}
jQuery(window).scroll(function() {
    swift_load_stylish_widget_images()
});
jQuery(window).load(function() {
    swift_load_stylish_widget_images()
});

(function(d){var e=false,c=false;var b={isUrl:function(g){var f=new RegExp("^(https?:\\/\\/)?((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|((\\d{1,3}\\.){3}\\d{1,3}))(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*(\\?[;&a-z\\d%_.~+=-]*)?(\\#[-a-z\\d_]*)?$","i");if(!f.test(g)){return false}else{return true}},loadContent:function(f,g){f.html(g)},addPrefix:function(f){var g=f.attr("id"),h=f.attr("class");if(typeof g==="string"&&""!==g){f.attr("id",g.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-id-$1"))}if(typeof h==="string"&&""!==h&&"sidr-inner"!==h){f.attr("class",h.replace(/([A-Za-z0-9_.\-]+)/g,"sidr-class-$1"))}f.removeAttr("style")},execute:function(l,g,u){if(typeof g==="function"){u=g;g="sidr"}else{if(!g){g="sidr"}}var f=d("#"+g),n=d(f.data("body")),m=d("html"),p=f.outerWidth(true),i=f.data("speed"),q=f.data("side"),s=f.data("displace"),j=f.data("onOpen"),r=f.data("onClose"),o,k,h,t=(g==="sidr"?"sidr-open":"sidr-open "+g+"-open");if("open"===l||("toggle"===l&&!f.is(":visible"))){if(f.is(":visible")||e){return}if(c!==false){a.close(c,function(){a.open(g)});return}e=true;if(q==="left"){o={left:p+"px"};k={left:"0px"}}else{o={right:p+"px"};k={right:"0px"}}if(n.is("body")){h=m.scrollTop();m.css("overflow-x","hidden").scrollTop(h)}if(s){n.addClass("sidr-animating").css({width:n.width(),position:"absolute"}).animate(o,i,function(){d(this).addClass(t)})}else{setTimeout(function(){d(this).addClass(t)},i)}f.css("display","block").animate(k,i,function(){e=false;c=g;if(typeof u==="function"){u(g)}n.removeClass("sidr-animating")});j()}else{if(!f.is(":visible")||e){return}e=true;if(q==="left"){o={left:0};k={left:"-"+p+"px"}}else{o={right:0};k={right:"-"+p+"px"}}if(n.is("body")){h=m.scrollTop();m.removeAttr("style").scrollTop(h)}n.addClass("sidr-animating").animate(o,i).removeClass(t);f.animate(k,i,function(){f.removeAttr("style").hide();n.removeAttr("style");d("html").removeAttr("style");e=false;c=false;if(typeof u==="function"){u(g)}n.removeClass("sidr-animating")});r()}}};var a={open:function(f,g){b.execute("open",f,g)},close:function(f,g){b.execute("close",f,g)},toggle:function(f,g){b.execute("toggle",f,g)},toogle:function(f,g){b.execute("toggle",f,g)}};d.sidr=function(f){if(a[f]){return a[f].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof f==="function"||typeof f==="string"||!f){return a.toggle.apply(this,arguments)}else{d.error("Method "+f+" does not exist on jQuery.sidr")}}};d.fn.sidr=function(h){var l=d.extend({name:"sidr",speed:200,side:"left",source:null,renaming:true,body:"body",displace:true,onOpen:function(){},onClose:function(){}},h);var g=l.name,k=d("#"+g);if(k.length===0){k=d("<div />").attr("id",g).css("display","none").appendTo(d("body"))}k.addClass("sidr").addClass(l.side).data({speed:l.speed,side:l.side,body:l.body,displace:l.displace,onOpen:l.onOpen,onClose:l.onClose});if(typeof l.source==="function"){var f=l.source(g);b.loadContent(k,f)}else{if(typeof l.source==="string"&&b.isUrl(l.source)){d.get(l.source,function(n){b.loadContent(k,n)})}else{if(typeof l.source==="string"){var m="",j=l.source.split(",");d.each(j,function(n,o){m+='<div class="sidr-inner">'+d(o).html()+"</div>"});if(l.renaming){var i=d("<div />").html(m);i.find("*").each(function(o,p){var n=d(p);b.addPrefix(n)});m=i.html()}b.loadContent(k,m)}else{if(l.source!==null){d.error("Invalid Sidr Source")}}}}return this.each(function(){var o=d(this),n=o.data("sidr");if(!n){o.data("sidr",g);if("ontouchstart" in document.documentElement){o.bind("touchstart",function(p){var q=p.originalEvent.touches[0];this.touched=p.timeStamp});o.bind("touchend",function(p){var q=Math.abs(p.timeStamp-this.touched);if(q<200){p.preventDefault();a.toggle(g)}})}else{o.click(function(p){p.preventDefault();a.toggle(g)})}}})}})(jQuery);
/* Modernizr 2.7.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-mq-teststyles
 */
;window.Modernizr=function(a,b,c){function v(a){i.cssText=a}function w(a,b){return v(prefixes.join(a+";")+(b||""))}function x(a,b){return typeof a===b}function y(a,b){return!!~(""+a).indexOf(b)}function z(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:x(f,"function")?f.bind(d||b):f}return!1}var d="2.7.2",e={},f=b.documentElement,g="modernizr",h=b.createElement(g),i=h.style,j,k={}.toString,l={},m={},n={},o=[],p=o.slice,q,r=function(a,c,d,e){var h,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:g+(d+1),l.appendChild(j);return h=["&#173;",'<style id="s',g,'">',a,"</style>"].join(""),l.id=g,(m?l:n).innerHTML+=h,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=f.style.overflow,f.style.overflow="hidden",f.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),f.style.overflow=k),!!i},s=function(b){var c=a.matchMedia||a.msMatchMedia;if(c)return c(b).matches;var d;return r("@media "+b+" { #"+g+" { position: absolute; } }",function(b){d=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle)["position"]=="absolute"}),d},t={}.hasOwnProperty,u;!x(t,"undefined")&&!x(t.call,"undefined")?u=function(a,b){return t.call(a,b)}:u=function(a,b){return b in a&&x(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=p.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(p.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(p.call(arguments)))};return e});for(var A in l)u(l,A)&&(q=A.toLowerCase(),e[q]=l[A](),o.push((e[q]?"":"no-")+q));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)u(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof enableClasses!="undefined"&&enableClasses&&(f.className+=" "+(b?"":"no-")+a),e[a]=b}return e},v(""),h=j=null,e._version=d,e.mq=s,e.testStyles=r,e}(this,this.document);


/* Responsive nav and widgets */

function swift_if_mobile() {
    jQuery(function($) {
        if (Modernizr.mq('(max-width: 580px)')) {
            $('.pull').remove(); /* Hide the nav to start with */
            $('.sw_nav').hide();
            $('.add-arrow').removeClass('add-arrow');
            $('.add-arrow-right').removeClass('add-arrow-right');
            
            /* Add the menu click area */
            if ($('#above-logo').length && $('#below-logo').length) {
                $('#below-logo').prepend('<div class="pull alignleft above"  id="above-nav" data="above-logo">&nbsp;</div>');
                $('#below-logo').prepend('<div class="pull alignright below"  id="below-nav" data="below-logo">&nbsp;</div>');
            } else if ($('#above-logo').length) {
                $('#branding .div-content').prepend('<div class="pull alignleft above" id="above-nav"  data="above-logo" style="position:absolute;top:20%;left:0">&nbsp;</div>');
            } else if ($('#below-logo').length) {
                $('#below-logo').prepend('<div class="pull alignright below"  id="below-nav" data="below-logo">&nbsp;</div>');
            }
            swift_sidr = false;
            $('#above-nav').sidr({
                name: 'sidr-left',
                side: 'left',
                speed: 100,
                source: '#above-logo-nav',
                onOpen: function(){
                	swift_sidr = true;
                },
                onClose: function(){
                	swift_sidr = false;
                }
            });
            $('#below-nav').sidr({
                name: 'sidr-right',
                side: 'right',
                speed: 100,
                source: '#below-logo-nav',
                onOpen: function(){
                	swift_sidr = true;
                },
                onClose: function(){
                	swift_sidr = false;
                }
            });

            if (typeof swift_hide_widegts === "function") { 
    			swift_hide_widegts();
			}
            $('.pull_w').click(function() {
                $("#" + jQuery(this).attr("data")).slideToggle()
            });
            if(!jQuery('#below-logo-container-sticky-wrapper').length){
                $("#below-logo-container").sticky({topSpacing:0,bottomSpacing:0,getWidthFrom:"#wrapper"});
            }

            $("#below-logo-container").sticky("update");

            


            
            
        } else {
            $('.sw_nav,.widget').show()
            $('.pull,.pull_w').remove()
            $.sidr('close', 'sidr-left');
            $.sidr('close', 'sidr-right');
        }
    });
}
jQuery(document).ready(function($) {
    swift_if_mobile();
    $(window).resize(function() {
        if(typeof swift_sidr === 'undefined' || !swift_sidr){
            swift_if_mobile();
        }

    });
});

// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//       It will only set the 'top' and 'position' of your element, you
//       might need to adjust the width in some cases.

(function($) {
  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrap: true,
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: ''
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css('position', '')
              .css('top', '');
            s.stickyElement.parent().removeClass(s.className);
            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop != newTop) {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.parent().addClass(s.className);
            s.currentTop = newTop;
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();
    },
    methods = {
      init: function(options) {
        var o = $.extend({}, defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          if (o.wrap) {
            var stickyId = stickyElement.attr('id') ? stickyElement.attr('id') : 'node' + sticked.length;
            var wrapper = $('<div></div>')
              .attr('id', stickyId + '-sticky-wrapper')
              .addClass(o.wrapperClassName);
            stickyElement.wrapAll(wrapper);
          }

          if (stickyElement.is('tr')) {
            stickyElement.parents('table').first().find('th, td').each(function() {
              $(this).width($(this).width());
            });
          }

          if (o.center) {
            stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") == "right") {
            stickyElement.css('left', stickyElement.offset().left);
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          var stickyWrapper = stickyElement.parent();
          stickyWrapper.css('height', stickyElement.outerHeight());
          sticked.push({
            topSpacing: o.topSpacing,
            bottomSpacing: o.bottomSpacing,
            stickyElement: stickyElement,
            currentTop: null,
            wrap: o.wrap,
            stickyWrapper: stickyWrapper,
            className: o.className,
            getWidthFrom: o.getWidthFrom
          });
        });
      },
      update: scroller
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };
  $(function() {
    setTimeout(scroller, 0);
  });
})(jQuery);

jQuery(window).load(function(){jQuery(".stick-it").sticky();if( window.outerWidth>580 ){}});
/*
 *
 */
jQuery(function($) {
	scroll_hidden = true;
	$(window).scroll(function() {
        if(!Modernizr.mq('(max-width: 580px)') ){
            return
        }
		clearTimeout($.data(this, 'scrollTimer'));
//		if(scroll_hidden){
	    	$('#scroll,#below-logo-container-sticky-wrapper.is-sticky').show();
	    	scroll_hidden = false;	
//		}
	    $.data(this, 'scrollTimer', setTimeout(function() {
            if( $('#scroll').is(":hover") || $('#below-logo-container-sticky-wrapper').is(":hover")){
                return
            }
	    	$('#scroll').hide( 500 );
	    	if( typeof swift_sidr === 'undefined' || !swift_sidr){
	    		$('#below-logo-container-sticky-wrapper.is-sticky').hide( 500 );
	    	}
	        scroll_hidden = true;
	    }, 1500));
	});	
	
	
    //Delayed loading of gravatars
    $('img[data-gravatar-hash]').each(function() {
        var hash = $(this).attr('data-gravatar-hash');
        if (window.location.protocol == "https:")
            var img_url = 'https://secure.gravatar.com/avatar/' + hash;
        else
            var img_url = 'http://www.gravatar.com/avatar/' + hash;
        $(this).attr('src', img_url);
    });
    //Nav search on tablets
    $('#navsearch input[type="text"]').after("<div class='fa-search'></div>");
    $('#navsearch').after("<div class='after' id='mobile-search'>&#xf002;</div>");
    $('#mobile-search').click(function() {
        $('#navsearch').toggle();
    });
    
    // Scroll to top abd bottom.
    var window_width = $(window).width();
    var wrapper_width = $("#wrapper").width();
   	if((window_width - wrapper_width)>40){
   		style = 'margin-left:'+(wrapper_width/2+20)+'px;';
   	}else{
   		style = 'margin-left:'+(wrapper_width/2-80)+'px;';
   	}
	var s ='<div id="scroll" class="" style="'+style+'"><a href="#top" id="goto_top">&#xf0aa;</a><a href="#copyright" id="goto_bottom">&#xf0ab;</a></div>';
	$("body").append(s);

    
    $("#goto_top").click(function(e) {
    	e.preventDefault();
		$('html, body').animate({
        	scrollTop: $("#top").offset().top
    	}, 1000);
	});
    
    $("#goto_bottom").click(function(e) {
		e.preventDefault();
    	$('html, body').animate({
        	scrollTop: $("#copyright").offset().top
    	}, 1000);
	});
	    
    // Shortcode tabs
    if ($('.shortcode-tabs').length) {
        $('.shortcode-tabs').each(function() {
            var tabCount = 1;
            $(this).children('.tab').each(function(index, element) {
                var idValue = $(this).parents('.shortcode-tabs').attr('id');
                var newId = idValue + '-tab-' + tabCount;
                $(this).attr('id', newId);
                $(this).parents('.shortcode-tabs').find('ul.tab_titles').children('li').eq(index).find('a').attr('href', '#' + newId);
                tabCount++;
            });
            var thisID = $(this).attr('id');
            $(this).tabs({
                fx: {
                    opacity: 'toggle',
                    duration: 200
                }
            });
        });
    } 	  
    
    //Toggle shortcode
	if ($('.shortcode-toggle').length) {
        $('.shortcode-toggle').each(function() {
            var toggleObj = $(this);
            toggleObj.closedText = toggleObj.find('input[name="title_closed"]').attr('value');
            toggleObj.openText = toggleObj.find('input[name="title_open"]').attr('value');
            // Add logic for the optional excerpt text.
            if (toggleObj.find('a.more-link.read-more').length) {
                toggleObj.readMoreText = toggleObj.find('a.more-link.read-more').text();
                toggleObj.readLessText = toggleObj.find('a.more-link.read-more').attr('readless');
                toggleObj.find('a.more-link.read-more').removeAttr('readless');
                toggleObj.find('a.more-link').click(function() {
                    var moreTextObj = $(this).next('.more-text');
                    moreTextObj.animate({
                        opacity: 'toggle',
                        height: 'toggle'
                    }, 300).css('display', 'block');
                    moreTextObj.toggleClass('open').toggleClass('closed');
                    if (moreTextObj.hasClass('open')) {
                        $(this).text(toggleObj.readLessText);
                    } // End IF Statement
                    if (moreTextObj.hasClass('closed')) {
                        $(this).text(toggleObj.readMoreText);
                    } // End IF Statement
                    return false;
                });
            }
            toggleObj.find('input[name="title_closed"]').remove();
            toggleObj.find('input[name="title_open"]').remove();
            toggleObj.find('h4.toggle-trigger a').click(function() {
                toggleObj.find('.toggle-content').animate({
                    opacity: 'toggle',
                    height: 'toggle'
                }, 300);
                toggleObj.toggleClass('open').toggleClass('closed');
                if (toggleObj.hasClass('open')) {
                    $(this).text(toggleObj.openText);
                } // End IF Statement
                if (toggleObj.hasClass('closed')) {
                    $(this).text(toggleObj.closedText);
                } // End IF Statement
                return false;
            });
        });
    }
Mx_nav();
    
}); /* add arrow to the drop down */

function Mx_nav() {
    jQuery(".sw_nav li ul").prev().addClass('add-arrow')
    jQuery(".sw_nav li ul li ul").prev().removeClass('add-arrow').addClass('add-arrow-right')
}
