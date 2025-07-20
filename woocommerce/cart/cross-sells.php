<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) :

	// Przetasowanie tablicy produktów cross-sell
	shuffle( $cross_sells );

	// Ograniczenie do maksymalnie 2 produktów
	$cross_sells = array_slice( $cross_sells, 0, 2 );
?>
<div class="col-12 col-md-10 col-lg-8 col-xl-6 offset-0 offset-md-1 offset-lg-2 offset-xl-0">
	<div class="cross-sells">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2 class="cross-sells__title mb-30 text-center text-xl-start"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] = $post_object );

					wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
</div>
<?php
endif;

wp_reset_postdata();
