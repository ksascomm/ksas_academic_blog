<?php
/**
 * Entry meta information for posts
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

if ( ! function_exists( 'ksasacademic_entry_meta' ) ) :
	function ksasacademic_entry_meta() {
		echo '<div class="entry-meta">';
		if ( ! is_author() ) :
			// Hide 'By...' field on author archive page.
			echo '<div class="posted-by">';
				// CEASE PublishPress Authors plugin conditional.
				// ADD Co-Authors Plus function conditional.
			if ( function_exists( 'coauthors_posts_links' ) ) {
				coauthors_posts_links();
			} else {
				// Revert to core functions if no plugin.
				printf(
					/* translators: %s author name. */
					esc_html__( 'By %s', 'ksasacademic' ),
					'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a><br>'
				);
			}
			if ( is_single() ) :
				// Show email address on single post.
				?>
				<span class="contact"><br><i class="fas fa-envelope"></i> <a href="mailto:<?php echo esc_html( get_the_author_meta( 'user_email' ) ); ?>?subject=Response to: <?php the_title(); ?>">Contact the author</a></span>
			<?php endif; ?>
			<?php
			echo '</div>';
		endif;
		// Set up time variable and echo below.
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);
			echo '<div class="posted-on">';
				printf(
					/* translators: %s: publish date. */
					esc_html__( '%s', 'ksasacademic' ),
					$time_string // phpcs:ignore WordPress.Security.EscapeOutput
				);
			echo '</div>';
		echo '</div>';
	}
endif;
