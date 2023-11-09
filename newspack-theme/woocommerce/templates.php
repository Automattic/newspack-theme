<?php
/**
 * This folder holds Woocommerce templates that override the default Woo templates.
 *
 * If you add or remove a template from this folder, it's a good idea to clear the template cache
 * to make sure the changes take effect - and not break anything - on sites that use persistent caching
 *
 * @package newspack-theme
 */

/**
 * When adding or removing a template from this folder, increase the templates_version variable below.
 */
$newspack_theme_woo_templates_version = 1;

if ( function_exists( 'wc_clear_template_cache' ) && get_option( 'newspack_theme_woo_templates_version', 0 ) !== $newspack_theme_woo_templates_version ) {
	wc_clear_template_cache();
	update_option( 'newspack_theme_woo_templates_version', $newspack_theme_woo_templates_version );
}
