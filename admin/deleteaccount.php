<?php
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');
$loc= isset ($_GET ['loc']) ? $_GET['loc']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;

$tutor = new Tutor($db);
$tutor->userId = $userId;



    if ($account->deleteUser() && $tutor->deleteTutor()){
      if ($loc == 1){
        echo "<script type='text/javascript'>alert('User Deleted!'); location='tutees.php';</script>";
      }else{
        echo "<script type='text/javascript'>alert('User Deleted!'); location='admins.php';</script>";
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