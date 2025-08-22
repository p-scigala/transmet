<?php /* Template Name: Strona główna */ ?>

<?php get_header();  ?>

<main id="page-home">
  <?php 
        get_template_part( 'template-parts/hero', 'page' );
        get_template_part( 'template-parts/bestsellers', 'page', array( 'id' => 'polecane' ) );
        get_template_part( 'template-parts/categories', 'page' );
        get_template_part( 'template-parts/text-and-logos', 'page', array( 'id' => 'producenci' ) );
        get_template_part( 'template-parts/text-and-image', 'page' );
        get_template_part( 'template-parts/newest-products', 'page' );
        get_template_part( 'template-parts/why-worth', 'page' );
        get_template_part( 'template-parts/faq', 'page' );
        get_template_part( 'template-parts/contact', 'page' );
     ?>
</main>

<?php get_footer();  ?>