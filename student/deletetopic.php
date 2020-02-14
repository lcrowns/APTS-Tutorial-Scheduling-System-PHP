<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$taughtId= isset ($_GET ['taughtId']) ? $_GET['taughtId']: die('ERROR: missing ID.');
$id = $_SESSION['userId'];

$database = new Database();
$db = $database->getConnection();

$tutor= new Tutor($db);
    
    if ($tutor->removeTutorTopic($taughtId)){
      echo "<script type='text/javascript'>alert('Topic Successfully Removed!'); location='mytutorprofile.php?userId={$id}';</script>";
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