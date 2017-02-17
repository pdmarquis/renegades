/* add arrow to the drop down */
function Mx_nav(){
    jQuery(".sw_nav li ul").prev().addClass('add-arrow')
    jQuery(".sw_nav li ul li ul").prev().removeClass('add-arrow').addClass('add-arrow-right')
}
jQuery(window).load(function(){                   
	    Mx_nav();
	});