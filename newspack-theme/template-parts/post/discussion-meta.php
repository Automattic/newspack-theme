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
	$meta_label = apply_filters(
		'newspack_number_comments',
		sprintf(
			/* translators: %1(X comments)$s */
			_n( '%d Comment', '%d Comments', $discussion->responses, 'newspack' ),
			$discussion->responses
		)
	);
} else {
	$meta_label = esc_html( apply_filters( 'newspack_no_comments', __( 'No comments', 'newspack' ) ) );
}
?>

<div class="discussion-meta">
	<p class="discussion-meta-info">
		<?php echo wp_kses( newspack_get_icon_svg( 'comment', 24 ), newspack_sanitize_svgs() ); ?>
		<span><?php echo esc_html( $meta_label ); ?></span>
	</p>
</div><!-- .discussion-meta -->
