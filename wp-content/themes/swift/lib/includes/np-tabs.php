<?php global $swift_exclude_post_ids; ?>

<div id="np-tabs"
     class="shortcode-tabs clearfix default boxed ui-tabs ui-widget ui-widget-content ui-corner-all clearfix">
    <ul
        class="tab_titles ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
        <?php
        GLOBAL $swift_options;
        $count = 1;
        $cat_list = $swift_options['np_tabbed_cats'];
        $first = true;
        foreach ($cat_list as $category):
            if ($first) {
                if ($category == -2) {
                    ?>
                    <li
                        class="nav-tab ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a
                            href="#tab-<?php echo $category ?>" data-cat_id="0"
                            data-tab_id="<?php echo $count ?>"><?php _e('Recent posts', 'swift') ?>
                        </a></li>

                <?php
                } else {
                    ?>
                    <li
                        class="nav-tab ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a
                            href="#tab-<?php echo $category ?>" data-cat_id="0"
                            data-tab_id="<?php echo $count ?>"><?php echo get_cat_name($category) ?>
                        </a></li>
                <?php
                }
                $first = false;
            } else {
                if ($category == -2) {
                    ?>
                    <li
                        class="nav-tab ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a
                            href="#tab-<?php echo $category ?>" data-cat_id="0"
                            data-tab_id="<?php echo $count ?>"><?php _e('Recent posts', 'swift') ?>
                        </a></li>

                <?php
                } else {
                    ?>

                    <li
                        class="nav-tab ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a
                            href="#tab-<?php echo $category ?>"
                            data-exclude_posts="[<?php echo implode(",", $swift_exclude_post_ids) ?>]"
                            data-cat_id="<?php echo $category ?>"
                            data-tab_id="<?php echo $count ?>"><?php echo get_cat_name($category) ?>
                        </a></li>
                <?php
                }
            }
            ?>



            <?php $count++;endforeach; ?>
    </ul>
    <?php
    $first = true;
    foreach ($cat_list as $category):
        ?>
        <div id="tabs-<?php echo $category ?>" class="tab ui-tabs-panel ui-widget-content ui-corner-bottom">
            <?php
            if ($first) {
                include('np-tab.php');
                $first = false;
            } else {
                ?>        <i class="fa fa-spinner fa-spin"></i>
            <?php
            }

            ?>
        </div>
    <?php endforeach; ?>
    <div class="fix"></div>
    <!--/.fix-->

</div>
<!--/.tabs-->
