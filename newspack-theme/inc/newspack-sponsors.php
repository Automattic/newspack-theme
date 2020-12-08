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
 * Returns post or taxonomy sponsors.
 */
function newspack_get_all_sponsors( $id = null, $scope = null, $type = null, $logo_options = [] ) {
	if ( function_exists( '\Newspack_Sponsors\get_all_sponsors' ) ) {
		return \Newspack_Sponsors\get_all_sponsors( $id, $scope, $type, $logo_options );
	}

	return false;
}

/**
 * Filters given sponsors for 'native' sponsors.
 *
 * @param array $sponsors Array of sponsors.
 * @return array|boolean Native sponsors only, or false if $sponsors is invalid.
 */
function newspack_get_native_sponsors( $sponsors = [] ) {
	if ( empty( $sponsors ) || ! is_array( $sponsors ) ) {
		return false;
	}

	return array_values(
		array_filter(
			$sponsors,
			function( $sponsor ) {
				return isset( $sponsor['sponsor_scope'] ) && 'native' === $sponsor['sponsor_scope'];
			}
		)
	);
}

/**
 * Filters given sponsors for 'underwiter' sponsors.
 *
 * @param array $sponsors Array of sponsors.
 * @return array|boolean Underwriter sponsors only, or false if $sponsors is invalid.
 */
function newspack_get_underwriter_sponsors( $sponsors = [] ) {
	if ( empty( $sponsors ) || ! is_array( $sponsors ) ) {
		return false;
	}

	return array_values(
		array_filter(
			$sponsors,
			function( $sponsor ) {
				return isset( $sponsor['sponsor_scope'] ) && 'underwritten' === $sponsor['sponsor_scope'];
			}
		)
	);
}

/**
 * Add classes to sponsored posts.
 */
function newspack_sponsor_body_classes( $classes ) {
	if ( ( is_category() || is_tag() ) && newspack_get_all_sponsors( get_queried_object_id(), 'native', 'archive' ) ) {
		$classes[] = 'sponsored-archive';
	}
	return $classes;
}
add_filter( 'body_class', 'newspack_sponsor_body_classes' );


