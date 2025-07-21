<div class="single-product__info-panel">
  <div class="single-product__info-panel-top">
    <div class="single-product__info-panel-icon">
      <img src="<?php echo $args['img']; ?>" alt="<?php echo $args['title']; ?>"
        class="single-product__info-panel-icon-img" />
    </div>
    <h4 class="single-product__info-panel-heading">
      <?php echo $args['title']; ?>
      <?php if($args['value']) { echo $args['value']; } ?>
    </h4>
  </div>
  <div class="single-product__info-panel-text">
    <?php echo $args['text']; ?>
  </div>
</div>