<?php
get_header();
?>

<?php $title = get_queried_object()->post_title; ?>
<main id="site-main" class='container'>
  <header class='mb-4'>
    <h1 class="h3">
      <?php echo $title; ?>
    </h1>
  </header>

  <?php
  get_template_part('loops/index-loop');
  ?>
</main>

<?php
get_footer();
?>