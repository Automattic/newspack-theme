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

	$primary_color_contrast   = newspack_get_color_contrast( $primary_color );
	$secondary_color_contrast = newspack_get_color_contrast( $secondary_color );

	$theme_css = '
		/* Set primary background color */

		.mobile-sidebar,
		/* Header default background; header default height */
		body.h-db.h-dh .site-header .nav3 .menu-highlight a,
		.entry .entry-content .has-primary-background-color,
		.entry .entry-content *[class^="wp-block-"].has-primary-background-color,
		.entry .entry-content *[class^="wp-block-"] .has-primary-background-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-primary-background-color,
		.entry .entry-content .wp-block-file .wp-block-file__button,
		.site-content .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			background-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		@media only screen and (min-width: 782px) {
			/* Header default background */
			.h-db .featured-image-beside {
				background-color: ' . $primary_color . ';
			}
		}

		/* Set primary color that contrasts against white */
		.entry .entry-content .more-link:hover,
		.nav1 .main-menu > li > a + svg,
		.search-form button:active, .search-form button:hover, .search-form button:focus,
		.entry-footer a,
		.comment .comment-metadata > a:hover,
		.comment .comment-metadata .comment-edit-link:hover,
		.site-info a:hover,
		.entry .entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
			color: ' . newspack_color_with_contrast( $primary_color ) . ';
		}

		/* Set primary color */

		.entry .entry-content .has-primary-color,
		.entry .entry-content *[class^="wp-block-"] .has-primary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color p {
			color: ' . $primary_color . ';
		}

		.mobile-sidebar,
		.mobile-sidebar button:hover,
		.mobile-sidebar a,
		.mobile-sidebar a:visited,
		.mobile-sidebar .nav1 .sub-menu > li > a,
		.mobile-sidebar .nav1 ul.main-menu > li > a,
		.site-header .nav1 .sub-menu a:hover,
		.site-header .nav1 .sub-menu a:focus,
		.site-header .nav1 .sub-menu > li.menu-item-has-children a:hover + .submenu-expand,
		.site-header .nav1 .sub-menu > li.menu-item-has-children a:focus + .submenu-expand,
		.highlight-menu .menu-label,
		/* Header default background; default height */
		body.h-db.h-dh .site-header .nav3 .menu-highlight a,
		.site-content .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			color: ' . $primary_color_contrast . ';
		}

		@media only screen and (min-width: 782px) {
			/* Header default background */
			.h-db .featured-image-beside .entry-header {
				color: ' . $primary_color_contrast . ';
			}
		}

		/* Set primary border color */

		blockquote,
		.entry .entry-content blockquote,
		.entry .entry-content .wp-block-quote:not(.is-large),
		.entry .entry-content .wp-block-quote:not(.is-style-large) {
			border-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.mobile-sidebar .nav1 + nav.secondary-menu {
			border-color: ' . $primary_color_contrast . ';
		}

		.gallery-item > div > a:focus {
			box-shadow: 0 0 0 2px ' . $primary_color . '; /* base: #0073a8; */
		}

		/* Set secondary background color */

		.entry .entry-content .wp-block-button .wp-block-button__link:not(.has-background),
		.button, button, input[type="button"], input[type="reset"], input[type="submit"],
		.entry .entry-content .has-secondary-background-color,
		.entry .entry-content *[class^="wp-block-"].has-secondary-background-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-background-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-secondary-background-color {
			background-color:' . $secondary_color . '; /* base: #666 */
		}

		/* Set colour that contrasts against the secondary background */

		.entry .entry-content .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-background),
		.button, .button:visited, .entry .entry-content .button, .entry .entry-content .button:visited, button, input[type="button"], input[type="reset"], input[type="submit"] {
			color: ' . $secondary_color_contrast . ';
		}

		/* Set secondary color */

		.entry .entry-content .has-secondary-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color p {
			color:' . $secondary_color . '; /* base: #666 */
		}

		/* Set secondary color with contrast */
		.site-header .highlight-menu .menu-label,
		.entry-content a,
		.entry-content a:visited,
		.author-bio .author-link,
		.entry .entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
			color:' . newspack_color_with_contrast( $secondary_color ) . ';
		}

		/* Set primary variation background color */

		.site-header .nav1 .sub-menu > li > a:hover,
		.site-header .nav1 .sub-menu > li > a:focus,
		.site-header .nav1 .sub-menu > li > a:hover:after,
		.site-header .nav1 .sub-menu > li > a:focus:after,
		.site-header .nav1 .sub-menu > li > .menu-item-link-return:hover,
		.site-header .nav1 .sub-menu > li > .menu-item-link-return:focus,
		.site-header .nav1 .sub-menu > li > a:not(.submenu-expand):hover,
		.site-header .nav1 .sub-menu > li > a:not(.submenu-expand):focus,
		.entry .entry-content .has-primary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"].has-primary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"] .has-primary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-primary-variation-background-color {
			background-color: ' . newspack_adjust_brightness( $primary_color, -30 ) . '; /* base: #005177; */
		}

		/* Set primary variation color */

		.author-bio .author-description .author-link:hover,
		.entry .entry-content .has-primary-variation-color,
		.entry .entry-content *[class^="wp-block-"] .has-primary-variation-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-variation-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-variation-color p,
		.comment .comment-author .fn a:hover,
		.comment-reply-link:hover,
		.comment-navigation .nav-previous a:hover,
		.comment-navigation .nav-next a:hover,
		#cancel-comment-reply-link:hover {
			color: ' . newspack_adjust_brightness( $primary_color, -40 ) . '; /* base: #0073a8; */
		}

		/* Set secondary variation background color */

		.entry .entry-content .has-secondary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"].has-secondary-variation-ackground-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-secondary-variation-background-color {
			background-color:' . newspack_adjust_brightness( $secondary_color, -40 ) . '; /* base: #666 */
		}

		/* Set secondary variation color */

		.entry-content a:hover,
		.widget a:hover,
		.author-bio .author-link:hover,
		.entry .entry-content .has-secondary-variation-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-variation-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color p {
			color:' . newspack_adjust_brightness( $secondary_color, -40 ) . '; /* base: #666 */
		}

		';

	if ( newspack_is_active_style_pack( 'default' ) ) {
		$theme_css .= '
			.mobile-sidebar .nav3 a {
				background: transparent;
			}
			.mobile-sidebar .nav3 .menu-highlight a {
				background: ' . newspack_adjust_brightness( $primary_color, -20 ) . ';
			}
			.h-sb .site-header .nav3 a {
				background-color: ' . newspack_adjust_brightness( $primary_color, -17 ) . ';
				color: ' . $primary_color_contrast . ';
			}
			.h-sb .site-header .nav3 .menu-highlight a {
				background-color: ' . $secondary_color . ';
				color: ' . $secondary_color_contrast . ';
			}
			.cat-links a,
			.cat-links a:visited,
			.site-header .nav3 .menu-highlight a {
				background-color: ' . $primary_color . ';
				color: ' . $primary_color_contrast . ';
			}
			.cat-links a:hover {
				background-color: ' . newspack_adjust_brightness( $primary_color, -40 ) . ';
				color: ' . $primary_color_contrast . ';
			}
			.accent-header, .article-section-title,
			.entry .entry-footer a:hover {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'default', 'style-3', 'style-4' ) ) {
		$theme_css .= '
			.archive .page-title,
			.entry-meta .byline a, .entry-meta .byline a:visited,
			.entry .entry-content .entry-meta .byline a, .entry .entry-content .entry-meta .byline a:visited,
			.entry .entry-meta a:hover {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-1' ) ) {
		$theme_css .= '
			.accent-header:not(.widget-title):before,
			.article-section-title:before,
			.cat-links:before,
			.page-title:before {
				background-color: ' . $primary_color . ';
			}

			.wp-block-pullquote blockquote p:first-of-type:before {
				color: ' . $primary_color . ';
			}

			@media only screen and (min-width: 782px) {
				/* Header default background */
				.h-db .featured-image-beside .cat-links:before {
					background-color: ' . $primary_color_contrast . ';
				}
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-2' ) ) {
		$theme_css .= '
			/* Header solid background */
			.h-sb .site-header {
				background-color: ' . $primary_color . ';
			}

			.site-header,
			/* Header default background */
			.h-db .site-header,
			/* Header short height; default background */
			.h-sh.h-db .site-header,
			.site-content #primary,
			#page .site-header {
				border-color: ' . newspack_adjust_brightness( $primary_color, -40 ) . ';
			}

			/* Header solid background */
			.h-sb .site-header .highlight-menu .menu-label,
			.h-sb .site-header .highlight-menu a {
				color: ' . $primary_color_contrast . ';
			}

			.site-footer {
				background-color: ' . $primary_color . ';
				color: ' . $primary_color_contrast . ';
			}

			.has-drop-cap:not(:focus)::first-letter {
				color: ' . newspack_color_with_contrast( $secondary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-3' ) ) {
		$theme_css .= '
			.cat-links,
			.cat-links a,
			.cat-links a:visited,
			.article-section-title,
			.entry .entry-footer,
			.accent-header {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}

			.cat-links a:hover {
				color: ' . newspack_adjust_brightness( $primary_color, -40 ) . ';
			}

			.accent-header:before,
			.site-content .wpnbha .article-section-title:before,
			.cat-links:before,
			.archive .page-title:before,
			figcaption:after,
			.wp-caption-text:after {
				background-color: ' . $primary_color . ';
			}

			@media only screen and (min-width: 782px) {
				.h-sb .featured-image-beside {
					background-color: ' . $primary_color . ';
				}

				.h-sb .featured-image-beside,
				.h-sb .featured-image-beside a,
				.featured-image-beside a,
				.featured-image-beside a:visited,
				.featured-image-beside .cat-links a {
					color: ' . $primary_color_contrast . ';
				}

				.featured-image-beside .cat-links:before {
					background-color: ' . $primary_color_contrast . ';
				}
			}

			/* Header solid background; short height */
			.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:hover,
			.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:focus {
				background-color: ' . newspack_adjust_brightness( $primary_color, -30 ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-4' ) ) {
		$theme_css .= '
			.accent-header,
			.article-section-title,
			.cat-links,
			.entry .entry-footer {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}

			@media only screen and (min-width: 782px) {
				.h-sb .featured-image-beside .cat-links {
					color: ' . newspack_color_with_contrast( $primary_color ) . ';
				}
			}

			.has-drop-cap:not(:focus)::first-letter {
				background-color: ' . $primary_color . ';
				color: ' . $primary_color_contrast . ';
			}

			.site-footer .widget .widget-title {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}

			/* Header solid background; short height */
			.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:hover,
			.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:focus {
				background-color: ' . newspack_adjust_brightness( $primary_color, -30 ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-5' ) ) {
		$theme_css .= '
			@media only screen and (min-width: 782px) {
				.h-db .featured-image-beside .entry-header {
					color: #fff;
				}
			}
		';
	}

	if ( true === get_theme_mod( 'header_solid_background', false ) && newspack_is_active_style_pack( 'default', 'style-1', 'style-2' ) ) {
		$theme_css .= '
			/* Header solid background */
			.h-sb .middle-header-contain {
				background-color: ' . $primary_color . ';
			}
			.h-sb .top-header-contain {
				background-color: ' . newspack_adjust_brightness( $primary_color, -10 ) . ';
				border-bottom-color: ' . newspack_adjust_brightness( $primary_color, -15 ) . ';
			}

			/* Header solif background */
			.h-sb .site-header,
			.h-sb .site-title,
			.h-sb .site-title a:link,
			.h-sb .site-title a:visited,
			.h-sb .site-description,
			/* Header solid background; short height */
			.h-sb.h-sh .nav1 .main-menu > li,
			.h-sb.h-sh .nav1 ul.main-menu > li > a,
			.h-sb.h-sh .nav1 ul.main-menu > li > a:hover,
			.h-sb .top-header-contain,
			.h-sb .middle-header-contain,
			.nav1 .sub-menu a {
				color: ' . $primary_color_contrast . ';
			}
		';
	}

	$editor_css = '
		/*
		 * Set colors for:
		 * - links
		 * - blockquote
		 * - pullquote (solid color)
		 * - buttons
		 */

		.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a {
			color: ' . newspack_color_with_contrast( $primary_color ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .block-editor-block-list__layout .wp-block-freeform blockquote {
			border-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			background-color: ' . $primary_color . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			color: ' . $primary_color_contrast . ';
		}

		/* Secondary color */

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"] {
			background-color: ' . $secondary_color . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"] {
			color: ' . $secondary_color_contrast . '; /* base: #0073a8; */
		}

		/* Hover colors */
		.block-editor-block-list__layout .block-editor-block-list__block a:hover,
		.block-editor-block-list__layout .block-editor-block-list__block a:active,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
			color: ' . newspack_adjust_brightness( $secondary_color, -40 ) . '; /* base: #005177; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block a,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button.is-style-outline:hover .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button.is-style-outline:focus .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button.is-style-outline:active .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__textlink {
			color: ' . newspack_color_with_contrast( $secondary_color ) . ';
		}

		/* Do not overwrite solid color pullquote or cover links */
		.block-editor-block-list__layout .block-editor-block-list__block .has-text-color a,
		.block-editor-block-list__layout .block-editor-block-list__block .has-text-color a:hover,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-pullquote.is-style-solid-color a,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-cover a,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles .entry-title a,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles .entry-title a:hover,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-cover .article-section-title {
			color: inherit;
		}
		';

	if ( newspack_is_active_style_pack( 'default', 'style-3', 'style-4' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'default' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-1' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header:not(.widget-title):before,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title:before {
				background-color: ' . $primary_color . ';
			}
			.editor-styles-wrapper .wp-block[data-type="core/pullquote"] .wp-block-pullquote:not(.is-style-solid-color) blockquote > .editor-rich-text__editable:first-child:before {
				color: ' . $primary_color . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-2' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter {
				color: ' . newspack_color_with_contrast( $secondary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-3' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}

			.block-editor-block-list__layout .block-editor-block-list__block .accent-header:before,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title:before,
			.block-editor-block-list__layout .block-editor-block-list__block figcaption:after,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-caption-text:after {
				background-color: ' . $primary_color . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-4' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title {
				color: ' . newspack_color_with_contrast( $primary_color ) . ';
			}
		';

		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter {
				background-color: ' . $primary_color . ';
				color: ' . $primary_color_contrast . ';
			}
		';

	}

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
