<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');
$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');
$topicId= isset ($_GET ['topicId']) ? $_GET['topicId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutor= new Tutor($db);
    
    if ($tutor->addTutorTopic($topicId,$tutorId)){
      echo "<script type='text/javascript'>alert('Topic Successfully Added!'); location='addtopic2.php?tutorId={$tutorId}&subjId={$subjId}';</script>";
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