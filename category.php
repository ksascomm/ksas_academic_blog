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
			<h1 class="page-title">Category: <?php single_cat_title(); ?></h1>
		<?php if ( have_posts() ) : ?>
			<div class="grid-x grid-margin-x small-up-1 large-up-3">
				<?php /* Start the Loop */ ?>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php get_template_part( 'template-parts/content-news-teaser', get_post_format() ); ?>
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
