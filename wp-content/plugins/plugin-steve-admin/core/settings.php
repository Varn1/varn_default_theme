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



/**
* Remove Upgrade Notice
*
* Stops WP Admin from displaying prompt to update WordPress core, so this can be handled by us via status dashboard.
*/

function wphidenag() {
  remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','wphidenag');




// Load any external files you have here

/*------------------------------------*\
Theme Support
\*------------------------------------*/

if (!isset($content_width)){
  $content_width = 1600;
}

/*------------------------------------*\
Functions
\*------------------------------------*/


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
  $args['container'] = false;
  return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var){
  return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist){
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
// Add body class
function add_slug_to_body_class($classes) {
  global $post;

  // Add page slug to body class, love this - Credit: Starkers Wordpress Theme
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }

  // add sidebar classes
  $type = get_post_type();

  return $classes;
}

/**
 * Disable Emoji Mess
 */





// Remove Actions
remove_action('welcome_panel', 'wp_welcome_panel');
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// REMOVE EMOJI ICONS
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
add_filter( 'emoji_svg_url', '__return_false' );

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter( 'jpeg_quality', create_function( '', 'return 95;' ) );

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );
