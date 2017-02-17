<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=wrapper div, opened in header.php
 *
 * @package Swift
 * @since Swift 6.0
 */
?>
<?php
GLOBAL $swift_options;
GLOBAL $swift_design_options;
?>
<div class="clear"></div>
<footer>
    <?php swift_before_footer() ?>
    <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')): ?>
        <div id="footer-container">
            <div id="footer" class="sidebar hybrid clearfix footer">
                <?php
                for ($i = 1; $i <= $swift_design_options['footer_columns']; $i++):
                    ?>
                <div class="fc-<?php echo $i ?> footer-widgets alignleft">
                    <div class="div-content">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar("footer-$i")) ?>
                    </div>
                    </div>
                    <!--End of footer-1 -->
                <?php
                endfor;
                ?>
            </div>
            <!-- /#footer -->
        </div>
        <!-- /#footer-contianer -->
    <?php endif ?>
    <?php get_template_part("copyright-{$swift_design_options['copyright_style']}"); ?>


    <?php swift_after_footer() ?>
</footer>
</div>
<div id="em_size"></div>
<!-- /#wrapper -->
<?php wp_footer() ?>
<?php swift_after_html(); ?>
</body>
</html>
