<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
				<?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'newspack' ); ?>
			</p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'newspack' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'newspack' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
				<?php echo wp_kses_post( apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'newspack' ), $order ) ); ?>
			</p>

			<h4><?php esc_html_e( 'Summary', 'newspack' ); ?></h4>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e( 'Date:', 'newspack' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e( 'Email:', 'newspack' ); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e( 'Total:', 'newspack' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Payment method:', 'newspack' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e( 'Transaction:', 'newspack' ); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

			</ul>

			<?php
				// Copied from templates/order/order-details.php
				$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
				if ( false === get_theme_mod( 'thank_you_customer_details_display', false ) ) {
					$show_customer_details = false;
				}
				if ( $show_customer_details ) {
					wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
				}
			?>
		<?php endif; ?>

		<?php
		/**
		 * Copied from the Order Downloads template - full details below:
		 *
		 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
		 *
		 * HOWEVER, on occasion WooCommerce will need to update template files and you
		 * (the theme developer) will need to copy the new files to your theme to
		 * maintain compatibility. We try to do this as little as possible, but it does
		 * happen. When this occurs the version of the template file will be bumped and
		 * the readme will list any important changes.
		 *
		 * @see     https://docs.woocommerce.com/document/template-structure/
		 * @package WooCommerce\Templates
		 * @version 3.3.0
		 */
		?>

		<?php
		$downloads = $order->get_downloadable_items();

		if ( $downloads ) : ?>
			<h4><?php esc_html_e( 'Downloads', 'newspack' ); ?></h4>

			<section class="woocommerce-order-downloads">
				<?php if ( isset( $show_title ) ) : ?>
					<h2 class="woocommerce-order-downloads__title"><?php esc_html_e( 'Downloads', 'newspack' ); ?></h2>
				<?php endif; ?>

				<table class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">
					<thead>
						<tr>
							<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
							<th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
							<?php endforeach; ?>
						</tr>
					</thead>

					<?php foreach ( $downloads as $download ) : ?>
						<tr>
							<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
								<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
									<?php
									if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
										do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
									} else {
										switch ( $column_id ) {
											case 'download-product':
												if ( $download['product_url'] ) {
													echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
												} else {
													echo esc_html( $download['product_name'] );
												}
												break;
											case 'download-file':
												echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file button alt">' . esc_html( $download['download_name'] ) . '</a>';
												break;
											case 'download-remaining':
												echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'newspack' );
												break;
											case 'download-expires':
												if ( ! empty( $download['access_expires'] ) ) {
													echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
												} else {
													esc_html_e( 'Never', 'newspack' );
												}
												break;
										}
									}
									?>
								</td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</table>
			</section>
		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
			<?php echo wp_kses_post( apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'newspack' ), null ) ); ?>
		</p>

	<?php endif; ?>

</div>
