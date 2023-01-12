<?php
/**
 * Template Name: Abonnement Page
 * Description: Abonnement page
 */

$context = Timber::get_context();
$context['page'] = new Timber\Post();
$context['abonnement'] = $context['page']->subscribe_sec2_preinscription;

Timber::render( 'tunnel/subscription.twig', $context );