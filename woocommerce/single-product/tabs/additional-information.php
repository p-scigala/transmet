<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// $heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );
// $heading = "Dane techniczne"; // Custom heading for additional information
$heading = "";
?>

<?php if ( $heading ) : ?>
	<h2 class="tab__heading"><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>

<?php
// add safety info
  $product_id = $product->get_id();

  if(get_field('product_safety_info', $product_id)) {
      echo get_field('product_safety_info', $product_id);
  } else {
      echo '<p>Brak informacji o bezpieczeństwie produktu.</p>';
  }
?>

<?php //do_action( 'woocommerce_product_additional_information', $product ); ?>
