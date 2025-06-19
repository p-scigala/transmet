<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */
?>


<article role="article" id="post_<?php the_ID() ?>" <?php post_class("post-card card h-100 position-relative"); ?>>
  <div class='post-card-category position-absolute z-2 top-0 start-0 p-2 d-flex gap-2 flex-wrap'>
    <?php
    $categories = get_the_category();
    // display all post categories
    foreach ($categories as $category) {
      echo '<a class="badge bg-primary text-decoration-none text-white" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
    }
    ?>
  </div>
  <div class='post-card-image'>
    <?php the_post_thumbnail(); ?>
  </div>
  <section class='card-body d-flex flex-column'>
    <div class='post-card-meta text-body-tertiary mb-2 d-flex justify-content-between'>
      <div class='post-card-meta-date'>
        <time class='post-card-meta-date-time' datetime='<?php echo get_the_date('c'); ?>'>
          <?php echo get_the_date('d.m.y'); ?>
        </time>
      </div>
      <div class='post-card-meta-author'>
        <?php _e('Autor: ', 'candyweb'); ?>
<a class='position-relative z-2' href='<?php echo get_author_posts_url($post->post_author); ?>'>
          <?php
          echo get_the_author_meta('display_name', $post->post_author);
          ?>
        </a>
      </div>
    </div>
    <h2 class="card-title h4 mb-3">
      <a class='' href="<?php the_permalink(); ?>">
        <?php the_title() ?>
      </a>
    </h2>
    <div class='card-text text-body-secondary'>
      <?php if (has_excerpt($post->ID)) {
        the_excerpt();
      } ?>
    </div>
    <div class='mt-auto'>
      <a href='<?php the_permalink(); ?>' class='btn btn-primary position-relative z-2'><?php _e('Czytaj więcej', 'candyweb'); ?></a>
    </div>
  </section>


  <a href='<?php the_permalink(); ?>' class='stretched-link'></a>
</article>
