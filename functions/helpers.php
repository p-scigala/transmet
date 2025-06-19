<?php

/**
 * Get an HTML img element representing an image attachment
 *
 * returns wp_get_attachment_image without a srcset
 * @param int          $attachment_id Image attachment ID.
 * @param string|array $size          (Optional)
 * @param bool         $icon          (Optional)
 * @param string|array $attr          (Optional)
 * @return string      HTML img element or empty string.
 */
function wp_get_attachment_image_no_srcset($attachment_id, $size = 'thumbnail', $icon = false, $attr = '')
{
  // add a filter to return null for srcset
  add_filter('wp_calculate_image_srcset_meta', '__return_null');
  // get the srcset-less img html
  $html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);
  // remove the above filter
  remove_filter('wp_calculate_image_srcset_meta', '__return_null');
  return $html;
}

/**
 * It takes a directory name as an argument, scans the directory for files, and returns an array of
 * file paths and file types.
 * 
 * @param font_directory_name The name of the directory where your fonts are stored.
 * 
 * @return An array of arrays.
 */
function get_fonts_to_preload($font_directory_name)
{
  // list only files in directory
  $files = array_diff(scandir(get_template_directory() . '/assets/fonts/' . $font_directory_name), array('..', '.'));

  if (empty($files)) return;

  foreach ($files as $file) {
    $file_path = get_template_directory_uri() . '/assets/fonts/' . $font_directory_name . '/' . $file;
    $file_type = pathinfo($file_path, PATHINFO_EXTENSION);
    $results[] = array(
      'link' => $file_path,
      'as' => 'font',
      'type' => 'font/' . $file_type
    );
  }
  return $results;
}


/**
 * It's a function that takes a variable as an argument and outputs it in a readable format.
 * 
 * @param var The variable to dump.
 */
function pvd($var)
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}


/**
 * It adds a header to the HTTP response that tells the browser to preload the assets.
 */
// add_action('send_headers', 'add_priority_hints');
function add_priority_hints()
{
  $assets = array(
    array(
      'link' => get_template_directory_uri() . '/assets/css/style.css',
      'as' => 'style'
    ),
    array(
      'link' => get_template_directory_uri() . '/assets/js/main.js',
      'as' => 'script'
    ),
  );
  $filter_assets = apply_filters('candy_priority_hints_headers_filter', $assets);


  foreach ($filter_assets as $asset) {
    header('Link: <' . $asset['link'] . '>; rel=preload; as=' . $asset['as'] . ';', false);
  }
}


/**
 * It adds a preload hint to the head of the document for each asset in the  array.
 */
add_action('wp_head', 'add_preload_hints', 1);
function add_preload_hints()
{
  $assets = array(
    array(
      'link' => get_template_directory_uri() . '/assets/css/style.css',
      'as' => 'style'
    ),
  );
  $filter_assets = apply_filters('candy_head_preload_hints_filter', $assets);


  foreach ($filter_assets as $asset) {

    echo '<link rel="preload" href="' . $asset['link'] . '" as="' . $asset['as'] . '"  crossorigin>';
  }
}

/**
 * It adds the fonts to the preload list.
 * 
 * @param assets array of assets to preload
 * 
 * @return An array of font files to preload.
 */
add_filter('candy_head_preload_hints_filter', 'add_fonts_to_preload');
function add_fonts_to_preload($assets)
{
  return array_merge($assets, get_fonts_to_preload('poppins'));
}




/* It's a function that adds a page to the admin panel. */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'   => 'Opcje motywu',
    'menu_title'  => 'Opcje motywu',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}




/**
 * It adds support for post thumbnails, excerpts, and woocommerce, etc.
 */
add_action('after_setup_theme', 'handle_after_theme_setup');
function handle_after_theme_setup()
{
  add_theme_support('post-thumbnails');
  add_theme_support('custom-logo', array('height' => 150, 'width' => 450, 'flex-height' => true, 'flex-width' => true));
  add_post_type_support('page', 'excerpt');
  add_theme_support('title-tag');


  // Check if WooCommerce is active
  if (class_exists('WooCommerce')) {
    add_theme_support('woocommerce');
  }



  // image sizes
  add_image_size('size-320', 320, 320);
  add_image_size('size-640', 640, 640);
  add_image_size('size-1280', 1280, 1280);
  add_image_size('size-1600', 1600, 1600);
  add_image_size('size-1920', 1920, 1920);

  // Menus
  register_nav_menu('navbar', __('Menu główne', 'candyweb'));
  register_nav_menu('footer', __('Menu stopka', 'candyweb'));
}


/**
 * Load svg file from images folder as svg tag
 * @param string $filename - filename with extension
 * @param array|null $args - array of additional arguments
 *
 * @return false
 */
function get_svg(string $filename, array $args = null)
{
  $file_path = get_template_directory() . '/assets/images' . $filename;
  $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

  if (!file_exists($file_path)) return new Exception('File does not exist');
  if ($file_extension !== 'svg') return new Exception('File is not SVG');

  $svg = file_get_contents(get_template_directory() . '/assets/images' . $filename);
  if ($args) {
    $dom = new DOMDocument();
    $dom->loadHTML($svg, LIBXML_NOERROR);

    foreach ($dom->getElementsByTagName('svg') as $item) {
      foreach ($args as $key => $value) {
        $item->setAttribute($key, $value);
      }
    }
    $dom->saveHTML();
    $svg = $dom->saveHTML();
  }

  return $svg;
}


/**
 * @param string $filename
 * @param array|null $args
 *
 * @return void
 */
function the_svg(string $filename, array $args = null)
{
  echo get_svg($filename, $args);
}


/**
 * Load svg from media library as svg tag
 * @param int $id
 * @param array|null $args
 *
 * @return false|string
 */
