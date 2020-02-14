<?php
include_once '../classes/tutor.php';
include_once '../config/connection.php';


$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

date_default_timezone_set('Asia/Manila');

$database = new Database();
$db = $database->getConnection();

$tutor = new tutor($db);

$tutor->userId = $userId;
$tutor->tutorStatus = "Active";
$tutor->dateadded = date('Y-m-d');
  
if($tutor->addtutor()){

  echo"<script type='text/javascript'>alert('Successfully Added!'); location='addtutor.php';</script>";
}
else{
    echo"<script type='text/javascript'>alert('Try Again!'); location='addtutor2.php?userId={$userId}';</script>";

}
?>