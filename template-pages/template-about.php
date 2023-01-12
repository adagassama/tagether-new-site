<?php
/**
 * Template Name: Qui sommes-nous Page
 * Description: Qui sommes-nous page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();

Timber::render( 'pages/about.twig', $context );