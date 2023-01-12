<?php

add_filter('timber/twig', 'add_to_twig');

function add_to_twig( $twig ) {
	$twig->addFilter(new Twig_SimpleFilter('fit', 'fit_image'));
	return $twig;
}

	function fit_image($src, $w, $h = 0) {
	// Instantiate TimberImage from $src so we have access to dimensions
  $img = new Timber\Image($src);

	// If the image is smaller on both width and height, return original
	if ($img->width() <= $w && $img->height() <= $h) {
		return $src;
	}

	// Compute aspect ratio of target box
	$aspect = $w / $h;

	// Call proportional resize on width or height, depending on how the image's
	// aspect ratio compares to the target box aspect ratio
	if ($img->aspect() > $aspect) {
		return Timber\ImageHelper::resize($src, $w);
	} else {
		return Timber\ImageHelper::resize($src, 0, $h);
	}
}