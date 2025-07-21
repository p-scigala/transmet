<?php
/*
 * All the functions are in the PHP files in the `functions/` folder.
 */

if (!defined('ABSPATH')) {
  exit;
}
require_once get_template_directory() . '/functions/cleanup.php';
require get_template_directory() . '/functions/widgets.php';
require_once get_template_directory() . '/functions/enqueues.php';
require_once get_template_directory() . '/functions/helpers.php';
require_once get_template_directory() . '/functions/custom_functions.php';
require_once get_template_directory() . '/lib/CF7BootstrapInputs.php';

// Add WooCommerce theme support
add_action('after_setup_theme', 'add_woocommerce_support');
function add_woocommerce_support() {
    add_theme_support('woocommerce');
}

add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
function jk_dequeue_styles($enqueue_styles)
{
  unset($enqueue_styles['woocommerce-general']);  // Remove the gloss
  unset($enqueue_styles['woocommerce-layout']);    // Remove the layout
  unset($enqueue_styles['woocommerce-smallscreen']);  // Remove the smallscreen optimisation
  return $enqueue_styles;
}

// Gdyby coś nie działało w cf7 -> zakomentować
$cf7BootstrapInputs = new CF7BootstrapInputs();
$cf7BootstrapInputs->init();

add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_add_span_inside_add_to_cart', 10, 3 );

function custom_add_span_inside_add_to_cart( $html, $product, $args ) {
    // Example: insert <span class="custom-span">text</span> after the text inside the <a>
    // Original $html is something like:
    // <a href="..." class="button add_to_cart_button">Add to cart</a>

    // Find the closing tag > and insert span after it
    $custom_html = str_replace('>', '><span>', $html);
    $custom_html = str_replace('<', '</span><', $custom_html);

    return $custom_html;
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script(
        'ajax-add-to-cart',
        '/wp-content/themes/candyweb-new/assets/js/addToCart.js',
        ['jquery'],
        '1.0',
        true
    );
    wp_localize_script('ajax-add-to-cart', 'AjaxCart', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-add-to-cart')
    ]);
});

add_action('wp_ajax_add_to_cart', 'add_to_cart_callback');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_callback');

function add_to_cart_callback() {
    check_ajax_referer('ajax-add-to-cart', 'nonce');

    $product_id = absint($_POST['product_id'] ?? 0);
    $quantity = absint($_POST['quantity'] ?? 1);
    $variation_id = absint($_POST['variation_id'] ?? 0);
    
    // Get variation attributes if present
    $variation_data = array();
    if ($variation_id > 0) {
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 10) === 'attribute_') {
                $variation_data[$key] = wc_clean($value);
            }
        }
    }

    if ($product_id > 0 && WC()->cart) {
        if ($variation_id > 0) {
            // Handle variable product
            $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation_data);
        } else {
            // Handle simple product
            $added = WC()->cart->add_to_cart($product_id, $quantity);
        }

        if ($added) {
            // Return new cart fragments to update mini cart, etc.
            WC_AJAX::get_refreshed_fragments();
        } else {
            wp_send_json_error(['message' => 'Could not add to cart.']);
        }
    } else {
        wp_send_json_error(['message' => 'Invalid product.']);
    }

    wp_die();
}

add_action('wp_ajax_get_cart_count', 'get_cart_count_callback');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count_callback');

function get_cart_count_callback() {
    // Get total items in cart
    $count = WC()->cart->get_cart_contents_count();
    wp_send_json_success(['count' => $count]);
}

// Handle standard WooCommerce variation form submissions
add_action('template_redirect', 'handle_variation_form_submission');
function handle_variation_form_submission() {
    if (isset($_POST['add-to-cart']) && isset($_POST['variation_id']) && $_POST['variation_id'] > 0) {
        $product_id = intval($_POST['add-to-cart']);
        $variation_id = intval($_POST['variation_id']);
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        
        // Get variation attributes
        $variation_data = array();
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 10) === 'attribute_') {
                $variation_data[$key] = wc_clean($value);
            }
        }
        
        // Add to cart
        $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation_data);
        
        if ($cart_item_key) {
            // Redirect to same page with success parameter to prevent form resubmission
            wp_safe_redirect(add_query_arg('added-to-cart', $product_id));
            exit;
        }
    }
}

/* najniższa cena sprzed 30 dni */

add_action( 'save_post_product', 'save_lowest_price_from_30_days', 10, 3 );

