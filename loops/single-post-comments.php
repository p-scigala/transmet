<?php
/*
 * Custom Feedback
 * ===============
 * https://codex.wordpress.org/Function_Reference/wp_list_comments#Comments_Only_With_A_Custom_Comment_Display
*/

function b5st_comment($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);
  if ('div' == $args['style']) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>

  <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body alert alert-primary text-body">
      <?php endif; ?>

      <div class="comment-author vcard d-flex">
        <div class="pe-3">
          <?php echo get_avatar($comment->comment_author_email, $size = '52', '', '', array('class' => 'rounded-circle')); ?>
        </div>
        <div>
          <p class="h3"><?php comment_author(); ?></p>
          <p class="comment-meta commentmetadata text-body-secondary"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php printf('%1$s ' . __('-', 'b5st') . ' %2$s', get_comment_date('d.m.Y'), get_comment_time()) ?></a></p>
          <?php if ($comment->comment_approved == '0') : ?>
            <p class="comment-awaiting-moderation text-body-secondary"><?php _e('Twój komentarz czeka na zatwierdzenie przez moderatora.', 'candyweb') ?></p>
          <?php endif; ?>
        </div>
      </div>

      <div class='comment-content'>
        <?php comment_text() ?>
      </div>

      <div class="reply">
        <p>
          <?php comment_reply_link(
            array_merge($args, array(
              'add_below' => $add_below,
              'reply_text' => __('Odpowiedz', 'candyweb'),
              'depth' => $depth,
              'max_depth' => $args['max_depth']
            ))
          ); ?>
          <?php edit_comment_link('<span class="btn btn-secondary btn-sm">' . __('Edytuj', 'candyweb') . '</span>', ' ', ''); ?>
        </p>
      </div>

      <?php if ('div' != $args['style']) : ?>
      </div>
    <?php endif;
    }

    /**!
     * Custom Comments Form
     */

    // Do not delete this section
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
      die('Please do not load this page directly. Thanks!');
    }
    if (post_password_required()) { ?>
    <section id="post-comments">
      <div class="container">
        <div class="alert alert-warning">
          <?php _e('Ten post jest chroniony hasłem. Wprowadź hasło aby zobaczyć komentarze.', 'candyweb'); ?>
        </div>
      </div>
    </section>
  <?php
      return;
    } // End do not delete section

    if (have_comments()) : ?>

    <secion id="post-comments">
      <div class="container">
        <h3 class="mt-5 mb-3">
          <?php printf(
            /* translators: 1: title. */
            esc_html__('Komentarze', 'candyweb'),
            '<span>' . get_the_title() . '</span>'
          ); ?>
        </h3>

        <p><?php
            $comment_count = get_comments_number();
            _e('Ilość komentarzy: ', 'candyweb');
            echo $comment_count;
            ?>
        </p>

        <ul class="comment-list list-unstyled">
          <?php wp_list_comments('type=comment&callback=b5st_comment'); ?>
        </ul><!-- /.comment-list -->

        <p class="text-muted">
          <?php paginate_comments_links(); ?>
        </p>
      </div>
      </section>
    <?php
    else :
      if (comments_open()) :
        echo '<section id="post-comments"><div class="container"><p class="alert alert-primary mt-5">' . __('Bądź pierwszą osobą, która skomentuje!', 'candyweb') . '</p></div></section>';
      else :
        echo '<section id="post-comments"><div class="container"><p class="alert alert-primary">' . __('Komentarze są wyłączone.', 'candyweb') . '</p></div></section>';
      endif;
    endif;
    ?>

    <?php if (comments_open()) : ?>
      <section id="respond" class="py-3">
        <div class="container ">
          <div class="row">
            <div class="col-md-8 col-lg-6 col-xxl-4">
              <div class='bg-light border rounded-2 p-3'>
                <p class="h4"><?php comment_form_title(__('Skomentuj', 'candyweb'), __('Odpowiadasz %s', 'candyweb')); ?></p>
                <p><?php cancel_comment_reply_link(); ?></p>
                <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                  <p><?php printf(__('Musisz być <a class="link-primary" href="%s">zalogowany</a> aby skomentować wpis.', 'candyweb'), wp_login_url(get_permalink())); ?></p>
                <?php else : ?>

                  <form action="<?php echo site_url('/wp-comments-post.php') ?>" method="post" id="commentform">

                    <?php if (is_user_logged_in()) : ?>
                      <div class='d-flex flex-wrap justify-content-between align-items-center mb-3'>
                        <p class='mb-0'><?php printf(__('Zalogowano jako', 'candyweb') . ' <a class="text-decoration-underline link-primary" href="%s/wp-admin/profile.php">%s</a>', get_option('url'), $user_identity); ?></p>
                        <a class="btn btn-danger btn-sm" href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Wyloguj się z tego konta.', 'candyweb'); ?>"><?php echo __('Wyloguj', 'candyweb'); ?></a>
                      </div>
                    <?php else : ?>

                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="author" placeholder="<?php _e('Nickname', 'candyweb');
                                                                                            if ($req) echo '*'; ?>" id="comment-author" value="<?php echo esc_attr($comment_author); ?>" <?php if ($req) echo 'aria-required="true"'; ?>>
                        <label for="comment-author">
                          <?php _e('Nickname', 'candyweb');
                          if ($req) echo '*'; ?>
                        </label>
                      </div>


                      <div class="form-floating mb-3">
                        <input placeholder="<?php _e('Twój email', 'candyweb');
                                            if ($req) echo '*';
                                            ?>" type="email" class="form-control" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" <?php if ($req) echo 'aria-required="true"'; ?>>
                        <label for="email">
                          <?php _e('Twój email', 'candyweb');
                          if ($req) echo '*';
                          ?>
                        </label>
                        <p class='small text-body-tertiary'><?php _e('Nie zostanie opublikowany', 'candyweb'); ?></p>
                      </div>

                    <?php endif; ?>

                    <div class="form-floating mb-4">
                      <textarea placeholder="<?php _e('Treść komentarza', 'candyweb'); ?>" name="comment" class="form-control" id="comment" rows="12" aria-required="true"></textarea>
                      <label for="comment"><?php _e('Treść komentarza', 'candyweb'); ?></label>
                    </div>

                    <p><input name="submit" class="btn btn-primary" type="submit" id="submit" value="<?php _e('Skomentuj', 'candyweb'); ?>"></p>

                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                  </form>
                <?php endif; ?>

              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endif; ?>