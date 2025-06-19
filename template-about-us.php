<?php /* Template Name: O nas */ ?>

<?php get_header();  ?>

<main id="page-about-us">
    <?php 
        get_template_part( 'template-parts/text-and-img', 'page' );
        get_template_part( 'template-parts/team', 'page' );
     ?>
</main>

<?php get_footer();  ?>