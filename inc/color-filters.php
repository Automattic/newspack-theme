<?php
/**
 * Newspack Theme: Color Filter for overriding the colors schemes in a child theme
 *
 * @package Newspack
 */

/**
 * Define default color filters.
 */
define( 'NEWSPACK_DEFAULT_PRIMARY', '#3366ff' ); // Hex
define( 'NEWSPACK_DEFAULT_PRIMARY_VARIATION', '#2240d5' ); // Hex
define( 'NEWSPACK_DEFAULT_SECONDARY', '#666666' ); // Hex

/**
 * The default color used for the primary color throughout this theme
 *
 * @return string the default hexidecimal color.
 */
function newspack_get_primary_color() {
	/**
	 * Default primary color.
	 *
	 * Sets the default primary color for the theme's custom colors.
	 *
	 * @since 1.0.0
	 *
	 * @param string $value Sets a hexidecimal color; uses theme default defined above.
	 */
	return apply_filters( 'newspack_primary_color', NEWSPACK_DEFAULT_PRIMARY );
}

/**
 * The default color used for the primary color variation throughout this theme
 *
 * @return string the default hexidecimal color.
 */
function newspack_get_primary_color_variation() {
	/**
	 * Default primary color variation.
	 *
	 * Sets the default primary color variation for the theme's custom colors.
	 *
	 * @since 1.0.0
	 *
	 * @param string $value Sets a hexidecimal color; uses theme default defined above.
	 */
	return apply_filters( 'newspack_primary_color_variation', NEWSPACK_DEFAULT_PRIMARY_VARIATION );
}

/**
 * The default color used for the secondary color throughout this theme
 *
 * @return string the default hexidecimal color.
 */
function newspack_get_secondary_color() {
	/**
	 * Default secondary color.
	 *
	 * Sets the default secondary color for the theme's custom colors.
	 *
	 * @since 1.0.0
	 *
	 * @param string $value Sets a hexidecimal color; uses theme default defined above.
	 */
	return apply_filters( 'newspack_secondary_color', NEWSPACK_DEFAULT_SECONDARY );
}

/**
 * Tests the current default hue against NEWSPACK_DEFAULT_PRIMARY.
 *
 * @return bool
 */
function newspack_has_custom_primary_color() {
	return newspack_get_primary_color() !== NEWSPACK_DEFAULT_PRIMARY;
}

/**
 * Tests the current default hue against NEWSPACK_DEFAULT_SECONDARY.
 *
 * @return bool
 */
function newspack_has_custom_secondary_color() {
	return newspack_get_secondary_color() !== NEWSPACK_DEFAULT_SECONDARY;
}
