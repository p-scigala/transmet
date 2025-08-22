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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
</head>

<body <?php body_class(); ?>>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/head-script.js"></script>

  <header id="site-header" class="header">

    <div class="header__top">
      <div class="wrapper">
        <?php wp_nav_menu(array(
            "theme_location" => "topbar", 
            "menu_class" => "top-menu",
        )); ?>

        <div class="header__top-contact">

          <?php if(get_field("options_phone", "option")): ?>
          <a class="link--icon" href="tel:<?php echo get_field("options_phone", "option"); ?>">
            <?php include (get_template_directory() . '/assets/imgs/icons/tel.svg'); ?>
            <span><?php echo get_field("options_phone", "option"); ?></span>
          </a>
          <?php endif; ?>

          <?php if(get_field("options_email_1", "option")): ?>
          <a class="link--icon" href="mailto:<?php echo get_field("options_email_1", "option"); ?>">
            <?php include (get_template_directory() . '/assets/imgs/icons/mail.svg'); ?>
            <span><?php echo get_field("options_email_1", "option"); ?></span>
          </a>
          <?php endif; ?>

        </div>
      </div>

    </div>

    <?php if(have_rows('header_info_repeater', 'option')):?>
    <div class="header__middle">
      <div class="wrapper">
        <?php while(have_rows('header_info_repeater', 'option')): the_row(); ?>
        <span class="header__info-item">
          <img src="<?php echo get_sub_field('header_info_img'); ?>"
            alt="<?php echo get_sub_field("header_info_text"); ?>" />
          <?php echo get_sub_field("header_info_text"); ?>
        </span>
        <?php endwhile;?>
      </div>
    </div>
    <?php endif;?>

    <div class="header__bottom">
      <div class="wrapper">

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
                title="<?php _e('Moje konto', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/icons/user.svg"
                  alt="<?php _e('Moje konto', 'woothemes'); ?>" class="header__account-icon" />
                <span class="screen-reader-text">
                  <?php _e('Moje konto', 'woothemes'); ?>
                </span>
              </a>
              <?php else : ?>
              <a class="header__account"
                href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                title="<?php _e('Logowanie', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/icons/user.svg"
                  alt="<?php _e('Logowanie', 'woothemes'); ?>" class="header__account-icon" />
                <span class="screen-reader-text">
                  <?php _e('Logowanie', 'woothemes'); ?>
                </span>
              </a>
              <?php endif; ?>

              <?php global $woocommerce; ?>
              <a class="header__cart" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
                title="<?php _e('Koszyk', 'woothemes'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/icons/cart.svg"
                  alt="<?php _e('Koszyk', 'woothemes'); ?>" class="header__cart-icon" />
                <span class="header__cart-count screen-reader-text">
                  <?php _e('Liczba produktów w koszyku', 'woothemes'); ?>
                </span>
                <span class="header__cart-count-number">
                  <?php echo $woocommerce->cart->cart_contents_count; ?>
                </span>
              </a>
            </div>
          </div>
        </div>

        <button class="header__menu-toggle"><span></span></button>

        <a href="/koszyk" class="back-to-cart">Powrót</a>

        <a href="/koszyk" class="back-to-cart">Powrót</a>

      </div>
    </div>
  </header>