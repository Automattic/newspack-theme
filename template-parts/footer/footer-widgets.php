<?php
/**
 * Displays the footer widget area
 *
 * @package Newspack
 */

if ( is_active_sidebar( 'footer-1' ) ) : ?>

	<aside class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'newspack' ); ?>">
		<?php
		if ( is_active_sidebar( 'footer-1' ) ) {
			?>
					<div class="widget-column footer-widget-1">
					<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php
		}
		?>
	</aside><!-- .widget-area -->

<?php endif; ?>
