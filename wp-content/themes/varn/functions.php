<?php
add_action( 'after_setup_theme', 'b2creative_setup' );
function b2creative_setup(){
  // Add Menu Support
  load_theme_textdomain( 'b2creative', get_template_directory() . '/languages' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  global $content_width;

  add_theme_support('menus');

  add_image_size('square_desktop', 180, 180, true);
  add_image_size('square_mobile', 500, 500, true);

  add_image_size('slider_desktop', 1368, 581, true);
  add_image_size('slider_tablet', 747, 417, true);

  add_image_size('media_desktop', 395, 257, true);
  add_image_size('media_tablet', 500, 325, true);

  add_image_size('news_desktop', 227, 176, true);

  add_theme_support( 'title-tag' );


  register_nav_menus(array( // Using array to specify more menus if needed
    'header-menu' => __('Header Menu', 'b2creative'), // Main Navigation
    'mobile-menu' => __('Mobile Menu', 'b2creative'), // Sidebar Navigation
    'footer-menu' => __('Footer Menu', 'b2creative'), // Sidebar Navigation
  ));
}


if (!isset($content_width)){
  $content_width = 1600;
}



$blank_includes = [
  /**
  * BC Extensions
  */


  'lib/custom/custom-query-controller.php',         // Control all queries

  'lib/custom/custom-set-images.php',               // Set responsive imageries

  'lib/acf/options.php',


];

//depicts where templates are found
foreach ($blank_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'b2creative'), $file), E_USER_ERROR);
  }

  require_once $filepath;
} unset($file, $filepath);


function loading_custom_scripts(){
  $currentTheme = wp_get_theme();

  // Theme's main CSS file.
   wp_enqueue_style( 'fontAwesome', '//use.fontawesome.com/releases/v5.2.0/css/all.css');
  wp_enqueue_style( 'Lato', '//fonts.googleapis.com/css?family=Lato:300,400,700,900' );
  wp_enqueue_style('boostrap.css', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
  wp_enqueue_style('main.css', get_template_directory_uri() . '/assets/css/style.css');

  wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css');



  //wp_enqueue_script( 'chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js');
  // HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  //wp_enqueue_script('inview', get_template_directory_uri() . '/assets/js/in-view.min.js',$currentTheme->get('Version'),false);

  wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',array('jquery'), '1.0.0', true);


  wp_enqueue_script('scripts',  get_template_directory_uri() . '/assets/js/scripts.js',array('jquery'), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'loading_custom_scripts');
