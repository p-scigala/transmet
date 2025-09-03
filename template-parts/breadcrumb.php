<?php if (function_exists('bcn_display')) : ?>
<div class="breadcrumb__wrapper bg-gray">
  <div class="wrapper">
    <nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">
      <?php bcn_display(); ?>
    </nav>
  </div>
</div>
<?php endif; ?>