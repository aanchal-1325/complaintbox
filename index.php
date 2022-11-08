<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'utils/mail.php';
require_once 'utils/functions.php';
require_once 'utils/event.php';
require_once 'vendor/autoload.php';
require_once 'utils/config.php';
require_once 'utils/fbconfig.php';
ini_set('display_errors', 1);
error_reporting(~0);

$pageFound=false;
$errorMsg="";

$loader = new Twig_Loader_Filesystem('resources');
$twig = new Twig_Environment($loader);

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);

if($uri[1]=='logout') {
	header('HTTP/1.1 401 Unauthorized');
	$errorMsg = 'You have been logged Out!!!';
	//Reset OAuth access token
	$google_client->revokeToken();
	session_unset();
	unset($_POST);
	session_destroy();
	goto notFound;
}
if (empty($uri[1])) {
		$pageFound=true;
		echo $twig->render('web/home.html', array('title' => 'Home Page'));

}else if ($uri[1]=='userPanel') {
	if(!isset($_SESSION['userName'])){
		$errorMsg="Invalid Access!!";
		goto notFound;
	}
	$userName= $_SESSION['userName'];
	$userEmail= $_SESSION['userEmail'];
	$userID=$_SESSION['userID'];
	if (empty($uri[2])||isset($_GET['code']) ){
	$pageFound=true;
	echo $twig->render('userPanel/dash.html', array('title' => 'Dashboard','uName'=>$userName,'uEmail'=>$userEmail));
	}else if ($uri[2] == 'newComplaint'){
		$pageFound=true;
		echo $twig->render('userPanel/addcomplaint.html', array('title' => 'New Complaint','uName'=>$userName,'uEmail'=>$userEmail));
	}else if($uri[2] == 'userProfile') {
		$pageFound=true;
		$Events = new Event;
		$userdata=$Events->getUserData($userEmail);
		$activeCount = $Events->getCountActiveComplaint($userID);
		$totalCount = $Events->getTotalCountComplaint($userID);
		echo $twig->render('userPanel/userProfile.html', array('title' => 'userProfile','uName'=>$userName,'uEmail'=>$userEmail,'userID'=>$userID,'activeCount'=>$activeCount,'totalCount'=>$totalCount,'users'=>$userdata));
	}else if ($uri[2]=='standardComplaint') {
		$pageFound=true;
		$Events = new Event;
		$Complaints = $Events->getStandardComplaints();
		echo $twig->render('userPanel/standardComplaint.html', array('title' => 'standard Complaint','uName'=>$userName,'uEmail'=>$userEmail,'complaints'=>$Complaints));
	}else if ($uri[2] == 'userWork') {
		$pageFound=true;
		$Events = new Event;
		$complaints = $Events->getUserWork($userID);
		 echo $twig->render('userPanel/myWork.html', array('title' => 'WorkSection',
		 	'uName'=>$userName,'uEmail'=>$userEmail,'complaints'=>$complaints));
	}else if ($uri[2] == 'viewComplaint') {
		$pageFound=true;
		$Events = new Event;
		$Complaints = $Events->getComplaints($userID);
		echo $twig->render('userPanel/viewComplaint.html', array('title' => 'View Complaint','complaints'=>$Complaints,'uName'=>$userName,'uEmail'=>$userEmail));
	}else if ($uri[2] == 'complaintDetails') {
		if(!isset($_GET['id'])){
			goto notFound;
		}
		$pageFound=true;
		$Name='';
		$id=$_GET['id'];
		$Events = new Event;
		$Worker=0;
		$Complaints = $Events->getComplaintsByID($id);
		$UID=$Events->getAssignedUserID($id);
		if($UID!=0)
		$Worker=$Events->getUserByID($UID);
		 if($Worker==0){
			$Worker="NODATA";
		 }
		$comments=$Events->getCommentsByID($id);
		echo $twig->render('userPanel/complaintDetails.html', array('title' => 'Complaint','complaints'=>$Complaints,'comments'=>$comments,'description' => file_get_contents($Events->getDescription($id)),'uName'=>$userName,'uEmail'=>$userEmail,'worker'=>$Worker));
	}elseif (strstr($uri[2], 'deleteComplaint')) {
		if(!isset($_GET['id'])){
			goto notFound;
		}
			$pageFound = true;
			$id=$_GET['id'];
			$event = new Event;
			$description = $event->getDescription($id);
			if ($event->Deletecomplaint($id)) {
				unlink($description);
				header("Location: /userPanel");
				$event = null;
				exit;

			}
	}elseif (strstr($uri[2], 'colseComplaint')) {
		if(!isset($_GET['id'])){
			goto notFound;
		}
			$pageFound = true;
			$id=$_GET['id'];
			$event = new Event;
			if ($event->markSolved($id)){
				header("Location: /userPanel/userWork");
				$event = null;
				exit;

			}
	}elseif (strstr($uri[2], 'updateComplaint')) {
			$pageFound = true;
			$id=$_GET['id'];
			$event = new Event;
			$subject = $event->getSubject($id);
			$cDate = $event->getDate($id);
			$cTime = $event->getTime($id);
			echo $twig->render('userPanel/updateComplaint.html', array('title' => 'Update Complaint','description' => file_get_contents($event->getDescription($id)),'uName'=>$userName,'uEmail'=>$userEmail,'subject'=>$subject,'cDate'=>$cDate,'cTime'=>$cTime,'id'=>$id));		
	}

}else if ($uri[1]=='adminPanel') {
	
	 if (empty($uri[2])){
	 if (!auth_user()) {
		$errorMsg="invalid userName or Password";
		goto notFound;
 	}
	$pageFound=true;
		echo $twig->render('adminPanel/dash.html', array('title' => 'Dashboard'));
	}else if ($uri[2] == 'complaintData') {
		$pageFound=true;
		$id=$_GET['id'];
		$Events = new Event;
		$Worker=0;
		$UID=$Events->getAssignedUserID($id);
		if($UID!=0)
		$Worker=$Events->getUserByID($UID);
		$complaints = $Events->getComplaintsByID($id);
		$comments=$Events->getCommentsByID($id);
	echo $twig->render('adminPanel/complaintData.html',  array('title' => 'Complaint Data','complaints'=>$complaints,'comments'=>$comments,'description' => file_get_contents($Events->getDescription($id)),'Worker'=>$Worker));
	}else if ($uri[2] == 'unseenComplaints') {
		$pageFound=true;
		$event = new Event;
		$complaints = $event->getComplaintByStatus("UNSEEN");
		echo $twig->render('adminPanel/unseenComplaints.html', array('title' => ' unseenComplaints','complaints'=>$complaints));
	}else if ($uri[2] == 'activeComplaints') {
		$pageFound=true;
		$event = new Event;
		$complaints = $event->getComplaintByStatus("ACTIVE");
		echo $twig->render('adminPanel/activeComplaints.html', array('title' => ' activeComplaints','complaints'=>$complaints));
	}else if ($uri[2] == 'pendngComplaints') {
		$pageFound=true;
		$event = new Event;
		$complaints = $event->getComplaintByStatus("PENDING");
		echo $twig->render('adminPanel/pendngComplaints.html', array('title' => ' pendngComplaints','complaints'=>$complaints));
	}else if ($uri[2] == 'resolvedComplaints') {
		$pageFound=true;
		$event = new Event;
		$complaints = $event->getComplaintByStatus("SOLVED");
		echo $twig->render('adminPanel/resolvedComplaints.html', array('title' => ' resolvedComplaints','complaints'=>$complaints));
	}else if ($uri[2] == 'usersProfile') {
		$pageFound=true;
		$event = new Event;
		$users=$event->getUsers();
		echo $twig->render('adminPanel/users.html', array('title' => 'usersProfile','users'=>$users));
	}else if ($uri[2] == 'userDeatils') {
		if(!isset($_GET['id'])){
			goto notFound;
		}
			$pageFound = true;
			$UID=$_GET['id'];
			$event = new Event;
			$users=$event->getUserByID($UID);
			$Complaints = $event->getComplaints($UID);
		echo $twig->render('adminPanel/usersDetails.html', array('title' => 'usersData','users'=>$users,'complaints'=>$Complaints));
	}elseif (strstr($uri[2], 'deleteUser')) {
		if(!isset($_GET['id'])){
			goto notFound;
		}
			$pageFound = true;
			$id=$_GET['id'];
			$event = new Event;
			if ($event->deleteUser($id)) {
				header("Location: /adminPanel/usersProfile");
				$event = null;
				exit;
		}
	}else if ($uri[2] =='complaintDetails') {
		if(!isset($_GET['id'])){
			goto notFound;
		}
		$pageFound=true;
		$id=$_GET['id'];
		$Events = new Event;
		$Events->updateStatusPanding($id);
		$UID=$Events->getUserIDbyCID($id);
		$email=$Events->getEmailByuserID($UID);
		$message="Your compalint seen by Admin they will sortly assign to some team member! Take Care (:-:) ";
		//sendUpdate($email,$message);
		$cat=$Events->getComplaintCategory($id);
		$category=$Events->getAllCategory(trim($cat));
		$Complaints = $Events->getComplaintsByID($id);
		$comments=$Events->getCommentsByID($id);
		echo $twig->render('adminPanel/complaintDetails.html', array('title' => 'Complaint','complaints'=>$Complaints,'comments'=>$comments,'categories'=>$category,'description' => file_get_contents($Events->getDescription($id))));
	}
}else if ($uri[1]=='about'){
	$pageFound = true;
	echo $twig->render('web/about.html', array('title' => 'About US'));
}
else if ($uri[1]=='blogs'){
	$pageFound = true;
	echo $twig->render('web/blogs.html', array('title' => 'Blogs'));
	}else if ($uri[1]=='contact'){
	$pageFound = true;
	echo $twig->render('web/contact.html', array('title' => 'Contact US'));
}else if ($uri[1]=='register'){
	$pageFound = true;
	if(isset($_SESSION['userName'])){
	$userName= $_SESSION['userName'];
	$userEmail= $_SESSION['userEmail'];
	$userID=$_SESSION['userID'];
			if (empty($uri[2])||isset($_GET['code']) ){
			$pageFound=true;
			echo $twig->render('userPanel/dash.html', array('title' => 'Dashboard','uName'=>$userName,'uEmail'=>$userEmail));

			}
	}else{
	echo $twig->render('web/register.html', array('title' => 'Register'));
	}
}else if ($uri[1]=='login'){
	$pageFound = true;
	if(isset($_SESSION['userName'])){
	$userName= $_SESSION['userName'];
	$userEmail= $_SESSION['userEmail'];
	$userID=$_SESSION['userID'];
			if (empty($uri[2])||isset($_GET['code']) ){
			$pageFound=true;
			echo $twig->render('userPanel/dash.html', array('title' => 'Dashboard','uName'=>$userName,'uEmail'=>$userEmail));

			}
		}else{
	$login_button=$google_client->createAuthUrl();
	echo $twig->render('web/login.html', array('title' => 'Login','login'=>$login_button,'fblogin'=>$loginUrl));
	}
}
notFound:if (!$pageFound) {

	echo $twig->render('web/404.html', array('title' => '404!','message'=>$errorMsg));
}
//ID 675623056178-uhlpgh3i7hfn2sqa8h1a87lh8b2ugp1c.apps.googleusercontent.com

//CS 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
?>
