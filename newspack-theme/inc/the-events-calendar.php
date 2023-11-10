<?php
/**
 * The Events Calendar Compatibility File
 *
 * @link https://theeventscalendar.com/
 *
 * @package Newspack
 */

/**
 * Add a Customizer option to display the sidebar in the default Events template.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newspack_tec_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'newspack_tec_options',
		array(
			'title' => esc_html__( 'Newspack Options', 'newspack' ),
			'panel' => 'tribe_customizer',
		)
	);

	$wp_customize->add_setting(
		'newspack_tec_sidebar_single',
		array(
			'default'           => false,
			'sanitize_callback' => 'newspack_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'newspack_tec_sidebar_single',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show sidebar on single events', 'newspack' ),
			'section' => 'newspack_tec_options',
		)
	);
}
add_action( 'customize_register', 'newspack_tec_customize_register' );

/**
 * Show sidebar on this page
 */
function newspack_tec_show_sidebar() {
	$show_sidebar = false;
	if ( function_exists( 'tribe_is_event' ) && tribe_is_event() && is_single() && true === get_theme_mod( 'newspack_tec_sidebar_single', false ) ) {
		$show_sidebar = true;
	}

	return $show_sidebar;
}

/**
 * Add CSS Class when sidebar is enabled.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newspack_tec_body_classes( $classes ) {
	if ( newspack_tec_show_sidebar() ) :
		$classes[] = 'tec-sidebar';
	endif;
	return $classes;
}
add_filter( 'body_class', 'newspack_tec_body_classes' );
