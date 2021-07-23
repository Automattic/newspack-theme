<?php
/**
 * Component: After Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/after.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.9.11
 *
 * @package Newspack
 *
 * @var string $after_events HTML stored on the Advanced settings to be printed after the Events.
 */

if ( ! empty( $after_events ) ) : ?>
			<div class="tribe-events-after-html">
				<?php echo wp_kses_post( $after_events ); ?>
			</div>
		<?php endif; ?>

	</div><!-- .tec-content -->

	<?php
	if ( true === get_theme_mod( 'newspack_tec_show_sidebar', false ) ) :
		get_sidebar();
	endif;
	?>

</div><!-- .tec-wrapper -->

<style>
@media (min-width: 782px) {
	.tec-wrapper {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	.tec-wrapper #secondary {
		width: calc( 35% - 2rem );
	}

	.tec-wrapper .tec-content {
		width: 65%;
	}
}

@media (min-width: 1024px) {
	.tec-wrapper #secondary {
		/*width: calc( 35% - #{3 * $size__spacing-unit} );*/
		width: calc( 35% - 3rem );
	}
}
</style>

