<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newspack
 */

$image_position = get_post_meta( get_the_ID(), 'newspack_featured_image_position', true );
get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				// Get the post thumbnail.
				$thumbnail_info = wp_get_attachment_metadata( get_post_thumbnail_id() );

				// Template part for large featured images.
				if ( has_post_thumbnail() && 1200 <= $thumbnail_info['width'] && 'small' !== $image_position ) :
					get_template_part( 'template-parts/post/large-featured-image' );
				else :
				?>
					<header class="entry-header">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</header>
				<?php endif; ?>

				<div class="main-content">

					<?php
					if ( is_active_sidebar( 'article-1' ) ) {
						dynamic_sidebar( 'article-1' );
					}

					// Place smaller featured images inside of 'content' area.
					if ( has_post_thumbnail() && ( 1200 > $thumbnail_info['width'] || 'small' === $image_position ) ) {
						newspack_post_thumbnail();
					}

					get_template_part( 'template-parts/content/content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

					?>
				</div><!-- .main-content -->

			<?php
				endwhile;
				get_sidebar();
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
