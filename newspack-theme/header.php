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
<?php

do_action( 'wp_body_open' );
do_action( 'before_header' );

// Header Settings
$header_simplified     = get_theme_mod( 'header_simplified', false );
$header_center_logo    = get_theme_mod( 'header_center_logo', false );
$show_slideout_sidebar = get_theme_mod( 'header_show_slideout', false );
$slideout_sidebar_side = get_theme_mod( 'slideout_sidebar_side', 'left' );
$header_sub_simplified = get_theme_mod( 'header_sub_simplified', false );

// Even if 'Show Slideout Sidebar' is checked, don't show it if no widgets are assigned.
if ( ! is_active_sidebar( 'header-1' ) ) {
	$show_slideout_sidebar = false;
}

get_template_part( 'template-parts/header/mobile', 'sidebar' );
get_template_part( 'template-parts/header/desktop', 'sidebar' );

if ( true === $header_sub_simplified && ! is_front_page() ) :
	get_template_part( 'template-parts/header/subpage', 'sidebar' );
endif;
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'newspack' ); ?></a>

	<header id="masthead" class="site-header hide-header-search" [class]="searchVisible ? 'show-header-search site-header ' : 'hide-header-search site-header'">

		<?php if ( true === $header_sub_simplified && ! is_front_page() ) : ?>
			<div class="middle-header-contain">
				<div class="wrapper">
					<?php if ( newspack_has_menus() || true === $show_slideout_sidebar ) : ?>
						<div class="subpage-toggle-contain">
							<button class="subpage-toggle" on="tap:subpage-sidebar.toggle">
								<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
								<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'newspack' ); ?></span>
							</button>
						</div>
					<?php endif; ?>

					<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

					<?php newspack_mobile_cta(); ?>

					<?php if ( newspack_has_menus() ) : ?>
						<button class="mobile-menu-toggle" on="tap:mobile-sidebar.toggle">
							<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
							<span><?php esc_html_e( 'Menu', 'newspack' ); ?></span>
						</button>
					<?php endif; ?>

					<?php get_template_part( 'template-parts/header/header', 'search' ); ?>
				</div>
			</div><!-- .wrapper -->
		<?php else : ?>
			<?php if ( has_nav_menu( 'secondary-menu' ) ) : ?>
				<div class="top-header-contain desktop-only">
					<div class="wrapper">
						<?php if ( true === $show_slideout_sidebar && 'left' === $slideout_sidebar_side ) : ?>
							<button class="desktop-menu-toggle" on="tap:desktop-sidebar.toggle">
								<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
								<span><?php echo esc_html( get_theme_mod( 'slideout_label', esc_html__( 'Menu', 'newspack' ) ) ); ?></span>
							</button>
						<?php endif; ?>

						<div id="secondary-nav-contain">
							<?php
							if ( ! newspack_is_amp() ) {
								newspack_secondary_menu();
							}
							?>
						</div>

						<?php
						// If logo is NOT centered:
						if (
							( false === $header_center_logo && false === $header_simplified ) ||
							( true === $header_simplified )
							) :
						?>
							<div id="social-nav-contain">
								<?php
								if ( ! newspack_is_amp() ) {
									newspack_social_menu_header();
								}
								?>
							</div>
						<?php endif; ?>

						<?php if ( true === $show_slideout_sidebar && 'right' === $slideout_sidebar_side ) : ?>
							<button class="desktop-menu-toggle dir-right" on="tap:desktop-sidebar.toggle">
								<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
								<span><?php echo esc_html( get_theme_mod( 'slideout_label', esc_html__( 'Menu', 'newspack' ) ) ); ?></span>
							</button>
						<?php endif; ?>
					</div><!-- .wrapper -->
				</div><!-- .top-header-contain -->
			<?php endif; ?>

			<div class="middle-header-contain">
				<div class="wrapper">
					<?php if ( true === $show_slideout_sidebar && ! has_nav_menu( 'secondary-menu' ) && 'left' === $slideout_sidebar_side ) : ?>
						<button class="desktop-menu-toggle" on="tap:desktop-sidebar.toggle">
							<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
							<span><?php echo esc_html( get_theme_mod( 'slideout_label', esc_html__( 'Menu', 'newspack' ) ) ); ?></span>
						</button>
					<?php endif; ?>

					<?php
					// Centered logo AND NOT short header.
					if ( true === $header_center_logo && false === $header_simplified ) :
					?>
						<div id="social-nav-contain" class="desktop-only">
							<?php
							if ( ! newspack_is_amp() ) {
								newspack_social_menu_header();
							}
							?>
						</div>
					<?php endif; ?>

					<?php
					// Centered logo AND short header.
					if ( true === $header_center_logo && true === $header_simplified ) :
					?>

						<div class="nav-wrapper desktop-only">
							<div id="site-navigation">
								<?php
								if ( ! newspack_is_amp() ) {
									newspack_primary_menu();
								}
								?>
							</div><!-- #site-navigation -->
						</div><!-- .nav-wrapper -->

					<?php endif; ?>

					<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

					<?php
					// Short header:
					if ( true === $header_simplified && false === $header_center_logo ) :
					?>

						<div class="nav-wrapper desktop-only">
							<div id="site-navigation">
								<?php
								if ( ! newspack_is_amp() ) {
									newspack_primary_menu();
								}
								?>
							</div><!-- #site-navigation -->

							<?php
							// Centered logo:
							if ( true === $header_center_logo ) {
								get_template_part( 'template-parts/header/header', 'search' );
							}
							?>
						</div><!-- .nav-wrapper -->

					<?php endif; ?>


					<div class="nav-wrapper desktop-only">
						<div id="tertiary-nav-contain">
							<?php
							if ( ! newspack_is_amp() ) {
								newspack_tertiary_menu();
							}
							?>
						</div><!-- #tertiary-nav-contain -->

						<?php
							// Header is simplified OR logo is centered:
							if ( true === $header_simplified || true === $header_center_logo ) :
								get_template_part( 'template-parts/header/header', 'search' );
							endif;
						?>
					</div><!-- .nav-wrapper -->

					<?php if ( true === $show_slideout_sidebar && ! has_nav_menu( 'secondary-menu' ) && 'right' === $slideout_sidebar_side ) : ?>
						<button class="desktop-menu-toggle dir-right" on="tap:desktop-sidebar.toggle">
							<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
							<span><?php echo esc_html( get_theme_mod( 'slideout_label', esc_html__( 'Menu', 'newspack' ) ) ); ?></span>
						</button>
					<?php endif; ?>

					<?php newspack_mobile_cta(); ?>

					<?php if ( newspack_has_menus() ) : ?>
						<button class="mobile-menu-toggle" on="tap:mobile-sidebar.toggle">
							<?php echo wp_kses( newspack_get_icon_svg( 'menu', 20 ), newspack_sanitize_svgs() ); ?>
							<span><?php esc_html_e( 'Menu', 'newspack' ); ?></span>
						</button>
					<?php endif; ?>

				</div><!-- .wrapper -->
			</div><!-- .middle-header-contain -->


			<?php
			// Header is NOT short:
			if ( false === $header_simplified ) :
			?>
				<div class="bottom-header-contain desktop-only">
					<div class="wrapper">
						<div id="site-navigation">
							<?php
							if ( ! newspack_is_amp() ) {
								newspack_primary_menu();
							}
							?>
						</div>

						<?php
						// If logo is not centered.
						if ( false === $header_center_logo && has_nav_menu( 'primary-menu' ) ) {
							get_template_part( 'template-parts/header/header', 'search' );
						}
						?>
					</div><!-- .wrapper -->
				</div><!-- .bottom-header-contain -->
			<?php
			endif;

			/**
			 * Displays 'highlight' menu; created a function to reduce duplication.
			 */
			if ( has_nav_menu( 'highlight-menu' ) ) :
			?>
				<div class="highlight-menu-contain desktop-only">
					<div class="wrapper">
						<nav class="highlight-menu" aria-label="<?php esc_attr_e( 'Highlight Menu', 'newspack' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'highlight-menu',
									'container'      => false,
									'items_wrap'     => '<ul id="%1$s" class="%2$s"><li><span class="menu-label">' . esc_html( wp_get_nav_menu_name( 'highlight-menu' ) ) . '</span></li>%3$s</ul>',
									'depth'          => 1,
								)
							);
							?>
						</nav>
					</div><!-- .wrapper -->
				</div><!-- .highlight-menu-contain -->
			<?php endif; ?>
		<?php endif; ?>

	</header><!-- #masthead -->

	<?php
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<div class="site-breadcrumb desktop-only"><div class="wrapper">','</div></div>' );
	}
	?>

	<?php do_action( 'after_header' ); ?>

	<div id="content" class="site-content">
