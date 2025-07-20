<?php /* Template Name: Refundacje */ ?>

<?php get_header();  ?>

<main id="page-refunds">

  <?php if ( have_rows('refunds_template') ) : ?>
  <?php while ( have_rows('refunds_template') ) : the_row(); ?>

  <?php
  $layout = get_row_layout();

  if ( $layout === 'refunds_text_and_imgs' ) {
    get_template_part( 'template-parts/text-and-img', 'text-and-img' );
  }
  
  if ( $layout === 'refunds_steps_list' ) {
    get_template_part( 'template-parts/steps', 'steps' );
  }
  ?>

  <?php endwhile; ?>
  <?php endif; ?>

  <?php get_template_part( 'template-parts/ask', 'page' ); ?>

  <?php get_template_part( 'template-parts/faq', 'page' ); ?>

</main>

<?php get_footer();  ?>