<?php
include "../assets/fpdf/fpdf.php";
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$sd= isset ($_GET ['sd']) ? $_GET['sd']: die('ERROR: missing ID.');
$ed= isset ($_GET ['ed']) ? $_GET['ed']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

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
$pdf->Cell(100,5, "Tutorial List Report",0,0);
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

if ($sd != '' AND empty($ed)){
$query = "SELECT * FROM t_list WHERE (t_list.date >= '".$sd."+') ORDER BY tListStatus";
}elseif ($ed != '' AND empty($sd)){
$query = "SELECT * FROM t_list WHERE (t_list.date <= '".$ed."+') ORDER BY tListStatus";
}elseif ($sd != '' AND $ed != ''){
$query = "SELECT * FROM t_list WHERE (t_list.date >= '".$sd."+' AND t_list.date <= '".$ed."+') ORDER BY tListStatus";
}else{
$query = "SELECT * FROM t_list ORDER BY tListStatus";
}


$stmt = $database->conn->prepare($query);
$stmt->execute();



while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $pdf->SetFont("Arial","B",12);
    $pdf->setFillColor(230,230,230);
    $pdf->Cell(20,5,'Tutor',1,0, '', TRUE);
    $pdf->SetFont("Arial", "",12);
	$pdf->Cell(60,5,"{$tutor}",1,0);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(20,5,'Tutee',1,0, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(60,5,"{$tutee}",1,0);

	//$pdf->Cell(20,5,'',1,0);
	$pdf->Cell(80,5,"",1,1);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(20,5,'Topic',1,0, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(60,5,"{$topic}",1,0);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(20,5,'Date',1,0, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(60,5,"{$date}",1,0);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(20,5,'Time',1,0, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(60,5,"{$time}",1,1);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(20,5,'Status',1,0, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(60,5,"{$tListStatus}",1,0);

	$pdf->Cell(160,5,"",1,1);
	//$pdf->Cell(59,5,"",0,1); //EOL

	if($tListStatus == 'Completed'){
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(240,5,'Tutor Feedback',1,1, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(240,5,"{$tutorFeed}",1,1);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(240,5,'Tutee Feedback',1,1, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(240,5,"{$tuteeFeed}",1,1);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(40,5,'Tutee Rate',1,0, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(200,5,"{$tuteeRate}",1,1);

	}elseif($tListStatus == 'Cancelled'){
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(240,5,'Cancelled By',1,1, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(240,5,"{$cancelBy}",1,1);

	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(240,5,'Cancellation Reason',1,1, '', TRUE);
	$pdf->SetFont("Arial", "",12);
	$pdf->Cell(240,5,"{$cancelReason}",1,1);
	}

	$pdf->Cell(189,10,"",0,1); //EOL
}


$pdf->Output();

?>