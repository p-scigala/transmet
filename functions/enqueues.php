<?php

/*
* Enqueues
*/

if (!defined('ABSPATH')) {
	exit;
}


add_filter('script_loader_tag', 'defer_frontend_scripts', 10, 3);
function defer_frontend_scripts($tag, $handle, $src)
{
	if (is_admin()) return $tag;

	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array(
		'main',
		'swiper',
		'aos',
	);

	$custom_attribs = array(
		array('script_name' => 'main', 'attrib' => 'defer'),
		array('script_name' => 'swiper', 'attrib' => 'defer'),
		array('script_name' => 'aos', 'attrib' => 'defer'),
		array('script_name' => 'instant-page', 'attrib' => 'type="module" async'),


	);


	foreach ($custom_attribs as $attrib) {
		if ($attrib['script_name'] === $handle) {
			$tag = str_replace('<script', '<script ' . $attrib['attrib'], $tag);
		}
	}

	return $tag;
}

if (!function_exists('enqueue_local_fonts')) {
	function enqueue_local_fonts()
	{
		$fonts_file_content = file_get_contents(get_template_directory() . '/assets/css/fonts.css');
		wp_register_style('local-fonts', false);
		wp_add_inline_style('local-fonts', $fonts_file_content);
	}
} else {
	throw new Exception('Function enqueue_local_fonts already exists');
}


if (!function_exists('enqueue_main')) {
	function enqueue_main()
	{
		// Styles
		wp_register_style('main', get_template_directory_uri() . '/assets/css/style.css', ['local-fonts'], filemtime(get_stylesheet_directory() . '/assets/css/style.css'), 'all');
		wp_enqueue_style('main');

		// Scripts
		wp_register_script('main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], filemtime(get_stylesheet_directory() . '/assets/js/main.js'), true);
		wp_enqueue_script('main');


		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
} else {
	throw new Exception('Function enqueue_main already exists');
}


if (!function_exists('enqueue_sliders')) {
	function enqueue_sliders()
	{
		// Styles
		wp_register_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css', ['main'], false, 'all');
		wp_enqueue_style('swiper');

		// wp_register_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', false, false, 'all');
		// wp_enqueue_style('slick');

		// wp_register_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', ['main'], false, 'all');
		// wp_enqueue_style('splide');

		// ------------------------------

		// Scripts
		// https://swiperjs.com/get-started
		wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', ['main'], false, true);
		wp_enqueue_script('swiper');

		// wp_register_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', false, false, 'all');
		// wp_enqueue_script('slick');

		// wp_register_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', ['main'], false, true);
		// wp_enqueue_script('splide');

	}
} else {
	throw new Exception('Function enqueue_swiper_slider already exists');
}


if (!function_exists('enqueue_addons')) {
	function enqueue_addons()
	{
		// Styles
		// wp_register_style('animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css', ['main'], false, 'all');
		// wp_enqueue_style('animate');

		wp_register_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css', ['main'], false, 'all');
		wp_enqueue_style('aos');

		// ------------------------------

		// Scripts
		// https://michalsnik.github.io/aos/
		wp_register_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', ['main'], false, true);
		wp_enqueue_script('aos');
		wp_add_inline_script('aos', 'document.addEventListener("DOMContentLoaded", ()=>{AOS.init();})');

		// @TODO fix this boi below - it's not working on not admin
		wp_register_script('instant-page', get_template_directory_uri() . '/assets/js/pagePreloader.js', array(), false, true);
		wp_enqueue_script('instant-page');
	}
} else {
	throw new Exception('Function enqueue_addons already exists');
}

if (!function_exists('enqueue_style_overrides')) {
	function enqueue_style_overrides()
	{
		wp_register_style('style-overrides', get_template_directory_uri() . '/style.css', ['main'], filemtime(get_stylesheet_directory() . '/style.css'), 'all');
		wp_enqueue_style('style-overrides');
	}
} else {
	throw new Exception('Function enqueue_style_overrides already exists');
}


if (!function_exists('handle_enqueues')) {
	add_action('wp_enqueue_scripts', 'handle_enqueues');
	function handle_enqueues()
	{
		enqueue_local_fonts();
		enqueue_main();
		enqueue_style_overrides();
		enqueue_sliders();
		enqueue_addons();
	}
} else {
	throw new Exception('Function handle_enqueues already exists');
}

add_action('login_enqueue_scripts', function () {
	wp_enqueue_style('candy-login', get_template_directory_uri() . '/admin/css/candy-admin.css', false, filemtime(get_stylesheet_directory() . '/admin/css/candy-admin.css'), 'all');
});


add_action('wp_print_styles', 'candy_deregister_styles', 100);
function candy_deregister_styles()
{
	// Admin styles
	if (!is_user_logged_in()) {
		wp_deregister_style('dashicons');
	}
}

// dequeue wp-block-library-css from frontend
add_action('wp_enqueue_scripts', function () {
	wp_dequeue_style('wp-block-library');
}, 100);


// dequeue classic-theme-styles-css from frontend
add_action('wp_enqueue_scripts', function () {
	wp_dequeue_style('classic-theme-styles');
}, 100);


// !!! This is a global style that is used by the editor, if something is not working in the editor, try to remove this
function custom_wp_remove_global_css()
{
	if (!is_admin() && !is_user_logged_in()) {
		remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
		remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
	}
}
add_action('init', 'custom_wp_remove_global_css');
