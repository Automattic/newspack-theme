<?php
/**
 * Newspack Scott: Typography
 *
 * @package Newspack Scott
 */
/**
 * Generate the CSS for custom typography.
 */
function newspack_scott_custom_typography_css() {
	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks        .= '
			.accent-header:not(.widget-title),
			.article-section-title,
			.page-title,
			#secondary .widget-title,
			.author-bio .accent-header span,
			#colophon .widget-title,
			#colophon .widgettitle,
			#secondary .widgettitle {
				text-transform: uppercase;
			}
		';
		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title {
				text-transform: uppercase;
			}
		';
	}

	if ( '' !== $css_blocks ) {
		$theme_css = $css_blocks;
	} else {
		$theme_css = '';
	}

	if ( '' !== $editor_css_blocks ) {
		$editor_css = $editor_css_blocks;
	} else {
		$editor_css = '';
	}

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
