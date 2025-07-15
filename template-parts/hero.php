<?php /* Template Name: Sekcja - Hero */ ?>

<?php if(have_rows("hero_repeater")):?>

<section class="hero">
  <div class="hero__slider-wrapper">
    <div class="hero__slick slick-carousel">

      <?php while(have_rows("hero_repeater")): the_row();?>

      <div
        class="hero__item hero__item--<?php echo get_sub_field("hero_img_width"); ?> hero__item--<?php echo get_sub_field("hero_bg"); ?>">
        <div class="wrapper hero__item-wrapper">
          <div class="hero__content col">

            <?php if(get_sub_field("hero_title_01")) { ?>
            <h2 class="hero__header">
              <?php echo get_sub_field("hero_title_01"); ?>
            </h2>
            <?php } ?>

            <?php if(get_sub_field("hero_title_02")) { ?>
            <h3 class="hero__subheader">
              <?php echo get_sub_field("hero_title_02"); ?>
            </h3>
            <?php } ?>

            <?php if(get_sub_field("hero_text")) { ?>
            <div class="hero__text">
              <?php echo get_sub_field("hero_text"); ?>
            </div>
            <?php } ?>

            <?php if (get_sub_field("hero_btn")) { ?>
            <div>
              <?php
          $link_url = get_sub_field("hero_btn")["url"];
          $link_title = get_sub_field("hero_btn")["title"];
          $link_target = isset(get_sub_field("hero_btn")["target"]) ? get_sub_field("hero_btn")["target"] : "_self";
        ?>
              <a class="hero__btn btn <?php if(get_sub_field("hero_bg") == "blue") echo "btn--alternative"; ?>"
                href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
              </a>
            </div>
            <?php } ?>
          </div>

          <div class="hero__img col">
            <?php if(get_sub_field("hero_img")) { ?>
            <img src="<?php echo get_sub_field("hero_img"); ?>" alt="<?php echo get_sub_field("hero_title_01"); ?>" />
            <?php } ?>
          </div>

        </div>
      </div>

      <?php endwhile;?>
    </div>
  </div>

  <div class="wrapper">
    <div class="hero__scroll">
      <div>Zjedź niżej</div>
      <img src="http://127.0.0.1:3000/orto4you2/wp-content/themes/candyweb-new/assets/imgs/arrow-down.svg"
        alt="Zjedź niżej" />
    </div>
  </div>
</section>

<?php endif;?>