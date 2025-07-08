<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">
</head>

<body <?php body_class(); ?>>
  <header id="site-header" class="header d-flex align-items-center justify-content-center">
    <div class="header__wrapper container row justify-content-between">

      <div class="col-3 col-md-2 px-0">
        <h1 class="header__logo">
          <?php echo get_custom_logo(); ?>
        </h1>
      </div>

      <div class="col-9 col-md-10 px-0">
        <?php wp_nav_menu(array("theme_location" => "navbar", "menu_class" => "main-menu")); ?>
        <div class="header__icons">
          <?php global $woocommerce; ?>
          <a class="your-class-name" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
            title="<?php _e('Cart View', 'woothemes'); ?>">
            <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'),
 $woocommerce->cart->cart_contents_count);?> -
            <?php echo $woocommerce->cart->get_cart_total(); ?>
          </a>
        </div>
      </div>

    </div>
  </header>

  <?php //get_template_part("template-parts/breadcrumb"); ?>