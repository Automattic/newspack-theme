<?php
/**
 * Newspack Nelson: Color Patterns
 *
 * @package Newspack Nelson
 */
/**
 * Add child theme-specific custom colours.
 */
function newspack_nelson_custom_colors_css() {
	$primary_color   = newspack_get_primary_color();
	$secondary_color = newspack_get_secondary_color();

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color   = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );

		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$header_color          = get_theme_mod( 'header_color_hex', '#666666' );
			$header_color_contrast = newspack_get_color_contrast( $header_color );
		} else {
			$header_color          = $primary_color;
			$header_color_contrast = newspack_get_color_contrast( $primary_color );
		}

		if ( 'default' !== get_theme_mod( 'footer_color', 'default' ) ) {
			$footer_color          = get_theme_mod( 'footer_color_hex', '' );
			$footer_color_contrast = newspack_get_color_contrast( $footer_color );
		}
	}

	// Set colour contrasts.
	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );

	$theme_css = '
		.site-header,
		/* Header default background */
		.h-db .site-header,
		/* Header short height; default background */
		.h-sh.h-db .site-header,
		.site-content #primary,
		#page .site-header {
			border-color: ' . esc_html( newspack_adjust_brightness( $primary_color, -40 ) ) . ';
		}

		.site-footer {
			background-color: ' . esc_html( $primary_color ) . ';
			color: ' . esc_html( $primary_color_contrast ) . ';
		}

		.has-drop-cap:not(:focus)::first-letter {
			color: ' . esc_html( newspack_color_with_contrast( $secondary_color ) ) . ';
		}
	';

	if ( true === get_theme_mod( 'header_solid_background', false ) ) {
		$theme_css .= '
			/* Header solid background */
			.h-sb .site-header,
			.h-sb .middle-header-contain {
				background-color: ' . esc_html( $header_color ) . ';
			}

			.h-sb .top-header-contain {
				background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -10 ) ) . ';
				border-bottom-color: ' . esc_html( newspack_adjust_brightness( $header_color, -15 ) ) . ';
			}

			.site-header,
			/* Header default background */
			.h-db .site-header,
			/* Header short height; default background */
			.h-sh.h-db .site-header,
			.site-content #primary,
			#page .site-header,
			/* Yoast Breadcrumb */
			.has-highlight-menu .site-breadcrumb .wrapper {
				border-color: ' . esc_html( newspack_adjust_brightness( $header_color, -40 ) ) . ';
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
			.h-sb .middle-header-contain,
			.nav1 .sub-menu a,
			.h-sb .site-header .highlight-menu .menu-label,
			.h-sb .site-header .highlight-menu a,
			.h-sb .site-breadcrumb,
			.h-sb .site-breadcrumb a,
			.h-sb .site-breadcrumb .breadcrumb_last {
				color: ' . esc_html( $header_color_contrast ) . ';
			}
		';

		if ( ! isset( $footer_color ) || ( isset( $footer_color ) && '' === $footer_color ) ) {
			$theme_css .= '
				.h-sb .site-footer {
					background-color: ' . esc_html( $header_color ) . ';
					color: ' . esc_html( $header_color_contrast ) . ';
				}
			';
		}
	}

	if ( isset( $footer_color ) && '' !== $footer_color ) {
		$theme_css .= '
			.h-sb .site-footer {
				background-color ' . esc_html( $footer_color ) . ';
			}

			.h-sb .site-footer,
			.site-footer .widget-title {
				color: ' . esc_html( $footer_color_contrast ) . ';
			}

			#colophon .site-info,
			#colophon .site-info .widget-title,
			#colophon .site-info a {
				color: #fff;
			}
		';
	}

	$editor_css = '
		.block-editor-block-list__layout .block-editor-block-list__block.has-drop-cap:not(:focus)::first-letter {
			color: ' . esc_html( newspack_color_with_contrast( $secondary_color ) ) . ';
		}
	';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
