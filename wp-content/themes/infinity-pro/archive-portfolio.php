<?php
/**
 * Portfolio Archive
 *
 */

/**
 * Display as Columns
 *
 */
function be_portfolio_post_class( $classes ) {
	
	global $wp_query;
	if( !$wp_query->is_main_query() ) 
		return $classes;

	// Archives get 3 column display and single portfolio gets full content area - 1 col
	$columns = 1;	
	if ( is_archive() ) $columns = 3;
	
	$column_classes = array( '', '', 'one-half', 'one-third', 'one-fourth', 'one-fifth', 'one-sixth' );
	$classes[] = $column_classes[$columns];
	if( 0 == $wp_query->current_post % $columns )
		$classes[] = 'first';
		
	return $classes;
}
add_filter( 'post_class', 'be_portfolio_post_class' );

// Remove items from loop
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

/**
 * Add Portfolio Image
 *
 */
function be_portfolio_image() {

	// Archives get medium image and single port gets large image
	$my_size = 'medium';
	if ( !is_archive() ) $my_size = 'large';
	echo wpautop( '<a href="' . get_permalink() . '">' . genesis_get_image( array( 'size' => $my_size ) ). '</a>' );
}

add_action( 'genesis_entry_content', 'be_portfolio_image' );
add_filter( 'genesis_pre_get_option_content_archive_thumbnail', '__return_false' );

if ( is_archive() ) {

	// Move Title below Image
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_open', 5 );
	add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_close', 15 );
	add_action( 'genesis_entry_footer', 'genesis_do_post_title' );

} Else {

	add_action( 'genesis_entry_content', 'genesis_do_post_content' );
	add_action( 'genesis_post_content', 'genesis_do_post_content' );

}
genesis();