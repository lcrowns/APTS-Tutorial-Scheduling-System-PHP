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


$pdf = new FPDF('L','mm','letter');

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
$pdf->Cell(100,5, "Feedback on Tutors",0,0);
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
$pdf->Cell(40,5,'Tutor',1,0);
$pdf->Cell(40,5,'Feedback by',1,0);
$pdf->Cell(150,5,'Tutee Feedback',1,0);
$pdf->Cell(30,5,'Tutee Rate',1,1);

if ($sd != '' AND empty($ed)){
$query = "SELECT * FROM t_list INNER JOIN accounts on t_list.tutor = (accounts.fname+' '+accounts.lname) WHERE tListStatus = 'Completed' AND (tuteeFeed != '' OR tuteeRate != '') AND (t_list.date >= '".$sd."+' ) GROUP BY tlistId ORDER BY tutor";
}elseif ($ed != '' AND empty($sd)){
$query = "SELECT * FROM t_list INNER JOIN accounts on t_list.tutor = (accounts.fname+' '+accounts.lname) WHERE tListStatus = 'Completed' AND (tuteeFeed != '' OR tuteeRate != '') AND (date <= '".$ed."+') GROUP BY tlistId ORDER BY tutor";
}elseif ($sd != '' AND $ed != ''){
$query = "SELECT * FROM t_list INNER JOIN accounts on t_list.tutor = (accounts.fname+' '+accounts.lname) WHERE tListStatus = 'Completed' AND (tuteeFeed != '' OR tuteeRate != '') AND (date >= '".$sd."+' AND date <= '".$ed."+') GROUP BY tlistId ORDER BY tutor";
}else{
$query = "SELECT * FROM t_list INNER JOIN accounts on t_list.tutor = (accounts.fname+' '+accounts.lname) WHERE tListStatus = 'Completed' AND (tuteeFeed != '' OR tuteeRate != '') GROUP BY tlistId ORDER BY tutor";
}

$stmt = $database->conn->prepare($query);
$stmt->execute();


$pdf->SetFont("Arial", "",12);
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

	$pdf->Cell(40,5,"{$tutor}",1,0);
	$pdf->Cell(40,5,"{$tutee}",1,0);
	$pdf->Cell(150,5,"{$tuteeFeed}",1,0);
	$pdf->Cell(30,5,"{$tuteeRate}",1,1);
}


$pdf->Output();

?>