<?php
/**
 * Newspack Sponsors Compatibility File
 *
 * @package Newspack
 */

/**
 * Enqueue styles needed for the sponsors.
 */
function newspack_sponsors_enqueue_styles() {
	wp_enqueue_style(
		'newspack-sponsors-style',
		get_template_directory_uri() . '/styles/newspack-sponsors.css',
		array( 'newspack-style' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_style_add_data( 'newspack-sponsors-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'newspack_sponsors_enqueue_styles' );

/**
 * Enqueue scripts needed for the sponsors.
 */
function newspack_sponsors_enqueue_scripts() {
	if ( ! newspack_is_amp() && ( is_single() || is_archive() ) ) {
		$newspack_l10n = array(
			'open_info'  => esc_html__( 'Learn More', 'newspack' ),
			'close_info' => esc_html__( 'Close', 'newspack' ),
		);

		wp_enqueue_script( 'newspack-amp-fallback-sponsors', get_theme_file_uri( '/js/dist/amp-fallback-newspack-sponsors.js' ), array(), wp_get_theme()->get( 'Version' ), true );
		wp_localize_script( 'newspack-amp-fallback-sponsors', 'newspackScreenReaderText', $newspack_l10n );
	}
}
add_action( 'wp_enqueue_scripts', 'newspack_sponsors_enqueue_scripts' );

/**
 * Enqueue supplemental block editor styles.
 */
function newspack_sponsor_editor_styles() {
	wp_enqueue_style( 'newspack-sponsor-editor-styles', get_theme_file_uri( '/styles/newspack-sponsors-editor.css' ), false, wp_get_theme()->get( 'Version' ), 'all' );
}
add_action( 'enqueue_block_editor_assets', 'newspack_sponsor_editor_styles' );


/**
 * Function to check if plugin is enabled, and if there are sponsors.
 */
function newspack_has_sponsors( $id, $scope = 'native', $type = 'post' ) {
	if ( function_exists( '\Newspack_Sponsors\get_sponsors_for_post' ) ) { // phpcs:ignore PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound
		// Get all assigned sponsors.
		if ( 'archive' === $type ) {
			$sponsors_all = \Newspack_Sponsors\get_sponsors_for_archive( $id ); // phpcs:ignore PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound
		} else {
			$sponsors_all = \Newspack_Sponsors\get_sponsors_for_post( $id ); // phpcs:ignore PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound
		}

		// Loop through sponsors and remove duplicates.
		$sponsors   = array();
		$duplicates = array();
		foreach ( $sponsors_all as $sponsor ) {
			if ( $scope !== $sponsor['sponsor_scope'] ) {
				continue;
			}
			if ( ! in_array( $sponsor['sponsor_id'], $duplicates ) ) {
				$duplicates[] = $sponsor['sponsor_id'];
				$sponsors[]   = $sponsor;
			}
		}
	}

	if ( ! empty( $sponsors ) ) {
		return $sponsors;
	} else {
		return false;
	}
}

/**
 * Add classes to sponsored posts.
 */
function newspack_sponsor_body_classes( $classes ) {

	if ( ( is_category() || is_tag() ) && newspack_has_sponsors( get_queried_object_id(), 'native', 'archive' ) ) {
		$classes[] = 'native-sponsor';
	}
	return $classes;
}
add_filter( 'body_class', 'newspack_sponsor_body_classes' );


if ( ! function_exists( 'newspack_sponsor_byline' ) ) :
	/**
	 * Outputs the sponsor byline markup for the theme.
	 */
	function newspack_sponsor_byline( $id, $scope = 'native', $type = 'post' ) {
		if ( newspack_has_sponsors( $id, $scope, $type ) ) {
			$sponsors      = newspack_has_sponsors( $id, $scope, $type );
			$sponsor_count = count( $sponsors );
			$i             = 1;
			?>
			<span class="byline sponsor-byline">
				<?php
				echo esc_html( $sponsors[0]['sponsor_byline'] ) . ' ';

				foreach ( $sponsors as $sponsor ) {
					$i++;
					if ( $sponsor_count === $i ) :
						/* translators: separates last two sponsor names; needs a space on either side. */
						$sep = esc_html__( ' and ', 'newspack' );
					elseif ( $sponsor_count > $i ) :
						/* translators: separates all but the last two sponsor names; needs a space at the end. */
						$sep = esc_html__( ', ', 'newspack' );
					else :
						$sep = '';
					endif;

					printf(
						/* translators: 1: sponsor link. 2: sponsor name. 3: sponsor seperator - either a comma or 'and'. */
						'<span class="author"><a target="_blank" href="%1$s">%2$s</a></span>%3$s',
						esc_url( $sponsor['sponsor_url'] ),
						esc_html( $sponsor['sponsor_name'] ),
						esc_html( $sep )
					);
				}
				?>
			</span><!-- .byline -->
		<?php
		}
	}
endif;

if ( ! function_exists( 'newspack_sponsor_label' ) ) :
	/**
	 * Outputs the text 'sponsored' in place of the article category.
	 */
	function newspack_sponsor_label( $id, $show_info = false, $scope = 'native', $type = 'post' ) {
		if ( newspack_has_sponsors( $id, $scope, $type ) ) :
			$sponsors     = newspack_has_sponsors( $id, $scope, $type );
			$sponsor_flag = $sponsors[0]['sponsor_flag'];
			?>

			<span class="cat-links sponsor-label" [class]="infoVisible ? 'cat-links sponsor-label show-info' : 'cat-links sponsor-label'">
				<span class="flag">
					<?php
						echo wp_kses( newspack_get_icon_svg( 'money', 16 ), newspack_sanitize_svgs() );
						// If multiple sponsors, use Sponsor Flag from the first one in the array.
						echo esc_html( $sponsors[0]['sponsor_flag'] );
					?>
				</span>
				<?php
				if ( true === $show_info && '' !== $sponsors[0]['sponsor_disclaimer'] ) :
					$allowed_html = array(
						'a' => array(
							'alt'    => array(),
							'class'  => array(),
							'href'   => array(),
							'rel'    => array(),
							'target' => array(),
							'title'  => array(),
						),
					);
					?>
					<button id="sponsor-info-toggle" on="tap:AMP.setState( { infoVisible: !infoVisible } )" aria-controls="sponsor-info" [aria-expanded]="infoVisible ? 'true' : 'false'" aria-expanded="false">
						<?php echo wp_kses( newspack_get_icon_svg( 'help', 16 ), newspack_sanitize_svgs() ); ?>
						<span class="screen-reader-text">
							<?php esc_html_e( 'Learn More', 'newspack' ); ?>
						</span>
					</button>
					<span id="sponsor-info" class="sponsor-info" [aria-expanded]="infoVisible ? 'true' : 'false'" aria-expanded="false">
						<?php
							foreach ( $sponsors as $sponsor ) {
								echo '<span>' . wp_kses( $sponsor['sponsor_disclaimer'], $allowed_html ) . '</span>';
							}
						?>
					</span>
				<?php endif; ?>
			</span><!-- .sponsor-label -->
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'newspack_sponsor_logo_list' ) ) :
	/**
	 * Outputs set of sponsor logos with links.
	 */
	function newspack_sponsor_logo_list( $id, $scope = 'native', $type = 'post' ) {
		if ( newspack_has_sponsors( $id, $scope, $type ) ) {
			$sponsors = newspack_has_sponsors( $id, $scope, $type );

			echo '<span class="sponsor-logos">';
				foreach ( $sponsors as $sponsor ) {
					if ( '' !== $sponsor['sponsor_logo'] ) :
						$logo_info = newspack_sponsor_logo_sized( $sponsor['sponsor_id'] );
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" target="_blank">';
						}
						?>
							<img src="<?php echo esc_url( $logo_info['src'] ); ?>" width="<?php echo esc_attr( $logo_info['img_width'] ); ?>" height="<?php echo esc_attr( $logo_info['img_height'] ); ?>">
						<?php if ( '' !== $sponsor['sponsor_url'] ) : ?>
							</a>
						<?php endif; ?>
					<?php
					endif;
				}
			echo '</span>';
		}
	}
endif;

/**
 * Returns scaled down logo sizes based on the provided width and height; this is necessary for AMP.
 */
function newspack_sponsor_logo_sized( $sponsor_id, $maxwidth = 130, $maxheight = 45 ) {

	// Get image information.
	$image_info = wp_get_attachment_image_src( get_post_thumbnail_id( $sponsor_id ), 'medium' );

	if ( '' !== $image_info ) {
		// Break out src, original width and original height.
		$logo_info['src'] = $image_info[0];
		$image_width      = $image_info[1];
		$image_height     = $image_info[2];

		// Set the max-height, and width based off that to maintain aspect ratio.
		$logo_info['img_height'] = $maxheight;
		$logo_info['img_width']  = ( $image_width / $image_height ) * $logo_info['img_height'];

		// If the new width is too wide, set to the max-width and update height based off that to maintain aspect ratio.
		if ( $maxwidth < $logo_info['img_width'] ) {
			$logo_info['img_width']  = $maxwidth;
			$logo_info['img_height'] = ( $image_height / $image_width ) * $logo_info['img_width'];
		}
		return $logo_info;
	}
}

if ( ! function_exists( 'newspack_sponsor_footer_bio' ) ) :
	/**
	 * Outputs the 'bio' for the sponsor.
	 */
	function newspack_sponsor_footer_bio( $id, $scope = 'native', $type = 'post' ) {
		if ( newspack_has_sponsors( $id, $scope, $type ) ) {
			$sponsors = newspack_has_sponsors( $id, $scope, $type );

			foreach ( $sponsors as $sponsor ) {
				$logo_info = newspack_sponsor_logo_sized( $sponsor['sponsor_id'], 150, 100 );
			?>

				<div class="author-bio sponsor-bio">
					<a href="<?php echo esc_url( $sponsor['sponsor_url'] ); ?>" class="avatar" target="_blank">
						<img src="<?php echo esc_url( $logo_info['src'] ); ?>" width="<?php echo esc_attr( $logo_info['img_width'] ); ?>" height="<?php echo esc_attr( $logo_info['img_height'] ); ?>">
					</a>

					<div class="author-bio-text">
						<div class="author-bio-header">
							<?php
								printf(
									/* translators: 1: sponsor preface. 2: sponsor link. 3: sponsor name. */
									'<h2 class="accent-header">%1$s <a target="_blank" href="%2$s">%3$s</a></h2>',
									esc_html( $sponsor['sponsor_byline'] ),
									esc_url( $sponsor['sponsor_url'] ),
									esc_html( $sponsor['sponsor_name'] )
									);
								?>
						</div><!-- .author-bio-header -->

						<?php echo wp_kses_post( $sponsor['sponsor_blurb'] ); ?>

						<a class="author-link" target="_blank" href="<?php echo esc_url( $sponsor['sponsor_url'] ); ?>">
							<?php
								printf(
									/* translators: %s is the post's sponsor's name. */
									esc_html__( 'Learn more about %s', 'newspack' ),
									esc_html( $sponsor['sponsor_name'] )
								);
							?>
						</a>

					</div><!-- .author-bio-text -->
				</div><!-- .author-bio -->
			<?php
			}
		}
	}
endif;

/**
 * Outputs the 'bio' for the sponsor.
 */
function newspack_sponsor_archive_description( $id, $scope = 'native', $type = 'post' ) {
	if ( newspack_has_sponsors( $id, $scope, $type ) ) {
		$sponsors = newspack_has_sponsors( $id, $scope, $type );

		foreach ( $sponsors as $sponsor ) {
			?>
			<div class="sponsor-archive">
				<span class="details">
					<?php
					if ( '' !== $sponsor['sponsor_logo'] ) :
						$logo_info = newspack_sponsor_logo_sized( $sponsor['sponsor_id'], 130, 80 );
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" target="_blank">';
						}
						echo '<img src="' . esc_url( $logo_info['src'] ) . '" width="' . esc_attr( $logo_info['img_width'] ) . '" height="' . esc_attr( $logo_info['img_height'] ) . '" alt="' . esc_attr( $sponsor['sponsor_name'] ) . '">';
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '</a>';
						}
					endif;
					?>

					<span class="entry-meta">
						<span class="byline sponsor-byline">
							<?php echo esc_html( $sponsor['sponsor_byline'] ); ?>
							<span class="author">
								<?php if ( '' !== $sponsor['sponsor_url'] ) : ?>
									<a target="_blank" href="<?php echo esc_url( $sponsor['sponsor_url'] ); ?>">
								<?php endif; ?>
									<?php echo esc_html( $sponsor['sponsor_name'] ); ?>
								<?php if ( '' !== $sponsor['sponsor_url'] ) : ?>
									</a>
								<?php endif; ?>
							</span><!-- .author -->
						</span><!-- .sponsor-byline -->
					</span><!-- .entry-meta -->
				</span><!-- .logo -->

				<div class="info">
					<?php echo wp_kses_post( $sponsor['sponsor_blurb'] ); ?>
				</div><!-- .info -->
			</div><!-- .sponsor-archive -->
		<?php
		}
	}
}

