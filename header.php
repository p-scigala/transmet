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
  <header id="site-header" class="header">
    <div class="wrapper">
      <div class="header__wrapper">

        <h1 class="header__logo">
          <?php echo get_custom_logo(); ?>
        </h1>

        <div class="header__nav">
          <div class="header__nav-inner">

            <div class="header__search">
              <label for="fibosearch" class="screen-reader-text">
                <?php _e('Search for:', 'woothemes'); ?>
              </label>
              <?php echo do_shortcode('[fibosearch]'); ?>
            </div>

            <?php wp_nav_menu(array(
                "theme_location" => "navbar", 
                "menu_class" => "main-menu",
                "walker" => new Custom_Nav_Walker()
            )); ?>

            <div class="header__icons">
              <?php if (is_user_logged_in()) : ?>
              <a class="header__account"
                href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                title="<?php _e('My Account', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/icon-avatar.svg"
                  alt="<?php _e('My Account', 'woothemes'); ?>" class="header__account-icon" />
                <span class="screen-reader-text">
                  <?php _e('My Account', 'woothemes'); ?>
                </span>
              </a>
              <?php else : ?>
              <a class="header__account"
                href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                title="<?php _e('Login', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/icon-avatar.svg"
                  alt="<?php _e('Login', 'woothemes'); ?>" class="header__account-icon" />
                <span class="screen-reader-text">
                  <?php _e('Login', 'woothemes'); ?>
                </span>
              </a>
              <?php endif; ?>

              <?php global $woocommerce; ?>
              <a class="header__cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
                title="<?php _e('Cart View', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/icon-cart.svg"
                  alt="<?php _e('Cart', 'woothemes'); ?>" class="header__cart-icon" />
                <span class="header__cart-count screen-reader-text">
                  <?php _e('Items in your cart', 'woothemes'); ?>
                </span>
                <span class="header__cart-count-number">
                  <?php echo $woocommerce->cart->cart_contents_count; ?>
                </span>
              </a>
            </div>
          </div>
        </div>

        <button class="header__menu-toggle"></button>

      </div>
    </div>
  </header>