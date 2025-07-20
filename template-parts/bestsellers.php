<?php /* Template Name: Sekcja - Bestsellery */ ?>

<section class="bestsellers">

  <div class="bestsellers__wrapper">
    <div class="wrapper">
      <div class="bestsellers__content">

        <?php if(get_field("bestsellers_title_01")) { ?>
        <h2 class="bestsellers__header">
          <?php echo get_field("bestsellers_title_01"); ?>
        </h2>
        <?php } ?>

        <?php if(get_field("bestsellers_title_02")) { ?>
        <h3 class="bestsellers__subheader">
          <?php echo get_field("bestsellers_title_02"); ?>
        </h3>
        <?php } ?>

        <?php if(get_field("bestsellers_text")) { ?>
        <div class="bestsellers__text">
          <?php echo get_field("bestsellers_text"); ?>
        </div>
        <?php } ?>

      </div>
    </div>

    <div class="bestsellers__items bestsellers__slick slick-carousel">
      <?php
      $quantity = get_field("bestsellers_text");

      $args = array(
        'post_type' => 'product',
        'posts_per_page' => (int)$quantity,
        'tax_query' => array(
          array(
            'taxonomy' => 'product_visibility', // Does a meta query on product visibility
            'field' => 'name',
            'terms' => 'featured', // Makes sure we grab all products flagged as featured
            'operator' => 'IN',
          ),
        ),
      );

      $loop = new WP_Query( $args );
      $products = wc_get_products( $args );

      while ( $loop->have_posts() ) : $loop->the_post();
        echo wc_get_template('content-product.php', array());
      endwhile;
      wp_reset_query();
    ?>
    </div>

    <div class="bestsellers__link text-center">
      <a class="link" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">Wszystkie produkty</a>
    </div>
  </div>

</section>