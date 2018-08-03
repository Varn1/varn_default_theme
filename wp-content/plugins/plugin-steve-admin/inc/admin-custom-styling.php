<?php
/*------------------------------------
Custom admin login logo
-------------------------------------*/
function custom_login_logo() {
echo '<link rel="stylesheet" type="text/css" href="' . plugins_url() . '/plugin-steve-admin/css/login.css" />';
}
add_action('login_head', 'custom_login_logo');


/*------------------------------------
When logged in admin area - set the menu colours
-------------------------------------*/
function custom_admin_css() {
echo '<link rel="stylesheet" type="text/css" href="' . plugins_url() . '/plugin-steve-admin/css/admin.css" />';
}

add_action('admin_head', 'custom_admin_css');


/*------------------------------------
Changing the logo link from wordpress.org to your site
-------------------------------------*/
function sf_login_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'sf_login_url' );

/*------------------------------------
Changing the alt text on the logo to show your site name
-------------------------------------*/
function sf_login_title() {
  return get_option( 'blogname' );
}
add_filter( 'login_headertitle', 'sf_login_title' );

/*------------------------------------
Alter details when logged in
-------------------------------------*/
function remove_footer_admin () {
    echo "Designed and developed by <a href='http://b2creative.co.uk/'>b2creative</a>";
}

add_filter('admin_footer_text', 'remove_footer_admin');
