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
