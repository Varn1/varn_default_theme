<?php
//
// //set a range of images sources depending what you need
// function get_big_header() {
//   $postID = get_the_id();
//   $post_thumbnail_id = get_post_thumbnail_id($postID);
//
//   $small =   wp_get_attachment_image_src($post_thumbnail_id,'small', true);
//   $medium =  wp_get_attachment_image_src($post_thumbnail_id,'medium', true);
//   $large =   wp_get_attachment_image_src($post_thumbnail_id,'large', true);
//   $alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true);
//   $title = get_the_title($postID);
//   $altText = $alt ? $alt : $title;
//
//   return  '<img class="fluid-img" src="' . $large[0]  . '"  srcset="' .  $small[0] . ' 680w, ' . $medium[0] . ' 900w, ' .  $large[0] . ' 1200w"  alt="' .  $altText  . '" />';
// }
//
// function get_big_header_background() {
//   $postID = get_the_id();
//   $post_thumbnail_id = get_post_thumbnail_id($postID);
//   $large =   wp_get_attachment_image_src($post_thumbnail_id,'large', true);
//
//   return  'style="background:url(' .  $large[0] .'); background-size: cover; background-position: center center;"';
// }
//
//
// function get_big_header_background_blog($postID) {
//   $post_thumbnail_id = get_post_thumbnail_id($postID);
//   $large =   wp_get_attachment_image_src($post_thumbnail_id,'large', true);
//
//   return  'style="background:url(' .  $large[0] .'); background-size: cover;"';
// }
