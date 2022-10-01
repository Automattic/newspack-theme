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

<body <?php body_class(); ?> data-amp-auto-lightbox-disable>
<?php

do_action( 'wp_body_open' );
do_action( 'before_header' );
?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'newspack' ); ?></a>

	<?php if ( is_active_sidebar( 'header-2' ) ) : ?>
		<div class="header-widget above-header-widgets">
			<div class="wrapper">
				<?php dynamic_sidebar( 'header-2' ); ?>
			</div><!-- .wrapper -->
		</div><!-- .above-header-widgets -->
	<?php endif; ?>

	<header id="masthead" class="site-header">
		<div class="wrapper">
			<?php block_template_part( 'header' ); ?>
		</div>
	</header>

	<?php
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<div class="site-breadcrumb desktop-only"><div class="wrapper">','</div></div>' );
	}
	?>

	<?php do_action( 'after_header' ); ?>

	<?php if ( is_active_sidebar( 'header-3' ) ) : ?>
		<div class="header-widget below-header-widgets">
			<div class="wrapper">
				<?php dynamic_sidebar( 'header-3' ); ?>
			</div><!-- .wrapper -->
		</div><!-- .above-header-widgets -->
	<?php endif; ?>

	<div id="content" class="site-content">
