<?php
/**
 * Category and tag meta information for posts
 *
 * @package KSASAcademic
 * @since KSASAcademic 1.0.0
 */

if ( ! function_exists( 'ksasacademic_category_meta' ) ) :
	function ksasacademic_category_meta() {
		echo '<div class="post-taxonomies button hollow tiny">';
		$categories = get_the_category();
		$separator = ' | ';
		$output = '';
		if ( ! empty( $categories ) ) {
			echo '<span class="cat-links">';
			foreach( $categories as $category ) {
					$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			}
			echo trim( $output, $separator );
			echo '</span>';
		}
		echo '</div>';
	}
	endif;
