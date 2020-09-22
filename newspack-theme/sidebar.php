<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspack
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php
		remove_filter( 'get_the_date', 'newspack_convert_to_time_ago', 10, 3 );
		do_action( 'before_sidebar' );
		dynamic_sidebar( 'sidebar-1' );
		do_action( 'after_sidebar' );
		add_filter( 'get_the_date', 'newspack_convert_to_time_ago', 10, 3 );
	?>
</aside><!-- #secondary -->
