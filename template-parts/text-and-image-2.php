<?php /* Template Name: Sekcja - Tekst z obrazem 2 */ ?>

<?php 
$page_id = get_query_var( 'acf_page_id' );
if (!$page_id) $page_id = get_the_ID();
$img_aspect = $args['img_aspect'] ? $args['img_aspect'] : "";
?>

<?php if(have_rows("text_and_img2_repeater", $page_id)): ?>
<?php while(have_rows("text_and_img2_repeater", $page_id)): the_row();?>

<section class="text-and-image
  <?php if(get_sub_field("text_and_img2_size")) { echo "text-and-image--half"; } else { echo "text-and-image--normal"; } ?>
  <?php if(get_sub_field("text_and_img2_position")) { echo "text-and-image--left"; } else { echo "text-and-image--right"; } ?>
  <?php if($img_aspect === "17/13") { echo "text-and-image--17-13"; } ?>
  <?php if($img_aspect === "16/9") { echo "text-and-image--16-9"; } ?>
  <?php if($img_aspect === "4/3") { echo "text-and-image--4-3"; } ?>
  ">

  <div class="wrapper">
    <div class="text-and-image__wrapper">
      <div class="text-and-image__content">

        <?php if(get_sub_field("text_and_img2_title_01")): ?>
        <h2 class="text-and-image__heading">
          <?php echo get_sub_field("text_and_img2_title_01"); ?>
        </h2>
        <?php endif; ?>

        <?php if(get_sub_field("text_and_img2_title_02")): ?>
        <h3 class="text-and-image__subheading">
          <?php echo get_sub_field("text_and_img2_title_02"); ?>
        </h3>
        <?php endif; ?>

        <?php if(get_sub_field("text_and_img2_text")): ?>
        <div class="text-and-image__description animate">
          <?php echo get_sub_field("text_and_img2_text"); ?>
        </div>

        <?php if (get_sub_field("text_and_img2_btn")):
          $link_url = get_sub_field("text_and_img2_btn")["url"];
          $link_title = get_sub_field("text_and_img2_btn")["title"];
          $link_target = isset(get_sub_field("text_and_img2_btn")["target"]) ? get_sub_field("text_and_img2_btn")["target"] : "_self";
        ?>
        <a class="text-and-image__btn link link--right" href="<?php echo esc_url($link_url); ?>"
          target="<?php echo esc_attr($link_target); ?>">
          <span class="btn__inner"><?php echo esc_html($link_title); ?></span>
        </a>
        <?php endif; ?>
      </div>

      <?php endif; ?>



      <div class="text-and-image__img">
        <?php
          if(get_sub_field("text_and_img2_img_bg")):
            $images = get_sub_field('text_and_img2_img_bg');
            $length = count($images);
        ?>
        <div class="text-and-image__img-items text-and-image__img-items--<?php echo $length; ?>">
          <?php if($images): ?>
          <?php foreach($images as $image): ?>
          <img class="text-and-image__img-item animate" src="<?php echo $image; ?>" />
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if(get_sub_field("text_and_img2_img_front")): ?>
        <img class="text-and-image__img-front" src="<?php echo get_sub_field("text_and_img2_img_front"); ?>" />
        <?php endif; ?>

        <?php if(get_sub_field("text_and_img2_img_logo")): ?>
        <div class="text-and-image__img-logo-wrapper">
          <img class="text-and-image__img-logo" src="<?php echo get_sub_field("text_and_img2_img_logo"); ?>" />
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

</section>

<?php endwhile; ?>
<?php endif; ?>