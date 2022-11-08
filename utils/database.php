<?php
//user:complaintboxuser:id19809824_complaintboxuser
//pass:OKatuP#$t=ZT]F9D
//dbname:complaintbox:id19809824_complaintbox
class database {
	private $conn;
	function mk_conn() {
		
		$server ="localhost";
		$user = "root";
		$pass = "";
		$dbName ="complaintbox";

		$this->conn = new mysqli($server, $user, $pass, $dbName);

		if ($this->conn->connect_error) {

			error_log("Failed to connect to database!", 0);
		}
	}

	function query($sql) {
		$result = $this->conn->query($sql);
		if ($result) {
			return $result;
		} else {
			error_log($sql . "\t" . $this->conn->error, 0);
		}
	}
	function getLastID(){
		return mysqli_insert_id($this->conn);
	}
	function close() {
		$this->conn->close();
	}

}

?>