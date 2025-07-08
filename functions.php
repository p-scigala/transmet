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
    $custom_html = str_replace(
        '>',
        '><span>',
        $html
    );
    $custom_html = str_replace(
        '<',
        '</span><',
        $custom_html
    );

    return $custom_html;
}