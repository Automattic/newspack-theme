<?php
/**
 * Newspack Katharine: Color Patterns
 *
 * @package Newspack Katharine
 */
/**
 * Add child theme-specific custom colours.
 */
function newspack_katharine_custom_colors_css() {
	$header_color    = '#333';

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$header_color = get_theme_mod( 'header_color_hex', '#666666' );
		}

		if ( 'default' !== get_theme_mod( 'footer_color', 'default' ) ) {
			$footer_color          = get_theme_mod( 'footer_color_hex', '' );
			$footer_color_contrast = newspack_get_color_contrast( $footer_color );
		}
	}

	$theme_css  = '';
	$editor_css = '';

	// Set colour contrasts.
	$header_color_contrast    = newspack_get_color_contrast( $header_color );

	if ( true === get_theme_mod( 'header_solid_background', false ) ) {
		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
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
				.h-sb.h-sh .site-header .nav1 .main-menu > li,
				.h-sb.h-sh .site-header .nav1 ul.main-menu > li > a,
				.h-sb.h-sh .site-header .nav1 ul.main-menu > li > a:hover,
				.h-sb .top-header-contain,
				.h-sb .middle-header-contain {
					color: ' . esc_html( $header_color_contrast ) . ';
				}

				.mobile-sidebar div.wpnbha .article-section-title::before,
				.mobile-sidebar .accent-header::before {
					background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -30 ) ) . ';
				}
			';
		}
	}

	if ( isset( $footer_color ) && '' !== $footer_color ) {
		$theme_css .= '
			.footer-branding .wrapper {
				border-bottom-color: ' . esc_html( newspack_adjust_brightness( $footer_color, -20 ) ) . ';
			}

			.site-footer div.wpnbha .article-section-title::before,
			.site-footer .accent-header::before {
				background-color: ' . esc_html( newspack_adjust_brightness( $footer_color, -20 ) ) . ';
			}
		';
	}

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
