<?php
  include_once "../config/connection.php";
  include_once "../classes/topic.php";

  $topicId= isset ($_GET ['topicId']) ? $_GET['topicId']: die('ERROR: missing ID.');

  $database = new Database();
  $db = $database->getConnection();
 	
  $topic1 = new Topic($db);
	$topic1->topicId = $topicId;

  if ($topic1->deleteTopThot() AND $topic1->deleteOneTop()){
      echo "<script type='text/javascript'>alert('Topic Successfully Deleted!'); window.history.go(-1);</script>";
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

