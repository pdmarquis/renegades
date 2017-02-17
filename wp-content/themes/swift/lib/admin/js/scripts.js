/* Tabs on Options page */

jQuery(document).ready(function($){





        jQuery('.pill').data('powertip', function() {
            return jQuery(this).find('.tooltip-html').html();
        });

        jQuery('.pill').powerTip({
            mouseOnToPopup: true,
            smartPlacement:true,
            closeDelay:500
        });
















    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;
    $('.branding .button').click(function(e) {
        var preview = $(this).parent().find('.swift_image_preview');

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('_button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                $("#"+id).val(attachment.url);
                preview.attr('src',attachment.url);

            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });


    $('.backgrounds .button').click(function(e) {
        var preview = $(this).parent().find('.swift_image_preview');

        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = $(this);
        var id = button.attr('id').replace('_button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media ) {
                $("#"+id).val(attachment.url);

            } else {
                return _orig_send_attachment.apply( this, [props, attachment] );
            };
        }

        wp.media.editor.open(button);
        return false;
    });

    $('.add_media').on('click', function(){
        _custom_media = false;
    });



});

jQuery(function () {

    /* Background selection */
    jQuery(".backgrounds .pattern").click(function(){
        var pattern;
        pattern = jQuery(this).attr('data');
        jQuery(this).parent().css( "background-image", 'url(' + pattern + ')'  )
        jQuery(this).parent().find('.bg-url').val(pattern)

    });


    jQuery("#tabs").tabs({
        active: jQuery.cookie('activetab'),
        activate: function (event, ui) {
            jQuery.cookie('activetab', ui.newTab.index(), {
                expires: 10
            });
        }
    });

    jQuery(".spectrum").spectrum({
        //color: tinycolor,

        showInput: true,
        allowEmpty: true,
        showAlpha: true,
        clickoutFiresChange: true,
        preferredFormat: "rgb",
        showPalette: true,

        palette: [['transparent']],


    });
});
jQuery(function () {
    jQuery('.color-group').each(function () {
        var ID = '#' + jQuery(this).attr('id')
        var temp = jQuery.cookie('show_' + jQuery(this).attr('id'));
        temp = Number(temp)
        if (temp) {
            jQuery(ID + " div.color,hr").show();
            jQuery(ID + " .color-heading").removeClass('hidden');

        } else {
            jQuery(ID + " div.color,hr").hide();
            jQuery(ID + " .color-heading").addClass('hidden');
        }

    });
});

jQuery(function () {
    jQuery('.color-heading a').click(function () {
        var groupID = jQuery(this).parent().parent().attr('id');
        if (jQuery("#" + groupID + " div.color,#" + groupID + " hr").is(":hidden")) {
            jQuery("#" + groupID + " div.color,#" + groupID + " hr").slideDown("slow");
            jQuery(this).parent().removeClass('hidden');
            jQuery.cookie('show_' + groupID, 1);

        } else {
            jQuery("#" + groupID + " div.color,#" + groupID + " hr").hide();
            jQuery(this).parent().addClass('hidden');
            jQuery.cookie('show_' + jgroupID, 0);
        }
    });
});

