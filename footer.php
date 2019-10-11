<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspack
 */

?>

	<?php do_action( 'before_footer' ); ?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php get_template_part( 'template-parts/footer/footer', 'branding' ); ?>
		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

		<div class="site-info">

			<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<div class="wrapper">
					<nav class="footer-menu">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer-menu',
									'container'      => false,
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'          => 1,
								)
							);
						?>
					</nav>
				</div><!-- .wrapper -->
			<?php endif; ?>

			<div class="wrapper">
				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( ! empty( $blog_info ) ) : ?>
					<span class="copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.</span>
				<?php endif; ?>

				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'newspack' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress. */
					printf( esc_html__( 'Proudly powered by %s.', 'newspack' ), 'WordPress' );
					?>
				</a>

				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '' );
				}

				if ( ! is_active_sidebar( 'footer-1' ) || ( ! has_custom_logo() ) ) {
					newspack_social_menu_footer();
				}
				?>
			</div><!-- .wrapper -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
