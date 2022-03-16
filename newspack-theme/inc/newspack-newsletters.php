<?php
/**
 * Newspack Newsletters Compatibility File
 *
 * @package Newspack
 */

/**
 * Enqueue Block Editor styles.
 */
function newspack_newsletters_enqueue_editor_styles() {
	add_editor_style( 'styles/newspack-newsletters-editor.css' );
}
add_action( 'newspack_newsletters_enqueue_block_editor_assets', 'newspack_newsletters_enqueue_editor_styles' );

/**
 * Custom MJML components attributes.
 *
 * @param array $attributes MJML component attributes.
 *
 * @return array MJML component attributes.
 */
function newspack_newsletters_mjml_component_attributes( $attributes ) {
	if ( isset( $attributes['css-class'] ) && 'image-caption' === $attributes['css-class'] ) {
		$attributes['align']   = 'left';
		$attributes['padding'] = '0';
	}
	return $attributes;
}
add_filter( 'newspack_newsletters_mjml_component_attributes', 'newspack_newsletters_mjml_component_attributes' );
