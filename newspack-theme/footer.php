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

		<?php remove_filter( 'get_the_date', 'newspack_convert_to_time_ago', 10, 3 ); ?>
		<?php get_template_part( 'template-parts/footer/footer', 'branding' ); ?>
		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

		<div class="site-info">

			<?php get_template_part( 'template-parts/footer/below-footer', 'widgets' ); ?>

			<div class="wrapper site-info-contain">
				<?php
					$copyright_info   = get_bloginfo( 'name' );
					$custom_copyright = get_theme_mod( 'footer_copyright', '' );
					if ( ! empty( $custom_copyright ) ) {
						$copyright_info = $custom_copyright;
					}
				?>
				<?php if ( ! empty( $copyright_info ) ) : ?>
					<span class="copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( $copyright_info ); ?>.</span>
				<?php endif; ?>

				<a href="<?php echo esc_url( __( 'https://newspack.pub/', 'newspack' ) ); ?>" class="imprint">
					<?php echo esc_html__( 'Proudly powered by Newspack by Automattic', 'newspack' ); ?>
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
