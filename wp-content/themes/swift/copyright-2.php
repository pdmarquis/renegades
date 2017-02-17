<?php
GLOBAL $swift_options;
GLOBAL $swift_design_options;
?>
<div id="copyright-container">
    <div id="copyright" class="hybrid clearfix">
        <div class="div-content">
            <div>
                <?php
                wp_nav_menu(array('container' => '',
                        'menu_class' => '',
                        'menu_id' => 'footer-links',
                        'fallback_cb' => '',
                        'theme_location' => 'footer-links')
                );
                ?>
            </div>

            <?php echo do_shortcode(stripslashes($swift_design_options['copyright_text'])); ?>
            <div class="clear"></div>
        </div>
    </div>
    <!-- /copyright -->
</div>
<!-- /copyright-container -->
