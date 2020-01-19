<?php
/**
 * Newpack Katharine: Customizer
 *
 * @package Newspack Katharine
 */

/**
 * Remove the 'Style Pack' customizer option.
 */
function newspack_katharine_customizer( $wp_customize ) {
	$wp_customize->remove_control( 'active_style_pack' );
}
add_action( 'customize_register', 'newspack_katharine_customizer', 99 );