jQuery(function () {
    jQuery('#expand').click(function () {
        if (jQuery("div.color,hr").is(":hidden")) {
            jQuery("div.color,hr").slideDown("fast");
            jQuery('.color-heading').removeClass('hidden');
            jQuery(this).html("[-] Collapse All")
            jQuery('.color-group').each(function () {
                jQuery.cookie('show_' + jQuery(this).attr('id'), 1);
            });

        }
        else {
            jQuery("div.color,hr").hide();
            jQuery('.color-heading').addClass('hidden');
            jQuery(this).html("[+] Expand All")
            jQuery('.color-group').each(function () {
                jQuery.cookie('show_' + jQuery(this).attr('id'), 0);
            });

        }
    });
});
/* Radio button options */
jQuery(document).ready(function () {



    //jQuery("#header").sticky({topSpacing:20+jQuery(".swift-wrap").offset().top, getWidthFrom:'#header'});
    //jQuery("#tabs-nav").sticky({topSpacing:200+jQuery(".swift-wrap").offset().top});

//     var top =  jQuery('.swift-wrap').offset().top;
    jQuery("#boom").sticky({topSpacing: 108, getWidthFrom: '#header', bottomSpacing: 50});
    jQuery("#wp-header").sticky({topSpacing: 50, bottomSpacing: 50});

    //jQuery("#tabs-nav").sticky({topSpacing:60+jQuery('#header').outerHeight()});

    jQuery('input:radio').click(function () {

        var radioID = jQuery(this).parent().attr('id');
        /*	jQuery('#'+radioID+' input').next().find( 'img' ).css('background','#fdd2cf')

         jQuery('#'+radioID).find(':checked').next().find( 'img' ).css('background','red')

         jQuery('#'+radioID+' input').next().find( 'img' ).removeClass('selected');

         jQuery('#'+radioID).find(':checked').next().find( 'img' ).addClass('selected');

         */

        jQuery('#' + radioID + ' input').next().removeClass('selected');

        jQuery('#' + radioID).find(':checked').next().addClass('selected');

    });



    jQuery('#body_bg').bind('colorpicked', function () {
        alert(jQuery(this).val());
    });
});


/* Sortable and draggable */
function update_input(optionName, test) {
    var output = '';
    test.find('input').each(function () {
        output = output + jQuery(this).val() + ',';
    });
    output = output.substring(0, output.length - 1);
    jQuery('input#' + optionName).val(output);
};

jQuery(function () {
    jQuery(".sortable").each(function () {

        /* trying to save changes when the text widget is updated */
        jQuery(this).find('input').change(function () {
            jQuery(this).parent().parent().sortable('refresh')
        });

        jQuery(this).sortable({
            update: function () {
                var optionName = jQuery(this).attr('ID');
                update_input(optionName, jQuery(this));
            },

            create: function () {
                var optionName = jQuery(this).attr('ID');
                update_input(optionName, jQuery(this));
            },

            receive: function (e, ui) {
                sortableIn = 1;
            },

            over: function (e, ui) {
                sortableIn = 1;
            },

            out: function (e, ui) {
                sortableIn = 0;
            },

            beforeStop: function (e, ui) {
                if (sortableIn == 0) {
                    ui.item.remove();
                }
                var optionName = jQuery(this).attr('ID');
                update_input(optionName, jQuery(this));
            }

        });

    });

    jQuery(".draggable li").each(function () {
        jQuery(this).draggable({
            connectToSortable: ".sortable",
            helper: "clone",
            revert: "invalid"
        });
    });

    jQuery(".sortable-container ul,.sortable-container li").disableSelection();

    /* Enable selection on input fields */
    jQuery(".sortable").sortable({
        stop: function () {
            // enable text select on inputs
            jQuery(".sortable").find("input")
                .bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function (e) {
                    e.stopImmediatePropagation();
                });
        }
    }).disableSelection();
});

function confirmation() {
    var answer = confirm("Reset will delete the options in other tabs on this page. Are you sure you want to proceed?")
    if (answer) {
        var answer = confirm("Are you really sure?")
    }
    if (answer)
        return true;
    else
        return false;
}

function confirm_color_import() {
    var answer = confirm("Import will overwrite your current color scheme. Are you sure you want to proceed.")
    if (answer) {
        var answer = confirm("Are you really sure?")
    }
    if (answer)
        return true;
    else
        return false;
}

