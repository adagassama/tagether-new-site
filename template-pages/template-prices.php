<?php
/**
 * Template Name: Tarifs Page
 * Description: Tarifs page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();

Timber::render( 'pages/prices.twig', $context );