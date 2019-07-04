<?php
/**
 * Displays the post header
 *
 * @package Newspack
 */

$discussion = ! is_page() && newspack_can_show_post_thumbnail() ? newspack_get_discussion_data() : null; ?>


<?php if ( is_singular() ) : ?>
	<?php
	if ( ! is_page() ) :
		newspack_categories();
	endif;
	?>
	<h1 class="entry-title">
		<?php echo wp_kses_post( get_the_title() ); ?>
	</h1>
<?php else : ?>
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php echo wp_kses_post( get_the_title() ); ?>
		</a>
	</h2>
<?php endif; ?>

<?php if ( ! is_page() ) : ?>
	<div class="entry-subhead">
		<div class="entry-meta">
			<?php newspack_posted_by(); ?>
			<?php newspack_posted_on(); ?>
		</div><!-- .meta-info -->
		<?php
			// Display Jetpack Share icons, if enabled
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
		?>
	</div>
<?php endif; ?>
