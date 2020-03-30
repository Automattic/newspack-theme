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

		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$header_color          = get_theme_mod( 'header_color_hex', '#666666' );
			$header_color_contrast = newspack_get_color_contrast( $header_color );
		}
	}

	// Set colour contrasts.
	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );

	$theme_css = '
		@media only screen and (min-width: 782px) {
			.h-db .featured-image-beside .entry-header {
				color: #fff;
			}
		}
	';

	if ( true === get_theme_mod( 'header_solid_background', false ) && 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
		$theme_css .= '
			/* Header solid background */
			.h-sb .middle-header-contain {
				background-color: ' . esc_html( $header_color ) . ';
			}
			.h-sb .top-header-contain {
				background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -10 ) ) . ';
				border-bottom-color: ' . esc_html( newspack_adjust_brightness( $header_color, -15 ) ) . ';
			}

			/* Header solid background */
			.h-sb .site-header,
			.h-sb .site-title,
			.h-sb .site-title a:link,
			.h-sb .site-title a:visited,
			.h-sb .site-description,
			/* Header solid background; short height */
			.h-sb.h-sh .nav1 .main-menu > li,
			.h-sb.h-sh .nav1 ul.main-menu > li > a,
			.h-sb.h-sh .nav1 ul.main-menu > li > a:hover,
			.h-sb .top-header-contain,
			.h-sb .middle-header-contain {
				color: ' . esc_html( $header_color_contrast ) . ';
			}
		';
	}

	$editor_css = '';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
