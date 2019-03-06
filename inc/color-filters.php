<?php
/**
 * Newspack Theme: Color Filter for overriding the colors schemes in a child theme
 *
 * @package Newspack
 */

/**
 * Define default color filters.
 */

define( 'NEWSPACK_DEFAULT_HUE', 199 );        // H
define( 'NEWSPACK_DEFAULT_SATURATION', 100 ); // S
define( 'NEWSPACK_DEFAULT_LIGHTNESS', 33 );   // L

define( 'NEWSPACK_DEFAULT_SATURATION_SELECTION', 50 );
define( 'NEWSPACK_DEFAULT_LIGHTNESS_SELECTION', 90 );
define( 'NEWSPACK_DEFAULT_LIGHTNESS_HOVER', 23 );

/**
 * The default hue (as in hsl) used for the primary color throughout this theme
 *
 * @return number the default hue
 */
function newspack_get_default_hue() {
	return apply_filters( 'newspack_default_hue', NEWSPACK_DEFAULT_HUE );
}

/**
 * The default saturation (as in hsl) used for the primary color throughout this theme
 *
 * @return number the default saturation
 */
function newspack_get_default_saturation() {
	return apply_filters( 'newspack_default_saturation', NEWSPACK_DEFAULT_SATURATION );
}

/**
 * The default lightness (as in hsl) used for the primary color throughout this theme
 *
 * @return number the default lightness
 */
function newspack_get_default_lightness() {
	return apply_filters( 'newspack_default_lightness', NEWSPACK_DEFAULT_LIGHTNESS );
}

/**
 * The default saturation (as in hsl) used when selecting text throughout this theme
 *
 * @return number the default saturation selection
 */
function newspack_get_default_saturation_selection() {
	return apply_filters( 'newspack_default_saturation_selection', NEWSPACK_DEFAULT_SATURATION_SELECTION );
}

/**
 * The default lightness (as in hsl) used when selecting text throughout this theme
 *
 * @return number the default lightness selection
 */
function newspack_get_default_lightness_selection() {
	return apply_filters( 'newspack_default_lightness_selection', NEWSPACK_DEFAULT_LIGHTNESS_SELECTION );
}

/**
 * The default lightness hover (as in hsl) used when hovering over links throughout this theme
 *
 * @return number the default lightness hover
 */
function newspack_get_default_lightness_hover() {
	return apply_filters( 'newspack_default_lightness_hover', NEWSPACK_DEFAULT_LIGHTNESS_HOVER );
}

/**
 * Tests the current default hue against NEWSPACK_DEFAULT_HUE.
 *
 * @return bool
 */
function newspack_has_custom_default_hue() {
	return newspack_get_default_hue() !== NEWSPACK_DEFAULT_HUE;
}
