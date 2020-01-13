<?php
/**
 * Newspack Sacha: Customizer
 *
 * @package Newspack Sacha
 */

/**
 * Remove the 'Style Pack' customizer option.
 */
function newspack_sacha_customizer( $wp_customize ) {
	$wp_customize->remove_control( 'active_style_pack' );
}
add_action( 'customize_register', 'newspack_sacha_customizer', 99 );
