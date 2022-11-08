<?php
require_once "event.php";
require_once "mailFunctions.php";
session_start();
if (isset($_POST['register'])){
	$firstName =$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$mobile=$_POST['mobile'];
	$gmail=$_POST['gmail'];
	$password=md5($_POST['pswd']);
	$category=$_POST['category'];
	$address=$_POST['address'];
	$Name=$firstName.' '.$lastName;
	//echo $Name.' '.$mobile.' '.$gmail.' '.md5($password).' '.$category.' '.$address;
	$event = new Event;
	if($event->checkUserExistance($gmail,$mobile)){
		echo '<script>alert("Email or Mobile number already exist!!")</script>';
			 header("refresh:0; url=/register");
	}else{
	if(registrationMail($Name,$gmail)){
		if($event->userRegistration($Name,$password,$category,$gmail,$mobile,$address)){
		echo '<script>alert("Registration Success!!!")</script>';
			header("refresh:0; url=/login");
		}
		}else{
			echo '<script>alert("Enter your correct mail or there is some problem please try after some time! or contact us! ")</script>';
			 header("refresh:0; url=/register");
		}

	}
$event=null;
}else if(isset($_POST['login'])){
	$email =$_POST['gmail'];
	$password=md5($_POST['password']);
	//echo $email.' '.$password;
	$event = new Event;
	 if ($event->userLogin($email, $password)) {
	 	$_SESSION['userID'] =$event->getUserID($email);
		 $_SESSION['userName'] =$event->getUserName($email);
		 $_SESSION['userEmail'] =$email;
		 $event = null;
	 	header("Location: /userPanel");
	exit;

	}else{
		echo '<script>alert("Invalid User!!!")</script>';
			header("refresh:0; url=/login");
	}

}

?>