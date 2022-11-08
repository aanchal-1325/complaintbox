<?php
require_once "database.php";
class Event {
	public function getavailUser($category){
		$db = new database;
		$db->mk_conn();
		$sql="SELECT UID FROM users WHERE Category='$category' ORDER BY RAND() LIMIT 1";
		$result = $db->query($sql);
		$count=mysqli_num_rows($result);
		$db->close();
		if($count==0)
			return null;
		$row = $result->fetch_assoc();
		return $row['UID'];
	}
	public function getUserWork($id){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * FROM complaints c,assignment a WHERE a.CID =c.CID AND a.UID='$id'";
		$result = $db->query($sql);
		$db->close();
		$complaints = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($complaints, $row);
			$row = $result->fetch_assoc();
		}
		return $complaints;
	}
	public function updateStatusPanding($id){
		$db = new database;
		$db->mk_conn();
		$sql="UPDATE complaints SET Status='PENDING' WHERE CID='$id'";
		$result = $db->query($sql);
		$db->close();
		if ($result)
			return true;
		else
			return false;
	}
	public function getComplaintByStatus($status){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * FROM complaints WHERE status='$status'";
		$result = $db->query($sql);
		$db->close();
		$complaints = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($complaints, $row);
			$row = $result->fetch_assoc();
		}
		return $complaints;
	}
	
public function getCountActiveComplaint($userID){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from complaints where status = 'ACTIVE' AND UID='$userID'";
		$result = $db->query($sql);
		$db->close();
		return mysqli_num_rows($result);
	}
public function getTotalCountComplaint($userID){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from complaints where UID='$userID'";
		$result = $db->query($sql);
		$db->close();
		return mysqli_num_rows($result);
	}

public function assignWork($UID,$CID){
		$db = new database;
		$db->mk_conn();
		$sql = "INSERT INTO assignment(CID,UID)VALUES('$CID','$UID')";
		$result = $db->query($sql);
		$sql1="UPDATE complaints SET Status='ACTIVE' WHERE CID='$CID'";
		$result1 = $db->query($sql1);
		// $sql2="UPDATE users SET workStatus='YES' WHERE UID='$UID'";
		// $result2= $db->query($sql2);
		$db->close();
		if ($result&&$result1)
			return true;
		else
			return false;
}
public function getComplaintCategory($id){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT cType from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['cType'];
	}
public function getUsers(){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from users";
		$result = $db->query($sql);
		$db->close();
		$users = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($users, $row);
			$row = $result->fetch_assoc();
		}
		return $users;
}
public function getUserData($email){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from users WHERE Email='$email'";
		$result = $db->query($sql);
		$db->close();
		$users = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($users, $row);
			$row = $result->fetch_assoc();
		}
		return $users;
}
public function getUserByID($UID){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from users WHERE UID='$UID'";
		$result = $db->query($sql);
		$db->close();
		$cnt=mysqli_num_rows($result);
		if($cnt==0)
			return 0;
		$users = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($users, $row);
			$row = $result->fetch_assoc();
		}
		return $users;
}
public function getAllCategory($userType){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from users where Category='$userType'";
		$result = $db->query($sql);
		$db->close();
		$category = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($category, $row);
			$row = $result->fetch_assoc();
		}
		return $category;
}
public function getAssignedUserID($CID){
	$db = new database;
		$db->mk_conn();
		$sql = "SELECT UID from assignment where CID = '$CID'";
		$result = $db->query($sql);
		$count=mysqli_num_rows($result);
		$db->close();
		if($count==0)
				return 0;
		
		$row = $result->fetch_assoc();
		return $row['UID'];

}
public function getMobile($UID){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT Mobile from users where UID = '$UID'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['Mobile'];
}
public function getEmailByuserID($id) {
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT Email from users where UID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['Email'];
	}
public function getUserID($email) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT UID from users where Email = '$email'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['UID'];
	}
	public function getEmailID($uid) {
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT Email from users where UID = '$uid'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['Email'];
	}
public function getUserName($email) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT Name from users where Email = '$email'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['Name'];
	}
	public function getUserNameBYID($id) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT Name from users where UID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['Name'];
	}

