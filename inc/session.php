<?php

// Start Session
add_action('init', 'start_session', 1);
function start_session() {
  if(!session_id()) {
    session_start();
  }
}

// Destroy Session
add_action('wp_logout', 'end_session');
add_action('wp_login', 'end_session');
add_action('end_session_action', 'end_session'); // Call 'do_action('end_session_action');' if need to destroy session somewhere
function end_session() {
  $_SESSION = array();
  session_regenerate_id(true);
  session_destroy ();
}