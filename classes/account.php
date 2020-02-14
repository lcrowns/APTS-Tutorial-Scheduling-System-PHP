<?php

class Account{

	public $acctId;
	public $userId;
	public $fname;
	public $mname;
	public $lname;
	public $contact;
	public $usertype;
	public $status;
	public $password;
	public $email;
	public $lastLogin;
	public $expDate;
	public $firstLogin;


	private $conn;

	function __construct($db){
		$this->conn = $db;
	}

	function addAccount($userId,$fname,$mname,$lname,$contact,$email,$usertype,$status,$password,$expDate,$firstLogin ){
		$query = "INSERT INTO accounts SET fname = ?, lname =?, userId =?, contact =?, usertype =?, status =?, password =?, email =?, expDate=?, firstLogin=?, mname=?";
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1,$fname);
		$stmt->bindParam(2,$lname);
		$stmt->bindParam(3,$userId);
		$stmt->bindParam(4,$contact);
		$stmt->bindParam(5,$usertype);
		$stmt->bindParam(6,$status);
		$stmt->bindParam(7,$password);
		$stmt->bindParam(8,$email);
		$stmt->bindParam(9,$expDate);
		$stmt->bindParam(10,$firstLogin);
		$stmt->bindParam(11,$mname);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readOneAccount(){
			
		$query = "SELECT * FROM accounts WHERE userId=?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->userId);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->acctId = $row['acctId'];
		$this->fname = $row['fname'];
		$this->lname = $row['lname'];
		$this->password = $row['password'];
		$this->contact = $row['contact'];
		$this->email = $row['email'];
		$this->usertype = $row['usertype'];
		$this->status = $row['status'];
		$this->lastLogin = $row['lastLogin'];
		$this->expDate = $row['expDate'];
		$this->firstLogin = $row['firstLogin'];
		
	}

	function readOneAccount2(){
			
		$query = "SELECT * FROM accounts WHERE email=?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindparam(1, $this->email);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->acctId = $row['acctId'];
		$this->userId = $row['userId'];
		$this->fname = $row['fname'];
		$this->lname = $row['lname'];
		$this->password = $row['password'];
		$this->contact = $row['contact'];
		$this->usertype = $row['usertype'];
		$this->status = $row['status'];
		$this->lastLogin = $row['lastLogin'];
		$this->expDate = $row['expDate'];
		$this->firstLogin = $row['firstLogin'];
		
	}

	function login(){
		$query = "SELECT * FROM accounts WHERE userId = :userId AND password = :password";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
	}

		

	function updateUser(){
		$query = "UPDATE accounts SET fname=?, lname=?, contact=?, usertype=?, status=?, password=?, email=? , lastLogin=?, expDate=?, firstLogin=? WHERE userId=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$this->fname);
		$stmt->bindParam(2,$this->lname);
		$stmt->bindParam(3,$this->contact);
		$stmt->bindParam(4,$this->usertype);
		$stmt->bindParam(5,$this->status);
		$stmt->bindParam(6,$this->password);
		$stmt->bindParam(7,$this->email);
		$stmt->bindParam(8,$this->lastLogin);
		$stmt->bindParam(9,$this->expDate);
		$stmt->bindParam(10,$this->firstLogin);
		$stmt->bindParam(11,$this->userId);

		if($stmt->execute()){
			return true;
		}else{
		return false;
		}
	}

	function deleteUser(){
		$query = "DELETE FROM accounts WHERE userId=?";
	
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$this->userId);
		
