<?php
/**
 * Newspack Theme: Typography
 *
 * @package Newspack
 */

/**
 * Generate the CSS for custom typography.
 */
function newspack_custom_typography_css() {

	$font_body   = newspack_font_stack( get_theme_mod( 'font_body', '' ), get_theme_mod( 'font_body_stack', 'serif' ) );
	$font_header = newspack_font_stack( get_theme_mod( 'font_header', '' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( get_theme_mod( 'font_header', '' ) ) {
		$css_blocks .= '
			:root {
				--newspack-theme-font-heading: ' . wp_kses( $font_header, null ) . ';
			}
		';

		$editor_css_blocks .= '
			:root .editor-styles-wrapper {
				--newspack-theme-font-heading: ' . wp_kses( $font_header, null ) . ';
			}
		';
	}

	if ( get_theme_mod( 'font_body', '' ) ) {
		$css_blocks .= '
			:root {
				--newspack-theme-font-body: ' . wp_kses( $font_body, null ) . ';
			}
		';

		$editor_css_blocks .= '
			:root .editor-styles-wrapper {
				--newspack-theme-font-body: ' . wp_kses( $font_body, null ) . ';
			}
		';
	}

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks .= '
			.tags-links span:first-child,
			.cat-links,
			.page-title,
			.highlight-menu .menu-label {
				text-transform: uppercase;
			}
		';

		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block .cat-links,
			.block-editor-block-list__layout .block-editor-block-list__block #jp-relatedposts h3.jp-relatedposts-headline {
				text-transform: uppercase;
			}
		';

		if ( ! is_child_theme() ) {
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

/**
 * Generate link elements for custom typography stylesheets.
 */
function newspack_custom_typography_link( $theme_mod ) {
	$font_code = get_theme_mod( $theme_mod, '' );
	if ( ! $font_code ) {
		return false;
	}
	return $font_code;
}

/**
 * Fallback font stacks
 */
function newspack_get_font_stacks() {
	return array(
		'serif'      => array(
			'name'  => __( 'Serif', 'newspack' ),
			'fonts' => array(
				'Georgia',
				'serif',
			),
		),
		'sans_serif' => array(
			'name'  => __( 'Sans Serif', 'newspack' ),
			'fonts' => array(
				'Helvetica',
				'sans-serif',
			),
		),
		'display'    => array(
			'name'  => __( 'Display', 'newspack' ),
			'fonts' => array(
				'Impact',
				'Arial Black',
				'sans-serif',
			),
		),
		'monospace'  => array(
			'name'  => __( 'Monospace', 'newspack' ),
			'fonts' => array(
				'Consolas',
				'Courier New',
				'Courier',
				'monospace'
			),
		),
	);
}

/**
 * Prepare fallback font stacks for use in a Select element
 */
function newspack_get_font_stacks_as_select_choices() {
	$stacks = array();
	foreach ( newspack_get_font_stacks() as $key => $value ) {
		$stacks[ $key ] = wp_kses( $value['name'], null );
	}
	return $stacks;
}

/**
 * Prepare a font-family definition with a primary font and fallbacks.
 */
function newspack_font_stack( $primary_font, $fallback_id ) {
	$stacks = newspack_get_font_stacks();
	$fonts  = isset( $stacks[ $fallback_id ] ) ? $stacks[ $fallback_id ]['fonts'] : array();
	array_unshift( $fonts, $primary_font );
	foreach ( $fonts as &$font ) {
		$font = '"' . $font . '"';
	}
	return implode( ',', $fonts );
}
