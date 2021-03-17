<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

get_header(); ?>

<div class="main-container" id="page">
	<div class="main-grid sidebar-right">
		<main class="main-content">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'post-full' ); ?>
			<?php endwhile; ?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php related_posts_by_cats(); ?>
<?php
get_footer();
