<?php
/**
 * Plugin Name: ProSplice Core Functionality
 * Plugin URI: 
 * Description: This contains all this site's core functionality so that it is theme independent. Customized for www.example.dev
 * @package      ProSplice Core Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/prosplice-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/* This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

// Plugin Directory
define( 'CWS_DIR', dirname( __FILE__ ) );

// Post Types
include_once( CWS_DIR . '/lib/functions/post-types.php' );

// Taxonomies
include_once( CWS_DIR . '/lib/functions/taxonomies.php' );

// Special handling of taxonomy templates
// include_once( CWS_DIR . '/lib/functions/taxonomies-portfolio.php' );

// Metaboxes
//include_once( CWS_DIR . '/lib/functions/metaboxes.php' );

// Widgets
//include_once( CWS_DIR . '/lib/widgets/widget-social.php' );

// General
include_once( CWS_DIR . '/lib/functions/general.php' );

// Woo tweaks
// include_once( CWS_DIR . '/lib/functions/wootweaks.php' );

// Testimonials
include_once( CWS_DIR . '/lib/functions/testimonials.php' );
