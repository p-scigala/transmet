<?php
  get_header();
?>

<main id="site-main">

  <?php get_template_part('loops/single-post', get_post_format()); ?>

</main>

<?php
    get_footer();
?>
