<?php
/**
 * The sidebar containing the main widget area
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

?>
<aside class="sidebar" aria-label="Page Sidebar">
	<?php
	global $post; // Setup the global variable $post.
	// Get the top-level page slug for sidebar/widget content conditionals.
	$ancestors      = get_post_ancestors( $post->ID ); // Get the array of ancestors.
	$ancestor_id    = ( $ancestors ) ? $ancestors[ count( $ancestors ) - 1 ] : $post->ID;
	$the_ancestor   = get_page( $ancestor_id );
	$ancestor_url   = get_permalink( $the_ancestor );
	$ancestor_title = $the_ancestor->post_title;

	if ( is_page() && $post->post_parent ) {
		// Make sure we are on a page and that the page is a parent.
		$kiddies = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	} else {
		$kiddies = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	}
	if ( $kiddies ) :
		?>

		<div class="sidebar-menu" aria-labelledby="sidebar-navigation">
			<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in 
				<?php if ( is_home() ) : ?>
					<a href="<?php echo esc_url( get_home_url() ); ?>/about/" aria-label="Sidebar Menu: About">About</a>
				<?php else : ?>
					<a href="<?php echo esc_url( $ancestor_url ); ?>" aria-label="Sidebar Menu: <?php echo esc_html( $ancestor_title ); ?>" class="border-dotted border-b-2 border-grey"><?php echo esc_html( $ancestor_title ); ?></a>
				<?php endif; ?>
			</h1>
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'top-bar-r',
					'menu_class'      => 'nav',
					'container_class' => '',
					'sub_menu'        => true,
				)
			);
			?>
		</div>
	<?php endif; ?>
	<?php if ( is_singular( 'people' ) ) : ?>
		<div class="sidebar-menu-area" aria-labelledby="sidebar-navigation">
			<div class="sidebar-menu">
				<h1 class="sidebar-menu-title" id="sidebar-navigation">Also in <a href="<?php echo esc_url( get_home_url() ); ?>/people/" aria-label="Sidebar Menu: People">People</a></h1>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-bar-r',
						'menu_class'     => 'nav',
						'submenu'        => 'People',
						'depth'          => 2,
						'items_wrap'     => '<ul class="%2$s" role="menu" aria-label="Sidebar Menu">%3$s</ul>',
					)
				);
				?>
			</div>
			<?php if ( has_term( '', 'role' ) && ! has_term( 'job-market-candidate', 'role' ) ) : ?>			
				<div class="sidebar-menu faculty-bio-jump" aria-labelledby="jump-menu">
					<label for="jump">
						<h1 id="jump-menu">Jump to Faculty Member</h1>
					</label>
					<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								?>
							<option>---<?php the_title(); ?></option> 
								<?php
						endwhile;
						endif;
						?>
						<?php
						$jump_menu_query = new WP_Query(
							array(
								'post-type'      => 'people',
								'role'           => 'faculty',
								'meta_key'       => 'ecpt_people_alpha',
								'orderby'        => 'meta_value',
								'order'          => 'ASC',
								'posts_per_page' => 100,
							)
						);
						?>
						<?php
						while ( $jump_menu_query->have_posts() ) :
							$jump_menu_query->the_post();
							?>
							<option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ( is_singular( 'testimonial' ) ) : ?>
		<div class="sidebar-menu faculty-bio-jump" aria-labelledby="jump-menu">
			<label for="jump">
				<h1 id="jump-menu">View Other Testimonials</h1>
			</label>
			<select name="jump" id="jump" onchange="window.open(this.options[this.selectedIndex].value,'_top')">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
					<option>---<?php the_title(); ?></option> 
						<?php
				endwhile;
				endif;
				?>
				<?php
				$jump_menu_query = new WP_Query(
					array(
						'post-type'       => 'testimonial',
						'testimonialtype' => array( 'internship-testimonial', 'alumni-testimonial' ),
						'orderby'         => 'title',
						'order'           => 'ASC',
						'posts_per_page'  => 50,
					)
				);
				?>
				<?php
				while ( $jump_menu_query->have_posts() ) :
					$jump_menu_query->the_post();
					?>
					<option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>
				<?php endwhile; ?>
			</select>
		</div>
	<?php endif; ?>

<!-- Page Specific Sidebar -->
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
			the_post();
			$sidebar = get_post_meta( $post->ID, 'ecpt_page_sidebar', true );
		?>
		<div class="widget-ecpt-page-sidebar">
			<?php dynamic_sidebar( $sidebar ); ?>
		</div>
			<?php
			endwhile;
			endif;
?>

<!--Single Post Sidebar -->
	<?php
	if ( is_single() && ! is_attachment() ) :
		?>


		<?php if ( is_plugin_active( 'formidable/formidable.php' ) ) : ?>
		<div class="reveal" id="exampleModal1" data-reveal>
			<?php echo FrmFormsController::show_form( '1', $key = '', $title = true, $description = true ); ?>
			<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
			<?php
		endif;
		?>

		<?php if ( is_plugin_active( 'formidable/formidable.php' ) ) : ?>
			<div class="widget-sidebar">
				<div class="widget widget_text">
					<h3 class="widgettitle"><i class="fas fa-envelope-open-text"></i> Newsletter</h3>
					<div class="textwidget">
						<p>Subscribe now to get our latest blog posts.</p>
						<?php echo do_shortcode( '[formidable id=2]' ); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>


		<?php
		endif;
	?>


<?php if ( is_active_sidebar( 'page-sb' ) ) : ?>

	<div class="widget-sidebar">
		<!--This is the Global Sidebar, not page-specific Sidebar #1 -->
		<?php dynamic_sidebar( 'page-sb' ); ?>
	</div>

<?php endif; ?>

</aside>
