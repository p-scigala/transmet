<?php
get_header();
?>



<main id="site-main">

  <section class='container '>
    <header class='mb-4'>
      <h1 class="h3">
        <span class="h3"><?php _e('Archiwum - ', 'candyweb'); ?></span>
        <?php echo the_archive_title(); ?>
      </h1>
    </header>

    <?php

    get_template_part('loops/index-loop');

    ?>
  </section>
</main>

<?php
get_footer();
?>