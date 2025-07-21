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

/**
 * Custom Walker for Navigation Menu
 * Adds span element after text in menu items with children
 */
class Custom_Nav_Walker extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes .'>';
        
        // Add the menu item title
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        
        // Check if this menu item has children and add span after text
        $has_children = in_array('menu-item-has-children', $classes);
        
        if ($has_children) {
            $item_output .= '<span class="menu-arrow"></span>';
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}