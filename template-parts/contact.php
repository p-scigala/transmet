<?php /* Template Name: Sekcja - Kontakt */ ?>

<section class="contact">

  <div class="contact__wrapper">
    <div class="contact__content">

      <?php if(get_field("title_01")) { ?>
        <h2 class="contact__header">
          <?php echo get_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
	      <h3 class="contact__subheader">
          <?php echo get_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
        <div class="contact__text">
          <?php echo get_field("text"); ?>
        </div>
      <?php } ?>

      <?php
        if(have_rows('links_repeater')):
          while(have_rows('links_repeater')): the_row();
            if (get_sub_field('link')) {
              $link_url = get_sub_field('link')['url'];
              $link_title = get_sub_field('link')['title'];
              $link_target = isset(get_sub_field('link')['target']) ? get_sub_field('link')['target'] : '_self';
      ?>
        <a class="contact__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php if (get_sub_field('icon')) { ?>
            <img src="<?php echo get_field('icon'); ?>" alt="<?php echo $link_title; ?>" />
          <?php } ?>
          <?php echo esc_html($link_title); ?>
        </a>
      <?php }
          endwhile
        endif;
      ?>
      
    </div>

    <div class="contact__form">
      <?php do_shortcode('[contact-form-7 id="0a1df65" title="Formularz - kontakt"]'); ?>
    </div>

  </div>

</section>