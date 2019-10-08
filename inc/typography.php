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
		$css_blocks .= "
		/* _headings.scss */
		.author-description .author-link,
		.comment-metadata,
		.comment-reply-link,
		.comments-title,
		.comment-author .fn,
		.discussion-meta-info,
		.entry-meta,
		.entry-footer,
		.main-navigation,
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
		input[type=\"button\"],
		input[type=\"reset\"],
		input[type=\"submit\"],

		/* _captions.scss */
		.wp-caption-text,
		.gallery-caption,

		/* _infinite_scroll.scss */
		.site-main #infinite-handle span button,
		.site-main #infinite-handle span button:hover,
		.site-main #infinite-handle span button:focus,

		/* _menu-main-navigation.scss */
		.main-navigation button,

		/* _menu-tertiary-navigation.scss */
		.tertiary-menu,

		/* _menu-top-navigation.scss */
		.secondary-menu,

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

		/* _widgets.scss */
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
		blockquote cite

		{
			font-family: $font_header;
		}";

		if ( newspack_is_active_style_pack( 'style-1' ) ) {
			$css_blocks .= "
			.has-drop-cap:not(:focus)::first-letter,
			.entry .entry-content .wp-block-pullquote,
			.entry .entry-content .wp-block-pullquote cite {
				font-family: $font_header;
			}";
		}

		if ( newspack_is_active_style_pack( 'style-2' ) ) {
			$css_blocks .= "
			blockquote,
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description {
				font-family: $font_header;
			}";
		}

		if ( newspack_is_active_style_pack( 'style-3' ) ) {
			$css_blocks .= "
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description {
				font-family: $font_header;
			}";
		}

		if ( newspack_is_active_style_pack( 'style-4' ) ) {
			$css_blocks .= "
			.has-drop-cap:not(:focus)::first-letter,
			.taxonomy-description,
			.entry .entry-content blockquote, .entry .entry-content blockquote cite, .entry .entry-content .wp-block-pullquote cite {
				font-family: $font_header;
			}
			";
		}

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$css_blocks .= "
			.entry .entry-content .has-drop-cap:not(:focus)::first-letter,
			.entry .entry-content .wp-block-pullquote {
				font-family: $font_header;
			}
			.entry-meta,
			.cat-links,
			.entry-footer,
			.main-navigation,
			.secondary-menu,
			.tertiary-menu,
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
			}";
		}

		$editor_css_blocks .= "
		.editor-block-list__layout .editor-block-list__block h1,
		.editor-block-list__layout .editor-block-list__block h2,
		.editor-block-list__layout .editor-block-list__block h3,
		.editor-block-list__layout .editor-block-list__block h4,
		.editor-block-list__layout .editor-block-list__block h5,
		.editor-block-list__layout .editor-block-list__block h6,
		.editor-block-list__layout .editor-block-list__block figcaption,
		.editor-block-list__layout .editor-block-list__block .gallery-caption,

		/* Post Title */
		.editor-styles-wrapper .editor-post-title .editor-post-title__block .editor-post-title__input,

		/* Table Block */
		.editor-block-list__layout .editor-block-list__block .wp-block-table,

		/* Cover Block */
		.editor-block-list__layout .editor-block-list__block .wp-block-cover h2,
		.editor-block-list__layout .editor-block-list__block .wp-block-cover .wp-block-cover-text,

		/* Button Block */
		.editor-block-list__layout .editor-block-list__block .wp-block-button .wp-block-button__link,

		/* Blockquote Block */
		.editor-block-list__layout .editor-block-list__block .wp-block-quote cite,
		.editor-block-list__layout .editor-block-list__block .wp-block-quote footer,
		.editor-block-list__layout .editor-block-list__block .wp-block-quote .wp-block-quote__citation,

		/* Pullquote Block */
		.editor-block-list__layout .editor-block-list__block .wp-block[data-type='core/pullquote'] .wp-block-pullquote__citation,
		.editor-block-list__layout .editor-block-list__block .wp-block[data-type='core/pullquote'][data-align='left'] .wp-block-pullquote__citation,
		.editor-block-list__layout .editor-block-list__block .wp-block[data-type='core/pullquote'][data-align='right'] .wp-block-pullquote__citation,

		/* File Block */
		.editor-block-list__layout .editor-block-list__block .wp-block-file,

		/* Widget blocks */
		.editor-block-list__layout .editor-block-list__block ul.wp-block-archives li,
		.editor-block-list__layout .editor-block-list__block .wp-block-categories li,
		.editor-block-list__layout .editor-block-list__block .wp-block-latest-posts li,

		/* Latest Comments blocks */
		.editor-block-list__layout .editor-block-list__block .wp-block-latest-comments .wp-block-latest-comments__comment-meta,

		/* Jetpack blocks */
		.editor-block-list__layout .editor-block-list__block .jp-relatedposts-i2 a,
		.editor-block-list__layout .editor-block-list__block .jp-relatedposts-i2 strong,

		/* Classic Editor */
		.editor-block-list__layout .editor-block-list__block .wp-caption dd,
		.editor-block-list__layout .editor-block-list__block .wp-block-freeform blockquote cite

		{
			font-family: $font_header;
		}
		";

		if ( newspack_is_active_style_pack( 'style-1' ) ) {
			$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] blockquote > .editor-rich-text p,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] p,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] .wp-block-pullquote__citation,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] .block-library-pullquote__content::before

			{
				font-family: $font_header;
			}
			";
		}

		if ( newspack_is_active_style_pack( 'style-2' ) ) {
			$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block blockquote,
			.editor-block-list__layout .editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter

			{
				font-family: $font_header;
			}
			";
		}


		if ( newspack_is_active_style_pack( 'style-3' ) ) {
			$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter

			{
				font-family: $font_header;
			}
			";
		}

		if ( newspack_is_active_style_pack( 'style-4' ) ) {
			$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] blockquote > .block-library-pullquote__content .editor-rich-text__tinymce[data-is-empty='true']::before,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] blockquote > .editor-rich-text p,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] p,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] .wp-block-pullquote__citation {
				font-family: $font_header;
			}";
		}

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block .wp-block-paragraph.has-drop-cap:not(:focus)::first-letter,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] blockquote > .editor-rich-text p,
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] p {
				font-family: $font_header;
			}
			.editor-block-list__layout .editor-block-list__block .article-section-title,
			.editor-block-list__layout .editor-block-list__block .accent-header {
				font-family: inherit;
			}";
		}
	}

	if ( get_theme_mod( 'font_body', '' ) ) {
		$css_blocks .= "
		/* _typography.scss */
		body,
		button,
		input,
		select,
		optgroup,
		textarea,

		/* _blocks.scss */
		.entry .entry-content .wp-block-verse,
		.page-title
		{
			font-family: $font_body;
		}
		";

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$css_blocks .= "
			.entry .entry-content .wp-block-pullquote cite {
				font-family: $font_body;
			}";
		}

		$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block,
			.editor-default-block-appender .editor-default-block-appender__content
			{
				font-family: $font_body;
			}
		";

		if ( newspack_is_active_style_pack( 'style-5' ) ) {
			$editor_css_blocks .= "
			.editor-block-list__layout .editor-block-list__block.wp-block[data-type='core/pullquote'] .wp-block-pullquote__citation {
				font-family: $font_body;
			}";
		}
	}

	if ( true === get_theme_mod( 'accent_allcaps', true ) ) {
		$css_blocks .= '
			.tags-links span:first-child,
			.page-title,
			.highlight-menu .menu-label {
				text-transform: uppercase;
			}
		';

		if ( newspack_is_active_style_pack( 'default', 'style-4', 'style-5' ) ) {
			$css_blocks        .= '
				.accent-header,
				.article-section-title,
				.cat-links a {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.accent-header,
				.article-section-title {
					text-transform: uppercase;
				}
			';
		}

		if ( newspack_is_active_style_pack( 'style-1' ) ) {
			$css_blocks        .= '
				.accent-header:not(.widget-title),
				.article-section-title,
				.cat-links,
				.page-title,
				#secondary .widget-title,
				.author-bio .accent-header span,
				.entry .entry-content .wp-block-pullquote cite,
				#colophon .widget-title {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.editor-block-list__layout .editor-block-list__block .accent-header,
				.editor-block-list__layout .editor-block-list__block .article-section-title,
				.editor-block-list__layout .editor-block-list__block .wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation {
					text-transform: uppercase;
				}
			';
		}

		if ( newspack_is_active_style_pack( 'style-2' ) ) {
			$css_blocks        .= '
				.main-navigation ul li,
				.tertiary-menu,
				.mobile-menu-toggle,
				.accent-header,
				.site-content .wp-block-newspack-blocks-homepage-articles .article-section-title,
				.cat-links,
				.entry-meta .byline a,
				.tags-links a,
				.post-edit-link,
				.entry .entry-content .wp-block-pullquote cite,
				.author-bio h2 span,
				.site-footer .widget-title {
					letter-spacing: 0.05em;
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.editor-block-list__layout .editor-block-list__block .accent-header,
				.editor-block-list__layout .editor-block-list__block .article-section-title,
				.editor-block-list__layout .editor-block-list__block .entry-meta .byline a,
				.editor-block-list__layout .editor-block-list__block .wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation {
					letter-spacing: 0.05em;
					text-transform: uppercase;
				}
			';
		}

		if ( newspack_is_active_style_pack( 'style-3' ) ) {
			$css_blocks        .= '
				.accent-header,
				.site-content .wp-block-newspack-blocks-homepage-articles .article-section-title,
				.cat-links,
				.archive .page-title,
				.author-bio h2 span,
				.entry-meta .byline a,
				.entry-meta .entry-date,
				.entry .entry-content .wp-block-pullquote cite,
				.site-footer .widget-title,
				.site-info {
					text-transform: uppercase;
				}
			';
			$editor_css_blocks .= '
				.editor-block-list__layout .editor-block-list__block .accent-header,
				.editor-block-list__layout .editor-block-list__block .article-section-title,
				.editor-block-list__layout .editor-block-list__block .entry-meta .byline a,
				.editor-block-list__layout .editor-block-list__block .entry-meta .entry-date,
				.editor-block-list__layout .editor-block-list__block .wp-block[data-type="core/pullquote"] .wp-block-pullquote__citation {
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
