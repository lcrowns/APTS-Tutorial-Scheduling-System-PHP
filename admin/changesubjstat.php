<?php
include_once '../classes/subjects.php';
include_once '../config/connection.php';

$subjstat= isset ($_GET ['subjstat']) ? $_GET['subjstat']: die('ERROR: missing ID.');
$subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);
$subject->subjId = $subjId;
$subject->readOneSubj();

if ($subjstat == 'Active'){
  
  $subject->subjstat=  'Inactive';
 
}else{
  $subject->subjstat=  'Active';
}

    if ($subject->updateSubj()){
      echo "<script type='text/javascript'>alert('Subject Successfully Updated!'); location='subjects.php';</script>";
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