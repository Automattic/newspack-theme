<?php
/**
 * Newspack Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newspack
 */

/**
 * Newspack Theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'newspack_is_amp' ) ) {
	/**
	 * Determine whether it is an AMP response.
	 *
	 * @return bool Whether AMP.
	 */
	function newspack_is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}
}

if ( ! function_exists( 'newspack_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newspack_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Newspack Theme, use a find and replace
		 * to change 'newspack' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newspack', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		add_image_size( 'newspack-featured-image', 1200, 9999 );
		add_image_size( 'newspack-archive-image', 800, 600, true );
		add_image_size( 'newspack-footer-logo', 400, 9999, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary-menu'   => __( 'Primary Menu', 'newspack' ),
				'secondary-menu' => __( 'Secondary Menu', 'newspack' ),
				'tertiary-menu'  => __( 'Tertiary Menu', 'newspack' ),
				'highlight-menu' => __( 'Topic Highlight Menu', 'newspack' ),
				'social'         => __( 'Social Links Menu', 'newspack' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => array( 'site-title' ),
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'styles/style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'newspack' ),
					'shortName' => __( 'S', 'newspack' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'newspack' ),
					'shortName' => __( 'M', 'newspack' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'newspack' ),
					'shortName' => __( 'L', 'newspack' ),
					'size'      => 36,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'newspack' ),
					'shortName' => __( 'XL', 'newspack' ),
					'size'      => 44,
					'slug'      => 'huge',
				),
			)
		);

		$primary_color           = newspack_get_primary_color();
		$primary_color_variation = newspack_get_primary_color_variation();
		$secondary_color         = newspack_get_secondary_color();

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'newspack' ),
					'slug'  => 'primary',
					'color' => 'default' === get_theme_mod( 'theme_colors' ) ?
						$primary_color :
						get_theme_mod( 'primary_color_hex', $primary_color ),
				),
				array(
					'name'  => __( 'Primary Variation', 'newspack' ),
					'slug'  => 'primary-variation',
					'color' => 'default' === get_theme_mod( 'theme_colors' ) ?
						$primary_color_variation :
						newspack_adjust_brightness( get_theme_mod( 'primary_color_hex', $primary_color ), -40 ),
				),
				array(
					'name'  => __( 'Secondary', 'newspack' ),
					'slug'  => 'secondary',
					'color' => 'default' === get_theme_mod( 'theme_colors' ) ?
						$secondary_color :
						get_theme_mod( 'secondary_color_hex', $secondary_color ),
				),
				array(
					'name'  => __( 'Secondary Variation', 'newspack' ),
					'slug'  => 'secondary-variation',
					'color' => 'default' === get_theme_mod( 'theme_colors' ) ?
						newspack_adjust_brightness( $secondary_color, -40 ) :
						newspack_adjust_brightness( get_theme_mod( 'secondary_color_hex', $secondary_color ), -40 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'newspack' ),
					'slug'  => 'dark-gray',
					'color' => '#111', // color__text-main
				),
				array(
					'name'  => __( 'Medium Gray', 'newspack' ),
					'slug'  => 'medium-gray',
					'color' => '#767676', // color__text-light
				),
				array(
					'name'  => __( 'Light Gray', 'newspack' ),
					'slug'  => 'light-gray',
					'color' => '#eee', // color__background-pre
				),
				array(
					'name'  => __( 'White', 'newspack' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Make our theme AMP/PWA Native
		add_theme_support( 'amp' , [
			'service_worker' => [
				'cdn_script_caching'   => true,
				'google_fonts_caching' => true,
			],
		] );

		// Add custom theme support - post subtitle
		add_theme_support( 'post-subtitle' );
	}
endif;
add_action( 'after_setup_theme', 'newspack_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newspack_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'newspack' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'newspack' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title accent-header"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'newspack' ),
			'id'            => 'footer-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'newspack' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Above Copyright', 'newspack' ),
			'id'            => 'footer-2',
			'description'   => __( 'Add widgets here to appear below the footer, above the copyright information.', 'newspack' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Article above content', 'newspack' ),
			'id'            => 'article-1',
			'description'   => __( 'Add widgets here to appear above article content.', 'newspack' ),
			'before_widget' => '<section id="%1$s" class="above-content widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Article below content', 'newspack' ),
			'id'            => 'article-2',
			'description'   => __( 'Add widgets here to appear below article content.', 'newspack' ),
			'before_widget' => '<section id="%1$s" class="below-content widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'newspack_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function newspack_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'newspack_content_width', 960 );
}
add_action( 'after_setup_theme', 'newspack_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function newspack_scripts() {
	wp_enqueue_style( 'newspack-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'newspack-style', 'rtl', 'replace' );

	wp_enqueue_style( 'newspack-print-style', get_template_directory_uri() . '/styles/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( ! newspack_is_amp() ) {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$newspack_l10n = array(
			'open_search'  => esc_html__( 'Open Search', 'newspack' ),
			'close_search' => esc_html__( 'Close Search', 'newspack' ),
		);

		wp_enqueue_script( 'newspack-amp-fallback', get_theme_file_uri( '/js/dist/amp-fallback.js' ), array(), '1.0', true );
		wp_localize_script( 'newspack-amp-fallback', 'newspackScreenReaderText', $newspack_l10n );
	}
	// Load custom fonts, if any.
	if ( get_theme_mod( 'custom_font_import_code', '' ) ) {
		wp_enqueue_style( 'newspack-font-import', newspack_custom_typography_link( 'custom_font_import_code' ), array(), null );
	}

	if ( get_theme_mod( 'custom_font_import_code_alternate', '' ) ) {
		wp_enqueue_style( 'newspack-font-alternative-import', newspack_custom_typography_link( 'custom_font_import_code_alternate' ), array(), null );
	}

}
add_action( 'wp_enqueue_scripts', 'newspack_scripts' );

