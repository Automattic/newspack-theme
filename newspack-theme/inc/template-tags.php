<?php
/**
 * Custom template tags for this theme
 *
 * @package Newspack
 */

if ( ! function_exists( 'newspack_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function newspack_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>%3$s<time class="updated" datetime="%4$s">%5$s</time>';
		}

		if ( newspack_should_display_updated_date() ) {
			add_filter( 'get_the_modified_date', 'newspack_convert_modified_to_time_ago', 10, 3 );

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date() ),
				'<span class="updated-label">' . esc_html__( 'Updated', 'newspack' ) . ' </span>',
				esc_attr( get_the_modified_date( DATE_W3C ) ),
				esc_html( get_the_modified_date() )
			);

			remove_filter( 'get_the_modified_date', 'newspack_convert_modified_to_time_ago', 10, 3 );
		} else {

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date() ),
				'',
				esc_attr( get_the_modified_date( DATE_W3C ) ),
				esc_html( get_the_modified_date() )
			);
		}

		if ( is_single() ) {
			printf(
			'<span class="posted-on">%1$s</span>',
				wp_kses(
					$time_string,
					array(
						'time' => array(
							'class'    => array(),
							'datetime' => array(),
						),
						'span' => array(
							'class' => array(),
						),
					)
				)
			);
		} else {
			printf(
			'<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>',
				esc_url( get_permalink() ),
				wp_kses(
					$time_string,
					array(
						'time' => array(
							'class'    => array(),
							'datetime' => array(),
						),
						'span' => array(),
					)
				)
			);
		}
	}
endif;

if ( ! function_exists( 'newspack_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function newspack_posted_by() {
		if ( true === apply_filters( 'newspack_listings_hide_author', false ) ) {
			return;
		}

		if ( function_exists( 'coauthors_posts_links' ) && ! empty( get_coauthors() ) ) : // phpcs:ignore PHPCompatibility.LanguageConstructs.NewEmptyNonVariable.Found

			$authors      = get_coauthors();
			$author_count = count( $authors );
			$i            = 1;

			foreach ( $authors as $author ) {
				if ( 'guest-author' === get_post_type( $author->ID ) ) {
					if ( get_post_thumbnail_id( $author->ID ) ) {
						$author_avatar = coauthors_get_avatar( $author, 80 );
					} else {
						// If there is no avatar, force it to return the current fallback image.
						$author_avatar = get_avatar( ' ' );
					}
				} else {
					$author_avatar = coauthors_get_avatar( $author, 80 );
				}

				echo '<span class="author-avatar">' . wp_kses( $author_avatar, newspack_sanitize_avatars() ) . '</span>';
			}
			?>

			<span class="byline">
				<span><?php echo esc_html__( 'by', 'newspack' ); ?></span>
				<?php
				foreach ( $authors as $author ) {

					$i++;
					if ( $author_count === $i ) :
						/* translators: separates last two names; needs a space on either side. */
						$sep = esc_html__( ' and ', 'newspack' );
					elseif ( $author_count > $i ) :
						/* translators: separates all but the last two names; needs a space at the end. */
						$sep = esc_html__( ', ', 'newspack' );
					else :
						$sep = '';
					endif;

					printf(
						/* translators: 1: author link. 2: author name. 3. variable seperator (comma, 'and', or empty) */
						'<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>%3$s ',
						esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ),
						esc_html( $author->display_name ),
						esc_html( $sep )
					);
				}
				?>
			</span><!-- .byline -->
		<?php
		else :
			printf(
				/* translators: 1: Author avatar. 2: post author, only visible to screen readers. 3: author link. */
				'<span class="author-avatar">%1$s</span><span class="byline"><span>%2$s</span> <span class="author vcard"><a class="url fn n" href="%3$s">%4$s</a></span></span>',
				get_avatar( get_the_author_meta( 'ID' ) ),
				esc_html__( 'by', 'newspack' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);

		endif;
	}
endif;

if ( ! function_exists( 'newspack_author_social_links' ) ) :
	/**
	 * Prints list of social links for the current author.
	 */
	function newspack_author_social_links( $author_id, $size = 24 ) {

		// Get list of available social profiles.
		$social_profiles = array(
			'facebook',
			'twitter',
			'instagram',
			'linkedin',
			'myspace',
			'pinterest',
			'soundcloud',
			'tumblr',
			'youtube',
			'wikipedia',
		);

		// Create empty string for links.
		$links = '';

		// Create array of allowed HTML, including SVG markup.
		$allowed_html = array(
			'a'  => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
			),
			'li' => array(
				'class' => array(),
			),
		);
		$allowed_html = array_merge( $allowed_html, newspack_sanitize_svgs() );

		foreach ( $social_profiles as $profile ) {
			if ( '' !== get_the_author_meta( $profile, $author_id ) ) {
				if ( 'twitter' === $profile ) {
					$links .= '<li class="twitter"><a href="https://twitter.com/' . esc_attr( get_the_author_meta( $profile, $author_id ) ) . '" target="_blank">' . newspack_get_social_icon_svg( $profile, $size, $profile ) . '</a></li>';
				} else {
					$links .= '<li class="' . esc_attr( $profile ) . '"><a href="' . esc_url( get_the_author_meta( $profile, $author_id ) ) . '" target="_blank">' . newspack_get_social_icon_svg( $profile, $size, $profile ) . '</a></li>';
				}
			}
		}

		if ( '' !== $links && true === get_theme_mod( 'show_author_social', false ) ) {
			echo '<ul class="author-social-links">' . wp_kses( $links, $allowed_html ) . '</ul>';
		}
	}
