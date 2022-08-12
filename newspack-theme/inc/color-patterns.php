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

	// Front-end colors that require the theme_colors to be set to 'custom':
	if ( 'default' !== get_theme_mod( 'theme_colors', 'default' ) ) {
		$theme_css .= '
			/* Set primary background color */
			.mobile-sidebar,
			/* Header default background; header default height */
			body.h-db.h-dh .site-header .nav3 .menu-highlight a,
			.has-primary-background-color,
			*[class^="wp-block-"].has-primary-background-color,
			*[class^="wp-block-"] .has-primary-background-color,
			*[class^="wp-block-"].is-style-solid-color,
			*[class^="wp-block-"].is-style-solid-color.has-primary-background-color,
			.is-style-outline .wp-block-button__link.has-primary-background-color:not( :hover ),
			.wp-block-search__button-outside .wp-block-search__button,
			.wp-block-file .wp-block-file__button,
			div.wpbnbd.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label,
			.comment .comment-author .post-author-badge,
			.woocommerce .onsale,
			.woocommerce-store-notice,
			.logged-in.page-template-single-wide.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
			.logged-in.page-template-single-feature.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a {
				background-color: ' . esc_attr( $colors['primary'] ) . '; /* base: #0073a8; */
			}

			@media only screen and (min-width: 782px) {
				/* Header default background */
				.h-db .featured-image-beside {
					background-color: ' . esc_attr( $colors['primary'] ) . ';
				}
			}

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

			/* Set primary color */

			.has-primary-color,
			*[class^="wp-block-"] .has-primary-color,
			*[class^="wp-block-"] .has-primary-color:visited:not(:hover),
			*[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color,
			*[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color p,
			.is-style-outline .wp-block-button__link.has-primary-color:not(:hover), /* legacy styles */
			.wp-block-button__link.is-style-outline.has-primary-color:not(:hover) {
				color: ' . esc_attr( $colors['primary'] ) . ';
			}

			/* Set color that contrasts against the primary color */
			.mobile-sidebar,
			.mobile-sidebar button:hover,
			.mobile-sidebar a,
			.mobile-sidebar a:visited,
			.mobile-sidebar .nav1 .sub-menu > li > a,
			.mobile-sidebar .nav1 ul.main-menu > li > a,
			.wp-block-search__button-outside .wp-block-search__button,
			.wp-block-file .wp-block-file__button,
			.highlight-menu .menu-label,
			/* Header default background; default height */
			body.h-db.h-dh .site-header .nav3 .menu-highlight a,
			.comment .comment-author .post-author-badge,
			div.wpbnbd.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label,
			.woocommerce .onsale,
			.woocommerce-store-notice,
			.logged-in.page-template-single-wide.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
			.logged-in.page-template-single-feature.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a {
				color: ' . esc_attr( $colors['primary_contrast'] ) . ';
			}

			@media only screen and (min-width: 782px) {
				/* Header default background */
				.h-db .featured-image-beside .entry-header,
				.h-db.h-sub.single-featured-image-beside .middle-header-contain {
					color: ' . esc_attr( $colors['primary_contrast'] ) . ';
				}
			}

			/* Set primary border color */

			blockquote,
			.wp-block-quote:not(.is-large),
			.wp-block-quote:not(.is-style-large),
			.woocommerce-tabs ul li.active a,
			.has-primary-border-color,
			.wp-block-pullquote.has-primary-border-color {
				border-color: ' . esc_attr( $colors['primary'] ) . '; /* base: #0073a8; */
			}

			.sponsor-uw-info {
				border-left-color: ' . esc_attr( $colors['primary'] ) . '; /* base: #0073a8; */
			}

			.mobile-sidebar nav + nav,
			.mobile-sidebar nav + .widget,
			.mobile-sidebar .widget + .widget {
				border-color: ' . esc_attr( $colors['primary_contrast'] ) . ';
			}

			.gallery-item > div > a:focus {
				box-shadow: 0 0 0 2px ' . esc_attr( $colors['primary'] ) . '; /* base: #0073a8; */
			}

			.wpnbha .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
			.wpnbpc .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
			.archive .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
			.search .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
			.blog .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
			.newspack-listings__curated-list .featured-listing .newspack-listings__listing-title::before {
				border-left-color: ' . esc_attr( $colors['primary'] ) . ';
				border-right-color: ' . esc_attr( $colors['primary'] ) . ';
			}

			/* Set secondary background color */

			.wp-block-button__link:not(.has-background),
			.button,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			input[type="checkbox"]:checked,
			.has-secondary-background-color,
			*[class^="wp-block-"].has-secondary-background-color,
			*[class^="wp-block-"] .has-secondary-background-color,
			*[class^="wp-block-"].is-style-solid-color.has-secondary-background-color,
			.is-style-outline .wp-block-button__link.has-secondary-background-color:not( :hover ) {
				background-color:' . esc_attr( $colors['secondary'] ) . '; /* base: #666 */
			}

			/* Set colour that contrasts against the secondary background */
			.wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color):not(:hover),
			.button,
			.button:visited,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"] {
				color: ' . esc_attr( $colors['secondary_contrast'] ) . ';
			}

			input[type="checkbox"]::before {
				background-image: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' width=\'24\' height=\'24\'%3E%3Cpath d=\'M16.7 7.1l-6.3 8.5-3.3-2.5-.9 1.2 4.5 3.4L17.9 8z\' fill=\'' . esc_attr( $colors['secondary_contrast'] ) . '\'%3E%3C/path%3E%3C/svg%3E");
			}

			/* Set secondary color */

			.has-secondary-color,
			*[class^="wp-block-"] .has-secondary-color,
			*[class^="wp-block-"] .has-secondary-color:visited:not(:hover),
			*[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color,
			*[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color p,
			.is-style-outline .wp-block-button__link.has-secondary-color:not(:hover), /* legacy styles */
			.wp-block-button__link.is-style-outline.has-secondary-color:not(:hover),
			.is-style-outline > .wp-block-button__link:not(.has-text-color):not(:hover) {
				color:' . esc_attr( $colors['secondary'] ) . '; /* base: #666 */
			}

			/* Set secondary color with contrast */
			.site-header .highlight-menu .menu-label,
			.entry-content a,
			.author-bio .author-link,
			.is-style-outline .wp-block-button__link, /* legacy selector */
			.wp-block-button__link.is-style-outline {
				color:' . esc_attr( newspack_color_with_contrast( $colors['secondary'] ) ) . ';
			}

			/* Set secondary border color */
			.has-secondary-border-color,
			.wp-block-pullquote.has-secondary-border-color {
				border-color:' . esc_attr( $colors['secondary'] ) . ';
			}

			/* Set primary variation background color */
			.has-primary-variation-background-color,
			*[class^="wp-block-"].has-primary-variation-background-color,
			*[class^="wp-block-"] .has-primary-variation-background-color,
			*[class^="wp-block-"].is-style-solid-color.has-primary-variation-background-color,
			.is-style-outline .wp-block-button__link.has-primary-variation-background-color:not( :hover )  {
				background-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . '; /* base: #005177; */
			}

			/* Set primary variation color */

			.author-bio .author-description .author-link:hover,
			.has-primary-variation-color,
			*[class^="wp-block-"] .has-primary-variation-color,
			*[class^="wp-block-"] .has-primary-variation-color:visited:not(:hover),
			*[class^="wp-block-"].is-style-solid-color blockquote.has-primary-variation-color,
			*[class^="wp-block-"].is-style-solid-color blockquote.has-primary-variation-color p,
			.comment .comment-author .fn a:hover,
			.comment-reply-link:hover,
			.comment-reply-login:hover,
			.comment-navigation .nav-previous a:hover,
			.comment-navigation .nav-next a:hover,
			#cancel-comment-reply-link:hover,
			.is-style-outline .wp-block-button__link.has-primary-variation-color:not(:hover), /* legacy styles */
			.wp-block-button__link.is-style-outline.has-primary-variation-color:not(:hover) {
				color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -40 ) ) . '; /* base: #0073a8; */
			}

			/* Set primary variation border color */
			.has-primary-variation-border-color,
			.wp-block-pullquote.has-primary-variation-border-color {
				border-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
			}

			/* Set secondary variation background color */

			.has-secondary-variation-background-color,
			*[class^="wp-block-"].has-secondary-variation-ackground-color,
			*[class^="wp-block-"] .has-secondary-variation-background-color,
			*[class^="wp-block-"].is-style-solid-color.has-secondary-variation-background-color,
			.is-style-outline .wp-block-button__link.has-secondary-variation-background-color:not( :hover ),
			#ship-to-different-address label input[type="checkbox"]:checked + span::before {
				background-color:' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . '; /* base: #666 */
			}

			/* Set secondary variation color */

			.entry-content a:hover,
			.widget a:hover,
			.author-bio .author-link:hover,
			.has-secondary-variation-color,
			*[class^="wp-block-"] .has-secondary-variation-color,
			*[class^="wp-block-"] .has-secondary-variation-color:visited:not(:hover),
			*[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color,
			*[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-variation-color p,
			.is-style-outline .wp-block-button__link.has-secondary-variation-color:not(:hover), /* legacy styles */
			.wp-block-button__link.is-style-outline.has-secondary-variation-color:not(:hover){
				color:' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . '; /* base: #666 */
			}

			/* Set secondary border */
			#ship-to-different-address label input[type="checkbox"]:checked + span::before,
			.has-secondary-variation-border-color,
			.wp-block-pullquote.has-secondary-variation-border-color {
				border-color:' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . ';
			}

			/* Set gradients */
			.has-grad-1-gradient-background {
				background-image: linear-gradient( 135deg, ' . esc_attr( $colors['primary'] ) . ' 0%, ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -40 ) ) . ' 100% );
			}
			.has-grad-2-gradient-background {
				background-image: linear-gradient( 135deg, ' . esc_attr( $colors['secondary'] ) . ' 0%, ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . ' 100% );
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
					background-color: ' . esc_attr( $colors['primary'] ) . ';
					color: ' . esc_attr( $colors['primary_contrast'] ) . ';
				}
				.cat-links a:hover {
					background-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -40 ) ) . ';
					color: ' . esc_attr( $colors['primary_contrast'] ) . ';
				}
				.accent-header,
				#secondary .widgettitle,
				.article-section-title,
				.entry .entry-footer a:hover {
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
						background-color: ' . $colors['secondary'] . ';
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

	$editor_css = '
		/*
		 * Set colors for:
		 * - links
		 * - blockquote
		 * - pullquote (solid color)
		 * - buttons
		 */

		.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a {
			color: ' . esc_attr( newspack_color_with_contrast( $colors['primary'] ) ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .block-editor-block-list__layout .wp-block-freeform blockquote,
		.edit-post-visual-editor.editor-styles-wrapper .has-primary-border-color {
			border-color: ' . esc_attr( $colors['primary'] ) . '; /* base: #0073a8; */
		}

		.editor-styles-wrapper .block-editor-block-list__block .wpnbha .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
		.editor-styles-wrapper .block-editor-block-list__block .wpnbpc .featured-listing[class*="type-newspack_lst_"] .entry-title a::before,
		.editor-styles-wrapper .block-editor-block-list__block .newspack-listings__curated-list .featured-listing .newspack-listings__listing-title::before {
			border-left-color: ' . esc_attr( $colors['primary'] ) . ';
			border-right-color: ' . esc_attr( $colors['primary'] ) . ';
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-file .wp-block-file__button,
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-search__button-outside .wp-block-search__button,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			background-color: ' . esc_attr( $colors['primary'] ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__button,
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-search__button-outside .wp-block-search__button,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate.tiered .wp-block-newspack-blocks-donate__tiers input[type="radio"]:checked + .tier-select-label {
			color: ' . esc_attr( $colors['primary_contrast'] ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-color, /* legacy */
		.edit-post-visual-editor .editor-styles-wrapper .has-primary-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-color {
			color: ' . esc_attr( $colors['primary'] ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-variation-color, /* legacy */
		.edit-post-visual-editor .editor-styles-wrapper .has-primary-variation-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-variation-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-variation-color {
			color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-background-color {
			background-color: ' . esc_attr( $colors['primary'] ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-variation-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-primary-variation-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-primary-variation-background-color {
			background-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-primary-variation-border-color {
			border-color: ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -30 ) ) . ';
		}

		/* Secondary color */

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link:not(.has-background),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"] {
			background-color: ' . esc_attr( $colors['secondary'] ) . '; /* base: #0073a8; */
		}

		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link:not(.has-text-color),
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-newspack-blocks-donate button[type="submit"] {
			color: ' . esc_attr( $colors['secondary_contrast'] ) . '; /* base: #0073a8; */
		}

		/* Hover colors */
		.block-editor-block-list__layout .block-editor-block-list__block a:hover,
		.block-editor-block-list__layout .block-editor-block-list__block a:active,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
			color: ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . '; /* base: #005177; */
		}

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

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-color, /* legacy */
		.edit-post-visual-editor .editor-styles-wrapper .has-secondary-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-color {
			color: ' . esc_attr( $colors['secondary'] ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-border-color {
			border-color: ' . esc_attr( $colors['secondary'] ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-variation-color, /* legacy */
		.edit-post-visual-editor .editor-styles-wrapper .has-secondary-variation-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-variation-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-variation-color {
			color: ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-background-color {
			background-color: ' . esc_attr( $colors['secondary'] ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-variation-background-color,
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline .wp-block-button__link.has-secondary-variation-background-color, /* legacy selector */
		.block-editor-block-list__layout .block-editor-block-list__block .is-style-outline.wp-block-button__link.has-secondary-variation-background-color {
			background-color: ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -30 ) ) . ';
		}

		.edit-post-visual-editor.editor-styles-wrapper .has-secondary-variation-border-color {
			border-color: ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -30 ) ) . ';
		}

		/* Set gradients */
		.editor-styles-wrapper .wp-block.has-grad-1-gradient-background,
		.editor-styles-wrapper .wp-block .has-grad-1-gradient-background {
			background-image: linear-gradient( 135deg, ' . esc_attr( $colors['primary'] ) . ' 0%, ' . esc_attr( newspack_adjust_brightness( $colors['primary'], -40 ) ) . ' 100% );
		}
		.editor-styles-wrapper .wp-block.has-grad-2-gradient-background,
		.editor-styles-wrapper .wp-block .has-grad-2-gradient-background {
			background-image: linear-gradient( 135deg, ' . esc_attr( $colors['secondary'] ) . ' 0%, ' . esc_attr( newspack_adjust_brightness( $colors['secondary'], -40 ) ) . ' 100% );
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
