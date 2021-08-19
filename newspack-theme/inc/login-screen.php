<?php
/**
 * Newspack Theme: Custom login screen.
 *
 * @package Newspack
 */

/**
 * Replace the URL returned by the logo.
 */
function newspack_login_headerurl() {
    return home_url();
}
add_filter( 'login_headerurl', 'newspack_login_headerurl' );

/**
 * Replace the title with the site name.
 */
function newspack_login_headertext() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'newspack_login_headertext' );

/**
 * Adds custom CSS.
 */
function newspack_login_enqueue_scripts() {
	$background_color = 'white';

	if ( true === get_theme_mod( 'header_solid_background', false ) && has_custom_logo() ) {
		$primary_color    = newspack_get_primary_color();
		$background_color = $primary_color;

		if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
			$primary_color = get_theme_mod( 'primary_color_hex', $primary_color );

			if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
				$background_color = get_theme_mod( 'header_color_hex', '#666666' );
			} else {
				$background_color = $primary_color;
			}
		}
	} ?>
  <style type="text/css">
		.login {
			background: <?php echo esc_html( $background_color ); ?>;
		}

		#login {
			color: #1e1e1e;
		}

		#login h1 {
			margin: 0 0 24px;
			padding: 24px 24px 0;
		}

		#login h1 a {
			background-position: bottom center;
			background-repeat: no-repeat;
			background-size: contain;
			height: 72px;
			margin: 0 auto;
			<?php if ( has_custom_logo() ) : ?>
				background-image: url( "<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>" );
				width: 272px;
			<?php else : ?>
				background-image: url( "data:image/svg+xml,%3Csvg width='72' height='72' fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath d='M16 32c8.836 0 16-7.164 16-16S24.836 0 16 0 0 7.164 0 16s7.163 16 16 16z' fill='%2336f'/%3E%3Cpath d='M22.988 16.622h-1.72l-1.103-1.124h2.823v1.124zm0-3.31H18.02l-1.102-1.124h6.071v1.124zm0-3.31h-8.217l-1.103-1.125h9.32v1.125zm0 13.12L9.012 8.878v14.246h3.45v-5.98l5.867 5.98h4.66z' fill='%23fff'/%3E%3C/svg%3E%0A" );
				width: 72px;
			<?php endif; ?>
		}

		#login form {
			border: none;
			box-shadow: 0 0 0 1px #ddd;
			margin: 0;
			padding: 24px;
		}

		#login #nav,
		#login #backtoblog {
			background: white;
			box-shadow: 0 0 0 1px #ddd;
			margin: 0;
			padding: 12px 12px 0;
		}

		#login #nav a,
		#login #backtoblog a {
			color: inherit;
		}

		#login #nav a:hover,
		#login #backtoblog a:hover {
			text-decoration: underline;
		}

		#login #backtoblog {
			padding-bottom: 12px;
			position: relative;
		}

		#login #backtoblog:before {
			background: white;
			content: "";
			display: block;
			height: 1px;
			left: 1px;
			position: absolute;
			right: 1px;
			top: -1px;
		}

		#login .message,
		#login .success,
		#login #login_error {
			box-shadow: 0 0 0 1px #ddd;
			margin: 0;
		}
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'newspack_login_enqueue_scripts' );
