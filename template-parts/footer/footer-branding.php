<?php
/**
 * Displays the footer branding and social links.
 *
 * @package Newspack
 */


if ( is_active_sidebar( 'footer-1' ) && has_custom_logo() ) : ?>
	<div class="footer-branding">
		<div class="wrapper">
			<?php
			if ( '' !== get_theme_mod( 'newspack_footer_logo', '' ) && 0 !== get_theme_mod( 'newspack_footer_logo', '' ) ) :
			?>
				<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php
					echo wp_get_attachment_image(
						get_theme_mod( 'newspack_footer_logo', '' ),
						'newspack-footer-logo',
						'',
						array( 'class' => 'custom-logo' )
					);
					?>
				</a>
			<?php
			elseif ( has_custom_logo() ) :
				the_custom_logo();
			endif;

			newspack_social_menu_footer();
			?>
		</div><!-- .wrapper -->
	</div><!-- .footer-branding -->
<?php endif; ?>
