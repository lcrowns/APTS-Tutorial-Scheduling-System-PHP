<?php
include_once '../classes/topic.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';


$subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);
$subject->subjId = $subjId;
$subject->readOneSubj();

if(isset($_POST['add'])){
  $topic = new Topic($db);

  $topic->topname = $_POST['topname'];
  $topic->topdesc = $_POST['topdesc'];
  $topic->subjId = $_POST['subjId'];
  $topic->topstatus = $_POST['topstatus'];
  
if($topic->addTopic()){

  echo"<script type='text/javascript'>alert('Successfully Added!'); location='viewonesubj.php?subjId={$subjId}';</script>";
}
else{
    echo"<script type='text/javascript'>alert('Try Again!'); location='viewonesubj.php?subjId={$subjId}';</script>";

}
}
?>