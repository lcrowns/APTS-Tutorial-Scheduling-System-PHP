<?php
include_once 'headerstudent.php';
include_once '../classes/tutorial.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutorial = new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();

$parts = explode("-", $tutorial->time);
$one = substr($parts[1], 0, 8);

$datein = $tutorial->date;
$timein = $one;

$timenow = date('Y-m-d H:i')."  ";

$selectedDate = date( 'Y-m-d H:i', strtotime("$datein $timein"));


if($selectedDate<$timenow){
  $tutorial->tListStatus = 'Completed';
  if ($tutorial->updateReq()){
    echo "<script type='text/javascript'>alert('Tutorial Successfully Updated!'); location='viewonetutorial.php?tlistId={$tlistId}';</script>";
  }else{
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong><p class='text-center'>Please Try Again!</p></strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>

      ";
      }
}else{
  echo "<script type='text/javascript'>alert('A tutorial cannot be marked as complete until its end time.'); window.history.go(-1);</script>";
}

?>
