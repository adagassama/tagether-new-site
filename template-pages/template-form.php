<?php
/**
 * Template Name: Formulaire Page
 * Description: Formulaire Page
 */


$context = Timber::get_context();
$context['page'] = new Timber\Post();

$errors = array();
$context['post_values'] = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  try {
    
    $_POST = stripslashes_deep($_POST);
    $_SESSION['post_values'] = $_POST;

    if (check_client($_POST['contact_email']) == 1) {
      throw new Exception( 'L\'email est déjà présent dans notre base de donnée.' );
    }
    else {

      $v = new Valitron\Validator($_POST);
      $v->rule('required', ['contact_name', 'contact_lsname', 'contact_email', 'contact_society', 'contact_address', 'contact_city', 'contact_zipcode', 'contact_iban'])->message('Le champ doit être rempli.');
      $v->rule('alpha_unicode', ['contact_name', 'contact_lsname'])->message('Le champ doit seulement contenir des lettres.');
      $v->rule('emailDNS', 'contact_email')->message('L\'email saisi est incorrect.');
      $v->rule('alnum_unicode', ['contact_society', 'contact_address', 'contact_city', 'contact_iban'])->message('Le champ doit seulement contenir des chiffres ou des lettres.');
      $v->rule('iban', ['contact_iban'])->message('L\'IBAN saisi est incorrect.');
      $v->rule('numeric', ['contact_zipcode'])->message('Le champ doit seulement contenir des chiffres.');
      $v->rule('required', ['contact_gtu'])->message('Vous devez accepter nos CGV.');
      if($v->validate()) {
        try {

          if(empty($_SESSION['customer'])) {
            $customer = create_customer($_POST);
            $_SESSION['customer'] = $customer;
            $_SESSION['iban'] = $_POST['contact_iban'];
            $_SESSION['id_check'] = session_id();
          }
          else {
            $customer = update_customer($_SESSION['customer'], $_POST);
            $_SESSION['customer'] = $customer;
            $_SESSION['iban'] = $_POST['contact_iban'];
          }

          header("Location:".get_page_link(2706));
        }

        // Error Gestion
        catch(Exception $e) {
          throw $e;
        }
      } else {
          // Errors
          $errors = $v->errors();
      }
    }
  }
  catch(Exception $e) {
    $errors['gocardless'] = $e->getMessage();
  }

  
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $context['get_values'] = $_GET;
}

$context['errors'] = $errors;
$context['session'] = $_SESSION;

Timber::render( 'tunnel/form.twig', $context );