function get_svg_from_media(int $id, array $args = null)
{
  $file_path = get_attached_file($id);

  $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
  if (!file_exists($file_path)) return new Exception('File does not exist');
  if ($file_extension !== 'svg') return new Exception('File is not SVG');
  $svg = file_get_contents(get_attached_file($id));
  if ($args) {
    $dom = new DOMDocument();
    $dom->loadHTML($svg, LIBXML_NOERROR);

    foreach ($dom->getElementsByTagName('svg') as $item) {
      foreach ($args as $key => $value) {
        $item->setAttribute($key, $value);
      }
    }
    $dom->saveHTML();
    $svg = $dom->saveHTML();
  }
  return $svg;
}


/**
 * It takes an SVG file from the media library, and returns it as an inline SVG element
 * 
 * @param int id The media ID of the SVG you want to display.
 * @param array args
 */
function the_svg_from_media(int $id, array $args = null)
{
  echo get_svg_from_media($id, $args);
}



/**
 * It converts a graphic file into a base64 string.
 * 
 * @param string The url to the graphic you want to convert to base64.
 * 
 * @return string base64 encoded string of the image.
 */
function graphic_to_base64($url)
{
  $extension = pathinfo($url)['extension'];
  $media_type = "";

  switch ($extension) {
    case 'jpg':
      $media_type = "data:image/jpeg;charset=utf-8;base64,";
      break;

    case 'png':
      $media_type = "data:image/png;charset=utf-8;base64,";
      break;

    case 'svg':
      $media_type = "data:image/svg+xml;charset=utf-8;base64,";
      break;

    default:
      return $url;
      break;
  }

  $graphic_to_encode = file_get_contents($url);

  $result = base64_encode($graphic_to_encode);

  return $media_type . $result;
}


/* These are three functions added to WordPress to allow SVG files to be uploaded and used on the website. */
add_filter(
  'upload_mimes',
  function ($upload_mimes) {

    if (!current_user_can('administrator')) {
      return $upload_mimes;
    }
    $upload_mimes['svg']  = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
  }
);
add_filter(
  'wp_check_filetype_and_ext',
  function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {
    if (!$wp_check_filetype_and_ext['type']) {
      $check_filetype  = wp_check_filetype($filename, $mimes);
      $ext             = $check_filetype['ext'];
      $type            = $check_filetype['type'];
      $proper_filename = $filename;
      if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
        $ext  = false;
        $type = false;
      }
      $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
    }
    return $wp_check_filetype_and_ext;
  },
  10,
  5
);
add_action('admin_head', function () {
?>
  <style>
    .media-icon img[src$=".svg"] {
      width: 100%;
    }
  </style>
<?php
});


// Add duplicate button to post/page list of actions.
add_filter('post_row_actions', 'candy_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'candy_duplicate_post_link', 10, 2);

if (!function_exists('candy_duplicate_post_link')) {
  /**
   * @param array   $actions The actions added as links to the admin.
   * @param WP_Post $post The post object.
   *
   * @return array
   */
  function candy_duplicate_post_link($actions, $post)
  {

    // Don't add action if the current user can't create posts of this post type.
    $post_type_object = get_post_type_object($post->post_type);

    if (null === $post_type_object || !current_user_can($post_type_object->cap->create_posts)) {
      return $actions;
    }


    $url = wp_nonce_url(
      add_query_arg(
        array(
          'action'  => 'candy_duplicate_post',
          'post_id' => $post->ID,
        ),
        'admin.php'
      ),
      'candy_e_post_' . $post->ID,
      'candy_e_nonce'
    );

    $actions['candy_e'] = '<a href="' . $url . '" title="' . __("Duplikuj post", "candyweb") . '" rel="permalink">' . __("Duplikuj", "candyweb") . '</a>';

    return $actions;
  }
}


add_action('admin_action_candy_duplicate_post', function () {

  if (empty($_GET['post_id'])) {
    wp_die('No post id set for the duplicate action.');
  }

  $post_id = absint($_GET['post_id']);

  // Check the nonce specific to the post we are duplicating.
  if (!isset($_GET['candy_e_nonce']) || !wp_verify_nonce($_GET['candy_e_nonce'], 'candy_e_post_' . $post_id)) {
    // Display a message if the nonce is invalid, may it expired.
    wp_die('The link you followed has expired, please try again.');
  }

  // Load the post we want to duplicate.
  $post = get_post($post_id);

  // Create a new post data array from the post loaded.
  if ($post) {
    $current_user = wp_get_current_user();
    $new_post     = array(
      'comment_status' => $post->comment_status,
      'menu_order'     => $post->menu_order,
      'ping_status'    => $post->ping_status,
      'post_author'    => $current_user->ID,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title . ' (copy)', // Add "(copy)" to the title.
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
    );
    // Create the new post
    $duplicate_id = wp_insert_post($new_post);
    // Copy the taxonomy terms.
    $taxonomies = get_object_taxonomies(get_post_type($post));
    if ($taxonomies) {
      foreach ($taxonomies as $taxonomy) {
        $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
        wp_set_object_terms($duplicate_id, $post_terms, $taxonomy);
      }
    }
    // Copy all the custom fields.
    $post_meta = get_post_meta($post_id);
    if ($post_meta) {

      foreach ($post_meta as $meta_key => $meta_values) {
        if ('_wp_old_slug' === $meta_key) { // skip old slug.
          continue;
        }
        foreach ($meta_values as $meta_value) {
          add_post_meta($duplicate_id, $meta_key, $meta_value);
        }
      }
    }

    // Refresh the post list to show updated post.
    wp_safe_redirect(admin_url('edit.php?post_type=' . $post->post_type));
    exit;
  } else {
    wp_die('Error loading post for duplication, please try again.');
  }
});
