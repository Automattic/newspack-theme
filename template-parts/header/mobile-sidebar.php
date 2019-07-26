<?php
/**
 * Template for display the mobile navigation.
 *
 * @package Newspack
 */
?>

<amp-sidebar id="mobile-sidebar" layout="nodisplay" side="right">

	<button class="mobile-menu-toggle" on='tap:mobile-sidebar.toggle'>
		<?php esc_html_e( 'Close', 'newspack' ); ?>
	</button>

	<?php if ( has_nav_menu( 'tertiary-menu' ) ) : ?>
		<nav toolbar="(min-width: 767px)" toolbar-target="tertiary-nav-contain" class="tertiary-menu" aria-label="<?php esc_attr_e( 'Tertiary Menu', 'newspack' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'tertiary-menu',
					'container'      => false,
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'          => 1,
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php get_search_form(); ?>

	<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
		<nav toolbar="(min-width: 767px)" toolbar-target="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'newspack' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'menu_class'     => 'main-menu',
					'container'      => false,
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>
		<nav toolbar="(min-width: 767px)" toolbar-target="secondary-nav-contain" class="secondary-menu" aria-label="<?php esc_attr_e( 'Secondary Menu', 'newspack' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'secondary-menu',
					'menu_class'     => 'secondary-menu',
					'container'      => false,
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'          => 1,
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav toolbar="(min-width: 767px)" toolbar-target="social-nav-contain" class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'newspack' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'menu_class'     => 'social-links-menu',
					'container'      => false,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>' . newspack_get_icon_svg( 'link' ),
					'depth'          => 1,
				)
			);
			?>
		</nav><!-- .social-navigation -->
	<?php endif; ?>

</amp-sidebar>
