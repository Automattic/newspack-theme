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

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color   = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );
	}

	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );

	$theme_css = '
		.archive .page-title,
		.entry-meta .byline a, .entry-meta .byline a:visited,
		.entry .entry-content .entry-meta .byline a, .entry .entry-content .entry-meta .byline a:visited,
		.entry .entry-meta a:hover,
		.accent-header,
		.article-section-title,
		.cat-links,
		.entry .entry-footer,
		.site-footer .widget .widget-title {
			color: ' . newspack_color_with_contrast( $primary_color ) . ';
		}

		.has-drop-cap:not(:focus)::first-letter {
			background-color: ' . $primary_color . ';
			color: ' . $primary_color_contrast . ';
		}

		/* Header solid background; short height */
		.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:hover,
		.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:focus {
			background-color: ' . newspack_adjust_brightness( $primary_color, -30 ) . ';
		}
	';

	$editor_css = '
		.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
		.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title {
			color: ' . newspack_color_with_contrast( $primary_color ) . ';
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter {
			background-color: ' . $primary_color . ';
			color: ' . $primary_color_contrast . ';
		}

	';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}
	/**
	 * Filters Newspack Theme custom colors CSS.
	 *
	 * @since Newspack Scott 1.0
	 *
	 * @param string $theme_css   Base theme colors CSS.
	 * @param int    $primary_color       The user's selected color hex.
	 */
	return apply_filters( 'newspack_scott_custom_colors_css', $theme_css, $primary_color );
}
