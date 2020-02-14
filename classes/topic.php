<?php

class Topic{
	public $topicId;
	public $subjId;
	public $topname;
	public $topdesc;
	public $topstatus;

	private $conn;

	function __construct($db){
		$this->conn = $db;
	}

	function addTopic(){
		$query = "INSERT INTO topic SET subjId = ?, topname=?, topdesc =?, topstatus =?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->subjId);
		$stmt->bindParam(2, $this->topname);
		$stmt->bindParam(3, $this->topdesc);
		$stmt->bindParam(4, $this->topstatus);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function updatetopic(){
			$query = "UPDATE topic SET topname=?, topdesc=?, topstatus=? WHERE topicId=?";
			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1,$this->topname);
			$stmt->bindParam(2,$this->topdesc);
			$stmt->bindParam(3,$this->topstatus);
			$stmt->bindParam(4,$this->topicId);

			if($stmt->execute()){
				return true;
			}else{
			return false;
			}
		}

	function readOnetopic1(){
		$query = "SELECT * FROM topic WHERE topicId = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->topicId);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->topname = $row['topname'];
		$this->topdesc = $row['topdesc'];
		$this->topstatus = $row['topstatus'];
		$this->subjId = $row['subjId'];
	}

	function readAllTopic(){
		$query = "SELECT * FROM topic";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function deleteTop(){
			$query = "DELETE FROM topic WHERE subjId = ?";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->subjId);
			
			if($result = $stmt->execute()){
				return true;
			}
			else{
				return false;
			}
	}

	function deleteOneTop(){
			$query = "DELETE FROM topic WHERE topicId = ?";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->topicId);
			
			if($result = $stmt->execute()){
				return true;
			}
			else{
				return false;
			}
	}

	function deleteTopThot(){
			$query = "DELETE FROM topic_taught WHERE topicId = ?";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->topicId);
			
			if($result = $stmt->execute()){
				return true;
			}
			else{
				return false;
			}
	}


	function getTopicId($in){
		$query = "SELECT topicId FROM topic WHERE subjId = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $in);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->topicId = $row['topicId'];

		return $this->topicId;
	}

	function searchTopic($uinput,$id){

		$query = "SELECT * FROM topic WHERE ((topname LIKE '%{$uinput}%') OR (topdesc LIKE '%{$uinput}%') OR (topstatus LIKE '%{$uinput}%')) AND subjId = ? GROUP BY topicId ORDER BY topicId";

		$srch = $this->conn->prepare($query);
		$srch->bindParam(1, $id);
		$srch->execute();


		return $srch;
	}
}

?>