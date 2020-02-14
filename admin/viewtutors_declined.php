<?php
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();

$tutor = new Tutor($db);

$stmt = $tutor->viewTutorsDec();


echo"

  <body>


   <div class='card' style='max-width: 100%; margin:0; margin-bottom: 15px;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Student ID</p></th>
								 		<th scope='col'><p class='text-center'>Student Name</p></th>
								 		<th scope='col'><p class='text-center'>Contact No.</p></th>
								 		<th scope='col'><p class='text-center'>Email</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>
								 	</tr>
								 </thead>
								<tbody>";

								  	if($_POST && $tutor->searchTutorsDec($_POST['search1'])->rowCount()>0){
  									$srch = $tutor->searchTutorsDec($_POST['search1']);
  									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);

								    echo"

									<tr>
									<td><p class='text-center'>{$userId}</p></td>
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td><p class='text-center'>{$contact}</p></td>
									<td><p class='text-center'>{$email}</p></td>
									<td class='text-center'><a class='btn btn-secondary' href='viewonetutor.php?tutorId={$tutorId}' role='button'>View</a></td>
									</tr>";

  }									
}								elseif($_POST && $tutor->searchTutorsDec($_POST['search1'])->rowCount()<1){
									echo 
										"
										<tr>
											<td class='text-center' colspan='5'>Nothing to show.</td>
										</tr>
										";
}
								elseif(($stmt->rowCount())>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr>
									<td><p class='text-center'>{$userId}</p></td>
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td><p class='text-center'>{$contact}</p></td>
									<td><p class='text-center'>{$email}</p></td>
									<td class='text-center'><a class='btn btn-secondary' href='viewonetutor.php?tutorId={$tutorId}' role='button'>View</a></td>
									</tr>
									</tbody>
									";
									}
									}else{
										echo 
										"
										<tr>
											<td class='text-center' colspan='5'>Nothing to show.</td>
										</tr>
										";
									}


								
								echo"
								</table>

  </div>


</body>";
?>

