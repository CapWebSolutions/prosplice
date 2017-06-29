<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      ProSplice Core Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/prosplice-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name"                  => __( 'Portfolio', '' ),
		"singular_name"         => __( 'Portfolio', '' ),
		"menu_name"             => __( 'Portfolio', '' ),
		"description"           => "Project Portfolio",
		"name_admin_bar"        => _x( 'Portfolio Item', '' ),
		"all_items"             => __( 'All Portfolio Items', '' ),
		"add_new"               => __( 'Add New Portfolio', '' ),
		"add_new_item"          => __( 'Add New Portfolio Item', '' ),
		"edit_item"             => __( 'Edit Portfolio Item', '' ),
		"new_item"              => __( 'Add New Portfolio Item', '' ),
		"view_item"             => __( 'View Portfolio Item', '' ),
		"search_items"          => __( 'Seach Portfolio', '' ),
		"not_found"             => __( 'No Portfolio Items Found', '' ),
		"not_found_in_trash"    => __( 'No Portfolio Items Found In trash', '' ),
		"parent_item_colon"     => __( 'Portfolio Parent Item', '' ),
		"featured_image"        => __( 'Portfolio Featured Image', '' ),
		"set_featured_image"    => __( 'Set Portfolio Featured Image', '' ),
		"remove_featured_image" => __( 'Remove Portfolio Featured Image', '' ),
		"use_featured_image"    => __( 'Use Portfolio Featured Image', '' ),
		"archives"              => __( 'Portfolio Archives', '' ),
		"insert_into_item"      => __( 'Insert into Portfolio', '' ),
		"uploaded_to_this_item" => __( 'Uploaded to Portfolio', '' ),
		"filter_items_list"     => __( 'Filter Portfolio List', '' ),
		"items_list_navigation" => __( 'Portfolio list navigation', '' ),
		"items_list"            => __( 'Portfolio Items List', '' ),
		"parent_item_colon"     => __( 'Portfolio Parent Item:', '' ),
		);

	$supports = array(
		'title',
		'editor',
		'excerpt',
		'thumbnail',
		'author',
		'custom-fields',
		'revisions',
	);

	$args = array(
		"labels"              => $labels,
		"supports"            => $supports,
		"public"              => true,
		"publicly_queryable"  => true,
		"show_ui"             => true,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"has_archive"         => true,
		"show_in_menu"        => true,
		"exclude_from_search" => false,
		"capability_type"     => "post",
		"map_meta_cap"        => true,
		"hierarchical"        => false,
		"rewrite"             => array( "slug" => "portfolio", ),
		"query_var"           => true,
		'menu_icon'           => 'dashicons-portfolio',

	);
	register_post_type( "portfolio", $args );

// End of cptui_register_my_cpts()
}
