<?php
/*
 * All the functions are in the PHP files in the `functions/` folder.
 */

if (!defined('ABSPATH')) {
  exit;
}
require_once get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/widgets.php';
require_once get_template_directory() . '/functions/enqueues.php';
require_once get_template_directory() . '/functions/helpers.php';
require_once get_template_directory() . '/functions/custom_functions.php';
require_once get_template_directory() . '/lib/CF7BootstrapInputs.php';

add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
function jk_dequeue_styles($enqueue_styles)
{
  unset($enqueue_styles['woocommerce-general']);  // Remove the gloss
  unset($enqueue_styles['woocommerce-layout']);    // Remove the layout
  unset($enqueue_styles['woocommerce-smallscreen']);  // Remove the smallscreen optimisation
  return $enqueue_styles;
}

// Gdyby coś nie działało w cf7 -> zakomentować
$cf7BootstrapInputs = new CF7BootstrapInputs();
$cf7BootstrapInputs->init();

add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_add_span_inside_add_to_cart', 10, 3 );

function custom_add_span_inside_add_to_cart( $html, $product, $args ) {
    // Example: insert <span class="custom-span">🔥</span> after the text inside the <a>
    // Original $html is something like:
    // <a href="..." class="button add_to_cart_button">Add to cart</a>

    // Find the closing tag > and insert span after it
    $custom_html = str_replace('>', '><span>', $html);
    $custom_html = str_replace('<', '</span><', $custom_html);

    return $custom_html;
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script(
        'ajax-add-to-cart',
        '/wp-content/themes/candyweb-new/assets/js/addToCart.js',
        ['jquery'],
        '1.0',
        true
    );
    wp_localize_script('ajax-add-to-cart', 'AjaxCart', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-add-to-cart')
    ]);
});

add_action('wp_ajax_add_to_cart', 'add_to_cart_callback');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_callback');

function add_to_cart_callback() {
    check_ajax_referer('ajax-add-to-cart', 'nonce');

    $product_id = absint($_POST['product_id'] ?? 0);
    $quantity = absint($_POST['quantity'] ?? 1);

    if ($product_id > 0 && WC()->cart) {
        $added = WC()->cart->add_to_cart($product_id, $quantity);

        if ($added) {
            // Return new cart fragments to update mini cart, etc.
            WC_AJAX::get_refreshed_fragments();
        } else {
            wp_send_json_error(['message' => 'Could not add to cart.']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid product.']);
    }

    wp_die();
}

add_action('wp_ajax_get_cart_count', 'get_cart_count_callback');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count_callback');

function get_cart_count_callback() {
    // Get total items in cart
    $count = WC()->cart->get_cart_contents_count();
    wp_send_json_success(['count' => $count]);
}