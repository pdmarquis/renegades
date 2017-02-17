function swift_hide_widegts(){
	/* Now the widgets */
            jQuery('.pull_w').remove() /* Hide the widgets to start with */
            jQuery('.sidebar .widget').hide()

            jQuery('.sidebar .widget').each(function() {
                title = jQuery(this).find('.widget-title').html();
                if (!title) {
                    title = "Show";
                }
                id = jQuery(this).attr('ID')
                jQuery(this).before('<div class="pull_w btn btn-primary" data="' + id + '">' + title + '</div>')
            });
}
