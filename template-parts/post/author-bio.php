<?php
/**
 * The template for displaying Author info
 *
 * @package Newspack
 */

if ( (bool) get_the_author_meta( 'description' ) ) : ?>
<div class="author-bio">
	<?php
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
	?>

	<div class="author-bio-text">
		<h2 class="author-title">
			<?php esc_html( get_the_author() ); ?>
		</h2>
		<p class="author-description">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-description -->
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php esc_html_e( 'View more posts', 'newspack' ); ?>
		</a>
</div><!-- .author-bio -->
<?php endif; ?>
