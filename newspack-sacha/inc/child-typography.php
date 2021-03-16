<?php
/**
 * Newspack Sacha: Typography
 *
 * @package Newspack Sacha
 */
/**
 * Generate the CSS for custom typography.
 */
function newspack_sacha_custom_typography_css() {
	$font_body   = newspack_font_stack( get_theme_mod( 'font_body', '' ), get_theme_mod( 'font_body_stack', 'serif' ) );
	$font_header = newspack_font_stack( get_theme_mod( 'font_header', '' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( get_theme_mod( 'font_header', '' ) ) {
		$css_blocks .= '
			.site-description,
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description,
			blockquote,
			blockquote cite,
			.wp-block-pullquote cite {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
		';

		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.has-drop-cap:not(:focus)::first-letter,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .block-library-pullquote__content .editor-rich-text__tinymce[data-is-empty="true"]::before,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .editor-rich-text p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation,
			.block-editor-block-list__layout blockquote.block-editor-block-list__block,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block-pullquote p,
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
		';
	}
	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks        .= '
			.accent-header,
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
