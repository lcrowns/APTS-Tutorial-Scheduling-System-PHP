<?php
    include_once "../config/connection.php";
    include_once "../classes/subjects.php";
    include_once "../classes/topic.php";

    $subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');

    $database = new Database();
    $db = $database->getConnection();
 	
    $topic1 = new Topic($db);
	$id = $topic1->getTopicId($subjId);
	$topic1->topicId = $id;


 	$topic = new Topic($db);
 	$topic->subjId = $subjId;

    $subject = new Subject($db);
    $subject->subjId = $subjId;

    if ($topic1->deleteTopThot() AND $topic->deleteTop() AND $subject->deleteSubj()){
      echo "<script type='text/javascript'>alert('Subject Successfully Deleted!'); location='subjects.php';</script>";
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

