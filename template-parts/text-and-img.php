<?php /* Template Name: Sekcja - Tekst z obrazem */ ?>

<section class="text-and-image
  <?php if(get_field("size")) { echo "text-and-image--wide"; } else { echo "text-and-image--thin"; } ?>
  <?php if(get_field("img_position")) { echo "text-and-image--left"; } else { echo "text-and-image--right"; } ?>
">

  <div class="text-and-image__wrapper d-flex justify-content-center align-center row">
    <div class="text-and-image__content">

      <?php if(get_field("title_01")) { ?>
        <h2 class="text-and-image__header">
          <?php echo get_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
	      <h3 class="text-and-image__subheader">
          <?php echo get_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
        <div class="text-and-image__text">
          <?php echo get_field("text"); ?>
        </div>
      <?php } ?>

      <div>
        <?php if (get_field('btn')) {
          $link_url = get_field('btn')['url'];
          $link_title = get_field('btn')['title'];
          $link_target = isset(get_field('btn')['target']) ? get_field('btn')['target'] : '_self';
        ?>
          <a class="text-and-image__btn btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
          </a>
        <?php } ?>
      </div>

      <?php
        if(have_rows('links_repeater')):
          while(have_rows('links_repeater')): the_row();
            if (get_sub_field('link')) {
              $link_url = get_sub_field('link')['url'];
              $link_title = get_sub_field('link')['title'];
              $link_target = isset(get_sub_field('link')['target']) ? get_sub_field('link')['target'] : '_self';
      ?>
        <a class="text-and-image__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php if (get_sub_field('icon')) { ?>
            <img src="<?php echo get_field('icon'); ?>" alt="<?php echo $link_title; ?>" />
          <?php } ?>
          <?php echo esc_html($link_title); ?>
        </a>
      <?php }
          endwhile;
        endif;
      ?>

    </div>

    <div class="text-and-image__img">
      <img src="<?php echo get_field('img'); ?>" alt="<?php echo get_field("title_01"); ?>" />
    </div>

  </div>

</section>