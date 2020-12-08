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
	$font_body   = newspack_font_stack( get_theme_mod( 'font_body', '' ), get_theme_mod( 'font_body_stack', 'serif' ) );
	$font_header = newspack_font_stack( get_theme_mod( 'font_header', '' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( get_theme_mod( 'font_header', '' ) ) {
		$css_blocks .= '
			.has-drop-cap:not(:focus)::first-letter,
			.wp-block-pullquote {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}

			figcaption,
			.entry-meta,
			.cat-links,
			.entry-footer,
			.nav1,
			.nav2,
			.nav3,
			.site-description,
			.site-info,
			#cancel-comment-reply-link,
			#mobile-sidebar,
			.widget,
			.widget-title.accent-header,
			.accent-header,
			.wp-block-button .wp-block-button__link,
			.entry .article-section-title,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"] {
				font-family: inherit;
			}';

		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.has-drop-cap:not(:focus)::first-letter,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .editor-rich-text p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] p {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block.accent-header {
				font-family: inherit;
			}';
	}

	if ( get_theme_mod( 'font_body', '' ) ) {
		$css_blocks .= '
		.wp-block-pullquote cite {
			font-family: ' . wp_kses( $font_body, null ) . ';
		}';

		$editor_css_blocks .= '
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation {
			font-family: ' . wp_kses( $font_body, null ) . ';
		}';
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
