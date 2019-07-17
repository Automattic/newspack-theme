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

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php get_template_part( 'template-parts/footer/footer', 'branding' ); ?>
		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

		<div class="site-info">
			<div class="wrapper">
				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( ! empty( $blog_info ) ) : ?>
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
				<?php endif; ?>

				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'newspack' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress. */
					printf( esc_html__( 'Proudly powered by %s.', 'newspack' ), 'WordPress' );
					?>
				</a>

				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}

				if ( ! is_active_sidebar( 'footer-1' ) ) {
					newspack_social_menu();
				}
				?>
			</div><!-- .wrapper -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
