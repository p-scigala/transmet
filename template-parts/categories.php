<?php /* Template Name: Sekcja - Kategorie */ ?>

<section class="categories">

  <div class="wrapper">
    <div class="categories__wrapper">
      <div class="categories__content">

        <?php if(get_field("categories_title_01")) { ?>
        <h2 class="categories__header">
          <?php echo get_field("categories_title_01"); ?>
        </h2>
        <?php } ?>

        <?php if(get_field("categories_title_02")) { ?>
        <h3 class="categories__subheader">
          <?php echo get_field("categories_title_02"); ?>
        </h3>
        <?php } ?>

        <?php if(get_field("categories_text")) { ?>
        <div class="categories__text">
          <?php echo get_field("categories_text"); ?>
        </div>
        <?php } ?>

      </div>

      <div class="categories__items categories__slick slick-carousel">
        <?php
      $args = array(
        "taxonomy"     => "product_cat",
        "orderby"      => "name",
        "show_count"   => 0,
        "pad_counts"   => 0,
        "hierarchical" => 1,
        "title_li"     => "",
        "hide_empty"   => 0
      );

      $all_categories = get_categories($args);
      foreach ($all_categories as $cat) {
        if($cat -> category_parent === 0) {
          $category_id = $cat->term_id;
          $thumbnail_id = get_woocommerce_term_meta($category_id, "thumbnail_id", true);
          $image = wp_get_attachment_url($thumbnail_id);
          ?>

        <div class="categories__item">
          <a class="categories__link panel" href="<?php echo get_term_link($cat->slug, "product_cat"); ?>">
            <div class="panel__content">
              <div class="categories__item-img">
                <img src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>" />
              </div>
              <h4><?php echo $cat->name; ?></h4>
              <span>Sprawdź</span>
            </div>
          </a>
        </div>

        <?php
        }       
      }
    ?>
      </div>
    </div>
  </div>

</section>