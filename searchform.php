<?php
/**
 * Template for displaying search forms.
 *
 * @package Newspack
 */

$unique_id = wp_unique_id( 'search-form-' );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'newspack' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'newspack' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit">
		<?php echo wp_kses( newspack_get_icon_svg( 'search', 28 ), newspack_sanitize_svgs() ); ?>
		<span class="screen-reader-text">
			<?php echo esc_html_x( 'Search', 'submit button', 'newspack' ); ?>
		</span>
	</button>
</form>
