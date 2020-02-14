<?php
include_once '../classes/tutorial.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutorial= new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();

if ($tutorial->tListStatus == 'Pending'){
  if ($tutorial->deleteReq()){
    echo "<script type='text/javascript'>alert('Request Successfully Removed!'); location='homestudent.php';</script>";
  }
    else{
      echo "
        <script type='text/javascript'>alert('Try again'); window.history.go(-1);</script>
      ";
      }
    }
?>