/**
 * Enqueue scripts for:
 * - Featured Image position option
 * - Article Subtitle
 */
function newspack_enqueue_scripts() {
	wp_enqueue_script( 'newspack-extend-featured-image-script', get_theme_file_uri( '/js/dist/extend-featured-image-editor.js' ), array( 'wp-blocks', 'wp-components' ), wp_get_theme()->get( 'Version' ) );

	if ( 'post' === get_current_screen()->post_type ) {
		wp_enqueue_script( 'newspack-post-subtitle', get_theme_file_uri( '/js/dist/post-subtitle.js' ), array(), wp_get_theme()->get( 'Version' ), true );
	}
}
add_action( 'enqueue_block_editor_assets', 'newspack_enqueue_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function newspack_skip_link_focus_fix() {
	// Bail if this is an AMP page, because AMP already handles this bug.
	if ( newspack_is_amp() ) {
		return;
	}

	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'newspack_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function newspack_editor_customizer_styles() {

	wp_enqueue_style( 'newspack-editor-customizer-styles', get_theme_file_uri( '/styles/style-editor-customizer.css' ), false, '1.1', 'all' );

	// Check for color or font customizations.
	$theme_customizations = '';
	if ( 'custom' === get_theme_mod( 'theme_colors' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		$theme_customizations .= newspack_custom_colors_css();
	}

	if ( get_theme_mod( 'font_body', '' ) || get_theme_mod( 'font_header', '' ) || get_theme_mod( 'accent_allcaps', true ) ) {
		$theme_customizations .= newspack_custom_typography_css();
	}

	// If there are any, add those styles inline.
	if ( $theme_customizations ) {
		wp_add_inline_style( 'newspack-editor-customizer-styles', $theme_customizations );
	}

	// If custom fonts are assigned, enqueue them as well.
	if ( get_theme_mod( 'custom_font_import_code', '' ) ) {
		wp_enqueue_style( 'newspack-font-import', newspack_custom_typography_link( 'custom_font_import_code' ), array(), null );
	}
	if ( get_theme_mod( 'custom_font_import_code_alternate', '' ) ) {
		wp_enqueue_style( 'newspack-font-alternative-import', newspack_custom_typography_link( 'custom_font_import_code_alternate' ), array(), null );
	}

}
add_action( 'enqueue_block_editor_assets', 'newspack_editor_customizer_styles' );

/**
 * Determine if current editor page is the static front page.
 */
function newspack_is_static_front_page() {
	global $post;
	$page_on_front = intval( get_option( 'page_on_front' ) );
	return isset( $post->ID ) && intval( $post->ID ) === $page_on_front;
}

/**
 * Check if the current style pack is a particular option.
 *
 * Pass in a style pack slug or list of slugs separated by commas (default|style-1|style-2|style-3|style-4)
 *
 * @return bool If current style pack is one of the passed options.
 */
function newspack_is_active_style_pack() {
	$args              = func_get_args();
	$active_style_pack = get_theme_mod( 'active_style_pack', 'default' );
	return in_array( $active_style_pack, $args );
}

/**
 * Check for specific templates.
 */
function newspack_check_current_template() {
	global $post;

	$template_file = ( $post && $post->ID ) ? get_post_meta( $post->ID, '_wp_page_template', true ) : '';

	return $template_file;
}

/**
 * Add body class on editor pages if editing the static front page.
 */
function newspack_filter_admin_body_class( $classes ) {

	if ( newspack_is_static_front_page() ) {
		$classes .= ' newspack-static-front-page';
	}

	if ( 'default' !== get_theme_mod( 'active_style_pack', 'default' ) ) {
		$classes .= ' style-pack-' . get_theme_mod( 'active_style_pack', 'default' );
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes .= ' no-sidebar';
	}

	if ( 'single-feature.php' === newspack_check_current_template() ) {
		$classes .= ' newspack-single-column-template';
	} elseif ( 'single-wide.php' === newspack_check_current_template() ) {
		$classes .= ' newspack-single-wide-template';
	} else {
		$classes .= ' newspack-default-template';
	}

	return $classes;
}
add_filter( 'admin_body_class', 'newspack_filter_admin_body_class', 10, 1 );


/**
 * Enqueue CSS styles for the editor that use the <body> tag.
 */
function newspack_enqueue_editor_override_assets( $classes ) {
	wp_enqueue_style( 'newspack-editor-overrides', get_theme_file_uri( '/styles/style-editor-overrides.css' ), false, '1.1', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'newspack_enqueue_editor_override_assets' );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function newspack_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'newspack_front_page_template' );

/**
 * Register meta fields:
 * - Featured Image position option
 * - Article Subtitle
 */
function newspack_register_meta() {
	register_meta(
		'post',
		'newspack_featured_image_position',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
		)
	);

	register_post_meta(
		'post',
		'newspack_post_subtitle',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'string',
		)
	);
}
add_action( 'init', 'newspack_register_meta' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function newspack_colors_css_wrap() {

	// Only bother if we haven't customized the color.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'theme_colors', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = newspack_get_primary_color();
	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hex', $primary_color );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-primary="' . esc_attr( $primary_color ) . '"' : ''; ?>>
		<?php echo newspack_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'newspack_colors_css_wrap' );

/**
 * Display custom font CSS in customizer and on frontend.
 */
function newspack_typography_css_wrap() {

	if ( is_admin() || ( ! get_theme_mod( 'font_body', '' ) && ! get_theme_mod( 'font_header', '' ) && ! get_theme_mod( 'accent_allcaps', true ) ) ) {
		return;
	}
	?>

	<style type="text/css" id="custom-theme-fonts">
		<?php echo wp_kses( newspack_custom_typography_css(), '' ); ?>
	</style>

<?php
}
add_action( 'wp_head', 'newspack_typography_css_wrap' );

/**
 * Returns an array of 'acceptable' SVG tags to use with wp_kses().
 */
function newspack_sanitize_svgs() {
	$svg_args = array(
		'svg'   => array(
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
		),
		'g'     => array(
			'fill' => true,
		),
		'title' => array(
			'title' => true,
		),
		'path'  => array(
			'd'    => true,
			'fill' => true,
		),
	);

	return $svg_args;
}

/**
 * Truncates text to a specific character length, without breaking a character.
 */
function newspack_truncate_text( $content, $length, $after = '...' ) {
	// If content is already shorter than the truncate length, return it.
	if ( strlen( $content ) <= $length ) {
		return $content;
	}

	// Find the first space after the desired length:
	$breakpoint = strpos( $content, ' ', $length );

	// Make sure $breakpoint isn't returning false, and is less than length of content:
	if ( false !== $breakpoint && $breakpoint < strlen( $content ) - 1 ) {
		$content = substr( $content, 0, $breakpoint ) . $after;
	}
	return $content;
}

 /**
 * Returns an array of 'acceptable' avatar tags, to use with wp_kses().
 */
function newspack_sanitize_avatars() {
	$avatar_args = array(
		'img' => array(
			'class'  => true,
			'src'    => true,
			'alt'    => true,
			'width'  => true,
			'height' => true,
			'data-*' => true,
			'srcset' => true,
		),
		'noscript' => array(),
	);

	return $avatar_args;
}

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-newspack-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-newspack-walker-comment.php';

/**
 * Style pack class.
 */
require get_template_directory() . '/classes/class-newspack-style-packs-core.php';
require get_template_directory() . '/inc/style-packs.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Default color filters.
 */
require get_template_directory() . '/inc/color-filters.php';

/**
 * Custom typography functions.
 */
require get_template_directory() . '/inc/typography.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Logo Resizer.
 */
require get_template_directory() . '/inc/logo-resizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
