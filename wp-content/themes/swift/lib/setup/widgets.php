<?php

/**
 * Affiliate Widget
 *
 * @since 6.2.4
 */
class Swift_Widget_Affiliate extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_affiliate widget_text_nopadding',
			'description' => __( 'Displays random affiliate banners', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-affiliate-widget', __( 'Swift Affiliates Widget', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$widths = get_option( 'swift_dimensions' );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		} ?>
		<div class="textwidget">
			<?php
			$width = $widths[ $args['id'] ];
			if ( 300 <= $width ) {
				echo $this->banner( get_template_directory() . '/lib/banners/400/' );
			} elseif ( ( 150 < $width ) && ( $width < 300 ) ) {
				echo $this->banner( get_template_directory() . '/lib/banners/260/' );
			} elseif ( $width <= 150 ) {
				echo $this->banner( get_template_directory() . '/lib/banners/125/' );
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}

	function banner( $path ) {
		GLOBAL $swift_options;
		$images = glob( $path . '*@2x.{jpg,jpeg,png,gif}', GLOB_BRACE );
		$image  = $images[ array_rand( $images ) ];
		$image  = preg_replace( '(@2x)', '', $image );
		$image  = preg_replace( '(' . get_template_directory() . ')', get_template_directory_uri(), $image );

		return '<a href="http://swiftthemes.com/swiftlers-area/go.php?r=' . $swift_options['affiliate_id'] . '" title="Downlaod Swift today and make your WordPress faster" rel="nofollow" ><img src="' . $image . '" alt="Download Swift" /></a>';
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );
		?>
		<h4>
			<?php _e( 'Set your affiliate id at Swift Options -> Ad Management. If you dont have an affiliate id signup', 'swift' ) ?>
			<a href="http://swiftthemes.com/swiftlers-area/aff/signup"><?php _e( 'here', 'swift' ) ?>
			</a>
		</h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

	<?php
	}
}

class Swift_Page_Specific_Ads_Widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_page_ads widget_text_nopadding',
			'description' => __( 'Displays page specific ads and content whenever available', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-page-specific-ads-widget', __( 'Swift Page Specific Ads Widget', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$widths = get_option( 'swift_dimensions' );

		global $swift_is_mobile;
		$swift_post_meta = get_post_meta( get_the_ID(), '_swift_post_meta', true );

		if ( $swift_is_mobile->isMobile() && ! $swift_is_mobile->isTablet() ) {
			if ( isset( $swift_post_meta['page_ad_m'] ) ) {
				$ad = stripslashes( $swift_post_meta['page_ad_m'] );
			} else {
				return;
			}
		} else {
			if ( isset( $swift_post_meta['page_ad'] ) ) {
				$ad = stripslashes( esc_js( $swift_post_meta['page_ad'] ) );
			} else {
				return;
			}
		}

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		?>
		<div class="textwidget">
			<?php
			echo $ad;
			?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );
		?>
		<h4>
			<?php _e( 'Set your affiliate id at Swift Options -> Ad Management. If you dont have an affiliate id signup', 'swift' ) ?>
			<a href="http://swiftthemes.com/swiftlers-area/aff/signup"><?php _e( 'here', 'swift' ) ?>
			</a>
		</h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

	<?php
	}
}


/**
 * Text widget without padding
 *
 * @since 6.0
 */
class Swift_Widget_Text_No_Styling extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_text_nopadding',
			'description' => __( 'Arbitrary text or HTML', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-text-no-styling', __( 'DEPRECATED: Text without padding and border', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text  = apply_filters( 'widget_text', $instance['text'], $instance );
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		} ?>
		<div class="textwidget">
			<?php echo $instance['filter'] ? wpautop( $text ) : $text; ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset( $new_instance['filter'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );
		?>
		<h4>
			<?php printf( __( '(This widget will be removed after June 1st, functionality of this widget is included in the %sSmart text widget%s.)', 'swift' ), '<strong>', '</strong>' ); ?>
		</h4>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<textarea class="widefat" rows="16" cols="20"
		          id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>"
			       name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"
				<?php checked( isset( $instance['filter'] ) ? $instance['filter'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'swift' ); ?>
			</label>
		</p>
	<?php
	}
}


/**
 * Smart text widget
 *
 * @since 6.0
 */
class Swift_Widget_Smart_Text extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_text_smart',
			'description' => __( 'Smart text widget that allows you to removing padding and hide it when the site is viewed on mobile', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-smart-text', __( 'Smart text widget', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		GLOBAL $swift_is_mobile, $swift_hide_all_ads;
		if ( $instance['hide_on_mobile'] && $swift_is_mobile->isMobile() && ! $swift_is_mobile->isTablet() ) {
			return;
		}
		if ( $instance['hide_on_tablet'] && $swift_is_mobile->isTablet() ) {
			return;
		}
		if ( $instance['hide_on_desktop'] && ! $swift_is_mobile->isMobile() ) {
			return;
		}
		if ( $instance['disable_when_ads_disabled'] && $swift_hide_all_ads ) {
			return;
		}


		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text  = apply_filters( 'widget_text', $instance['text'], $instance );
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		} ?>
		<div
			class="textwidget <?php echo $instance['nopadding'] ? 'nopadding' : ''; ?>">
			<?php echo $instance['filter'] ? wpautop( $text ) : $text; ?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['filter']                    = isset( $new_instance['filter'] );
		$instance['nopadding']                 = isset( $new_instance['nopadding'] );
		$instance['hide_on_mobile']            = isset( $new_instance['hide_on_mobile'] );
		$instance['hide_on_tablet']            = isset( $new_instance['hide_on_tablet'] );
		$instance['hide_on_desktop']           = isset( $new_instance['hide_on_desktop'] );
		$instance['disable_when_ads_disabled'] = isset( $new_instance['disable_when_ads_disabled'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<textarea class="widefat" rows="16" cols="20"
		          id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>"
			       name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"
				<?php checked( isset( $instance['filter'] ) ? $instance['filter'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'swift' ); ?>
			</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'nopadding' ); ?>"
			       name="<?php echo $this->get_field_name( 'nopadding' ); ?>"
			       type="checkbox"
				<?php checked( isset( $instance['nopadding'] ) ? $instance['nopadding'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'nopadding' ); ?>"><?php _e( 'Remove padding and borders', 'swift' ); ?>
			</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'hide_on_mobile' ); ?>"
			       name="<?php echo $this->get_field_name( 'hide_on_mobile' ); ?>"
			       type="checkbox"
				<?php checked( isset( $instance['hide_on_mobile'] ) ? $instance['hide_on_mobile'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'hide_on_mobile' ); ?>"><?php _e( 'Hide this widget when viewed on mobile', 'swift' ); ?>
			</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'hide_on_tablet' ); ?>"
			       name="<?php echo $this->get_field_name( 'hide_on_tablet' ); ?>"
			       type="checkbox"
				<?php checked( isset( $instance['hide_on_tablet'] ) ? $instance['hide_on_tablet'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'hide_on_tablet' ); ?>"><?php _e( 'Hide this widget when viewed on tablets', 'swift' ); ?>
			</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'hide_on_desktop' ); ?>"
			       name="<?php echo $this->get_field_name( 'hide_on_desktop' ); ?>"
			       type="checkbox"
				<?php checked( isset( $instance['hide_on_desktop'] ) ? $instance['hide_on_desktop'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'hide_on_desktop' ); ?>"><?php _e( 'Hide this widget when viewed on desktop', 'swift' ); ?>
			</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'disable_when_ads_disabled' ); ?>"
			       name="<?php echo $this->get_field_name( 'disable_when_ads_disabled' ); ?>"
			       type="checkbox"
				<?php checked( isset( $instance['disable_when_ads_disabled'] ) ? $instance['disable_when_ads_disabled'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'disable_when_ads_disabled' ); ?>"><?php _e( 'Hide this widget when ads on the page are disabled', 'swift' ); ?>
			</label>
		</p>
	<?php
	}
}

/**
 * HomePage only text widget
 *
 * @since 6.0
 */
class Swift_Widget_Text_Home extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_text',
			'description' => __( 'Display text only on the home page', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-text-home', __( 'Homepage only text widget', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		if ( is_home() || is_front_page() ):
			extract( $args );
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$text  = apply_filters( 'widget_text', $instance['text'], $instance );
			echo $before_widget;
			if ( ! empty( $title ) ) {
				echo $before_title . $title . $after_title;
			} ?>
			<div class="textwidget">
				<?php echo $instance['filter'] ? wpautop( $text ) : $text; ?>
			</div>
			<?php
			echo $after_widget;
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset( $new_instance['filter'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<textarea class="widefat" rows="16" cols="20"
		          id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>"
			       name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"
				<?php checked( isset( $instance['filter'] ) ? $instance['filter'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'swift' ); ?>
			</label>
		</p>
	<?php
	}
}

/**
 * Page specific text widget
 *
 * @since 6.0
 */
class Swift_Widget_Text_Page_Specific extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_text',
			'description' => __( 'Display text only on some pages', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-text-page-specific', __( 'Page specific text widget', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		if ( is_page( $instance['pages'] ) ):
			extract( $args );
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$text  = apply_filters( 'widget_text', $instance['text'], $instance );
			echo $before_widget;
			if ( ! empty( $title ) ) {
				echo $before_title . $title . $after_title;
			} ?>
			<div class="textwidget">
				<?php echo $instance['filter'] ? wpautop( $text ) : $text; ?>
			</div>
			<?php
			echo $after_widget;
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset( $new_instance['filter'] );

		$instance['pages'] = $new_instance['pages'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'pages' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );

		if ( is_array( $instance['pages'] ) ) {
			foreach ( $instance['pages'] as $selected ) {
				$selected_pages[] = $selected;
			}
		}

		$pages = get_pages();
		?>
		<h4>
			<?php _e( 'Select the pages on which you want this widget to appear', 'swift' ); ?>
		</h4>
		<style>
			ul.swift_multiselect li {
				list-style: none;
				float: left;
				width: 50%
			}

			ul.swift_multiselect .checkbox {
				padding: 5px;
				margin-right: 10px
			}
		</style>
		<ul class="swift_multiselect">
			<?php

			foreach ( $pages as $pagg ) {
				if ( isset( $selected_pages ) && is_array( $selected_pages ) && in_array( $pagg->ID, $selected_pages ) ) {
					$checked = 'checked';
				} else {
					$checked = '';
				}

				$option = '<li><input class="checkbox" name="' . $this->get_field_name( 'pages' ) . '[]" type="checkbox" value="' . $pagg->ID . '" id="p_' . $pagg->ID . '" ' . $checked . '>';
				$option .= '<label for="p_' . $pagg->ID . '">' . $pagg->post_title . '</label>';
				$option .= '</li>';
				echo $option;
			}
			?>
		</ul>
		<div class="clear"></div>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<textarea class="widefat" rows="16" cols="20"
		          id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>"
			       name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"
				<?php checked( isset( $instance['filter'] ) ? $instance['filter'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'swift' ); ?>
			</label>
		</p>
	<?php
	}
}

/**
 * Category specific text widget
 *
 * @since 6.0
 */
class Swift_Widget_Text_Category_Specific extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_text',
			'description' => __( 'Display text only on some categories', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-text-category-specific', __( 'Category specific text widget', 'swift' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		if ( in_category( $instance['cats'] ) ):
			extract( $args );
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$text  = apply_filters( 'widget_text', $instance['text'], $instance );
			echo $before_widget;
			if ( ! empty( $title ) ) {
				echo $before_title . $title . $after_title;
			} ?>
			<div class="textwidget">
				<?php echo $instance['filter'] ? wpautop( $text ) : $text; ?>
			</div>
			<?php
			echo $after_widget;
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset( $new_instance['filter'] );

		$instance['cats'] = $new_instance['cats'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'cats' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$text     = esc_textarea( $instance['text'] );

		if ( is_array( $instance['cats'] ) ) {
			foreach ( $instance['cats'] as $selected ) {
				$selected_cats[] = $selected;
			}
		}

		$cats = get_categories();
		?>
		<h4>
			<?php _e( 'Select the pages on which you want this widget to appear', 'swift' ); ?>
		</h4>
		<style>
			ul.swift_multiselect_cat li {
				list-style: none;
				float: left;
				width: 33%
			}

			ul.swift_multiselect_cat .checkbox {
				padding: 5px;
				margin-right: 10px
			}
		</style>
		<ul class="swift_multiselect_cat">
			<?php

			foreach ( $cats as $cat ) {
				if ( isset( $selected_cats ) && is_array( $selected_cats ) && in_array( $cat->cat_ID, $selected_cats ) ) {
					$checked = 'checked';
				} else {
					$checked = '';
				}

				$option = '<li><input class="checkbox" name="' . $this->get_field_name( 'cats' ) . '[]" type="checkbox" value="' . $cat->cat_ID . '" id="c_' . $cat->cat_ID . '" ' . $checked . '>';
				$option .= '<label for="p_' . $cat->cat_ID . '">' . $cat->name . '</label>';
				$option .= '</li>';
				echo $option;
			}
			?>
		</ul>
		<div class="clear"></div>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title' ); ?>"
			                name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			                value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<textarea class="widefat" rows="16" cols="20"
		          id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>

		<p>
			<input id="<?php echo $this->get_field_id( 'filter' ); ?>"
			       name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"
				<?php checked( isset( $instance['filter'] ) ? $instance['filter'] : 0 ); ?> />&nbsp;<label
				for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'swift' ); ?>
			</label>
		</p>
	<?php
	}
}

/**
 * Swift_Popular_Posts widget class
 *
 * @since 6.0
 */
class Swift_Popular_Posts extends WP_Widget {

	public $age;

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_popular_entries',
			'description' => __( 'The most popular posts on your site', 'swift' )
		);
		parent::__construct( 'swift-popular-posts', __( 'Popular posts', 'swift' ), $widget_ops );
		$this->alt_option_name = 'widget_popular_entries';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_popular_posts', 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Popular Posts', 'swift' ) : $instance['title'], $instance, $this->id_base );
		if ( ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}

		if ( ! $this->age = absint( $instance['age'] ) ) {
			$this->age = 90;
		}

		if ( ! $images = (bool) $instance['images'] ) {
			$images = false;
		}

		if ( ! $show_date = (bool) $instance['show_date'] ) {
			$show_date = false;
		}

		if ( ! $show_author_name = (bool) $instance['show_author_name'] ) {
			$show_author_name = false;
		}


		add_filter( 'posts_where', array( &$this, 'query_where' ) );

		$r = new WP_Query( array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'orderby'             => 'comment_count',
			'order'               => 'DESC'
		) );

		remove_filter( 'posts_where', array( &$this, 'query_where' ) );

		if ( $r->have_posts() ) :
			?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) {
			echo $before_title . $title . $after_title;
		} ?>
			<ul class="thumb-list">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li class="clearfix"><?php
						if ( $images ) {
							the_post_thumbnail( array( 36, 36 ), array( 'class' => 'alignleft thumb' ) );
						}
						?> <a href="<?php the_permalink() ?>"
					          title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) {
								the_title();
							} else {
								the_ID();
							} ?>
						</a> <br/> <span class="meta"> <?php if ( $show_date ): ?> <?php _e( 'on', 'swift' ) ?>
								<a href="<?php echo esc_url( get_permalink() ) ?>"
								   title="<?php echo esc_attr( get_the_time() ) ?>" rel="bookmark">
									<time
										class="entry-date"
										datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
										<?php echo esc_html( get_the_date() ) ?>
									</time>
								</a> <?php endif ?> <?php if ( $show_author_name ): ?> <?php _e( 'by', 'swift' ) ?>
								<a
									href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_attr( get_the_author() ) ?>
								</a> <?php endif; ?>
    </span>

						<div class="clear"></div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $after_widget; ?>
