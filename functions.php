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

// Remove navigation menus
remove_theme_support( 'genesis-menus' );

// Unregister sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar-alt' );

// Remove default sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

// Set and unregister layout settings
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove breadcrumbs
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');

// Remove customizer panels
add_action( 'customize_register', 'gbb_remove_customizer_sections', 20 );

function gbb_remove_customizer_sections() {
	global $wp_customize;
	$wp_customize->remove_section( 'genesis_breadcrumbs' );
	$wp_customize->remove_section( 'genesis_comments' );
	$wp_customize->remove_section( 'genesis_archives' );
}

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

// Clear out meta boxes

add_action( 'genesis_admin_before_metaboxes', 'gbb_remove_unwanted_genesis_metaboxes' );

function gbb_remove_unwanted_genesis_metaboxes() {
	remove_meta_box( 'genesis-theme-settings-version', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-feeds', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-layout', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-breadcrumb', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-comments', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-posts', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-blogpage', 'toplevel_page_genesis', 'main' );
	//remove_meta_box( 'genesis-theme-settings-scripts', 'toplevel_page_genesis', 'main' );
	remove_meta_box( 'genesis-theme-settings-header', 'toplevel_page_genesis', 'main' );
}