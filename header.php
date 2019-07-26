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
				<div id="secondary-nav-contain"></div>
				<div id="social-nav-contain"></div>
			</div><!-- .wrapper -->
		</div><!-- .top-header-contain -->

		<div class="middle-header-contain">
			<div class="wrapper">
				<?php if ( has_nav_menu( 'social' ) && true === get_theme_mod( 'header_center_logo', false ) ) : ?>
					<div id="social-nav-contain"></div>
				<?php endif; ?>

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<div id="tertiary-nav-contain"></div>

				<?php if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) : ?>
					<button class="mobile-menu-toggle" on='tap:mobile-sidebar.toggle'>
						<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
						<?php esc_html_e( 'Menu', 'newspack' ); ?>
					</button>
				<?php endif; ?>
			</div><!-- .wrapper -->
		</div><!-- .middle-header-contain -->

		<div class="bottom-header-contain">
			<div class="wrapper">
				<div id="site-navigation"></div>

				<?php get_template_part( 'template-parts/header/header', 'search' ); ?>
			</div><!-- .wrapper -->
		</div><!-- .bottom-header-contain -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
