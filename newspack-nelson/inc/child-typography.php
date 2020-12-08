<?php
/**
 * Newspack Nelson: Typography
 *
 * @package Newspack Nelson
 */
/**
 * Generate the CSS for custom typography.
 */
function newspack_nelson_custom_typography_css() {
	$font_body   = newspack_font_stack( get_theme_mod( 'font_body', '' ), get_theme_mod( 'font_body_stack', 'serif' ) );
	$font_header = newspack_font_stack( get_theme_mod( 'font_header', '' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( get_theme_mod( 'font_header', '' ) ) {
		$css_blocks .= '
		blockquote,
		.has-drop-cap:not(:focus)::first-letter,
		.taxonomy-description {
			font-family: ' . wp_kses( $font_header, null ) . ';
		}';

		$editor_css_blocks .= '
		.block-editor-block-list__layout .block-editor-block-list__block blockquote,
		.block-editor-block-list__layout .block-editor-block-list__block.has-drop-cap:not(:focus)::first-letter {
			font-family: ' . wp_kses( $font_header, null ) . ';
		}
		';
	}

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks        .= '
			.nav1 ul li,
			.nav3,
			.mobile-menu-toggle,
			.accent-header,
			.cat-links,
			div.wpnbha .article-section-title,
			.entry-meta .byline .author,
			.tags-links a,
			.post-edit-link,
			.author-bio h2 span,
			.site-footer .widget-title {
				letter-spacing: 0.05em;
				text-transform: uppercase;
			}
		';
		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
			.block-editor-block-list__layout .block-editor-block-list__block .cat-links {
				letter-spacing: 0.05em;
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
