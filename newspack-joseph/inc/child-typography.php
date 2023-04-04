<?php
/**
 * Newspack Joseph: Typography
 *
 * @package Newspack Joseph
 */
/**
 * Generate the CSS for custom typography.
 */
function newspack_joseph_custom_typography_css() {
	$font_header = newspack_font_stack( get_theme_mod( 'font_header', '' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( '' !== $font_header ) {
		$css_blocks .= '
			/* Font Family */
			figcaption,
			.entry-meta,
			.cat-links,
			.entry-footer,
			.nav1,
			.secondary-menu,
			.nav3,
			.site-description,
			.site-info,
			#cancel-comment-reply-link,
			#mobile-sidebar,
			.widget,
			.widget-title.accent-header,
			.widgettitle,
			.wp-block-button__link,
			div.wp-block-file,
			div.wp-block-file .wp-block-file__button,
			.wp-block-pullquote cite,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"] {
				font-family: var( --newspack-theme-font-heading );
			}
		';
	}

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks        .= '
			.accent-header,
			#secondary .widgettitle,
			.article-section-title {
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
