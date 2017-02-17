<?php
GLOBAL $swift_options;
GLOBAL $swift_thumbnail_sizes;
$slides = $swift_options['slides'];
if ($swift_options['slider_style'] == 'content-width') {
    $width = $swift_thumbnail_sizes['content_width_slider'][0];
    $height = $swift_thumbnail_sizes['content_width_slider'][1];
} else {
    $width = $swift_thumbnail_sizes['full_width_slider'][0];
    $height = $swift_thumbnail_sizes['full_width_slider'][1];

}
if (is_array($slides) && count($slides)) {
    ?>

    <div id="custom-slider" class="flex-container">
        <div class="flexslider">
            <ul class="slides">
                <?php
                foreach ($slides as $slide) {
                    ?>
                    <li>

                        <a href="<?php echo $slide['href'] ?>"><img src="<?php echo $slide['img'] ?>"
                                                                    width="<?php echo $width; ?>"
                                                                    height="<?php echo $height; ?>"></a>

                        <div class="flex-caption">
                            <?php echo $slide['caption'] ?>
                        </div>
                    </li>


                <?php
                }
                ?>
            </ul>
        </div>
    </div>
<?php
}?>
    