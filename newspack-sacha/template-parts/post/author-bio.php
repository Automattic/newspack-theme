<?php
/**
 * The template for displaying Author info
 *
 * @package Newspack Sacha
 */

// Check if the author bio is turned on
if ( false === get_theme_mod( 'show_author_bio', true ) ) {
	return;
}

$author_bio_length = get_theme_mod( 'author_bio_length', 200 );

if ( function_exists( 'coauthors_posts_links' ) && is_single() && ! empty( get_coauthors() ) ) : // phpcs:ignore PHPCompatibility.LanguageConstructs.NewEmptyNonVariable.Found

	$authors      = get_coauthors();
	$author_count = count( $authors );
	$i            = 1;

	foreach ( $authors as $author ) {

		if ( '' !== $author->description ) {
			// avatar_img_tag is a property added by Newspack Network plugin to distributed posts.
			$author_avatar = $author->avatar_img_tag ?? coauthors_get_avatar( $author, 80 );
			$author_url    = get_author_posts_url( $author->ID, $author->user_nicename );
			?>

			<div class="author-bio">
				<div class="author-bio-text">
					<div class="author-bio-header">
						<?php if ( $author_avatar ) { ?>
							<?php if ( '#' !== $author_url ) : ?>
								<a class="author-link" href="<?php echo esc_url( $author_url ); ?>" rel="author">
							<?php endif; ?>
								<?php echo wp_kses( $author_avatar, newspack_sanitize_avatars() ); ?>
							<?php if ( '#' !== $author_url ) : ?>
								</a>
							<?php endif; ?>
						<?php } ?>

						<div>
							<h2 class="accent-header">
								<?php if ( '#' !== $author_url ) : ?>
									<a class="author-link" href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php endif; ?>
									<?php echo wp_kses( apply_filters( 'newspack_author_bio_name', $author->display_name, $author->ID, $author ), array( 'span' => array( 'class' => array() ) ) ); ?>
								<?php if ( '#' !== $author_url ) : ?>
									</a>
								<?php endif; ?>
							</h2>

							<?php if ( true === get_theme_mod( 'show_author_email', false ) && '' !== $author->user_email ) : ?>
								<div class="author-meta">
									<a class="author-email" href="<?php echo 'mailto:' . esc_attr( $author->user_email ); ?>">
										<?php echo wp_kses( newspack_get_social_icon_svg( 'mail', 18 ), newspack_sanitize_svgs() ); ?>
										<?php echo esc_html( $author->user_email ); ?>
									</a>
								</div><!-- .author-meta -->
							<?php endif; ?>
						</div>
					</div><!-- .author-bio-header -->

					<?php if ( get_theme_mod( 'author_bio_truncate', true ) ) : ?>
						<p>
							<?php echo esc_html( newspack_truncate_text( wp_strip_all_tags( $author->description ), $author_bio_length ) ); ?>
							<?php if ( '#' !== $author_url ) : ?>
								<a class="author-link" href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php
									/* translators: %s is the current author's name. */
									printf( esc_html__( 'More by %s', 'newspack' ), esc_html( $author->display_name ) );
								?>
								</a>
							<?php endif; ?>
						</p>
					<?php else : ?>
						<?php echo wp_kses_post( wpautop( $author->description ) ); ?>
						<?php if ( '#' !== $author_url ) : ?>
							<a class="author-link" href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php
									/* translators: %s is the current author's name. */
									printf( esc_html__( 'More by %s', 'newspack' ), esc_html( $author->display_name ) );
								?>
							</a>
						<?php endif; ?>
					<?php endif; ?>

					<?php newspack_author_social_links( $author->ID ); ?>

				</div><!-- .author-bio-text -->

			</div><!-- .author-bio -->
			<?php
		}
	}

elseif ( (bool) get_the_author_meta( 'description' ) && is_single() ) :
	?>

<div class="author-bio">

	<div class="author-bio-text">
		<div class="author-bio-header">
			<?php
				$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
			if ( $author_avatar ) {
				?>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<?php
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $author_avatar;
					?>
				</a>
			<?php } ?>

			<div>
				<h2 class="accent-header">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php echo wp_kses( apply_filters( 'newspack_author_bio_name', get_the_author(), get_the_author_meta( 'ID' ), get_user_by( 'id', get_the_author_meta( 'ID' ) ) ), array( 'span' => array( 'class' => array() ) ) ); ?>
					</a>
				</h2>

				<?php if ( true === get_theme_mod( 'show_author_email', false ) ) : ?>
					<div class="author-meta">
						<a class="author-email" href="<?php echo 'mailto:' . esc_attr( get_the_author_meta( 'user_email' ) ); ?>">
							<?php echo wp_kses( newspack_get_social_icon_svg( 'mail', 18 ), newspack_sanitize_svgs() ); ?>
							<?php echo esc_html( get_the_author_meta( 'user_email' ) ); ?>
						</a>
					</div><!-- .author-meta -->
				<?php endif; ?>
			</div>
		</div><!-- .author-bio-header -->

		<?php if ( get_theme_mod( 'author_bio_truncate', true ) ) : ?>
			<p>
				<?php echo esc_html( newspack_truncate_text( wp_strip_all_tags( get_the_author_meta( 'description' ) ), $author_bio_length ) ); ?>
				<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php
					/* translators: %s is the current author's name. */
					printf( esc_html__( 'More by %s', 'newspack' ), esc_html( get_the_author() ) );
				?>
				</a>
			</p>
		<?php else : ?>
			<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>

			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php
					/* translators: %s is the current author's name. */
					printf( esc_html__( 'More by %s', 'newspack' ), esc_html( get_the_author() ) );
				?>
			</a>
		<?php endif; ?>

		<?php newspack_author_social_links( get_the_author_meta( 'ID' ) ); ?>

	</div><!-- .author-bio-text -->
</div><!-- .author-bio -->
<?php endif; ?>
