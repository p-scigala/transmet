<div class="single-product__info-panel">
  <div class="single-product__info-panel-top">
    <div class="single-product__info-panel-icon">
      <img src="<?php echo $args['img']; ?>" alt="<?php echo $args['title']; ?>"
        class="single-product__info-panel-icon-img" />
    </div>
  </div>
  <div class="single-product__info-panel-text">
    <h4 class="single-product__info-panel-heading">
      <?php echo $args['title']; ?>
    </h4>
    <?php echo $args['text']; ?>
    <?php if($args['link']) : ?>
      <a href="<?php echo $args['link']; ?>" class="single-product__info-panel-link link">Sprawdź</a>
    <?php endif; ?>
  </div>
</div>