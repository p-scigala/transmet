<?php
get_header(); ?>
<main class='container'>
    <section class="page-not-found">
        <div class="d-flex align-items-center justify-content-center col-md-8 offset-md-2">
            <div class="text-center">
                <h1 class="fs-2">404</h1>
                <p class="fs-5"> <span class="text-danger"><?php _e('Ups!', 'candyweb'); ?></span><?php _e(' Strona nie została znaleziona.'); ?></p>
                <p class="lead">
                    <?php _e('Przepraszamy, ale strona, której szukasz, nie istnieje lub została przeniesiona.', 'candyweb'); ?>
                </p>
                <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                    <?php _e('Powrót do strony głównej', 'candyweb'); ?>
                </a>
            </div>
        </div>

    </section>
</main>
<?php get_footer(); ?>