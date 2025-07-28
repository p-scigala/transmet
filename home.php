<?php
get_header();
?>

<?php $title = get_queried_object()->post_title; ?>
<main id="site-main">

  <?php
  get_template_part('loops/index-loop');
  ?>
</main>

<?php
get_footer();
?>