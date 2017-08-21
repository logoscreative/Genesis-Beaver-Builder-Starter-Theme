<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis + Beaver Builder: Starter Theme' );
define( 'CHILD_THEME_URL', 'https://evermo.re' );
define( 'CHILD_THEME_VERSION', '0.1' );

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links', 'rems' ) );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Remove support for 3-column footer widgets
remove_theme_support( 'genesis-footer-widgets', 1 );

// Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Remove the header right widget area
unregister_sidebar( 'header-right' );

// Remove default sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

// Unregister layout settings
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// De-register stylesheet
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

// Deregister WP 4.2 Emoji support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'gbb_enqueue_scripts_styles' );
function gbb_enqueue_scripts_styles() {

	// Because who wants Superfish?
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );

	$version = defined( 'CHILD_THEME_VERSION' ) && CHILD_THEME_VERSION ? CHILD_THEME_VERSION : PARENT_THEME_VERSION;
	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	wp_enqueue_style( $handle, get_stylesheet_directory_uri() . '/style.min.css', false, $version);

}