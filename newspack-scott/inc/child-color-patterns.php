<?php
/**
 * Newspack Scott: Color Patterns
 *
 * @package Newspack Scott
 */
/**
 * Add child theme-specific custom colours.
 */
function newspack_scott_custom_colors_css() {
	$primary_color   = newspack_get_primary_color();
	$secondary_color = newspack_get_secondary_color();
	$header_color    = $primary_color;

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color   = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );

		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$header_color = get_theme_mod( 'header_color_hex', '#666666' );
		} else {
			$header_color = $primary_color;
		}

		if ( 'default' !== get_theme_mod( 'footer_color', 'default' ) ) {
			$footer_color          = get_theme_mod( 'footer_color_hex', '' );
			$footer_color_contrast = newspack_get_color_contrast( $footer_color );
		}
	}

	// Set colour contrasts.
	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );
	$header_color_contrast    = newspack_get_color_contrast( $header_color );

	$theme_css = '
		.mobile-sidebar .article-section-title,
		.mobile-sidebar .accent-header {
			color: ' . esc_html( $primary_color_contrast ) . ';
		}

		.mobile-sidebar .article-section-title::before,
		.mobile-sidebar .accent-header::before {
			background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -30 ) ) . ';
		}

		@media only screen and (min-width: 782px) {
			/* Header default background */
			.h-db .featured-image-beside .cat-links:before {
				background-color: ' . esc_html( $primary_color_contrast ) . ';
			}
		}
	';

	if ( true === get_theme_mod( 'header_solid_background', false ) ) {
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
			#colophon .social-navigation a,
			#colophon .widgettitle {
				color: ' . esc_html( $footer_color_contrast ) . ';
			}

			#colophon .footer-branding .wrapper,
			#colophon .footer-widgets:first-child {
				border: 0;
			}

			.site-footer .accent-header::before,
			.site-footer .article-section-title::before {
				background-color: ' . esc_html( newspack_adjust_brightness( $footer_color, -20 ) ) . ';
			}
		';
	}

	$editor_css = '';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
