<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

?>

<footer class="footer">
	<?php if ( is_front_page() && is_plugin_active( 'formidable/formidable.php' ) ) : ?>
	<div class="newsletter-section">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 large-4 large-offset-2">
				<h2><i class="fas fa-envelope-open-text"></i> Newsletter</h2>
				<p>Subscribe now to get our latest blog posts.</p>
			</div>
			<div class="cell small-12 large-4">
				<?php echo do_shortcode( '[formidable id=2]' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="footer-container">
	<?php if ( has_nav_menu( 'footer-links' ) ) : ?>
		<div class="grid-x grid-padding-x hide-for-print">
			<div class="cell small-12 footer-links">
				<?php ksasacademic_footer_links(); ?>
			</div>
			<div class="small-12 cell centered">
				<a href="https://www.jhu.edu/">
					<img class="jhushield" src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/jhu.horizontal.white.png" alt="Johns Hopkins University">
				</a>
			</div>
		</div>

	<?php else : ?>
		<div class="grid-x grid-padding-x hide-for-print">
			<div class="small-12 medium-4 cell">
				<a href="https://www.jhu.edu/">
					<img class="jhushield" src="<?php echo get_template_directory_uri(); ?>/dist/assets/images/jhu.horizontal.white.png" alt="Johns Hopkins University">
				</a>
			</div>
			<div class="small-12 medium-4 cell">
				<div class="footer-links">
					<ul class="menu" role="menu" id="menu-footer-links">
						<li role="menuitem"><a href="https://accessibility.jhu.edu/" target="_blank">Accessibility</a></li>	
						<li role="menuitem"><a href="https://jobs.jhu.edu/" target="_blank">Careers</a></li>	
						<li role="menuitem"><a href="https://it.johnshopkins.edu/policies/privacystatement" target="_blank">Privacy Statement</a></li>
					</ul>
				</div>
			</div>
			<div class="small-12 medium-4 cell social-media hide-for-small-only">
				<a href="http://facebook.com/JHUArtsSciences"><span class="fab fa-facebook fa-2x"></span><span class="screen-reader-text">Facebook</span></a>
				<a href="https://www.instagram.com/JHUArtsSciences/"><span class="fab fa-instagram fa-2x"></span><span class="screen-reader-text">Instagram</span></a>
				<a href="https://twitter.com/JHUArtsSciences"><span class="fab fa-twitter fa-2x"></span><span class="screen-reader-text">Twitter</span></a>
				<a href="https://www.youtube.com/jhuartssciences"><span class="fab fa-youtube fa-2x"></span><span class="screen-reader-text">YouTube</span></a>
		</div>
	<?php endif; ?>

			<div class="small-12 cell copydate">
				<?php $theme_option = flagship_sub_get_global_options(); ?>
				<p>&copy; <?php print gmdate( 'Y' ); ?> Johns Hopkins University, <?php echo $theme_option['flagship_sub_copyright']; ?></p>
			</div>
	</div>
</footer>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
