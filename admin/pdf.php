<?php
include "../assets/fpdf/fpdf.php";
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$sd= isset ($_GET ['sd']) ? $_GET['sd']: die('ERROR: missing ID.');
$ed= isset ($_GET ['ed']) ? $_GET['ed']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();
/*$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId";
$stmt = $database->conn->prepare($query);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$userId = $row['userId'];
		$fname = $row['fname'];
		$lname = $row['lname'];
		$contact = $row['contact'];
		$email = $row['email'];
		$tutorStatus = $row['tutorStatus'];*/


$pdf = new FPDF('P','mm','letter');

$pdf->AddPage();



$pdf->SetFont("Arial","B",14);

$pdf->Cell(100,5,"University of Baguio",0,0);
$pdf->Cell(59,5,"",0,1); //EOL

$pdf->SetFont("Arial","",12);

$pdf->Cell(100,5,"School of International Hospitality and Management",0,0);
$pdf->Cell(59,5,"",0,1); //EOL

$pdf->Cell(100,5,"Upper General Luna Road",0,0);
$pdf->Cell(59,5,"",0,1); //EOL

$pdf->Cell(100,5,"Baguio City, Philippines, 2600",0,0);
$pdf->Cell(25,5,"",0,0);
$pdf->Cell(34,5,"",0,1); //EOL

$pdf->Cell(100,5,"+63 998-765",0,1); //EOL
$pdf->Cell(34,5,"",0,1); //EOL

$pdf->SetFont("Arial","B",14);
$pdf->Cell(59,5, "A-Peer Tutoring System",0,1); //EOL

$pdf->SetFont("Arial","B",12);
$pdf->Cell(100,5, "Tutor List Report",0,0);
$pdf->Cell(59,5, "",0,1); //EOL

$pdf->SetFont("Arial","B",11);
if(!empty($sd) AND empty($ed)){
	$pdf->Cell(100,5, "(".$sd." - "."Present)",0,1);
}elseif(empty($sd) AND !empty($ed)){
	$pdf->Cell(100,5, "(Before ".$ed.")",0,1);
}elseif(!empty($sd) AND !empty($ed)){
	$pdf->Cell(100,5, "(".$sd." - ".$ed.")",0,1);
}



$pdf->Cell(189,10,"",0,1); //EOL

$pdf->SetFont("Arial","B",12);
$pdf->Cell(26,5,'User ID',1,0);
$pdf->Cell(30,5,'First Name',1,0);
$pdf->Cell(30,5,'Last Name',1,0);
$pdf->Cell(30,5,'Contact',1,0);
$pdf->Cell(58,5,'Email',1,0);
$pdf->Cell(23,5,'Status',1,1);

if ($sd != '' AND empty($ed)){
$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE (tutor.dateadded >= '".$sd."+') GROUP BY tutor.userId";
}elseif ($ed != '' AND empty($sd)){
$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE (tutor.dateadded <= '".$ed."+') GROUP BY tutor.userId";
}elseif ($sd != '' AND $ed != ''){
$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId WHERE (tutor.dateadded >= '".$sd."+' AND tutor.dateadded <= '".$ed."+') GROUP BY tutor.userId";
}else{
$query = "SELECT * FROM tutor INNER JOIN accounts ON tutor.userId = accounts.userId GROUP BY tutor.userId";
}

$stmt = $database->conn->prepare($query);
$stmt->execute();


$pdf->SetFont("Arial", "",12);
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

	$pdf->Cell(26,5,"{$userId}",1,0);
	$pdf->Cell(30,5,"{$fname}",1,0);
	$pdf->Cell(30,5,"{$lname}",1,0);
	$pdf->Cell(30,5,"{$contact}",1,0);
	$pdf->Cell(58,5,"{$email}",1,0);
	$pdf->Cell(23,5,"{$tutorStatus}",1,1);
}


$pdf->Output();

?>