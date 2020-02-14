<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
require_once $_SERVER['DOCUMENT_ROOT'] . '/APTS/assets/phpSpreadsheet/src/Bootstrap.php';

$helper = new Sample();

$inputFileType = 'Xlsx';
$inputFileName = $_SERVER['DOCUMENT_ROOT'] . '/APTS/uploads/students.xlsx';

$reader = IOFactory::createReader($inputFileType);
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($inputFileName);

$sheetData = $spreadsheet->getActiveSheet()->toArray(true, true, true, true);
#var_dump($sheetData);

$conn = new mysqli("localhost", "root", "", "apts");

if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}

$sql='';
for($row=2;$row<=count($sheetData);$row++){
	$xx = "'" . implode("','", $sheetData[$row]) . "'";
	$sql = "INSERT INTO temporary (userId,fname,mname,lname,contact,email) VALUES ($xx);";
	if ($conn->query($sql) === TRUE){
		#echo "row $row Inserted Succesffuly"."<br>";
	}else{
		echo "Error: " .$sql. "<br>". $conn->error;
	}
}
#echo'<pre>';print_r($val);
