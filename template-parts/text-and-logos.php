<?php /* Template Name: Sekcja - Tekst z logotypami */ ?>

<section class="text-and-logos">

<div class="text-and-logos__wrapper d-flex justify-content-center align-center row">

    <div class="text-and-logos__content">
      <?php if(get_field("title_01")) { ?>
        <h2 class="text-and-logos__header">
          <?php echo get_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
	      <h3 class="text-and-logos__subheader">
          <?php echo get_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
        <div class="text-and-logos__text">
          <?php echo get_field("text"); ?>
        </div>
      <?php } ?>

      <?php if (get_field('btn')) { ?>
      <div>
        <?php
          $link_url = get_field('btn')['url'];
          $link_title = get_field('btn')['title'];
          $link_target = isset(get_field('btn')['target']) ? get_field('btn')['target'] : '_self';
        ?>
          <a class="text-and-logos__btn btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <span class="btn__inner">
              <?php echo esc_html($link_title); ?>
            </span>
          </a>
      </div>
      <?php } ?>
    </div>

    <div class="text-and-logos__logos d-flex flex-nowrap">
      <?php if(have_rows('logos_repeater')):?>
        <?php while(have_rows('logos_repeater')): the_row();?>
          <div class="text-and-logos__logo">
            <?php if(get_sub_field("logo")) { ?>
              <img src="<?php echo get_sub_field('logo')['url']; ?>" alt="<?php echo get_sub_field("logo")['title']; ?>" />
            <?php } ?>
          </div>
        <?php endwhile;?>
      <?php endif;?>
    </div>

  </div>
  
</section>
