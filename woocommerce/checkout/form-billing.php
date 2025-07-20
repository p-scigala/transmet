<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="checkout-shipping">
	<h3 class="my-checkout__title mb-30">1. Opcje dostawy</h3>
	<ul class="checkout-shipping__ul">
		<li>
			<input type="radio" data-index="0" id="shipping-odbior" name="shipping-method" class="checkout-shipping__input" checked>
			<label class="checkout-shipping__label" for="shipping-odbior">
				<img src="<?php echo get_template_directory_uri()?>/assets/img/shipping-free.svg">
				<div class="d-inline-block">
					Odbiór osobisty w recepcji Hotelu Trylogia 0 zł
				</div>
			</label>
		</li>
		<li>
			<input type="radio" data-index="1" id="shipping-dostawa" name="shipping-method" class="checkout-shipping__input">
			<label class="checkout-shipping__label" for="shipping-dostawa">
				<img src="<?php echo get_template_directory_uri()?>/assets/img/shipping-dostawa.svg">
				<div class="d-inline-block">
					Dostawa Prosimy o kontakt w celu potwierdzenia możliwości. -  
					<span class="woocommerce-Price-amount amount">
						<bdi>20,00&nbsp;<span class="woocommerce-Price-currencySymbol">zł</span></bdi>
					</span>
				</div>
			</label>
		</li>
	</ul>

</div>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3 class="my-checkout__title"><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3 class="my-checkout__title mb-30 mb-md-60 mt-60 ">2. <?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
