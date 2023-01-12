<?php
/**
 * Template Name: Legals Page
 * Description: Legals page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();
$page_template = ['pages/cgu.twig', 'pages/cgv.twig', 'pages/prpd.twig', 'pages/mentions-legales.twig', 'pages/charte-de-cookies'];

if ($context['page']->slug == 'conditions-generales-dutilisation'){
  Timber::render( $page_template[0], $context );
}
else if ($context['page']->slug == 'conditions-generales-de-vente'){
  Timber::render( $page_template[1], $context );
} else if ($context['page']->slug == 'prpd'){
  Timber::render( $page_template[2], $context );
} else if ($context['page']->slug == 'mentions-legales'){
  Timber::render( $page_template[3], $context );
} else if ($context['page']->slug == 'charte-de-cookies'){
  Timber::render( $page_template[3], $context );
}