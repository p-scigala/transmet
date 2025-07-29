<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

<div class="up-sells upsells products">
  <div class="wrapper">

    <?php if(get_field("related_title", "option")) { ?>
    <h2 class="up-sells__heading scroll-anim">
      <?php echo get_field("related_title", "option"); ?>
    </h2>
    <?php } ?>

    <?php if(get_field("related_subtitle", "option")) { ?>
    <h3 class="up-sells__subheading scroll-anim">
      <?php echo get_field("related_subtitle", "option"); ?>
    </h3>
    <?php } ?>

    <?php if(get_field("related_description", "option")) { ?>
    <div class="up-sells__description scroll-anim">
      <?php echo get_field("related_description", "option"); ?>
    </div>
    <?php } ?>
  </div>

  <?php woocommerce_product_loop_start(); ?>

  <?php foreach ( $upsells as $upsell ) : ?>

  <?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part( 'content', 'product' );
				?>

  <?php endforeach; ?>

  <?php woocommerce_product_loop_end(); ?>

</div>

<?php
endif;

wp_reset_postdata();