<?php

class Tutor{

	public $tutorId;
	public $userId;
	public $tutorStatus;
	public $DaysAvail;
	public $TimeAvail;
	public $dateadded;

	public $acctId;
	public $fname;
	public $lname;
	public $contact;
	public $usertype;
	public $status;
	public $password;
	public $email;

	public $accounts;

	private $conn;

	function __construct($db){
		$this->conn = $db;
	}

	function addtutor(){
		$query = "INSERT INTO tutor SET userId = ?, tutorStatus =?, dateadded=?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->userId);
		$stmt->bindParam(2,$this->tutorStatus);
		$stmt->bindParam(3,$this->dateadded);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function addTutor2(){
		$query = "INSERT INTO tutor SET userId = ?, tutorStatus =?, DaysAvail = ?, TimeAvail = ?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->userId);
		$stmt->bindParam(2,$this->tutorStatus);
		$stmt->bindParam(3,$this->DaysAvail);
		$stmt->bindParam(4,$this->TimeAvail);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function viewtutor(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId GROUP BY tutor.userId";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}

	function viewtutorrequest(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutorStatus='Pending'";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}

	function viewonetutor(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutor.userId = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->tutorId);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->userId = $row['userId'];
		$this->fname = $row['fname'];
		$this->lname = $row['lname'];
		$this->contact = $row['contact'];
		$this->email = $row['email'];
		$this->tutorStatus = $row['tutorStatus'];
	}

	function viewonetutor2($id){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutor.userId = ? GROUP BY tutor.userId";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->tutorId = $row['tutorId'];
		$this->fname = $row['fname'];
		$this->lname = $row['lname'];
		$this->contact = $row['contact'];
		$this->email = $row['email'];
		$this->tutorStatus = $row['tutorStatus'];
	}

	function updateRequest(){
		$query = "UPDATE tutor SET tutorStatus=? WHERE userId=?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->tutorStatus);
		$stmt->bindParam(2,$this->userId);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function viewTutorsAct(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutorStatus='Active' GROUP BY tutor.userId ORDER BY tutor.tutorId";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewTutorsInac(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutorStatus='Inactive' GROUP BY tutor.userId";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewTutorsAll(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId GROUP BY tutor.userId";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewTutorsPend(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutorStatus='Pending'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewTutorsDec(){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE tutorStatus='Declined'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function searchTutors($uinput){

		#$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE userId LIKE '%{$uinput}%' OR fname LIKE '%{$uinput}%' OR lname LIKE '%{$uinput}%' OR contact LIKE '%{$uinput}%' OR email LIKE '%{$uinput}%' ORDER BY tutorId";

		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE (tutor.userId LIKE '%{$uinput}%') OR (fname LIKE '%{$uinput}%') OR (lname LIKE '%{$uinput}%') OR (contact LIKE '%{$uinput}%') OR (email LIKE '%{$uinput}%') GROUP BY tutor.userId ORDER BY tutorId";

		$srch = $this->conn->prepare($query);
		$srch->execute();


		return $srch;
	}

	function searchTutorsAct($uinput){

		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE ((tutor.userId LIKE '%{$uinput}%') OR (fname LIKE '%{$uinput}%') OR (lname LIKE '%{$uinput}%') OR (contact LIKE '%{$uinput}%') OR (email LIKE '%{$uinput}%')) AND tutorStatus = 'Active' GROUP BY tutor.userId ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchTutorsInac($uinput){

		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE ((tutor.userId LIKE '%{$uinput}%') OR (fname LIKE '%{$uinput}%') OR (lname LIKE '%{$uinput}%') OR (contact LIKE '%{$uinput}%') OR (email LIKE '%{$uinput}%')) AND tutorStatus = 'Inactive' GROUP BY tutor.userId ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchTutorsPend($uinput){

		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE ((tutor.userId LIKE '%{$uinput}%') OR (fname LIKE '%{$uinput}%') OR (lname LIKE '%{$uinput}%') OR (contact LIKE '%{$uinput}%') OR (email LIKE '%{$uinput}%')) AND tutorStatus = 'Pending' GROUP BY tutor.userId ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchTutorsDec($uinput){

		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE ((tutor.userId LIKE '%{$uinput}%') OR (fname LIKE '%{$uinput}%') OR (lname LIKE '%{$uinput}%') OR (contact LIKE '%{$uinput}%') OR (email LIKE '%{$uinput}%')) AND tutorStatus = 'Declined' GROUP BY tutor.userId ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function viewTutorTopic(){
		$query = "SELECT * FROM topic_taught INNER JOIN tutor ON tutor.userId = topic_taught.tutorId INNER JOIN topic ON topic_taught.topicId = topic.topicId INNER JOIN subject ON subject.subjId = topic.subjId WHERE tutor.userId = ? GROUP BY taughtId";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->userId);
		$stmt->execute();

		return $stmt;
	}

	function viewTutorTopicAct(){
		$query = "SELECT * FROM topic_taught INNER JOIN tutor ON tutor.userId = topic_taught.tutorId INNER JOIN topic ON topic_taught.topicId = topic.topicId INNER JOIN subject ON subject.subjId = topic.subjId WHERE tutor.userId = ? AND topic.topstatus = 'Active' AND subject.subjstat = 'Active' GROUP BY taughtId";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->userId);
		$stmt->execute();

		return $stmt;
	}

	function viewTutorAvail(){
		$query = "SELECT tutorId, DaysAvail, TimeAvail FROM tutor WHERE userId = ? AND (DaysAvail != '' OR TimeAvail != '') ORDER BY (CASE WHEN DaysAvail='Monday' THEN 1 WHEN DaysAvail='Tuesday' THEN 2 WHEN DaysAvail='Wednesday' THEN 3 WHEN DaysAvail='Thursday' THEN 4 ELSE DaysAvail END), TimeAvail";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->userId);
		$stmt->execute();

		return $stmt;
	}

	function checkTimeDay($day,$time,$id){
		$query = "SELECT tutorId FROM tutor WHERE (DaysAvail = ? AND TimeAvail = ?) AND userId = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $day);
		$stmt->bindparam(2, $time);
		$stmt->bindparam(3, $id);
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}

	function readTutorTop($id){
		$query = "SELECT * FROM topic_taught INNER JOIN tutor ON topic_taught.tutorId = tutor.userId INNER JOIN accounts ON topic_taught.tutorId = accounts.userId WHERE topic_taught.topicId = ? GROUP BY tutor.userId";

		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $id);

		$stmt->execute();

		return $stmt;
	}

	function readMyTopics($tutor){
		$query = "SELECT * FROM topic_taught INNER JOIN tutor ON tutor.userId = topic_taught.tutorId INNER JOIN topic ON topic.topicId = topic_taught.topicId INNER JOIN subject ON topic.subjId = topic.subjId WHERE topstatus = 'Active' AND topic_taught.tutorId =? GROUP BY taughtId";
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $tutor);

		$stmt->execute();

		return $stmt;
	}

	function addTutorTopic($topic,$tutor){
		$query = "INSERT INTO topic_taught SET topicId = ?, tutorId =?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$topic);
		$stmt->bindParam(2,$tutor);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function removeTutorTopic($id){
		$query = "DELETE FROM topic_taught WHERE taughtId = ?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$id);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function removeTutorAvail($id,$day,$time){
		$query = "DELETE FROM tutor WHERE tutorId = ? AND (DaysAvail = ? AND TimeAvail = ?)";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$id);
		$stmt->bindParam(2,$day);
		$stmt->bindParam(3,$time);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function isAdded($topic,$tutor){
		$query = "SELECT * FROM topic_taught WHERE topicId = ? AND tutorId =?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$topic);
		$stmt->bindParam(2,$tutor);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	function getTutorUserId($tutor){
		$query = "SELECT * FROM tutor INNER JOIN accounts ON tutorId.userId = accounts.userId WHERE tutor.userId = ?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$tutor);
		$stmt->execute();
	}

	function deleteTutor(){
		$query = "DELETE FROM tutor WHERE userId = ?; DELETE FROM topic_taught WHERE tutorId = ?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->userId);
		$stmt->bindParam(2,$this->userId);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}