if ( ! function_exists( 'newspack_sponsor_byline' ) ) :
	/**
	 * Outputs the sponsor byline markup for the theme.
	 */
	function newspack_sponsor_byline( $sponsors = null, $id = null, $scope = 'native', $type = 'post' ) {
		if ( null === $sponsors ) {
			// Can't proceed if we don't have an id to query with.
			if ( empty( $id ) ) {
				return;
			}

			$sponsors = newspack_get_all_sponsors( $id, $scope, $type );
		}

		if ( ! empty( $sponsors ) ) {
			$sponsor_count = count( $sponsors );
			$i             = 1;
			?>
			<span class="byline sponsor-byline">
				<?php
				echo esc_html( $sponsors[0]['sponsor_byline'] ) . ' ';

				foreach ( $sponsors as $sponsor ) {
					$i++;
					if ( $sponsor_count === $i ) :
						/* translators: separates last two names; needs a space on either side. */
						$sep = esc_html__( ' and ', 'newspack' );
					elseif ( $sponsor_count > $i ) :
						/* translators: separates all but the last two names; needs a space at the end. */
						$sep = esc_html__( ', ', 'newspack' );
					else :
						$sep = '';
					endif;

					echo '<span class="author">';
					if ( '' !== $sponsor['sponsor_url'] ) {
						echo '<a target="_blank" href="' . esc_url( $sponsor['sponsor_url'] ) . '">';
					}
					echo esc_html( $sponsor['sponsor_name'] );
					if ( '' !== $sponsor['sponsor_url'] ) {
						echo '</a>';
					}
					echo '</span>' . esc_html( $sep );
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
	function newspack_sponsor_label( $sponsors = null, $id = null, $show_info = false, $scope = 'native', $type = 'post' ) {
		if ( null === $sponsors ) {
			// Can't proceed if we don't have an id to query with.
			if ( empty( $id ) ) {
				return;
			}

			$sponsors = newspack_get_all_sponsors( $id, $scope, $type );
		}

		if ( ! empty( $sponsors ) ) :
			$sponsor_flag       = $sponsors[0]['sponsor_flag'];
			$sponsor_disclaimer = $sponsors[0]['sponsor_disclaimer'];
			?>

			<span class="cat-links sponsor-label" [class]="infoVisible ? 'cat-links sponsor-label show-info' : 'cat-links sponsor-label'">
				<span class="flag">
					<?php
						// If multiple sponsors, use Sponsor Flag from the first one in the array.
						echo esc_html( $sponsors[0]['sponsor_flag'] );
					?>
				</span>
				<?php
				if ( true === $show_info && '' !== $sponsor_disclaimer ) :
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
						<?php echo wp_kses( $sponsor_disclaimer, $allowed_html ); ?>
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
	function newspack_sponsor_logo_list( $sponsors = null, $id = null, $scope = 'native', $type = 'post' ) {
		if ( null === $sponsors ) {
			// Can't proceed if we don't have an id to query with.
			if ( empty( $id ) ) {
				return;
			}

			$sponsors = newspack_get_all_sponsors( $id, $scope, $type );
		}

		if ( ! empty( $sponsors ) ) {
			echo '<span class="sponsor-logos">';
				foreach ( $sponsors as $sponsor ) {
					if ( ! empty( $sponsor['sponsor_logo'] ) ) :
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" target="_blank">';
						}
						?>
							<img src="<?php echo esc_url( $sponsor['sponsor_logo']['src'] ); ?>" width="<?php echo esc_attr( $sponsor['sponsor_logo']['img_width'] ); ?>" height="<?php echo esc_attr( $sponsor['sponsor_logo']['img_height'] ); ?>">
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

if ( ! function_exists( 'newspack_sponsor_footer_bio' ) ) :
	/**
	 * Outputs the 'bio' for the sponsor.
	 */
	function newspack_sponsor_footer_bio( $sponsors = null, $id = null, $scope = 'native', $type = 'post' ) {
		$sponsors = newspack_get_all_sponsors(
			$id,
			$scope,
			$type,
			array(
				'maxwidth'  => 150,
				'maxheight' => 100,
			)
		);
		if ( ! empty( $sponsors ) ) {
			foreach ( $sponsors as $sponsor ) {
			?>

				<div class="author-bio sponsor-bio">

					<?php
					if ( ! empty( $sponsor['sponsor_logo'] ) ) {
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" class="avatar" target="_blank">';
						}
						echo '<img src="' . esc_url( $sponsor['sponsor_logo']['src'] ) . '" width="' . esc_attr( $sponsor['sponsor_logo']['img_width'] ) . '" height="' . esc_attr( $sponsor['sponsor_logo']['img_height'] ) . '">';
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '</a>';
						}
					}
					?>

					<div class="author-bio-text">
						<div class="author-bio-header">
							<h2 class="accent-header">
								<?php
								echo esc_html( $sponsor['sponsor_byline'] ) . ' ';
								if ( '' !== $sponsor['sponsor_url'] ) {
									echo '<a target="_blank" href="' . esc_url( $sponsor['sponsor_url'] ) . '">';
								}
								echo esc_html( $sponsor['sponsor_name'] );
								if ( '' !== $sponsor['sponsor_url'] ) {
									echo '</a>';
								}
								?>
							</h2>
						</div><!-- .author-bio-header -->

						<?php echo wp_kses_post( $sponsor['sponsor_blurb'] ); ?>

						<?php if ( '' !== $sponsor['sponsor_url'] ) : ?>
							<a class="author-link" target="_blank" href="<?php echo esc_url( $sponsor['sponsor_url'] ); ?>">
								<?php
									printf(
										/* translators: %s is the post's sponsor's name. */
										esc_html__( 'Learn more about %s', 'newspack' ),
										esc_html( $sponsor['sponsor_name'] )
									);
								?>
							</a>
						<?php endif; ?>

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
function newspack_sponsor_archive_description( $sponsors = null, $id = null, $scope = 'native', $type = 'post' ) {
	if ( null === $sponsors ) {
		if ( empty( $id ) ) {
			return;
		}
		$sponsors = newspack_get_all_sponsors( $id, $scope, $type );
	}

	if ( ! empty( $sponsors ) ) {
		foreach ( $sponsors as $sponsor ) {
			?>
			<div class="sponsor-archive">
				<span class="details">
					<?php
					if ( ! empty( $sponsor['sponsor_logo'] ) ) :
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" target="_blank">';
						}
						echo '<img src="' . esc_url( $sponsor['sponsor_logo']['src'] ) . '" width="' . esc_attr( $sponsor['sponsor_logo']['img_width'] ) . '" height="' . esc_attr( $sponsor['sponsor_logo']['img_height'] ) . '" alt="' . esc_attr( $sponsor['sponsor_name'] ) . '">';
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
function newspack_sponsored_underwriters_info( $sponsors = null, $id = null, $scope = 'native', $type = 'post' ) {
	if ( null === $sponsors ) {
		if ( empty( $id ) ) {
			return;
		}
		$sponsors = newspack_get_all_sponsors( $id, $scope, $type );
	}

	if ( ! empty( $sponsors ) ) {
		foreach ( $sponsors as $sponsor ) {
			?>
			<div class="sponsor-uw-info">
				<span class="logo">
					<?php if ( ! empty( $sponsor['sponsor_logo'] ) ) : ?>
						<?php
						if ( '' !== $sponsor['sponsor_url'] ) {
							echo '<a href="' . esc_url( $sponsor['sponsor_url'] ) . '" target="_blank">';
						}
						echo '<img src="' . esc_url( $sponsor['sponsor_logo']['src'] ) . '" width="' . esc_attr( $sponsor['sponsor_logo']['img_width'] ) . '" height="' . esc_attr( $sponsor['sponsor_logo']['img_height'] ) . '" alt="' . esc_attr( $sponsor['sponsor_name'] ) . '">';
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
 * Add custom colors to trust indicators.
 */
function newspack_sponsored_styles() {
	$flag_color          = get_theme_mod( 'sponsored_flag_hex', '#FED850' );
	$flag_color_contrast = newspack_get_color_contrast( $flag_color );
	?>
	<style>
		.sponsor-label .flag,
		amp-script .sponsor-label .flag  {
			background: <?php echo esc_attr( $flag_color ); ?>;
			color: <?php echo esc_attr( $flag_color_contrast ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'newspack_sponsored_styles' );

/**
 * Add custom colors for trust indicators to editor.
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
