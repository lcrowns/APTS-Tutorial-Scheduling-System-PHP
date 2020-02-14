<?php
include_once '../classes/account.php';
include_once '../classes/topic.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

class Tutorial extends Account{

	public $tlistId;
	public $tutor;
	public $tutee;
	public $topic;
	public $tListStatus;
	public $date;
	public $time;
	public $cancelReason;
	public $cancelBy;
	public $tuteeFeed;
	public $tuteeRate;
	public $tutorFeed;

	public $fname;
	public $lname;
	public $topname;

	private $conn;

	function __construct($db){
		$this->conn = $db;
	}

	function addTutorial(){
		$query = "INSERT INTO t_list  SET tutor = ?, tutee =?, topic = ?, tListStatus = ?, t_list.date = ?, t_list.time = ?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->tutor);
		$stmt->bindParam(2,$this->tutee);
		$stmt->bindParam(3,$this->topic);
		$stmt->bindParam(4,$this->tListStatus);
		$stmt->bindParam(5,$this->date);
		$stmt->bindParam(6,$this->time);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readOneTutorial(){
			
		$query = "SELECT * FROM t_list WHERE tlistId=?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->tlistId);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->tutor = $row['tutor'];
		$this->tutee = $row['tutee'];
		$this->topic = $row['topic'];
		$this->tListStatus = $row['tListStatus'];
		$this->date = $row['date'];
		$this->time = $row['time'];
		$this->cancelReason = $row['cancelReason'];
		$this->cancelBy = $row['cancelBy'];
		$this->tuteeFeed = $row['tuteeFeed'];
		$this->tuteeRate = $row['tuteeRate'];
		$this->tutorFeed = $row['tutorFeed'];
	}

	function updateTutorial(){
		$query = "UPDATE t_list SET tuteeFeed=?,tuteeRate=?,tutorFeed=?  WHERE tlistId=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$this->tuteeFeed);
		$stmt->bindParam(2,$this->tuteeRate);
		$stmt->bindParam(3,$this->tutorFeed);
		$stmt->bindParam(4,$this->tlistId);

		if($stmt->execute()){
			return true;
		}else{
		return false;
		}
	}

	function updateTutorial2(){
		$query = "UPDATE t_list SET tutor =?, tutee=?, topic=?,tListStatus=?,date=?,time=?,cancelReason=?,cancelBy=?,tuteeFeed=?,tuteeRate=?,tutorFeed=? WHERE tlistId=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$this->tutor);
		$stmt->bindParam(2,$this->tutee);
		$stmt->bindParam(3,$this->topic);
		$stmt->bindParam(4,$this->tListStatus);
		$stmt->bindParam(5,$this->date);
		$stmt->bindParam(6,$this->time);
		$stmt->bindParam(7,$this->cancelReason);
		$stmt->bindParam(8,$this->cancelBy);
		$stmt->bindParam(9,$this->tuteeFeed);
		$stmt->bindParam(10,$this->tuteeRate);
		$stmt->bindParam(11,$this->tutorFeed);
		$stmt->bindParam(12,$this->tlistId);

		if($stmt->execute()){
			return true;
		}else{
		return false;
		}
	}

	function viewTutorials($tutor,$tutee,$stat){
		$query = "SELECT * FROM t_list WHERE (tutee LIKE '{$tutee}' OR tutor LIKE '{$tutor}') AND tListStatus LIKE '{$stat}' ORDER BY tlistId";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function searchTutorials($uinput,$stat){
		$query = "SELECT * FROM t_list WHERE ((tutor LIKE '%{$uinput}%') OR (tutee LIKE '%{$uinput}%') OR (topic LIKE '%{$uinput}%') OR (date LIKE '%{$uinput}%') OR (time LIKE '%{$uinput}%') OR (tListStatus LIKE '%{$uinput}%')) AND tListStatus LIKE '%{$stat}%' GROUP BY tlistId ORDER BY tlistId";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function searchTutorials2($user,$uinput,$stat){
		$query = "SELECT * FROM t_list WHERE ((tutor LIKE '%{$uinput}%') OR (tutee LIKE '%{$uinput}%') OR (topic LIKE '%{$uinput}%') OR (date LIKE '%{$uinput}%') OR (time LIKE '%{$uinput}%') OR (tListStatus LIKE '%{$uinput}%')) AND tListStatus LIKE '%{$stat}%' AND (tutor LIKE '%{$user}%' OR tutee LIKE '%{$user}%')  GROUP BY tlistId ORDER BY tlistId";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function updateReq(){
		$query = "UPDATE t_list SET tListStatus=? WHERE tlistId=?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->tListStatus);
		$stmt->bindParam(2,$this->tlistId);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function deleteReq(){
		$query = "DELETE FROM t_list WHERE tlistId=?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$this->tlistId);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>