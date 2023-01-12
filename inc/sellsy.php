<?php

use GuzzleHttp\Client;
use Teknoo\Sellsy\Transport\Guzzle;
use Teknoo\Sellsy\Sellsy;

//Create the HTTP client
$guzzleClient = new Client();

//Create the transport bridge
$transportBridge = new Guzzle($guzzleClient);

//Create the front object
$sellsy = new Sellsy(
  'https://apifeed.sellsy.com/0/', // API URL
  SELLSY_UT, // User Token
  SELLSY_US, // User Secret
  SELLSY_CT, // Consumer Token
  SELLSY_CS // Consumer Secret
);

$sellsy->setTransport($transportBridge);

function create_client($session) {
  global $sellsy;

  $third = array(
    'name' => $session['post_values']['contact_society'],
    'email' => $session['customer']->email,
  );
  $contact = array(
    'name' => $session['customer']->family_name,
    'forename' => $session['customer']->given_name,
    'email' => $session['customer']->email,
    'mcoptin' => true,
  );
  $address = array(
    'name' => 'Adresse Principale',
    'part1' => $session['customer']->address_line1,
    'zip' => $session['customer']->postal_code,
    'town' => $session['customer']->city,
  );

  $newSellsyClient = array(
    'third' => $third,
    'contact' => $contact,
    'address' => $address,
  );

  $client = $sellsy->Client()->create($newSellsyClient)->getResponse();
  return $client;
}

function check_client($email) {
  global $sellsy;

  $search = array(
    'contains' => $email
  );

  $client = $sellsy->Client()->getList(
    array(
      'search' => $search
    )
  )->getResponse();
  
  return count($client['result']);
}