<?php
// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;
		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_popular_posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance                     = $old_instance;
		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['number']           = (int) $new_instance['number'];
		$instance['images']           = (bool) $new_instance['images'];
		$instance['show_author_name'] = (bool) $new_instance['show_author_name'];
		$instance['show_date']        = (bool) $new_instance['show_date'];
		$instance['age']              = (int) $new_instance['age'];

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_popular_entries'] ) ) {
			delete_option( 'widget_popular_entries' );
		}

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_popular_posts', 'widget' );
	}

	function query_where( $where = '' ) {
		$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-' . $this->age . ' days' ) ) . "'";

		return $where;
	}

	function form( $instance ) {
		$title            = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number           = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$images           = isset( $instance['images'] ) ? (bool) ( $instance['images'] ) : true;
		$show_author_name = isset( $instance['show_author_name'] ) ? (bool) ( $instance['show_author_name'] ) : true;
		$show_date        = isset( $instance['show_date'] ) ? (bool) ( $instance['show_date'] ) : true;
		$age              = isset( $instance['age'] ) ? absint( $instance['age'] ) : 30;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'title', 'swift' ); ?>"
			                type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'number' ); ?>"
			                name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
			                value="<?php echo $number; ?>" size="3"/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'age' ); ?>"><?php _e( 'Show posts from last "n" days:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'age' ); ?>"
			                name="<?php echo $this->get_field_name( 'age' ); ?>" type="text"
			                value="<?php echo $age; ?>" size="3"/>
		</p>
		<p>
			<i><label
					for="<?php echo $this->get_field_id( 'age' ); ?>"><?php _e( 'Enter the value of "n" above', 'swift' ); ?>
				</label> </i>
		</p>
		<br/>
		<input
			class="checkbox" type="checkbox" <?php checked( $images, true ) ?>
			id="<?php echo $this->get_field_id( 'images' ); ?>"
			name="<?php echo $this->get_field_name( 'images' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'images' ); ?>"><?php _e( 'Show thumbnail', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox" <?php checked( $show_date, true ) ?>
			id="<?php echo $this->get_field_id( 'show_date' ); ?>"
			name="<?php echo $this->get_field_name( 'show_date' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox"
			<?php checked( $show_author_name, true ) ?>
			id="<?php echo $this->get_field_id( 'show_author_name' ); ?>"
			name="<?php echo $this->get_field_name( 'show_author_name' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_author_name' ); ?>"><?php _e( 'Show author name', 'swift' ); ?>
		</label>
		<br/>
	<?php
	}
}

/**
 * Swift_Random_Posts widget class
 *
 * @since 2.8.0
 */
class Swift_Random_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_random_posts',
			'description' => __( 'Random posts from your site', 'swift' )
		);
		parent::__construct( 'swift-random-posts', __( 'Random posts', 'swift' ), $widget_ops );
		$this->alt_option_name = 'widget_random_entries';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_random_posts', 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Random Posts', 'swift' ) : $instance['title'], $instance, $this->id_base );
		if ( ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}

		if ( ! $images = (bool) $instance['images'] ) {
			$images = false;
		}

		if ( ! $show_date = (bool) $instance['show_date'] ) {
			$show_date = false;
		}

		if ( ! $show_author_name = (bool) $instance['show_author_name'] ) {
			$show_author_name = false;
		}

		if ( ! $show_button = (bool) $instance['show_button'] ) {
			$show_button = false;
		}

		if ( isset( $instance['button_text'] ) && $instance['button_text'] != '' ) {
			$button_text = strip_tags( $instance['button_text'] );
		} else {
			$button_text = 'Random post';
		}


		$r = new WP_Query( array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'orderby'             => 'rand'
		) );
		if ( $r->have_posts() ) :
			?>
			<?php echo $before_widget; ?>
			<?php if ( $show_button ) {
			$button = '<a href="' . home_url() . '/?random=1" class="alignright btn btn-small btn-primary"><span>' . $button_text . '</span></a>';
		} else {
			$button = '';
		}
			?>
			<?php if ( $title ) {
			echo $before_title . $title . $button . $after_title;
		} ?>
			<ul class="thumb-list">
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li><?php
						if ( $images ) {
							the_post_thumbnail( array( 36, 36 ), array( 'class' => 'alignleft thumb' ) );
						}
						?> <a href="<?php the_permalink() ?>"
					          title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) {
								the_title();
							} else {
								the_ID();
							} ?>
						</a> <br/> <span class="meta"> <?php if ( $show_date ): ?> <?php _e( 'on', 'swift' ) ?>
								<a href="<?php echo esc_url( get_permalink() ) ?>"
								   title="<?php echo esc_attr( get_the_time() ) ?>" rel="bookmark">
									<time
										class="entry-date"
										datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
										<?php echo esc_html( get_the_date() ) ?>
									</time>
								</a> <?php endif ?> <?php if ( $show_author_name ): ?> <?php _e( 'by', 'swift' ) ?>
								<a
									href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_attr( get_the_author() ) ?>
								</a> <?php endif; ?>
    </span>

						<div class="clear"></div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $after_widget; ?>
<?php
// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance                     = $old_instance;
		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['number']           = (int) $new_instance['number'];
		$instance['images']           = (bool) $new_instance['images'];
		$instance['show_author_name'] = (bool) $new_instance['show_author_name'];
		$instance['show_date']        = (bool) $new_instance['show_date'];
		$instance['show_button']      = (bool) $new_instance['show_button'];
		$instance['button_text']      = strip_tags( $new_instance['button_text'] );
		$instance['images']           = (bool) $new_instance['images'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_random_entries'] ) ) {
			delete_option( 'widget_random_entries' );
		}

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_random_posts', 'widget' );
	}

	function form( $instance ) {
		$title            = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number           = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$images           = isset( $instance['images'] ) ? (bool) ( $instance['images'] ) : true;
		$show_author_name = isset( $instance['show_author_name'] ) ? (bool) ( $instance['show_author_name'] ) : true;
		$show_date        = isset( $instance['show_date'] ) ? (bool) ( $instance['show_date'] ) : true;
		$show_button      = isset( $instance['show_button'] ) ? (bool) ( $instance['show_button'] ) : true;
		$button_text      = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'title', 'swift' ); ?>"
			                type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'number' ); ?>"
			                name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
			                value="<?php echo $number; ?>" size="3"/>
		</p>

		<input
			class="checkbox" type="checkbox" <?php checked( $images, true ) ?>
			id="<?php echo $this->get_field_id( 'images' ); ?>"
			name="<?php echo $this->get_field_name( 'images' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'images' ); ?>"><?php _e( 'Show thumbnail', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox" <?php checked( $show_date, true ) ?>
			id="<?php echo $this->get_field_id( 'show_date' ); ?>"
			name="<?php echo $this->get_field_name( 'show_date' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox"
			<?php checked( $show_author_name, true ) ?>
			id="<?php echo $this->get_field_id( 'show_author_name' ); ?>"
			name="<?php echo $this->get_field_name( 'show_author_name' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_author_name' ); ?>"><?php _e( 'Show author name', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox" <?php checked( $show_button, true ) ?>
			id="<?php echo $this->get_field_id( 'show_button' ); ?>"
			name="<?php echo $this->get_field_name( 'show_button' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_button' ); ?>"><?php _e( 'Show random post button in widget title', 'swift' ); ?>
		</label>
		<br/>
		<br>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'button_text', 'swift' ); ?>"><?php _e( 'Random post button text:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'button_text', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'button_text', 'swift' ); ?>"
			                type="text" value="<?php echo $button_text; ?>"/>
		</p>
	<?php
	}
}

/**
 *
 * Swift_SubscribeBox widget class
 * @author satish
 *
 */
