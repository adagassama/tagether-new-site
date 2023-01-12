<?php

function addInNewsletter($email) {
  // Instantiate curl
  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, 'https://twitter.us19.list-manage.com/subscribe/post-json?u=3234d3702a935ab9745bf364f&id=ce5ce20826&c=?');
  curl_setopt($curl, CURLOPT_POSTFIELDS, 'MERGE0='.urlencode($email));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $result = curl_exec($curl);

  curl_close($curl);

  return $result;
}