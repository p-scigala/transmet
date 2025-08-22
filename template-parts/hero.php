<?php /* Template Name: Sekcja - Hero */ ?>

<?php if(have_rows("hero_repeater")):?>

<section class="hero">
  <div class="hero__slider-wrapper">
    <div class="hero__slider slider--with-bar">

      <?php while(have_rows("hero_repeater")): the_row();?>

      <div class="hero__item">
        <?php if(get_sub_field("hero_bg")): ?>
        <img class="hero__bg" src="<?php echo get_sub_field("hero_bg"); ?>" alt="" />
        <?php endif; ?>

        <div class="wrapper hero__item-wrapper">
          <div class="hero__content col">

            <?php if(get_sub_field("hero_logo")): ?>
            <img class="hero__logo animate delay-10" src="<?php echo get_sub_field("hero_logo"); ?>" alt="" />
            <?php endif; ?>

            <?php if(get_sub_field("hero_title_01")): ?>
            <h2 class="hero__heading animate delay-10">
              <?php echo get_sub_field("hero_title_01"); ?>
            </h2>
            <?php endif; ?>

            <?php if(get_sub_field("hero_title_02")): ?>
            <h3 class="hero__subheading animate delay-11">
              <?php echo get_sub_field("hero_title_02"); ?>
            </h3>
            <?php endif; ?>

            <?php if(get_sub_field("hero_text")): ?>
            <div class="hero__description animate delay-12">
              <?php echo get_sub_field("hero_text"); ?>
            </div>
            <?php endif; ?>

            <?php if (get_sub_field("hero_btn")): ?>
            <div class="animate delay-13">
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
            <?php endif; ?>
          </div>

          <div class="hero__img col hidden-before-load">
            <?php if(get_sub_field("hero_img")): ?>
            <img src="<?php echo get_sub_field("hero_img"); ?>" alt="<?php echo get_sub_field("hero_title_01"); ?>"
              class="animate delay-14" />
            <?php endif; ?>
          </div>

        </div>
      </div>

      <?php endwhile;?>
    </div>

  </div>

</section>

<?php endif;?>