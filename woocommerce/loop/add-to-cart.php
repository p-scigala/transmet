<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$aria_describedby = isset( $args['aria-describedby_text'] ) ? sprintf( 'aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr( $product->get_id() ) ) : '';

echo apply_filters(
	'woocommerce_loop_add_to_cart_link',
	sprintf(
		'<div><a href="%s" %s data-quantity="%s" class="%s btn--add position-relative" %s>%s</a></div>',
		esc_url( $product->add_to_cart_url() ),
		$aria_describedby,
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		'<span>
			<svg xmlns="http://www.w3.org/2000/svg" width="15.964" height="18.86" viewBox="0 0 15.964 18.86">
  			<path d="M418.269,280.1h-1.222a1.61,1.61,0,0,0-1.606,1.5l-.788,11.04a1.61,1.61,0,0,0,1.606,1.725H429a1.61,1.61,0,0,0,1.606-1.725l-.788-11.04a1.61,1.61,0,0,0-1.606-1.5H427v-.23a4.37,4.37,0,0,0-4.37-4.37,4.3,4.3,0,0,0-4.37,4.37c0,.076.006.153.009.23ZM427,281.48v3.45a.69.69,0,1,1-1.38,0v-3.45h-5.98v3.45a.69.69,0,1,1-1.38,0s.06-1.612.04-3.45h-1.254a.23.23,0,0,0-.229.213l-.789,11.04a.23.23,0,0,0,.23.247H429a.23.23,0,0,0,.229-.247l-.789-11.04a.23.23,0,0,0-.229-.213Zm-1.38-1.38v-.23a2.99,2.99,0,1,0-5.98,0v.23Z"
    			transform="translate(-414.648 -275.5)" fill="#fff" fill-rule="evenodd" />
			</svg>
		</span>'
	),
	$product,
	$args
);

?>
<?php if ( isset( $args['aria-describedby_text'] ) ) : ?>
<span id="woocommerce_loop_add_to_cart_link_describedby_<?php echo esc_attr( $product->get_id() ); ?>"
  class="screen-reader-text">
  <?php echo esc_html( $args['aria-describedby_text'] ); ?>
</span>
<?php endif; ?>