<?php
/**
 * Newspack Joseph functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newspack Joseph
 */


if ( ! function_exists( 'newspack_joseph_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newspack_joseph_setup() {
		// Remove the default editor styles
		remove_editor_styles();
		// Add child theme editor styles, compiled from `style-child-theme-editor.scss`.
		add_editor_style( 'styles/style-editor.css' );
	}
endif;
add_action( 'after_setup_theme', 'newspack_joseph_setup', 12 );

/**
 * Function to load style pack's Google Fonts.
 */
function newspack_joseph_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Old Standard TT, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$old_standard_tt = esc_html_x( 'on', 'Old Standard TT font: on or off', 'newspack-joseph' );

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by EB Garamond, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$eb_garamond = esc_html_x( 'on', 'EB Garamond: on or off', 'newspack-joseph' );

	if ( 'off' !== $old_standard_tt || 'off' !== $eb_garamond ) {

		$font_families = array();

		if ( 'off' !== $old_standard_tt ) {
			$font_families[] = 'Old Standard TT:400,400i,700';
		}

		if ( 'off' !== $eb_garamond ) {
			$font_families[] = 'EB Garamond:400,400i,700,700i';
		}

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
function newspack_joseph_custom_colors_css_wrap() {
	// Only bother if we haven't customized the color.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'theme_colors', 'default' ) ) || is_admin() ) {
		return;
	}
	require_once get_stylesheet_directory() . '/inc/child-color-patterns.php';
	?>

	<style type="text/css" id="custom-theme-colors-joseph">
		<?php echo newspack_joseph_custom_colors_css(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</style>
	<?php
}
add_action( 'wp_head', 'newspack_joseph_custom_colors_css_wrap' );

/**
 * Display custom font CSS in customizer and on frontend.
 */
function newspack_joseph_typography_css_wrap() {
	if ( is_admin() || ( ! get_theme_mod( 'font_body', '' ) && ! get_theme_mod( 'font_header', '' ) && ! get_theme_mod( 'accent_allcaps', true ) ) ) {
		return;
	}
	?>

	<style type="text/css" id="custom-theme-fonts-joseph">
		<?php echo newspack_joseph_custom_typography_css(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</style>

<?php
}
add_action( 'wp_head', 'newspack_joseph_typography_css_wrap' );


/**
 * Enqueue scripts and styles.
 */
function newspack_joseph_scripts() {
	// Dequeue parent styles
	wp_dequeue_style( 'newspack-style' );
	// Enqueue Google fonts.
	wp_enqueue_style( 'newspack-joseph-fonts', newspack_joseph_fonts_url(), array(), null );
	// Enqueue child styles
	wp_enqueue_style( 'newspack-joseph-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	// Enqueue child RTL styles
	wp_style_add_data( 'newspack-joseph-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'newspack_joseph_scripts', 99 );


/**
 * Enqueue supplemental block editor styles.
 */
function newspack_joseph_editor_customizer_styles() {
	// Enqueue Google fonts.
	wp_enqueue_style( 'newspack-joseph-fonts', newspack_joseph_fonts_url(), array(), null );

	// Check for color or font customizations.
	$theme_customizations = '';
	require_once get_stylesheet_directory() . '/inc/child-color-patterns.php';

	if ( 'custom' === get_theme_mod( 'theme_colors' ) ) {
		// Include color patterns.
		$theme_customizations .= newspack_joseph_custom_colors_css();
	}

	if ( get_theme_mod( 'font_body', '' ) || get_theme_mod( 'font_header', '' ) || get_theme_mod( 'accent_allcaps', true ) ) {
		$theme_customizations .= newspack_joseph_custom_typography_css();
	}

	// If there are any, add those styles inline.
	if ( $theme_customizations ) {
		// Enqueue a non-existant file to hook our inline styles to:
		wp_register_style( 'newspack-joseph-editor-inline-styles', false );
		wp_enqueue_style( 'newspack-joseph-editor-inline-styles' );
		// Add inline styles:
		wp_add_inline_style( 'newspack-joseph-editor-inline-styles', $theme_customizations );
	}
}
add_action( 'enqueue_block_editor_assets', 'newspack_joseph_editor_customizer_styles' );

/**
 * Custom typography styles for child theme.
 */

require get_stylesheet_directory() . '/inc/child-typography.php';

/**
 * Customizer functions.
 */
require get_stylesheet_directory() . '/inc/child-customizer.php';