function save_lowest_price_from_30_days( $post_id, $post, $update ) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    $product = wc_get_product( $post_id );
    if ( ! $product ) return;

    $current_price = (float) $product->get_regular_price();

    // Pobierz historię zmian ceny z meta (lub inicjalizuj)
    $history = get_post_meta( $post_id, '_price_history', true );
    if ( ! is_array( $history ) ) $history = array();

    // Dodaj aktualną cenę z timestampem
    $history[] = array(
        'price' => $current_price,
        'time'  => time(),
    );

    // Usuń wpisy starsze niż 30 dni
    $threshold = strtotime( '-30 days' );
    $history = array_filter( $history, function( $item ) use ( $threshold ) {
        return $item['time'] >= $threshold;
    });

    // Znajdź najniższą cenę z historii
    $lowest = $current_price;
    foreach ( $history as $item ) {
        if ( $item['price'] < $lowest ) {
            $lowest = $item['price'];
        }
    }

    // Zapisz historię i najniższą cenę
    update_post_meta( $post_id, '_price_history', $history );
    update_post_meta( $post_id, '_lowest_price_last_30_days', $lowest );
}

function display_lowest_price_from_30_days() {
    global $product;

    $lowest_price = get_post_meta( $product->get_id(), 'lowest_price_last_30_days', true );

    if ( $lowest_price ) {
        echo '<p class="single-product__lowest-price">Najniższa cena sprzed 30 dni: <strong>' 
             . wc_price( $lowest_price ) 
             . '</strong></p>';
    }
}

/* display category name in product page */

function display_product_category_name() {
    global $product;

    $terms = get_the_terms( $product->get_id(), 'product_cat' );

    if ( $terms && ! is_wp_error( $terms ) ) {
        echo '<div class="single-product__category-name">';

        $categories = wp_list_pluck( $terms, 'name' );
        echo implode( ', ', $categories );

        echo '</div>';
    }

}

/* change additional information tab name */

add_filter( 'woocommerce_product_tabs', 'display_custom_additional_information_name', 98 );
function display_custom_additional_information_name( $tabs ) {
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = 'Dane techniczne';
    }
    return $tabs;
}

/* add new tab in product page with files to download */

add_filter( 'woocommerce_product_tabs', 'add_tab_to_product_tabs' );
function add_tab_to_product_tabs( $tabs ) {

    $tabs['files_to_download'] = array(
        'title' => 'Materiały do pobrania', // Tytuł zakładki
        'priority' => 50, // Kolejność wyświetlania
        'callback' => 'product_files_to_download' // Funkcja, która zwróci HTML
    );

    return $tabs;
}

