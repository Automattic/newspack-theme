<?php
/**
 * Trust Indicators Compatibility File
 *
 * @link https://thetrustproject.org/
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
	if ( ! newspack_is_amp() && is_single() ) {
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
 * Function to check if plugin is enabled, and if there are sponsors.
 */
function newspack_post_has_sponsors( $post_id ) {
	if ( function_exists( '\Newspack_Sponsors\get_sponsors_for_post' ) ) { // phpcs:ignore PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound
		// Get all assigned sponsors.
		$sponsors_all = \Newspack_Sponsors\get_sponsors_for_post( $post_id ); // phpcs:ignore PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound

		// Loop through sponsors and remove duplicates.
		$sponsors   = array();
		$duplicates = array();
		foreach ( $sponsors_all as $sponsor ) {
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

if ( ! function_exists( 'newspack_sponsor_byline' ) ) :
	/**
	 * Outputs the sponsor byline markup for the theme.
	 */
	function newspack_sponsor_byline( $post_id ) {
		if ( newspack_post_has_sponsors( $post_id ) ) {
			$sponsors      = newspack_post_has_sponsors( $post_id );
			$sponsor_count = count( $sponsors );
			$i             = 1;
			?>
			<span class="byline sponsor-byline">
				<span>
					<span>
						<?php echo esc_html( $sponsors[0]['sponsor_byline'] ); ?>
					</span>

					<?php
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
							/* translators: 1: sponsor link. 2: sponsor name. 3. variable seperator (comma, 'and', or empty) */
							'<span class="author"><a target="_blank" href="%1$s">%2$s</a></span>%3$s ',
							esc_url( $sponsor['sponsor_url'] ),
							esc_html( $sponsor['sponsor_name'] ),
							esc_html( $sep )
						);
					}
					?>
				</span>
			</span><!-- .byline -->
		<?php
		}
	}
endif;

if ( ! function_exists( 'newspack_sponsor_label' ) ) :
	/**
	 * Outputs the text 'sponsored' in place of the article category.
	 */
	function newspack_sponsor_label( $show_info = false ) {
	?>
		<span class="cat-links sponsor-label" [class]="infoVisible ? 'cat-links sponsor-label show-info' : 'cat-links sponsor-label'">
			<span class="flag">
				<?php echo wp_kses( newspack_get_icon_svg( 'money', 16 ), newspack_sanitize_svgs() ); ?>
				<?php // TODO: Replace with user editable content. ?>
				<?php echo esc_html__( 'Sponsored', 'newspack' ); ?>
			</span>
			<?php
			if ( true === $show_info ) :
				$allowed_html        = array(
					'a' => array(
						'alt'    => array(),
						'class'  => array(),
						'href'   => array(),
						'rel'    => array(),
						'target' => array(),
						'title'  => array(),
					),
				);
				// TODO: Replace with user editable content.
				$sponsor_information = 'Filler content for the sponsor info including <a href="#">a link</a>.';
			?>
				<button id="sponsor-info-toggle" on="tap:AMP.setState( { infoVisible: !infoVisible } )" aria-controls="sponsor-info" [aria-expanded]="infoVisible ? 'true' : 'false'" aria-expanded="false">
					<?php echo wp_kses( newspack_get_icon_svg( 'help', 16 ), newspack_sanitize_svgs() ); ?>
					<span class="screen-reader-text">
						<?php esc_html_e( 'Learn More', 'newspack' ); ?>
					</span>
				</button>
				<span id="sponsor-info" class="sponsor-info" [aria-expanded]="infoVisible ? 'true' : 'false'" aria-expanded="false">
					<?php echo wp_kses( $sponsor_information, $allowed_html ); ?>
				</span>
			<?php endif; ?>
		</span><!-- .sponsor-label -->

	<?php
	}
endif;

if ( ! function_exists( 'newspack_sponsor_logo_list' ) ) :
	/**
	 * Outputs set of sponsor logos with links.
	 */
	function newspack_sponsor_logo_list( $post_id ) {
		if ( newspack_post_has_sponsors( $post_id ) ) {
			$sponsors = newspack_post_has_sponsors( $post_id );

			echo '<span class="sponsor-logos">';
				foreach ( $sponsors as $sponsor ) {
					$logo_info = newspack_sponsor_logo_sized( $sponsor['sponsor_logo'] );
					?>
					<a href="<?php echo esc_url( $sponsor['sponsor_url'] ); ?>" target="_blank">
						<img src="<?php echo esc_url( $logo_info['url'] ); ?>" width="<?php echo esc_attr( $logo_info['img_width'] ); ?>" height="<?php echo esc_attr( $logo_info['img_height'] ); ?>">
					</a>

				<?php
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
	$image_info = wp_get_attachment_image_src( $sponsor_id, 'medium' );

	// Break out URL, original width and original height.
	$logo_info['url'] = $image_info[0];
	$image_width      = $image_info[1];
	$image_height     = $image_info[2];

	// Set the max-height, and width based off that to maintain aspect ratio.
	$logo_info['img_height'] = $maxheight;
	$logo_info['img_width']  = ( $image_width / $image_height ) * $logo_info['img_height'];

	// If the new width is too wide, set to the max-width and update height based off that to maintain aspect ratio.
	if ( 130 < $logo_info['img_width'] ) {
		$logo_info['img_width']  = $maxwidth;
		$logo_info['img_height'] = ( $image_height / $image_width ) * $logo_info['img_width'];
	}

	return $logo_info;
}

if ( ! function_exists( 'newspack_sponsor_footer_bio' ) ) :
	/**
	 * Outputs the 'bio' for the sponsor.
	 */
	function newspack_sponsor_footer_bio( $post_id ) {
		if ( newspack_post_has_sponsors( $post_id ) ) {
			$sponsors = newspack_post_has_sponsors( $post_id );

			foreach ( $sponsors as $sponsor ) {
				$logo_info = newspack_sponsor_logo_sized( $sponsor['sponsor_logo'], 150, 100 );
			?>

				<div class="author-bio sponsor-bio">
					<a href="<?php echo esc_url( $sponsor['sponsor_url'] ); ?>" class="avatar" target="_blank">
						<img src="<?php echo esc_url( $logo_info['url'] ); ?>" width="<?php echo esc_attr( $logo_info['img_width'] ); ?>" height="<?php echo esc_attr( $logo_info['img_height'] ); ?>">
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
function newspack_sponsored_customizer_styles() {
	$flag_color          = get_theme_mod( 'sponsored_flag_hex', '#FED850' );
	$flag_color_contrast = newspack_get_color_contrast( $flag_color );
	?>
	<style>
		.sponsor-label strong {
			background: <?php echo esc_attr( $flag_color ); ?>;
			color: <?php echo esc_attr( $flag_color_contrast ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'newspack_sponsored_customizer_styles' );


