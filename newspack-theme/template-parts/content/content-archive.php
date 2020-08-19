<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newspack
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php newspack_post_thumbnail(); ?>

	<div class="entry-container">
		<?php
			if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'native', 'post' ) ) :
				newspack_sponsor_label( get_the_id() );
			endif;
		?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( ! is_page() ) : ?>
			<?php if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'native', 'post' ) ) : ?>
				<div class="entry-meta entry-sponsor">
					<?php newspack_sponsor_logo_list( get_the_id() ); ?>
					<span>
						<?php
							newspack_sponsor_byline( get_the_id() );
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