class Swift_Subscribe_Box extends WP_Widget {
	/** constructor */
	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_subscribe_box',
			'description' => __( 'RSS Subscribe widget', 'swift' )
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-subscribe-box', __( 'RSS Subscribe widget', 'swift' ), $widget_ops, $control_ops );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		GLOBAL $swift_options, $swift_design_options;
		$feedId = $swift_options['feedburnerid'];
		?>
		<?php echo $before_widget; ?>
		<div class="subscribe-box">
			<h3 class="alignleft">
				<?php _e( 'Subscribe', 'swift' ); ?>
			</h3>
			<a href="https://feeds.feedburner.com/<?php echo $feedId ?>"
			   title="<?php _e( 'Subscribe to our RSS feed', 'swift' ); ?>"> <img
					src="https://feeds.feedburner.com/~fc/<?php echo $feedId ?>?bg=055da0<?php //echo $swift_design_options['chicklet_bg'];?>&amp;fg=FFFFFF<?php //echo $swift_design_options['chicklet'];?>&amp;anim=0"
					class="chicklet alignright"
					alt="<?php _e( 'Feedburner counter', 'swift' ); ?>"/>
			</a>

			<div class="clear"></div>
			<form action="https://feedburner.google.com/fb/a/mailverify"
			      method="post" target="popupwindow"
			      onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedId ?>', 'popupwindow', 'scrollbars=yes, width=550,height=520 ');return true">
				<input name="email"
				       value="<?php _e( 'Enter your e-mail address', 'swift' ); ?>"
				       onfocus="if (this.value == '<?php _e( 'Enter your e-mail address', 'swift' ); ?>') {this.value = '';}"
				       onblur="if (this.value == '') {this.value = '<?php _e( 'Enter your e-mail address', 'swift' ); ?>';}"
				       type="text" class="alignleft"/> <input value="<?php echo $feedId ?>"
				                                              name="uri" type="hidden"/> <input name="loc" value="en_US"
				                                                                                type="hidden"/> <input
					value="<?php _e( 'Subscribe', 'swift' ); ?>"
					type="submit" class="btn btn-primary btn-small alignright"/>
			</form>
			<div class="clear"></div>
		</div>

		<ul class="sm-love clearfix">
			<li class="plus1">
				<!-- Place this tag where you want the +1 button to render -->
				<div class="g-plusone" data-size="medium"
				     data-href="<?php echo $swift_options['sm_gplus']; ?>"></div>
				<!-- Place this render call where appropriate -->
				<script type="text/javascript">
					(function () {
						var po = document.createElement('script');
						po.type = 'text/javascript';
						po.async = true;
						po.src = 'https://apis.google.com/js/plusone.js';
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(po, s);
					})();
				</script>
			</li>
			<li class="fb-like">
				<iframe
					src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F<?php echo $swift_options['sm_fb_page_id']; ?>&amp;send=false&amp;layout=button_count&amp;width=60&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=140172592746809"
					style="border: none; overflow: hidden; width: 100px; height: 21px;"></iframe>
			</li>

			<li class="twitter-follow last"><a
					href="https://twitter.com/<?php echo $swift_options['sm_twitter']; ?>"
					class="twitter-follow-button" data-show-count="true"
					data-show-screen-name="false"><?php printf( __( 'Follow %s', 'swift' ), '@' . $swift_options['sm_twitter'] ); ?>
				</a>
				<script>!function (d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (!d.getElementById(id)) {
							js = d.createElement(s);
							js.id = id;
							js.src = "//platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js, fjs);
						}
					}(document, "script", "twitter-wjs");</script>
			</li>
		</ul>
		<?php echo $after_widget; ?>
	<?php
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		GLOBAL $swift_options;

		echo '<p>';

		if ( ! $swift_options['feedburnerid'] ) {
			echo '<span style="color:#F00">';
			printf( __( 'You should enter your Feedburner ID in %s for this widget to function properly.', 'swift' ), '<em><a href="admin.php?page=swift-options#social-media">' . __( 'Swift Options', 'swift' ) . ' &rarr; ' . __( 'Social media', 'swift' ) . '</a></em>' );
			echo '</span><br />';
		}

		printf( __( 'You can customize the colors of this widget and of the Feedburner chicklet in %s.', 'swift' ), '<em><a href="admin.php?page=swift-design-options#color-options">' . __( 'Design Options', 'swift' ) . ' &rarr; ' . __( 'Color options', 'swift' ) . '</a></em>' );
		echo '</p>';
	}
}

/**
 *
 * Swift_Tabs widget class
 * @author Satish
 *
 */
class Swift_Tabs extends WP_Widget {
	/** constructor */
	function __construct() {
		$widget_ops  = array( 'classname' => 'widget_swift_tabs', 'description' => __( 'Swift tabs widget', 'swift' ) );
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'swift-tabs-widget', __( 'Tabs widget', 'swift' ), $widget_ops, $control_ops );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		?>
		<?php echo $before_widget; ?>
		<div id="tabs-widget"
		     class="shortcode-tabs clearfix default">
			<ul class="tab_titles">
				<li class="nav-tab"><a href="#tab-2"><?php _e( 'Comments', 'swift' ) ?> </a>
				</li>
				<li class="nav-tab"><a href="#tab-1"><?php _e( 'Recent posts', 'swift' ) ?>
					</a></li>
				<li class="nav-tab"><a href="#tab-3"><?php _e( 'Tags', 'swift' ) ?> </a></li>
			</ul>

			<div class="tab">
				<ul>
					<?php
					global $wpdb;
					$comments = $wpdb->get_results( "SELECT * FROM $wpdb->comments WHERE comment_approved = '1'
                                  ORDER BY comment_date_gmt DESC LIMIT 6" );

					if ( $comments ) : foreach ( (array) $comments as $comment ) :
						$author  = wp_kses( $comment->comment_author, '', '' );
						$content = wp_kses( $comment->comment_content, '', '' );
						echo '<li class="clearfix">' . get_avatar( $comment, $size = '32' ) . sprintf( _x( '%1$s on %2$s', 'author ON title', 'swift' ), $author, '<a href="' . get_comment_link( $comment->comment_ID ) . '"  title="' . $content . '">' . get_the_title( $comment->comment_post_ID ) . '</a>' ) . '<br />
                <span class="meta">
                <time class="entry-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" >' . esc_html( get_the_date() ) . '
                </time></span></li>';
					endforeach; endif;?>
				</ul>
			</div>

			<div class="tab">
				<ul>
					<?php wp_get_archives( 'title_li=&type=postbypost&limit=9' ); ?>
				</ul>
			</div>
			<div class="tab">
				<?php wp_tag_cloud( 'smallest=8&largest=22' ); ?>
			</div>

			<div class="fix"></div>
			<!--/.fix-->

		</div>
		<!--/.tabs-->

		<?php echo $after_widget; ?>
	<?php
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		return null;
	}
}


/**
 * Swift_Post_Showcase widget class
 *
 * @since 7.2.2
 */
