<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Newspack
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function newspack_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 300,
			'single_image_width'    => 706,
		)
	);
}
add_action( 'after_setup_theme', 'newspack_woocommerce_setup' );


/**
 * Add theme's WooCommerce styles.
 *
 * @return void
 */
function newspack_woocommerce_scripts() {
	wp_enqueue_style( 'newspack-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
	wp_style_add_data( 'newspack-woocommerce-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'newspack_woocommerce_scripts' );


/**
 * Remove WooCommerce general styles.
 */
function newspack_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );
	return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'newspack_dequeue_styles' );


/**
 * Use theme's custom color for WooCommerce elements.
 */
function newspack_woo_custom_colors_css( $css, $primary_color, $saturation ) {
	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		return $css;
	}
	$lightness = absint( apply_filters( 'newspack_custom_colors_lightness', 33 ) );
	$lightness = $lightness . '%';
	$css      .= '
		.onsale,
		.woocommerce-info,
		.woocommerce-store-notice {
			background-color: hsl( ' . $primary_color . ', ' . $saturation . ', ' . $lightness . ' );
		}
		.woocommerce-tabs ul li.active a {
			color: hsl( ' . $primary_color . ', ' . $saturation . ', ' . $lightness . ' );
			box-shadow: 0 2px 0 hsl( ' . $primary_color . ', ' . $saturation . ', ' . $lightness . ' );
		}
	';
	return $css;
}
add_filter( 'newspack_custom_colors_css', 'newspack_woo_custom_colors_css', 10, 3 );


/**
 * Remove WooCommerce sidebar - this theme doesn't have a traditional sidebar.
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


if ( ! function_exists( 'newspack_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function newspack_woocommerce_wrapper_before() { ?>
		<section id="primary" class="content-area">
			<main id="main" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'newspack_woocommerce_wrapper_before' );

if ( ! function_exists( 'newspack_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function newspack_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</section><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'newspack_woocommerce_wrapper_after' );