endif;

if ( ! function_exists( 'newspack_comment_count' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function newspack_comment_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo newspack_get_icon_svg( 'comment', 16 );

			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'newspack' ), get_the_title() ) );

			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'newspack_categories' ) ) :
	/**
	 * Prints HTML with the current post's categories.
	 */
	function newspack_categories() {
		$categories_list = '';
		$primary_cat_enabled = get_theme_mod( 'post_primary_category', true );

		// Only display Yoast primary category if set.
		if ( class_exists( 'WPSEO_Primary_Term' ) && $primary_cat_enabled ) {
			$primary_term = new WPSEO_Primary_Term( 'category', get_the_ID() );
			$category_id = $primary_term->get_primary_term();
			if ( $category_id ) {
				$category = get_term( $category_id );
				if ( $category ) {
					$categories_list = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category tag">' . $category->name . '</a>';
				}
			}
		}

		if ( ! $categories_list ) {
			/* translators: used between list items; followed by a space. */
			$categories_list = get_the_category_list( '<span class="sep">' . esc_html__( ',', 'newspack' ) . '&nbsp;</span>' );
		}

		if ( $categories_list ) {
			printf(
				/* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
				'<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
				esc_html__( 'Posted in', 'newspack' ),
				apply_filters( 'newspack_theme_categories', $categories_list )
			); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'newspack_previous_next' ) ) :
	/**
	 * Prints previous and next links for single posts.
	 */
	function newspack_previous_next() {
		$show_prev_next_links = get_theme_mod( 'post_previous_next', false );

		if ( true === $show_prev_next_links && is_singular( 'post' ) ) {
			the_post_navigation(
				array(
					'next_text' => '<span class="meta-nav">' . __( 'Next', 'newspack' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav">' . __( 'Previous', 'newspack' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				)
			);
		}
	}
endif;

if ( ! function_exists( 'newspack_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the tags and comments.
	 */
	function newspack_entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items; followed by a space. */
			$tags_list = get_the_tag_list( '', '<span class="sep">' . esc_html__( ',', 'newspack' ) . '&nbsp;</span>' );
			if ( $tags_list ) {
				printf(
					/* translators: 1: posted in label, only visible to screen readers. 2: list of tags. */
					'<span class="tags-links"><span>%1$s </span>%2$s</span>',
					esc_html__( 'Tagged:', 'newspack' ),
					$tags_list
				); // WPCS: XSS OK.
			}
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post; only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'newspack' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . newspack_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'newspack_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function newspack_post_thumbnail( $size = 'newspack-featured-image' ) {
		if ( ! newspack_can_show_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) : ?>

			<figure class="post-thumbnail">

				<?php

				// If using the behind or beside image styles, add the object-fit argument for AMP.
				if ( in_array( newspack_featured_image_position(), array( 'behind', 'beside' ) ) ) :

					the_post_thumbnail(
						$size,
						array(
							'object-fit' => 'cover',
						)
					);
				else :

					if ( 'above' === newspack_featured_image_position() ) :
						the_post_thumbnail(
							$size,
							array(
								'layout' => 'responsive',
							)
						);
					else :
						the_post_thumbnail( $size );
					endif;

					$caption = get_the_excerpt( get_post_thumbnail_id() );
					// Check the existance of the caption separately, so filters -- like ones that add ads -- don't interfere.
					$caption_exists = get_post( get_post_thumbnail_id() )->post_excerpt;

					// Account for featured images that have a credit but no caption.
					if ( ! $caption_exists && class_exists( 'Newspack_Image_Credits' ) ) {
						$maybe_newspack_image_credit = Newspack_Image_Credits::get_media_credit_string( get_post_thumbnail_id() );
						if ( strlen( wp_strip_all_tags( $maybe_newspack_image_credit ) ) ) {
							$caption_exists = true;
						}
					}

					if ( $caption_exists ) :
					?>
						<figcaption><?php echo wp_kses_post( $caption ); ?></figcaption>
					<?php
					endif;
				endif;
				?>

			</figure><!-- .post-thumbnail -->

		<?php else : ?>

			<figure class="post-thumbnail">
				<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( $size ); ?>
				</a>
			</figure>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'newspack_comment_form' ) ) :
	/**
	 * Documentation for function.
	 */
	function newspack_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {

			$comment_attributes = array(
				'logged_in_as' => null,
				'title_reply'  => null,
			);

			$comment_policy = get_theme_mod( 'comment_policy', '' );
			$display_policy = get_theme_mod( 'display_comment_policy', false );

			// Check if there's a comment policy set in the Customizer.
			if ( $display_policy && '' !== trim( $comment_policy ) ) {
				$comment_attributes['title_reply_before'] = '<div class="comment-policy">' . wp_kses_post( $comment_policy ) . '</div>';
			}

			comment_form( $comment_attributes );
		}
	}
endif;

if ( ! function_exists( 'newspack_comments_template' ) ) {

	/**
	 * Output the comment template.
	 */
	function newspack_comments_template() {
		// Add Coral AMP compatibility because they integrated with AMP for WP plugin instead of the official AMP plugin.
		if ( newspack_is_amp() && function_exists( 'coral_talk_comments_amp_template' ) ) {
			coral_talk_comments_amp_template();
		} else {
			comments_template();
		}
	}
}

if ( ! function_exists( 'newspack_the_posts_navigation' ) ) :
	/**
	 * Documentation for function.
	 */
	function newspack_the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => sprintf(
					'%s <span class="nav-prev-text">%s</span>',
					newspack_get_icon_svg( 'chevron_left', 22 ),
					__( 'Newer posts', 'newspack' )
				),
				'next_text' => sprintf(
					'<span class="nav-next-text">%s</span> %s',
					__( 'Older posts', 'newspack' ),
					newspack_get_icon_svg( 'chevron_right', 22 )
				),
			)
		);
	}
endif;

if ( ! function_exists( 'newspack_mobile_cta' ) ) :
	/**
	 * Echo a CTA link in the mobile header.
	 */
	function newspack_mobile_cta() {
		$cta_show   = get_theme_mod( 'show_header_cta', false );
		$cta_text   = get_theme_mod( 'header_cta_text', esc_html__( 'Donate', 'newspack' ) );
		$cta_url    = get_theme_mod( 'header_cta_url', '' );
		$cta_target = get_theme_mod( 'header_cta_target', false );

		if ( true === $cta_show && '' !== $cta_url ) {
			echo '<a class="button mb-cta" href="' . esc_url( $cta_url ) . '"';
			if ( true === $cta_target ) {
				echo ' target="_blank"';
			}
			echo '>' . esc_html( $cta_text ) . '</a>';
		}
	}
endif;

/**
 * Check if any header menus are applied; used to show menu toggle on smaller screens.
 */
function newspack_has_menus() {
	if ( has_nav_menu( 'primary-menu' ) || has_nav_menu( 'secondary-menu' ) || has_nav_menu( 'tertiary-menu' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Displays primary menu; created a function to reduce duplication.
 */
function newspack_primary_menu() {
	if ( ! has_nav_menu( 'primary-menu' ) ) {
		return;
	}

	// Only set a toolbar-target attributes if the primary menu container exists in the header - if not subpage header.
	$toolbar_attributes = '';
	if ( false === get_theme_mod( 'header_sub_simplified', false ) || is_front_page() ) {
		$toolbar_attributes = 'toolbar-target="site-navigation" toolbar="(min-width: 767px)"';
	}
	?>
	<nav class="main-navigation nav1 dd-menu" aria-label="<?php esc_attr_e( 'Top Menu', 'newspack' ); ?>" <?php echo $toolbar_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary-menu',
				'menu_class'     => 'main-menu',
				'container'      => false,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			)
		);
		?>
	</nav>
<?php
}

/**
 * Displays secondary menu; created a function to reduce duplication.
 */
function newspack_secondary_menu() {
	if ( ! has_nav_menu( 'secondary-menu' ) ) {
		return;
	}

	// Only set a toolbar-target attributes if the secondary menu container exists in the header - if not short or subpage header.
	$toolbar_attributes = '';
	if ( false === get_theme_mod( 'header_sub_simplified', false ) || is_front_page() ) {
		$toolbar_attributes = 'toolbar-target="secondary-nav-contain" toolbar="(min-width: 767px)"';
	}

	?>
	<nav class="secondary-menu nav2 dd-menu" aria-label="<?php esc_attr_e( 'Secondary Menu', 'newspack' ); ?>" <?php echo $toolbar_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'secondary-menu',
				'menu_class'     => 'secondary-menu',
				'container'      => false,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			)
		);
		?>
	</nav>
<?php
}

