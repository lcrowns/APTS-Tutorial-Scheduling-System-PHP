<?php
include_once 'headeradmin.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$tutorStatus= isset ($_GET ['tutorStatus']) ? $_GET['tutorStatus']: die('ERROR: missing ID.');
$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutor = new Tutor($db);
$tutor->userId = $userId;

if ($tutorStatus == 'Active'){
  
  $tutor->tutorStatus=  'Inactive';
 
}else{
  $tutor->tutorStatus=  'Active';
}

    if ($tutor->updateRequest()){
      echo "<script type='text/javascript'>alert('Tutor Successfully Updated!'); location='tutors.php';</script>";
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