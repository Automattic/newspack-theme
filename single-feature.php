<?php
/**
 * Template Name: One column
 * Template Post Type: post, page
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newspack
 */

get_header();
$thumbnail_info = wp_get_attachment_metadata( get_post_thumbnail_id() );
?>



	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				$featured_image_position = get_post_meta( get_the_ID(), 'newspack_featured_image_position', true );
				if ( 'behind' === $featured_image_position ) :
				?>

					<div class="featured-image-behind">

						<?php newspack_post_thumbnail(); ?>

						<div class="wrapper">
							<header class="entry-header">
								<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
							</header>
						</div><!-- .wrapper -->
					</div><!-- .featured-image-behind -->
				<?php else : ?>

					<header class="entry-header">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</header>

					<?php
					// Place larger featured images above content area.
					if ( has_post_thumbnail() && 1200 <= $thumbnail_info['width'] && 'default' === $featured_image_style ) {
						newspack_post_thumbnail();
					}

				endif;
				?>

				<div class="main-content">

					<?php
					if ( is_active_sidebar( 'article-1' ) && is_single() ) {
						dynamic_sidebar( 'article-1' );
					}

					// Place smaller featured images inside of 'content' area.
					if ( has_post_thumbnail() && 1200 > $thumbnail_info['width'] ) {
						newspack_post_thumbnail();
					}

					get_template_part( 'template-parts/content/content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>

			<?php endwhile; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
