<?php /* Template Name: Sekcja - Dlaczego warto */ ?>

<section class="in-numbers">

  <div class="in-numbers__content">

    <?php if(get_field("numbers_bg")): ?>
    <img src="<?php echo get_field("numbers_bg"); ?>" alt="" class="in-numbers__bg">
    <?php endif; ?>

    <?php if(get_field("numbers_front")): ?>
    <img src="<?php echo get_field("numbers_front"); ?>" alt="" class="in-numbers__front">
    <?php endif; ?>

    <div class="wrapper">
      <div class="in-numbers__text">

        <?php if(get_field("numbers_title_01")): ?>
        <h2 class="in-numbers__heading animate">
          <?php echo get_field("numbers_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_field("numbers_title_02")): ?>
        <h3 class="in-numbers__subheading animate delay-1">
          <?php echo get_field("numbers_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_field("numbers_text")): ?>
        <div class="in-numbers__description animate delay-2">
          <?php echo get_field("numbers_text"); ?>
        </div>
        <?php endif; ?>
      </div>

      <?php if(have_rows("numbers_list_repeater")): ?>
      <div class="in-numbers__items">
        <?php $cnt = 1; ?>
        <?php while(have_rows("numbers_list_repeater")): the_row(); ?>
        <div class="in-numbers__item animate delay-<?php echo $cnt; ?>">

          <?php if(get_sub_field("number_list_title")) : ?>
          <?php if(get_sub_field("number_list_number")) : ?>
          <span class="in-numbers__item-text">
            <?php if(get_sub_field("number_list_prefix")) : ?>
            <?php echo get_sub_field("number_list_prefix"); ?><?php endif; ?><?php echo get_sub_field("number_list_number"); ?>
          </span>
          <?php endif; ?>
          <h4 class="in-numbers__item-title">
            <?php echo get_sub_field("number_list_title"); ?>
          </h4>
          <?php endif; ?>

        </div>
        <?php $cnt++; endwhile;?>
      </div>
      <?php endif;?>

    </div>

    <div class="in-numbers__opinions">
      <?php include('opinions.php'); ?>
    </div>

  </div>

</section>