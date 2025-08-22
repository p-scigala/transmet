<?php
get_header(); ?>
<main id="error-404" class='container error-404'>
  <section class="page-not-found">
    <div class="d-flex align-items-center justify-content-center col-md-8 offset-md-2">
      <div class="text-center">
        <h1 class="fs-2 mb-4">404</h1>
        <p class="fs-5"> <span
            class="text-danger"><?php _e('Ups!', 'candyweb'); ?></span><?php _e(' Strona nie została znaleziona.'); ?>
        </p>
        <p class="lead">
          <?php _e('Przepraszamy, ale strona, której szukasz, nie istnieje lub została przeniesiona.', 'candyweb'); ?>
        </p>
        <div class="error-404__link">
          <a href="<?php echo home_url(); ?>" class="btn">
            <?php _e('<span>Powrót do strony głównej</span>', 'candyweb'); ?>
          </a>
        </div>
      </div>
    </div>

  </section>
</main>
<?php get_footer(); ?>