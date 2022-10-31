<?php
/**
 * Newspack Theme back compat functionality
 *
 * Prevents Newspack Theme from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Newspack
 */

/**
 * Prevent switching to Newspack Theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Newspack Theme 1.0.0
 */
function newspack_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	add_action( 'admin_notices', 'newspack_upgrade_notice' );
}
add_action( 'after_switch_theme', 'newspack_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Newspack Theme on WordPress versions prior to 4.7.
 *
 * @since Newspack Theme 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function newspack_upgrade_notice() {
	/* translators: %s: WordPress version used by current site. */
	$message = sprintf( __( 'Newspack Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'newspack' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Newspack Theme 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function newspack_customize() {
	wp_die(
		sprintf(
			/* translators: %s: WordPress version used by current site. */
			esc_html__( 'Newspack Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'newspack' ),
			esc_html( $GLOBALS['wp_version'] )
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'newspack_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Newspack Theme 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function newspack_preview() {
	if ( isset( $_GET['preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: WordPress version used by current site. */
		wp_die( sprintf( esc_html__( 'Newspack Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'newspack' ), esc_html( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'newspack_preview' );