jQuery(function () {
    jQuery("#slider-range").slider({
        range: true,
        min: 0,
        max: 100,
        step: 0.05,
        values: [jQuery('#content_width').val(), parseInt(jQuery('#content_width').val()) + parseInt(jQuery('#sb1_width').val())],
        slide: function (event, ui) {
            var content = jQuery("#slider-range").slider("values", 0)
            var sb1 = jQuery("#slider-range").slider("values", 1) - jQuery("#slider-range").slider("values", 0)
            var sb2 = 100 - jQuery("#slider-range").slider("values", 1)
            var sb = 100 - jQuery("#slider-range").slider("values", 0)
            airy = jQuery('#airy input[type="radio"]:checked').val();
            wrapper = (jQuery('#wrapper_width').val() - 2 * airy) / 100;
            jQuery('#content-width').html('Content width is <strong>' + content + '% {' + parseInt(content * wrapper) + 'px}</strong>')
            jQuery('#sb-width').html('Sidebar width is <strong>' + (sb).toFixed(2) + '% {' + Math.floor(sb * wrapper) + 'px}</strong>')
            jQuery('#sb1-width').html('Sidebar 1 width is <strong>' + (sb1).toFixed(2) + '% {' + Math.floor(sb1 * wrapper) + 'px}</strong>')
            jQuery('#sb2-width').html('Sidebar 2 width is <strong>' + (sb2).toFixed(2) + '% {' + Math.floor(sb2 * wrapper) + 'px}</strong>')
            jQuery('#content_width').val(content)
            jQuery('#sb1_width').val(sb1)
            //alert(( "$" + jQuery( "#slider-range" ).slider( "values", 0 ) +" - $" + jQuery( "#slider-range" ).slider( "values", 1 ) ))
        }
    });

    /*
     * JS for Google WEB fonts
     */
    jQuery(document).on('click', 'span.remove', function () {
        remove_font = jQuery(this).attr('data');
        jQuery('#li_' + remove_font).remove();
        jQuery('#input_' + remove_font).remove();
    });
    if (!(typeof font_list_start === 'undefined')) {
        WebFont.load({
            google: {
                families: font_list_start,
            }
        });
    }


    var data = {
        action: 'font_scroll',
        font_number: 0,
        sample: jQuery("#sample_text").val()
    };
    jQuery('#infinite_scroll').scroll(function () {
        data['sample'] = jQuery("#sample_text").val();
        var height = jQuery('#infinite_scroll')[0].scrollHeight;
        var position = jQuery('#infinite_scroll').scrollTop() + 240
        if ((height - position) < 3) {
            data['font_number'] = jQuery('#infinite_scroll').children('li').length;
            var families = [];
            jQuery.post(ajaxurl, data, function (response) {
                jQuery('#infinite_scroll').append(response);
                jQuery('li', jQuery('<div>' + response + '</div>')).each(function () {
                    families.push(jQuery(this).attr('data'));
                });
                WebFont.load({
                    google: {
                        families: families
                    }
                });
            });
        }
    });
    jQuery(document).on('click', '#infinite_scroll li', function () {
        var font;
        font = jQuery(this).attr('data')
        var variants = '';

        jQuery(this).find("input[type=checkbox]:checked").each(function () {
            variants = variants + jQuery(this).val() + ','
        });
        jQuery('#font_preview').css('font-family', font)
        jQuery('#addfont').text('Add ' + font)
        jQuery('#addfont').attr('data', font)
        jQuery('#addfont').attr('variants', variants)
    });

    jQuery('#addfont').click(function () {
        //jQuery('#selected_fonts').append(jQuery('#addfont').attr('data'))
        font = jQuery('#addfont').attr('data');
        variants = jQuery('#addfont').attr('variants');
        for_blogname = jQuery('#font_optimization #blogname').is(':checked')
        for_tagline = jQuery('#font_optimization #tagline').is(':checked')
        san_font = font.replace(/[\,,:,\+ ]/, '_')
        li = '<li id="li_' + san_font + '"  style="font-family:' + font + '" class="btn btn-primary"><strong>' + font + '</strong><br><span>'
        if (for_blogname && for_tagline) {
            li = li + 'For blogname and tagline only'
        } else {
            if (for_blogname)
                li = li + 'For blogname only'
            if (for_tagline)
                li = li + 'For tagline only'
        }
        if (!for_blogname && !for_tagline) {
            li = li + 'Load entire font'
        }
        li = li + '</span><span data="' + san_font + '"class="remove"></li>'
        input = '<input type="hidden" id="input_' + san_font + '" name="swift_design_options[swift_gfonts][]" value="' + font + ':' + variants + '%' + for_blogname + '%' + for_tagline + '">'
        jQuery('#selected_fonts').append(li + input)
    })
    jQuery('span.remove').click(function () {
        remove_font = jQuery(this).attr('data')
        jQuery('#li_' + remove_font).remove()
        jQuery('#input_' + remove_font).remove()
    })


});

//-->
