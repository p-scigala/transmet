<?php /* Template Name: Sekcja - Kroki */ ?>

<section class="steps <?php if(get_sub_field("steps_pos")) { echo "steps--" . get_sub_field("steps_pos"); } ?>">
  <div class="wrapper">
    <div class="steps__wrapper">
      <div class="steps__content">

        <?php if(get_sub_field("steps_heading")): ?>
        <h2 class="steps__heading">
          <?php echo get_sub_field("steps_heading"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_sub_field("steps_subheading")): ?>
        <h3 class="steps__subheading">
          <?php echo get_sub_field("steps_subheading"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_sub_field("steps_description")): ?>
        <div class="steps__description">
          <?php echo get_sub_field("steps_description"); ?>
        </div>
        <?php endif; ?>

      </div>

      <div class="steps__items steps__slick">
        <?php if(have_rows('steps_repeater')) : ?>
        <?php while(have_rows('steps_repeater')) : the_row(); ?>

        <div class="steps__item">

          <?php if(get_sub_field("steps_list_heading")): ?>
          <h4 class="steps__item-heading">
            <?php echo get_sub_field("steps_list_heading"); ?>
          </h4>
          <?php endif; ?>

          <?php if(get_sub_field("steps_list_subheading")): ?>
          <h4 class="steps__item-subheading">
            <?php echo get_sub_field("steps_list_subheading"); ?>
          </h4>
          <?php endif; ?>

          <?php if(get_sub_field("steps_list_description")): ?>
          <div class="steps__item-description">
            <?php echo get_sub_field("steps_list_description"); ?>
          </div>
          <?php endif; ?>

        </div>

        <?php endwhile; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>

</section>