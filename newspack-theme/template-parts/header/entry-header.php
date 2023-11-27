<?php
/**
 * Displays the post header
 *
 * @package Newspack
 */

$discussion = ! is_page() && newspack_can_show_post_thumbnail() ? newspack_get_discussion_data() : null;

// Get sponsors for this post.
if ( function_exists( 'newspack_get_all_sponsors' ) ) {
	$all_sponsors                    = newspack_get_all_sponsors( get_the_id() );
	$native_sponsors                 = newspack_get_native_sponsors( $all_sponsors );
	$underwriter_sponsors            = newspack_get_underwriter_sponsors( $all_sponsors );
	$display_sponsors_and_categories = newspack_display_sponsors_and_categories( $native_sponsors );
	$display_sponsors_and_authors    = newspack_display_sponsors_and_authors( $native_sponsors );
}

// Get page title visibility.
$page_hide_title = get_post_meta( $post->ID, 'newspack_hide_page_title', true );

// Get post subtitle.
if ( true === get_theme_mod( 'post_excerpt_instead_of_subtitle', false ) ) {
	$subtitle = $post->post_excerpt;
} else {
	$subtitle = get_post_meta( $post->ID, 'newspack_post_subtitle', true );
}
?>

<?php if ( is_singular() ) : ?>
	<?php
	if ( ! is_page() ) :
		if ( ! empty( $native_sponsors ) ) {
			newspack_sponsor_label( $native_sponsors, null, true );
			if ( $display_sponsors_and_categories ) {
				newspack_categories();
			}
		} else {
			newspack_categories();
		}
	endif;
	?>
	<?php if ( ! $page_hide_title ) : ?>
		<h1 class="entry-title <?php echo $subtitle ? 'entry-title--with-subtitle' : ''; ?>">
			<?php echo wp_kses_post( get_the_title() ); ?>
		</h1>
	<?php endif; ?>
	<?php if ( $subtitle ) : ?>
		<div class="newspack-post-subtitle">
			<?php
			$allowed_tags = array(
				'b'      => true,
				'strong' => true,
				'i'      => true,
				'em'     => true,
				'mark'   => true,
				'u'      => true,
				'small'  => true,
				'sub'    => true,
				'sup'    => true,
				'a'      => array(
					'href'   => true,
					'target' => true,
					'rel'    => true,
				),
			);

			echo wptexturize( wp_kses( $subtitle, $allowed_tags ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	<?php endif; ?>
<?php else : ?>
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php echo wp_kses_post( get_the_title() ); ?>
		</a>
	</h2>
<?php endif; ?>

<?php
$sharing_enabled = ! is_page() || ! empty( get_post_meta( $post->ID, 'newspack_show_share_buttons', true ) );
if ( $sharing_enabled ) :
	?>
	<div class="entry-subhead">
		<?php if ( ! is_page() ) : ?>
			<?php if ( ! empty( $native_sponsors ) ) : ?>
				<?php
				// If showing both authors and sponsors, show the byline and date first.
				if ( $display_sponsors_and_authors ) :
				?>
					<div class="entry-meta">
						<?php
						newspack_posted_by();
						newspack_posted_on();
						?>
					</div>
				<?php endif; ?>
				<div class="entry-meta entry-sponsor">
					<?php newspack_sponsor_logo_list( $native_sponsors ); ?>
					<span>
						<?php
							newspack_sponsor_byline( $native_sponsors );

							// If not showing the author, we still need to show the date.
							if ( ! $display_sponsors_and_authors ) {
								newspack_posted_on();
							}
							do_action( 'newspack_theme_entry_meta' );
						?>
					</span>
				</div>
			<?php else : ?>
				<div class="entry-meta">
					<?php
						newspack_posted_by();
						newspack_posted_on();
						do_action( 'newspack_theme_entry_meta' );
					?>
				</div><!-- .meta-info -->
			<?php endif; ?>
		<?php endif; ?>
		<?php
		// Display Jetpack Share icons, if enabled.
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}
		?>
	</div>
<?php endif; ?>
