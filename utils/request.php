<?php
require_once "event.php";
require_once "mailFunctions.php";
date_default_timezone_set('Asia/Kolkata');
session_start();
if (isset($_POST['addComplaint'])) {
	$subject =$_POST['subject'];
	$cdate =$_POST['cdate'];
	$ctime =$_POST['ctime'];
	$uid= $_SESSION['userID'];
	$category=$_POST['category'];
	if (!empty($_POST['cDescription'])) {
		$cDescription = "description/".rand().rand().rand().".html";
		$description = $_POST['cDescription'];
		$descFile = fopen("../" . $cDescription, "w");
		fwrite($descFile, $description);
		fclose($descFile);

	}
	$event = new Event;
if($event->addComplaint($uid, $cdate, $ctime, $subject, $cDescription,$category)) {
		$msg="Hey! ".$_SESSION['userName']." Your complaint submitted successfully  we'll assign your complaint to our worker soon, you will get update regrading this complaint and will try to resolve it faster!, ThankYou!! ";
		sendUpdate($_SESSION['userEmail'],$msg);
		$event = null;
	 	header("Location: /userPanel/viewComplaint");

	}

}else if (isset($_POST['UpdateComplaint'])) {
	$subject =$_POST['subject'];
	$cdate =$_POST['cdate'];
	$ctime =$_POST['ctime'];
	$cid=$_POST['CID'];

	if (!empty($_POST['cDescription'])) {
		$cDescription = "description/" .rand().$ctime.$uid.".html";
		$description = $_POST['cDescription'];
		$descFile = fopen("../" . $cDescription, "w");
		fwrite($descFile, $description);
		fclose($descFile);

	}
	$event = new Event;
	 if ($event->updateComplaint($cid, $cdate, $ctime, $subject, $cDescription)) {
		$event = null;
	 	header("Location: /userPanel");
	 	exit;

	}

}else if (isset($_POST['assignWork'])){
	$Name="Admin";
	$CID=$_POST['CID'];
	$UID=$_POST['UID'];
	$comment=$_POST['comment'];
 	$dateTime= date("M,d,Y h:i:s A");
 	$event = new Event;
	 if($event->addComment($UID, $CID, $dateTime, $comment,$Name)&&
	 	$event->assignWork($UID, $CID)) {
		$event = null;
	 	header("Location: /adminPanel/unseenComplaints");
	 	exit;
	}
}else if (isset($_POST['addUserComment'])){
	$UID= $_SESSION['userID'];
	$CID=$_POST['CID'];
	$Name=$_SESSION['userName'];
	$comment=$_POST['comment'];
 	$dateTime= date("M,d,Y h:i:s A");
 	$event = new Event;
	 if ($event->addComment($UID, $CID, $dateTime, $comment,$Name)) {
		$event = null;
	 	header("Location: /userPanel/complaintDetails/?id=$CID");
	 	exit;

	}
}else if (isset($_POST['addAdminComment'])){
	$UID= 0;
	$CID=$_POST['CID'];
	$Name="Admin";
	$comment=$_POST['comment'];
 	$dateTime= date("M,d,Y h:i:s A");
 	$event = new Event;
	 if ($event->addComment($UID, $CID, $dateTime, $comment,$Name)) {
		$event = null;
	 	header("Location: /adminPanel/complaintData/?id=$CID");
	 	exit;

	}
}else if(isset($_POST['sendEmail'])){
	$CID=$_POST['CID'];
	$subject=$_POST['subject'];
	$msg=$subject.$_POST['message'];
	$event = new Event;
	$UID=$event->getUserIDbyCID($CID);
	$gmail=$event->getEmailID($UID);
	if(sendUpdate($gmail,$msg)){
	echo '<script>alert("Your Message has been sent!!!")</script>';
		 header("refresh:0; url=/userPanel/userWork");
	}else{
		echo '<script>alert("There is some problem please try after some time!")</script>';
		 header("refresh:0; url=/userPanel/userWork");
	}

}else if(isset($_POST['query'])){
	$Name=$_POST['userName'];
	$userMail=$_POST['userMail'];
	$Msg=$_POST['message'];
	$subject="Query From Complaint Box";
	if(sendMail($Name,$userMail,$subject,$Msg)){
	echo '<script>alert("Thanks! ,we will contact you ASAP!")</script>';
		 header("refresh:0; url=/");
	}else{
		echo '<script>alert("There is some problem please try after some time!")</script>';
		 header("refresh:0; url=/");
	}

}else if(isset($_POST['changePassword'])){
	$changePassword=$_POST['password'];
	$event = new Event;
if($event->changePassword($_SESSION['userEmail'],md5($changePassword))){
	$event = null;
	echo '<script>alert("password changed!")</script>';
	$msg="Hay! ".$_SESSION['userName']." your password changed successfully your new password is ".$changePassword." ,you can also change your password in your profile section thankyou!! ";
		sendUpdate($_SESSION['userEmail'],$msg);

		 header("refresh:0; url=/userPanel/userProfile");
	}else{
		$event = null; 
		echo '<script>alert("There is some problem please try after some time!")</script>';
		 header("refresh:0; url=/userPanel/userProfile");
	}


}else if(isset($_POST['forgetPassword'])){
	$gmail=$_POST['gmail'];
	$event = new Event;
	if($event->checkUserExistance1($gmail)){
echo'<script>alert("User with this Email ID ' .$gmail .' DNE!!")</script>';
			 header("refresh:0; url=/login");
	}
	$changePassword=rand();
	if($event->changePassword($gmail,md5($changePassword))){
	$event = null;
	echo '<script>alert("password changed check your email box! !")</script>';
	$msg="Hey! your password changed successfully.Your new password is ".$changePassword." ,ThankYou!! ";
		sendUpdate($gmail,$msg);

		 header("refresh:0; url=/");
	}else{
		$event = null; 
		echo '<script>alert("There is some problem please try after some time!")</script>';
		 header("refresh:0; url=/");
	}


}else if (isset($_POST['standardComplaints'])) {
	$subject =$_POST['subject'];
	$cdate =date("M,d,Y");
	$ctime =date("h:i:s A");
	$uid= $_SESSION['userID'];
	$category=$_POST['category'];
	if (!empty($_POST['cDescription'])) {
		$cDescription = "description/".rand().rand().rand().".html";
		$description = $_POST['cDescription'];
		$descFile = fopen("../" . $cDescription, "w");
		fwrite($descFile, $description);
		fclose($descFile);

	}
	$event = new Event;
	$UID=$event->getavailUser(trim($category));
	if($UID==null){
		echo '<script>alert("There is no user available at this time please try after some time!")</script>';
		 header("refresh:0; url=/userPanel/standardComplaint");
	}else{
	
	$CID=$event->addStandardComplaint($uid, $cdate, $ctime, $subject, $cDescription,$category);
			if($event->assignWork($UID,$CID)){
			$msg="Hey! ".$_SESSION['userName']." Your complaint with complaint id ".$CID." assigned to our Department team,you will get update soon regrading this complaint!, Thankyou!! ";
				sendUpdate($_SESSION['userEmail'],$msg);
				$event = null;
			 	header("Location: /userPanel/viewComplaint");
			 	exit;
		}	}


}else if (isset($_POST['updateProfile'])){
	$mobile=$_POST['Mobile'];
	$category=$_POST['category'];
	$address=$_POST['address'];
	$UID=$_SESSION['userID'];
	$event = new Event;
	 if ($event->updateProfile($UID,$mobile,$category,$address)) {
		$event = null;
	 	header("Location: /userPanel/userProfile");
	 	exit;

	}
}

?>