<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newspack
 */

// Get sponsors for this post.
if ( function_exists( 'newspack_get_all_sponsors' ) ) {
	$all_sponsors         = newspack_get_all_sponsors( get_the_id(), null, 'post' );
	$native_sponsors      = newspack_get_native_sponsors( $all_sponsors );
	$underwriter_sponsors = newspack_get_underwriter_sponsors( $all_sponsors );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php newspack_post_thumbnail(); ?>

	<div class="entry-container">
		<?php
		if ( ! empty( $native_sponsors ) ) {
			// Get label for native post sponsors.
			newspack_sponsor_label( $native_sponsors );
		}
		?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( ! is_page() ) : ?>
			<?php if ( ! empty( $native_sponsors ) ) : ?>
				<div class="entry-meta entry-sponsor">
					<?php newspack_sponsor_logo_list( $native_sponsors ); ?>
					<span>
						<?php
						newspack_sponsor_byline( $native_sponsors );
						newspack_posted_on();
						?>
					</span>
				</div>
			<?php else : ?>
				<div class="entry-meta">
					<?php
						newspack_posted_by();
						newspack_posted_on();
					?>
				</div><!-- .meta-info -->
			<?php endif; ?>
		<?php endif; ?>
	</div><!-- .entry-container -->
</article><!-- #post-${ID} -->
