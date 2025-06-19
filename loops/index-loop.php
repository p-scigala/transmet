<?php
/*
 * The Default Loop (used by index.php, category.php, tag.php, archive.php and author.php)
 * =================================================================
 * If you require only post excerpts to be shown in index and category pages, 
 * use the [---more---] block within blog posts.
 */
?>

<?php if (have_posts()) : ?>
  <div class="row gy-30">
    <?php foreach ($posts as $index => $post) : setup_postdata($post); ?>
      <div class="col-12 col-md-6 col-lg-4">
        <?php get_template_part('loops/index-post', get_post_format()); ?>
      </div>
    <?php endforeach;
    wp_reset_postdata(); ?>
  </div>
  <div class="row my-5">
    <div class="col-12">
      <?php if (function_exists('wp_pagenavi')) : ?>
        <?php wp_pagenavi(); ?>
      <?php else : ?>
        <div class="pagination">
          <div class="nav-previous alignleft"><?php next_posts_link(__('&larr; Starsze wpisy', 'candyweb')); ?></div>
          <div class="nav-next alignright"><?php previous_posts_link(__('Nowsze wpisy &rarr;', 'candyweb')); ?></div>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php else :
  get_template_part('loops/404');
endif; ?>