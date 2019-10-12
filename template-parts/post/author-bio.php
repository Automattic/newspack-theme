<?php
/**
 * The template for displaying Author info
 *
 * @package Newspack
 */

if ( (bool) get_the_author_meta( 'description' ) && is_single() ) : ?>
<div class="author-bio">

	<?php
	if ( ! newspack_is_active_style_pack( 'style-4' ) ) :
		$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
		if ( $author_avatar ) :
			echo wp_kses(
				$author_avatar,
				array(
					'img' => array(
						'src'    => array(),
						'alt'    => array(),
						'class'  => array(),
						'width'  => array(),
						'height' => array(),
					),
				)
			);
		endif;
	endif;
	?>

	<div class="author-bio-text">
		<div class="author-bio-header">
			<?php
			if ( newspack_is_active_style_pack( 'style-4' ) ) :
				$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
				if ( $author_avatar ) :
					echo wp_kses(
						$author_avatar,
						array(
							'img' => array(
								'src'    => array(),
								'alt'    => array(),
								'class'  => array(),
								'width'  => array(),
								'height' => array(),
							),
						)
					);
				endif;
			endif;
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
