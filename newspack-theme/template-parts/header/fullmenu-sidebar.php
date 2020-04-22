<?php
/**
 * Template to display the mobile navigation, either AMP or fallback.
 *
 * @package Newspack
 */

if ( newspack_is_amp() ) : ?>
	<amp-sidebar id="fullmenu-sidebar" layout="nodisplay" side="left" class="fullmenu-sidebar">
		<button class="fullmenu-toggle" on='tap:fullmenu-sidebar.toggle'>
			<?php echo wp_kses( newspack_get_icon_svg( 'close', 20 ), newspack_sanitize_svgs() ); ?>
			<?php esc_html_e( 'Close', 'newspack' ); ?>
		</button>
<?php else : ?>
	<aside id="fullmenu-sidebar-fallback" class="fullmenu-sidebar">
		<button class="fullmenu-toggle">
			<?php echo wp_kses( newspack_get_icon_svg( 'close', 20 ), newspack_sanitize_svgs() ); ?>
			<?php esc_html_e( 'Close', 'newspack' ); ?>
		</button>
<?php endif; ?>

		<?php
		newspack_tertiary_menu();

		get_search_form();

		newspack_primary_menu();

		newspack_secondary_menu();

		newspack_social_menu_header();

		if ( is_active_sidebar( 'header-1' ) ) {
			dynamic_sidebar( 'header-1' );
		}
		?>

<?php if ( newspack_is_amp() ) : ?>
	</amp-sidebar>
<?php else : ?>
	</aside>
<?php endif; ?>
