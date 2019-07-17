<?php
/**
 * Displays the footer branding and social links.
 *
 * @package Newspack
 */


if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<div class="footer-branding">
		<div class="wrapper">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php
			endif;

			if ( has_nav_menu( 'social' ) ) :
			?>
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
	</div><!-- .footer-branding -->
<?php endif; ?>
