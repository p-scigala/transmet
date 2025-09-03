<?php
/*
 * The Page Content Loop
 */
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<article role="article" id="post_<?php the_ID() ?>">
  <div class="wrapper">

    <h1 class="page-title"><?php the_title() ?></h1>

    <section>
      <?php the_content() ?>
      <?php wp_link_pages(); ?>
    </section>
    
  </div>
</article>
<?php
  endwhile;
else :
  get_template_part('loops/404');
endif;
?>