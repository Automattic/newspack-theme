<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Newspack
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newspack_body_classes( $classes ) {

	if ( is_singular() ) {
		// Adds `singular` to singular pages.
		$classes[] = 'singular';
	} else {
		// Adds `hfeed` to non singular pages.
		$classes[] = 'hfeed';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'newspack-front-page';
	}

	// Adds a class when in the Customizer.
	if ( is_customize_preview() ) :
		$classes[] = 'newspack-customizer';
	endif;

	$hide_title = get_theme_mod( 'hide_front_page_title', false );
	if ( true === $hide_title ) {
		$classes[] = 'hide-homepage-title';
	}

	$show_tagline = get_theme_mod( 'header_display_tagline', true );
	if ( false === $show_tagline ) {
		$classes[] = 'hide-site-tagline';
	}

	// Adds classes to reflect the header layout
	$header_solid_background = get_theme_mod( 'header_solid_background', false );
	if ( true === $header_solid_background ) {
		$classes[] = 'header-solid-background';
	}

	$header_center_logo = get_theme_mod( 'header_center_logo', false );
	if ( true === $header_center_logo ) {
		$classes[] = 'header-center-logo';
	}

	$header_simplified = get_theme_mod( 'header_simplified', false );
	if ( true === $header_simplified ) {
		$classes[] = 'header-simplified';
	}

	// Adds a class of has-sidebar when there is a sidebar present.
	if ( is_active_sidebar( 'sidebar-1' ) && ! ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) ) {
		$classes[] = 'has-sidebar';
	}

	// Adds class if singular post or page has a featured image.
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	}

	// Adds a class if singular post has a large featured image
	$thumbnail_info = wp_get_attachment_metadata( get_post_thumbnail_id() );
	if ( is_single() && has_post_thumbnail() && 1200 > $thumbnail_info['width'] ) {
		$classes[] = 'has-large-featured-image';
	}

	return $classes;
}
add_filter( 'body_class', 'newspack_body_classes' );

/**
 * Adds custom class to the array of posts classes.
 */
function newspack_post_classes( $classes, $class, $post_id ) {
	$classes[] = 'entry';



	return $classes;
}
add_filter( 'post_class', 'newspack_post_classes', 10, 3 );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function newspack_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'newspack_pingback_header' );

/**
 * Changes comment form default fields.
 */
