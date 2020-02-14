<?php
include_once 'header.php';
include_once 'classes/account.php';
include_once 'config/connection.php';


date_default_timezone_set('Asia/Manila');

$date = date('Y-m-d');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->deleteExpired($date);

?>

<html>
	<head>
		<title>	</title>
	</head>
	<style type="text/css">
			.mainContent{
				width: 100%;
				margin-top: 4%;
				font-family: Calibri;
			}

			.card{
				width: 45%;
				height: 350px;
				border: 1px;

				display: block;
				float: 	left;

				margin:2%;
				margin-right: 3%;
				/*padding: 1%;*/

				/*background-color: #575452;*/
			}

			.cardTop{
				background-color: #f55656;
				height: 70px;
				width: 100%;
			}

			.cardText{
				margin: 5px;

				color: white;
			}

			.cardText h4,h1,p{
				padding-left: 5px;
			}

			.card a{
				float: right;

				color: #bd2222;
				text-decoration: underline;
				margin-right: 10px;
			}

			.card a:hover{
				color: orange;
			}

			.card img{
				width: 100%;
			}
	</style>
	<body>	
		<div class="mainContent">	
				<div class="card">
					<div class="cardText">
						<img src="assets/imgs/img2.jpg" \>
					</div>
				</div>
				<!--<div class="card">
					<div class="cardTop"></div>
					<div class="cardText">
						<p>sample text.</p>
					</div>
				</div>-->
				<div class="card">
					<div class="cardText" style="color:#827c7e; margin-top: 6%;">
						<div style="background-color: #d1d1d1; width: 100%;"><h1 style="margin-bottom: 1px; color:#6e6868;">A-PTS</h1></div>
						<h4 style="margin-top: 1px;">A-Peer Tutoring System</h4>
						<p>A-Peer Tutoring System (A-PTS) allows students to find tutors and schedule a tutorial with them to further their understanding of a given subject matter. </p>
					</div>
					<a href=about.php>Read More</a>
				</div>
		</div>
	</body>
</html>