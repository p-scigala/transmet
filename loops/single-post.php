<?php
/*
 * The Single Post
 */
?>

<?php if (have_posts()) :
  while (have_posts()) :
    the_post(); ?>
    <article role="article" id="post_<?php the_ID() ?>" <?php post_class("entry-content") ?>>
      <header class="container">
        <div class="index-post-category mb-2 text-muted">
          <?php the_category(''); ?>
        </div>
        <h1 class="h2"><?php the_title() ?></h1>
        <p class="">
          <time class="text-body-secondary" datetime="<?php echo get_the_date('c'); ?>">
            <?php echo get_the_date('d.m.Y'); ?>
          </time>
        </p>
      </header>
      <section class="container">
        <div class="single-thumbnail-wrapper">
          <?php the_post_thumbnail(); ?>

        </div>
      </section>

      <?php wp_link_pages(); ?>

      <section class="single-post-content container">
        <?php the_content(); ?>
      </section>

      <?php wp_link_pages(); ?>
    </article>

    <?php if (has_tag()) { ?>
      <section class='single-post-tags'>
        <div class="container">
          <div class="d-flex flex-column justify-content-center align-items-start fs-5 fw-bold">
            <?php the_tags(__('Tagi: ', 'candyweb'), ', '); ?>

          </div>
        </div>
      </section>

    <?php }; ?>





    <?php
    // This continues in the single post loop
    if (comments_open() || get_comments_number()) :

      //comments_template();
      comments_template('/loops/single-post-comments.php');

    endif;
    ?>


    <?php get_template_part('template-parts/latest-posts'); ?>



<?php
  endwhile;
else :
  get_template_part('loops/404');
endif;
?>