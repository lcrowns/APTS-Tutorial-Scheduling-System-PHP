<?php
include_once '../classes/topic.php';
include_once '../config/connection.php';

$topstatus= isset ($_GET ['topstatus']) ? $_GET['topstatus']: die('ERROR: missing ID.');
$topicId= isset ($_GET ['topicId']) ? $_GET['topicId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$topic = new Topic($db);
$topic->topicId = $topicId;
$topic->readOnetopic1();

if ($topstatus == 'Active'){
  
  $topic->topstatus=  'Inactive';
 
}else{
  $topic->topstatus=  'Active';
}

    if ($topic->updatetopic()){
      echo "<script type='text/javascript'>alert('Topic Successfully Updated!'); window.history.go(-1);</script>";
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