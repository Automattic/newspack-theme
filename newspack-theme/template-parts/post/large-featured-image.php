<?php
/**
 * The template part for displaying large featured images on posts.
 *
 * @package Newspack
 */

$caption = get_the_excerpt( get_post_thumbnail_id() );
// Check the existance of the caption separately, so filters -- like ones that add ads -- don't interfere.
$caption_exists = get_post( get_post_thumbnail_id() )->post_excerpt;


if ( 'behind' === newspack_featured_image_position() ) :
?>

	<div class="featured-image-behind">
		<?php newspack_post_thumbnail(); ?>
		<div class="wrapper">
			<header class="entry-header">
				<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
			</header>
		</div><!-- .wrapper -->
	</div><!-- .featured-image-behind -->

	<?php if ( $caption_exists ) : ?>
		<figcaption><?php echo wp_kses_post( $caption ); ?></figcaption>
	<?php endif; ?>

<?php elseif ( 'beside' === newspack_featured_image_position() ) : ?>

	<div class="featured-image-beside">
		<div class="wrapper">
			<header class="entry-header">
				<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
			</header>
		</div><!-- .wrapper -->

		<?php newspack_post_thumbnail(); ?>

		<?php if ( $caption_exists ) : ?>
			<figcaption><span><?php echo wp_kses_post( $caption ); ?></span></figcaption>
		<?php endif; ?>
	</div><!-- .featured-image-behind -->

<?php elseif ( 'above' === newspack_featured_image_position() ) : ?>

	<div class="featured-image-above">
		<?php newspack_post_thumbnail(); ?>

		<header class="entry-header">
			<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
		</header>
	</div><!-- featured-image-above -->

<?php else : ?>

	<header class="entry-header">
		<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
	</header>

	<?php
	newspack_post_thumbnail();
endif;