public function userRegistration($Name,$password,$category,$gmail,$mobile,$address){
		$db = new database;
		$db->mk_conn();
		$sql = "INSERT INTO users(Name,Email,Password,Category,Mobile,Address) VALUES('$Name','$gmail','$password','$category','$mobile','$address')";
		$result = $db->query($sql);
		$db->close();
		if ($result)
			return true;
}
public function userRegistrationbyGoogleAccout($Name,$gmail){
		$db = new database;
		$db->mk_conn();
		$sql = "INSERT INTO users(Name,Email)VALUES('$Name','$gmail')";
		$result = $db->query($sql);
		$id=$db->getLastID();
		$db->close();
		if ($result)
			return $id;
}
	public function checkUserExistance($gmail,$mobile){
			$db = new database;
			$db->mk_conn();
			$sql = "SELECT * FROM users WHERE Email='$gmail' OR Mobile='$mobile'";
			$result = $db->query($sql);
			$db->close();
			if(mysqli_num_rows($result))
				return 1;
			else{
				return 0;
			}
	}
	public function checkUserExistance1($gmail){
			$db = new database;
			$db->mk_conn();
			$sql = "SELECT * FROM users WHERE Email='$gmail'";
			$result = $db->query($sql);
			$db->close();
			if(mysqli_num_rows($result))
				return 0;
			else{
				return 1;
			}
	}
	public function userLogin($email,$password){
		$db = new database;
			$db->mk_conn();
		$sql = "SELECT * FROM users WHERE Email='$email' AND Password='$password'";
			$result = $db->query($sql);
			$db->close();
			if(mysqli_num_rows($result))
				return 1;
			else{
				return 0;
			}
	}
	public function changePassword($email, $password){
		$db = new database;
			$db->mk_conn();
		$sql = "UPDATE users SET Password='$password' WHERE Email='$email'";
			$result = $db->query($sql);
			$db->close();
			if($result)
				return 1;
			else{
				return 0;
			}
	}
	public function updateProfile($UID,$mobile,$category,$address){
			$db = new database;
			$db->mk_conn();
		$sql = "UPDATE users SET Mobile='$mobile',Category='$category',
		Address='$address' WHERE UID='$UID'";
			$result = $db->query($sql);
			$db->close();
			if($result)
				return 1;
			else{
				return 0;
			}
	}
	public function markSolved($id){
		$db = new database;
			$db->mk_conn();
		$sql = "UPDATE complaints SET status='SOLVED' WHERE CID='$id'";
			$result = $db->query($sql);
			$db->close();
			if($result)
				return 1;
			else{
				return 0;
			}
	}
		public function addComment($UID, $CID, $dateTime, $comment,$Name) {
		$db = new database;
		$db->mk_conn();
		$sql = "INSERT into comments(CID,UID,timeDate,comment,Name) values('$CID','$UID','$dateTime', '$comment','$Name')";
		$result = $db->query($sql);
		$db->close();
		if ($result) {
			return true;
		}
	}
		public function getCommentsByID($id) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from comments where CID='$id'";
		$result = $db->query($sql);
		$db->close();
		$comments = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($comments, $row);
			$row = $result->fetch_assoc();
		}
		return $comments;
	}
    	public function addComplaint($uid, $cdate, $ctime, $subject, $dec,$category) {
		$db = new database;
		$db->mk_conn();
		$sql = "INSERT into complaints(UID,cDate,cTime,subject,cDescription,cType) values('$uid', '$cdate', '$ctime', '$subject', '$dec','$category')";
		$result = $db->query($sql);
		$db->close();
		if ($result) {
			return true;
		}

	}
	public function updateComplaint($cid, $cdate, $ctime, $subject, $dec) {
		$db = new database;
		$db->mk_conn();
		$sql = "UPDATE complaints SET cDate='$cdate',cTime='$ctime',subject='$subject',cDescription='$dec' WHERE CID='$cid'";
		$result = $db->query($sql);
		$db->close();
		if ($result) {
			return true;
		}

	}
	
	public function getStandardComplaints(){
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from standardcomplaints";
		$result = $db->query($sql);
		$db->close();
		$complaints = array();
		$row = $result->fetch_assoc();
		while($row){
			array_push($complaints, $row);
			$row = $result->fetch_assoc();
		}
		return $complaints;
	}

	public function getComplaints($userID) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from complaints WHERE UID='$userID'";
		$result = $db->query($sql);
		$db->close();
		$complaints = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($complaints, $row);
			$row = $result->fetch_assoc();
		}
		return $complaints;
	}
	public function getComplaintsByID($id) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT * from complaints where CID='$id'";
		$result = $db->query($sql);
		$db->close();
		$complaints = array();
		$row = $result->fetch_assoc();
		while ($row) {
			array_push($complaints, $row);
			$row = $result->fetch_assoc();
		}
		return $complaints;
	}

	public function Deletecomplaint($id) {

		$db = new database;
		$db->mk_conn();
		$sql = "DELETE from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		if ($result) {
			return true;
		}

	}
	public function deleteUser($UID){
		$db = new database;
		$db->mk_conn();
		//$sql1="UPDATE complaints SET Status='PENDING' WHERE IN (SELECT CID FROM assignment WHERE UID='$UID')";
	//	$result = $db->query($sql1);
		$sql = "DELETE from users where UID = '$UID'";
		$result = $db->query($sql);
		$db->close();
		if ($result) {
			return true;
		}
	}

	public function getDescription($id) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT cDescription from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['cDescription'];
	}

	public function getTime($id) {

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT cTime from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['cTime'];
	}
	public function getUserIDbyCID($id) {
		$db = new database;
		$db->mk_conn();
		$sql = "SELECT UID from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['UID'];
	}
	public function getDate($id){

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT cDate from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['cDate'];
	}
	public function getSubject($id){

		$db = new database;
		$db->mk_conn();
		$sql = "SELECT subject from complaints where CID = '$id'";
		$result = $db->query($sql);
		$db->close();
		$row = $result->fetch_assoc();
		return $row['subject'];
	}
	public function addStandardComplaint($uid, $cdate, $ctime, $subject, $dec,$category){
		$db = new database;
		$db->mk_conn();
		$sql = "INSERT into complaints(UID,cDate,cTime,subject,cDescription,cType,status) values('$uid', '$cdate', '$ctime', '$subject', '$dec','$category','AUTOMETIC')";
		$result = $db->query($sql);
		$id=$db->getLastID();
		$db->close();
		if ($result)
			return $id;

		}
}
?>