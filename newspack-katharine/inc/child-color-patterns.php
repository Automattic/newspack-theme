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
		.archive .page-title,
		.entry-meta .byline a, .entry-meta .byline a:visited,
		.entry .entry-content .entry-meta .byline a, .entry .entry-content .entry-meta .byline a:visited,
		.entry .entry-meta a:hover,
		.cat-links,
		.cat-links a,
		.cat-links a:visited,
		.article-section-title,
		.entry .entry-footer,
		.accent-header {
			color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
		}

		.cat-links a:hover {
			color: ' . esc_html( newspack_adjust_brightness( $primary_color, -40 ) ) . ';
		}

		.accent-header:before,
		.site-content .wpnbha .article-section-title:before,
		.cat-links:before,
		.archive .page-title:before,
		figcaption:after,
		.wp-caption-text:after {
			background-color: ' . esc_html( $primary_color ) . ';
		}

		@media only screen and (min-width: 782px) {
			.featured-image-beside a,
			.featured-image-beside a:visited,
			.featured-image-beside .cat-links a {
				color: ' . esc_html( $primary_color_contrast ) . ';
			}

			.featured-image-beside .cat-links:before {
				background-color: ' . esc_html( $primary_color_contrast ) . ';
			}
		}
	';

	if ( true === get_theme_mod( 'header_solid_background', false ) ) {
		$theme_css .= '
			/* Featured Image Beside styles */
			@media only screen and (min-width: 782px) {
				.h-sb .featured-image-beside {
					background-color: ' . esc_html( $primary_color ) . ';
				}

				.h-sb .featured-image-beside,
				.h-sb .featured-image-beside a {
					color: ' . esc_html( $primary_color_contrast ) . ';
				}
			}

			.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:hover,
			.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:focus {
				background-color: ' . esc_html( newspack_adjust_brightness( $primary_color, -30 ) ) . ';
			}
		';


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
				.h-sb.h-sh .nav1 .main-menu > li,
				.h-sb.h-sh .nav1 ul.main-menu > li > a,
				.h-sb.h-sh .nav1 ul.main-menu > li > a:hover,
				.h-sb .top-header-contain,
				.h-sb .middle-header-contain {
					color: ' . esc_html( $header_color_contrast ) . ';
				}
			';
		}
	}

	$editor_css = '
		.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
		.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title {
			color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
		}

		.block-editor-block-list__layout .block-editor-block-list__block .accent-header:before,
		.block-editor-block-list__layout .block-editor-block-list__block .article-section-title:before,
		.block-editor-block-list__layout .block-editor-block-list__block figcaption:after,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-caption-text:after {
			background-color: ' . esc_html( $primary_color ) . ';
		}
	';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
