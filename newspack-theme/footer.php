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


$show_footer_branding = get_theme_mod( 'footer_show_branding', true );
$has_footer_logo = false;
if ( '' !== get_theme_mod( 'newspack_footer_logo', '' ) && 0 !== get_theme_mod( 'newspack_footer_logo', '' ) ) {
	$has_footer_logo = true;
}
?>

	<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
		<div class="above-footer-widgets">
			<div class="wrapper">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div><!-- .wrapper -->
		</div><!-- .above-footer-widgets -->
	<?php endif; ?>

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

				<a target="_blank" href="<?php echo esc_url( __( 'https://newspack.com/', 'newspack' ) ); ?>" class="imprint">
					<?php echo esc_html__( 'Powered by Newspack', 'newspack' ); ?>
				</a>

				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '' );
				}


				if ( ( ! is_active_sidebar( 'footer-1' ) || ! ( has_custom_logo() || $has_footer_logo ) ) || ! $show_footer_branding ) {
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
