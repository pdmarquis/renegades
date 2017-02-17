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
