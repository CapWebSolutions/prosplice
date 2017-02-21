<?php
/**
 * WooCommerce Tweaks 
 *
 * This file includes any custom WooCommerce tweaks
 *
 * @package      ProSplice Core Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/prosplice-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
/*
 * wc_remove_related_products
 * 
 * Clear the query arguments for related products so none show.
 * Add this code to your theme functions.php file.  
 */
function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10); 

