<?php
/**
 * Web Stories Compatibility File
 *
 * @link https://wp.stories.google/
 *
 * @package Newspack
 */

/**
 * Add theme support for Web Stories.
 *
 * @return void
 */
function newspack_web_stories_setup() {
	add_theme_support( 'web-stories' );
}
add_action( 'after_setup_theme', 'newspack_web_stories_setup' );

/**
 * Custom render function for Web Stories embedding.
 */
function newspack_web_stories_embed() {
	if ( function_exists( '\Google\Web_Stories\render_theme_stories' ) ) {
		\Google\Web_Stories\render_theme_stories();
	}
}
add_action( 'wp_body_open', 'newspack_web_stories_embed' );
