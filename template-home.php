<?php /* Template Name: Strona główna */ ?>

<?php get_header();  ?>

<main id="page-home">
    <?php 
        get_template_part( 'template-parts/home-hero', 'page' );
        get_template_part( 'template-parts/text-and-img', 'page' );
        get_template_part( 'template-parts/categories', 'page' );
        get_template_part( 'template-parts/text-and-img', 'page' );
        get_template_part( 'template-parts/text-and-logos', 'page' );
        get_template_part( 'template-parts/faq', 'page' );
     ?>
</main>

<?php get_footer();  ?>