<?php
/**
 * Template Name: Thank you Page
 * Description: Thank you Page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();

$result = array();

if($_SESSION['id_check'] == session_id() && $_SESSION['customer'] && $_SESSION['iban']) {

  if ($_SESSION['post_values']['contact_newsletter']) {
    addInNewsletter($_SESSION['post_values']['contact_email']);
  }

  try {
    $bank_account = create_bank_account($_SESSION['customer'], $_SESSION['iban']);
    $_SESSION['bank_account'] = $bank_account;
  
    $mandate = create_mandate($bank_account);
    $_SESSION['mandate'] = $mandate;

    $_SESSION['customer'] = $gocardless->customers()->get($_SESSION['customer']->id);
    create_client($_SESSION);

    $result['title'] = $context['page']->thankyou_sec1_title;
    $result['message'] = $context['page']->thankyou_sec1_description;

    $pdf = mandateToPdf($mandate);
    $result['message'] .= '<br><br>Votre référence de mandat est ' . $mandate->reference . '.';
    $result['message'] .= '<br>Vous pouvez télécharger une copie du mandat au format PDF <a target="_blank" href="'.$pdf->url.'">ici</a>';
    $result['message'] .= '<br><br>Tagether (GB56ZZZSDDBARC0000007495895781) sera inscrit sur votre relevé bancaire quand vous serez prélevé avec ce mandat de prélèvement SEPA.';

    do_action('end_session_action');
  }

  // Error Gestion
  catch(Exception $e) {
    $result['title'] = 'Une erreur est survenue';
    $result['message'] .= $e->getMessage();
  }

  $context['result'] = $result;
}
else {
  header("Location:".get_page_link(553));
  do_action('end_session_action');
}

Timber::render( 'tunnel/thank-you.twig', $context );