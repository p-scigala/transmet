<?php /* Template Name: Sekcja - Tekst z obrazem */ ?>

<?php 
$page_id = get_query_var( 'acf_page_id' );
if (!$page_id) {
  $page_id = get_the_ID();
}
?>

<?php if(have_rows("text_and_img_repeater", $page_id)): ?>
<?php while(have_rows("text_and_img_repeater", $page_id)): the_row();?>

<section class="text-and-image
  <?php if(get_sub_field("text_and_img_size")) { echo "text-and-image--wide"; } else { echo "text-and-image--thin"; } ?>
  <?php if(get_sub_field("text_and_img_position")) { echo "text-and-image--left"; } else { echo "text-and-image--right"; } ?>
">

  <div class="wrapper">
    <div class="text-and-image__wrapper">
      <div class="text-and-image__content">

        <?php if(get_sub_field("text_and_img_title_01")) { ?>
        <h2 class="text-and-image__header">
          <?php echo get_sub_field("text_and_img_title_01"); ?>
        </h2>
        <?php } ?>

        <?php if(get_sub_field("text_and_img_title_02")) { ?>
        <h3 class="text-and-image__subheader">
          <?php echo get_sub_field("text_and_img_title_02"); ?>
        </h3>
        <?php } ?>

        <?php if(get_sub_field("text_and_img_text")) { ?>
        <div class="text-and-image__text">
          <?php echo get_sub_field("text_and_img_text"); ?>
        </div>
        <?php } ?>

        <?php
        if(have_rows("text_and_img_icon_group")): ?>
        <?php while(have_rows("text_and_img_icon_group")): the_row(); ?>
        <?php if(get_sub_field("text_and_img_icon")): ?>

        <div class="text-and-image__icon">
          <span class="text-and-image__icon-img">
            <?php if (get_sub_field("text_and_img_icon")): ?>
            <img src="<?php echo get_sub_field("text_and_img_icon"); ?>" alt="Icon" />
            <?php endif; ?>
          </span>
          <span class="text-and-image__icon-text">
            <?php if (get_sub_field("text_and_img_icon_text")): ?>
            <?php echo get_sub_field("text_and_img_icon_text"); ?>
            <?php endif; ?>
          </span>
        </div>

        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>

        <?php if(get_sub_field("text_and_img_img_logo")): ?>
        <img class="text-and-image__img-logo no-desktop" src="<?php echo get_sub_field("text_and_img_img_logo"); ?>" />
        <?php endif; ?>

        <div>
          <?php if (get_sub_field("text_and_img_btn")) {
          $link_url = get_sub_field("text_and_img_btn")["url"];
          $link_title = get_sub_field("text_and_img_btn")["title"];
          $link_target = isset(get_sub_field("text_and_img_btn")["target"]) ? get_sub_field("text_and_img_btn")["target"] : "_self";
        ?>
          <a class="text-and-image__btn btn" href="<?php echo esc_url($link_url); ?>"
            target="<?php echo esc_attr($link_target); ?>">
            <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
          </a>
          <?php } ?>
        </div>
      </div>

      <div class="text-and-image__img">
        <div class="text-and-image__img-wrapper">
          <div class="text-and-image__img-inner">
            <?php if(get_sub_field("text_and_img_img_bg")): ?>
            <img class="text-and-image__img-bg" src="<?php echo get_sub_field("text_and_img_img_bg"); ?>" />
            <?php endif; ?>
            <?php if(get_sub_field("text_and_img_img_front")): ?>
            <img class="text-and-image__img-front" src="<?php echo get_sub_field("text_and_img_img_front"); ?>" />
            <?php endif; ?>
          </div>
          <?php if(get_sub_field("text_and_img_img_logo")): ?>
          <img class="text-and-image__img-logo no-mobile" src="<?php echo get_sub_field("text_and_img_img_logo"); ?>" />
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>

</section>

<?php endwhile; ?>
<?php endif; ?>