<?php

//start session on web page

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('140344111241-rkoocfv85jgqlfg517trq1tmq3f0kdqj.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/PROJECT_REGISTER_AND_LOGIN/index_test.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>