<?php
/**
 * KSAS Academic Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KSASAcademic
 */

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
	/**
	 * Sets up styles and scripts for this child theme
	 *
	 * Note that this function is hooked into the wp_enqueue_scripts
	 */
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	$theme        = wp_get_theme();
	wp_enqueue_style(
		$parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // if the parent theme code has a dependency, copy it to here.
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // this only works if you have Version in the style header.
	);
	wp_enqueue_style( 'aos', '//unpkg.com/aos@next/dist/aos.css', array(), '3.0.0', 'all' );
	wp_enqueue_script( 'aos', '//unpkg.com/aos@next/dist/aos.js', array( 'jquery' ), '3.0.0', true );
	wp_enqueue_script( 'aos-init', get_stylesheet_directory_uri() . '/js/aos-init.js', array(), '1.0.0', true );
}
/** Return entry meta information for posts */
require_once 'library/entry-meta.php';
require_once 'library/categories.php';

/** Return related posts by Category */
require_once 'library/related-posts.php';

/** Custom Breadcrumb menus */
require_once 'library/breadcrumbs.php';

add_filter(
	'excerpt_length',
	function( $length ) {
		return 30;
	}
);

/** Remove Disable/Clean Inline Styles from Parent Theme */
add_action( 'after_setup_theme', 'remove_parent_post_cleaner' );
function remove_parent_post_cleaner() {
	remove_filter( 'the_content', 'clean_post_content', 10, 2 );
}

/** Disable/Clean Inline Styles Specifically on Child Theme */
function child_theme_clean_post_content( $content ) {
	// Remove inline styling.
	// $content = preg_replace( '/(<[^>]+) style=".*?"/i', '$1', $content );
	$content = preg_replace( '/(<[span>]+) style=".*?"/i', '$1', $content );
	$content = preg_replace( '/font-family\:.+?;/i', '', $content );
	$content = preg_replace( '/color\:.+?;/i', '', $content );

	// Remove font tag.
	$content = preg_replace( '/<font[^>]+>/', '', $content );

	// Remove empty tags.
	$post_cleaners = array(
		'<p></p>'             => '',
		'<p> </p>'            => '',
		'<p>&nbsp;</p>'       => '',
		'<span></span>'       => '',
		'<span> </span>'      => '',
		'<span>&nbsp;</span>' => '',
		'<font>'              => '',
		'</font>'             => '',
	);
	$content       = strtr( $content, $post_cleaners );

	return $content;
}
add_filter( 'the_content', 'child_theme_clean_post_content', 10, 2 );
