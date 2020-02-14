<?php
include_once '../classes/account.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();


$account = new Account($db);
$account->$userId = $_SESSION['userId'];

$account->readOneAccount();
$thisaccount = $account->acctId;
$thisaccountud = $_SESSION['userId'];

$tutor = new Tutor($db);
$stmt = $tutor->viewTutorsAct();



echo"
  <style>
  	tbody #clickable:hover{cursor:pointer;}
  </style>
  <body>


   <div class='card' style='max-width: 100%; margin:0; margin-bottom: 15px;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Student Name</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>
								 	</tr>
								 </thead>
								<tbody>";

								  	if($_POST && $tutor->searchTutorsAct($_POST['search1'])->rowCount()>0){
  									$srch = $tutor->searchTutorsAct($_POST['search1']);
  									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);


    								if($tutorId == $account->getTutorId($_SESSION['userId'])){
									echo "<tr>";
									}else{
									echo "<tr id='clickable' onclick=\"window.location='viewonetutor.php?tutorId={$userId}&tuteeId={$thisaccountud}>';\"
									>";
									}

								    echo"

									<td><p class='text-center'>{$fname} {$lname}</p></td>";

									if($tutorId == $account->getTutorId($_SESSION['userId'])){
									echo "<td></td>";
									}else{
									echo "<td class='text-center'><a class='btn btn-danger text-light' href=\"requesttutorial.php?tutorId={$userId}&tuteeId={$thisaccountud}\">Request For Tutorial</a></td>";
									}
									
									echo "
									</tr>";

  }									
}								elseif($_POST && $tutor->searchTutorsAct($_POST['search1'])->rowCount()<1){
									echo 
										"
										<tr>
											<td class='text-center' colspan='2'>Nothing to show.</td>
										</tr>
										";
}
								elseif(($stmt->rowCount())>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									if($tutorId == $account->getTutorId($_SESSION['userId'])){
									echo "<tr>";
									}else{
									echo "<tr id='clickable' onclick=\"window.location='viewonetutor.php?tutorId={$userId}&tuteeId={$thisaccountud}';\"
									>";
									}

								    echo"

									<td><p class='text-center'>{$fname} {$lname}</p></td>";

									if($tutorId == $account->getTutorId($_SESSION['userId'])){
									echo "<td></td>";
									}else{
									echo "<td class='text-center'><a class='btn btn-danger text-light' href=\"requesttutorial.php?tutorId={$userId}&tuteeId={$thisaccountud}\">Request For Tutorial</a></td>";
									}
									
									echo "
									</tr>
									</tbody>
									";
									}
									}else{
										echo 
										"
										<tr>
											<td class='text-center' colspan='2'>Nothing to show.</td>
										</tr>
										";
									}


								
								echo"
								</table>

  </div>


</body>";
?>

