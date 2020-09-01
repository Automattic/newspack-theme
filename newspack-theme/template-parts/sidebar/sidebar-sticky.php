<?php
/**
 * Template to display a sticky 'sidebar' on desktop.
 *
 * @package Newspack
 */
?>

<nav
	<?php if ( newspack_is_amp() ) : ?>
	toolbar="(min-width: 960px)"
	toolbar-target="sticky-sidebar"
	<?php endif; ?>
>
	<ul>
		<li><img src="https://via.placeholder.com/300x450" /></li>
	</ul>
</nav>
