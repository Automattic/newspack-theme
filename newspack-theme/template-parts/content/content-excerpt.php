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
		if ( 'page' !== get_post_type() ) :
			if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'native', 'post' ) ) :
				newspack_sponsor_label( get_the_id() );
			elseif ( ! is_archive() ) :
				newspack_categories();
			endif;
		endif;
		?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( 'page' !== get_post_type() ) : ?>
			<?php if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'native', 'post' ) ) : ?>
				<div class="entry-meta entry-sponsor">
					<?php newspack_sponsor_logo_list( get_the_id() ); ?>
					<span>
						<?php
							newspack_sponsor_byline( get_the_id() );
							newspack_posted_on();
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

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
	</div><!-- .entry-container -->
</article><!-- #post-${ID} -->

