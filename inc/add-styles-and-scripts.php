<?php

// Enqueue scripts
function my_scripts() {

	// Use jQuery from a CDN
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), null, false);

	// Enqueue ScrollMagic
	wp_register_script( 'tween_script', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'tween_script' );

	wp_register_script( 'scrollMagic_script', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array('tween_script'), false, true );
	wp_enqueue_script( 'scrollMagic_script' );

	wp_register_script( 'gsap_script', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js', array('scrollMagic_script'), false, true );
	wp_enqueue_script( 'gsap_script' );

	wp_register_script( 'indicators_script', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array('gsap_script'), false, true );
	wp_enqueue_script( 'indicators_script' );

	// Enqueue Swiper
	wp_register_style( 'swiper_style', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css');
	wp_enqueue_style( 'swiper_style' );

	// Enqueue Slick
	wp_register_style( 'slick_style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css');
	wp_enqueue_style( 'slick_style' );
	wp_register_style( 'slick_style_theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css');
	wp_enqueue_style( 'slick_style_theme' );

	// wp_enqueue_script( 'swiper_script' );
	wp_register_script( 'slick_script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'slick_script' );

	// wp_register_script( 'swiper_script', '//cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js', array('jquery'), false, true );
	// wp_enqueue_script( 'swiper_script' );
	wp_register_script( 'swiper_script', get_template_directory_uri() . '/assets/src/js/lib/swiper.js', array('jquery'), false, true );
	wp_enqueue_script( 'swiper_script' );

	// Cookie library
	wp_enqueue_script( 'cookie-js', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array('jquery'), false, true );

	// Enqueue our stylesheet and JS file with a jQuery dependency.
	// Note that we aren't using WordPress' default style.css, and instead enqueueing the file of compiled Sass.
	wp_enqueue_style( 'my-styles', get_template_directory_uri() . '/assets/public/css/main.min.css', array('swiper_style'), 1.0);
	wp_enqueue_script( 'my-js', get_template_directory_uri() . '/assets/public/js/main.min.js', array('jquery', 'indicators_script', 'swiper_script', 'cookie-js'), '1.0.0', true );
}

// function my_acf_add_local_field_groups() {
//     remove_filter('acf_the_content', 'wpautop' );
// }

//add_action('acf/init', 'my_acf_add_local_field_groups');
add_action( 'wp_enqueue_scripts', 'my_scripts' );
