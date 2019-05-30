<?php
/**
 * Displays the post header
 *
 * @package Newspack
 */

$discussion = ! is_page() && newspack_can_show_post_thumbnail() ? newspack_get_discussion_data() : null; ?>


<?php
if ( is_singular() ) :
	the_title( '<h1 class="entry-title">', '</h1>' );
else :
	the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
endif;
?>

<?php if ( ! is_page() ) : ?>
<div class="entry-meta">
	<?php newspack_posted_by(); ?>
	<?php newspack_posted_on(); ?>
</div><!-- .meta-info -->
<?php endif; ?>
