<?php /* Template Name: Home - Hero */ ?>

<?php if(have_rows('home_hero_repeater')):?>

<section class="home-hero slick-carousel">

  <?php while(have_rows('home_hero_repeater')): the_row();?>

  <div class="home-hero__wrapper d-flex justify-content-center align-center row">
    <div class="home-hero__content col">

      <?php if(get_sub_field("title_01")) { ?>
        <h2 class="home-hero__header">
          <?php echo get_sub_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_sub_field("title_02")) { ?>
	      <h3 class="home-hero__subheader">
          <?php echo get_sub_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_sub_field("text")) { ?>
        <div class="home-hero__text">
          <?php echo get_sub_field("text"); ?>
        </div>
      <?php } ?>

      <?php if (get_sub_field('btn')) { ?>
      <div>
        <?php
          $link_url = get_sub_field('btn')['url'];
          $link_title = get_sub_field('btn')['title'];
          $link_target = isset(get_sub_field('btn')['target']) ? get_sub_field('btn')['target'] : '_self';
        ?>
          <a class="home-hero__btn btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
            <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
          </a>
      </div>
      <?php } ?>
    </div>

    <div class="home-hero__img col">
      <?php if(get_sub_field("img")) { ?>
        <img src="<?php echo get_sub_field('img'); ?>" alt="<?php echo get_sub_field("title_01"); ?>" />
      <?php } ?>
    </div>

  </div>

  <?php endwhile;?>

  <div class="home-hero__scroll">
    <div>Zjedź niżej</div>
    <img src="" alt="Zjedź niżej" />
  </div>
  
</section>

<?php endif;?>