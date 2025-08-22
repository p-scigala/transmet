<?php /* Template Name: Kontakt */ ?>

<?php get_header();  ?>

<main id="page-contact">
  <?php get_template_part('template-parts/breadcrumb'); ?>

  <?php get_template_part( 'template-parts/contact', 'page' ); ?>
  <?php get_template_part( 'template-parts/map', 'page' ); ?>
</main>

<?php get_footer();  ?>