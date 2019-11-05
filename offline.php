<?php
/**
 * The PWA Offline template file
 *
 * @package Newspack
 */

// Prevent showing nav menus.
add_filter( 'has_nav_menu', '__return_false' );

// Prevent showing widgets.
add_filter( 'is_active_sidebar', '__return_false' );

// Disable WordAds in the header.
// See: https://wordads.co/2018/02/07/how-to-control-jetpack-ad-placements-using-hooks/
add_filter( 'wordads_header_disable', '__return_true' );

// Remove everything from the theme's do_action locations above and below the header, and footer.
remove_all_actions( 'before_header' );
remove_all_actions( 'after_header' );
remove_all_actions( 'before_footer' );

get_header();
?>
	<section id="primary" class="content-area">
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Offline', 'newspack' ); ?></h1>
		</header><!-- .entry-header -->
		<main id="main" class="site-main">
			<?php
			if ( function_exists( 'wp_service_worker_error_message_placeholder' ) ) {
				wp_service_worker_error_message_placeholder();
			}
			?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php
get_footer();


