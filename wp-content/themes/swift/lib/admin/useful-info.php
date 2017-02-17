<?php
GLOBAL $swift_thumbnail_sizes;
//var_dump($swift_thumbnail_sizes);
$content_width = $swift_thumbnail_sizes['content_width_slider'][0];
?>

<style>
    #wrapper {
        padding: 20px 0
    }

    .widget {
        width: 32%;
        float: left;
        background: #fefab6;
        color: #333;
        line-height: 1.5em;
        font-size: 14px;
        margin-right: 1.33%;
        padding: 20px;

        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;

    }

    .widget a {
        font-weight: 900;
        color: #000
    }

    .widget .title {
        background: rgba(0, 0, 0, 0.1);
        margin: -20px -20px 20px;
        color: #000;
        font-weight: 900;
    }

    .widget ol li {
        list-style: decimal
    }

    table {
        width: 100%
    }

    td {
        text-align: center
    }

    small {
        font-size: .8em
    }
</style>
<div id="wrapper" class="js-masonry"
     data-masonry-options='{ "itemSelector": ".widget" }'>
    <div class="widget">

        <div class="title"><span style="font-size:1.5em">Swift Theme Recommendations</span></div>
        <p>Below are some recommended settings and other useful info that take your blog design an extra mile. <br>
            This recommendations are generated based on your current theme settings. If you are still playing around
            with the theme options,
            it's highly recommended to come back here after you finish your customization.
        </p>
    </div>

    <div class="widget">
        <div class="title">Ideal Media Settings</div>
        <p>
            You can change the media settings <a href="<?php echo admin_url('options-media.php') ?>">here</a>.<br>
            With these settings, you can have 3 thumbnail sized, and 2 medium sized images in a row when floated.<br>
            The large image will take 100% of your content area.<br>
            These fine details will make your design very professional. These are only recommended settings, its up to
            you to use them or not.
        </p>
        <br>
        <table>
            <tr>
                <th>Size</th>
                <th>Width in px<br></th>
                <th>Height in px</th>
            </tr>
            <tr>
                <td>Thumbnail</td>
                <td><?php echo (int)(($content_width - 60) / 3) ?></td>
                <td>0</td>
            </tr>
            <tr>
                <td>Medium</td>
                <td><?php echo (int)(($content_width - 40) / 2) ?></td>
                <td>0</td>
            </tr>
            <tr>
                <td>Large</td>
                <td><?php echo $content_width ?></td>
                <td>0</td>
            </tr>
        </table>
    </div>

    <div class="widget">
        <div class="title">Content width slider</div>
        Your content width slider size is <?php echo $swift_thumbnail_sizes['content_width_slider'][0] ?>
        *<?php echo $swift_thumbnail_sizes['content_width_slider'][1] ?>px.<br>
        You can use any image whose width and height are both greater
        than <?php echo $swift_thumbnail_sizes['content_width_slider'][0] ?>px
        and <?php echo $swift_thumbnail_sizes['content_width_slider'][1] ?>px respectively.<br>
        <?php $ratio = round($swift_thumbnail_sizes['content_width_slider'][0] / $swift_thumbnail_sizes['content_width_slider'][1], 3) ?>
        Ideally images should be in the aspect ratio <?php echo $ratio ?>:1 (width:height). That is a 1000px wide image
        should be <?php echo (int)(1000 / $ratio) ?>px tall.<br>
        You can change the height of the slider <a
            href="<?php echo admin_url('admin.php?page=swift-design-options#thumbnail-sizes') ?>">here</a>.
        <br>
        If you are using custom slider, make sure all the images are of equal dimensions.
    </div>

    <div class="widget">
        <div class="title">Full width slider</div>
        Your full width slider size is <?php echo $swift_thumbnail_sizes['full_width_slider'][0] ?>
        *<?php echo $swift_thumbnail_sizes['full_width_slider'][1] ?>px.<br>
        You can use any image whose width and height are both greater
        than <?php echo $swift_thumbnail_sizes['full_width_slider'][0] ?>px
        and <?php echo $swift_thumbnail_sizes['full_width_slider'][1] ?>px respectively.<br>
        <?php $ratio = round($swift_thumbnail_sizes['full_width_slider'][0] / $swift_thumbnail_sizes['full_width_slider'][1], 3) ?>
        Ideally images should be in the aspect ratio <?php echo $ratio ?>:1 (width:height). That is a 2000px wide image
        should be <?php echo (int)(2000 / $ratio) ?>px tall.<br>
        You can change the height of the slider <a
            href="<?php echo admin_url('admin.php?page=swift-design-options#thumbnail-sizes') ?>">here</a>.

        <br>
        If you are using custom slider, make sure all the images are of equal dimensions.
    </div>


    <div class="widget">
        <div class="title">Sidebars</div>
        Your sidebars dimensions are as follows. When using a text widget or the smart text widget to add ads, facebook
        likeboxes, twitter widget, optin codes etc
        make sure you add the appropriately sized one.
        <br><br>
        <table>
            <tr>
                <th>Sidebar</th>
                <th>With padding &amp; border<br>
                    <small>Regular text widget</small>
                </th>
                <th>Without padding &amp; border<br>
                    <small>Smart text widget</small>
                </th>
            </tr>
            <tr>
                <td>Wide sidebar<br></td>
                <td><?php echo $swift_thumbnail_sizes['wsb'] - 22 ?> px</td>
                <td><?php echo $swift_thumbnail_sizes['wsb'] ?> px</td>
            </tr>
            <tr>
                <td>Narrow sidebar 1<br></td>
                <td><?php echo $swift_thumbnail_sizes['ns1'] - 22 ?> px</td>
                <td><?php echo $swift_thumbnail_sizes['ns1'] ?> px</td>
            </tr>
            <tr>
                <td>Narrow sidebar 2<br></td>
                <td><?php echo $swift_thumbnail_sizes['ns2'] - 22 ?> px</td>
                <td><?php echo $swift_thumbnail_sizes['ns2'] ?> px</td>
            </tr>
            <tr>
                <td>Footer widgets<br></td>
                <td><?php echo $swift_thumbnail_sizes['footer-1'] - 20 ?> px</td>
                <td><?php echo $swift_thumbnail_sizes['footer-1'] ?> px</td>
            </tr>
        </table>
    </div>


    <div class="widget">
        <div class="title">Blog and magazine layouts</div>
        If you do not want your images awkwardly cropped, follow the below instructions.
        <ol>
            <li>Maintain same aspect ratio for sliders, magazine and blog thumbs</li>
            <li>Only use images in the above aspect ratio as featured images</li>
            You can change the thumbnail sizes <a
                href="<?php echo admin_url('admin.php?page=swift-design-options#thumbnail-sizes') ?>">here</a> to get
            the aspect ratio right.<br>

            Below are your current aspect ratios. Only the layout(blog or magazine) and slider (content or full width)
            you are using have to be in the same aspect ratio.

        </ol>
    </div>


</div>

