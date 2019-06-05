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

	$font_body   = newspack_font_stack( get_theme_mod( 'font_body' ), get_theme_mod( 'font_body_stack', 'serif' ) );
	$font_header = newspack_font_stack( get_theme_mod( 'font_header' ), get_theme_mod( 'font_header_stack', 'serif' ) );

	$css_blocks = array();

	if ( get_theme_mod( 'font_header' ) ) {
		$css_blocks[] = "
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
		.post-navigation .post-title,
		.page-links,
		.page-description,
		.pagination .nav-links,
		.sticky-post,
		.site-title,
		.site-info,
		#cancel-comment-reply-link,
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
	}
	if ( get_theme_mod( 'font_body' ) ) {
		$css_blocks[] = "
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
	}
	if ( count( $css_blocks ) > 0 ) {
		$theme_css = "<style type='text/css' id='custom-typography'>\n" . implode( '', $css_blocks ) . "\n</style>";
	} else {
		$theme_css = '';
	}

	return $theme_css;
}

/**
 * Generate link elements for custom typography stylesheets.
 */
function newspack_custom_typography_link( $theme_mod ) {

	$font_code = get_theme_mod( $theme_mod );

	if ( $font_code ) {
		return "<link rel='stylesheet' href='" . esc_url( $font_code ) . "'>";
	}
	return '';
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
