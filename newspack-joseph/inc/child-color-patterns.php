<?php
/**
 * Newspack Joseph: Color Patterns
 *
 * @package Newspack Joseph
 */
/**
 * Add child theme-specific custom colours.
 */
function newspack_joseph_custom_colors_css() {
	$primary_color   = newspack_get_primary_color();
	$secondary_color = newspack_get_secondary_color();

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color   = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );
	}

	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );

	$theme_css = '
		@media only screen and (min-width: 782px) {
			.h-db .featured-image-beside .entry-header {
				color: #fff;
			}
		}
	';

	$editor_css = '';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
