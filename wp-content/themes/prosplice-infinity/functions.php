<?php
/**
 *  ProSplice Infinity.
 *
 * This file adds functions to the  ProSplice Infinity Child Theme.
 *
 * @package ProSplice Infinity
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    Theme URI: http://github.com/capwebsolutions/prosplice/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Include customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add image upload and color select to theme customizer. 
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Add the required WooCommerce functions.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce custom CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Include notice to install Genesis Connect for WooCommerce.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'prosplice_infinity_localization_setup' );
function prosplice_infinity_localization_setup(){
	load_child_theme_textdomain( 'prosplice-infinity', get_stylesheet_directory() . '/languages' );
}

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'ProSplice Infinity' );
define( 'CHILD_THEME_URL', 'http://github.com/capwebsolutions/prosplice/' );
define( 'CHILD_THEME_VERSION', '1.0.3' );

// Enqueue scripts and styles.
add_action( 'wp_enqueue_scripts', 'prosplice_infinity_enqueue_scripts_styles' );
function prosplice_infinity_enqueue_scripts_styles() {

	wp_enqueue_style( 'prosplice-infinity-fonts', '//fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i,700|Raleway:700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'prosplice-infinity-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'prosplice-infinity-match-height', get_stylesheet_directory_uri() . '/js/match-height.js', array( 'jquery' ), '0.5.2', true );
	wp_enqueue_script( 'prosplice-infinity-global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), '1.0.0', true );

// Use these for phone icon in top nav
	wp_enqueue_style( 'material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), null );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'infinity-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script( 'infinity-responsive-menu', 'genesis_responsive_menu', infinity_responsive_menu_settings() );

}

// Define our responsive menu settings.
function infinity_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'prosplice-infinity' ),
		'menuIconClass'    => 'ionicons-before ion-ios-drag',
		'subMenu'          => __( 'Submenu', 'prosplice-infinity' ),
		'subMenuIconClass' => 'ionicons-before ion-chevron-down',
		'menuClasses'      => array(
			'others' => array(
				'.nav-primary',
			),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 400,
	'height'          => 130,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add image sizes.
add_image_size( 'mini-thumbnail', 75, 75, TRUE );
add_image_size( 'team-member', 600, 600, TRUE );
add_image_size( 'team-member-small', 300, 300, TRUE );


// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove header right widget area.
unregister_sidebar( 'header-right' );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Remove navigation meta box.
add_action( 'genesis_theme_settings_metaboxes', 'infinity_remove_genesis_metaboxes' );
function infinity_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}

// Remove skip link for primary navigation.
add_filter( 'genesis_skip_links_output', 'infinity_skip_links_output' );
function infinity_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	return $links;

}

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Header Menu', 'prosplice-infinity' ), 'secondary' => __( 'Footer Menu', 'prosplice-infinity' ) ) );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );


// Reduce secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'infinity_secondary_menu_args' );
function infinity_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Setup widget counts.
function infinity_count_widgets( $id ) {

	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

// Determine the widget area class.
function infinity_widget_area_class( $id ) {

	$count = infinity_count_widgets( $id );

	$class = '';

	if ( $count == 1 ) {
		$class .= ' widget-full';
	} elseif ( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif ( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif ( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 1 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 2 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 3 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 4 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 5 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 6 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Front Page 7', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 7 section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-7a',
	'name'        => __( 'Front Page 7a', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 7a section.', 'prosplice-infinity' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-8',
	'name'        => __( 'Front Page 8', 'prosplice-infinity' ),
	'description' => __( 'This is the front page 8 section.', 'prosplice-infinity' ),
) );


function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}

/**
 * Portfolio Template for Taxonomies
 * 
 * This tells WordPress “if we’re on either the portfolio category or portfolio tag taxonomies, use the portfolio archive template file”.
 * Ref: http://www.billerickson.net/genesis-portfolio/
 *
 */
function be_portfolio_template( $template ) {
  if( is_tax( array( 'portfolio_category', 'portfolio_tag' ) ) || is_post_type( 'portfolio' ) )
    $template = get_query_template( 'archive-portfolio' );
  return $template;
}
add_filter( 'template_include', 'be_portfolio_template' );

/**
 * Add a phone icon with phone number to primary & secondary nav
 * 
 */
add_filter( 'wp_nav_menu_items', 'cws_phone_info', 10, 2 );
function cws_phone_info( $menu, $args ) {

	$args = (array)$args;
	$phone = "+18452352115";
	$phone_pretty ="(845)235-2115";

	$menu_right_local_start = '<div itemscope itemtype="http://schema.org/LocalBusiness">';
	$menu_right_local_start .= '<span itemprop="telephone">';
	$menu_right_local_start .= '<a href="tel:' . $phone . '">';
	$menu_right_local_end = $phone_pretty . '</a>';
	$menu_right_local_end .= '</span></div>';

	$menu_right  = '<li class="phone menu-item last">' . $menu_right_local_start . '<i class="material-icons">phone_in_talk</i>' . $menu_right_local_end . '</li>';
	return $menu . $menu_right;

}
	// $menu_right  = '<li class="phone menu-item last"><a href="tel:' . strip_tags( $phone ) . '">' . '<i class="material-icons">phone_in_talk</i>' . strip_tags( $phone ) . '</a></li>';
	// return $menu . $menu_right;

// <div itemscope itemtype="http://schema.org/LocalBusiness">
//   <h1 itemprop="name">Beach Bunny Swimwear</h1>
//   Phone: 
//     <span itemprop="telephone">
//       <a href="tel:+18506484200">
//          850-648-4200
//       </a>
//     </span>
// </div>

