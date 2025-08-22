<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<div class="products-desc">
  <div class="wrapper">

    <?php $shop_id = get_option('woocommerce_shop_page_id'); ?>

    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
    <!-- <h2 class="products-desc__heading animate">
      <?php woocommerce_page_title(); ?>
    </h2> -->
    <?php endif; ?>

    <?php if(get_field("shop_heading", $shop_id)) : ?>
    <h2 class="products-desc__heading animate">
      <?php echo get_field("shop_heading", $shop_id); ?>
    </h2>
    <?php endif; ?>

    <?php if(!empty(get_field('product_archive_title_02', 'option'))): ?>
    <h3 class="products-desc__subheading animate">
      <?php echo get_field('product_archive_title_02', 'option');?>
    </h3>
    <?php endif; ?>

    <?php if(get_field("shop_subheading", $shop_id)) : ?>
    <h3 class="products-desc__subheading animate">
      <?php echo get_field("shop_subheading", $shop_id); ?>
    </h3>
    <?php endif; ?>

    <?php if(get_the_archive_description()) : ?>
    <!-- <div class="styled-wysiwyg text-start  mt-15 mt-lg-30">
      <?php echo strip_tags(get_the_archive_description());?>
    </div> -->
    <?php endif; ?>

    <?php if(get_field("shop_description", $shop_id)) : ?>
    <div class="products-desc__description animate">
      <?php echo get_field("shop_description", $shop_id); ?>
    </div>
    <?php endif; ?>

  </div>
</div>

<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
?>

<div class="products">
  <div class="products__wrapper">
    <button class="products__filters-toggle products__filters-toggle-main"><?php _e('Filtry', 'candyweb'); ?></button>
    <div class="products__filters">
      <button class="close-filter-button">&times;</button>
      <div class="products__filters-category">
        <h3 class="products__filters-heading"><?php _e('Kategorie', 'candyweb'); ?></h3>
        <ul class="products__filters-box">
          <?php
							$args = array(
								'taxonomy'     => 'product_cat',
								'orderby'      => 'name',
								'show_count'   => 0,
								'pad_counts'   => 0,
								'hierarchical' => 1,
								'title_li'     => '',
								'hide_empty'   => 0,
								'parent'       => 0,
								'exclude'      => '15, 41'
							);
							$categories = get_categories($args);
							
							foreach ($categories as $category) {
								$category_link = get_term_link($category);
								$active_class = is_tax('product_cat', $category->slug) ? 'active-cat' : '';
							
								$subcategories = get_categories(array(
									'taxonomy'     => 'product_cat',
									'orderby'      => 'name',
									'show_count'   => 0,
									'pad_counts'   => 0,
									'hierarchical' => 1,
									'title_li'     => '',
									'hide_empty'   => 0,
									'parent'       => $category->term_id,
								));

								$hasSubCategoryClass = $subcategories ? ' products__filters-category-has-items' : '';

								if(is_tax('product_cat', $category->slug)) {
									$isActive = ' products__filters-category--active';
								} else {
									$isActive = '';
								}

								if($isCategoryActive && $subcategories) {
									$subcategory_collapse = 1;
								} else {
									$subcategory_collapse = 0;
								}

								if (!is_wp_error($category_link)) {
									echo '<li class="products__filters-category' . $hasSubCategoryClass . $isActive . '"><div class="products__filter-category-wrap"><a class="products__filter-category-link" href="' . esc_url($category_link) . '" class="' . $active_class . '">' . $category->name . '</a>';
							
									if ($subcategories) {

										foreach ($subcategories as $subcategory2) {
											$subcategory_link2 = get_term_link($subcategory2);
											if (is_tax('product_cat', $subcategory2->slug)) {
												$subcategory_collapse = 1;
											}
										}
										
										if (is_tax('product_cat', $category->slug)) {
											echo '<i class="cursor-pointer categories-collapse active" data-bs-toggle="collapse" data-bs-target="#' . $category->slug . '" aria-expanded="true" aria-controls="collapseExample"></i></div>';
											echo '<ul class="archive-products__category-second show" id="' . $category->slug . '">';
										} elseif (isset($subcategory_collapse)) {
											echo '<i class="cursor-pointer categories-collapse collapsed" data-bs-toggle="collapse" data-bs-target="#' . $category->slug . '" aria-expanded="true" aria-controls="collapseExample"></i></div>';
											echo '<ul class="archive-products__category-second collapse" id="' . $category->slug . '">';
										} else {
											echo '<i class="cursor-pointer categories-collapse collapsed" data-bs-toggle="collapse" data-bs-target="#' . $category->slug . '" aria-expanded="true" aria-controls="collapseExample"></i></div>';
											echo '<ul class="archive-products__category-second collapse" id="' . $category->slug . '">';
										}
										
										foreach ($subcategories as $subcategory) {
											$subcategory_link = get_term_link($subcategory);
											$active_class_sub = is_tax('product_cat', $subcategory->slug) ? 'active-cat' : '';
							
											$isSubcategoryActive = is_tax('product_cat', $subcategory->slug);
											if ($isSubcategoryActive) {
												$active_class_sub = ' products__filters-category--active';
											} else {
												$active_class_sub = '';
											}

											if (!is_wp_error($subcategory_link)) {
												echo '<li><a href="' . esc_url($subcategory_link) . '" class="' . $active_class_sub . '">' . $subcategory->name . '</a></li>';
											}

											
										}
							
										echo '</ul>';
									}
							
									echo '</li>';
								}
							}
						?>
        </ul>
      </div>
      <div>
        <span class="products__filters-heading"><?php _e('Filtry', 'candyweb'); ?></span>
        <div class="products__filters-box">
          <?php echo do_shortcode('[woof]'); ?>
        </div>
      </div>


    </div>

    <div class="products__list-wrapper">
      <?php
		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		?>


      <?php
				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );
						
 						// echo wc_get_template('content-product.php', array());
						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			?>
    </div>
  </div>
</div>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

$shop_id = wc_get_page_id( 'shop' );
set_query_var( 'acf_page_id', $shop_id );
get_template_part( 'template-parts/text-and-image', 'page' );

get_template_part( 'template-parts/call-to-action', 'page' );
get_template_part( 'template-parts/seo-text', 'page' );
get_footer();