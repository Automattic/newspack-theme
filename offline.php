<?php
/**
 * The PWA Offline template file
 *
 * @package Newspack
 */

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


