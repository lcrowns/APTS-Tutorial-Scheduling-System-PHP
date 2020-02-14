<?php
include_once 'headeradmin.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';

//$subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);

$stmt = $subject->readAllSubjs();

  echo"

  <body style='background-color:gray;'>

    <br><br>
    <div class='container'>

   <div class='card border-danger mb-5' style='max-width: 90rem;'>
  <div class='card-header'><h1><p class='text-center'>Subjects</p></h1></div>


<form method='POST' action='viewsubjects.php'>

						&nbsp
						<input type='text' id='search' name='search' placeholder='Search here' style='width:1020px; height: 36px; margin-top: 5px; margin-bottom: 10px;'> <input class='btn btn-primary' type='submit' value='Search'>
     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Subject ID</p></th>
								 		<th scope='col'><p class='text-center'>Subject Name</p></th>
								 		<th scope='col'><p class='text-center'>Subject Description</p></th>
								 		<th scope='col'><p class='text-center'>Added By</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>

								 	</tr>

								 </thead>
								<tbody>";

								  if($_POST){
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
								else{
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr>
									<td><p class='text-center'>{$subjId}</p></td>
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
									<td><p class='text-center'>{$adfname} {$adlname}</p></td>
									<td><a class='btn btn-primary' href='viewonesubj.php?subjId={$subjId}' role='button'>Edit</a></td>
									</tr>
									</tbody>
									";
  								}
  							}


								
								echo"
								</table>

  </div>


</div>
</body>";
?>

