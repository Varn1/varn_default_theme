<?php
/*
Plugin Name: Varn - Services plugin
Plugin URI: https://varn.co.uk/
Description: Create and manage services - this plugin creates a custom post type and acf fields
Version: 1.0
Author: Varn
Author URI: https://varn.co.uk/
*/

// Register Custom Post Type
function custom_post_type_services() {

  $labels = array(
    'name'                  => _x( 'Services', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Services', 'text_domain' ),
    'name_admin_bar'        => __( 'Services', 'text_domain' ),
    'archives'              => __( 'Item Archives', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All Services', 'text_domain' ),
    'add_new_item'          => __( 'Add New Service', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Service', 'text_domain' ),
    'edit_item'             => __( 'Edit Service', 'text_domain' ),
    'update_item'           => __( 'Update Service', 'text_domain' ),
    'view_item'             => __( 'View Service', 'text_domain' ),
    'view_items'            => __( 'View Services', 'text_domain' ),
    'search_items'          => __( 'Search Item', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                  => 'services',
    'with_front'            => false,
  );

  $args = array(
    'label'                 => __( 'Service', 'text_domain' ),
    'description'           => __( 'Range of services', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'            => array('service_types'),
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'rewrite'               => $rewrite,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'services', $args );

}

add_action( 'init', 'custom_post_type_services', 0 );

require_once('acf-fields.php');

// Register Custom Taxonomy
function custom_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Service Types', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Service Type', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Service Types', 'text_domain' ),
    'all_items'                  => __( 'All Items', 'text_domain' ),
    'parent_item'                => __( 'Parent Item', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
    'new_item_name'              => __( 'New Item Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Item', 'text_domain' ),
    'edit_item'                  => __( 'Edit Item', 'text_domain' ),
    'update_item'                => __( 'Update Item', 'text_domain' ),
    'view_item'                  => __( 'View Item', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Items', 'text_domain' ),
    'search_items'               => __( 'Search Items', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No items', 'text_domain' ),
    'items_list'                 => __( 'Items list', 'text_domain' ),
    'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'public' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'services', 'with_front' => false ),

  );
  register_taxonomy( 'service_types', array( 'services' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );


function generate_taxonomy_rewrite_rules( $wp_rewrite ) {
  $rules = array();
  $post_types = get_post_types( array( 'name' => 'services', 'public' => true, '_builtin' => false ), 'objects' );
  $taxonomies = get_taxonomies( array( 'name' => 'service_types', 'public' => true, '_builtin' => false ), 'objects' );

  foreach ( $post_types as $post_type ) {
    $post_type_name = $post_type->name; // 'developer'
    $post_type_slug = $post_type->rewrite['slug']; // 'developers'

    foreach ( $taxonomies as $taxonomy ) {
      if ( $taxonomy->object_type[0] == $post_type_name ) {
        $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
        foreach ( $terms as $term ) {
          $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
        }
      }
    }
  }
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');



add_filter('single_template', function($original){
  global $post;
  $post_type = $post->post_type;
  $base_name = '/templates/single-' . $post_type .'.php';
  $template = locate_template($base_name);
  if ($template && ! empty($template)) return $template;
  return $original;
});

add_filter('archive_template', function($original){
  global $post;
  $post_type = $post->post_type;
  $base_name = '/templates/archive-' . $post_type .'.php';
  $template = locate_template($base_name);
  if ($template && ! empty($template)) return $template;
  return $original;
});

// add_filter('taxonomy_template', function($original){
//   global $post;
//   $post_type = $post->post_type;
//   $base_name = '/templates/taxonomy-' . $post_type .'.php';
//   $template = locate_template($base_name);
//   if ($template && ! empty($template)) return $template;
//   return $original;
// });


?>
