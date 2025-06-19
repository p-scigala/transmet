<?php
/*
 * The Page Content Loop
 */
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article role="article" id="post_<?php the_ID() ?>" <?php post_class("mb-5") ?>>
      <header class="mb-4">
        <h1 class="h3">
          <?php the_title() ?>
        </h1>
      </header>
      <section class="pb-5 entry-content cms-text">
        <?php the_content() ?>
        <?php wp_link_pages(); ?>
      </section>
    </article>
<?php
  endwhile;
else :
  get_template_part('loops/404');
endif;
?>