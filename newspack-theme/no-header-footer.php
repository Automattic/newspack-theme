<?php
/**
 * Template Name: No header or footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspack
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-amp-auto-lightbox-disable>
<?php do_action( 'wp_body_open' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'newspack' ); ?></a>

	<div id="content" class="site-content">

		<section id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					// Template part for large featured images.
					if ( in_array( newspack_featured_image_position(), array( 'large', 'behind', 'beside', 'above' ) ) ) :
						get_template_part( 'template-parts/post/large-featured-image' );
					else :
					?>
						<header class="entry-header">
							<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
						</header>
					<?php endif; ?>

					<div class="main-content">

						<?php
						// Place smaller featured images inside of 'content' area.
						if ( 'small' === newspack_featured_image_position() ) {
							newspack_post_thumbnail();
						}

						get_template_part( 'template-parts/content/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							newspack_comments_template();
						}
						?>
					</div>

				<?php endwhile; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

	</div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
