<?php
/**
 * The default template for displaying news content on homepage (meta fields are above the permalink; contains external link class; categories NOT shown)
 *
 * Used for both single and index/archive/search.
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

?>

<article aria-labelledby="post-<?php the_ID(); ?>" class="post-listing cell <?php if ( is_sticky() ) : ?> 
	wp-sticky 
	<?php endif; ?>" data-aos="fade-in" data-aos-once="true">
	<div class="card">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php
				the_post_thumbnail(
					array( 480, 270 ),
					array(
						'class' => 'news-thumb',
						'alt'   => esc_html( get_the_title() ),
					)
				);
				?>
			<?php endif; ?>
			<div class="card-section">
			<header>
				<?php ksasacademic_category_meta(); ?>
				<h2>
					<?php if ( get_post_meta( $post->ID, 'ecpt_external_link', true ) ) : ?>
						<a href="<?php echo esc_url( get_post_meta( $post->ID, 'ecpt_external_link', true ) ); ?>" target="_blank" rel="noopener" title="<?php the_title(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?> <span class="icon-new-tab2" aria-hidden="true"></span>
						</a>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a>
					<?php endif; ?>
				</h2>
				<?php ksasacademic_entry_meta(); ?>
		</header>
		<div class="entry-content">	
				<?php the_excerpt(); ?>
		</div>	
		</div>
	</div>
</article>
