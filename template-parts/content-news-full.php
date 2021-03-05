<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
	<header>
	<?php ksasacademic_category_meta(); ?>
	<?php
	if ( is_single() ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	} else {
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
	?>
	<?php ksasacademic_entry_meta(); ?>
	</header>
	<div class="entry-content">
	<?php the_post_thumbnail( 'full', array( 'class' => 'news-thumb' ) ); ?>
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'ksasacademic' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
</article>
