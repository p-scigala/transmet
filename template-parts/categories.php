<?php /* Template Name: Sekcja - Kategorie */ ?>

<section class="categories">

  <div class="wrapper">
    <div class="categories__wrapper">
      <div class="categories__content">

        <?php if(get_field("categories_title_01")) { ?>
        <h2 class="categories__heading heading animate">
          <?php echo get_field("categories_title_01"); ?>
        </h2>
        <?php } ?>

        <?php if(get_field("categories_title_02")) { ?>
        <h3 class="categories__subheading subheading animate delay-1">
          <?php echo get_field("categories_title_02"); ?>
        </h3>
        <?php } ?>

        <?php if(get_field("categories_text")) { ?>
        <div class="categories__description description animate delay-2">
          <?php echo get_field("categories_text"); ?>
        </div>
        <?php } ?>

      </div>

      <div class="categories__items slider slider--with-bar slider--with-buttons animate delay-3">
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
        if($cat -> category_parent === 0 && $cat->slug !== "uncategorized" && $cat->slug !== "brak-kategorii") {
          $category_id = $cat->term_id;
          $thumbnail_id = get_woocommerce_term_meta($category_id, "thumbnail_id", true);
          $image = wp_get_attachment_url($thumbnail_id);
          ?>

        <div class="categories__item animate">
          <a class="categories__link panel" href="<?php echo get_term_link($cat->slug, "product_cat"); ?>">
            <div class="panel__content">
              <div class="categories__item-img">
                <img src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>" />
              </div>
              <h4><?php echo $cat->name; ?></h4>
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