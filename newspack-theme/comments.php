<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newspack
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

$discussion = newspack_get_discussion_data();
$collapse_comments = get_theme_mod( 'collapse_comments', false );
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
	<div class="<?php echo $discussion->responses > 0 ? 'comments-title-wrap' : 'comments-title-wrap no-responses'; ?>">
		<h2 class="comments-title">
		<?php
		if ( comments_open() ) {
			if ( have_comments() ) {
				echo esc_html( apply_filters( 'newspack_comment_section_title_nocomments', __( 'Join the Conversation', 'newspack' ) ) );
			} else {
				echo esc_html( apply_filters( 'newspack_comment_section_title', __( 'Leave a comment', 'newspack' ) ) );
			}
		} else {
			if ( '1' == $discussion->responses ) {
				/* translators: %s: post title */
				printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'newspack' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s reply on &ldquo;%2$s&rdquo;',
						'%1$s replies on &ldquo;%2$s&rdquo;',
						$discussion->responses,
						'comments title',
						'newspack'
					),
					number_format_i18n( $discussion->responses ),
					get_the_title()
				);
			}
		}
		?>
		</h2><!-- .comments-title -->
		<?php
			// Only show discussion meta information when comments are open and available.
		if ( have_comments() && comments_open() ) {
			get_template_part( 'template-parts/post/discussion', 'meta' );
		}
		?>
	</div><!-- .comments-title-flex -->
	<?php
	if ( have_comments() ) :

		// Show comment form at top if showing newest comments at the top.
		if ( comments_open() ) {
			newspack_comment_form( 'desc' );
		}
		?>

		<?php if ( $collapse_comments && 1 < (int) $discussion->responses ) : ?>
			<div id="comments-wrapper" class="comments-wrapper comments-hide" [class]="showComments ? 'comments-wrapper' : 'comments-wrapper comments-hide'">
		<?php endif; ?>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'walker'      => new newspack_Walker_Comment(),
						'avatar_size' => newspack_get_avatar_size(),
						'short_ping'  => true,
						'style'       => 'ol',
					)
				);
				?>
			</ol><!-- .comment-list -->
			<?php

			// Show comment navigation
			if ( have_comments() ) :
				$prev_icon     = newspack_get_icon_svg( 'chevron_left', 22 );
				$next_icon     = newspack_get_icon_svg( 'chevron_right', 22 );
				$comments_text = apply_filters( 'newspack_comments_name_plural', __( 'Comments', 'newspack' ) );
				the_comments_navigation(
					array(
						'prev_text' => sprintf( '%s <span class="nav-prev-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span>', $prev_icon, __( 'Previous', 'newspack' ), $comments_text ),
						'next_text' => sprintf( '<span class="nav-next-text"><span class="primary-text">%s</span> <span class="secondary-text">%s</span></span> %s', __( 'Next', 'newspack' ), $comments_text, $next_icon ),
					)
				);
			endif;
			?>

		<?php if ( $collapse_comments && 1 < (int) $discussion->responses ) : ?>
			</div><!-- .comments-wrapper -->
			<button class="comments-toggle" id="comments-toggle" on="tap:AMP.setState({showComments: !showComments})">
				<?php echo wp_kses( newspack_get_icon_svg( 'chevron_left', 24 ), newspack_sanitize_svgs() ); ?><span [text]="showComments ? '<?php esc_html_e( 'Collapse comments', 'newspack' ); ?>' : '<?php esc_html_e( 'Expand comments', 'newspack' ); ?>'"><?php esc_html_e( 'Expand comments', 'newspack' ); ?></span>
			</button>
		<?php endif; ?>

		<?php
		// Show comment form at bottom if showing newest comments at the bottom.
		if ( comments_open() && 'asc' === strtolower( get_option( 'comment_order', 'asc' ) ) ) :
			$leave_comment_text = apply_filters( 'newspack_comments_leave_comment', __( 'Leave a comment', 'newspack' ) );
			?>
			<div class="comment-form-flex">
				<span class="screen-reader-text"><?php echo esc_html( $leave_comment_text ); ?></span>
				<?php newspack_comment_form( 'asc' ); ?>
				<h2 class="comments-title" aria-hidden="true"><?php echo esc_html( $leave_comment_text ); ?></h2>
			</div>
			<?php
		endif;

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments">
				<?php
					echo esc_html( apply_filters( 'newspack_comments_closed', __( 'Comments are closed.', 'newspack' ) ) );
				?>
			</p>
			<?php
		endif;

	else :

		// Show comment form.
		newspack_comment_form( true );

	endif; // if have_comments();
	?>
</div><!-- #comments -->
