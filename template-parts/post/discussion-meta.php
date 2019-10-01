<?php
/**
 * The template for displaying Current Discussion on posts
 *
 * @package Newspack
 */

/* Get data from current discussion on post. */
$discussion    = newspack_get_discussion_data();
$has_responses = $discussion->responses > 0;

if ( $has_responses ) {
	/* translators: %1(X comments)$s */
	$meta_label = sprintf( _n( '%d Comment', '%d Comments', $discussion->responses, 'newspack' ), $discussion->responses );

	if ( function_exists('\Rename_Comments\get_text') ) {
		$rc_name = ( $discussion->responses > 1 )
			? \Rename_Comments\get_text('rc_comments_name_plural')
			: \Rename_Comments\get_text('rc_comments_name');
		$meta_label = sprintf( '%d %s', $discussion->responses, $rc_name );
	}
} else {
	$meta_label = __( 'No comments', 'newspack' );

	if ( function_exists('\Rename_Comments\get_text') ) {
		$meta_label = sprintf( esc_html__( 'No %s', 'newspack' ), \Rename_Comments\get_text('rc_comments_name_plural') );
	}
}
?>

<div class="discussion-meta">
	<p class="discussion-meta-info">
		<?php echo newspack_get_icon_svg( 'comment', 24 ); ?>
		<span><?php echo esc_html( $meta_label ); ?></span>
	</p>
</div><!-- .discussion-meta -->
