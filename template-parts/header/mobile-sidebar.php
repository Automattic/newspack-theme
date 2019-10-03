<?php
/**
 * Template for display the AMP mobile navigation.
 *
 * @package Newspack
 */
?>

<amp-sidebar id="mobile-sidebar" layout="nodisplay" side="right" class="mobile-sidebar">

	<button class="mobile-menu-toggle" on='tap:mobile-sidebar.toggle'>
		<?php echo wp_kses( newspack_get_icon_svg( 'close', 20 ), newspack_sanitize_svgs() ); ?>
		<?php esc_html_e( 'Close', 'newspack' ); ?>
	</button>

	<?php newspack_tertiary_menu(); ?>

	<?php get_search_form(); ?>

	<?php newspack_primary_menu(); ?>

	<?php newspack_secondary_menu(); ?>

	<?php newspack_social_menu_header(); ?>

</amp-sidebar>
