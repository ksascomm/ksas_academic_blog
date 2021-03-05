<?php
/**
 * Display related posts by categories
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */
function related_posts_by_cats() {
	$post_id = get_the_ID();
	$cat_ids = array();
	$categories = get_the_category( $post_id );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
		foreach ( $categories as $category ) :
				array_push( $cat_ids, $category->term_id );
		endforeach;
	endif;

	$current_post_type = get_post_type( $post_id );

	$query_args = array(
		'category__in'   => $cat_ids,
		'post_type'      => $current_post_type,
		'post__not_in'   => array( $post_id ),
		'posts_per_page' => '3',
	);

	$related_cats_post = new WP_Query( $query_args );

	if ( $related_cats_post->have_posts() ) : ?>
	<div class="related-posts-section" data-aos="fade-in" data-aos-once="true">
		<div class="grid-container">
			<div class="grid-x grid-margin-x">	
				<div class="related-posts">
					<h3>Related Posts</h3>
					<div class="grid-x grid-padding-x small-up-1 large-up-3">
						<?php
						while ( $related_cats_post->have_posts() ) :
							$related_cats_post->the_post();
							?>
							<div class="cell"> 
								<div class="card">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php
										the_post_thumbnail(
											'thumbnail',
											array(
												'class' => 'news-thumb',
												'alt'   => esc_html( get_the_title() ),
											)
										);
										?>
									<?php endif; ?>
									<div class="card-section">
										<h5>
										<a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
										</a>
										</h5>
										<?php the_excerpt(); ?>
									</div>
								</div>
							</div>
							<?php
						endwhile;
							// Restore original Post Data!
							wp_reset_postdata();?>
					</div>
				</div>
			</div>
		</div>
	</div>
		<?php
	endif;
}