class Swift_Post_Showcase extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_showcase_posts nopadding',
			'description' => __( 'Display your content in style', 'swift' )
		);
		parent::__construct( 'swift-posts-showcase', __( 'Smart & awesome posts', 'swift' ), $widget_ops );
		$this->alt_option_name = 'widget_showcase_posts';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function query_where( $where = '' ) {
		$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-' . $this->age . ' days' ) ) . "'";

		return $where;
	}

	public function widget( $args, $instance ) {
		$cache   = wp_cache_get( 'widget_showcase_posts', 'widget' );

		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_showcase_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();
		extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( ! $number = absint( $instance['number'] ) ) {
			$number = 5;
		}

		if ( ! $show_date = (bool) $instance['show_date'] ) {
			$show_date = false;
		}

		if ( ! $show_author_name = (bool) $instance['show_author_name'] ) {
			$show_author_name = false;
		}

		if ( ! $this->age = absint( $instance['age'] ) ) {
			$this->age = 90;
		}

		if ( !isset($instance['$post_ids']) || ! $post_ids = (bool) $instance['$post_ids'] ) {
			$post_ids = false;
		} else {
			$post_ids = explode( ',', $instance['post_ids'] );
		}

		$cats = isset( $instance['cats'] ) && is_array( $instance['cats'] ) ? $instance['cats'] : array();

		if ( !isset($instance['show_random_button']) || ! $show_random_button = (bool) $instance['show_random_button'] ) {
			$show_random_button = false;
		}
		$random_button_text = ( ! empty( $instance['random_button_text'] ) ) ? $instance['random_button_text'] : __( 'Random posts', 'swift' );

		$which = ( ! empty( $instance['which'] ) ) ? $instance['which'] : 'recent_posts';
		$selected_post_type = ( ! empty( $instance['selected_post_type'] ) ) ? $instance['selected_post_type'] : '';

		$query_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		);

		if($selected_post_type) {
			$query_args['post_type'] = $selected_post_type;
		}

		if  ( $which == 'recent_posts' ) {

		} elseif ( $which == 'random_posts' ) {
			$query_args['orderby'] = 'rand';
		} elseif ( $which == 'popular_posts' ) {
			add_filter( 'posts_where', array( &$this, 'query_where' ) );
			$query_args['orderby'] = 'comment_count';
			$query_args['order']   = 'DESC';
		} elseif ( $post_ids ) {
			$query_args['post__in'] = $post_ids;
		} elseif ( $cats ) {
			$query_args['category__in'] = $cats;
		}

		if ( isset( $instance['desktop_w'] ) && isset( $instance['desktop_h'] ) && $instance['desktop_w'] && $instance['desktop_h']  ) {
			GLOBAL $swift_is_mobile;

			if(!$swift_is_mobile->isMobile() || !isset($instance['tablet_columns']) || !$instance['tablet_columns'] ){
				$size = array($instance['desktop_w'],$instance['desktop_h']);
			}elseif($swift_is_mobile->isTablet()){
				$width = (int)(768/$instance['tablet_columns']);
				$size =array($width, (int)($instance['desktop_h']/$instance['desktop_w']*$width));
			}elseif($swift_is_mobile->isMobile()){
				if(isset($instance['mobile_columns']) && $instance['mobile_columns']){
					$width = (int)(580/$instance['mobile_columns']);
				}else{
					$width = 480;
				}
				$size =array($width, (int)($instance['desktop_h']/$instance['desktop_w']*$width));
			}
		} else {
			GLOBAL $swift_thumbnail_sizes;
			$sb_name = $args['class'];
			$size[0] = $swift_thumbnail_sizes[ $sb_name ];
			if ( $size[0] > 280 ) {
				$size[1] = (int) ( $size[0] / 2.5 );
			} elseif ( $size[0] < 280 && $size[0] > 180 ) {
				$size[1] = (int) ( $size[0] / 1.5 );
			} else {
				$size[1] = $size[0];
			}
		}


			?>
			<style type="text/css">
				<?php
				echo '#'.$args['widget_id'].' li img{width:'.$size[0].'px;height:'.$size[1].'px;}';

				if((isset($instance['tablet_columns']) && $instance['tablet_columns']) || (isset($instance['mobile_columns']) && $instance['mobile_columns'])){
				?>
				@media screen and (min-width:580px) and (max-width: 768px) {
					<?php echo '#'.$args['widget_id']?> li {width:<?php  echo 100/$instance['tablet_columns']?>%}
				}

				@media screen and (max-width: 580px) {
					<?php
					if(isset($instance['mobile_columns']) && $instance['mobile_columns']){
						echo '#'.$args['widget_id'].' li {width:'.(100/$instance['mobile_columns']).'%}';
					}
					?>
				}
				<?php
				}else{
								echo '@media screen and (max-width: 580px) {#'.$args['widget_id'].' li {width:100%;height:auto;}}';

				}
				?>
			</style>


<?php
		$r = new WP_Query( $query_args );
		if ( $r->have_posts() ) :

			echo $before_widget;
			if ( $show_random_button && $instance['which'] == 'random_posts' ) {
				$button = '<a href="' . home_url() . '/?random=1" class="alignright btn btn-small btn-primary"><span>' . $random_button_text . '</span></a>';
			} else {
				$button = '';
			}
			if ( $title ) {
				echo $before_title . $title . $button . $after_title;
			} ?>
			<ul class="image-list">
				<?php while ( $r->have_posts() ) : $r->the_post();
					if ( has_post_thumbnail() ):
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );


						?>
						<li>
							<a href="<?php the_permalink() ?>"
							   title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
							<img data-src="<?php echo $img[0]; ?>"
							     src="<?php echo get_template_directory_uri(); ?>/images/rp-dummy.png"
							     width="<?php echo $img[1]; ?>" height="<?php echo $img[2]; ?>"
							     class="stylish-thumb alignleft"></a>

							<div class="widget-post-title"><a href="<?php the_permalink() ?>"
							                                  title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
									<?php if ( get_the_title() ) {
										the_title();
									} else {
										the_ID();
									} ?>
								</a> <br/> <span class="meta"> <?php if ( $show_date ): ?> <?php _e( 'on', 'swift' ) ?>
										<a href="<?php echo esc_url( get_permalink() ) ?>"
										   title="<?php echo esc_attr( get_the_time() ) ?>" rel="bookmark">
											<time
												class="entry-date"
												datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
												<?php echo esc_html( get_the_date() ) ?>
											</time>
										</a> <?php endif ?> <?php if ( $show_author_name ): ?> <?php _e( 'by', 'swift' ) ?>
										<a
											href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
											<?php echo esc_attr( get_the_author() ) ?>
										</a>
									<?php endif; ?>

    </span>
							</div>

							<div class="clear"></div>
						</li>
					<?php endif;endwhile; ?>
			</ul>
			<?php echo $after_widget; ?>
