<?php
/**
 * Newspack Theme: Add Logo Size option in the customizer.
 *
 * @package Newspack
 */

/**
 * Registers customizer controls for the logo resizer.
 */
function newspack_logo_resizer_customize_register( $wp_customize ) {
	// Logo Resizer additions
	$wp_customize->add_setting(
		'logo_size',
		array(
			'default'              => 50,
			'type'                 => 'theme_mod',
			'theme_supports'       => 'custom-logo',
			'transport'            => 'postMessage',
			'sanitize_callback'    => 'absint',
			'sanitize_js_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'logo_size',
		array(
			'label'       => esc_html__( 'Logo Size', 'newspack' ),
			'section'     => 'title_tagline',
			'priority'    => 8,
			'type'        => 'range',
			'settings'    => 'logo_size',
			'input_attrs' => array(
				'step'             => 5,
				'min'              => 0,
				'max'              => 100,
				'aria-valuemin'    => 0,
				'aria-valuemax'    => 100,
				'aria-valuenow'    => 50,
				'aria-orientation' => 'horizontal',
			),
		)
	);
}
add_action( 'customize_register', 'newspack_logo_resizer_customize_register' );

/**
 * Add support for logo resizing by filtering `get_custom_logo`.
 */
function newspack_customize_logo_resize( $html ) {
	$size           = get_theme_mod( 'logo_size' );
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	// set the short side minimum
	$min = 48;

	// don't use empty() because we can still use a 0
	if ( is_numeric( $size ) && is_numeric( $custom_logo_id ) ) {

		// we're looking for $img['width'] and $img['height'] of original image
		$logo = wp_get_attachment_metadata( $custom_logo_id );
		if ( ! $logo ) {
			return $html;
		}

		// get the logo support size
		$sizes = get_theme_support( 'custom-logo' );

		$logo_max_width = ( $logo['width'] > 600 ) ? 600 : $logo['width'];

		// Check for max height and width, default to image sizes if none set in theme
		$max['height'] = isset( $sizes[0]['height'] ) ? $sizes[0]['height'] : $logo['height'];
		$max['width']  = isset( $sizes[0]['width'] ) ? $sizes[0]['width'] : $logo_max_width;

		// landscape or square
		if ( $logo['width'] >= $logo['height'] ) {
			$output = newspack_logo_resize_min_max(
				$logo['height'],
				$logo['width'],
				$max['height'],
				$max['width'],
				$size,
				$min
			);
			$img    = array(
				'height' => $output['short'],
				'width'  => $output['long'],
			);
		// portrait
		} elseif ( $logo['width'] < $logo['height'] ) {
			$output = newspack_logo_resize_min_max( $logo['width'], $logo['height'], $max['width'], $max['height'], $size, $min );
			$img    = array(
				'height' => $output['long'],
				'width'  => $output['short'],
			);
		}

		$mobile_max_width  = 175;
		$mobile_max_height = 65;

		$subhead_max_width  = 200;
		$subhead_max_height = 60;

		$mobile  = newspack_logo_small_sizes( $img['width'], $img['height'], $mobile_max_width, $mobile_max_height );
		$subhead = newspack_logo_small_sizes( $img['width'], $img['height'], $subhead_max_width, $subhead_max_height );

		// add the CSS
		$css = '
		<style>
		.site-header .custom-logo {
			height: ' . $img['height'] . 'px;
			max-height: ' . $max['height'] . 'px;
			max-width: ' . $max['width'] . 'px;
			width: ' . $img['width'] . 'px;
		}

		@media (max-width: 781px) {
			.site-header .custom-logo {
				max-width: ' . $mobile['width'] . 'px;
				max-height: ' . $mobile['height'] . 'px;
			}
		}

		@media (min-width: 782px) {
			.h-sub .site-header .custom-logo {
				max-width: ' . $subhead['width'] . 'px;
				max-height: ' . $subhead['height'] . 'px;
			}
		}
		</style>';

		$html = $css . $html;
	}

	return $html;
}
add_filter( 'get_custom_logo', 'newspack_customize_logo_resize' );

/**
 * Helper function to determine the max size of the logo
 */
function newspack_logo_resize_min_max( $short, $long, $short_max, $long_max, $percent, $min ) {
	$ratio        = ( $long / $short );
	$max['long']  = ( $long_max >= $long ) ? $long : $long_max;
	$max['short'] = ( $short_max >= ( $max['long'] / $ratio ) ) ? floor( $max['long'] / $ratio ) : $short_max;

	$ppp = ( $max['short'] - $min ) / 100;

	$size['short'] = round( $min + ( $percent * $ppp ) );
	$size['long']  = round( $size['short'] / ( $short / $long ) );

	return $size;
}

/**
 * Helper function to return smaller version of the logo size
 */
function newspack_logo_small_sizes( $width, $height, $max_width, $max_height ) {
	$size = array(
		'width'  => round( $max_height * ( $width / $height ) ),
		'height' => $max_height,
	);

	if ( $size['width'] > $max_width ) {
		$size['height'] = round( $max_width * ( $height / $width ) );
		$size['width']  = $max_width;
	}

	return $size;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newspack_logo_resizer_customize_preview_js() {
	wp_enqueue_script( 'newspack-logo-resizer-customizer', get_template_directory_uri() . '/js/dist/logo-customize-preview.js', array( 'jquery', 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'newspack_logo_resizer_customize_preview_js' );

/**
 * JS handlers for Customizer Controls
 */
function newspack_logo_resizer_customize_controls_js() {
	wp_enqueue_script( 'newspack-logo-resizer-customizer-controls', get_template_directory_uri() . '/js/dist/logo-customize-controls.js', array( 'jquery', 'customize-controls' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'newspack_logo_resizer_customize_controls_js' );

/**
 * Adds CSS to the Customizer controls.
 */
function newspack_logo_resizer_customize_css() {
	wp_add_inline_style( 'customize-controls', '#customize-control-logo_size input[type="range"] { width: 100%; }' );
}
add_action( 'customize_controls_enqueue_scripts', 'newspack_logo_resizer_customize_css' );
