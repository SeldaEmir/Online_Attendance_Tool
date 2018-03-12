<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '522968522410-lsss0270pbp5t2hv5jjmi5kqe5c000nb.apps.googleusercontent.com'; //Google client ID
$clientSecret = '0Y7kFG55DCPTxP_fVsMrG8zi'; //Google client secret
$redirectURL = 'http://localhost/login_with_google_using_php/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('php-project-sehir');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>