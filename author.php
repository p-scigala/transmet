<?php
$userInfo = get_userdata(get_query_var('author'));
$isAuthor = true;
if (
  !in_array('contributor', $userInfo->roles) &&
  !in_array('administrator', $userInfo->roles) &&
  !in_array('author', $userInfo->roles) &&
  !in_array('editor', $userInfo->roles)
) {
  $isAuthor = false;
  wp_redirect(esc_url(home_url()) . '/404', 404);
}
?>
<?php
get_header();
?>

<main id="site-main">

  <section class='container '>

    <?php if ($isAuthor === true) : ?>
      <header class='mb-4'>
        <h1 class="h3">
          <span class="h3"><?php _e('Posty użytkownika - ', 'candyweb'); ?></span>
          <?php echo get_the_author_meta('display_name'); ?>
        </h1>
      </header>
    <?php endif; ?>

    <?php
    if (have_posts()) :
      get_template_part('loops/index-loop');
    else :
      get_template_part('loops/index-none');
    endif;
    ?>
  </section>
</main>

<?php
get_footer();
?>