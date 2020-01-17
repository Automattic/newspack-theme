<?php
/**
 * Newpack Scott: Customizer
 *
 * @package Newspack Scott
 */

/**
 * Remove the 'Style Pack' customizer option.
 */
function newspack_scott_customizer( $wp_customize ) {
	$wp_customize->remove_control( 'active_style_pack' );
}
add_action( 'customize_register', 'newspack_scott_customizer', 99 );
