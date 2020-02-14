<?php
include_once 'headeradmin.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();

$tutor = new Tutor($db);
$stmt = $tutor->viewtutorrequest();

echo"

  <body style='background-color:white;'>

    <br><br>
    <div class='container'>

   <div class='card border-secondary mb-5' style='max-width: 90rem;'>
  <div class='card-header'><h1><p class='text-center'>Tutor Requests</p></h1></div>


<form method='POST' action='viewsubjects.php'>

						
						<!--<input type='text' id='search' name='search' placeholder='Search here' style='width:1020px; height: 36px; margin-top: 5px; margin-bottom: 10px;'> <input class='btn btn-primary' type='submit' value='Search'>-->
     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Student ID</p></th>
								 		<th scope='col'><p class='text-center'>Tutor Name</p></th>
								 		<th scope='col'><p class='text-center'>Tutor Status</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>
								 	</tr>
								 </thead>
								<tbody>";

								  /*if($_POST){
  $srch = $subject->searchSubjs($_POST['search']);
  while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    extract($row);
								    echo"

									<tr>
									<td><p class='text-center'>{$subjId}</p></td>
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
									<td><p class='text-center'>{$adfname} {$adlname}</p></td>
									<td><a class='btn btn-primary' href='viewonesubj.php?subjId={$subjId}' role='button'>Edit</a></td>
									</tr>";

  }
}
								else{*/
									if (($stmt->rowCount())>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr>
									<td><p class='text-center'>{$userIds}</p></td>
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td><p class='text-center'>{$tutorStatus}</p></td>
									<td class='text-center'><a class='btn btn-success' href='viewonetutorreq.php?tutorId={$tutorId}' role='button'>View</a></td>
									</tr>
									</tbody>
									";
									}
									}else{
										echo 
										"
										<tr>
											<td class='text-center' colspan='4'>There are no Tutor Applications existing right now.</td>
										</tr>
										";
									}
  								
  							


								
								echo"
								</table>

  </div>


</div>
</body>";
?>