/**
 * Displays tertiary menu; created a function to reduce duplication.
 */
function newspack_tertiary_menu() {
	if ( ! has_nav_menu( 'tertiary-menu' ) ) {
		return;
	}

	// Only set a toolbar-target attributes if the tertiary menu container exists in the header - if not subpage header.
	$toolbar_attributes = '';
	if ( false === get_theme_mod( 'header_sub_simplified', false ) || is_front_page() ) {
		$toolbar_attributes = 'toolbar-target="tertiary-nav-contain" toolbar="(min-width: 767px)"';
	}
	?>
		<nav class="tertiary-menu nav3" aria-label="<?php esc_attr_e( 'Tertiary Menu', 'newspack' ); ?>" <?php echo $toolbar_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'tertiary-menu',
					'container'      => false,
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'          => 1,
				)
			);
			?>
		</nav>
<?php
}

/**
 * Displays social links menu; create a function for the wp_nav_menu settings to reduce duplication.
 */
function newspack_social_menu_settings() {
	wp_nav_menu(
		array(
			'theme_location' => 'social',
			'menu_class'     => 'social-links-menu',
			'container'      => false,
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>' . newspack_get_icon_svg( 'link' ),
			'depth'          => 1,
		)
	);
}

/**
 * Displays social links menu for the header; includes AMP toolbar and toolbar-target attributes.
 */
