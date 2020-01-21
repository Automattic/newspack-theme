<?php
/**
 * Newspack Joseph: Customizer
 *
 * @package Newspack Joseph
 */

/**
 * Remove the 'Style Pack' customizer option.
 */
function newspack_joseph_customizer( $wp_customize ) {
	$wp_customize->remove_control( 'active_style_pack' );
}
add_action( 'customize_register', 'newspack_joseph_customizer', 99 );
