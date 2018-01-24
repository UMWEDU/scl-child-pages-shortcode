<?php
/*
	Plugin Name: Steph's Tiny List Child Pages Plugin
	Plugin URI: http://sillybean.net/2010/06/listing-child-pages-with-a-shortcode/
	Description: Lets you list child pages using a shortcode. Also displays child page list by default on empty parent pages.
	Author: Stephanie Leary
	Version: 1.0
	Author URI: http://sillybean.net/
	License: GPL v2 or later
*/ 

// note depth = 0 (no hierarchy)
function scl_child_pages_shortcode( $atts=array() ) {
	$id = get_the_ID();
	$atts = shortcode_atts( array( 'child_of' => $id, 'depth' => 0 ), $atts );
	$atts['title_li'] = null;
	$atts['echo'] = 0;

	return '<ul class="childpages">' . wp_list_pages( $args ) . '</ul>';
}
add_shortcode( 'child-pages', 'scl_child_pages_shortcode' );
add_shortcode( 'children', 'scl_child_pages_shortcode' );
add_shortcode( 'subpages', 'scl_child_pages_shortcode' );

// note no depth argument (full hierarchy)
function scl_append_child_pages( $content ) {
	$children = '';
	if ( is_page() && ( empty($content) ) ) {
		$id = get_the_ID();
		$args = array( 'echo' => 0, 'title_li' => null, 'child_of' => $id );
		$children = '<ul class="childpages">' . wp_list_pages( $args ) . '</ul>';
	}
	return $content.$children;
}
add_filter( 'the_content', 'scl_append_child_pages' );
