<?php
/**
 * Displays the search form for the header.
 *
 * @package Newspack
 */
?>

<div id="header-search" [aria-expanded]="searchVisible ? 'true' : 'false'" aria-expanded="false">
	<div class="wrapper">
		<?php get_search_form(); ?>
	</div><!-- .wrapper -->
</div><!-- #header-search -->