		if($stmt->execute()){
			return true;
		}else{
		return false;
		}
	}

	function viewTutees(){
		$query = "SELECT * FROM accounts WHERE usertype='Student' AND status='Active'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewNewTutees(){
		$query = "SELECT * FROM temporary WHERE usertype='Student'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewTuteesInac(){
		$query = "SELECT * FROM accounts WHERE usertype='Student' AND status='Inactive'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewTuteesAll(){
		$query = "SELECT * FROM accounts WHERE usertype='Student'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function searchTutees($uinput){

		$query = "SELECT acctId, userId, fname, lname, contact, email, status FROM accounts WHERE (userId REGEXP '".$uinput."+' OR fname REGEXP '".$uinput."+' OR lname REGEXP '".$uinput."+' OR contact REGEXP '".$uinput."+' OR email REGEXP '".$uinput."+') AND usertype = 'Student' ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchTuteesAct($uinput){

		$query = "SELECT acctId, userId, fname, lname, contact, email, status FROM accounts WHERE ((userId LIKE '%{$uinput}%' AND status = 'Active') OR (fname REGEXP '".$uinput."+' AND status = 'Active') OR (lname REGEXP '".$uinput."+' AND status = 'Active') OR (contact REGEXP '".$uinput."+' AND status = 'Active') OR (email REGEXP '".$uinput."+' AND status = 'Active')) AND usertype = 'Student' ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchTuteesInac($uinput){

		$query = "SELECT acctId, userId, fname, lname, contact, email, status FROM accounts WHERE ((status = 'Inactive' AND userId REGEXP '".$uinput."+') OR (status = 'Inactive' AND fname REGEXP '".$uinput."+') OR (status = 'Inactive' AND lname REGEXP '".$uinput."+') OR (status = 'Inactive' AND contact REGEXP '".$uinput."+') OR (status = 'Inactive' AND email REGEXP '".$uinput."+')) AND usertype = 'Student' ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function viewAdminsAll(){
		$query = "SELECT * FROM accounts WHERE usertype='Admin'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewAdminsAct(){
		$query = "SELECT * FROM accounts WHERE usertype='Admin' AND status='Active'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function viewAdminsInact(){
		$query = "SELECT * FROM accounts WHERE usertype='Admin' AND status='Inactive'";
	
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function searchAdmins($uinput){

		$query = "SELECT acctId, userId, fname, lname, contact, email, status FROM accounts WHERE (userId REGEXP '".$uinput."+' OR fname REGEXP '".$uinput."+' OR lname REGEXP '".$uinput."+' OR contact REGEXP '".$uinput."+' OR email REGEXP '".$uinput."+') AND usertype = 'Admin' ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchAdminsAct($uinput){

		$query = "SELECT acctId, userId, fname, lname, contact, email FROM accounts WHERE ((userId LIKE '%{$uinput}%' AND status = 'Active') OR (fname REGEXP '".$uinput."+' AND status = 'Active') OR (lname REGEXP '".$uinput."+' AND status = 'Active') OR (contact REGEXP '".$uinput."+' AND status = 'Active') OR (email REGEXP '".$uinput."+' AND status = 'Active')) AND usertype = 'Admin' ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function searchAdminsInact($uinput){

		$query = "SELECT acctId, userId, fname, lname, contact, email FROM accounts WHERE ((status = 'Inactive' AND userId REGEXP '".$uinput."+') OR (status = 'Inactive' AND fname REGEXP '".$uinput."+') OR (status = 'Inactive' AND lname REGEXP '".$uinput."+') OR (status = 'Inactive' AND contact REGEXP '".$uinput."+') OR (status = 'Inactive' AND email REGEXP '".$uinput."+')) AND usertype='Admin' ORDER BY acctId";

		$srch = $this->conn->prepare($query);
		$srch->execute();
		return $srch;
	}

	function ifTutor(){
		$query = "SELECT DISTINCT * FROM tutor WHERE userId=? AND tutorStatus = 'Active' ";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$this->userId);
		$stmt->execute();


		if ($stmt->rowCount() > 0){
			return true;
		}else{ return false; }
	}

	function getTutorId($id){
		$query = "SELECT tutorId FROM tutor WHERE userId= ? ";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row['tutorId'];
	}

	function getAcctId($id){
		$query = "SELECT acctId FROM accounts WHERE userId= ? ";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row['acctId'];
	}

	function getkeyexp($key){
		$query = "SELECT * FROM `password_reset_temp` WHERE `password_reset_temp`.key = '{$key}'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function deletekey($key){
		$query = "DELETE FROM `password_reset_temp` WHERE `password_reset_temp`.expDate<= ? ";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$key);
		$stmt->execute();
	}

	function deleteExpired($date){
		$query = "DELETE FROM accounts WHERE expDate <= ? ";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$date);
		$stmt->execute();
	}
}