<?php
// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
			wp_reset_query();
		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_showcase_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance                       = $old_instance;
		$instance['title']              = strip_tags( $new_instance['title'] );
		$instance['number']             = (int) $new_instance['number'];
		$instance['tablet_columns']             = (int) $new_instance['tablet_columns'];
		$instance['mobile_columns']             = (int) $new_instance['mobile_columns'];
		$instance['show_author_name']   = isset( $new_instance['show_author_name'] ) ? (bool) $new_instance['show_author_name'] : false;
		$instance['show_date']          = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['which']              = esc_attr( $new_instance['which'] );
		$instance['selected_post_type']              = esc_attr( $new_instance['selected_post_type'] );
		$instance['cats']               = isset( $new_instance['cats'] ) && is_array( $new_instance['cats'] ) ? $new_instance['cats'] : array();
		if ( isset( $new_instance['desktop_w'] ) && isset( $new_instance['desktop_h'] ) && $new_instance['desktop_w'] && $new_instance['desktop_h']  ) {
			$instance['desktop_w']            = (int) $new_instance['desktop_w'];
			$instance['desktop_h']            = (int) $new_instance['desktop_h'];

		}
		$instance['age']                = (int) $new_instance['age'];
		$instance['post_ids']           = strip_tags( $new_instance['post_ids'] );
		$instance['random_button_text'] = strip_tags( $new_instance['random_button_text'] );
		$instance['show_random_button'] = isset( $new_instance['show_random_button'] ) ? (bool) $new_instance['show_random_button'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_post_showcase'] ) ) {
			delete_option( 'widget_post_showcase' );
		}

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_post_showcase', 'widget' );
	}

	function form( $instance ) {
		$title            = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$post_ids         = isset( $instance['post_ids'] ) ? esc_attr( $instance['post_ids'] ) : '';
		$number           = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$tablet_columns           = isset( $instance['tablet_columns'] ) ? absint( $instance['tablet_columns'] ) : 0;
		$mobile_columns           = isset( $instance['mobile_columns'] ) ? absint( $instance['mobile_columns'] ) : 0;
		$age              = isset( $instance['age'] ) ? absint( $instance['age'] ) : 90;
		$show_author_name = isset( $instance['show_author_name'] ) ? (bool) ( $instance['show_author_name'] ) : true;
		$show_date        = isset( $instance['show_date'] ) ? (bool) ( $instance['show_date'] ) : true;
		$which            = isset( $instance['which'] ) ? esc_attr( $instance['which'] ) : '';
		$selected_post_type            = isset( $instance['selected_post_type'] ) ? esc_attr( $instance['selected_post_type'] ) : '';
		$cats             = isset( $instance['cats'] ) && is_array( $instance['cats'] ) ? $instance['cats'] : array();
		$desktop_w           = isset( $instance['desktop_w'] ) ? absint( $instance['desktop_w'] ) : 0;
		$desktop_h           = isset( $instance['desktop_h'] ) ? absint( $instance['desktop_h'] ) : 0;
		$random_button_text = isset( $instance['random_button_text'] ) ? esc_attr( $instance['random_button_text'] ) : '';
		$show_random_button = isset( $instance['show_random_button'] ) ? (bool) ( $instance['show_random_button'] ) : true;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'title', 'swift' ); ?>"
			                type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'number' ); ?>"
			                name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
			                value="<?php echo $number; ?>" size="3"/>
		</p>



		<input
			class="checkbox" type="checkbox" <?php checked( $show_date, true ) ?>
			id="<?php echo $this->get_field_id( 'show_date' ); ?>"
			name="<?php echo $this->get_field_name( 'show_date' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox"
			<?php checked( $show_author_name, true ) ?>
			id="<?php echo $this->get_field_id( 'show_author_name' ); ?>"
			name="<?php echo $this->get_field_name( 'show_author_name' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_author_name' ); ?>"><?php _e( 'Show author name', 'swift' ); ?>
		</label>
		<br/>



		<p>
			<label
				for="<?php echo $this->get_field_id( 'age' ); ?>"><?php _e( 'If you choose to show popular posts, show posts from last "n" days:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'age' ); ?>"
			                name="<?php echo $this->get_field_name( 'age' ); ?>" type="text"
			                value="<?php echo $age; ?>" size="3"/>
		</p>
		<hr>
		<input
			class="radio" type="radio" <?php checked( $which, 'recent_posts' ) ?>
			id="<?php echo $this->get_field_id( 'recent_posts' ); ?>"
			value="recent_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'recent_posts' ); ?>"><?php _e( 'Show recent posts', 'swift' ); ?>
		</label><br>

		<input
			class="radio" type="radio" <?php checked( $which, 'popular_posts' ) ?>
			id="<?php echo $this->get_field_id( 'popular_posts' ); ?>"
			value="popular_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'popular_posts' ); ?>"><?php _e( 'Show popular posts', 'swift' ); ?>
		</label><br>

		<input
			class="radio" type="radio" <?php checked( $which, 'random_posts' ) ?>
			id="<?php echo $this->get_field_id( 'random_posts' ); ?>"
			value="random_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'random_posts' ); ?>"><?php _e( 'Show random posts', 'swift' ); ?>
		</label><br>

		<input
			class="radio" type="radio" <?php checked( $which, 'category_posts' ) ?>
			id="<?php echo $this->get_field_id( 'category_posts' ); ?>"
			value="category_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'category_posts' ); ?>"><?php _e( 'Or show posts from selected categories.
', 'swift' ); ?>
		</label><br>


		<ul class="swift_multiselect_cat">
			<?php

			if ( is_array( $cats ) ) {
				foreach ( $cats as $selected ) {
					$selected_cats[] = $selected;
				}
			}

			$all_cats = get_categories();

			foreach ( $all_cats as $cat ) {
				if ( isset( $selected_cats ) && is_array( $selected_cats ) && in_array( $cat->cat_ID, $selected_cats ) ) {
					$checked = 'checked';
				} else {
					$checked = '';
				}

				$rand   = rand( 0, 999 );
				$option = '<li><input class="checkbox" name="' . $this->get_field_name( 'cats' ) . '[]" type="checkbox"
                value="' . $cat->cat_ID . '" id="c_' . $rand . $cat->cat_ID . '" ' . $checked . '>';
				$option .= '<label for="c_' . $rand . $cat->cat_ID . '">' . $cat->name . '</label>';
				$option .= '</li>';
				echo $option;
			}
			?>
		</ul>
		<div class="clear"></div>
		<?php
		$post_type_args = array('public'=>true);

		$post_types = get_post_types( $post_type_args, 'names' );

		if(count($post_types)>3):
			?>
			<h3><?php _e('Query by post type','swift')?></h3>
			<input
				class="radio" type="radio" <?php checked( $selected_post_type, 'none' ) ?>
				id="<?php echo $this->get_field_id( 'none' ); ?>"
				value=""
				name="<?php echo $this->get_field_name( 'selected_post_type' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'none' ); ?>">None
			</label><br />
			<?php
			foreach($post_types as $post_type){
				?>
				<input
					class="radio" type="radio" <?php checked( $selected_post_type, $post_type ) ?>
					id="<?php echo $this->get_field_id( $post_type ); ?>"
					value="<?php echo $post_type;?>"
					name="<?php echo $this->get_field_name( 'selected_post_type' ); ?>"/>
				<label
					for="<?php echo $this->get_field_id( $post_type ); ?>"><?php echo $post_type?>
				</label><br />
			<?php
			}
		endif;
		?>
		<hr>
		<h3>Advanced</h3>
		width * height:
		<input style="width: 3em"
		       id="<?php echo $this->get_field_id( 'desktop_w', 'swift' ); ?>"
		       name="<?php echo $this->get_field_name( 'desktop_w', 'swift' ); ?>"
		       type="text" value="<?php echo $desktop_w; ?>"/> *
		<input style="width: 3em"
		       id="<?php echo $this->get_field_id( 'desktop_h' ); ?>"
		       name="<?php echo $this->get_field_name( 'desktop_h' ); ?>"
		       type="text" value="<?php echo $desktop_h; ?>"/>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'post_ids', 'swift' ); ?>"><?php _e( 'Comma separated list of post ids to show (Order of ids is not followed)', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'post_ids' ); ?>"
			                name="<?php echo $this->get_field_name( 'post_ids' ); ?>"
			                type="text" value="<?php echo $post_ids; ?>"/>
		</p>
		<br>
		<hr>
		<br>
		<strong style="color:green"><?php _e('These options are applicable only when showing random posts','swift') ?></strong><br><br>
		<input
			class="checkbox" type="checkbox"
			<?php checked( $show_random_button, true ) ?>
			id="<?php echo $this->get_field_id( 'show_random_button' ); ?>"
			name="<?php echo $this->get_field_name( 'show_random_button' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_random_button' ); ?>"><?php _e( 'Show random button', 'swift' ); ?>
		</label>
		<br/>
		<p>

			<label
				for="<?php echo $this->get_field_id( 'random_button_text', 'swift' ); ?>"><?php _e( 'Random button text', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'random_button_text', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'random_button_text', 'swift' ); ?>"
			                type="text" value="<?php echo $random_button_text; ?>"/>
		</p>
		<strong style="color:green"><?php _e('Following two options are applicable only when using the widget in page builder','swift') ?></strong><br><br>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'tablet_columns' ); ?>"><?php _e( 'Number of columns when the widget is shown on tablets:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'tablet_columns' ); ?>"
			                name="<?php echo $this->get_field_name( 'tablet_columns' ); ?>" type="text"
			                value="<?php echo $tablet_columns; ?>" size="3"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'mobile_columns' ); ?>"><?php _e( 'Number of columns when the widget is shown on mobiles:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'mobile_columns' ); ?>"
			                name="<?php echo $this->get_field_name( 'mobile_columns' ); ?>" type="text"
			                value="<?php echo $mobile_columns; ?>" size="3"/>
		</p>


	<?php
	}
}


/**
 * Swift_Post_Showcase widget class
 *
 * @since 7.2.2
 */
