<?php /* Template Name: Sekcja - Kategorie */ ?>

<section class="categories">

  <div class="categories__wrapper">
    <div class="categories__content">

      <?php if(get_field("title_01")) { ?>
      <h2 class="categories__header">
        <?php echo get_field("title_01"); ?>
      </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
      <h3 class="categories__subheader">
        <?php echo get_field("title_02"); ?>
      </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
      <div class="categories__text">
        <?php echo get_field("text"); ?>
      </div>
      <?php } ?>

    </div>

    <div class="categories__items d-flex row">
      <?php
      $args = array(
        'taxonomy'     => 'product_cat',
        'orderby'      => 'name',
        'show_count'   => 0,
        'pad_counts'   => 0,
        'hierarchical' => 1,
        'title_li'     => '',
        'hide_empty'   => 0
      );

      $all_categories = get_categories($args);
      foreach ($all_categories as $cat) {
        if($cat -> category_parent === 0) {
          $category_id = $cat->term_id;
          $thumbnail_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
          $image = wp_get_attachment_url($thumbnail_id);
          ?>

      <div class="categories__item">
        <a class="categories__link btn btn--panel" href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>">
          <div class="btn__inner">
            <div class="categories__item-img">
              <img src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>" />
              <h4><?php echo $cat->name; ?></h4>
              <span>Sprawdź</span>
            </div>
          </div>
        </a>
      </div>

      <?php
        }       
      }
    ?>
    </div>
  </div>

</section>