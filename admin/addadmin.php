<?php
include_once '../classes/account.php';
include_once '../config/connection.php';

$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');
$fname= isset ($_GET ['fname']) ? $_GET['fname']: die('ERROR: missing ID.');
$mname= isset ($_GET ['mname']) ? $_GET['mname']: die('ERROR: missing ID.');
$lname= isset ($_GET ['lname']) ? $_GET['lname']: die('ERROR: missing ID.');
$contact= isset ($_GET ['contact']) ? $_GET['contact']: die('ERROR: missing ID.');
$email= isset ($_GET ['email']) ? $_GET['email']: die('ERROR: missing ID.');

$futureDate=date('Y-m-d', strtotime('+1 year'));

$database = new Database();
$db = $database->getConnection();

$usertype= 'Admin';
$status= 'Active';

  $account = new Account($db);


    if($account->addAccount($userId,$fname,$mname,$lname,$contact,$email,$usertype,$status,$mname,$futureDate,1 )){
    echo "<script type='text/javascript'>alert('Successfully Added!'); location='admins.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Try Again!');</script>";
  }

?>