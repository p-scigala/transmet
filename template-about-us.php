<?php /* Template Name: O firmie */ ?>

<?php get_header();  ?>

<main id="page-o-firmie">
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>

  <?php 
        get_template_part( 'template-parts/text-and-image', 'page' );
        get_template_part( 'template-parts/in-numbers', 'page' );
        get_template_part( 'template-parts/text-and-image-2', 'page' );
        get_template_part( 'template-parts/text-and-logos', 'page' );
        get_template_part( 'template-parts/contact', 'page' );
     ?>
</main>

<?php get_footer();  ?>