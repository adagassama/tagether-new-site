<?php 

// Create our version of the TimberSite object
class StarterSite extends TimberSite {

	// This function applies some fundamental WordPress setup, as well as our functions to include custom post types and taxonomies.
	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'init', array( $this, 'register_widgets' ) );
		parent::__construct();
	}


	// Abstracting long chunks of code.

	// The following included files only need to contain the arguments and register_whatever functions. They are applied to WordPress in these functions that are hooked to init above.

	// The point of having separate files is solely to save space in this file. Think of them as a standard PHP include or require.

	function register_post_types(){
		require __DIR__.'/../lib/custom-types.php';
	}

	function register_taxonomies(){
		require __DIR__.'/../lib/taxonomies.php';
	}

	function register_menus(){
		require __DIR__.'/../lib/menus.php';
	}

	function register_widgets(){
		require __DIR__.'/../lib/widgets.php';
	}


	// Access data site-wide.

	// This function adds data to the global context of your site. In less-jargon-y terms, any values in this function are available on any view of your website. Anything that occurs on every page should be added here.

	function add_to_context( $context ) {

		// Our menu occurs on every page, so we add it to the global context.
		$context['menu'] = new Timber\Menu('header');
		$context['footer'] = new Timber\Menu('footer');

		// This 'site' context below allows you to access main site information like the site title or description.
		$context['site'] = $this;
		$context['options'] = get_fields(51);
		
		// Check if mobile site
		$context['isMobile'] = wp_is_mobile();

		// Image size
		$retina = array();
		$large = array();
		$medium = array();
		$mobile = array();

		$retina['width'] = '2x';
		$retina['very_small'] = [
			'width' => 100*2,
			'height' => 100*2
		];
		$retina['card'] = [
			'width' => 300*2,
			'height' => 300*2
		];
		$retina['card_big'] = [
			'width' => 500*2,
			'height' => 500*2
		];
		$retina['phone'] = [
			'width' => 450*2,
			'height' => 750*2
		];
		$retina['big'] = [
			'width' => 1152*2,
			'height' => 1152*2
		];

		$large['width'] = '1440w';
		$large['very_small'] = [
			'width' => 100,
			'height' => 100
		];
		$large['card'] = [
			'width' => 300,
			'height' => 300
		];
		$large['card_big'] = [
			'width' => 500,
			'height' => 500
		];
		$large['phone'] = [
			'width' => 450,
			'height' => 750
		];
		$large['big'] = [
			'width' => 1152,
			'height' => 1152
		];

		$medium['width'] = '768w';
		$medium['very_small'] = [
			'width' => 75, 
			'height' =>75
		];
		$medium['card'] = [
			'width' => 300,
			'height' => 300
		];
		$medium['card_big'] = [
			'width' => 400,
			'height' => 400
		];
		$medium['phone'] = [
			'width' => 350,
			'height' => 650
		];
		$medium['big'] = [
			'width' => 614,
			'height' => 614
		];

		$mobile['width'] = '425w';
		$mobile['very_small'] = [
			'width' => 75, 
			'height' =>75
		];
		$mobile['card'] = [
			'width' => 250,
			'height' => 250
		];
		$mobile['card_big'] = [
			'width' => 375,
			'height' => 375
		];
		$mobile['phone'] = [
			'width' => 350,
			'height' => 650
		];
		$mobile['big'] = [
			'width' => 375,
			'height' => 375
		];

		$sizes = [
			'retina' => $retina,
			'large' => $large,
			'medium' => $medium,
			'mobile' => $mobile,
		];
		$context['image_size'] = $sizes;

		return $context;
	}

	// Here you can add your own fuctions to Twig. Don't worry about this section if you don't come across a need for it.
	// See more here: http://twig.sensiolabs.org/doc/advanced.html
	function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new StarterSite();