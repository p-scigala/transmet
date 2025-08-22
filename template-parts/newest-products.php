<?php /* Template Name: Sekcja - Ostatnio dodane produkty */ ?>

<section class="newest-products" id="ostatnio-dodane">
  <div class="newest-products__wrapper">

    <?php if(get_field("newest_products_bg")): ?>
    <img class="newest-products__bg" src="<?php echo get_field("newest_products_bg"); ?>"
      alt="Ostatnio dodane produkty" />
    <?php endif; ?>

    <div class="wrapper">
      <div class="newest-products__content">

        <?php if(get_field("newest_products_title_01")): ?>
        <h2 class="newest-products__heading heading animate">
          <?php echo get_field("newest_products_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("newest_products_title_02")): ?>
        <h3 class="newest-products__subheading subheading animate delay-1">
          <?php echo get_field("newest_products_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("newest_products_text")): ?>
        <div class="newest-products__description description animate delay-2">
          <?php echo get_field("newest_products_text"); ?>
        </div>
        <?php endif; ?>

      </div>
    </div>

    <div class="wrapper">
      <div class="newest-products__items slider slider--with-bar slider--with-buttons animate delay-3">
        <?php
      $quantity = get_field("newest_products_quantity");
   
      $args = array(
        'post_type' => 'product',
        'posts_per_page' => (int)$quantity,
      );

      $loop = new WP_Query($args);
      $products = wc_get_products($args);

      while ($loop->have_posts()): $loop->the_post();
        echo wc_get_template('content-product.php', array(
          'category' => 'newest-products',
        ));
      endwhile;
      wp_reset_query();
    ?>
      </div>
    </div>

  </div>
</section>