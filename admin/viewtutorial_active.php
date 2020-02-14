<?php
include_once '../classes/tutorial.php';
include_once '../classes/account.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $_SESSION['userId'];
$account->readOneAccount();


$tutor = new Tutor($db);

$tutorial = new Tutorial($db);

$stmt = $tutorial->viewTutorials('%','%','Active');

echo"
  <style>
  	tbody tr:hover{cursor:pointer;}
  </style>

  <body>


   <div class='card' style='max-width: 100%; margin:0;margin-bottom: 15px;'>


<form method='POST'>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col'><p class='text-center'>Tutor</p></th>
				<th scope='col'><p class='text-center'>Tutee</p></th>
				<th scope='col'><p class='text-center'>Topic</p></th>
				<th scope='col'><p class='text-center'>Date</p></th>
				<th scope='col'><p class='text-center'>Time</p></th>
			</tr>
		</thead>
		<tbody>";
			if(isset($_POST['search'])){
				$srch = $tutorial->searchTutorials($_POST['search'],'Active');			  	
				if($srch->rowCount()>0){
  					while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    					extract($row);

						echo"

						<tr onclick=\"window.location='viewonetutorial.php?tlistId={$tlistId}'\">
							<td><p class='text-center'>{$tutor}</p></td>
							<td><p class='text-center'>{$tutee}</p></td>
							<td><p class='text-center'>{$topic}</p></td>
							<td><p class='text-center'>{$date}</p></td>
							<td><p class='text-center'>{$time}</p></td>
						</tr>";
					}									
				}else{
				echo "
					<tr>
						<td class='text-center' colspan='5'>Nothing to show.</td>
					</tr>
				";
				}
			}
			elseif(($stmt->rowCount())>0){
  				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					echo"
					
					<tr onclick=\"window.location='viewonetutorial.php?tlistId={$tlistId}'\">
						<td><p class='text-center'>{$tutor}</p></td>
						<td><p class='text-center'>{$tutee}</p></td>
						<td><p class='text-center'>{$topic}</p></td>
						<td><p class='text-center'>{$date}</p></td>
						<td><p class='text-center'>{$time}</p></td>
					</tr>
					</tbody>";
				}
			}else{
					echo "
					<tr>
						<td class='text-center' colspan='5'>Nothing to show.</td>
					</tr>";
			}					
			echo "
			</table>

  </div>


</body>";
?>

