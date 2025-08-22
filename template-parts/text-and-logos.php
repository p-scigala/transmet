<?php /* Template Name: Sekcja - Tekst z logotypami */ ?>

<?php if( $args['id']) $id = $args['id']; ?>

<section class="text-and-logos" id="<?php echo esc_attr( $id ); ?>">

  <div class="text-and-logos__wrapper">
    <div class="wrapper">
      <div class="text-and-logos__wrapper">

        <div class="text-and-logos__content">
          <?php if(get_field("text_and_logos_title_01")): ?>
          <h2 class="text-and-logos__heading heading animate">
            <?php echo get_field("text_and_logos_title_01"); ?>
          </h2>
          <?php endif; ?>

          <?php if(get_field("text_and_logos_title_02")): ?>
          <h3 class="text-and-logos__subheading subheading animate delay-1">
            <?php echo get_field("text_and_logos_title_02"); ?>
          </h3>
          <?php endif; ?>

          <?php if(get_field("text_and_logos_text")): ?>
          <div class="text-and-logos__description description animate delay-2">
            <?php echo get_field("text_and_logos_text"); ?>
          </div>
          <?php endif; ?>

        </div>

        <div class="text-and-logos__logos slider slider--with-bar slider--with-buttons animate delay-3">
          <?php if(have_rows("text_and_logos_logos_repeater")):?>
          <?php while(have_rows("text_and_logos_logos_repeater")): the_row(); ?>
          <div class="text-and-logos__logo panel">
            <?php if(get_sub_field("text_and_logos_logo")): ?>
            <img src="<?php echo get_sub_field("text_and_logos_logo")["url"]; ?>"
              alt="<?php echo get_sub_field("text_and_logos_logo")["title"]; ?>" />
            <?php endif; ?>
          </div>
          <?php endwhile ;?>
          <?php endif ;?>
        </div>

      </div>
    </div>
  </div>

</section>