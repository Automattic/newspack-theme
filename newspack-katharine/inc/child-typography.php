<?php
/**
 * Newspack Katharine: Typography
 *
 * @package Newspack Katharine
 */
/**
 * Generate the CSS for custom typography.
 */
function newspack_katharine_custom_typography_css() {
	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks        .= '
			.accent-header,
			div.wpnbha .article-section-title,
			.archive .page-title,
			.author-bio h2 span,
			.entry-meta .byline a,
			.entry-meta .entry-date,
			.entry-meta .updated,
			.site-footer .widget-title,
			.site-footer .widgettitle,
			.site-info,
			#secondary .widgettitle {
				text-transform: uppercase;
			}
		';
		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .entry-date {
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
