<?php

session_start();
require_once "../vendor/autoload.php";

if (isset($_SESSION['google'])){

//Make object of Google API Client for call Google API
    $google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
    $google_client->setClientId('1042968621215-5h6voj4amt32hmddcsmpfbpr2o3k8tpa.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
    $google_client->setClientSecret('TXf0qO4MoOa1M9a3G6gFsPja');

//Set the OAuth 2.0 Redirect URI
    $google_client->setRedirectUri('http://localhost:8080/login/google.php');
//
    $google_client->addScope('email');
    $google_client->addScope('profile');
    $google_client->revokeToken();

}


session_destroy();
session_abort();
header("LOCATION: ../../index.php");
