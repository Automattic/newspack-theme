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

	<header id="masthead" class="site-header hide-header-search" [class]="searchVisible ? 'show-header-search site-header ' : 'hide-header-search site-header'">

		<?php
			$header_simplified  = get_theme_mod( 'header_simplified', false );
			$header_center_logo = get_theme_mod( 'header_center_logo', false );
		?>

		<?php if ( false === $header_simplified ) : ?>
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

					<?php if ( has_nav_menu( 'social' ) && false === $header_center_logo ) : ?>
						<?php newspack_social_menu(); ?>
					<?php endif; ?>
				</div><!-- .wrapper -->
			</div><!-- .top-header-contain -->
		<?php endif; ?>

		<div class="middle-header-contain">
			<div class="wrapper">
				<?php if ( has_nav_menu( 'social' ) && true === $header_center_logo && false === $header_simplified ) : ?>
					<?php newspack_social_menu(); ?>
				<?php endif; ?>

				<?php if ( true === $header_simplified && true === $header_center_logo ) : ?>

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
					<?php else : ?>
						<div></div>
					<?php endif; ?>
				<?php endif; ?>

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<?php if ( has_nav_menu( 'primary-menu' ) && true === $header_simplified ) : ?>
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

				<?php if ( has_nav_menu( 'tertiary-menu' ) && ! ( true === $header_center_logo && true === $header_simplified ) ) : ?>
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
						<?php if ( true === $header_simplified ) : ?>
							<?php get_template_part( 'template-parts/header/header', 'search' ); ?>
						<?php endif; ?>
					</nav>
				<?php endif; ?>
			</div><!-- .wrapper -->
		</div><!-- .middle-header-contain -->

		<?php if ( false === $header_simplified ) : ?>
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
					<?php get_template_part( 'template-parts/header/header', 'search' ); ?>
				</div><!-- .wrapper -->
			</div><!-- .bottom-header-contain -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
