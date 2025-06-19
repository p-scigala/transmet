<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
* Remove auto <p> tags in cf7
*
*/
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Acf google map api key
 */
function my_acf_google_map_api($api)
{
    $api['key'] = 'api-key-here';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
 * Print map marker
 * @param $acf_google_map_field - acf google map field
 *  
 */
function print_map_marker($acf_google_map_field)
{
    $street = $acf_google_map_field['street_name'] . ' ' . $acf_google_map_field['street_number'];
    $city = $acf_google_map_field['post_code'] . ' ' . $acf_google_map_field['city'];
    printf(
        '<div class="my-map__marker" data-lat="%s" data-lng="%s" data-name="%s" data-street="%s" data-city="%s"></div>',
        esc_attr($acf_google_map_field['lat']),
        esc_attr($acf_google_map_field['lng']),
        esc_attr($acf_google_map_field['name']),
        esc_attr($street),
        esc_attr($city),
    );
}