function newspack_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'newspack_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function newspack_get_the_archive_title() {
	if ( is_category() ) {
		$title = esc_html__( 'Category: ', 'newspack' ) . '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = esc_html__( 'Tag: ', 'newspack' ) . '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author Archives: ', 'newspack' ) . '<span class="page-description">' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = esc_html__( 'Yearly Archives: ', 'newspack' ) . '<span class="page-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'newspack' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = esc_html__( 'Monthly Archives: ', 'newspack' ) . '<span class="page-description">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'newspack' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = esc_html__( 'Daily Archives: ', 'newspack' ) . '<span class="page-description">' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = esc_html__( 'Post Type Archives: ', 'newspack' ) . '<span class="page-description">' . post_type_archive_title( '', false ) . '</span>';
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: %s: Taxonomy singular name */
		$title = sprintf( esc_html__( '%s Archives:', 'newspack' ), $tax->labels->singular_name );
	} else {
		$title = esc_html__( 'Archives:', 'newspack' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'newspack_get_the_archive_title' );

/**
 * Determines if post thumbnail can be displayed.
 */
function newspack_can_show_post_thumbnail() {
	return apply_filters( 'newspack_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Add custom sizes attribute to responsive image functionality for post thumbnails.
 *
 * @origin Newspack Theme 1.0
 *
 * @param array $attr  Attributes for the image markup.
 * @return string Value for use in post thumbnail 'sizes' attribute.
 */
function newspack_post_thumbnail_sizes_attr( $attr ) {

	if ( is_admin() ) {
		return $attr;
	}

	if ( ! is_singular() ) {
		$attr['sizes'] = '(max-width: 34.9rem) calc(100vw - 2rem), (max-width: 53rem) calc(8 * (100vw / 12)), (min-width: 53rem) calc(6 * (100vw / 12)), 100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'newspack_post_thumbnail_sizes_attr', 10, 1 );

/**
 * Returns the size for avatars used in the theme.
 */
function newspack_get_avatar_size() {
	return 60;
}

/**
 * Returns true if comment is by author of the post.
 *
 * @see get_comment_class()
 */
function newspack_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function newspack_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

/**
 * WCAG 2.0 Attributes for Dropdown Menus
 *
 * Adjustments to menu attributes tot support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @ref https://www.w3.org/WAI/tutorials/menus/flyout/
 */
function newspack_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

	// Add [aria-haspopup] and [aria-expanded] to menu items that have children
	$item_has_children = in_array( 'menu-item-has-children', $item->classes );
	if ( $item_has_children ) {
		$atts['aria-haspopup'] = 'true';
		$atts['aria-expanded'] = 'false';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'newspack_nav_menu_link_attributes', 10, 4 );

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function newspack_add_dropdown_icons( $output, $item, $depth, $args ) {

	// Only add class to 'top level' items on the 'primary' menu.
	if ( ! isset( $args->theme_location ) || 'primary-menu' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'mobile-parent-nav-menu-item', $item->classes, true ) && isset( $item->original_id ) ) {
		// Inject the keyboard_arrow_left SVG inside the parent nav menu item, and let the item link to the parent item.
		// @todo Only do this for nested submenus? If on a first-level submenu, then really the link could be "#" since the desire is to remove the target entirely.
		$link = sprintf(
			'<button class="menu-item-link-return" tabindex="-1">%s',
			newspack_get_icon_svg( 'chevron_left', 24 )
		);

		// replace opening <a> with <button>
		$output = preg_replace(
			'/<a\s.*?>/',
			$link,
			$output,
			1 // Limit.
		);

		// replace closing </a> with </button>
		$output = preg_replace(
			'#</a>#i',
			'</button>',
			$output,
			1 // Limit.
		);

	} elseif ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = newspack_get_icon_svg( 'keyboard_arrow_down', 24 );

		$output .= sprintf(
			'<button class="submenu-expand" tabindex="-1">%s</button>',
			$icon
		);
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'newspack_add_dropdown_icons', 10, 4 );

/**
 * Adjust a hexidecimal colour value to lighten or darken it.
 *
 * @param  string $hex Hexidecimal value of the color to adjust.
 * @param  string $steps Number of 'steps' to adjust the hexidecimal value's brightness.
 * @return string Updated hexidecimal value.
 */
function newspack_adjust_brightness( $hex, $steps ) {

	$steps = max( -255, min( 255, $steps ) );

	$hex = str_replace( '#', '', $hex );
	if ( 3 == strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$new_shade   = '#';

	foreach ( $color_parts as $color ) {
		$color      = hexdec( $color ); // Convert to decimal
		$color      = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$new_shade .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $new_shade;
}

/**
 * Pick either white or black, whatever has sufficient contrast with the color being passed to it.
 *
 * @param  string $hex Hexidecimal value of the color to adjust.
 * @return string Either black or white hexidecimal values.
 *
 * @ref https://stackoverflow.com/questions/1331591/given-a-background-color-black-or-white-text
 */
function newspack_get_color_contrast( $hex ) {
	// hex RGB
	$r1 = hexdec( substr( $hex, 1, 2 ) );
	$g1 = hexdec( substr( $hex, 3, 2 ) );
	$b1 = hexdec( substr( $hex, 5, 2 ) );
	// Black RGB
	$black_color    = '#000';
	$r2_black_color = hexdec( substr( $black_color, 1, 2 ) );
	$g2_black_color = hexdec( substr( $black_color, 3, 2 ) );
	$b2_black_color = hexdec( substr( $black_color, 5, 2 ) );
	// Calc contrast ratio
	$l1             = 0.2126 * pow( $r1 / 255, 2.2 ) +
		0.7152 * pow( $g1 / 255, 2.2 ) +
		0.0722 * pow( $b1 / 255, 2.2 );
	$l2             = 0.2126 * pow( $r2_black_color / 255, 2.2 ) +
		0.7152 * pow( $g2_black_color / 255, 2.2 ) +
		0.0722 * pow( $b2_black_color / 255, 2.2 );
	$contrast_ratio = 0;
	if ( $l1 > $l2 ) {
		$contrast_ratio = (int) ( ( $l1 + 0.05 ) / ( $l2 + 0.05 ) );
	} else {
		$contrast_ratio = (int) ( ( $l2 + 0.05 ) / ( $l1 + 0.05 ) );
	}
	if ( $contrast_ratio > 5 ) {
		// If contrast is more than 5, return black color
		return '#000';
	} else {
		// if not, return white color.
		return '#fff';
	}
}
