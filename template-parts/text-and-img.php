<?php /* Template Name: Sekcja - Tekst z obrazem */ ?>

<section class="text-and-image
  <?php if(get_field("text_and_img_size")) { echo "text-and-image--wide"; } else { echo "text-and-image--thin"; } ?>
  <?php if(get_field("text_and_img_img_position")) { echo "text-and-image--left"; } else { echo "text-and-image--right"; } ?>
">

  <div class="wrapper">
    <div class="text-and-image__wrapper">
      <div class="text-and-image__content">

        <?php if(get_field("text_and_img_title_01")) { ?>
        <h2 class="text-and-image__header">
          <?php echo get_field("text_and_img_title_01"); ?>
        </h2>
        <?php } ?>

        <?php if(get_field("text_and_img_title_02")) { ?>
        <h3 class="text-and-image__subheader">
          <?php echo get_field("text_and_img_title_02"); ?>
        </h3>
        <?php } ?>

        <?php if(get_field("text_and_img_text")) { ?>
        <div class="text-and-image__text">
          <?php echo get_field("text_and_img_text"); ?>
        </div>
        <?php } ?>

        <div>
          <?php if (get_field("text_and_img_btn")) {
          $link_url = get_field("text_and_img_btn")["url"];
          $link_title = get_field("text_and_img_btn")["title"];
          $link_target = isset(get_field("text_and_img_btn")["target"]) ? get_field("text_and_img_btn")["target"] : "_self";
        ?>
          <a class="text-and-image__btn btn" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>">
            <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
          </a>
          <?php } ?>
        </div>

        <?php
        if(have_rows("links_repeater")):
          while(have_rows("links_repeater")): the_row();
            if (get_sub_field("text_and_img_link")) {
              $link_url = get_sub_field("text_and_img_link")["url"];
              $link_title = get_sub_field("text_and_img_link")["title"];
              $link_target = isset(get_sub_field("text_and_img_link")["target"]) ? get_sub_field("text_and_img_link")["target"] : "_self";
      ?>
        <a class="text-and-image__link" href="<?php echo esc_url($link_url); ?>"
          target="<?php echo esc_attr($link_target); ?>">
          <?php if (get_sub_field("text_and_img_icon")) { ?>
          <img src="<?php echo get_field("text_and_img_icon"); ?>" alt="<?php echo $link_title; ?>" />
          <?php } ?>
          <?php echo esc_html($link_title); ?>
        </a>
        <?php }
          endwhile;
        endif;
      ?>

      </div>

      <div class="text-and-image__img">
        <div class="text-and-image__img-wrapper">
          <div class="text-and-image__img-inner">
            <?php if(get_field("text_and_img_img_bg")): ?>
            <img class="text-and-image__img-bg" src="<?php echo get_field("text_and_img_img_bg"); ?>" />
            <?php endif; ?>
            <?php if(get_field("text_and_img_img_front")): ?>
            <img class="text-and-image__img-front" src="<?php echo get_field("text_and_img_img_front"); ?>" />
            <?php endif; ?>
          </div>
          <?php if(get_field("text_and_img_img_logo")): ?>
          <img class="text-and-image__img-logo" src="<?php echo get_field("text_and_img_img_logo"); ?>" />
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>

</section>