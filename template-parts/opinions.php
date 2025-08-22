<div class="opinions">
  <div class="wrapper">

    <?php if(get_field("opinions_title_01", 'option')): ?>
    <h2 class="opinions__heading heading animate">
      <?php echo get_field("opinions_title_01", 'option'); ?>
    </h2>
    <?php endif; ?>

    <?php if(get_field("opinions_title_02", 'option')): ?>
    <h3 class="opinions__subheading subheading animate delay-1">
      <?php echo get_field("opinions_title_02", 'option'); ?>
    </h3>
    <?php endif; ?>

    <?php if(get_field("why_text")): ?>
    <div class="opinions__description description animate delay-2">
      <?php echo get_field("why_text"); ?>
    </div>
    <?php endif; ?>

    <div class="opinions__items slider slider--with-bar slider--with-buttons">
      <?php if(have_rows('opinions_repeater', 'option')):?>
      <?php while(have_rows('opinions_repeater', 'option')): the_row(); ?>
      <div class="opinions__item">
        <h4 class="opinions__name"><?php echo get_sub_field('opinion_name'); ?></h4>
        <img src="<?php echo get_sub_field('opinion_icon'); ?>" alt="" class="opinions__icon" />
        <div class="opinions__rate">
          <?php for($i = 0; $i < get_sub_field('opinion_rate'); $i++): ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/imgs/stars/star.svg" alt="Star" />
          <?php endfor; ?>
        </div>
        <div class="opinions__text"><?php echo get_sub_field('opinion_description'); ?></div>
      </div>
      <?php endwhile;?>
      <?php endif;?>
    </div>

  </div>
</div>

</div>