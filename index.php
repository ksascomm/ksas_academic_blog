<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

get_header();
$theme_option = flagship_sub_get_global_options(); ?>

<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width ">
			<div class="secondary">
				<?php ksasacademic_breadcrumb(); ?>
			</div>				
			<h1 class="page-title"><?php echo esc_html( $theme_option['flagship_sub_feed_name'] ); ?></h1>
		<?php
		if ( have_posts() ) :
			$post_count = 0;
			?>
			<div class="grid-x grid-margin-x small-up-1 large-up-3">
				<?php /* Start the Loop */ ?>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php
					/*
					 * Add the post count below the loop.
					 * Then add the widget area and change the post count to have it show up
					 * after X many posts have been used. Right now it'll show up after every 2 posts
					 */

					if ( is_active_sidebar( 'sidebar-1' ) && $post_count == 2 ) :
						?>
					<div class="callout widget-area cell" data-closable="fade-in fade-out">
						<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
							<span aria-hidden="true">&times;</span>
						</button>
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
						<?php
					endif;
					wp_reset_postdata();
					?>
					<?php get_template_part( 'template-parts/content-news-teaser', get_post_format() ); ?>
					<?php $post_count++; ?>
				<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</div>
			<?php endif; // End have_posts() check. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<div class="paging">
			<?php
			if ( function_exists( 'ksasacademic_pagination' ) ) :
				ksasacademic_pagination();
			elseif ( is_paged() ) :
				?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'ksasacademic' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'ksasacademic' ) ); ?></div>
				</nav>
			<?php endif; ?>
			</div>
		</main>
	</div>
</div>
<?php
get_footer();
