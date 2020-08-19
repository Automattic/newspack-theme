<?php
/**
 * Displays the post header
 *
 * @package Newspack
 */

$discussion = ! is_page() && newspack_can_show_post_thumbnail() ? newspack_get_discussion_data() : null;

?>

<?php if ( is_singular() ) : ?>
	<?php
	if ( ! is_page() ) :
		if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id() ) ) {
			newspack_sponsor_label( get_the_id(), true );
		} else {
			newspack_categories();
		}
	endif;
	?>
	<?php
		$subtitle = get_post_meta( $post->ID, 'newspack_post_subtitle', true );
	?>
	<h1 class="entry-title <?php echo $subtitle ? 'entry-title--with-subtitle' : ''; ?>">
		<?php echo wp_kses_post( get_the_title() ); ?>
	</h1>
	<?php if ( $subtitle ) : ?>
		<div class="newspack-post-subtitle">
			<?php echo esc_html( $subtitle ); ?>
		</div>
	<?php endif; ?>
<?php else : ?>
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php echo wp_kses_post( get_the_title() ); ?>
		</a>
	</h2>
<?php endif; ?>


<?php if ( ! is_page() ) : ?>
	<div class="entry-subhead">
		<?php if ( function_exists( 'newspack_get_all_sponsors' ) && newspack_get_all_sponsors( get_the_id(), 'native' ) ) : ?>
			<div class="entry-meta entry-sponsor">
				<?php newspack_sponsor_logo_list( get_the_id() ); ?>
				<span>
					<?php
						newspack_sponsor_byline( get_the_id() );
						newspack_posted_on();
						do_action( 'newspack_theme_entry_meta' );
					?>
				</span>
			</div>
		<?php else : ?>
			<div class="entry-meta">
				<?php
					newspack_posted_by();
					newspack_posted_on();
					do_action( 'newspack_theme_entry_meta' );
				?>
			</div><!-- .meta-info -->
		<?php endif; ?>
		<?php
			// Display Jetpack Share icons, if enabled
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
		?>
	</div>
<?php endif; ?>
