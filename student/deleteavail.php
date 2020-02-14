<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');
$loc= isset ($_GET ['loc']) ? $_GET['loc']: die('ERROR: missing ID.');
$DaysAvail =isset ($_GET ['DaysAvail']) ? $_GET['DaysAvail']: die('ERROR: missing ID.');
$TimeAvail =isset ($_GET ['TimeAvail']) ? $_GET['TimeAvail']: die('ERROR: missing ID.');
$id = $_SESSION['userId'];

$database = new Database();
$db = $database->getConnection();

$tutor= new Tutor($db);
    
    if ($tutor->removeTutorAvail($tutorId,$DaysAvail,$TimeAvail)){
      if($loc ==1){
        echo "<script type='text/javascript'>alert('Date/Time Successfully Removed!'); location='myaccount.php?userId={$id}';</script>";
      }else{
        echo "<script type='text/javascript'>alert('Date/Time Successfully Removed!'); location='addavail.php?userId={$id}&tutorId={$tutorId}';</script>";
      }
    }
    else{
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong><p class='text-center'>Please Try Again!</p></strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>

      ";
      }
?>