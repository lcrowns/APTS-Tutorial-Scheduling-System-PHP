if (isset($_POST['save'])){
		$tutor = new Tutor($db);
		
		$tutor->userId=$_POST['userId'];
    $tutor->tutorStatus=$_POST['tutorStatus'];


			if ($tutor->addtutor()){
			echo "<script type='text/javascript'>alert('Successfully Requested!'); location='homestudent.php';</script>";
				}
				else {
						echo "<script type='text/javascript'>alert('Try Again!'); location='myaccount.php?userId=$userId';</script>";
				}
	}
?>


<button name="save" type="submit" class="btn btn-success" onclick='confirmation()'>Apply as Tutor</button>

function confirmation(){
     var result = confirm("Are you sure you want to proceed?")
  }