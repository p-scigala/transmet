<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;


$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>

<?php the_title( '<h1 class="single-product__title no-desktop">', '</h1>' ); ?>

<div class="single-product__main">

  <div class="single-product__gallery">

    <?php if ( has_term( 'featured', 'product_visibility', $product->get_id() ) ) : ?>
    <span class="product__featured">Bestseller</span>
    <?php endif; ?>

    <!-- <?php if ( has_term( 41, 'product_cat', $product->get_id() ) ) : ?>
    <div class="bestsellers-product">
      <img src="<?php echo get_template_directory_uri()?>/assets/img/bestseller.png" class="bestseller-product__img"
        alt="<?php echo _e('Ikona Bestsellera', 'candyweb');?>">
    </div>
    <?php endif;?> -->

    <div class="product-gallery__slider">

      <?php if (!empty(get_field('product_video'))): ?>
      <?php
			$iframe = get_field('product_video');
			preg_match('/src="https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_-]+)(\?.+)?"/', $iframe, $matches);
			$video_id = $matches[1];
			?>
      <div class="product-gallery__item d-flex align-items-center justify-content-center position-relative">
        <div class="youtube" data-id="<?php echo esc_attr($video_id); ?>">
          <div class="play-button"></div>
        </div>
      </div>
      <?php endif; ?>

      <?php 
		if ( $post_thumbnail_id ) :
			$image_url = wp_get_attachment_image_url( $post_thumbnail_id, 'full' );
			$image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
			?>
      <div class="product-gallery__item d-flex align-items-center justify-content-center position-relative">
        <a href="<?php echo esc_url($image_url); ?>" data-lightbox="product">
          <?php echo wp_get_attachment_image( $post_thumbnail_id, 'product-single-img', false, array( 'alt' => esc_attr( $image_alt ), 'class' => 'product-gallery__img' ) ); ?>
        </a>
      </div>
      <?php
		endif;

		if ( class_exists( 'WooCommerce' ) ) :
			$product = wc_get_product();
			if ( $product->get_gallery_image_ids() ) :
				$gallery_image_ids = $product->get_gallery_image_ids();

				foreach ( $gallery_image_ids as $image_id ) :
					$image_url = wp_get_attachment_image_url( $image_id, 'full' );
					$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					?>
      <div class="product-gallery__item d-flex align-items-center justify-content-center position-relative">
        <a href="<?php echo esc_url($image_url); ?>" data-lightbox="product">
          <?php echo wp_get_attachment_image( $image_id, 'product-single-img', false, array( 'alt' => esc_attr( $image_alt ), 'class' => 'product-gallery__img' ) ); ?>
        </a>
      </div>
      <?php
				endforeach;
			endif;
		endif;
		?>
    </div>
    <div class="product-gallery__slider-nav mt-30">
      <?php if (!empty(get_field('product_video'))): ?>
      <?php
				$iframe = get_field('product_video');
				preg_match('/src="https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_-]+)(\?.+)?"/', $iframe, $matches);
				$video_id = $matches[1];
				?>
      <div class="product-gallery__nav-item d-flex align-items-center justify-content-center position-relative">
        <div class="youtube-thumb" data-id="<?php echo esc_attr($video_id); ?>">
          <div class="play-button"></div>
        </div>
      </div>
      <?php endif; ?>
      <?php 
			

			if ( class_exists( 'WooCommerce' ) ) :
				$product = wc_get_product();
				if ( $product->get_gallery_image_ids() ) :
					$gallery_image_ids = $product->get_gallery_image_ids();
					if ( $post_thumbnail_id ) :
						$image_url = wp_get_attachment_image_url( $post_thumbnail_id, 'full' );
						$image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
						?>
      <div class="product-gallery__nav-item d-flex align-items-center justify-content-center position-relative">
        <?php echo wp_get_attachment_image( $post_thumbnail_id, 'product-single-nav-img', false, array( 'alt' => esc_attr( $image_alt ), 'class' => 'product-gallery__nav-img' ) ); ?>
      </div>
      <?php
					endif;
					foreach ( $gallery_image_ids as $image_id ) :
						$image_url = wp_get_attachment_image_url( $image_id, 'full' );
						$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
						?>
      <div class="product-gallery__nav-item d-flex align-items-center justify-content-center position-relative">
        <?php echo wp_get_attachment_image( $image_id, 'product-single-nav-img', false, array( 'alt' => esc_attr( $image_alt ), 'class' => 'product-gallery__nav-img' ) ); ?>
      </div>
      <?php
					endforeach;
				endif;
			endif;
			?>
    </div>
  </div>