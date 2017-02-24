<?php
/**
 * Post Type Taxonomies
 *
 * This file registers any custom post type taxonomies needed
 *
 * @package      ProSplice Core Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/prosplice-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {
	$labels = array(
		"name" => __( 'Portfolio Categories', '' ),
		"singular_name" => __( 'Portfolio Category', '' ),
		);

	$args = array(
		"label" => __( 'Portfolio Categories', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Portfolio Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'portfolio_category', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "portfolio_category", array( "portfolio" ), $args );

	$labels = array(
		"name" => __( 'Portfolio Tags', '' ),
		"singular_name" => __( 'Portfolio Tag', '' ),
		);

	$args = array(
		"label" => __( 'Portfolio Tags', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => false,
		"label" => "Portfolio Tags",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'portfolio_tag', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "portfolio_tag", array( "portfolio" ), $args );

// End cptui_register_my_taxes()
}