<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newspack
 */

?>

<div class="main-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php
			if ( is_sticky() && is_home() && ! is_paged() ) {
				printf( '<span class="sticky-post">%s</span>', esc_html_x( 'Featured', 'post', 'newspack' ) );
			}
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>
		</header><!-- .entry-header -->

		<?php newspack_post_thumbnail(); ?>

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php newspack_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-${ID} -->
</div>
