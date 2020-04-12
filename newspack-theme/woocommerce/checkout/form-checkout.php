<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order_details_display = get_theme_mod( 'collapse_order_details', 'hide' );

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	esc_html_e( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'newspack' ) ) );
	return;
}
?>

<?php if ( 'toggle' === $order_details_display ) : ?>
	<div class="cart-summary-header">
		<h3><?php esc_html_e( 'Summary', 'newspack' ); ?></h3>
		<button id="toggle-order-details" class="order-details-hidden" on="tap:AMP.setState( { orderVisible: !orderVisible } )" [class]="orderVisible ? '' : 'order-details-hidden'" aria-controls="full-order-details" [aria-expanded]="orderVisible ? 'true' : 'false'" aria-expanded="false">
			<?php echo wp_kses( newspack_get_icon_svg( 'chevron_left', 24 ), newspack_sanitize_svgs() ); ?>
			<span [text]="orderVisible ? '<?php esc_html_e( 'Hide details', 'newspack' ); ?>' : '<?php esc_html_e( 'Show details', 'newspack' ); ?>'"><?php esc_html_e( 'Show details', 'newspack' ); ?></span>
		</button>
	</div>
<?php endif; ?>

<?php if ( 'display' !== $order_details_display ) : ?>
	<div class="order-details-summary">
	<?php
	// Simplified output of order
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		?>
			<h4>
				<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' ' . sprintf( '%s&nbsp;&times;', $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<strong>
					<?php
						echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</strong>
				<span>
				<?php
					echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
				</span>
			</h4>
			<?php
		}
	}
	?>
	</div><!-- .order-details-summary -->
<?php endif; ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( 'display' === $order_details_display ) : ?>
		<div id="order-details-wrapper">
	<?php else : ?>
		<div id="order-details-wrapper" class="order-details-hidden" [class]="orderVisible ? '' : 'order-details-hidden'">
	<?php endif; ?>
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

		<h3 id="order_review_heading" class="screen-reader-text"><?php esc_html_e( 'Order Details', 'newspack' ); ?></h3>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	</div><!-- .full-order-details -->

<?php if ( $checkout->get_checkout_fields() ) : ?>

	<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

	<div class="col2-set" id="customer_details">
		<?php if ( wc_shipping_enabled() && WC()->cart->get_shipping_total() > 0 ) : ?>
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		<?php else : ?>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
		<?php endif; ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
