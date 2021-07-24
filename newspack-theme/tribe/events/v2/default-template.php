<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();

?>
<div class="tec-wrapper">

	<?php echo tribe( Template_Bootstrap::class )->get_view_html(); ?>

	<?php
	if ( true === get_theme_mod( 'newspack_tec_show_sidebar', false ) ) :
		get_sidebar();
	endif;
	?>

</div><!-- .tec-wrapper -->

<style>
.tec-wrapper {
	margin: auto;
	max-width: 90%;
	width: 1200px;
}
@media (min-width: 782px) {
	.tec-wrapper {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}

	.tec-wrapper #secondary {
		width: calc( 35% - 2rem );
	}

	.tec-wrapper .tribe-common {
		width: 65%;
	}

	.tribe-common--breakpoint-medium.tribe-common .tribe-common-l-container {
		padding-left: 0;
		padding-right: 0;
	}
}

@media (min-width: 1024px) {
	.tec-wrapper #secondary {
		/*width: calc( 35% - #{3 * $size__spacing-unit} );*/
		width: calc( 35% - 3rem );
	}
}
</style>

<?php
get_footer();
