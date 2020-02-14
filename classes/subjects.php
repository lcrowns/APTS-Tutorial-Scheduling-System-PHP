<?php

class Subject{
	public $subjId;
	public $subjName;
	public $subjdesc;
	public $fname;
	public $lname;
	public $adfname;
	public $adlname;
	public $acctId;
	public $subjstat;
	public $editedby;
	public $editdate;
	private $conn;

	function __construct($db){
		$this->conn = $db;
	}

	function addsubjs(){
		$query = "INSERT INTO subject SET subjname = ?, subjdesc=?, subjstat =?";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->subjname);
		$stmt->bindParam(2, $this->subjdesc);
		$stmt->bindParam(3, $this->subjstat);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readAllSubjs(){
		$query = "SELECT * FROM subject ORDER BY subjId";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function searchSubjs($uinput){

		$query = "SELECT * FROM subject WHERE subjId REGEXP '".$uinput."+' OR subjname REGEXP '".$uinput."+' OR (subjdesc REGEXP '".$uinput."+') OR subjstat REGEXP '".$uinput."+'  ORDER BY subjId";
		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function readOneSubj(){
		$query = "SELECT * FROM subject WHERE subjId=?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->subjId);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->subjname = $row['subjname'];
		$this->subjdesc = $row['subjdesc'];
		$this->subjstat = $row['subjstat'];
		
	}

	function updateSubj(){
		$query = "UPDATE subject SET subjname=?, subjdesc=?, subjstat=? WHERE subjId=?";
			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(1,$this->subjname);
			$stmt->bindParam(2,$this->subjdesc);
			$stmt->bindParam(3,$this->subjstat);
			$stmt->bindParam(4,$this->subjId);

			if($stmt->execute()){
				return true;
			}else{
			return false;
			}
	}

	
	function readOnetopic(){
		$query = "SELECT * FROM topic WHERE subjId = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->subjId);
		$stmt->execute();

		return $stmt;
	}

	function readOnetopicAct(){
		$query = "SELECT * FROM topic WHERE subjId = ? AND topstatus = 'Active'";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->subjId);
		$stmt->execute();

		return $stmt;
	}

	function viewSubjsAct(){
		$query = "SELECT * FROM subject WHERE subjstat = 'Active' ORDER BY subjId";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function viewSubjsInact(){
		$query = "SELECT * FROM subject WHERE subjstat = 'Inactive' ORDER BY subjId";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function searchSubjsAct($uinput){

		$query = "SELECT * FROM subject WHERE (subjId REGEXP '".$uinput."+' OR subjname REGEXP '".$uinput."+' OR (subjdesc REGEXP '".$uinput."+') OR subjstat REGEXP '".$uinput."+') AND subjstat = 'Active'  ORDER BY subjId";
		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchSubjsInact($uinput){

		$query = "SELECT * FROM subject WHERE (subjId REGEXP '".$uinput."+' OR subjname REGEXP '".$uinput."+' OR (subjdesc REGEXP '".$uinput."+') OR subjstat REGEXP '".$uinput."+') AND subjstat = 'Inactive'  ORDER BY subjId";
		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function deleteSubj(){
			$query = "DELETE FROM subject WHERE subjId = ?";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->subjId);
			
			if($result = $stmt->execute()){
				return true;
			}
			else{
				return false;
			}
	}
}
?>