<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/subjects.php';
include_once '../classes/account.php';

$subjname= isset ($_GET ['subjname']) ? $_GET['subjname']: die('ERROR: missing ID.');
$subjdesc= isset ($_GET ['subjdesc']) ? $_GET['subjdesc']: die('ERROR: missing ID.');


$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);
$stmt = $subject->addsubjs();



	$subject = new Subject($db);

	$subject->subjname = $subjname;
	$subject->subjdesc = $subjdesc;
  $subject->subjstat = 'Active';


	  if($subject->addsubjs()){
    echo "<script type='text/javascript'>alert('Successfully Added!'); location='subjects.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Try Again!');</script>";
  }


?>



