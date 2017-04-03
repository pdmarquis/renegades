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
            
            <div class="clear"></div>
				<p class="pdm-footer-link"><?php echo __('Copyright &copy;', 'swift') . '&nbsp;' . date('Y'); ?>
                    <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>. Email the Renegades: <a href="mailto:bostonrenegades@gmail.com">bostonrenegades@gmail.com</a></p>
            <p class="pdm-footer-link">
                    This site in <a href="http://www.viguide.com/blindandvi.htm">The Blind and Visually Impaired Ring</a> is owned by <a href="mailto:president@blindcitizens.org">John Oliveira</a></p>
            <div class="clear"></div>
        </div>
    </div>
    <!-- /copyright -->
</div>
<!-- /copyright-container -->
