<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
	<div>
	<?php if ($gateway->id == "bluemedia"): ?>
		<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
			<span class="payment_method_name">Blue Media</span>
			<img class="lazy-loaded payment-image-bacs bluemedia-przelewy-checkout" src="<?php echo get_template_directory_uri(); ?>/assets/img/bacs.svg" data-lazy-type="image" data-src="<?php echo get_template_directory_uri(); ?>/assets/img/bacs.svg">
		</label>
	<?php else:?>
	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		<span class="payment_method_name"><?php echo $gateway->get_title();
		/* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?> </span>
		


		<?php if( $gateway->get_icon()):?>
			<?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
		<?php elseif ($gateway->id == "cod"):?>
			<img class="lazy-loaded payment-image-bacs" src="<?php echo get_template_directory_uri(); ?>/assets/img/bacs.svg" data-lazy-type="image" data-src="<?php echo get_template_directory_uri(); ?>/assets/img/bacs.svg">
		<?php else:?>
		<img class="lazy-loaded payment-image-bacs" src="<?php echo get_template_directory_uri(); ?>/assets/img/bacs.svg" data-lazy-type="image" data-src="<?php echo get_template_directory_uri(); ?>/assets/img/bacs.svg">
		<?php endif;?>
	</label>
	<?php endif;?>
		</div>
	
</li>
