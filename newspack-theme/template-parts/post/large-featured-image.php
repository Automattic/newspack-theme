<?php
/**
 * The template part for displaying large featured images on posts.
 *
 * @package Newspack
 */

$header_sticky = get_theme_mod( 'header_sticky', false );

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

	<?php newspack_post_thumbnail_caption(); ?>

<?php elseif ( 'beside' === newspack_featured_image_position() ) : ?>

	<div class="featured-image-beside">
		<div class="wrapper">
			<header class="entry-header">
				<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
			</header>
		</div><!-- .wrapper -->

		<?php newspack_post_thumbnail(); ?>

		<?php newspack_post_thumbnail_caption(); ?>
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

