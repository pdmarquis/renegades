<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package zenzero
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<div class="comments-title"><h2>
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'zenzero' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2></div>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => '60',
					'reply_text'        =>  '<span>' .esc_html__( 'Reply'  , 'zenzero' ) . '<i class="fa fa-reply spaceLeft"></i></span>',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'zenzero' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link ( '<i class="fa fa-angle-left"></i>' ); ?></div>
			<div class="nav-next"><?php next_comments_link ( '<i class="fa fa-angle-right"></i>' ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>
		
		<div class="betweenPost"></div>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'zenzero' ); ?></p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Name *'  , 'zenzero' ) . '"/></p>',
		'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Email *'  , 'zenzero' ) . '"/></p>',
		'url'    => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website'  , 'zenzero' ) . '"/></p>',
	);
	$required_text = __(' Required fields are marked ', 'zenzero').' <span class="required">*</span>';
	?>
	<?php comment_form( array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'zenzero' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  , 'zenzero' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes smallPart">' . __( 'Your email address will not be published.'  , 'zenzero' ) . ( $req ? $required_text : '' ) . '</p>',
		'title_reply' => __( 'Leave a Reply'  , 'zenzero' ),
		'title_reply_to' => __( 'Leave a Reply to %s'  , 'zenzero' ),
		'cancel_reply_link' => __( 'Cancel reply'  , 'zenzero' ) . '<i class="fa fa-times spaceLeft"></i>',
		'label_submit' => __( 'Post Comment'  , 'zenzero' ),
		'comment_field' => '<div class="clear"></div><p class="comment-form-comment"><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Comment *'  , 'zenzero' ) . '"></textarea></p>',
	)); 
	?>

</div><!-- #comments -->
