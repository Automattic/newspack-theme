<?php
/**
 * Newspack Theme: Customizer
 *
 * @package Newspack
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspack_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_text' )->label          = __( 'Display Site Title', 'newspack' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'newspack_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'newspack_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Primary color.
	 */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => 'default',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'newspack_sanitize_color_option',
		)
	);

	$wp_customize->add_control(
		'primary_color',
		array(
			'type'     => 'radio',
			'label'    => __( 'Primary Color', 'newspack' ),
			'choices'  => array(
				'default' => _x( 'Default', 'primary color', 'newspack' ),
				'custom'  => _x( 'Custom', 'primary color', 'newspack' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);

	// Add primary color hue setting and control.
	$wp_customize->add_setting(
		'primary_color_hue',
		array(
			'default'           => newspack_get_default_hue(),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_hue',
			array(
				'description' => __( 'Apply a custom color for buttons, links, featured images, etc.', 'newspack' ),
				'section'     => 'colors',
				'mode'        => 'hue',
			)
		)
	);
}
add_action( 'customize_register', 'newspack_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function newspack_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function newspack_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function newspack_customize_preview_js() {
	wp_enqueue_script( 'newspack-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '20181231', true );
	wp_localize_script(
		'newspack-customize-preview',
		'_NewspackThemePreviewData',
		array(
			'default_hue' => newspack_get_default_hue(),
		)
	);
}
add_action( 'customize_preview_init', 'newspack_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function newspack_panels_js() {
	wp_enqueue_script( 'newspack-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'newspack_panels_js' );

/**
 * Sanitize custom color choice.
 *
 * @param string $choice Whether image filter is active.
 *
 * @return string
 */
function newspack_sanitize_color_option( $choice ) {
	$valid = array(
		'default',
		'custom',
	);

	if ( in_array( $choice, $valid, true ) ) {
		return $choice;
	}

	return 'default';
}
