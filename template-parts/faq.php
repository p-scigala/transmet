<?php /* Template Name: Sekcja - FAQ */ ?>

<section class="faq">

  <div class="wrapper">
    <div class="faq__wrapper">
      <div class="faq__content">

        <?php if(get_field("faq_title_01")): ?>
        <h2 class="faq__header">
          <?php echo get_field("faq_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("faq_title_02")): ?>
        <h3 class="faq__subheader">
          <?php echo get_field("faq_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("faq_text")): ?>
        <div class="faq__text">
          <?php echo get_field("faq_text"); ?>
        </div>
        <?php endif; ?>

      </div>

      <div class="faq__items">
        <?php
      $args = array(
        'post_type' => 'faq',
        'posts_per_page' => 100,
      );

      $loop = new WP_Query( $args );

      while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
        ?>
        <div class="faq__item accordion">
          <div class="accordion__trigger">
            <?php echo get_the_title(); ?>
            <span class="accordion__icon"></span>
          </div>
          <div class="accordion__content">
            <div class="accordion__text">
              <?php echo get_the_content(); ?>
            </div>
          </div>
        </div>
        <?php
      endwhile;
      wp_reset_query();
      ?>
      </div>

    </div>
  </div>

</section>