<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.com/
 *
 * @package Newspack
 */

/**
 * Set up theme support for Jetpack.
 */
function newspack_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 */
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'newspack_infinite_scroll_render',
			'footer'    => 'page',
			'wrapper'   => false,
		)
	);

	/**
	 * Add theme support for Responsive Videos.
	 */
	add_theme_support( 'jetpack-responsive-videos' );

	/**
	 * Add theme support for geo-location.
	 */
	add_theme_support( 'jetpack-geo-location' );

	/**
	 * Add theme support for Content Options.
	 */
	add_theme_support(
		'jetpack-content-options',
		array(
			'blog-display'    => array(
				'content',
				'excerpt',
			),
			'post-details'    => array(
				'stylesheet' => 'newspack-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline, .author-avatar',
			),
			'featured-images' => array(
				'archive' => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'newspack_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function newspack_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_archive() ) {
			get_template_part( 'template-parts/content/content', 'archive' );
		} else {
			get_template_part( 'template-parts/content/content', 'excerpt' );
		}
	}
}

/**
 * Toggle between click to load or scroll to load for infinite scroll.
 */
function newspack_toggle_infinite_scroll_type() {
	if ( is_active_sidebar( 'footer-1' ) ) {
		return true;
	}
	if ( jetpack_is_mobile( '', true ) && is_active_sidebar( 'sidebar-1' ) ) {
		return true;
	}
	return false;
}
add_filter( 'infinite_scroll_has_footer_widgets', 'newspack_toggle_infinite_scroll_type' );


/**
 * Remove Jetpack Share icons from standard location so they can be moved.
 */
function newspack_remove_jetpack_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'newspack_remove_jetpack_share' );

/**
 * Alter gallery widget default width.
 */
function newspack_gallery_widget_content_width( $width ) {
	return 390;
}
add_filter( 'gallery_widget_content_width', 'newspack_gallery_widget_content_width' );

/**
 * Alter featured-image default visibility for content-options.
 */
function newspack_override_post_thumbnail( $width ) {
	$options         = get_theme_support( 'jetpack-content-options' );
	$featured_images = ( ! empty( $options[0]['featured-images'] ) ) ? $options[0]['featured-images'] : null;

	$settings = array(
		'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
		'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
	);

	$settings = array_merge(
		$settings,
		array(
			'post-option' => get_option(
				'jetpack_content_featured_images_post',
				$settings['post-default']
			),
			'page-option' => get_option(
				'jetpack_content_featured_images_page',
				$settings['page-default']
			),
		)
	);

	if ( ( ! $settings['post-option'] && is_single() )
	|| ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
		return false;
	} else {
		return ! post_password_required() && ! is_attachment() && has_post_thumbnail();
	}
}
add_filter( 'newspack_can_show_post_thumbnail', 'newspack_override_post_thumbnail', 10, 2 );
