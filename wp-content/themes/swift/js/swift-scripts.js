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