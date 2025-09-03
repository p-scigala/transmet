<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

<div class="woocommerce-tabs wc-tabs-wrapper animate">
  <div class="tabs">
    <div class="wrapper">

      <ul class="tabs__list wc-tabs" role="tablist">

        <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
        <li role="presentation" class="<?php echo esc_attr( $key ); ?>_tab tab__trigger"
          id="tab-title-<?php echo esc_attr( $key ); ?>">
          <a href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
            <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
          </a>
        </li>
        <?php endforeach; ?>

      </ul>

      <?php foreach ( $product_tabs as $key => $product_tab ) : ?>

      <?php
        $hasSafetyInfo = get_field('product_safety_info');
        $isSafetyInfoTab = ($key === 'product_safety_info');
      ?>

      <?php if(!($isSafetyInfoTab && !$hasSafetyInfo)): // Skip rendering this tab if no safety info ?>
      <div
        class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> entry-content wc-tab tab__content"
        id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel"
        aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
        <?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
      </div>
      <?php endif; ?>

      <?php endforeach; ?>

      <?php do_action( 'woocommerce_product_after_tabs' ); ?>

    </div>
  </div>
</div>

<?php endif; ?>