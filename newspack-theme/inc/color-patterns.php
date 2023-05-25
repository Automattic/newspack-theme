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
	$colors = newspack_get_colors();
	$theme_css = '';
	$editor_css = '';

	// Front-end colors that require the theme_colors to be set to 'custom':
	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {

		$css_variables =  '
				--newspack-theme-color-primary: ' . esc_attr( $colors['primary'] ) . ';
				--newspack-theme-color-primary-variation: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
				--newspack-theme-color-secondary: ' . esc_attr( $colors['secondary'] ) . ' !important;
				--newspack-theme-color-secondary-variation: ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . ';

				--newspack-theme-color-primary-darken-5: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -5 ) ) . ';
				--newspack-theme-color-primary-darken-10: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -10 ) ) . ';
		';

		$theme_css = '
			:root { ' . $css_variables . ' }
		';

		$editor_css = '
			:root .editor-styles-wrapper { ' . $css_variables . ' }
		';

		$theme_css .= '
			/* Set primary color that contrasts against white */
			.more-link:hover,
			.nav1 .main-menu > li > a + svg,
			form.search-form button:active,
			form.search-form button:hover,
			form.search-form button:focus,
			.entry-footer a,
			.comment .comment-metadata > a:hover,
			.comment .comment-metadata .comment-edit-link:hover,
			.site-info a:hover,
			.comments-toggle:hover, .comments-toggle:focus,
			.logged-in.page-template-single-wide.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
			.logged-in.page-template-single-wide.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover:visited,
			.logged-in.page-template-single-feature.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
			.logged-in.page-template-single-feature.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover:visited {
				color: ' . esc_attr( newspack_color_with_contrast( $colors['primary'] ) ) . ';
			}

			/* Set color that contrasts against the primary color */
			.mobile-sidebar,
			.mobile-sidebar button:hover,
			.mobile-sidebar a,
			.mobile-sidebar a:visited,
			.mobile-sidebar .nav1 .sub-menu > li > a,
			.mobile-sidebar .nav1 ul.main-menu > li > a,
			.wp-block-file .wp-block-file__button,
			/* Header default background; default height */
			body.h-db.h-dh .site-header .nav3 .menu-highlight a,
			.comment .comment-author .post-author-badge,
			.woocommerce .onsale,
			.woocommerce-store-notice,
			.logged-in.page-template-single-wide.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
			.logged-in.page-template-single-feature.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a {
				color: ' . esc_attr( $colors['primary_contrast'] ) . ';
			}

			.mobile-sidebar nav + nav,
			.mobile-sidebar nav + .widget,
			.mobile-sidebar .widget + .widget {
				border-color: ' . esc_attr( $colors['primary_contrast'] ) . ';
			}

			@media only screen and (min-width: 782px) {
				/* Header default background */
				.h-db .featured-image-beside .entry-header,
				.h-db.h-sub.single-featured-image-beside .middle-header-contain {
					color: ' . esc_attr( $colors['primary_contrast'] ) . ';
				}
			}

			/* Set colour that contrasts against the secondary background */
			.wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color):not(:hover),
			.button,
			.button:visited,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.wp-block-search__button {
				color: ' . esc_attr( $colors['secondary_contrast'] ) . ';
			}

			input[type="checkbox"]::before {
				background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' width=\'24\' height=\'24\'%3E%3Cpath d=\'M16.7 7.1l-6.3 8.5-3.3-2.5-.9 1.2 4.5 3.4L17.9 8z\' fill=\'' . esc_attr( $colors['secondary_contrast'] ) . '\'%3E%3C/path%3E%3C/svg%3E");
			}

			/* Set secondary color with contrast */
			.site-header .highlight-menu .menu-label,
			.entry-content a,
			.author-bio .author-link,
			.is-style-outline .wp-block-button__link, /* legacy selector */
			.wp-block-button__link.is-style-outline,
			.is-style-outline > .wp-block-button__link:not(.has-text-color):not(:hover) {
				color:' . esc_attr( newspack_color_with_contrast( $colors['secondary'] ) ) . ';
			}

			';

		if ( true === get_theme_mod( 'header_solid_background', false ) ) {
			$theme_css .= '
				.mobile-sidebar {
					background: ' . esc_attr( $colors['header'] ) . ';
				}

				.mobile-sidebar,
				.mobile-sidebar button:hover,
				.mobile-sidebar a,
				.mobile-sidebar a:visited,
				.mobile-sidebar .nav1 .sub-menu > li > a,
				.mobile-sidebar .nav1 ul.main-menu > li > a {
					color: ' . esc_attr( $colors['header_contrast'] ) . ';
				}
			';

			if ( isset( $colors['primary_menu'] ) && '' !== $colors['primary_menu'] ) {
				$theme_css .= '
					.h-sb .bottom-header-contain {
						background: ' . esc_attr( $colors['primary_menu'] ) . ';
					}

					.h-sb .bottom-header-contain .nav1 .main-menu > li,
					.h-sb .bottom-header-contain .nav1 .main-menu > li > a,
					.h-sb .bottom-header-contain #search-toggle {
						color: ' . esc_attr( $colors['primary_menu_contrast'] ) . ';
					}
				';
			}
		}

		if ( isset( $colors['footer'] ) && '' !== $colors['footer'] ) {
			$theme_css .= '
				.site-footer {
					background: ' . esc_attr( $colors['footer'] ) . ';
				}

				.site-footer,
				.site-footer a,
				.site-footer a:hover,
				.site-footer .widget-title,
				.site-footer .widgettitle,
				.site-info {
					color: ' . esc_attr( $colors['footer_contrast'] ) . ';
				}

				.site-footer a:hover,
				.site-footer .widget a:hover {
					opacity: 0.7;
				}

				.site-info .widget-area .wrapper,
				.site-info .site-info-contain:first-child {
					border-top-color: ' . esc_attr( newspack_adjust_brightness( $colors['footer'], -20 ) ) . ';
				}
			';
		}

		if ( ! is_child_theme() ) {
			$theme_css .= '
				.mobile-sidebar .nav3 a {
					background: transparent;
				}
				.mobile-sidebar .nav3 .menu-highlight a {
					background: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -20 ) ) . ';
				}
				.mobile-sidebar .accent-header,
				.mobile-sidebar .article-section-title {
					border-color: ' . newspack_adjust_brightness( $colors['header'], -20 ) . ';
					color: ' . esc_attr( $colors['header_contrast'] ) . ';
				}
				.cat-links a,
				.cat-links a:visited,
				.site-header .nav3 .menu-highlight a,
				.subpage-sidebar .nav3 .menu-highlight a {
					color: ' . esc_attr( $colors['primary_contrast'] ) . ';
				}
				.cat-links a:hover {
					background-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -40 ) ) . ';
					color: ' . esc_attr( $colors['primary_contrast'] ) . ';
				}
				.accent-header,
				#secondary .widgettitle,
				.article-section-title,
				.entry .entry-footer a:hover,
				div.author-bio .author-link {
					color: ' . esc_attr( newspack_color_with_contrast( $colors['primary'] ) ) . ';
				}
			';

			if ( true === get_theme_mod( 'header_solid_background', false ) ) {
				$theme_css .= '
					.mobile-sidebar .nav3 .menu-highlight a {
						background: ' . esc_attr( newspack_adjust_brightness( $colors['header'], -20 ) ) . ';
					}
					.h-sb .site-header .nav3 a {
						background-color: ' . newspack_adjust_brightness( $colors['header'], -17 ) . ';
						color: ' . esc_attr( $colors['header_contrast'] ) . ';
					}
					.h-sb .site-header .nav3 .menu-highlight a {
						color: ' . esc_attr( $colors['secondary_contrast'] ) . ';
					}
				';
			}

			if ( isset( $colors['footer'] ) && '' !== $colors['footer'] ) {
				$theme_css .= '
					.site-footer .footer-branding .wrapper,
					.site-footer .footer-widgets:first-child .wrapper {
						border-top: 0;
					}

					.site-footer .accent-header,
					.site-footer .article-section-title {
						border-color: ' . newspack_adjust_brightness( $colors['footer'], -20 ) . ';
					}

					.site-footer .accent-header,
					.site-footer .article-section-title {
						color: ' . esc_attr( $colors['footer_contrast'] ) . ';
					}
				';
			}
		}

		if ( ! is_child_theme() ) {
			$theme_css .= '
				.archive .page-title,
				.entry-meta .byline a,
				.entry-meta .byline a:visited {
					color: ' . esc_attr( newspack_color_with_contrast( $colors['primary'] ) ) . ';
				}

				.entry-meta .byline a:hover,
				.entry-meta .byline a:visited:hover,
				footer.entry-footer a {
					color: ' . esc_attr( newspack_color_with_contrast( newspack_adjust_brightness( $colors['primary'], -40 ) ) ) . ';
				}
			';

			if ( true === get_theme_mod( 'header_solid_background', false ) ) {
				$theme_css .= '
					/* Header solid background */
					.h-sb .middle-header-contain {
						background-color: ' . esc_attr( $colors['header'] ) . ';
					}
					.h-sb .top-header-contain {
						background-color: ' . esc_attr( newspack_adjust_brightness( $colors['header'], -10 ) ) . ';
						border-bottom-color: ' . esc_attr( newspack_adjust_brightness( $colors['header'], -15 ) ) . ';
					}
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
						color: ' . esc_attr( $colors['header_contrast'] ) . ';
					}
				';
			}
		}
	}

	// Front-end colors that don't require the theme_colors to be set to 'custom':
	if ( newspack_get_mobile_cta_color() !== $colors['cta'] ) {
		$theme_css .= '
			.button.mb-cta,
			.button.mb-cta:not(:hover):visited,
			.tribe_community_edit .button.mb-cta {
				background-color: ' . esc_attr( $colors['cta'] ) . ';
				color: ' . esc_attr( $colors['cta_contrast'] ) . ';
			}
		';
	}

	// Set ads background color
	if ( 'default' !== get_theme_mod( 'ads_color', 'default' ) ) {
		$theme_css .= '
			.site .entry .entry-content .scaip .newspack_global_ad,
			.site .entry .entry-content .scaip .widget_newspack-ads-widget,
			.newspack_global_ad,
			.newspack_global_ad.global_above_header,
			.widget_newspack-ads-widget,
			div[class*="newspack-ads-blocks-ad-unit"] {
				background-color: ' . esc_attr( get_theme_mod( 'ads_color_hex', '#ffffff' ) ) . ';
			}
		';
	}

	$editor_css .= '
		/* This is editor CSS */

		.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a {
			color: ' . esc_attr( newspack_color_with_contrast( $colors['primary'] ) ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button {
			color: ' . esc_attr( $colors['primary_contrast'] ) . ';
		}

		.edit-post-visual-editor .editor-styles-wrapper .has-primary-variation-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-variation-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-variation-background-color {
			background-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-variation-border-color {
			border-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
		}

		/* Secondary color */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"],
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-search__button {
			color: ' . esc_attr( $colors['secondary_contrast'] ) . '; /* base: #0073a8; */
		}

		/* Hover colors */
		.block-editor-block-list__layout .block-editor-block-list__block a,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link:not(.has-text-color), /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__textlink {
			color: ' . esc_attr( newspack_color_with_contrast( $colors['secondary'] ) ) . ';
		}

		/* Do not overwrite solid color pullquote or cover links */
		.block-editor-block-list__layout .block-editor-block-list__block a.more-link,
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

	if ( ! is_child_theme() ) {
		$editor_css .= '
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-homepage-articles:not(.has-text-color) .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block.accent-header {
				color: ' . esc_attr( newspack_color_with_contrast( $colors['primary'] ) ) . ';
			}
		';
	}

	if ( 'default' !== get_theme_mod( 'ads_color', 'default' ) ) {
		$editor_css .= '
			.wp-block-newspack-ads-blocks-ad-unit > div {
				background-color: ' . esc_attr( get_theme_mod( 'ads_color_hex', '#ffffff' ) ) . ';
				padding: 8px;
			}
		';
	}

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}