class Swift_Widget_Smart_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_smart_posts',
			'description' => __( 'Display posts in every possible way', 'swift' )
		);
		parent::__construct( 'swift-smart-posts', __( 'Smart posts', 'swift' ), $widget_ops );
		$this->alt_option_name = 'widget_smart_posts';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function query_where( $where = '' ) {
		$where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-' . $this->age . ' days' ) ) . "'";
		return $where;
	}

	public function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_smart_posts', 'widget' );

		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_smart_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();
		extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( ! $number = absint( $instance['number'] ) ) {
			$number = 5;
		}

		if ( ! $show_date = (bool) $instance['show_date'] ) {
			$show_date = false;
		}

		if ( ! $show_author_name = (bool) $instance['show_author_name'] ) {
			$show_author_name = false;
		}

		if ( ! $show_thumbs = (bool) $instance['show_thumbs'] ) {
			$show_thumbs = false;
		}

		if ( ! $show_excerpts = (bool) $instance['show_excerpts'] ) {
			$show_excerpts = false;
		}

		if ( ! $this->age = absint( $instance['age'] ) ) {
			$this->age = 90;
		}

		if ( isset( $instance['$post_ids'] ) && ! $post_ids = (bool) $instance['$post_ids'] ) {
			$post_ids = false;
		} else {
			$post_ids = explode( ',', $instance['post_ids'] );
		}

		$cats = isset( $instance['cats'] ) && is_array( $instance['cats'] ) ? $instance['cats'] : array();

		if ( ! $show_random_button = (bool) $instance['show_random_button'] ) {
			$show_random_button = false;
		}
		$random_button_text = ( ! empty( $instance['$random_button_text'] ) ) ? $instance['$random_button_text'] : __( 'Random posts', 'swift' );

		$which = ( ! empty( $instance['which'] ) ) ? $instance['which'] : 'recent_posts';
		$selected_post_type = ( ! empty( $instance['selected_post_type'] ) ) ? $instance['selected_post_type'] : '';

		$query_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		);


		if($selected_post_type) {
			$query_args['post_type'] = $selected_post_type;
		}
		if ( $which == 'recent_posts' ) {

		} elseif ( $which == 'random_posts' ) {
			$query_args['orderby'] = 'rand';
		} elseif ( $which == 'popular_posts' ) {
			add_filter( 'posts_where', array( &$this, 'query_where' ) );
			$query_args['orderby'] = 'comment_count';
			$query_args['order']   = 'DESC';
		} elseif ( $post_ids ) {
			$query_args['post__in'] = $post_ids;
		} elseif ( $cats ) {
			$query_args['category__in'] = $cats;
		}

		if ( isset( $instance['desktop_w'] ) && isset( $instance['desktop_h'] ) && $instance['desktop_w'] && $instance['desktop_h']  ) {
			$size = array($instance['desktop_w'],$instance['desktop_h']);
		} else {
			$size = array( 36, 36 );
		}

		$r = new WP_Query( $query_args );
		if ( $r->have_posts() ) :

			echo $before_widget;
			if ( $show_random_button && $instance['which'] == 'random_posts' ) {
				$button = '<a href="' . home_url() . '/?random=1" class="alignright btn btn-small btn-primary"><span>' . $random_button_text . '</span></a>';
			} else {
				$button = '';
			}
			if ( $title ) {
				echo $before_title . $title . $button . $after_title;
			} ?>
			<ul class="thumb-list">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li class="clearfix"><?php
			if ( $show_thumbs ) {
				the_post_thumbnail( $size, array( 'class' => 'alignleft thumb' ) );
			}
			?>


			<?php
			if ( $show_excerpts ) {
			?>
				<h4 class="post-title"><a href="<?php the_permalink() ?>"
					          title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) {
					the_title();
				} else {
					the_ID();
				} ?></h4>
						</a>
			<?php
				echo '<p class="excerpt">' . get_the_excerpt() . '</p>';
				}
			else{
				?>
				<a href="<?php the_permalink() ?>"
				   title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) {
						the_title();
					} else {
						the_ID();
					} ?>
				</a> <br/>
				<?php
			}
			?>
						<span class="meta"> <?php if ( $show_date ): ?> <?php _e( 'on', 'swift' ) ?>
								<a href="<?php echo esc_url( get_permalink() ) ?>"
								   title="<?php echo esc_attr( get_the_time() ) ?>" rel="bookmark">
									<time
										class="entry-date"
										datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
										<?php echo esc_html( get_the_date() ) ?>
									</time>
								</a> <?php endif ?> <?php if ( $show_author_name ): ?> <?php _e( 'by', 'swift' ) ?>
								<a
									href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_attr( get_the_author() ) ?>
								</a> <?php endif; ?>
    </span>

						<div class="clear"></div>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $after_widget; ?>
