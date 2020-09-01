<?php
/**
 * The template for displaying the static front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newspack
 */

get_header();
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>

				<header class="entry-header">
					<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
				</header>

				<?php
				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					newspack_comments_template();
				}

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->

		<section id="sticky-sidebar" class="desktop-sidebar-sticky">
			<?php
			if ( ! newspack_is_amp() ) {
				get_template_part( 'template-parts/sidebar/sidebar', 'sticky' );
			}
			?>
		</section>
	</section><!-- #primary -->

	<?php if ( newspack_is_amp() ) : ?>
	<amp-sidebar id="sidebar-desktop"
		class="desktop-sidebar"
		layout="nodisplay"
		side="left">
		<?php get_template_part( 'template-parts/sidebar/sidebar', 'sticky' ); ?>
	</amp-sidebar>
	<?php endif; ?>

<?php
get_footer();
