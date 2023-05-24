<?php
/**
 * Adds support to the Newspack Multi-branded site plugin
 *
 * @package Newspack
 */

/**
 * Register the colors users will be able to customize per brand using the Multi-branded site plugin.
 */
add_filter(
	'newspack_multibranded_site_theme_colors',
	function() {
		return [
			[
				'theme_mod_name' => 'primary_color_hex',
				'label'          => __( 'Primary Color', 'newspack-theme' ),
				'default'        => 'default' !== get_theme_mod( 'theme_colors' ) ? get_theme_mod( 'primary_color_hex', newspack_get_primary_color() ) : newspack_get_primary_color(),
			],
			[
				'theme_mod_name' => 'secondary_color_hex',
				'label'          => __( 'Secondary Color', 'newspack-theme' ),
				'default'        => 'default' !== get_theme_mod( 'theme_colors' ) ? get_theme_mod( 'secondary_color_hex', newspack_get_secondary_color() ) : newspack_get_secondary_color(),
			],
			[
				'theme_mod_name' => 'ads_color_hex',
				'label'          => __( 'Background color to the ads', 'newspack-theme' ),
				'default'        => get_theme_mod( 'ads_color_hex', '#ffffff' ),
			],
		];
	}
);

/**
 * Custom ads color will only be applied if the ads_color theme_mod is set to 'custom', so we need to filter it if they are being set by the Newspack Multi-branded site plugin.
 */
add_filter(
	'theme_mod_ads_color',
	function( $value ) {
		if ( ( defined( 'WP_CLI' ) && WP_CLI ) || is_admin() || ! class_exists( 'Newspack_Multibranded_Site\Customizations\Theme_Colors' ) ) {
			return $value;
		}
		if ( Newspack_Multibranded_Site\Customizations\Theme_Colors::current_brand_has_custom_colors( [ 'ads_color_hex' ] ) ) {
			return 'custom';
		}
		return $value;
	}
);

/**
 * Custom colors will only be applied if the theme_colors theme_mod is set to 'custom', so we need to filter it if they are being set by the Newspack Multi-branded site plugin.
 */
add_filter(
	'theme_mod_theme_colors',
	function( $value ) {
		if ( ( defined( 'WP_CLI' ) && WP_CLI ) || is_admin() || ! class_exists( 'Newspack_Multibranded_Site\Customizations\Theme_Colors' ) ) {
			return $value;
		}
		if ( Newspack_Multibranded_Site\Customizations\Theme_Colors::current_brand_has_custom_colors( [ 'primary_color_hex', 'secondary_color_hex' ] ) ) {
			return 'custom';
		}
		return $value;
	}
);