<?php
// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
			wp_reset_query();
		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_smart_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {

		$instance                       = $old_instance;
		$instance['title']              = strip_tags( $new_instance['title'] );
		$instance['number']             = (int) $new_instance['number'];
		$instance['show_author_name']   = isset( $new_instance['show_author_name'] ) ? (bool) $new_instance['show_author_name'] : false;
		$instance['show_thumbs']   = isset( $new_instance['show_thumbs'] ) ? (bool) $new_instance['show_thumbs'] : false;
		$instance['show_excerpts']   = isset( $new_instance['show_excerpts'] ) ? (bool) $new_instance['show_excerpts'] : false;
		$instance['show_date']          = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['which']              = esc_attr( $new_instance['which'] );
		$instance['selected_post_type']              = esc_attr( $new_instance['selected_post_type'] );
		$instance['cats']               = isset( $new_instance['cats'] ) && is_array( $new_instance['cats'] ) ? $new_instance['cats'] : array();

		if(isset($instance['desktop_w']) && isset($instance['desktop_h'])){
			$instance['desktop_w']            = (int) $new_instance['desktop_w'];
			$instance['desktop_h']            = (int) $new_instance['desktop_h'];

		}else{
			$instance['desktop_w']            = 36;
			$instance['desktop_h']            = 36;
		}
		$instance['age']                = (int) $new_instance['age'];
		$instance['post_ids']           = strip_tags( $new_instance['post_ids'] );
		$instance['random_button_text'] = strip_tags( $new_instance['random_button_text'] );
		$instance['show_random_button'] = isset( $new_instance['show_random_button'] ) ? (bool) $new_instance['show_random_button'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_smart_posts'] ) ) {
			delete_option( 'widget_smart_posts' );
		}

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_smart_posts', 'widget' );
	}

	function form( $instance ) {
		$title            = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$post_ids         = isset( $instance['post_ids'] ) ? esc_attr( $instance['post_ids'] ) : '';
		$number           = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$age              = isset( $instance['age'] ) ? absint( $instance['age'] ) : 90;
		$show_author_name = isset( $instance['show_author_name'] ) ? (bool) ( $instance['show_author_name'] ) : true;
		$show_thumbs = isset( $instance['show_thumbs'] ) ? (bool) ( $instance['show_thumbs'] ) : true;
		$show_excerpts = isset( $instance['show_excerpts'] ) ? (bool) ( $instance['show_excerpts'] ) : true;
		$show_date        = isset( $instance['show_date'] ) ? (bool) ( $instance['show_date'] ) : true;
		$which            = isset( $instance['which'] ) ? esc_attr( $instance['which'] ) : '';
		$selected_post_type = isset( $instance['selected_post_type'] ) ? esc_attr( $instance['selected_post_type'] ) : '';
		$cats             = isset( $instance['cats'] ) && is_array( $instance['cats'] ) ? $instance['cats'] : array();
		$desktop_w           = isset( $instance['desktop_w'] ) ? absint( $instance['desktop_w'] ) : NULL;
		$desktop_h           = isset( $instance['desktop_h'] ) ? absint( $instance['desktop_h'] ) : NULL;
		$random_button_text = isset( $instance['random_button_text'] ) ? esc_attr( $instance['random_button_text'] ) : '';
		$show_random_button = isset( $instance['show_random_button'] ) ? (bool) ( $instance['show_random_button'] ) : true;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"><?php _e( 'Title:', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'title', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'title', 'swift' ); ?>"
			                type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'number' ); ?>"
			                name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
			                value="<?php echo $number; ?>" size="3"/>
		</p>


		<input
			class="checkbox" type="checkbox" <?php checked( $show_thumbs, true ) ?>
			id="<?php echo $this->get_field_id( 'show_thumbs' ); ?>"
			name="<?php echo $this->get_field_name( 'show_thumbs' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'show_thumbs' ); ?>"><?php _e( 'Show thumbnails(You can set the dimensions below).', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox" <?php checked( $show_excerpts, true ) ?>
			id="<?php echo $this->get_field_id( 'show_excerpts' ); ?>"
			name="<?php echo $this->get_field_name( 'show_excerpts' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'show_excerpts' ); ?>"><?php _e( 'Show excerpts.', 'swift' ); ?>
		</label>
		<br/>


		<input
			class="checkbox" type="checkbox" <?php checked( $show_date, true ) ?>
			id="<?php echo $this->get_field_id( 'show_date' ); ?>"
			name="<?php echo $this->get_field_name( 'show_date' ); ?>"/>
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'swift' ); ?>
		</label>
		<br/>

		<input
			class="checkbox" type="checkbox"
			<?php checked( $show_author_name, true ) ?>
			id="<?php echo $this->get_field_id( 'show_author_name' ); ?>"
			name="<?php echo $this->get_field_name( 'show_author_name' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_author_name' ); ?>"><?php _e( 'Show author name', 'swift' ); ?>
		</label>
		<br/>



		<p>
			<label
				for="<?php echo $this->get_field_id( 'age' ); ?>"><?php _e( 'If you choose to show popular posts, show posts from last "n" days:', 'swift' ); ?>
			</label> <input id="<?php echo $this->get_field_id( 'age' ); ?>"
			                name="<?php echo $this->get_field_name( 'age' ); ?>" type="text"
			                value="<?php echo $age; ?>" size="3"/>
		</p>
		<hr>
		<input
			class="radio" type="radio" <?php checked( $which, 'recent_posts' ) ?>
			id="<?php echo $this->get_field_id( 'recent_posts' ); ?>"
			value="recent_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'recent_posts' ); ?>"><?php _e( 'Show recent posts', 'swift' ); ?>
		</label><br>

		<input
			class="radio" type="radio" <?php checked( $which, 'popular_posts' ) ?>
			id="<?php echo $this->get_field_id( 'popular_posts' ); ?>"
			value="popular_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'popular_posts' ); ?>"><?php _e( 'Show popular posts', 'swift' ); ?>
		</label><br>

		<input
			class="radio" type="radio" <?php checked( $which, 'random_posts' ) ?>
			id="<?php echo $this->get_field_id( 'random_posts' ); ?>"
			value="random_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'random_posts' ); ?>"><?php _e( 'Show random posts', 'swift' ); ?>
		</label><br>

		<input
			class="radio" type="radio" <?php checked( $which, 'category_posts' ) ?>
			id="<?php echo $this->get_field_id( 'category_posts' ); ?>"
			value="category_posts"
			name="<?php echo $this->get_field_name( 'which' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'category_posts' ); ?>"><?php _e( 'Or show posts from selected categories.
', 'swift' ); ?>
		</label><br>


		<ul class="swift_multiselect_cat">
			<?php

			if ( is_array( $cats ) ) {
				foreach ( $cats as $selected ) {
					$selected_cats[] = $selected;
				}
			}

			$all_cats = get_categories();

			foreach ( $all_cats as $cat ) {
				if ( isset( $selected_cats ) && is_array( $selected_cats ) && in_array( $cat->cat_ID, $selected_cats ) ) {
					$checked = 'checked';
				} else {
					$checked = '';
				}

				$rand   = rand( 0, 999 );
				$option = '<li><input class="checkbox" name="' . $this->get_field_name( 'cats' ) . '[]" type="checkbox"
                value="' . $cat->cat_ID . '" id="c_' . $rand . $cat->cat_ID . '" ' . $checked . '>';
				$option .= '<label for="c_' . $rand . $cat->cat_ID . '">' . $cat->name . '</label>';
				$option .= '</li>';
				echo $option;
			}
			?>
		</ul>
		<div class="clear"></div>

		<?php
		$post_type_args = array('public'=>true);

		$post_types = get_post_types( $post_type_args, 'names' );

		if(count($post_types)>3):
			?>
			<h3><?php _e('Query by post type','swift')?></h3>
			<input
				class="radio" type="radio" <?php checked( $selected_post_type, 'none' ) ?>
				id="<?php echo $this->get_field_id( 'none' ); ?>"
				value=""
				name="<?php echo $this->get_field_name( 'selected_post_type' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'none' ); ?>">None
			</label><br />
			<?php
		foreach($post_types as $post_type){
			?>
			<input
				class="radio" type="radio" <?php checked( $selected_post_type, $post_type ) ?>
				id="<?php echo $this->get_field_id( $post_type ); ?>"
				value="<?php echo $post_type;?>"
				name="<?php echo $this->get_field_name( 'selected_post_type' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( $post_type ); ?>"><?php echo $post_type?>
			</label><br />
			<?php
		}
		endif;
		?>
		<hr>
		<h3>Advanced</h3>
		width * height:
		<input style="width: 3em"
		       id="<?php echo $this->get_field_id( 'desktop_w', 'swift' ); ?>"
		       name="<?php echo $this->get_field_name( 'desktop_w', 'swift' ); ?>"
		       type="text" value="<?php echo $desktop_w; ?>"/> *
		<input style="width: 3em"
		       id="<?php echo $this->get_field_id( 'desktop_h', 'swift' ); ?>"
		       name="<?php echo $this->get_field_name( 'desktop_h', 'swift' ); ?>"
		       type="text" value="<?php echo $desktop_h; ?>"/>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'post_ids', 'swift' ); ?>"><?php _e( 'Comma separated list of post ids to show (Order of ids is not followed)', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'post_ids', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'post_ids', 'swift' ); ?>"
			                type="text" value="<?php echo $post_ids; ?>"/>
		</p>
		<br>
		<hr>
		<br>
		<strong style="color:green"><?php _e('These options are applicable only when showing random posts','swift') ?></strong><br><br>
		<input
			class="checkbox" type="checkbox"
			<?php checked( $show_random_button, true ) ?>
			id="<?php echo $this->get_field_id( 'show_random_button' ); ?>"
			name="<?php echo $this->get_field_name( 'show_random_button' ); ?>"/>
		<label
			for="<?php echo $this->get_field_id( 'show_random_button' ); ?>"><?php _e( 'Show random button', 'swift' ); ?>
		</label>
		<br/>
		<p>

			<label
				for="<?php echo $this->get_field_id( 'random_button_text', 'swift' ); ?>"><?php _e( 'Random button text', 'swift' ); ?>
			</label> <input class="widefat"
			                id="<?php echo $this->get_field_id( 'random_button_text', 'swift' ); ?>"
			                name="<?php echo $this->get_field_name( 'random_button_text', 'swift' ); ?>"
			                type="text" value="<?php echo $random_button_text; ?>"/>
		</p>

	<?php
	}
}

/**
 * Register all of the default Swift widgets on startup.
 *
 * Calls 'widgets_init' action after all of the Swift widgets have been
 * registered.
 *
 * @since 6.0
 */
function swift_widgets_init() {
	if ( ! is_blog_installed() ) {
		return;
	}

	//register_widget( 'Swift_Widget_Text_No_Styling' );
	register_widget( 'Swift_Widget_Text_Home' );
	register_widget( 'Swift_Widget_Smart_Text' );
	register_widget( 'Swift_Widget_Text_Page_Specific' );
	register_widget( 'Swift_Widget_Text_Category_Specific' );
	register_widget( 'Swift_Widget_Affiliate' );
	register_widget( 'Swift_Popular_Posts' );
	register_widget( 'Swift_Random_Posts' );
	register_widget( 'Swift_Subscribe_Box' );
	register_widget( 'Swift_Tabs' );
	register_widget( 'Swift_Page_Specific_Ads_Widget' );
	//register_widget( 'Swift_Post_Showcase' );
	//register_widget( 'Swift_Widget_Smart_Posts' );

}

add_action( 'widgets_init', 'swift_widgets_init', 1 );

