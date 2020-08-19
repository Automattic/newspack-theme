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

					$queried       = get_queried_object();
					$author_avatar = '';

					if ( function_exists( 'coauthors_posts_links' ) ) {
						// Check if this is a guest author post type.
						if ( 'guest-author' === get_post_type( $queried->{ 'ID' } ) ) {
							// If yes, make sure the author actually has an avatar set; otherwise, coauthors_get_avatar returns a featured image.
							if ( get_post_thumbnail_id( $queried->{ 'ID' } ) ) {
								$author_avatar = coauthors_get_avatar( $queried, 120 );
							} else {
								// If there is no avatar, force it to return the current fallback image.
								$author_avatar = get_avatar( ' ' );
							}
						} else {
							$author_avatar = coauthors_get_avatar( $queried, 120 );
						}
					} else {
						$author_id     = get_query_var( 'author' );
						$author_avatar = get_avatar( $author_id, 120 );
					}

					if ( $author_avatar ) {
						echo wp_kses( $author_avatar, newspack_sanitize_avatars() );
					}
				}
			?>
			<span>

				<?php
					if ( ( is_category() || is_tag() ) && function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_queried_object_id() ) ) {
						newspack_sponsor_label( get_queried_object_id(), true, 'native', 'archive' );
					}
				?>

				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>

				<?php do_action( 'newspack_theme_below_archive_title' ); ?>

				<?php if ( ( is_category() || is_tag() ) && function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_queried_object_id(), 'native' ) ) : ?>
					<?php newspack_sponsor_archive_description( get_queried_object_id(), 'native', 'archive' ); ?>
				<?php elseif ( '' !== get_the_archive_description() ) : ?>
					<div class="taxonomy-description">
						<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
					</div>
				<?php endif; ?>

				<?php
				if ( is_category() || is_tag() ) {
					if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_queried_object_id(), 'underwritten', 'archive' ) ) {
						newspack_sponsored_underwriters_info( get_queried_object_id(), 'underwritten', 'archive' );
					}
				}
			?>

				<?php if ( is_author() ) : ?>
					<div class="author-meta">
						<?php
							$author_email = get_the_author_meta( 'user_email', get_query_var( 'author' ) );
							if ( true === get_theme_mod( 'show_author_email', false ) && '' !== $author_email ) :
							?>
							<a class="author-email" href="<?php echo 'mailto:' . esc_attr( $author_email ); ?>">
								<?php echo wp_kses( newspack_get_social_icon_svg( 'mail', 18 ), newspack_sanitize_svgs() ); ?>
								<?php echo esc_html( $author_email ); ?>
							</a>
						<?php endif; ?>

						<?php newspack_author_social_links( get_the_author_meta( 'ID' ), 20 ); ?>
					</div><!-- .author-meta -->

					<?php do_action( 'newspack_theme_below_author_archive_meta' ); ?>

				<?php endif; ?>
			</span>

		</header><!-- .page-header -->

		<?php do_action( 'before_archive_posts' ); ?>

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
