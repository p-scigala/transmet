<?php /* Template Name: Sekcja - Dlaczego warto */ ?>

<section class="why-worth">

  <div class="why-worth__content">

    <?php if(get_field("why_bg")): ?>
    <img src="<?php echo get_field("why_bg"); ?>" alt="" class="why-worth__bg">
    <?php endif; ?>

    <?php if(get_field("why_front")): ?>
    <img src="<?php echo get_field("why_front"); ?>" alt="" class="why-worth__front">
    <?php endif; ?>

    <div class="wrapper">

      <?php if(get_field("why_title_01")): ?>
      <h2 class="why-worth__heading animate">
        <?php echo get_field("why_title_01"); ?>
      </h2>
      <?php endif; ?>

      <?php if(get_field("why_title_02")): ?>
      <h3 class="why-worth__subheading animate delay-1">
        <?php echo get_field("why_title_02"); ?>
      </h3>
      <?php endif; ?>

      <?php if(get_field("why_text")): ?>
      <div class="why-worth__description animate delay-2">
        <?php echo get_field("why_text"); ?>
      </div>
      <?php endif; ?>

      <?php if(have_rows("why_list_repeater")): ?>
      <div class="why-worth__items">
        <?php $cnt = 1; ?>
        <?php while(have_rows("why_list_repeater")): the_row(); ?>
        <div class="why-worth__item animate delay-<?php echo $cnt; ?>">

          <?php if(get_sub_field("why_list_title")) : ?>

          <div class="why-worth__item-img icon">
            <?php if(get_sub_field("why_list_icon")) : ?>
            <img src="<?php echo get_sub_field("why_list_icon"); ?>"
              alt="<?php echo get_sub_field("why_list_title"); ?>" />
            <?php endif; ?>
          </div>

          <h4 class="why-worth__item-title icon__title">
            <?php echo get_sub_field("why_list_title"); ?>
            <?php if(get_sub_field("why_list_text")) : ?>
            <span class="why-worth__item-text icon__subtitle">
              <?php echo get_sub_field("why_list_text"); ?>
            </span>
            <?php endif; ?>
          </h4>
          <?php endif; ?>

        </div>
        <?php $cnt++; endwhile;?>
      </div>
      <?php endif;?>

    </div>

    <div class="why-worth__opinions">
      <?php include('opinions.php'); ?>
    </div>

  </div>

</section>