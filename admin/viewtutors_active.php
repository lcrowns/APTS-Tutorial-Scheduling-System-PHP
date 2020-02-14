<?php
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();

$tutor = new Tutor($db);

$stmt = $tutor->viewTutorsAct();


echo"
  <style>
  	tbody tr:hover p{ }
  	tbody tr:hover{cursor:pointer;}
  </style>

  <body>


   <div class='card' style='max-width: 100%; margin:0; margin-bottom: 15px;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Student ID</p></th>
								 		<th scope='col'><p class='text-center'>Student Name</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>
								 	</tr>
								 </thead>
								<tbody>";

								  	if(isset($_POST['search1']) && $tutor->searchTutorsAct($_POST['search1'])->rowCount()>0){
  									$srch = $tutor->searchTutorsAct($_POST['search1']);
  									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);

								    echo"

									<tr onclick=\"window.location='viewonetutor.php?tutorId={$userId}';\"
									>
									<td><p class='text-center'>{$userId}</p></td>
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td>
									<div class='text-center' style='margin:0; padding: 5px 0;'>
										<a href='changetutorstat.php?tutorStatus={$tutorStatus}&userId={$userId}' class='btn btn-danger'>Deactivate</a>
										<a href='deletetutor.php?userId={$userId}&loc=1' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Are you sure?\"); '>Delete</a>
									</div>
									</td>
									</tr>";

  }									
}								elseif($_POST && $tutor->searchTutorsAct($_POST['search1'])->rowCount()<1){
									echo 
										"
										<tr>
											<td class='text-center' colspan='3'>Nothing to show.</td>
										</tr>
										";
}
								elseif(($stmt->rowCount())>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr onclick=\"window.location='viewonetutor.php?tutorId={$userId}';\"
									>
									<td><p class='text-center'>{$userId}</p></td>
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td>
									<div class='text-center' style='margin:0; padding: 5px 0;'>
										<a href='changetutorstat.php?tutorStatus={$tutorStatus}&userId={$userId}' class='btn btn-danger'>Deactivate</a>
										<a href='deletetutor.php?userId={$userId}&loc=1' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Are you sure?\"); '>Delete</a>
									</div>
									</td>
									</tr>
									</tbody>
									";
									}
									}else{
										echo 
										"
										<tr>
											<td class='text-center' colspan='3'>Nothing to show.</td>
										</tr>
										";
									}


								
								echo"
								</table>

  </div>


</body>";
?>

