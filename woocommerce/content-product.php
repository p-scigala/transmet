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
  <div class="product__statuses">

    <?php
    // New product badge (published in last 30 days)
    $days = 30;
    $postdate = get_the_time( 'U', $product->get_id() );
    $now = strtotime( 'now' );
    $diff = ( $now - $postdate ) / DAY_IN_SECONDS;
    if ( $diff < $days ) : ?>
    <span class="product__new">Nowość</span>
    <?php endif; ?>

    <?php
      // also display it in newest products section if it match x newest items even if they are older than 30 days
      $category = isset($args['category']) ? $args['category'] : '';
      if ( $category ): ?>
    <span class="product__new">Nowość</span>
    <?php endif; ?>

    <?php // Bestseller badge ?>
    <?php if ( has_term( 'featured', 'product_visibility', $product->get_id() ) ) : ?>
    <span class="product__featured">Bestseller</span>
    <?php endif; ?>

    <?php // On sale badge ?>
    <?php if ( $product && $product->is_on_sale() ) : ?>
    <?php wc_get_template( 'loop/sale-flash.php' ); ?>
    <?php endif; ?>

  </div>

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

  <?php if ( shortcode_exists( 'wc_price_history' ) ) : ?>
  <div class="product__lowest-price">
    Najniższa cena sprzed 30 dni:&nbsp;<?php echo do_shortcode('[wc_price_history]'); ?>
  </div>
  <?php endif; ?>
  </a>

  <div class="product__bottom">

    <div class="product__quantity">
      <div class="input__number">

        <button type="button" class="input__number-minus"
          aria-label="<?php esc_attr_e( 'Decrease quantity', 'woocommerce' ); ?>">
          -
        </button>

        <input type="number" id="quantity-<?php echo esc_attr($product->get_id()); ?>"
          class="input__number-text input--quantity" name="quantity" value="1" min="1" step="1"
          aria-labelledby="quantity-<?php echo esc_attr($product->get_id()); ?>-label" />

        <button type="button" class="input__number-plus"
          aria-label="<?php esc_attr_e( 'Increase quantity', 'woocommerce' ); ?>">
          +
        </button>
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
  </div>

</li>