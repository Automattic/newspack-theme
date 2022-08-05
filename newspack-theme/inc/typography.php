<?php
/**
 * Newspack Theme: Typography
 *
 * @package Newspack
 */

/**
 * Generate the CSS for custom typography.
 */
function newspack_custom_typography_css() {

	$font_body   = newspack_font_stack( get_theme_mod( 'font_body', '' ), get_theme_mod( 'font_body_stack', 'serif' ) );
	$font_header = newspack_font_stack( get_theme_mod( 'font_header', '' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks        = '';
	$editor_css_blocks = '';

	if ( get_theme_mod( 'font_header', '' ) ) {
		$css_blocks .= '
		/* _headings.scss */
		.author-bio .author-link,
		.author-meta,
		.comment-metadata,
		.comment-reply-link,
		.comment-reply-login,
		.comments-title,
		.comment-author .fn,
		.discussion-meta-info,
		.cat-links,
		amp-script .cat-links,
		.entry-meta,
		.entry-footer,
		.nav1,
		.no-comments,
		.not-found .page-title,
		.error-404 .page-title,
		.page-links,
		.page-description,
		.pagination .nav-links,
		.sticky-post,
		.site-title,
		.site-description,
		.site-info,
		#cancel-comment-reply-link,
		.jp-relatedposts-i2 a,
		.page-title,
		.wp-block-post-date,
		.wp-block-post-terms,
		.wp-block-query-pagination,
		.wp-block-loginout,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,

		/* _tables.scss */
		table,

		/* _buttons.scss */
		.button,
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.wp-block-search__button-outside .wp-block-search__button,

		/* _blocks.scss */
		.wp-block-button__link,
		.wp-block-jetpack-button button.wp-block-button__link,

		/* _captions.scss */
		figcaption,
		.wp-caption-text,
		.gallery-caption,
		.amp-image-lightbox-caption,

		/* _infinite_scroll.scss */
		.site-main #infinite-handle span button,
		.site-main #infinite-handle span button:hover,
		.site-main #infinite-handle span button:focus,

		/* _menu-main-navigation.scss */
		.nav1 button,
		.mobile-menu-toggle,

		/* _menu-tertiary-navigation.scss */
		.nav3,

		/* _menu-top-navigation.scss */
		.secondary-menu,

		/* _menu-highlight-navigation.scss */
		.highlight-menu-contain .wrapper,

		/* _next_previous.scss */
		.comment-navigation .nav-previous,
		.comment-navigation .nav-next,
		.post-navigation,

		/* _comments.scss */
		.comment-list .pingback .comment-body,
		.comment-list .trackback .comment-body,
		.comment-list .pingback .comment-body .comment-edit-link,
		.comment-list .trackback .comment-body .comment-edit-link,
		.comment-form label,
		.comment-form .comment-notes,

		/* _blocks.scss */
		.wp-block-latest-comments .wp-block-latest-comments__comment-meta,
		.wp-block-pullquote cite,
		.wp-block-categories li,
		.wp-block-archives li,
		.wp-block-latest-posts li > a,
		.wp-block-latest-posts time,
		.wp-block-file,
		.wp-block-file .wp-block-file__button,
		.wpbnbd .freq-label,
		.wpbnbd .tier-label,

		/* _widgets.scss */
		.widget,
		.widget_archive ul li,
		.widget_categories ul li,
		.widget_meta ul li,
		.widget_nav_menu ul li,
		.widget_pages ul li,
		.widget_recent_comments ul li,
		.widget_recent_entries ul li,
		.widget_rss ul li,
		.widget_tag_cloud .tagcloud,

		/* _copy.scss */
		blockquote cite,

		/* Jetpack */
		.jp-relatedposts-i2,
		#jp-relatedposts.jp-relatedposts,
		.jp-relatedposts-i2 .jp-relatedposts-headline,
		#jp-relatedposts.jp-relatedposts .jp-relatedposts-headline,

		/* Yoast Breadcrumbs */
		.site-breadcrumb .wrapper > span,

		/* WooCommerce */
		.woocommerce-breadcrumb,
		.woocommerce-pagination,
		.woocommerce .onsale,
		.woocommerce .price,
		.woocommerce .product_meta,
		.woocommerce-review-link,
		.woocommerce-grouped-product-list,
		.woocommerce .first-payment-date,
		.woocommerce-message,
		.woocommerce-error,
		.woocommerce-info,
		ul.products .added_to_cart,
		.woocommerce-tabs ul,
		.woocommerce-MyAccount-navigation,
		.woocommerce-Reviews .comment-reply-title,
		.woocommerce-results-wrapper,
		.product .nyp
		{
			font-family: ' . wp_kses( $font_header, null ) . ';
		}';

		if ( class_exists( 'Tribe__Main' ) ) {
			$css_blocks .= '
			/* The Events Calendar */
			body div.tribe-common .tribe-common-form-control-checkbox__label,
			body div.tribe-common .tribe-common-form-control-radio__label,
			body div.tribe-common .tribe-common-form-control-slider__label,
			body div.tribe-common--breakpoint-medium.tribe-common .tribe-common-form-control-text__input,
			body div.tribe-common .tribe-common-form-control-text__input,
			body div#top .main_color .tribe-common .tribe-common-form-control-text__input,
			body div#top.tribe-theme-enfold .tribe-common .tribe-common-form-control-text__input,
			body div#top .main_color .tribe-common.tribe-common--breakpoint-medium .tribe-common-form-control-text__input,
			body div#top.tribe-theme-enfold .tribe-common.tribe-common--breakpoint-medium .tribe-common-form-control-text__input,
			body div.tribe-common .tribe-common-form-control-toggle__label,
			body div.tribe-common .tribe-common-b1,
			body div.tribe-common .tribe-common-b2,
			body div.tribe-common .tribe-common-b3,
			body div.tribe-common .tribe-common-cta,
			body div.tribe-common .tribe-common-h1,
			body div.tribe-common .tribe-common-h2,
			body div.tribe-common .tribe-common-h3,
			body div.tribe-common .tribe-common-h4,
			body div.tribe-common .tribe-common-h5,
			body div.tribe-common .tribe-common-h6,
			body div.tribe-common .tribe-common-h7,
			body div.tribe-common .tribe-common-h8,
			body div.tribe-common .tribe-common-c-btn-border,
			body div.tribe-common a.tribe-common-c-btn-border,
			body div.tribe-common .tribe-common-c-btn-border-small,
			body div.tribe-common a.tribe-common-c-btn-border-small,
			body div.tribe-common .tribe-common-c-btn,
			body div.tribe-common a.tribe-common-c-btn,
			body div.tribe-events .tribe-events-c-breadcrumbs__list,
			body div.tribe-events .datepicker .datepicker-switch,
			body div.tribe-events .datepicker .day,
			body div.tribe-events .datepicker .dow,
			body div.tribe-events .datepicker .month,
			body div.tribe-events .datepicker .year,
			body div.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-view-selector--labels .tribe-events-c-view-selector__button-text,
			body div.tribe-events .tribe-events-c-view-selector__list-item-text,
			body div.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
			body div.tribe-events .tribe-events-calendar-month__calendar-event-datetime,
			body div.tribe-events .tribe-events-calendar-month__calendar-event-tooltip-datetime,
			body div.tribe-events .tribe-events-calendar-latest-past__event-date-tag-month,
			body div.tribe-events .tribe-events-calendar-latest-past__event-date-tag-year,
			body div.tribe-events-widget .tribe-events-widget-countdown__number,

			/* TEC - single event view */
			p.tribe-events-back a,
			p.tribe-events-back a:visited,
			div .tribe-events-single-event-title,
			div.tribe-events-schedule .recurringinfo,
			div.tribe-events-schedule h2,
			div.tribe-related-event-info .recurringinfo,
			div.tribe-events-schedule .tribe-events-cost,
			div.tribe-events-content h2,
			div.tribe-events-content h3,
			div.tribe-events-content h4,
			div.tribe-events-content h5,
			div.tribe-events-content h6,
			div.tribe-events-cal-links,
			div.tribe-events-event-meta,
			h2.tribe-events-related-events-title,
			div.tribe-events-single ul.tribe-related-events li,
			div.tribe-events-single ul.tribe-related-events li .tribe-related-events-title,
			div.tribe-events-single .tribe-events-sub-nav,
			div#top.tribe-theme-enfold.single-tribe_events .tribe-events-single-event-title,
			div#top.tribe-theme-enfold.single-tribe_events .tribe-events-schedule h3,
			div.tribe-events-widget .tribe-events-widget-countdown__number,

			/* Mobile CTA fix */
			.tribe_community_edit .button.mb-cta
			{
				font-family: ' . wp_kses( $font_header, null ) . ';
			}';
		}

		$editor_css_blocks .= '
		.editor-styles-wrapper .block-editor-block-list__layout h1,
		.editor-styles-wrapper .block-editor-block-list__layout h2,
		.editor-styles-wrapper .block-editor-block-list__layout h3,
		.editor-styles-wrapper .block-editor-block-list__layout h4,
		.editor-styles-wrapper .block-editor-block-list__layout h5,
		.editor-styles-wrapper .block-editor-block-list__layout h6,
		.block-editor-block-list__layout .block-editor-block-list__block figcaption,
		.block-editor-block-list__layout .block-editor-block-list__block .gallery-caption,
		.block-editor-block-list__layout .block-editor-block-list__block .cat-links,

		/* Post Title */
		.edit-post-visual-editor.editor-styles-wrapper .editor-post-title__block .editor-post-title__input, /* legacy */
		.edit-post-visual-editor .editor-styles-wrapper .editor-post-title__block .editor-post-title__input, /* legacy */
		.editor-styles-wrapper .edit-post-visual-editor__post-title-wrapper h1.wp-block-post-title,

		/* Homepage Posts Block */
		.block-editor-block-list__layout .wp-block .entry-title,
		.block-editor-block-list__layout .wp-block .entry-meta,

		/* Query Block */
		.block-editor-block-list__layout .wp-block.wp-block-post-date,
		.block-editor-block-list__layout .wp-block.wp-block-post-terms,
		.block-editor-block-list__layout .wp-block.wp-block-query-pagination,

		/* Login/out Block */
		.block-editor-block-list__layout .wp-block.wp-block-loginout,

		/* Table Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-table th, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-table td, /* legacy */
		.block-editor-block-list__layout .wp-block-table th,
		.block-editor-block-list__layout .wp-block-table td,

		/* Button Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link,

		/* Blockquote Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote cite, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote footer,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote .wp-block-quote__citation,
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-quote cite,
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-quote footer,
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-quote .wp-block-quote__citation,

		/* Pullquote Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block[data-type="core/pullquote"][data-align="left"] .wp-block-pullquote__citation,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block[data-type="core/pullquote"][data-align="right"] .wp-block-pullquote__citation,
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-pullquote .wp-block-pullquote__citation,

		/* File Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-file,

		/* Search Block */
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-search .wp-block-search__button,

		/* Widget blocks */
		.block-editor-block-list__layout .block-editor-block-list__block ul.wp-block-archives li,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-categories li, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-categories li,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-latest-posts li > a, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-latest-posts li > a,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-latest-posts time, /* legacy */
		.block-editor-block-list__layout .block-editor-block-list__block.wp-block-latest-posts time,

		/* Latest Comments blocks */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-latest-comments .wp-block-latest-comments__comment-meta,

		/* Jetpack blocks */
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 a,
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 strong,
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 .jp-related-posts-i2__post-date,
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 .jp-related-posts-i2__post-context,

		/* Donate block */
		.block-editor-block-list__layout .block-editor-block-list__block .wpbnbd .freq-label,
		.block-editor-block-list__layout .block-editor-block-list__block .wpbnbd .tier-label,
		.block-editor-block-list__layout .block-editor-block-list__block .wpbnbd button,

		/* Reader Registration Block */
		.block-editor-block-list__layout .block-editor-block-list__block .newspack-registration button,

		/* Classic Editor */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-caption dd,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-freeform blockquote cite

		{
			font-family: ' . wp_kses( $font_header, null ) . ';
		}
		';
	}

	if ( get_theme_mod( 'font_body', '' ) ) {
		$css_blocks .= '
		/* _typography.scss */
		body,
		input,
		select,
		optgroup,
		textarea,

		/* _blocks.scss */
		.wp-block-verse
		{
			font-family: ' . wp_kses( $font_body, null ) . ';
		}
		';

		if ( class_exists( 'Tribe__Main' ) ) {
			$css_blocks .= '
			div.tribe-common p,
			div.tribe-events-content
			{
				font-family: ' . wp_kses( $font_body, null ) . ';
			}
			';
		}

		$editor_css_blocks .= '
			#newspack-post-subtitle-element,
			.block-editor-block-list__layout,
			.editor-default-block-appender .editor-default-block-appender__content
			{
				font-family: ' . wp_kses( $font_body, null ) . ';
			}
		';
	}

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks .= '
			.tags-links span:first-child,
			.cat-links,
			.page-title,
			.highlight-menu .menu-label {
				text-transform: uppercase;
			}
		';

		$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block .cat-links,
			.block-editor-block-list__layout .block-editor-block-list__block #jp-relatedposts h3.jp-relatedposts-headline {
				text-transform: uppercase;
			}
		';

		if ( ! is_child_theme() ) {
			$css_blocks        .= '
				.accent-header,
				#secondary .widgettitle,
				.article-section-title {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.block-editor-block-list__layout .block-editor-block-list__block.accent-header,
				.block-editor-block-list__layout .block-editor-block-list__block .article-section-title {
					text-transform: uppercase;
				}
			';
		}
	}

	if ( '' !== $css_blocks ) {
		$theme_css = $css_blocks;
	} else {
		$theme_css = '';
	}

	if ( '' !== $editor_css_blocks ) {
		$editor_css = $editor_css_blocks;
	} else {
		$editor_css = '';
	}

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	return $theme_css;
}

/**
 * Generate link elements for custom typography stylesheets.
 */
function newspack_custom_typography_link( $theme_mod ) {
	$font_code = get_theme_mod( $theme_mod, '' );
	if ( ! $font_code ) {
		return false;
	}
	return $font_code;
}

/**
 * Fallback font stacks
 */
function newspack_get_font_stacks() {
	return array(
		'serif'      => array(
			'name'  => __( 'Serif', 'newspack' ),
			'fonts' => array(
				'Georgia',
				'serif',
			),
		),
		'sans_serif' => array(
			'name'  => __( 'Sans Serif', 'newspack' ),
			'fonts' => array(
				'Helvetica',
				'sans-serif',
			),
		),
		'display'    => array(
			'name'  => __( 'Display', 'newspack' ),
			'fonts' => array(
				'Impact',
				'Arial Black',
				'sans-serif',
			),
		),
		'monospace'  => array(
			'name'  => __( 'Monospace', 'newspack' ),
			'fonts' => array(
				'Consolas',
				'Courier New',
				'Courier',
				'monospace'
			),
		),
	);
}

/**
 * Prepare fallback font stacks for use in a Select element
 */
function newspack_get_font_stacks_as_select_choices() {
	$stacks = array();
	foreach ( newspack_get_font_stacks() as $key => $value ) {
		$stacks[ $key ] = wp_kses( $value['name'], null );
	}
	return $stacks;
}

/**
 * Prepare a font-family definition with a primary font and fallbacks.
 */
function newspack_font_stack( $primary_font, $fallback_id ) {
	$stacks = newspack_get_font_stacks();
	$fonts  = isset( $stacks[ $fallback_id ] ) ? $stacks[ $fallback_id ]['fonts'] : array();
	array_unshift( $fonts, $primary_font );
	foreach ( $fonts as &$font ) {
		$font = '"' . $font . '"';
	}
	return implode( ',', $fonts );
}
