<?php
/*
 * Cleanup
 */

// Less stuff in <head>
if (!defined('ABSPATH')) {
  exit;
}
if (!function_exists('b5st_cleanup_head')) {
  function b5st_cleanup_head()
  {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
  }
}
add_action('init', 'b5st_cleanup_head');

	
// Disable the emojis in WordPress.
 
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	// Remove from TinyMCE.
	add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	} );
	// Remove from dns-prefetch.
	add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
			$urls          = array_diff( $urls, array( $emoji_svg_url ) );
		}
		return $urls;
	}, 10, 2 );
} );

// Show less info to users on failed login for security.
// (Will not let a valid username be known.)

if (!function_exists('show_less_login_info')) {
  function show_less_login_info(): string
  {
    return "Hasło do konta jest nieprawidłowe lub konto nie istnieje.";
  }
}
add_filter('login_errors', 'show_less_login_info');

// Do not generate and display WordPress version

if (!function_exists('b5st_remove_generator')) {
  function b5st_remove_generator(): string
  {
    return '';
  }
}
add_filter('the_generator', 'no_generator');

// Remove Query Strings From Static Resources
function candy_remove_query_strings_split( $src ) {
	if (current_user_can('manage_options')) {
    return $src;
  }
  if (strpos($src, '?ver=')) {
    $src = remove_query_arg('ver', $src);
    return $src;
  }
}
add_action( 'init', function () {
	if ( ! is_admin() ) {
		add_filter( 'script_loader_src', 'candy_remove_query_strings_split', 15 );
		add_filter( 'style_loader_src', 'candy_remove_query_strings_split', 15 );
	}
} );



/* Disabling automatic updates for WordPress core, plugins and themes. */
add_filter( 'auto_update_core', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );