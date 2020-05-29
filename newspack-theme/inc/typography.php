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
		.comments-title,
		.comment-author .fn,
		.discussion-meta-info,
		.cat-links,
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
		.site-info,
		#cancel-comment-reply-link,
		.entry .entry-content .jp-relatedposts-i2 a,
		.page-title,
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

		/* _blocks.scss */
		.entry .entry-content .wp-block-button__link,

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
		.entry .entry-content .wp-block-categories li,
		.entry .entry-content .wp-block-archives li,
		.entry .entry-content .wp-block-latest-posts li > a,
		.entry .entry-content .wp-block-latest-posts time,
		.entry .entry-content .wp-block-file,
		.entry .entry-content .wp-block-file .wp-block-file__button,

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
		.site-breadcrumb .wrapper > span
		{
			font-family: ' . wp_kses( $font_header, null ) . ';
		}';

		if ( newspack_is_active_style_pack( 'style-1' ) ) {
			$css_blocks .= '
			.has-drop-cap:not(:focus)::first-letter,
			.wp-block-pullquote,
			.wp-block-pullquote cite {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}';
		}

		if ( newspack_is_active_style_pack( 'style-2' ) ) {
			$css_blocks .= '
			blockquote,
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description
			{
				font-family: ' . wp_kses( $font_header, null ) . ';
			}';
		}

		if ( newspack_is_active_style_pack( 'style-3' ) ) {
			$css_blocks .= '
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description,
			.page-title {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}';
		}

		if ( newspack_is_active_style_pack( 'style-4' ) ) {
			$css_blocks .= '
			.site-description,
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description,
			.entry .entry-content blockquote, .entry .entry-content blockquote cite, .wp-block-pullquote cite {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			';
		}

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$css_blocks .= '
			.has-drop-cap:not(:focus)::first-letter,
			.entry .entry-content .wp-block-pullquote {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			figcaption,
			.entry-meta,
			.cat-links,
			.entry-footer,
			.nav1,
			.nav2,
			.nav3,
			.site-description,
			.site-info,
			#cancel-comment-reply-link,
			#mobile-sidebar,
			.widget,
			.widget-title.accent-header,
			.accent-header,
			.entry .entry-content .wp-block-button .wp-block-button__link,
			.entry .article-section-title,
			button,
			input[type=\"button\"],
			input[type=\"reset\"],
			input[type=\"submit\"] {
				font-family: inherit;
			}';
		}

		$editor_css_blocks .= '
		.edit-post-visual-editor.editor-styles-wrapper h1,
		.edit-post-visual-editor.editor-styles-wrapper h2,
		.edit-post-visual-editor.editor-styles-wrapper h3,
		.edit-post-visual-editor.editor-styles-wrapper h4,
		.edit-post-visual-editor.editor-styles-wrapper h5,
		.edit-post-visual-editor.editor-styles-wrapper h6,
		.block-editor-block-list__layout .block-editor-block-list__block figcaption,
		.block-editor-block-list__layout .block-editor-block-list__block .gallery-caption,
		.block-editor-block-list__layout .block-editor-block-list__block .cat-links,

		/* Post Title */
		.edit-post-visual-editor.editor-styles-wrapper .editor-post-title__block .editor-post-title__input,

		/* Homepage Posts Block */
		.block-editor-block-list__layout .wpnbha .entry-title,
		.block-editor-block-list__layout .wpnbha .entry-meta,

		/* Table Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-table th,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-table td,

		/* Button Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-button__link,

		/* Blockquote Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote cite,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote footer,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-quote .wp-block-quote__citation,

		/* Pullquote Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block[data-type="core/pullquote"][data-align="left"] .wp-block-pullquote__citation,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block[data-type="core/pullquote"][data-align="right"] .wp-block-pullquote__citation,

		/* File Block */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-file,

		/* Widget blocks */
		.block-editor-block-list__layout .block-editor-block-list__block ul.wp-block-archives li,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-categories li,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-latest-posts li > a,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-latest-posts time,

		/* Latest Comments blocks */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-latest-comments .wp-block-latest-comments__comment-meta,

		/* Jetpack blocks */
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 a,
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 strong,
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 .jp-related-posts-i2__post-date,
		.block-editor-block-list__layout .block-editor-block-list__block .jp-relatedposts-i2 .jp-related-posts-i2__post-context,

		/* Classic Editor */
		.block-editor-block-list__layout .block-editor-block-list__block .wp-caption dd,
		.block-editor-block-list__layout .block-editor-block-list__block .wp-block-freeform blockquote cite

		{
			font-family: ' . wp_kses( $font_header, null ) . ';
		}
		';

		if ( newspack_is_active_style_pack( 'style-1' ) ) {
			$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .editor-rich-text p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .editor-rich-text__editable:first-child::before

			{
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			';
		}

		if ( newspack_is_active_style_pack( 'style-2' ) ) {
			$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block blockquote,
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter

			{
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			';
		}


		if ( newspack_is_active_style_pack( 'style-3' ) ) {
			$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter

			{
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			';
		}

		if ( newspack_is_active_style_pack( 'style-4' ) ) {
			$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .block-library-pullquote__content .editor-rich-text__tinymce[data-is-empty="true"]::before,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .editor-rich-text p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation,
			.block-editor-block-list__layout .block-editor-block-list__block .entry-meta {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}';
		}

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] blockquote > .editor-rich-text p,
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] p {
				font-family: ' . wp_kses( $font_header, null ) . ';
			}
			.block-editor-block-list__layout .block-editor-block-list__block .article-section-title,
			.block-editor-block-list__layout .block-editor-block-list__block .accent-header {
				font-family: inherit;
			}';
		}
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
		.entry .entry-content .wp-block-verse
		{
			font-family: ' . wp_kses( $font_body, null ) . ';
		}
		';

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$css_blocks .= '
			.wp-block-pullquote cite {
				font-family: ' . wp_kses( $font_body, null ) . ';
			}';
		}

		$editor_css_blocks .= '
			#newspack-post-subtitle-element,
			.block-editor-block-list__layout,
			.editor-default-block-appender .editor-default-block-appender__content
			{
				font-family: ' . wp_kses( $font_body, null ) . ';
			}
		';

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$editor_css_blocks .= '
			.block-editor-block-list__layout .block-editor-block-list__block.wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation {
				font-family: ' . wp_kses( $font_body, null ) . ';
			}';
		}
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

		if ( newspack_is_active_style_pack( 'default', 'style-4', 'style-5' ) ) {
			$css_blocks        .= '
				.accent-header,
				.article-section-title {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
				.block-editor-block-list__layout .block-editor-block-list__block .article-section-title {
					text-transform: uppercase;
				}
			';
		}

		if ( newspack_is_active_style_pack( 'style-1' ) ) {
			$css_blocks        .= '
				.accent-header:not(.widget-title),
				.article-section-title,
				.page-title,
				#secondary .widget-title,
				.author-bio .accent-header span,
				#colophon .widget-title {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
				.block-editor-block-list__layout .block-editor-block-list__block .article-section-title {
					text-transform: uppercase;
				}
			';
		}

		if ( newspack_is_active_style_pack( 'style-2' ) ) {
			$css_blocks        .= '
				.nav1 ul li,
				.nav3,
				.mobile-menu-toggle,
				.accent-header,
				.cat-links,
				.site-content .wpnbha .article-section-title,
				.entry-meta .byline a,
				.tags-links a,
				.post-edit-link,
				.author-bio h2 span,
				.site-footer .widget-title {
					letter-spacing: 0.05em;
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
				.block-editor-block-list__layout .block-editor-block-list__block .article-section-title,
				.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
				.block-editor-block-list__layout .block-editor-block-list__block .cat-links {
					letter-spacing: 0.05em;
					text-transform: uppercase;
				}
			';
		}

		if ( newspack_is_active_style_pack( 'style-3' ) ) {
			$css_blocks        .= '
				.accent-header,
				.site-content .wpnbha .article-section-title,
				.archive .page-title,
				.author-bio h2 span,
				.entry-meta .byline a,
				.entry-meta .entry-date,
				.site-footer .widget-title,
				.site-info {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.block-editor-block-list__layout .block-editor-block-list__block .accent-header,
				.block-editor-block-list__layout .block-editor-block-list__block .article-section-title,
				.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .byline a,
				.block-editor-block-list__layout .block-editor-block-list__block .entry-meta .entry-date {
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
			'name'  => __( 'Serif' ),
			'fonts' => array(
				'Georgia',
				'Garamond',
				'Times New Roman',
				'serif',
			),
		),
		'sans_serif' => array(
			'name'  => __( 'Sans Serif' ),
			'fonts' => array(
				'-apple-system',
				'BlinkMacSystemFont',
				'Segoe UI',
				'Roboto',
				'Oxygen',
				'Ubuntu',
				'Cantarell',
				'Fira Sans',
				'Droid Sans',
				'Helvetica Neue',
				'sans-serif',
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
