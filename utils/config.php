<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//Include Google Client Library for PHP autoload file
require_once 'C:/xampp/htdocs/complaintBox/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('675623056178-uhlpgh3i7hfn2sqa8h1a87lh8b2ugp1c.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://complaintbox.co.in/login');
//$google_client->setRedirectUri('http://complaintbox.co.in/utils/googleRequst.php');
$google_client->setRedirectUri('http://complaintbox.co.in/userPanel/');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

$login_button = '';
if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

  $Name='';
  if(!empty($data['given_name']))
  {
   $Name= $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $Name=$Name.' '.$data['family_name'];
     $_SESSION['userName'] =$Name;
  }

  if(!empty($data['email']))
  {
   $_SESSION['userEmail'] = $data['email'];
  }

  $event = new Event;
  if(!($event->checkUserExistance1($_SESSION['userEmail']))){
  	$_SESSION['userID']=$event->getUserID($_SESSION['userEmail']);
  }else{
  	$_SESSION['userID']=$event->userRegistrationbyGoogleAccout($_SESSION['userName'],
  		$_SESSION['userEmail']);
  }
  $event=null;

 }
}

?>