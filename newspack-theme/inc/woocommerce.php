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
	if (
		function_exists( 'is_woocommerce' ) && is_woocommerce()
		|| function_exists( 'is_cart' ) && is_cart()
		|| function_exists( 'is_checkout' ) && is_checkout()
		|| function_exists( 'is_account_page' ) && is_account_page()
	) {
		wp_enqueue_style( 'newspack-woocommerce-style', get_template_directory_uri() . '/styles/woocommerce.css', array( 'newspack-style' ), wp_get_theme()->get( 'Version' ) );
		wp_style_add_data( 'newspack-woocommerce-style', 'rtl', 'replace' );
	}
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
 * Remove WooCommerce sidebar - this theme doesn't have a traditional sidebar.
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Order details are at the top, so move the payment form to the bottom.
 */
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment' );

/**
 * Add heading above payment info form.
 */
function newspack_woo_payment_heading() {
	?>
	<h3><?php esc_html_e( 'Payment info', 'newspack' ); ?></h3>
	<?php
}
add_action( 'woocommerce_review_order_before_payment', 'newspack_woo_payment_heading' );

/**
 * Add heading above checkout account creation form.
 */
function newspack_woo_account_registration_heading() {
	$checkout = WC_Checkout::instance();

	if ( $checkout->get_checkout_fields( 'account' ) ) :
		?>
		<h3><?php esc_html_e( 'Create an account', 'newspack' ); ?></h3>
		<?php
	endif;

}
add_action( 'woocommerce_before_checkout_registration_form', 'newspack_woo_account_registration_heading' );

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
	function newspack_woocommerce_wrapper_before() {
		?>
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

/**
 * Override the Woo function that prints the shop page content.
 */
function woocommerce_product_archive_description() {
	// Don't display the description on search results page.
	if ( is_search() ) {
		return;
	}

	if ( is_post_type_archive( 'product' ) && in_array( absint( get_query_var( 'paged' ) ), array( 0, 1 ), true ) ) {
		$shop_page = get_post( wc_get_page_id( 'shop' ) );
		if ( $shop_page ) {
			echo wp_kses_post( wc_format_content( $shop_page->post_content ) );
		}
	}
}

/**
 * Change the products per column in the shop.
 */
function woocommerce_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'woocommerce_loop_columns', 999 );


/**
 * Open a div to wrap the sort dropdown and results count in a container.
 */
function woocommerce_before_shop_loop_wrapper_open() {
	echo '<div class="woocommerce-results-wrapper">';
}
add_action( 'woocommerce_before_shop_loop', 'woocommerce_before_shop_loop_wrapper_open', 15 );

/**
 * Close a div to wrap the sort dropdown and results count in a container.
 */
function woocommerce_before_shop_loop_wrapper_close() {
	echo '</div><!-- .woocommerce-results-order-wrapper -->';
}
add_action( 'woocommerce_before_shop_loop', 'woocommerce_before_shop_loop_wrapper_close', 40 );

/**
 * Improve appearance of WooCommerce checkout.
 *
 * @param array $fields Array of WooCommerce address fields.
 */
function newspack_address_fields_styling( $fields ) {
	$fields['city']['class']     = array( 'form-row-first' );
	$fields['state']['class']    = array( 'form-row-last' );
	$fields['postcode']['class'] = array( 'form-row-first' );

	return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'newspack_address_fields_styling', 9999 );
