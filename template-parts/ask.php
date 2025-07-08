<?php /* Template Name: Sekcja - Zapytaj o pomoc */ ?>

<section class="ask">

  <div class="wrapper">
    <div class="ask__wrapper">
      <div class="ask__img">
        <?php if(get_field("ask_img")): ?>
        <img src="<?php echo get_field("ask_img"); ?>" alt="Zapytaj o pomoc" />
        <?php endif; ?>
      </div>
      <div class="ask__content">

        <?php if(get_field("ask_title_01")): ?>
        <h2 class="ask__header">
          <?php echo get_field("ask_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("ask_title_02")): ?>
        <h3 class="ask__subheader">
          <?php echo get_field("ask_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("ask_text")): ?>
        <div class="ask__text">
          <?php echo get_field("ask_text"); ?>
        </div>
        <?php endif; ?>

        <?php
        if(have_rows("links_repeater")):
          while(have_rows("links_repeater")): the_row();
            if (get_sub_field("ask_link")) {
              $link_url = get_sub_field("ask_link")["url"];
              $link_title = get_sub_field("ask_link")["title"];
              $link_target = isset(get_sub_field("ask_link")["target"]) ? get_sub_field("ask_link")["target"] : "_self";
      ?>
        <a class="ask__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php if (get_sub_field("ask_icon")) { ?>
          <img src="<?php echo get_field("ask_icon"); ?>" alt="<?php echo $link_title; ?>" />
          <?php } ?>
          <?php echo esc_html($link_title); ?>
        </a>
        <?php }
          endwhile;
        endif;
      ?>

        <div>
          <?php if (get_field("ask_btn")) {
          $link_url = get_field("ask_btn")["url"];
          $link_title = get_field("ask_btn")["title"];
          $link_target = isset(get_field("ask_btn")["target"]) ? get_field("ask_btn")["target"] : "_self";
        ?>
          <a class="ask__btn btn" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>">
            <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
          </a>
          <?php } ?>
        </div>

      </div>
    </div>
  </div>

</section>