<?php
/**
 * Template Name: Front (Blog)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KSASAcademic
 */

$theme_option = flagship_sub_get_global_options();
get_header(); ?>

<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
	<header class="hero" role="banner" aria-label="Featured Image">
			<div class="full-screen-image show-for-large">
				<div class="front-hero static" role="banner">
				<?php
						the_post_thumbnail(
							'full',
							array(
								'class'   => 'featured-hero-image',
								'loading' => 'eager',
							)
						);
				?>
				</div>
			</div>
		</header>
<?php endif; ?>
<?php do_action( 'ksasacademic_before_content' ); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
	<main class="home-intro blue" id="page" tabindex="0" aria-label="Website Introduction">
		<div class="grid-x grid-padding-x grid-container">
			<div class="cell small-12">
				<?php the_content(); ?>	
			</div>	
		</div>
	</main>
		<?php
		endwhile;
		endif;
?>
<?php do_action( 'ksasacademic_after_content' ); ?>
<div class="main-container">
	<div class="main-grid homepage">
		<div class="main-content-full-width homepage-news">
			<div class="heading-archive">
				<h2><?php echo esc_html( $theme_option['flagship_sub_feed_name'] ); ?></h2>     
				<a class="button news-archive" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
					View All Posts <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
				</a>
			</div>
			<?php
			if ( is_active_sidebar( 'homepage1' ) && is_active_sidebar( 'homepage2' ) ) :
					$news_quantity = '4';
			else :
					$news_quantity = $theme_option['flagship_sub_news_quantity'];
			endif;
			?>
			<?php
			$news_query = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => $news_quantity,
				)
			);
			// Start the post counter at 0.
			$postnum = 0;
			if ( $news_query->have_posts() ) :
				?>
			<div class="grid-x grid-margin-x small-up-1 large-up-3" >
				<?php
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					?>
					<?php get_template_part( 'template-parts/content-post-teaser', get_post_format() ); ?>
					<?php
					// Increment the post counter.
					$postnum++;
					// if sidebar is active and post counter = 2 show widget.
					if ( is_active_sidebar( 'homepage1' ) && $postnum == 2 ) {
						?>
						<div class="front-widget-area cell" data-aos="fade-in" data-aos-once="true">
							<?php dynamic_sidebar( 'homepage1' ); ?>
						</div>
					<?php } ?>
					<?php
					// if sidebar is active and post counter = 4 show widget.
					if ( is_active_sidebar( 'homepage2' ) && $postnum == 4 ) {
						?>
						<div class="front-widget-area cell" data-aos="fade-in" data-aos-once="true">
							<?php dynamic_sidebar( 'homepage2' ); ?>
						</div>
						<?php } ?>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php do_action( 'ksasacademic_after_content' ); ?>

<?php
get_footer();
