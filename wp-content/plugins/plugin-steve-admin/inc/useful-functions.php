<?php
/*------------------------------------
Useful Functions
-------------------------------------*/
// Debug info
function debug($data) {
  //if(WP_ENV == 'local') {
  echo "<pre>";
  print_r($data);
  echo "</pre>";
  //  }
}


function ShortenText($text, $characters) { // Function name ShortenText
  $chars_limit = $characters; // Character length
  $chars_text = strlen($text);
  $text = $text." ";
  $text = substr($text,0,$chars_limit);
  $text = substr($text,0,strrpos($text,' '));

  if ($chars_text > $chars_limit)
     { $text = $text."..."; } // Ellipsis
     return $text;
}


$email = 'mymail@mail.com';
//echo 'You can contact me at ' . antispambot( $email ) . ' any time'.


// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );
