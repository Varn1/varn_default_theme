<?php
/**
* Admin Customisation
*
* functions and tweaks to customise the WP Admin area *
*/


/**
* Remove The Ability to Edit Plugins via Edit screen
*/
if( !defined( 'DISALLOW_FILE_EDIT' ) || DISALLOW_FILE_EDIT == false )
define( 'DISALLOW_FILE_EDIT', true );


/**
* Remove The Theme Editor
*/
function remove_editor() {
  $page = remove_submenu_page( 'themes.php', 'theme-editor.php' );
}
add_action( 'admin_init', 'remove_editor' );


/**
* De-regsiter WP Core Widgets
*
* Removes unwanted/unused WP Core Widgets
*/

//
function bc_unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'bc_unregister_default_wp_widgets', 1);

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

/**
* Remove Upgrade Notice
*
* Stops WP Admin from displaying prompt to update WordPress core, so this can be handled by us via status dashboard.
*/

function wphidenag() {
  remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','wphidenag');


/*
* Enables SVG uploading in the WP upload option
*/
function bc_mime_types( $mimes = array() ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'bc_mime_types' );


/*
* Fixes display of svg images when selected as featured image
*/
function bc_fix_svg() {
  echo '<style type="text/css">
  .attachment-post-thumbnail, .thumbnail img {
    width: 100% !important;
    height: auto !important;
  }
  </style>';
}
add_action('admin_head', 'bc_fix_svg');


// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');


/*
* Remove comments sitewide
*/
// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');
