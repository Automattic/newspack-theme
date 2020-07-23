<?php
/**
 * Trust Indicators Compatibility File
 *
 * @link https://thetrustproject.org/
 *
 * @package Newspack
 */

/**
 * Enqueue styles needed for trust indicators.
 */
function newspack_trust_indicators_enqueue_styles() {
	wp_enqueue_style(
		'newspack-trust-indicators-style',
		get_template_directory_uri() . '/styles/trust-indicators.css',
		array( 'newspack-style' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_style_add_data( 'newspack-trust-indicators-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'newspack_trust_indicators_enqueue_styles' );

/**
 * Add a label saying what type of work a post is (analysis, opinion, etc.)
 *
 * @param string $categories_html HTML for the category label on an article.
 * @return string Modified $categories_html
 */
function newspack_trust_indicators_add_type_of_work_label( $categories_html ) {
	if ( ! taxonomy_exists( 'type-of-work' ) || ! is_single() ) {
		return $categories_html;
	}

	$type_of_work_terms = get_the_terms( get_the_ID(), 'type-of-work' );
	if ( $type_of_work_terms ) {
		$terms_list      = join( ', ', wp_list_pluck( $type_of_work_terms, 'name' ) );
		$categories_html = '<span class="type-of-work">' . esc_html( $terms_list ) . ':</span>' . $categories_html;
	}

	return $categories_html;
}
add_filter( 'newspack_theme_categories', 'newspack_trust_indicators_add_type_of_work_label' );

/**
 * Output a "Why trust Sitename" link to the publishing principles in the post byline area.
 */
function newspack_trust_indicators_output_why_trust_link() {
	$publishing_principles_url = get_option( 'publishing_principles', '' );
	if ( ! $publishing_principles_url ) {
		return;
	}

	$site_name = get_bloginfo( 'name' );

	/* translators: %s - site name */
	$message = sprintf( __( 'Why you can trust %s', 'newspack' ), $site_name );
	?>

	<a href="<?php echo esc_url( $publishing_principles_url ); ?>" class="trust-label">
		<svg data-v-22ae94a0="" data-v-2f899364="" width="16" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="trust-label__icon"><path data-v-22ae94a0="" d="M16.8 0C18.56 0 20 1.44 20 3.2v13.6c0 1.76-1.44 3.2-3.2 3.2H3.2A3.21 3.21 0 0 1 0 16.8V3.2C0 1.44 1.44 0 3.2 0h13.6zm0 1.2H3.2c-1.1 0-2 .9-2 2v13.6c0 1.1.9 2 2 2h13.6c1.1 0 2-.9 2-2V3.2c0-1.1-.9-2-2-2zm-1 3.38c.08 0 .14.06.14.14V8.2c0 .08-.06.14-.14.14h-3.54c-.08 0-.14.06-.14.14v6.74c0 .08-.06.14-.14.14H8.04c-.08 0-.14-.06-.14-.14V8.5c0-.1-.08-.18-.18-.18H4.2c-.08 0-.14-.06-.14-.14V4.72c0-.08.06-.14.14-.14h11.6z" fill="#666"></path></svg>
		<span class="trust-label__message"><?php echo esc_html( $message ); ?></span>
	</a>
	<?php
}
add_action( 'newspack_theme_entry_meta', 'newspack_trust_indicators_output_why_trust_link' );

/**
 * Output author work contact info on author archives.
 */
function newspack_trust_indicators_output_author_info() {
	if ( ! is_author() || ! class_exists( 'Trust_Indicators_User_Settings' ) ) {
		return;
	}

	$author = get_queried_object();

	$author_email = '';
	if ( true === get_theme_mod( 'show_author_email', false ) ) {
		$author_email = get_user_meta( $author->ID, 'public_contact_info_email', true );
		if ( ! $author_email ) {
			$author_email = get_user_meta( $author->ID, 'user_email', true );
		}
	}

	$author_phone = get_user_meta( $author->ID, 'public_contact_info_tel', true );
	$author_twitter = get_user_meta( $author->ID, 'twitter', true );
	?>
	<div class="trust-indicators author-meta">
		<?php if ( $author_email ) : ?>
			<a class="author-expanded-social-link" href="mailto:<?php echo esc_attr( $author_email ); ?>">
				<?php echo newspack_get_social_icon_svg( 'mail', 20 ); ?>
				<?php echo esc_html( $author_email ); ?>
			</a>
		<?php endif; ?>

		<?php if ( $author_twitter ) : ?>
			<a class="author-expanded-social-link" href="<?php echo esc_attr( 'https://twitter.com/' . $author_twitter ); ?>" target="_blank">
				<?php echo newspack_get_social_icon_svg( 'twitter', 20 ); ?>
				<?php echo esc_html( $author_twitter ); ?>
			</a>
		<?php endif; ?>

		<?php if ( $author_phone ) : ?>
			<span class="author-expanded-social-link">
				<?php echo newspack_get_social_icon_svg( 'phone', 20 ); ?>
				<?php echo esc_html( $author_phone ); ?>
			</span>
		<?php endif; ?>

		<?php newspack_author_social_links( $author->ID, 20 ); ?>
	</div>
	<?php
}
add_action( 'newspack_theme_below_archive_title', 'newspack_trust_indicators_output_author_info' );


/**
 * Adds author title to the_archive_title().
 */
function newspack_trust_indicators_output_author_job_title( $title ) {
	if ( is_author() ) {
		$author = get_queried_object();
		$role   = get_user_meta( $author->ID, 'title', true );
		if ( $role ) {
			$title .= '<span class="author-job-title">' . $role . '</span>';
		}
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'newspack_trust_indicators_output_author_job_title' );

/**
 * Output location and expertise info on author archive pages.
 */
function newspack_trust_indicators_output_author_details() {
	if ( ! is_author() || ! class_exists( 'Trust_Indicators_User_Settings' ) ) {
		return;
	}

	$author = get_queried_object();

	$all_settings_fields = Trust_Indicators_User_Settings::get_fields();
	$fields = [
		'location',
		'languages_spoken',
		'areas_of_expertise',
		'location_expertise',
	];

	?>
	<div class="author-additional-infos">
		<?php foreach ( $fields as $field ) : ?>
			<?php $value = get_user_meta( $author->ID, $field, true ); ?>
			<?php if ( empty( $value ) ) : ?>
				<?php continue; ?>
			<?php endif; ?>

			<div class="author-additional-info">
				<h4><?php echo esc_html( $all_settings_fields[ $field ]['label'] ); ?></h4>
				<?php echo wp_kses_post( wpautop( $value ) ); ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
}
add_action( 'newspack_theme_below_author_archive_meta', 'newspack_trust_indicators_output_author_details' );
