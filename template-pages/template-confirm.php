<?php
/**
 * Template Name: Confirmation SEPA Page
 * Description: Confirmation SEPA Page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();

if ($_SESSION['id_check'] !== session_id() || empty($_SESSION['customer']) || empty($_SESSION['iban'])) {
  header("Location:".get_page_link(553));
  do_action('end_session_action');
}
$context['session'] = $_SESSION;

Timber::render( 'tunnel/confim.twig', $context );