<?php
/**
 * Template Name: Front Page
 * Description: Front page
 */

$context = Timber::get_context();


/**
 * Get Page Fields
 */

$context['page'] = new Timber\Post();

/**
 * Get last publications
 */

// get latest three posts
$args = array(
    'posts_per_page' => 3,
    'post__not_in'  => get_option( 'sticky_posts' )
);
$context['posts'] = Timber::get_posts($args);

Timber::render( 'pages/front-page.twig', $context);

