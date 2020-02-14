<?php
include_once '../classes/tutorial.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');
$set= isset ($_GET ['set']) ? $_GET['set']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutorial= new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();

if($set == 'Accepted') {
  $tutorial->readOneTutorial();
  if ($tutorial->tListStatus == 'Pending'){
  $tutorial->tListStatus=  'Active';

    if ($tutorial->updateTutorial2()){
      echo "<script type='text/javascript'>alert('Tutorial Successfully Updated!'); window.history.go(-1);</script>";
    }
    else{
      echo "<script type='text/javascript'>alert('Try again!'); window.history.go(-1);</script>";
    }
  }
  }

if($set == 'Declined') {
    $tutorial->readOneTutorial();
    if ($tutorial->tListStatus == 'Pending'){
  $tutorial->tListStatus=  'Inactive';

    if ($tutorial->updateTutorial2()){
      echo "<script type='text/javascript'>alert('Tutorial Successfully Updated!'); window.history.go(-1);</script>";
    }
    else{
      echo "<script type='text/javascript'>alert('Try again!'); window.history.go(-1);</script>";
    }
    }
  }
?>