<?php /* Template Name: Sekcja - Co nas wyróżnia */ ?>

<section class="about">

  <div class="about__wrapper">
    <div class="about__content">

      <?php if(get_field("title_01")) { ?>
        <h2 class="about__header">
          <?php echo get_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
	      <h3 class="about__subheader">
          <?php echo get_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
        <div class="about__text">
          <?php echo get_field("text"); ?>
        </div>
      <?php } ?>

    </div>

    <?php if(have_rows('list_repeater')):?>
      <div class="about__items">
        <?php while(have_rows('list_repeater')): the_row();?>
          <div class="about__item">
            <div class="about__item-img">
              <?php if(get_sub_field("icon")) { ?>
                <img src="<?php echo get_sub_field('icon'); ?>" alt="<?php echo get_sub_field("title"); ?>" />
              <?php } ?>
            </div>
            <?php if(get_sub_field("title")) { ?>
              <h4 class="about__item-title">
                <?php echo get_sub_field("title"); ?>
              </h4>
            <?php } ?>
            <?php if(get_sub_field("text")) { ?>
              <div class="about__item-text">
                <?php echo get_sub_field("text"); ?>
              </div>
            <?php } ?>
          </div>
        <?php endwhile;?>
      </div>
    <?php endif;?>

  </div>

</section>
