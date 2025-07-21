<?php /* Template Name: Sekcja - Zapytaj o pomoc */ ?>

<section class="ask">

  <div class="wrapper">
    <div class="ask__wrapper">
      <div class="ask__img">
        <?php if(get_field("ask_img", "option")): ?>
        <img src="<?php echo get_field("ask_img", "option"); ?>" alt="Zapytaj o pomoc" class="scroll-anim" />
        <?php endif; ?>
      </div>
      <div class="ask__content">

        <?php if(get_field("ask_title_01", "option")): ?>
        <h2 class="ask__header scroll-anim">
          <?php echo get_field("ask_title_01", "option"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("ask_title_02", "option")): ?>
        <h3 class="ask__subheader scroll-anim">
          <?php echo get_field("ask_title_02", "option"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("ask_text", "option")): ?>
        <div class="ask__text scroll-anim">
          <?php echo get_field("ask_text", "option"); ?>
        </div>
        <?php endif; ?>

        <?php
        if(have_rows("links_repeater", "option")):
          while(have_rows("links_repeater", "option")): the_row();
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

        <div class="ask__btn-wrapper scroll-anim">
          <?php if (get_field("ask_btn", "option")) {
          $link_url = get_field("ask_btn", "option")["url"];
          $link_title = get_field("ask_btn", "option")["title"];
          $link_target = isset(get_field("ask_btn", "option")["target"]) ? get_field("ask_btn", "option")["target"] : "_self";
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