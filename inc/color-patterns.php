<?php
/**
 * Newspack Theme: Color Patterns
 *
 * @package Newspack
 */

/**
 * Generate the CSS for the current primary color.
 */
function newspack_custom_colors_css() {

	$primary_color = newspack_get_primary_color();
	$secondary_color = newspack_get_secondary_color();

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );
	}


	$theme_css = '
		/* Set primary background color */

		.main-navigation .sub-menu,
		.sticky-post,
		.entry .entry-content .wp-block-button .wp-block-button__link:not(.has-background),
		.entry .button, button, input[type="button"], input[type="reset"], input[type="submit"],
		.entry .entry-content > .has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-primary-background-color,
		.entry .entry-content .wp-block-file .wp-block-file__button {
			background-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		/* Set primary color */

		.main-navigation .main-menu > li,
		.main-navigation ul.main-menu > li > a,
		.post-navigation .post-title,
		.entry .entry-meta a:hover,
		.entry .entry-footer a:hover,
		.entry .entry-content .more-link:hover,
		.main-navigation .main-menu > li > a + svg,
		.comment .comment-metadata > a:hover,
		.comment .comment-metadata .comment-edit-link:hover,
		#colophon .site-info a:hover,
		.widget a, .widget a:visited,
		.entry .entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.entry .entry-content > .has-primary-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color p,
		.entry .entry-content .wp-block-newspack-blocks-homepage-articles .article-section-title {
			color: ' . $primary_color . '; /* base: #0073a8; */
		}

		/* Set primary border color */

		blockquote,
		.entry .entry-content blockquote,
		.entry .entry-content .wp-block-quote:not(.is-large),
		.entry .entry-content .wp-block-quote:not(.is-style-large),
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus {
			border-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.gallery-item > div > a:focus {
			box-shadow: 0 0 0 2px ' . $primary_color . '; /* base: #0073a8; */
		}

		/* Set secondary background color */

		.entry .entry-content > .has-secondary-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-secondary-background-color,
		.entry .entry-content > *[class^="wp-block-"] .has-secondary-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-secondary-background-color {
			background-color:' . $secondary_color . '; /* base: #666 */
		}

		/* Set secondary color */

		a, a:visited,
		.entry .entry-content > .has-secondary-color,
		.entry .entry-content > *[class^="wp-block-"] .has-secondary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color p {
			color:' . $secondary_color . '; /* base: #666 */
		}

		/* Set primary variation background color */

		.main-navigation .sub-menu > li > a:hover,
		.main-navigation .sub-menu > li > a:focus,
		.main-navigation .sub-menu > li > a:hover:after,
		.main-navigation .sub-menu > li > a:focus:after,
		.main-navigation .sub-menu > li > .menu-item-link-return:hover,
		.main-navigation .sub-menu > li > .menu-item-link-return:focus,
		.main-navigation .sub-menu > li > a:not(.submenu-expand):hover,
		.main-navigation .sub-menu > li > a:not(.submenu-expand):focus,
		.entry .entry-content > .has-primary-variation-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-primary-variation-background-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-variation-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-primary-variation-background-color {
			background-color: ' . newspack_adjust_brightness( $primary_color, -40 ) . '; /* base: #005177; */
		}

		/* Set primary variation color */

		.main-navigation .main-menu > li > a:hover,
		.main-navigation .main-menu > li > a:hover + svg,
		.post-navigation .nav-links a:hover,
		.post-navigation .nav-links a:hover .post-title,
		.author-bio .author-description .author-link:hover,
		.entry .entry-content > .has-primary-variation-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-variation-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-variation-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-variation-color p,
		.comment .comment-author .fn a:hover,
		.comment-reply-link:hover,
		.comment-navigation .nav-previous a:hover,
		.comment-navigation .nav-next a:hover,
		#cancel-comment-reply-link:hover,
		.widget a:hover {
			color: ' . newspack_adjust_brightness( $primary_color, -40 ) . '; /* base: #0073a8; */
		}

		/* Set secondary variation background color */

		.entry .entry-content > .has-secondary-variation-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-secondary-variation-ackground-color,
		.entry .entry-content > *[class^="wp-block-"] .has-secondary-variation-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-secondary-variation-background-color {
			background-color:' . newspack_adjust_brightness( $secondary_color, -40 ) . '; /* base: #666 */
		}

		/* Set secondary variation color */

		a:hover, a:active,
		.entry .entry-content > .has-secondary-variation-color,
		.entry .entry-content > *[class^="wp-block-"] .has-secondary-variation-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color p {
			color:' . newspack_adjust_brightness( $secondary_color, -40 ) . '; /* base: #666 */
		}

		/* Text selection colors */

		::selection {
			background-color: ' . newspack_adjust_brightness( $primary_color, 200 ) . '; /* base: #005177; */
		}
		::-moz-selection {
			background-color: ' . newspack_adjust_brightness( $primary_color, 200 ) . '; /* base: #005177; */
		}';

	$editor_css = '
		/*
		 * Set colors for:
		 * - links
		 * - blockquote
		 * - pullquote (solid color)
		 * - buttons
		 */
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:hover .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:focus .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:active .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink,
		.editor-block-list__layout .editor-block-list__block .wp-block-newspack-blocks-homepage-articles .article-section-title {
			color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .editor-block-list__layout .wp-block-freeform blockquote {
			border-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color) {
			background-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__button,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover {
			background-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		/* Set secondary color */

		.editor-block-list__layout .editor-block-list__block  a {
			color:' . $secondary_color . '; /* base: #666 */
		}

		/* Hover colors */
		.editor-block-list__layout .editor-block-list__block a:hover,
		.editor-block-list__layout .editor-block-list__block a:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
			color: ' . newspack_adjust_brightness( $primary_color, -40 ) . '; /* base: #005177; */
		}

		/* Do not overwrite solid color pullquote or cover links */
		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color a,
		.editor-block-list__layout .editor-block-list__block .wp-block-cover a {
			color: inherit;
		}
		';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	/**
	 * Filters Newspack Theme custom colors CSS.
	 *
	 * @since Newspack Theme 1.0
	 *
	 * @param string $css           Base theme colors CSS.
	 * @param int    $primary_color The user's selected color hex.
	 * @param string $saturation    Filtered theme color saturation level.
	 */
	return apply_filters( 'newspack_custom_colors_css', $theme_css, $primary_color );
}
