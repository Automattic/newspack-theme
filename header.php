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
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'newspack' ); ?></a>

	<header id="masthead" class="site-header hide-header-search" [class]="searchVisible ? 'show-header-search' : 'hide-header-search'">

		<div class="top-header-contain">
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

				<?php if ( has_nav_menu( 'social' ) && false === get_theme_mod( 'header_center_logo', false ) ) : ?>
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
					<nav class="tertiary-menu" aria-label="<?php esc_attr_e( 'Tertiary Menu', 'newspack' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'tertiary-menu',
								'menu_class'     => 'tertiary-menu',
								'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div><!-- .wrapper -->
		</div><!-- .middle-header-contain -->

		<div class="bottom-header-contain">
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

				<button id="search-toggle" on="tap:AMP.setState({searchVisible: !searchVisible})" aria-controls="search-menu" [aria-expanded]="searchVisible ? 'true' : 'false'" aria-expanded="false">
					<span class="screen-reader-text" [text]="searchVisible ? '<?php esc_html_e( 'Close Search', 'newspack' ); ?>' : '<?php esc_html_e( 'Open Search', 'newspack' ); ?>'">
						<?php esc_html_e( 'Open Search', 'newspack' ); ?>
					</span>
					<span class="search-icon"><?php echo wp_kses( newspack_get_icon_svg( 'search', 28 ), newspack_sanitize_svgs() ); ?></span>
					<span class="close-icon"><?php echo wp_kses( newspack_get_icon_svg( 'close', 28 ), newspack_sanitize_svgs() ); ?></span>
				</button>
			</div><!-- .wrapper -->
		</div><!-- .bottom-header-contain -->

		<?php get_template_part( 'template-parts/header/header', 'search' ); ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
