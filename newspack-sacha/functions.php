<?php
/**
 * Newspack Sacha functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newspack Sacha
 */


if ( ! function_exists( 'newspack_sacha_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newspack_sacha_setup() {
		// Remove the default editor styles
		remove_editor_styles();
		// Add child theme editor styles, compiled from `style-child-theme-editor.scss`.
		add_editor_style( 'styles/style-editor.css' );
	}
endif;
add_action( 'after_setup_theme', 'newspack_sacha_setup', 12 );

/**
 * Function to load style pack's Google Fonts.
 */
function newspack_sacha_fonts_url() {
	$fonts_url = '';

	/**
	* Translators: If there are characters in your language that are not
	* supported by IBM Plex Serif, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$ibm_plex_serif = esc_html_x( 'on', 'IBM Plex Serif font: on or off', 'newspack-sacha' );
	if ( 'off' !== $ibm_plex_serif ) {
		$font_families   = array();
		$font_families[] = 'IBM Plex Serif:400,400i,700,700i';

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'swap' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}

/**
 * Display custom color CSS in customizer and on frontend.
 */
function newspack_sacha_custom_colors_css_wrap() {
	// Only bother if we haven't customized the color.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'theme_colors', 'default' ) ) || is_admin() ) {
		return;
	}
	require_once get_stylesheet_directory() . '/inc/child-color-patterns.php';
	?>

	<style type="text/css" id="custom-theme-colors-sacha">
		<?php echo newspack_sacha_custom_colors_css(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</style>
	<?php
}
add_action( 'wp_head', 'newspack_sacha_custom_colors_css_wrap' );

/**
 * Display custom font CSS in customizer and on frontend.
 */
function newspack_sacha_typography_css_wrap() {
	if ( is_admin() || ( ! get_theme_mod( 'font_body', '' ) && ! get_theme_mod( 'font_header', '' ) && ! get_theme_mod( 'accent_allcaps', true ) ) ) {
		return;
	}
	?>

	<style type="text/css" id="custom-theme-fonts-sacha">
		<?php echo newspack_sacha_custom_typography_css(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</style>

<?php
}
add_action( 'wp_head', 'newspack_sacha_typography_css_wrap' );


/**
 * Enqueue scripts and styles.
 */
function newspack_sacha_scripts() {
	// Enqueue Google fonts.
	wp_enqueue_style( 'newspack-sacha-fonts', newspack_sacha_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'newspack_sacha_scripts' );


/**
 * Enqueue supplemental block editor styles.
 */
function newspack_sacha_editor_customizer_styles() {
	// Enqueue Google fonts.
	wp_enqueue_style( 'newspack-sacha-fonts', newspack_sacha_fonts_url(), array(), null );

	// Check for color or font customizations.
	$theme_customizations = '';
	require_once get_stylesheet_directory() . '/inc/child-color-patterns.php';

	if ( 'custom' === get_theme_mod( 'theme_colors' ) ) {
		// Include color patterns.
		$theme_customizations .= newspack_sacha_custom_colors_css();
	}

	if ( get_theme_mod( 'font_body', '' ) || get_theme_mod( 'font_header', '' ) || get_theme_mod( 'accent_allcaps', true ) ) {
		$theme_customizations .= newspack_sacha_custom_typography_css();
	}

	// If there are any, add those styles inline.
	if ( $theme_customizations ) {
		// Enqueue a non-existant file to hook our inline styles to:
		wp_register_style( 'newspack-sacha-editor-inline-styles', false );
		wp_enqueue_style( 'newspack-sacha-editor-inline-styles' );
		// Add inline styles:
		wp_add_inline_style( 'newspack-sacha-editor-inline-styles', $theme_customizations );
	}

	// Enqueue CSS styles for the editor that use the <body> tag.
	wp_enqueue_style( 'newspack-sacha-editor-overrides', get_theme_file_uri( '/styles/child-style-editor-overrides.css' ), array(), null, 'all' );

}
add_action( 'enqueue_block_editor_assets', 'newspack_sacha_editor_customizer_styles' );

/**
 * Custom typography styles for child theme.
 */

require get_stylesheet_directory() . '/inc/child-typography.php';

/**
 * Customizer functions.
 */
require get_stylesheet_directory() . '/inc/child-customizer.php';
