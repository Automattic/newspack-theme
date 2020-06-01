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
	wp_enqueue_style( 'newspack-woocommerce-style', get_template_directory_uri() . '/styles/woocommerce.css', array( 'newspack-style' ), wp_get_theme()->get( 'Version' ) );
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
function newspack_woo_custom_colors_css( $css, $primary_color ) {
	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		return $css;
	}
	$css      .= '
		.onsale,
		.woocommerce-store-notice {
			background-color: ' . $primary_color . ';
		}
		.woocommerce-tabs ul li.active a {
			color:  ' . $primary_color . ';
			box-shadow: 0 2px 0 ' . $primary_color . ';
		}
		.woocommerce-tabs ul li a:hover {
			color: ' . newspack_adjust_brightness( $primary_color, -40 ) . ';
		}
	';
	return $css;
}
add_filter( 'newspack_custom_colors_css', 'newspack_woo_custom_colors_css', 10, 2 );


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
 * Disable order notes field because it's not useful for digital products.
 */
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

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

/**
 * Replace .form-row-wide classes with classes to style fields narrower.
 */
function newspack_checkout_fields_styling( $fields ) {
	$fields['billing']['billing_city']['class'][0]     = 'form-row-first';
	$fields['billing']['billing_postcode']['class'][0] = 'form-row-first';
	$fields['billing']['billing_state']['class'][0]    = 'form-row-last';
	$fields['billing']['billing_phone']['class'][0]    = 'form-row-last';
	return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'newspack_checkout_fields_styling', 9999 );

/**
 * Filters the page title for the Thank You page.
 */
function newspack_thankyou_page_title( $title, $id ) {
	if ( function_exists( 'is_order_received_page' ) &&
		is_order_received_page() && get_the_ID() === $id ) {
		$title = get_theme_mod( 'woocommerce_thank_you_title', esc_html__( 'Order received', 'newspack' ) );
	}
	return wp_kses_post( $title );
}
add_filter( 'the_title', 'newspack_thankyou_page_title', 10, 2 );

/**
 * Filters the 'message' for the Thank You page.
 */
function newspack_thankyou_order_message() {
	$thank_you_msg = get_theme_mod( 'woocommerce_thank_you_message', esc_html__( 'Thank you. Your order has been received.', 'newspack' ) );
	return esc_html( $thank_you_msg );
}
add_filter( 'woocommerce_thankyou_order_received_text', 'newspack_thankyou_order_message' );

/**
 * Remove the subscription 'thank you' message.
 */
function newspack_subscription_thank_you() {
	return '';
}
add_filter( 'woocommerce_subscriptions_thank_you_message', 'newspack_subscription_thank_you' );


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
			echo $shop_page->post_content;
		}
	}
}
