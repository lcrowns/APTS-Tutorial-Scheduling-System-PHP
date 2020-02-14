<?php
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../config/connection.php';

$status= isset ($_GET ['status']) ? $_GET['status']: die('ERROR: missing ID.');
$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

if ($status == 'Active'){
  
  $account->status=  'Inactive';
 
}else{
  $account->status=  'Active';
}

    if ($account->updateUser()){
      echo "<script type='text/javascript'>alert('User Successfully Updated!');history.go(-1);</script>";
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