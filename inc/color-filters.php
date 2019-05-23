<?php
/**
 * Newspack Theme: Color Filter for overriding the colors schemes in a child theme
 *
 * @package Newspack
 */

/**
 * Define default color filters.
 */

define( 'NEWSPACK_DEFAULT_PRIMARY', '#0073a8' ); // Hex

/**
 * The default color used for the primary color throughout this theme
 *
 * @return string the default hexidecimal color.
 */
function newspack_get_primary_color() {
	return apply_filters( 'newspack_primary_color', NEWSPACK_DEFAULT_PRIMARY );
}

/**
 * Tests the current default hue against NEWSPACK_DEFAULT_HEX.
 *
 * @return bool
 */
function newspack_has_custom_primary_color() {
	return newspack_get_primary_color() !== NEWSPACK_DEFAULT_PRIMARY;
}
