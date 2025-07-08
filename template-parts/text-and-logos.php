<?php /* Template Name: Sekcja - Tekst z logotypami */ ?>

<section class="text-and-logos">

  <div class="text-and-logos__wrapper d-flex justify-content-center align-center row">
    <div class="wrapper">
      <div class="text-and-logos__wrapper">

        <div class="text-and-logos__content">
          <?php if(get_field("text_and_logos_title_01")) { ?>
          <h2 class="text-and-logos__header">
            <?php echo get_field("text_and_logos_title_01"); ?>
          </h2>
          <?php } ?>

          <?php if(get_field("text_and_logos_title_02")) { ?>
          <h3 class="text-and-logos__subheader">
            <?php echo get_field("text_and_logos_title_02"); ?>
          </h3>
          <?php } ?>

          <?php if(get_field("text_and_logos_text")) { ?>
          <div class="text-and-logos__text">
            <?php echo get_field("text_and_logos_text"); ?>
          </div>
          <?php } ?>

          <?php if (get_field("text_and_logos_btn")) { ?>
          <div>
            <?php
          $link_url = get_field("text_and_logos_btn")["url"];
          $link_title = get_field("text_and_logos_btn")["title"];
          $link_target = isset(get_field("text_and_logos_btn")["target"]) ? get_field("text_and_logos_btn")["target"] : "_self";
        ?>
            <a class="text-and-logos__btn btn" href="<?php echo esc_url($link_url); ?>"
              target="<?php echo esc_attr($link_target); ?>">
              <span class="btn__inner">
                <?php echo esc_html($link_title); ?>
              </span>
            </a>
          </div>
          <?php } ?>
        </div>

        <div class="text-and-logos__logos">
          <?php if(have_rows("text_and_logos_logos_repeater")):?>
          <?php while(have_rows("text_and_logos_logos_repeater")): the_row(); ?>
          <div class="text-and-logos__logo">
            <?php if(get_sub_field("text_and_logos_logo")) { ?>
            <img src="<?php echo get_sub_field("text_and_logos_logo")["url"]; ?>"
              alt="<?php echo get_sub_field("text_and_logos_logo")["title"]; ?>" />
            <?php } ?>
          </div>
          <?php endwhile ;?>
          <?php endif ;?>
        </div>

      </div>
    </div>
  </div>

</section>