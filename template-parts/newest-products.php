<?php /* Template Name: Sekcja - Ostatnio dodane produkty */ ?>

<section class="newest-products">

  <div class="newest-products__wrapper">

    <?php if(get_field("newest_products_bg")): ?>
    <img class="newest-products__bg" src="<?php echo get_field("newest_products_bg"); ?>"
      alt="Ostatnio dodane produkty" />
    <?php endif; ?>

    <div class="wrapper">
      <div class="newest-products__content">

        <?php if(get_field("newest_products_title_01")): ?>
        <h2 class="newest-products__header">
          <?php echo get_field("newest_products_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("newest_products_title_02")): ?>
        <h3 class="newest-products__subheader">
          <?php echo get_field("newest_products_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("newest_products_text")): ?>
        <div class="newest-products__text">
          <?php echo get_field("newest_products_text"); ?>
        </div>
        <?php endif; ?>

      </div>
    </div>

    <div class="newest-products__items newest-products__slick slick-carousel d-flex row">
      <?php
      $quantity = get_field("newest_products_quantity");
   
      $args = array(
        'post_type' => 'product',
        'posts_per_page' => (int)$quantity,
      );

      $loop = new WP_Query( $args );
      $products = wc_get_products( $args );

      while ( $loop->have_posts() ) : $loop->the_post();
        echo wc_get_template('content-product.php');
      endwhile;
      wp_reset_query();
    ?>
    </div>

    <div class="newest-products__link text-center">
      <a class="link" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">Wszystkie produkty</a>
    </div>
  </div>

</section>