function newspack_social_menu_header() {
	if ( ! has_nav_menu( 'social' ) ) {
		return;
	}

	$header_simplified     = get_theme_mod( 'header_simplified', false );
	$header_center_logo    = get_theme_mod( 'header_center_logo', false );
	$header_sub_simplified = get_theme_mod( 'header_sub_simplified', false );

	$toolbar_attributes = 'toolbar="(min-width: 767px)" toolbar-target="social-nav-contain"';

	// In some cases when this menu won't appear on desktop, override the Toobar Attributes for AMP, so it doesn't try to "move" it.
	if (
		( true === $header_simplified && ! has_nav_menu( 'secondary-menu' ) ) ||
		( true === $header_sub_simplified && ! is_front_page() ) ||
		( false === $header_simplified && ! has_nav_menu( 'secondary-menu' ) && false === $header_center_logo )
	) {
		$toolbar_attributes = '';
	}
	?>
	<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'newspack' ); ?>" <?php echo $toolbar_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php newspack_social_menu_settings(); ?>
	</nav><!-- .social-navigation -->
<?php
}

/**
 * Displays social links menu for the footer; without AMP-related attributes, to prevent duplication errors.
 */
function newspack_social_menu_footer() {
	if ( ! has_nav_menu( 'social' ) ) {
		return;
	}
	?>
	<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'newspack' ); ?>">
		<?php newspack_social_menu_settings(); ?>
	</nav><!-- .social-navigation -->
<?php
}
