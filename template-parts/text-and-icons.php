<?php /* Template Name: Sekcja - Tekst z ikonami */ ?>

<?php if( $args['id']) $id = $args['id']; ?>

<section class="text-and-icons" id="<?php echo esc_attr( $id ); ?>">

  <div class="text-and-icons__wrapper">
    <div class="wrapper">
      <div class="text-and-icons__wrapper">

        <div class="text-and-icons__content">
          <?php if(get_field("text_and_icons_title_01")): ?>
          <h2 class="text-and-icons__heading animate">
            <?php echo get_field("text_and_icons_title_01"); ?>
          </h2>
          <?php endif; ?>

          <?php if(get_field("text_and_icons_title_02")): ?>
          <h3 class="text-and-icons__subheading animate delay-1">
            <?php echo get_field("text_and_icons_title_02"); ?>
          </h3>
          <?php endif; ?>

          <?php if(get_field("text_and_icons_text")): ?>
          <div class="text-and-icons__description animate delay-2">
            <?php echo get_field("text_and_icons_text"); ?>
          </div>
          <?php endif; ?>

        </div>

        <div class="text-and-icons__icons animate delay-3">
          <?php if(have_rows("text_and_icons_repeater")):?>
          <?php while(have_rows("text_and_icons_repeater")): the_row(); ?>
          <div class="text-and-icons__item">
            <?php if(get_sub_field("text_and_icons_icon_img")): ?>
            <div class="text-and-icons__icon icon">
              <img src="<?php echo get_sub_field("text_and_icons_icon_img"); ?>"
                alt="<?php echo get_sub_field("text_and_icons_icon_title"); ?>" />
            </div>
            <?php endif; ?>
            <h4 class="icon__title">
              <?php echo get_sub_field("text_and_icons_icon_title"); ?>
              <span class="icon__subtitle"><?php echo get_sub_field("text_and_icons_icon_subtitle"); ?></span>
            </h4>
          </div>
          <?php endwhile ;?>
          <?php endif ;?>
        </div>

      </div>
    </div>
  </div>

</section>