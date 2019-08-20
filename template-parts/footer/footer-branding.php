<?php
/**
 * Displays the footer branding and social links.
 *
 * @package Newspack
 */


if ( is_active_sidebar( 'footer-1' ) && has_custom_logo() ) : ?>
	<div class="footer-branding">
		<div class="wrapper">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php
			endif;
			newspack_social_menu_footer();
			?>
		</div><!-- .wrapper -->
	</div><!-- .footer-branding -->
<?php endif; ?>
