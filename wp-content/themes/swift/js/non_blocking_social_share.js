 function loadSocial() {
    //I will assume that if we have one type of button we have them all
    //If not we'll just exit
    //if ($(".twitter-share-button").length == 0) return;
    //Twitter
    if (typeof(twttr) != 'undefined') {
        twttr.widgets.load();
    } else {
        jQuery.getScript('//platform.twitter.com/widgets.js');
    }
    //Facebook
    if (typeof(FB) != 'undefined') {
        FB.init({
            status: true,
            cookie: true,
            xfbml: true
        });
    } else {
        jQuery.getScript("//connect.facebook.net/en_US/all.js#xfbml=1&appId="+swift.fb_app_id, function() {
            FB.init({
                status: true,
                cookie: true,
                xfbml: true
            });
        });
    }
    //Linked-in
    if (typeof(IN) != 'undefined') {
        IN.parse();
    } else {
        jQuery.getScript("//platform.linkedin.com/in.js");
    }
    //Google - Note that the google button will not show if you are opening the page from disk - it needs to be http(s)
    if (typeof(gapi) != 'undefined') {
        jQuery(".g-plusone").each(function() {
            gapi.plusone.render(jQuery(this).get(0));
        });
    } else {
        jQuery.getScript('https://apis.google.com/js/plusone.js');
    }
    // Should check if its already loaded
    jQuery.getScript('//assets.pinterest.com/js/pinit.js')
}
if(typeof(loadSocialProxy ) == "function"){
    loadSocialProxy()
}