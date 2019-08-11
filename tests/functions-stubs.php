<?php

/**
 * Determine whether it is an AMP response.
 *
 * @return bool Whether AMP.
 */
function newspack_is_amp()
{
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newspack_setup()
{
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newspack_widgets_init()
{
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function newspack_content_width()
{
}
/**
 * Enqueue scripts and styles.
 */
function newspack_scripts()
{
}
/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function newspack_skip_link_focus_fix()
{
}
/**
 * Enqueue supplemental block editor styles.
 */
function newspack_editor_customizer_styles()
{
}
/**
 * Determine if current editor page is the static front page.
 */
function newspack_is_static_front_page()
{
}
/**
 * Add body class on editor pages if editing the static front page.
 */
function newspack_filter_admin_body_class($classes)
{
}
/**
 * Enqueue CSS styles for the editor that use the <body> tag.
 */
function newspack_enqueue_editor_override_assets($classes)
{
}
/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function newspack_front_page_template($template)
{
}
/**
 * Display custom color CSS in customizer and on frontend.
 */
function newspack_colors_css_wrap()
{
}
/**
 * Display custom font CSS in customizer and on frontend.
 */
function newspack_typography_css_wrap()
{
}
/**
 * Returns an array of 'acceptable' SVG tags to use with wp_kses().
 */
function newspack_sanitize_svgs()
{
}
