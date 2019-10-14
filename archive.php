<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newspack
 */

get_header();
?>

	<section id="primary" class="content-area">

		<header class="page-header">
			<?php
				if ( is_author() ) {
					$author_id     = get_query_var( 'author' );
					$author_avatar = get_avatar( $author_id, 120 );

					if ( $author_avatar ) {
						echo get_avatar( $author_id, 120 );
					}
				}
			?>
			<span>
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</span>

		</header><!-- .page-header -->

		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :
			$post_count = 0;
			?>

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				$post_count++;
				the_post();

				if ( 1 === $post_count ) {
					get_template_part( 'template-parts/content/content', 'excerpt' );
				} else {
					get_template_part( 'template-parts/content/content', 'archive' );
				}

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			newspack_the_posts_navigation();

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
		<?php get_sidebar(); ?>
	</section><!-- #primary -->

<?php
get_footer();
