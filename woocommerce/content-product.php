<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
  <?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	// do_action( 'woocommerce_after_shop_loop_item' );
  ?>

  <div class="product__quantity">
    <div class="input__number">

      <!-- <label for="quantity-<?php echo esc_attr( $product->get_id() ); ?>">
      <?php esc_html_e( 'Quantity', 'woocommerce' ); ?>
    </label> -->

      <button type="button" class="input__number-minus"
        aria-label="<?php esc_attr_e( 'Decrease quantity', 'woocommerce' ); ?>">
        <span class="dashicons dashicons-minus"></span>
      </button>

      <input type="number" id="quantity-<?php echo esc_attr( $product->get_id() ); ?>" class="input__number-text"
        name="quantity" value="1" min="1" step="1"
        aria-labelledby="quantity-<?php echo esc_attr( $product->get_id() ); ?>-label" />

      <button type="button" class="input__number-plus"
        aria-label="<?php esc_attr_e( 'Increase quantity', 'woocommerce' ); ?>">
        <span class="dashicons dashicons-plus"></span>
      </button>

      <script>
      document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.querySelector('#quantity-<?php echo esc_js( $product->get_id() ); ?>');
        const minusButton = quantityInput.previousElementSibling;
        const plusButton = quantityInput.nextElementSibling;

        minusButton.addEventListener('click', function() {
          let currentValue = parseInt(quantityInput.value, 10);
          if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
          }
        });

        plusButton.addEventListener('click', function() {
          let currentValue = parseInt(quantityInput.value, 10);
          quantityInput.value = currentValue + 1;
        });
      });
      </script>

    </div>
  </div>

  <div class="product__add-to-cart">
    <?php
    woocommerce_template_loop_add_to_cart(
      array(
        'class' => 'btn',
        'attributes' => array(
          'data-product_id' => $product->get_id(),
          'data-product_sku' => $product->get_sku(),
          'aria-label' => sprintf( __( 'Add %s to your cart', 'woocommerce' ), $product->get_name() ),
          'rel' => 'nofollow',
        ),
        'quantity' => 1, // Default quantity set to 1
        'type' => 'button', // Use button type for better accessibility
        'text' => 'Do koszyka',
        'text_disabled' => 'Brak na stanie',
        'text_no_stock' => 'Brak na stanie',
        'class_add_to_cart' => 'btn btn--add-to-cart',
        'class_added_to_cart' => 'btn btn--added-to-cart',
        'class_out_of_stock' => 'btn btn--out-of-stock',
        'class_disabled' => 'btn btn--disabled',
        'class_no_stock' => 'btn btn--no-stock',
        'class_on_backorder' => 'btn btn--on-backorder',
        'class_in_stock' => 'btn btn--in-stock',
        'class_available' => 'btn btn--available',
        'class_unavailable' => 'btn btn--unavailable',
      )
    );
    ?>
  </div>
</li>