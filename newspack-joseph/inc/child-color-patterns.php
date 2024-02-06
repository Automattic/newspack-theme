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
	$header_color    = '#111';

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$header_color = get_theme_mod( 'header_color_hex', '#666666' );
		}
		if ( 'default' !== get_theme_mod( 'footer_color', 'default' ) ) {
			$footer_color          = get_theme_mod( 'footer_color_hex', '' );
			$footer_color_contrast = newspack_get_color_contrast( $footer_color );
		}
	}

	// Set colour contrasts.
	$header_color_contrast    = newspack_get_color_contrast( $header_color );

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

	if ( isset( $footer_color ) && '' !== $footer_color ) {
		$theme_css .= '
			#colophon,
			#colophon .widget-title,
			#colophon .widgettitle,
			#colophon .social-navigation a {
				color: ' . esc_html( $footer_color_contrast ) . ';
			}

			#colophon .footer-branding .wrapper,
			#colophon .footer-widgets:first-child {
				border-top: 0;
			}
		';
	}

	$editor_css = '';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
