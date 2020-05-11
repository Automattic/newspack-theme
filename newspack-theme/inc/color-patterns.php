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

	$primary_color   = newspack_get_primary_color();
	$secondary_color = newspack_get_secondary_color();

	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$primary_color   = get_theme_mod( 'primary_color_hex', $primary_color );
		$secondary_color = get_theme_mod( 'secondary_color_hex', $secondary_color );

		if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$header_color          = get_theme_mod( 'header_color_hex', '#666666' );
			$header_color_contrast = newspack_get_color_contrast( $header_color );
		} else {
			$header_color          = $primary_color;
			$header_color_contrast = newspack_get_color_contrast( $primary_color );
		}
	}

	// Set colour contrasts.
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
		.site-content .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label,
		.comment .comment-author .post-author-badge {
			background-color: ' . esc_html( $primary_color ) . '; /* base: #0073a8; */
		}

		@media only screen and (min-width: 782px) {
			/* Header default background */
			.h-db .featured-image-beside {
				background-color: ' . esc_html( $primary_color ) . ';
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
		.comments-toggle:hover, .comments-toggle:focus {
			color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
		}

		/* Set primary color */

		.entry .entry-content .has-primary-color,
		.entry .entry-content *[class^="wp-block-"] .has-primary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color p,
		.entry .entry-content .is-style-outline .wp-block-button__link.has-primary-color:not(:hover), /* legacy styles */
		.entry .entry-content .wp-block-button__link.is-style-outline.has-primary-color:not(:hover) {
			color: ' . esc_html( $primary_color ) . ';
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
		.comment .comment-author .post-author-badge,
		.site-content .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			color: ' . esc_html( $primary_color_contrast ) . ';
		}

		@media only screen and (min-width: 782px) {
			/* Header default background */
			.h-db .featured-image-beside .entry-header,
			.h-db.h-sub.single-featured-image-beside .middle-header-contain {
				color: ' . esc_html( $primary_color_contrast ) . ';
			}
		}

		/* Set primary border color */

		blockquote,
		.entry .entry-content blockquote,
		.entry .entry-content .wp-block-quote:not(.is-large),
		.entry .entry-content .wp-block-quote:not(.is-style-large) {
			border-color: ' . esc_html( $primary_color ) . '; /* base: #0073a8; */
		}

		.mobile-sidebar nav + nav,
		.mobile-sidebar nav + .widget,
		.mobile-sidebar .widget + .widget {
			border-color: ' . esc_html( $primary_color_contrast ) . ';
		}

		.gallery-item > div > a:focus {
			box-shadow: 0 0 0 2px ' . esc_html( $primary_color ) . '; /* base: #0073a8; */
		}

		/* Set secondary background color */

		.entry .entry-content .wp-block-button__link:not(.has-background),
		.button, button, input[type="button"], input[type="reset"], input[type="submit"],
		.entry .entry-content .has-secondary-background-color,
		.entry .entry-content *[class^="wp-block-"].has-secondary-background-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-background-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-secondary-background-color {
			background-color:' . esc_html( $secondary_color ) . '; /* base: #666 */
		}

		/* Set colour that contrasts against the secondary background */
		.entry .entry-content .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-background),
		.button, .button:visited, .entry .entry-content .button, .entry .entry-content .button:visited, button, input[type="button"], input[type="reset"], input[type="submit"] {
			color: ' . esc_html( $secondary_color_contrast ) . ';
		}

		/* Set secondary color */

		.entry .entry-content .has-secondary-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color p,
		.entry .entry-content .is-style-outline .wp-block-button__link.has-secondary-color:not(:hover), /* legacy styles */
		.entry .entry-content .wp-block-button__link.is-style-outline.has-secondary-color:not(:hover) {
			color:' . esc_html( $secondary_color ) . '; /* base: #666 */
		}

		/* Set secondary color with contrast */
		.site-header .highlight-menu .menu-label,
		.entry-content a,
		.author-bio .author-link,
		.entry .entry-content .is-style-outline .wp-block-button__link, /* legacy selector */
		.entry .entry-content .wp-block-button__link.is-style-outline {
			color:' . esc_html( newspack_color_with_contrast( $secondary_color ) ) . ';
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
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-primary-variation-background-color  {
			background-color: ' . esc_html( newspack_adjust_brightness( $primary_color, -30 ) ) . '; /* base: #005177; */
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
		#cancel-comment-reply-link:hover,
		.entry .entry-content .is-style-outline .wp-block-button__link.has-primary-variation-color:not(:hover), /* legacy styles */
		.entry .entry-content .wp-block-button__link.is-style-outline.has-primary-variation-color:not(:hover) {
			color: ' . esc_html( newspack_adjust_brightness( $primary_color, -40 ) ) . '; /* base: #0073a8; */
		}

		/* Set secondary variation background color */

		.entry .entry-content .has-secondary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"].has-secondary-variation-ackground-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-variation-background-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color.has-secondary-variation-background-color {
			background-color:' . esc_html( newspack_adjust_brightness( $secondary_color, -40 ) ) . '; /* base: #666 */
		}

		/* Set secondary variation color */

		.entry-content a:hover,
		.widget a:hover,
		.author-bio .author-link:hover,
		.entry .entry-content .has-secondary-variation-color,
		.entry .entry-content *[class^="wp-block-"] .has-secondary-variation-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color,
		.entry .entry-content *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color p,
		.entry .entry-content .is-style-outline .wp-block-button__link.has-secondary-variation-color:not(:hover), /* legacy styles */
		.entry .entry-content .wp-block-button__link.is-style-outline.has-secondary-variation-color:not(:hover){
			color:' . esc_html( newspack_adjust_brightness( $secondary_color, -40 ) ) . '; /* base: #666 */
		}
		';

	if ( true === get_theme_mod( 'header_solid_background', false ) ) {
		$theme_css .= '
			.mobile-sidebar {
				background: ' . esc_html( $header_color ) . ';
			}

			.mobile-sidebar,
			.mobile-sidebar button:hover,
			.mobile-sidebar a,
			.mobile-sidebar a:visited,
			.mobile-sidebar .nav1 .sub-menu > li > a,
			.mobile-sidebar .nav1 ul.main-menu > li > a {
				color: ' . esc_html( $header_color_contrast ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'default' ) ) {
		$theme_css .= '
			.mobile-sidebar .nav3 a {
				background: transparent;
			}
			.mobile-sidebar .nav3 .menu-highlight a {
				background: ' . esc_html( newspack_adjust_brightness( $primary_color, -20 ) ) . ';
			}
			.cat-links a,
			.cat-links a:visited,
			.site-header .nav3 .menu-highlight a {
				background-color: ' . esc_html( $primary_color ) . ';
				color: ' . esc_html( $primary_color_contrast ) . ';
			}
			.cat-links a:hover {
				background-color: ' . esc_html( newspack_adjust_brightness( $primary_color, -40 ) ) . ';
				color: ' . esc_html( $primary_color_contrast ) . ';
			}
			.accent-header, .article-section-title,
			.entry .entry-footer a:hover {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}
		';

		if ( true === get_theme_mod( 'header_solid_background', false ) ) {
			$theme_css .= '
				.mobile-sidebar .nav3 .menu-highlight a {
					background: ' . esc_html( newspack_adjust_brightness( $header_color, -20 ) ) . ';
				}
				.h-sb .site-header .nav3 a {
					background-color: ' . newspack_adjust_brightness( $header_color, -17 ) . ';
					color: ' . esc_html( $header_color_contrast ) . ';
				}
				.h-sb .site-header .nav3 .menu-highlight a {
					background-color: ' . $secondary_color . ';
					color: ' . esc_html( $secondary_color_contrast ) . ';
				}
			';
		}
	}

	if ( newspack_is_active_style_pack( 'default', 'style-3', 'style-4' ) ) {
		$theme_css .= '
			.archive .page-title,
			.entry-meta .byline a, .entry-meta .byline a:visited,
			.entry .entry-content .entry-meta .byline a, .entry .entry-content .entry-meta .byline a:visited,
			.entry .entry-meta a:hover {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-1' ) ) {
		$theme_css .= '
			.accent-header:not(.widget-title):before,
			.article-section-title:before,
			.cat-links:before,
			.page-title:before {
				background-color: ' . esc_html( $primary_color ) . ';
			}

			.wp-block-pullquote blockquote p:first-of-type:before {
				color: ' . esc_html( $primary_color ) . ';
			}

			@media only screen and (min-width: 782px) {
				/* Header default background */
				.h-db .featured-image-beside .cat-links:before {
					background-color: ' . esc_html( $primary_color_contrast ) . ';
				}
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-2' ) ) {
		$theme_css .= '
			.site-header,
			/* Header default background */
			.h-db .site-header,
			/* Header short height; default background */
			.h-sh.h-db .site-header,
			.site-content #primary,
			#page .site-header {
				border-color: ' . esc_html( newspack_adjust_brightness( $primary_color, -40 ) ) . ';
			}

			.site-footer {
				background-color: ' . esc_html( $primary_color ) . ';
				color: ' . esc_html( $primary_color_contrast ) . ';
			}

			.has-drop-cap:not(:focus)::first-letter {
				color: ' . esc_html( newspack_color_with_contrast( $secondary_color ) ) . ';
			}
		';

		if ( true === get_theme_mod( 'header_solid_background', false ) ) {
			$theme_css .= '
				/* Header solid background */
				.h-sb .site-header,
				.h-sb .site-header .highlight-menu .menu-label,
				.h-sb .site-header .highlight-menu a,
				.h-sb .site-footer {
					color: ' . esc_html( $header_color_contrast ) . ';
				}

				.h-sb site-footer {
					background-color: ' . esc_html( $header_color ) . ';
				}

				.site-header,
				/* Header default background */
				.h-db .site-header,
				/* Header short height; default background */
				.h-sh.h-db .site-header,
				.site-content #primary,
				#page .site-header {
					border-color: ' . esc_html( newspack_adjust_brightness( $header_color, -40 ) ) . ';
				}
			';
		}
	}

	if ( newspack_is_active_style_pack( 'style-3' ) ) {
		$theme_css .= '
			.cat-links,
			.cat-links a,
			.cat-links a:visited,
			.article-section-title,
			.entry .entry-footer,
			.accent-header {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}

			.cat-links a:hover {
				color: ' . esc_html( newspack_adjust_brightness( $primary_color, -40 ) ) . ';
			}

			.accent-header:before,
			.site-content .wpnbha .article-section-title:before,
			.cat-links:before,
			.archive .page-title:before,
			figcaption:after,
			.wp-caption-text:after {
				background-color: ' . esc_html( $primary_color ) . ';
			}

			@media only screen and (min-width: 782px) {
				.featured-image-beside a,
				.featured-image-beside a:visited,
				.featured-image-beside .cat-links a {
					color: ' . esc_html( $primary_color_contrast ) . ';
				}

				.featured-image-beside .cat-links:before {
					background-color: ' . esc_html( $primary_color_contrast ) . ';
				}
			}
		';

		if ( true === get_theme_mod( 'header_solid_background', false ) ) {
			$theme_css .= '
				@media only screen and (min-width: 782px) {
					.h-sb .featured-image-beside {
						background-color: ' . esc_html( $primary_color ) . ';
					}

					.h-sb .featured-image-beside,
					.h-sb .featured-image-beside a {
						color: ' . esc_html( $primary_color_contrast ) . ';
					}
				}

				/* Header solid background; short height */
				.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:hover,
				.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:focus {
					background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -30 ) ) . ';
				}
			';

			if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
				$theme_css .= '
					/* Header solid background */
					.h-sb .middle-header-contain {
						background-color: ' . esc_html( $header_color ) . ';
					}
					.h-sb .top-header-contain {
						background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -10 ) ) . ';
						border-bottom-color: ' . esc_html( newspack_adjust_brightness( $header_color, -15 ) ) . ';
					}

					/* Header solid background */
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
					.h-sb .middle-header-contain {
						color: ' . esc_html( $header_color_contrast ) . ';
					}
				';
			}
		}
	}

	if ( newspack_is_active_style_pack( 'style-4' ) ) {
		$theme_css .= '
			.accent-header,
			.article-section-title,
			.cat-links,
			.entry .entry-footer {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}

			.has-drop-cap:not(:focus)::first-letter {
				background-color: ' . esc_html( $primary_color ) . ';
				color: ' . esc_html( $primary_color_contrast ) . ';
			}

			.site-footer .widget .widget-title {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}
		';

		if ( true === get_theme_mod( 'header_solid_background', false ) ) {
			$theme_css .= '
				/* Header solid background; short height */
				.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:hover,
				.h-sb.h-sh .site-header .nav1 .main-menu .sub-menu a:focus {
					background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -30 ) ) . ';
				}

				@media only screen and (min-width: 782px) {
					.h-sb .featured-image-beside .cat-links {
						color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
					}
				}
			';

			if ( 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
				$theme_css .= '
					/* Header solid background */
					.h-sb .middle-header-contain {
						background-color: ' . esc_html( $header_color ) . ';
					}
					.h-sb .top-header-contain {
						background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -10 ) ) . ';
						border-bottom-color: ' . esc_html( newspack_adjust_brightness( $header_color, -15 ) ) . ';
					}

					/* Header solid background */
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
					.h-sb .middle-header-contain {
						color: ' . esc_html( $header_color_contrast ) . ';
					}
				';
			}
		}
	}

	if ( newspack_is_active_style_pack( 'style-5' ) ) {
		$theme_css .= '
			@media only screen and (min-width: 782px) {
				.h-db .featured-image-beside .entry-header {
					color: #fff;
				}
			}
		';

		if ( true === get_theme_mod( 'header_solid_background', false ) && 'default' !== get_theme_mod( 'header_color', 'default' ) ) {
			$theme_css .= '
				/* Header solid background */
				.h-sb .middle-header-contain {
					background-color: ' . esc_html( $header_color ) . ';
				}
				.h-sb .top-header-contain {
					background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -10 ) ) . ';
					border-bottom-color: ' . esc_html( newspack_adjust_brightness( $header_color, -15 ) ) . ';
				}

				/* Header solid background */
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
				.h-sb .middle-header-contain {
					color: ' . esc_html( $header_color_contrast ) . ';
				}
			';
		}
	}

	if ( true === get_theme_mod( 'header_solid_background', false ) && newspack_is_active_style_pack( 'default', 'style-1', 'style-2' ) ) {
		$theme_css .= '
			/* Header solid background */
			.h-sb .middle-header-contain {
				background-color: ' . esc_html( $header_color ) . ';
			}
			.h-sb .top-header-contain {
				background-color: ' . esc_html( newspack_adjust_brightness( $header_color, -10 ) ) . ';
				border-bottom-color: ' . esc_html( newspack_adjust_brightness( $header_color, -15 ) ) . ';
			}

			/* Header solid background */
			.h-sb .site-header,
			.h-sb .site-title,
			.h-sb .site-title a:link,
			.h-sb .site-title a:visited,
			.h-sb .site-description,
			/* Header solid background; short height */
			.h-sb.h-sh .site-header .nav1 .main-menu > li,
			.h-sb.h-sh .site-header .nav1 ul.main-menu > li > a,
			.h-sb.h-sh .site-header .nav1 ul.main-menu > li > a:hover,
			.h-sb .top-header-contain,
			.h-sb .middle-header-contain {
				color: ' . esc_html( $header_color_contrast ) . ';
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
			color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .block-editor-block-list__layout .wp-block-freeform blockquote {
			border-color: ' . esc_html( $primary_color ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			background-color: ' . esc_html( $primary_color ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			color: ' . esc_html( $primary_color_contrast ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-color {
			color: ' . esc_html( $primary_color ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-variation-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-variation-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-variation-color {
			color: ' . esc_html( newspack_adjust_brightness( $primary_color, -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-background-color {
			background-color: ' . esc_html( $primary_color ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-variation-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-variation-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-variation-background-color {
			background-color: ' . esc_html( newspack_adjust_brightness( $primary_color, -30 ) ) . ';
		}

		/* Secondary color */

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link:not(.has-background),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"] {
			background-color: ' . esc_html( $secondary_color ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"] {
			color: ' . esc_html( $secondary_color_contrast ) . '; /* base: #0073a8; */
		}

		/* Hover colors */
		.block-editor-block-list__layout .block-editor-block-list__block a:hover,
		.block-editor-block-list__layout .block-editor-block-list__block a:active,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
			color: ' . esc_html( newspack_adjust_brightness( $secondary_color, -40 ) ) . '; /* base: #005177; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block a,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link:not(.has-text-color), /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__textlink {
			color: ' . esc_html( newspack_color_with_contrast( $secondary_color ) ) . ';
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

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-color {
			color: ' . esc_html( $secondary_color ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-variation-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-variation-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-variation-color {
			color: ' . esc_html( newspack_adjust_brightness( $secondary_color, -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-background-color {
			background-color: ' . esc_html( $secondary_color ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-variation-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-variation-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-variation-background-color {
			background-color: ' . esc_html( newspack_adjust_brightness( $secondary_color, -30 ) ) . ';
		}
		';

	if ( newspack_is_active_style_pack( 'default', 'style-3', 'style-4' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'default' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-1' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header:not(.widget-title):before,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title:before {
				background-color: ' . esc_html( $primary_color ) . ';
			}
			.editor-styles-wrapper .wp-block[data-type="core/pullquote"] .wp-block-pullquote:not(.is-style-solid-color) blockquote > .editor-rich-text__editable:first-child:before {
				color: ' . esc_html( $primary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-2' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter {
				color: ' . esc_html( newspack_color_with_contrast( $secondary_color ) ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-3' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}

			.block-editor-block-list__layout .block-editor-block-list__block .accent-header:before,
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title:before,
			.block-editor-block-list__layout .block-editor-block-list__block figcaption:after,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-caption-text:after {
				background-color: ' . esc_html( $primary_color ) . ';
			}
		';
	}

	if ( newspack_is_active_style_pack( 'style-4' ) ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title {
				color: ' . esc_html( newspack_color_with_contrast( $primary_color ) ) . ';
			}
		';

		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter {
				background-color: ' . esc_html( $primary_color ) . ';
				color: ' . esc_html( $primary_color_contrast ) . ';
			}
		';

	}

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
