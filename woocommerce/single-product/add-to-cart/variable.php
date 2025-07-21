<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart product__variant-form"
  action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
  method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>"
  data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
  <?php do_action( 'woocommerce_before_variations_form' ); ?>

  <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
  <p class="stock out-of-stock">
    <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?>
  </p>
  <?php else : ?>
  <table class="variations" cellspacing="0" role="presentation">
    <tbody>
      <?php foreach ( $attributes as $attribute_name => $options ) : ?>
      <tr>
        <!-- <th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label> -->

        <?php
								wc_dropdown_variation_attribute_options(
									array(
										'options' => $options,
										'attribute' => $attribute_name,
										'product' => $product,
										'class' => 'product-hero__select',
										'show_option_none' => 'Wybierz ' . $attribute_name
									)
								);
								
							?>
        </th>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <?php do_action( 'woocommerce_after_variations_table' ); ?>

  <div class="single_variation_wrap">
    <?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
  </div>
  <?php endif; ?>

  <?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<div class="single-product__info-panel-wrapper">
	<?php
		$prodData = get_field('product_info');
		$infoData = get_field('options_product_info', 'option');

		if($prodData['product_info_01']) {
			get_template_part("template-parts/components/info-panel", null, array(
  	    "title" => $infoData['options_product_info_01']['options_product_info_01_title'],
  	    "img" => $infoData['options_product_info_01']['options_product_info_01_img'],
				"text" => $infoData['options_product_info_01']['options_product_info_01_text'],
  	  ));
		}

		if($prodData['product_info_02']) {
			get_template_part("template-parts/components/info-panel", null, array(
  	    "title" => $infoData['options_product_info_02']['options_product_info_02_title'],
  	    "img" => $infoData['options_product_info_02']['options_product_info_02_img'],
				"text" => $infoData['options_product_info_02']['options_product_info_02_text'],
  	  ));
		}

		if($prodData['product_info_03']) {
			$months = substr($prodData['product_info_03_value'], -1);
			if($months === 1) $value = $prodData['product_info_03_value'] . ' miesiąc';
			if($months >= 2 && $months <= 4) $value = $prodData['product_info_03_value'] . ' miesiące';
			if($months >= 5) $value = $prodData['product_info_03_value'] . ' miesięcy';

			get_template_part("template-parts/components/info-panel", null, array(
  	    "title" => $infoData['options_product_info_03']['options_product_info_03_title'],
  	    "img" => $infoData['options_product_info_03']['options_product_info_03_img'],
				"text" => $infoData['options_product_info_03']['options_product_info_03_text'],
				"value" => $value
  	  ));
		}

		if($prodData['product_info_04']) {
			get_template_part("template-parts/components/info-panel", null, array(
    	  "title" => $infoData['options_product_info_04']['options_product_info_04_title'],
    	  "img" => $infoData['options_product_info_04']['options_product_info_04_img'],
				"text" => $infoData['options_product_info_04']['options_product_info_04_text'],
    	));
		}
	?>
</div>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );