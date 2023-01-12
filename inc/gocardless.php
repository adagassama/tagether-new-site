<?php

$gocardless = new \GoCardlessPro\Client([
  // We recommend storing your access token in an
  // environment variable for security, but you could
  // include it as a string directly in your code
  'access_token' => GC_ACCESS_TOKEN,
  // Change me to LIVE when you're ready to go live
  'environment' => \GoCardlessPro\Environment::LIVE
]);

function create_customer($post) {
  global $gocardless;

  $customer = $gocardless->customers()->create([
    "params" => [
      "given_name" => $post['contact_name'],
      "family_name" => $post['contact_lsname'],
      "email" => $post['contact_email'],
      "address_line1" => $post['contact_address'],
      "city" => $post['contact_city'],
      "postal_code" => $post['contact_zipcode'],
      "country_code" => "FR",
      ]
  ]);

  return $customer;
}

function create_bank_account($customer, $iban) {
  global $gocardless;

  $bank_account = $gocardless->customerBankAccounts()->create([
    "params" => [
      "account_holder_name" => $customer->given_name[0] . ' ' . $customer->family_name,
      "iban" => $iban,
      "links" => ["customer" => $customer->id],
      ]
  ]);

  return $bank_account;
}

function create_mandate($bank_account) {
  global $gocardless;
  
  $mandate = $gocardless->mandates()->create([
    "params" => [
      "links" => ["customer_bank_account" => $bank_account->id]]
  ]);

  return $mandate;
}

function update_customer($customer, $post) {
  global $gocardless;

  $customer_updated = $gocardless->customers()->update($customer->id, [
    "params" => [
      "given_name" => $post['contact_name'],
      "family_name" => $post['contact_lsname'],
      "email" => $post['contact_email'],
      "address_line1" => $post['contact_address'],
      "city" => $post['contact_city'],
      "postal_code" => $post['contact_zipcode'],
      "country_code" => "FR",
    ]
  ]);

  return $customer_updated;
}

function mandateToPdf($mandate) {
  global $gocardless;

  $mandatePdf = $gocardless->mandatePdfs()->create([
    "params" => ["links" => ["mandate" => $mandate->id]]
  ]);

  return $mandatePdf;
}