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
		'theme_colors',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'newspack_sanitize_color_option',
		)
	);

	$wp_customize->add_control(
		'theme_colors',
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

	// Add primary color hexidecimal setting and control.
	$wp_customize->add_setting(
		'primary_color_hex',
		array(
			'default'           => newspack_get_primary_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_hex',
			array(
				'description' => __( 'Apply a primary custom color.', 'newspack' ),
				'section'     => 'colors',
			)
		)
	);

	// Add secondary color hexidecimal setting and control.
	$wp_customize->add_setting(
		'secondary_color_hex',
		array(
			'default'           => newspack_get_secondary_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color_hex',
			array(
				'description' => __( 'Apply a secondary custom color.', 'newspack' ),
				'section'     => 'colors',
			)
		)
	);

	// Header - add option to hide tagline.
	$wp_customize->add_setting(
		'header_display_tagline',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'newspack_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'header_display_tagline',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display Tagline', 'newspack' ),
			'section' => 'title_tagline',
		)
	);

	// Header - add option to center logo.
	$wp_customize->add_setting(
		'header_center_logo',
		array(
			'default'           => false,
			'sanitize_callback' => 'newspack_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'header_center_logo',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Center Logo', 'newspack' ),
			'description' => esc_html__( 'Check to center the logo in the header.', 'newspack' ),
			'section'     => 'title_tagline',
		)
	);

	// Header - add option for solid background colour.
	$wp_customize->add_setting(
		'header_solid_background',
		array(
			'default'           => false,
			'sanitize_callback' => 'newspack_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'header_solid_background',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Solid Background', 'newspack' ),
			'description' => esc_html__( 'Check to use the primary color as the header background.', 'newspack' ),
			'section'     => 'title_tagline',
		)
	);

	// Header - add option for simplified short header.
	$wp_customize->add_setting(
		'header_simplified',
		array(
			'default'           => false,
			'sanitize_callback' => 'newspack_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'header_simplified',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Simplify Header', 'newspack' ),
			'description' => esc_html__( 'Displays header as a shorter, simpler version.', 'newspack' ),
			'section'     => 'title_tagline',
		)
	);

	// Add option to hide page title on static front page.
	$wp_customize->add_setting(
		'hide_front_page_title',
		array(
			'default'           => false,
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'newspack_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'hide_front_page_title',
		array(
			'label'       => esc_html__( 'Hide Homepage Title', 'newspack' ),
			'description' => esc_html__( 'Check to hide the page title, if your homepage is set to display a static page.', 'newspack' ),
			'section'     => 'static_front_page',
			'priority'    => 10,
			'type'        => 'checkbox',
			'settings'    => 'hide_front_page_title',
		)
	);
}
add_action( 'customize_register', 'newspack_customize_register' );

/**
 * Add custom font support in the Customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspack_customize_typography_register( $wp_customize ) {

	require_once get_parent_theme_file_path( '/inc/typography.php' );

	$wp_customize->add_section(
		'newspack_typography',
		array(
			'title'    => __( 'Typography', 'newspack' ),
			'priority' => 50,
		)
	);

	$wp_customize->add_setting(
		'custom_font_import_code',
		array(
			'sanitize_callback' => 'newspack_sanitize_font_provider_url',
		)
	);
	$wp_customize->add_setting(
		'custom_font_import_code_alternate',
		array(
			'sanitize_callback' => 'newspack_sanitize_font_provider_url',
		)
	);
	$wp_customize->add_setting(
		'font_body',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);
	$wp_customize->add_setting(
		'font_header',
		array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);
	$wp_customize->add_setting(
		'font_body_stack',
		array(
			'sanitize_callback' => 'newspack_sanitize_font_stack',
			'default'           => 'serif',
		)
	);
	$wp_customize->add_setting(
		'font_header_stack',
		array(
			'sanitize_callback' => 'newspack_sanitize_font_stack',
			'default'           => 'serif',
		)
	);

	$wp_customize->add_control(
		'custom_font_import_code',
		array(
			'label'       => __( 'Font Provider Import Code or URL', 'newspack' ),
			'description' => __( 'Example: &lt;link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet"&gt; or https://fonts.googleapis.com/css?family=Open+Sans' ),
			'section'     => 'newspack_typography',
			'type'        => 'text',
		)
	);

	$wp_customize->add_control(
		'custom_font_import_code_alternate',
		array(
			'label'   => __( 'Secondary Font Provider Import Code or URL', 'newspack' ),
			'section' => 'newspack_typography',
			'type'    => 'text',
		)
	);

	$wp_customize->add_control(
		'font_header',
		array(
			'label'       => __( 'Header Font', 'newspack' ),
			'description' => __( 'Example: Open Sans' ),
			'section'     => 'newspack_typography',
			'type'        => 'text',
		)
	);

	$font_stacks = newspack_get_font_stacks_as_select_choices();

	foreach ( $font_stacks as $key => &$stack ) {
		$stack = wp_kses( $stack, null );
	}

	$wp_customize->add_control(
		'font_header_stack',
		array(
			'label'   => __( 'Header Font Fallback Stack', 'newspack' ),
			'section' => 'newspack_typography',
			'type'    => 'select',
			'choices' => $font_stacks,
		)
	);

	$wp_customize->add_control(
		'font_body',
		array(
			'label'   => __( 'Body Font', 'newspack' ),
			'section' => 'newspack_typography',
			'type'    => 'text',
		)
	);

	$wp_customize->add_control(
		'font_body_stack',
		array(
			'label'   => __( 'Body Font Fallback Stack', 'newspack' ),
			'section' => 'newspack_typography',
			'type'    => 'select',
			'choices' => $font_stacks,
		)
	);
}

add_action( 'customize_register', 'newspack_customize_typography_register' );

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
			'default_hex' => newspack_get_primary_color(),
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

/**
 * Sanitize the checkbox.
 *
 * @param boolean $input Value of checkbox.
 *
 * @return boolean true if is 1 or '1', false if anything else
 */
function newspack_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize font provider embed URL.
 *
 * @param string $code Font provider embed code.
 *
 * @return string Return a valid font provider URL if found or false if not.
 */
function newspack_sanitize_font_provider_url( $code ) {
	if ( '' === trim( $code ) ) {
		return '';
	}
	$font_service_urls = array(
		'google'     => 'fonts.googleapis.com',
		'fonts'      => 'fast.fonts.net',
		'typekit'    => 'use.typekit.net',
		'typography' => 'cloud.typography.com',
	);

	$regex = '/\/\/[^\("\') \n]+/i';
	preg_match( $regex, $code, $matches );
	$url = isset( $matches[0] ) ? $matches[0] : null;

	$url_info = wp_parse_url( $url );
	if ( isset( $url_info['host'] ) && in_array( $url_info['host'], array_values( $font_service_urls ) ) ) {
		return $url;
	}
	return null;
}

/**
 * Sanitize font stack ID.
 *
 * @param string $stack_id Font stack ID.
 *
 * @return string Return a valid font stack ID or null.
 */
function newspack_sanitize_font_stack( $stack_id ) {
	$stacks = newspack_get_font_stacks();
	if ( in_array( $stack_id, array_keys( $stacks ) ) ) {
		return $stack_id;
	}
	return null;
}
