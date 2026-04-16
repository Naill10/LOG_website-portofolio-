<?php
require '../vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('57784371766-bq1boo41c17b81nmacnuocjn91j9ab1a.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/LOG_WEB/login/google-callback.php');

$client->addScope("email");
$client->addScope("profile");

header('Location: ' . $client->createAuthUrl());
exit;