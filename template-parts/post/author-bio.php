<?php
/**
 * The template for displaying Author info
 *
 * @package Newspack
 */


if ( function_exists( 'coauthors_posts_links' ) && is_single() ) :

	$authors      = get_coauthors();
	$author_count = count( $authors );
	$i            = 1;

	foreach ( $authors as $author ) {

		if ( '' !== $author->description ) {

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
			?>

			<div class="author-bio">
				<?php
				if ( ! newspack_is_active_style_pack( 'style-4' ) && $author_avatar ) {
					echo wp_kses_post( $author_avatar );
				}
				?>

				<div class="author-bio-text">
					<div class="author-bio-header">
						<?php
						if ( newspack_is_active_style_pack( 'style-4' ) && $author_avatar ) {
							echo wp_kses_post( $author_avatar );
						}
						?>

						<div>
							<h2 class="accent-header">
								<?php echo esc_html( esc_html( $author->display_name ) ); ?>
								<span><?php // TODO: Add Job title ?></span>
							</h2>
							<div class="author-meta">
								<a class="author-email" href="<?php echo 'mailto:' . esc_attr( $author->user_email ); ?>"><?php echo esc_html( $author->user_email ); ?></a>
							</div>
						</div>
					</div><!-- .author-bio-header -->

					<p>
						<?php echo wp_kses_post( $author->description ); ?>
					</p><!-- .author-description -->
					<a class="author-link" href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ); ?>" rel="author">
						<?php
							/* translators: %s is the current author's name. */
							printf( esc_html__( 'More by %s', 'newspack' ), esc_html( $author->display_name ) );
						?>
					</a>
				</div><!-- .author-bio-text -->

			</div><!-- .author-bio -->
		<?php
		}
	}

elseif ( (bool) get_the_author_meta( 'description' ) && is_single() ) :
?>

<div class="author-bio">

	<?php
	if ( ! newspack_is_active_style_pack( 'style-4' ) ) {
		$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
		if ( $author_avatar ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $author_avatar;
		}
	}
	?>

	<div class="author-bio-text">
		<div class="author-bio-header">
			<?php
			if ( newspack_is_active_style_pack( 'style-4' ) ) {
				$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
				if ( $author_avatar ) {
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $author_avatar;
				}
			}
			?>

			<div>
				<h2 class="accent-header">
					<?php echo esc_html( get_the_author() ); ?>
					<span><?php // TODO: Add Job title ?></span>
				</h2>
				<div class="author-meta">
					<a class="author-email" href="<?php echo 'mailto:' . esc_attr( get_the_author_meta( 'user_email' ) ); ?>"><?php the_author_meta( 'user_email' ); ?></a>
				</div>
			</div>
		</div><!-- .author-bio-header -->

		<p>
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-description -->
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php
				/* translators: %s is the current author's name. */
				printf( esc_html__( 'More by %s', 'newspack' ), esc_html( get_the_author() ) );
			?>
		</a>
	</div><!-- .author-bio-text -->
</div><!-- .author-bio -->
<?php endif; ?>
