<?php
add_filter('body_class', 'swift_mag_class', 10, 2);
function swift_mag_class($classes)
{
    global $swift_design_options;

    if (in_array($swift_design_options['blog_or_mag'], array('magazine-full', 'magazine-grid-full'))
            && !is_single() && !is_archive()) {
        $classes[] = 'mag-full';
    }

	if (in_array($swift_design_options['blog_or_mag_archives'], array('magazine-full', 'magazine-grid-full'))
	    && !is_single() && is_archive()) {
		$classes[] = 'mag-full';
	}

	return $classes;
}