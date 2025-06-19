<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>

<body <?php body_class(); ?>>
  <header id="site-header" class="header d-flex align-items-center">
    <div class="header d-flex justify-content-between">
      <div class="row">

        <div class="col-3 col-md-2">
          <h1>
            <?php echo get_custom_logo(); ?>
          </h1>
        </div>

        <div class="col-9 col-md-10">
          <?php wp_nav_menu(array("theme_location" => "navbar", "menu_class" => "main-menu")); ?>
        </div>

      </div>
    </div>
  </header>
  
  <?php get_template_part("template-parts/breadcrumb"); ?>