<?php
/**
 * Component: Before Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/before.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.9.11
 *
 * @package Newspack
 *
 * @var string $before_events HTML stored on the Advanced settings to be printed before the Events.
 */

?>

<div class="tec-wrapper">
	<div class="tec-content">
		<?php if ( ! empty( $before_events ) ) : ?>
			<div class="tribe-events-before-html">
				<?php echo wp_kses_post( $before_events ); ?>
			</div>
		<?php endif; ?>