function product_files_to_download() {
    global $product;
    $product_id = $product->get_id();

    if(get_field('product_files_repeater', $product_id)) {
        $files = get_field('product_files_repeater', $product_id);
        if($files) {
            echo '<ul class="single-product__files">';
            foreach($files as $file) {
                echo '<li class="single-product__file"><a href="' . esc_url($file['product_file']) . '" target="_blank"><img src="../../wp-content/themes/candyweb-new/assets/imgs/icon-file.svg" /><span>' . esc_html($file['product_file_name']) . '</span></a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Brak plików do pobrania.</p>';
        }
    } else {
        echo '<p>Brak plików do pobrania.</p>';
    }
}

/* remove reviews tab from product page */

add_filter( 'woocommerce_product_tabs', 'remove_reviews_tab_from_product_page', 98 );
function remove_reviews_tab_from_product_page( $tabs ) {
    unset( $tabs['reviews'] );
    return $tabs;
}

/* display additional data in product page */

function display_product_additional_data() {
  global $product;
  $product_id = $product->get_id();

  $ean_code = get_field('product_ean_code', $product_id);
  $nfz_code = get_field('product_nfz_code', $product_id);
  $quality = get_field('product_quality', $product_id);
  $refundation = get_field('product_nfz_refundation', $product_id);

  echo '<table class="single-product__table">';

  if($ean_code) echo '<tr><th>Kod EAN</th><td>' . $ean_code . '</td></tr>';
  if($quality) echo '<tr><th>Klasa wyrobu</th><td>' . $quality . '</td></tr>';
  if($nfz_code) echo '<tr><th>Kod NFZ</th><td>' . $nfz_code . '</td></tr>';

  echo "</table>";

  if($refundation) {
    echo '<div class="single-product__refund-info">Refundacja NFZ - ' . $refundation['label'] . '</div>';
  }
}

add_filter( 'wpcf7_form_elements', 'cf7_replace_submit_with_button' );
function cf7_replace_submit_with_button( $form ) {
    // Znajdź input submit i zamień na <button><span>...</span></button>
    if ( preg_match( '/<input[^>]+type=["\']submit["\'][^>]*>/i', $form, $matches ) ) {
        $submit_input = $matches[0];

        // Wyciągnij wartość z atrybutu value
        preg_match( '/value=["\']([^"\']+)["\']/', $submit_input, $value_match );
        $label = isset($value_match[1]) ? $value_match[1] : 'Wyślij';

        // Zamień <input> na <button><span>...</span></button>
        $button_html = str_replace( $submit_input,
            '<button type="submit" class="wpcf7-submit btn"><span>' . esc_html($label) . '</span></button>',
            $form
        );

        return $button_html;
    }

    return $form;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_single_product_summary', 'display_product_category_name', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 7 );
add_action( 'woocommerce_single_product_summary', 'display_lowest_price_from_30_days', 8 );
add_action( 'woocommerce_single_product_summary', 'display_product_additional_data', 9 );

add_filter( 'woocommerce_get_price_html', 'show_unavailable_instead_of_price', 20, 2 );

function show_unavailable_instead_of_price( $price_html, $product ) {
    // Sprawdź, czy produkt jest niedostępny
    if ( ! $product->is_in_stock() ) {
        return '<span class="price no-price"><bdi>Produkt niedostępny</bdi></span>';
    }

    // Jeśli produkt nie ma ceny
    if ( $product->get_price() === '' || $product->get_price() === null ) {
        return '<span class="price no-price"><bdi>Produkt niedostępny</bdi></span>';
    }

    // W przeciwnym razie wyświetl standardową cenę
    return $price_html;
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'variants_instead_of_add_to_cart_btn', 10, 2 );

function variants_instead_of_add_to_cart_btn( $button, $product ) {
    if ( $product->is_type( 'variable' ) ) {
        $url = get_permalink( $product->get_id() );
        $label = 'Zobacz warianty';

        return sprintf(
            '<a href="%s" class="btn"><span>%s</span></a>',
            esc_url( $url ),
            esc_html( $label )
        );
    }

    return $button;
}

// add_filter( 'woocommerce_get_price_html', 'show_variants_instead_of_price', 20, 2 );

// function show_variants_instead_of_price( $price_html, $product ) {
//     if ( $product->is_type( 'variable' ) ) {
//         return '<span class="price price-has-variants"><bdi>Produkt posiada warianty</bdi></span>';
//     }

//     return $price_html;
// }

add_filter( 'woocommerce_get_price_html', 'display_price_range_for_variants', 20, 2 );

function display_price_range_for_variants( $price_html, $product ) {
    // Dotyczy tylko produktów typu 'variable'
    if ( $product->is_type( 'variable' ) ) {
        // Pobierz wszystkie warianty (bez względu na widoczność)
        $available_variations = $product->get_children();

        $prices = [];

        foreach ( $available_variations as $variation_id ) {
            $variation = wc_get_product( $variation_id );

            if ( $variation && $variation->get_price() !== '' ) {
                $prices[] = floatval( $variation->get_price() );
            }
        }

        if ( ! empty( $prices ) ) {
            $min_price = min( $prices );
            $max_price = max( $prices );

            if ( $min_price === $max_price ) {
                return '<span class="price">' . wc_price( $min_price ) . '</span>';
            } else {
                return '<span class="price"><span class="price-amount">' . wc_price( $min_price ) . '<span class="woocommerce-Price-amount amount"><bdi>-</bdi></span>' . wc_price( $max_price ) . '</span></span>';
            }
        }

        // Jeśli nie ma cen – zwróć komunikat
        return '<span class="price no-price">Cena niedostępna</span>';
    }

    return $price_html; // dla innych typów produktów
}

add_filter( 'woocommerce_pagination_args', 'change_pagination_arrows' );

function change_pagination_arrows( $args ) {
    $args['prev_text'] = '<button type="button" class="btn btn--arrow btn--arrow-left prev" title="Poprzednia strona"><span></span></button>';
    $args['next_text'] = '<button type="button" class="btn btn--arrow btn--arrow-right next" title="Następna strona"><span></span></button>';
    return $args;
}
