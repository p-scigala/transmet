<?php
/*
 * The Search Results (Main Header and) Loop
 */
?>



<header class="mb-4">
  <h1 class="h3 text-center">
    <?php _e('Wyniki wyszukiwania: ', 'candyweb'); ?> &ldquo;<?php the_search_query(); ?>&rdquo;
  </h1>
</header>

<main id='site-main'>
  <section class="container pb-5 entry-content cms-text">
    <div class="row gy-5">
      <?php if (have_posts()) :
        while (have_posts()) : the_post(); ?>
          <div class='col-12 col-md-6 col-lg-4'>
            <?php if (get_post_type() == 'post') : ?>

              <?php get_template_part('loops/index-post'); ?>

            <?php else : ?>
              <article role="article" id="post_<?php the_ID() ?>" <?php post_class() ?>>
                <header class="entry-header">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
                </header>
                <section class="entry-content cms-text">
                  <?php the_excerpt(); ?>
                </section>
              </article>
            <?php endif; ?>
          </div>
        <?php endwhile;
      else : ?>
        <div class="col-12 cms-text">
          <div class="d-flex align-items-center justify-content-center col-md-8 offset-md-2">
            <div class="text-center">
              <h1 class="fs-2">Brak wyników wyszukiwania</h1>
              <p class="fs-5"> <span class="text-danger"><?php _e('Ups!', 'candyweb'); ?></span><?php _e(' Nie znaleźliśmy nic co mogłoby pasować do szukanego wyrażenia.', 'candyweb'); ?></p>


              <p class="lead mt-5">
                <?php _e('Spróbuj wyszukać inną frazę.', 'candyweb'); ?>
              </p>
              <?php get_search_form(); ?>

              <p class='lead mt-5'>
                <?php _e('Lub wróc do strony głównej.', 'candyweb'); ?>
              </p>
              <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
                <?php _e('Powrót do strony głównej', 'candyweb'); ?>
              </a>

            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

</main>