<?php
/**
 * Newspack Nelson: Customizer
 *
 * @package Newspack Nelson
 */

/**
 * Remove the 'Style Pack' customizer option.
 */
function newspack_nelson_customizer( $wp_customize ) {
	$wp_customize->remove_control( 'active_style_pack' );
}
add_action( 'customize_register', 'newspack_nelson_customizer', 99 );
