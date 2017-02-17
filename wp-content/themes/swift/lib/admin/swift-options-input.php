<?php
function np_setup_cat_base()
{
    ?>
    <div id="cat-base" class="sortable-container">
        <ul class="draggable clearfix">
            <!--
		<li class="ui-state-default btn random"><input type="hidden"
			value="-6"> <?php _e('Recenet comments', 'swift'); ?></li>
		<li class="ui-state-default btn random"><input type="hidden"
			value="-5"> <?php _e('Top authors', 'swift'); ?></li>
		<li class="ui-state-default btn random"><input type="hidden"
			value="-4"> <?php _e('Random authors', 'swift'); ?></li>
		<li class="ui-state-default btn random"><input type="hidden"
			value="-3"> <?php _e('Popular posts', 'swift'); ?></li>
		<li class="ui-state-default btn recent"><input type="hidden"
			value="-2"> <?php _e('Recent posts', 'swift'); ?></li>
		<li class="ui-state-default btn random"><input type="hidden"
			value="-1"> <?php _e('Random posts', 'swift'); ?></li>
			-->
            <li class="ui-state-default btn recent"><input type="hidden"
                                                           value="-2"> <?php _e('Recent posts', 'swift'); ?></li>
            <?php
            $categories = get_categories();
            foreach ($categories as $cat) {
                ?>
                <li class="ui-state-default btn btn-primary"><input type="hidden"
                                                                    value="<?php echo $cat->term_id; ?>"> <?php echo $cat->name . ' ( ' . $cat->count . ' )'; ?>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
<?php
}

function swift_custom_slider()
{
    GLOBAL $swift_options;

    $slides = (!isset($swift_options['slides'])) ? array() : $swift_options['slides'];
    for ($i = 0; $i < $swift_options['number_of_slides']; $i++) {

        $slide = (!isset($slides[$i])) ? array() : $slides[$i];
        ?>
        <div class="slide">




	        <div class="uploader branding">
		        <label for="slide_img<?php echo $i ?>" class="alignleft"><?php _e('Image', 'swift'); ?></label>
		        <input class="regular-text alignleft" id="slide_img<?php echo $i ?>" name="swift_options[slides][<?php echo $i ?>][img]"
		               type="text"
		               value="<?php echo (!isset($slide['img'])) ? '' : $slide['img']; ?>" >
		        <input id="slide_img<?php echo $i ?>_button" class="button" name="unique_name_button alignleft" type="text" value="Upload" />

	        </div>
			<div class="clear"></div>
	        <?php if (isset($slide['img']) && $slide['img'] != ''): ?>
		        <img class="swift_image_preview alignright" id="image_slide_<?php echo $i; ?>"
		             src="<?php echo $slide['img']; ?>" style="max-width: 90%"/>
	        <?php endif; ?>

	        <label for="slide_href_<?php echo $i ?>"><?php _e('Traget/link', 'swift'); ?></label>
            <input type="text" name="swift_options[slides][<?php echo $i ?>][href]"
                   value="<?php echo (!isset($slide['href'])) ? '' : $slide['href']; ?>"
                   id="slide_href_<?php echo $i ?>"><br/>

            <label for="slide_caption_<?php echo $i ?>"><?php _e('Caption', 'swift'); ?></label>

            <textarea name="swift_options[slides][<?php echo $i ?>][caption]"
                      id="slide_caption_<?php echo $i ?>"><?php echo stripslashes((!isset($slide['caption'])) ? '' : $slide['caption']); ?></textarea>

        </div>
        <div class="clear"></div>
    <?php
    }
}

function swift_options_input()
{
    ?>
    </td>
    </tr>
    </table>
    <div id="tabs" class="clearfix">
    <div id="boom">
        <div id="header">
            <div id="theme-logo" class="alignleft">
                <a href="http://SwiftThemes.Com"><img
                        src="<?php echo get_template_directory_uri() ?>/lib/admin/images/SwiftThemesLogo.png"
                        alt="SwiftThemes"> </a>
            </div>
            <div id="swift-options-buttons" class="clearfix">
                <input
                    name="swift_options[save]" type="submit"
                    value="<?php _e('Save options', 'swift'); ?>"
                    class="btn btn-primary btn-lg" id="save"/>
                <input name="swift_options[reset]" type="submit" id="reset"
                       onClick="return confirmation()"
                       value="<?php _e('Reset options', 'swift'); ?>"
                       class=""/>
            </div>
        </div>
        <ul id="tabs-nav" class="clearfix">
            <li><a href="#general-settings" id="logo-header"><?php _e('Branding & Misc', 'swift') ?>
                </a></li>
            <!--<li><a href="#header-options" id="logo-header"><?php _e('Branding & Header', 'swift') ?> </a>
            </li>-->
            <!--
            <li><a href="#slider-options" id="slider-settings"><?php _e('Custom slider', 'swift') ?>
                </a></li> -->
            <li><a href="#homepage-options" id="homepage-settings"><?php _e('Homepage settings', 'swift') ?>
                </a></li>
            <li><a href="#post-meta" id="single-settings"><?php _e('Single post options', 'swift') ?> </a>
            </li>
            <!--<li><a href="#ad-management" id="ad-settings"><?php _e('AD management', 'swift') ?> </a>
            -->
            </li>
            <!-- <li><a href="#np-layout" id="np-settings"><?php _e('NEWS paper layout', 'swift') ?> </a>
            </li> -->
            <!--
		<li><a href="#np2-layout" id="np2-settings"><?php _e('NEWS paper layout 2', 'swift') ?> </a>
		</li>
		-->
            <li><a href="#social-media" id="sm-settings"><?php _e('Social media', 'swift') ?> </a></li>
        </ul>
    </div>
    <div id="options" class="clearfix">
    <?php
    GLOBAL $swift_options_init, $swift_options;
    $swift_options_init = apply_filters('swift_options_init', $swift_options_init);
    $temp = get_option('SwiftOptions');
    $swift_opt = $temp['site_options'];
    foreach ($swift_options_init as $opt) {

        switch ($opt['type']) {

            case 'heading':
                echo '<div id="' . $opt['id'] . '" class="options clearfix">';
                break;

            case 'close':
                echo '</div>';
                break;

            case 'clear':
                echo '<div class="clear"></div>';
                break;
            case 'hidden':
                ?>
                <input type="hidden" value="options"
                       name="swift_options[<?php echo $opt['id'] ?>]">
                <?php
                break;

            case 'explain':
                ?>
                <p id="<?php echo $opt['id'] ?>" class="explain alert alert-info">
                    <?php echo wp_kses_post($opt['desc']) ?>
                </p>
                <?php
                break;

            case 'function' :
                $opt['id'] ();
                break;

            case 'text':
                ?>
                <div class="text">
                    <label for="<?php echo $opt['id'] ?>"><h4>
                            <?php echo $opt['name'] ?>
                        </h4></label> <input type="text"
                                             name="swift_options[<?php echo $opt['id'] ?>]"
                                             id="<?php echo $opt['id'] ?>"
                                             value="<?php echo $swift_opt[$opt['id']]; ?>"/> <label
                        for="<?php echo $opt['id'] ?>"><em><?php echo $opt['desc'] ?> </em> </label>
                </div>
                <?php
                break;

            case 'textarea':
	        case 'ads':

	        ?>
                <div class="textarea clearfix">
                    <label for="<?php echo $opt['id'] ?>"><h4>
                            <?php echo $opt['name'] ?>
                        </h4></label>
                    <textarea rows="7" cols="50"
                              name="swift_options[<?php echo $opt['id'] ?>]"
                              id="<?php echo $opt['id'] ?>"><?php
                        if (isset($swift_opt[$opt['id']]) && $swift_opt[$opt['id']] != '') {
                            echo stripslashes(esc_attr($swift_opt[$opt['id']]));
                        } else {
                            echo stripslashes($opt['default']);
                        } ?></textarea>
                    <label for="<?php echo $opt['id'] ?>"><em><?php echo $opt['desc'] ?> </em>
                    </label>
                </div>
                <?php            break;

            case 'ads':
                ?>
                <div class="textarea clearfix">
                    <label for="<?php echo $opt['id'] ?>"><h4>
                            <?php echo $opt['name'] ?>
                        </h4></label>

                    <div class="ads desktop">
                        <textarea rows="7" cols="50"
                                  name="swift_options[<?php echo $opt['id'] ?>]"
                                  id="<?php echo $opt['id'] ?>"><?php
                            if (isset($swift_opt[$opt['id']]) && $swift_opt[$opt['id']] != '') {
                                echo stripslashes(esc_attr($swift_opt[$opt['id']]));
                            } else {
                                echo stripslashes($opt['default']);
                            } ?></textarea>
                    </div>
                    <div class="ads mobile">
                        <textarea rows="7" cols="50" class="ads mobile"
                                  name="swift_options[<?php echo $opt['id'] . '_m' ?>]"
                                  id="<?php echo $opt['id'] ?>"><?php
                            if (isset($swift_opt[$opt['id'] . '_m']) && $swift_opt[$opt['id'] . '_m'] != '') {
                                echo stripslashes(esc_attr($swift_opt[$opt['id'] . '_m']));
                            } else {
                                echo stripslashes($opt['default']);
                            } ?></textarea>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <label for="<?php echo $opt['id'] . '_m' ?>"><em><?php echo $opt['desc'] ?> </em>
                    </label>
                </div>
                <?php            break;


            case 'radio':
                ?>
                <div class="radio clearfix" id="<?php echo $opt['id'] ?>">
                    <h4>
                        <?php echo $opt['name'] ?>
                    </h4>
                    <em><?php echo $opt['desc'] ?> </em>
                    <?php            foreach ($opt['options'] as $choice) {
                        if (isset($swift_opt[$opt['id']]) && $swift_opt[$opt['id']] == $choice) {
                            $checked = 'checked';
                            $label_style = 'class="selected"';
                        } else {
                            $checked = '';
                            $label_style = '';
                        }
                        ?>
                        <input type="radio" name="swift_options[<?php echo $opt['id'] ?>]"
                               value="<?php echo $choice; ?>"
                               id="<?php echo $opt['id'] . $choice; ?>" <?php echo $checked ?>> <label
                            for="<?php echo $opt['id'] . $choice;; ?>" <?php echo $label_style; ?>>
                            <img
                                src="<?php echo get_template_directory_uri() . '/lib/admin/images/' . $opt['id'] . '_' . $choice . '.png'; ?>"
                                alt="<?php echo $choice ?>"/> <?php echo $choice ?>
                        </label>
                    <?php
                    }
                    ?>
                </div>
                <?php
                break;

            case 'checkbox':
                ?>
                <div class="checkbox">
                    <h4>
                        <?php echo $opt['name'] ?>
                    </h4>
                    <input type="checkbox" name="swift_options[<?php echo $opt['id'] ?>]"
                           value="true" <?php checked($swift_opt[$opt['id']], true); ?>
                           id="<?php echo $opt['id']; ?>"/> <label
                        for="<?php echo $opt['id'] ?>"><em><?php echo $opt['desc'] ?> </em> </label>
                </div>
                <?php
                break;

            case 'select':
                ?>
                <div class="select">
                    <label for="<?php echo $opt['id'] ?>"><h4>
                            <?php echo $opt['name'] ?>
                        </h4></label> <select name="swift_options[<?php echo $opt['id'] ?>]">
                        <?php            foreach ($opt['options'] as $key => $choice) {
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php selected($swift_opt[$opt['id']], $key); ?>>
                                <?php echo $choice; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select> <label for="<?php echo $opt['id'] ?>"><em><?php echo $opt['desc'] ?>
                        </em> </label>
                </div>
                <?php
                break;
	        case 'upload':
		        ?>
		        <div class="uploader branding text">
			        <label for="<?php echo $opt['id'] ?>"><h4>
					        <?php echo $opt['name'] ?>
				        </h4> <em><?php echo $opt['desc'] ?> </em><br/> </label>
			        <input class="regular-text alignleft" id="<?php echo $opt['id'] ?>" name="swift_options[<?php echo $opt['id'] ?>]"
			               type="text"
			               value="<?php if ( isset( $swift_opt[ $opt['id'] ] ) && $swift_opt[ $opt['id'] ] != '' ) {
				               echo stripslashes( esc_attr( $swift_opt[ $opt['id'] ] ) );
			               } else {
				               echo stripslashes( $opt['default'] );
			               } ?>" >
		    <input id="<?php echo $opt['id'] ?>_button" class="button" name="unique_name_button" type="text" value="Upload" />
                    <?php
                if(isset($swift_opt[$opt['id']])):
                ?>
			        <img class="swift_image_preview" id="image_<?php echo $opt['id']; ?>"
			             src="<?php echo $swift_opt[$opt['id']]; ?>" style="max-width: 90%"/>
                <?php endif ?>
		        </div>

		        <?php
		        break;

            case 'cat_base':
                np_setup_cat_base();
                break;

            case 'np-setup':
                include(SWIFT_ADMIN . '/np-setup.php');
                break;

            case 'sortable':
                ?>

                <div class="sortable-container" id="<?php echo $opt['id'] ?>-container">
                    <label for="<?php echo $opt['id'] ?>"><h4>
                            <?php echo $opt['name'] ?>
                        </h4></label>

                    <ul class="sortable clearfix" id="<?php echo $opt['id'] ?>">
                        <?php
                        $sortable_options = $swift_opt[$opt['id']];
                        $size = count($sortable_options);
                        for ($i = 0; $i < $size; $i++) {
                            if ($sortable_options[$i] == 'text') {
                                ?>
                                <li class="ui-state-default btn btn-primary drag-text"><input class="position"
                                                                                              type="text" name="text"
                                                                                              value="<?php echo $sortable_options[$i + 1] ?>">
                                </li>
                                <?php                $i++;
                            } elseif ($sortable_options[$i] != '') {
                                ?>
                                <li class="ui-state-default btn btn-primary" id="1"><input type="hidden"
                                                                                           value="<?php echo $sortable_options[$i] ?>"> <?php echo $sortable_options[$i] ?>
                                </li>
                            <?php
                            }
                        }
                        ?>
                    </ul>
                    <ul class="draggable clearfix">
                        <?php            foreach ($opt['options'] as $option) {
                            if ($option == 'text') {
                                ?>
                                <li class="ui-state-default btn btn-primary drag-text"><input class="position"
                                                                                              type="text" name="text"
                                                                                              value=""></li>
                            <?php
                            } else {
                                ?>
                                <li class="ui-state-default btn btn-primary" id="1"><input type="hidden"
                                                                                           value="<?php echo $option ?>"> <?php echo $option ?>
                                </li>

                            <?php
                            }
                        }
                        ?>


                    </ul>
                    <input id="<?php echo $opt['id'] ?>" type="hidden"
                           name="swift_options[<?php echo $opt['id'] ?>]" value="">
                </div>
                <?php break;

        }

    }
    ?>
    </div>
    <!-- /#options -->
    </div>
    <!-- /#tabs -->

    <td>
        <tr>
            <table>
		<?php
}

?>