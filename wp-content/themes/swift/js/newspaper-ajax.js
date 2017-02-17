jQuery(document).ready(function($) {
    $('#np-tabs .nav-tab a').on('click',function() {
        var cat_id = $(this).data("cat_id")
        if(!cat_id){
            return true;
        }
        var tab_id = $(this).data("tab_id")
        var exclude_post_ids = $(this).data("exclude_posts")
        jQuery.ajax({
            type: "post",
            dataType: "html",
            url: swift.ajaxurl,
            data: {
                'action': 'load_np_tab',
                'cat_id': cat_id,
                'exclude_post_ids':exclude_post_ids
            },
            success: function(response) {
                if (response) {
                    jQuery('#np-tabs-tab-'+tab_id).html(response)
                    jQuery('#np-tabs #ui-id-'+tab_id).data('cat_id',0)
                    loadSocial()
                } else {
                    jQuery('#np-tabs-tab-'+tab_id).html("Could not fetch related posts")
                    
                }
            }
        })
    })
});