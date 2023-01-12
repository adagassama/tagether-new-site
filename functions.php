<?php

require 'vendor/autoload.php';

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	} );
	return;
}

$timber = new Timber\Timber();
foreach (glob(__DIR__.'/inc/*.php') as $filename)
{
	include $filename;
}

/**
 * Hide admin bar
 */
// add_action('after_setup_theme', 'remove_admin_bar');
// function remove_admin_bar() {
// 	show_admin_bar(false);
// }

Timber::$dirname = array('templates', 'views');




