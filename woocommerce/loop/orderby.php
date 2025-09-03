<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="products__orderby">
  <form class="products__orderby-form" method="get">

    <!-- <select name="orderby" class="orderby products__orderby-select select--secondary form-submit-select" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>"> -->
    <select name="orderby" class="orderby products__orderby-select select--secondary form-submit-select"
      aria-label="Sortuj">
      <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
      <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>>
        <?php echo esc_html( $name ); ?></option>
      <?php endforeach; ?>
    </select>

    <input type="hidden" name="paged" value="1" />

    <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>

  </form>

  <div class="products__display">
    <button class="products__display-button" data-display="block"
      title="<?php esc_attr_e( 'Change display', 'woocommerce' ); ?>">
      <?php include( get_template_directory() . '/assets/imgs/icons/display-block.svg' ); ?>
    </button>
    <button class="products__display-button" data-display="list"
      title="<?php esc_attr_e( 'Change display', 'woocommerce' ); ?>">
      <?php include( get_template_directory() . '/assets/imgs/icons/display-list.svg' ); ?>
    </button>
  </div>

</div>
</div>