<?php
include_once 'headeradmin.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');
$loc= isset ($_GET ['loc']) ? $_GET['loc']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutor = new Tutor($db);
$tutor->userId = $userId;


    if ($tutor->deleteTutor()){
      if ($loc == 1){
        echo "<script type='text/javascript'>alert('Tutor Deleted!'); location='tutors.php';</script>";
      }else{
        echo "<script type='text/javascript'>alert('Tutor Deleted!'); location='viewonetutor.php?userId={$userId}';</script>";
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