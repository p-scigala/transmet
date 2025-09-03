<?php /* Template Name: Sekcja - Bestsellery */ ?>

<?php if( $args['id']) $id = $args['id']; ?>

<section class="bestsellers" id="<?php echo esc_attr( $id ); ?>">

  <div class="bestsellers__wrapper">
    <div class="wrapper">
      <div class="bestsellers__content">

        <?php if(get_field("bestsellers_title_01")): ?>
        <h2 class="bestsellers__heading heading animate">
          <?php echo get_field("bestsellers_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if($args['heading']): ?>
        <h2 class="bestsellers__heading heading animate">
          <?php echo $args['heading']; ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("bestsellers_title_02")): ?>
        <h3 class="bestsellers__subheading subheading animate delay-1">
          <?php echo get_field("bestsellers_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("bestsellers_text")): ?>
        <div class="bestsellers__description description animate delay-2">
          <?php echo get_field("bestsellers_text"); ?>
        </div>
        <?php endif; ?>

      </div>

      <div class="bestsellers__items slider slider--with-bar slider--with-buttons animate delay-3">
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
    </div>
  </div>

</section>