<?php /* Template Name: Sekcja - Zespół */ ?>

<section class="team">

  <div class="team__wrapper">
    <div class="team__content">

      <?php if(get_field("title_01")) { ?>
        <h2 class="team__header">
          <?php echo get_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
	      <h3 class="team__subheader">
          <?php echo get_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
        <div class="team__text">
          <?php echo get_field("text"); ?>
        </div>
      <?php } ?>

    </div>

    <?php if(have_rows('team_repeater')):?>
      <div class="team__items">
        <?php while(have_rows('team_repeater')): the_row(); ?>
          <div class="team__person">
            <div class="team__person-img scroll-anim">
              <?php if(get_sub_field("img")) { ?>
                <img src="<?php echo get_sub_field('img'); ?>" alt="<?php echo get_sub_field("name"); ?>" />
              <?php } ?>
            </div>
            <h4><?php get_sub_field("name"); ?></h4>
          </div>
        <?php endwhile;?>
      </div>
    <?php endif;?>

  </div>

</section>
