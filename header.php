<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspack
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/header/mobile', 'sidebar' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'newspack' ); ?></a>

	<header id="masthead" class="site-header hide-header-search" [class]="searchVisible ? 'show-header-search site-header ' : 'hide-header-search site-header'">

		<div class="top-header-contain desktop-navigation">
			<div class="wrapper">
				<?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>
					<nav class="secondary-menu" aria-label="<?php esc_attr_e( 'Secondary Menu', 'newspack' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary-menu',
								'menu_class'     => 'secondary-menu',
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>

				<?php newspack_social_menu(); ?>
			</div><!-- .wrapper -->
		</div><!-- .top-header-contain -->

		<div class="middle-header-contain">
			<div class="wrapper">
				<?php if ( has_nav_menu( 'social' ) && true === get_theme_mod( 'header_center_logo', false ) ) : ?>
					<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'newspack' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . newspack_get_icon_svg( 'link' ),
								'depth'          => 1,
							)
						);
						?>
					</nav><!-- .social-navigation -->
				<?php endif; ?>

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<?php if ( has_nav_menu( 'tertiary-menu' ) ) : ?>
					<nav class="tertiary-menu desktop-navigation" aria-label="<?php esc_attr_e( 'Tertiary Menu', 'newspack' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'tertiary-menu',
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>

				<?php if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) : ?>
					<button class="mobile-menu-toggle" on='tap:mobile-sidebar.toggle'>
						<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
						<?php esc_html_e( 'Menu', 'newspack' ); ?>
					</button>
				<?php endif; ?>
			</div><!-- .wrapper -->
		</div><!-- .middle-header-contain -->

		<div class="bottom-header-contain desktop-navigation">
			<div class="wrapper">
				<?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
					<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'newspack' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary-menu',
								'menu_class'     => 'main-menu',
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							)
						);
						?>
					</nav><!-- #site-navigation -->
				<?php endif; ?>

				<?php get_template_part( 'template-parts/header/header', 'search' ); ?>
			</div><!-- .wrapper -->
		</div><!-- .bottom-header-contain -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