/**
 * Outputs the 'underwriters' information for the top of single posts.
 */
function newspack_sponsored_underwriters_info( $id, $scope = 'native', $type = 'post' ) {
	if ( newspack_has_sponsors( $id, $scope, $type ) ) {
		$sponsors = newspack_has_sponsors( $id, $scope, $type );
		foreach ( $sponsors as $sponsor ) {
			?>
			<div class="sponsor-uw-info">
				<span class="logo">
					<?php if ( '' !== $sponsor['sponsor_logo'] ) : ?>
						<?php
						$logo_info = newspack_sponsor_logo_sized( $sponsor['sponsor_id'], 130, 80 );
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" target="_blank">';
						}
						echo '<img src="' . esc_url( $logo_info['src'] ) . '" width="' . esc_attr( $logo_info['img_width'] ) . '" height="' . esc_attr( $logo_info['img_height'] ) . '" alt="' . esc_attr( $sponsor['sponsor_name'] ) . '">';
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '</a>';
						}
						?>
					<?php endif; ?>
				</span>
				<div class="info">
					<?php echo wp_kses_post( $sponsor['sponsor_blurb'] ); ?>
				</div>
			</div>
		<?php
		}
	}
}

/**
 * Adds section to customizer for Sponsored Content options.
 */
function newspack_sponsored_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'newspack_sponsored_content',
		array(
			'title' => esc_html__( 'Sponsored Content', 'newspack' ),
		)
	);

	$wp_customize->add_setting(
		'sponsored_flag_hex',
		array(
			'default'           => '#FED850',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sponsored_flag_hex',
			array(
				'label'       => esc_html__( 'Sponsored Content Label', 'newspack' ),
				'description' => esc_html__( 'Changes the background of the sponsored content flag that appears on posts and blocks. It should stand out boldly against your site\'s color scheme.', 'newspack' ),
				'section'     => 'newspack_sponsored_content',
			)
		)
	);
}
add_action( 'customize_register', 'newspack_sponsored_customize_register' );

/**
 * Add custom colors the Sponsored flag.
 */
function newspack_sponsored_styles() {
	$flag_color          = get_theme_mod( 'sponsored_flag_hex', '#FED850' );
	$flag_color_contrast = newspack_get_color_contrast( $flag_color );
	?>
	<style>
		.sponsor-label .flag  {
			background: <?php echo esc_attr( $flag_color ); ?>;
			color: <?php echo esc_attr( $flag_color_contrast ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'newspack_sponsored_styles' );

/**
 * Add custom colors the Sponsored flag for the editor.
 */
function newspack_sponsored_styles_editor() {
	$flag_color          = get_theme_mod( 'sponsored_flag_hex', '#FED850' );
	$flag_color_contrast = newspack_get_color_contrast( $flag_color );

	$sponsor_customizations = '
		.editor-styles-wrapper .sponsor-label .flag  {
			background: ' . esc_attr( $flag_color ) . ';
			color: ' . esc_attr( $flag_color_contrast ) . ';
		}
	';

	wp_add_inline_style( 'newspack-sponsor-editor-styles', $sponsor_customizations );
}
add_action( 'enqueue_block_editor_assets', 'newspack_sponsored_styles_editor' );


