<?php
/**
 * Template Name: FAQ Page
 * Description: FAQ page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();

Timber::render( 'pages/faq.twig', $context );