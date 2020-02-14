<?php 
include_once "headerstudent.php";
include_once '../classes/account.php';
include_once '../config/connection.php';
include_once '../classes/tutor.php';
include_once '../classes/subjects.php';

$database = new Database();
$db = $database->getConnection();

$tutor = new Tutor($db);
$stmt = $tutor->addtutor();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

$subject = new Subject($db);
$stmt = $subject->readAllSubjs();

if(isset($_POST['save'])){
	$tutor = new Tutor($db);

	$tutor->userId = $_POST['userId'];
	$tutor->tutorStatus = $_POST['tutorStatus'];


	  if($tutor->addtutor()){
    echo "<script type='text/javascript'>alert('Successfully Added!'); location='homestudent.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Try Again!');</script>";
  }

}

?>

<div class="container alert alert-secondary" role="alert">
<div class = "row mb-5">
</div>
<div class ="row mb-2">
<div class = "col-lg-4">
</div>
<div class = "col-lg-4">
<label><h1>Tutor Form</h1></label>
		</div>
<div class = "col-lg-4">
</div>		
			
		</div>
	
 <div class="row mb-3" >
    
		<div class = "col-lg-4">
		
</div>	
<div class = "col-lg-4">
		  <label>Tutor</label> 
		  <input type="text" class="form-control" name ="userId" id="userId">

		 <!-- <br>
		  <label>Subject</label> 
		  <select class="custom-select" >
		  	<option disabled selected>Choose Subject</option>
		  	<?php
		  	/*while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                    extract($row);
                    echo "<option>{$subjname}</option>";
                }*/
                    
		  	?>
		  </select>-->

</div>	
<div class = "col-lg-4">
</div>	</div>


<div class= " row mb-3">
<div class = "col-lg-2">
</div>
<div class = "col-lg-2">

</div>
<div class = "col-lg-2">
<button type="button" class="btn btn-danger">Submit</button>
</div>
<div class = "col-lg-1">

</div>
<div class = "col-lg-1">
<button type="button" class="btn btn-danger">Cancel</button>
</div>
<div class = "col-lg-2">

</div>
<div class = "col-lg-2">
</div>
</div>

		  
		  
  </div>
</div>