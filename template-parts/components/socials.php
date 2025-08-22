<?php if(have_rows('options_socials_repeater', 'option')): ?>
<div class="socials <?php echo $args['class']; ?>">
  <?php while(have_rows('options_socials_repeater', 'option')): the_row();?>

  <div class="socials__item">
    <a class="socials__link" href="<?php echo get_sub_field("options_socials_url"); ?>" target="_blank">
      <img class="socials__icon" src="<?php echo get_sub_field("options_socials_icon"); ?>"
        alt="<?php echo get_sub_field("options_socials_label"); ?>" />
      <?php if(!$args['hide_labels']): ?>
      <span class="socials__label"><?php echo get_sub_field("options_socials_label"); ?></span>
      <?php endif; ?>
    </a>
  </div>

  <?php endwhile; ?>

</div>
<?php endif; ?>