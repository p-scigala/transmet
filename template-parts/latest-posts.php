<?php

$current_post_id = get_the_ID();
$args = array(
    'limit' => 3,
    'post__not_in' => array($current_post_id),
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish'
);

$latest_posts = new WP_Query($args);

if ($latest_posts->have_posts()) : ?>


    <section class='py-5'>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <h2 class="h3 text-center mb-4"><?php _e('Ostatnie wpisy', 'candyweb'); ?></h2>
                </div>
            </div>

            <div class="row gy-5 justify-content-center">
                <?php foreach ($latest_posts->posts as $index => $post) : ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <?php get_template_part('loops/index-post'); ?>
                    </div>
                <?php
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

<?php endif; ?>