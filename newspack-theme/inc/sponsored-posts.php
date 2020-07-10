<?php
/**
 * Newspack Theme: Functions for sponsored content plugin.
 *
 * @package Newspack
 */
/**
 * Prepend categroy with 'sponsored' text.
 */
function newspack_sponsor_label( $before = '', $after = '' ) {
	echo wp_kses_post( $before ) . '<span class="sponsored-cat">' . esc_html__( 'Sponsored', 'newspack' ) . '</span>' . wp_kses_post( $after );
}

/**
 * Placeholder for sponsor name.
 */
function newspack_sponsor_name() {
	return 'Sponsor Name';
}

/**
 * Placeholder for sponsor URL.
 */
function newspack_sponsor_url() {
	return 'https://google.com';
}

/**
 * Placeholder for sponsor Logo.
 */
function newspack_sponsor_logo( $width = '45', $height = '45', $class = 'avatar' ) {
	$logo_url = 'https://i2.wp.com/newspack-model-home.newspackstaging.com/wp-content/uploads/2020/04/newspack-logo.png?width=80';
	return '<img class="' . esc_attr( $class ) . '" src="' . esc_url( $logo_url ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '">';
}

/**
 * Returns array of allowed HTML tags to sanitize newspack_sponsor_logo().
 */
function newspack_sponsor_logo_allowed_tags() {
	$logo_args = array(
		'img' => array(
			'class'  => true,
			'src'    => true,
			'width'  => true,
			'height' => true,
		),
	);

	return $logo_args;
}

/**
 * Placeholder for sponsor bio.
 */
function newspack_sponsor_info() {
	return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris purus urna, vulputate at
	convallis hendrerit, mattis id mi. Nulla mauris justo, sodales vitae sodales nec, fermentum at elit.
	Proin condimentum risus sed venenatis mollis. Donec auctor euismod sodales. Donec sodales congue metus,
	sit amet tempor odio maximus in. Ut vestibulum nisl a maximus scelerisque. Donec aliquam eleifend metus,
	eget iaculis ante vestibulum id. Nulla facilisi. Nullam interdum sagittis accumsan. Phasellus egestas
	elementum enim nec condimentum. Sed mattis purus odio. Curabitur vehicula rutrum porttitor.';
}

/**
 * Add body class to sponsored post.
 */
function newspack_sponsor_body_classes( $classes ) {
	$classes[] = 'sponsored-content';
	return $classes;
}
add_filter( 'body_class', 'newspack_sponsor_body_classes' );
