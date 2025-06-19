<?php /* Template Name: Sekcja - FAQ */ ?>

<section class="faq">

  <div class="faq__wrapper">
    <div class="faq__content">

      <?php if(get_field("title_01")) { ?>
        <h2 class="faq__header">
          <?php echo get_field("title_01"); ?>
        </h2>
      <?php } ?>

      <?php if(get_field("title_02")) { ?>
	      <h3 class="faq__subheader">
          <?php echo get_field("title_02"); ?>
        </h3>
      <?php } ?>

      <?php if(get_field("text")) { ?>
        <div class="faq__text">
          <?php echo get_field("text"); ?>
        </div>
      <?php } ?>

    </div>

    <?php if(have_rows('faq_repeater')):?>
      <div class="faq__items">
        <?php while(have_rows('faq_repeater')): the_row();?>
          <div class="faq__item <?php if(get_sub_field('active')) echo "active"; ?>">
            <div class="faq__item-trigger">
               <?php if(get_sub_field("title")) { ?>
                <h4><?php echo get_sub_field("title"); ?></h4>
              <?php } ?>
              <div class="faq__item-content">
                <?php if(get_sub_field("text")) { ?>
                    <?php echo get_sub_field("text"); ?>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php endwhile;?>
      </div>
    <?php endif;?>

  </div>

</section>
