<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Open+Sans:300,700|Roboto:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" />

  <title itemprop="name"><?php wp_title(''); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); ?>
</head>
<body <?php body_class('flex flex-column'); ?>>
  <nav role="navigation" class='mobile-menu block none-l'>
    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
  </nav>
  <div id="wrapper" class="flex flex-column move flex-fill">

    <header id="header" role="banner" class='overflow '>
      <div class='container pad-top-20 pad-bottom-20 overflow flex align-items'>
        <section id="branding" class='col-2-m no-padding '>
        <a href='/'><img class='fluid-img' src='<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png' alt='' /></a>
        </section>
        <nav id="menu" role="navigation" class='margin-left-auto none block-m'>
          <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
        </nav>
        <div class="block none-m no-padding margin-left-auto hamburger-wrapper">
          <div id="mobile-menu-button" class="hamburger"><span></span></div>
        </div>
        <div class='overlay'></div>
      </div>

    </header>
    <div id="container" class='clear pad-top-40 '>
      <div class=''>
