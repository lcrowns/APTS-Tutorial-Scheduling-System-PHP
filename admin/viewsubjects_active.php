<?php
include_once 'headeradmin.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';


$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);

$stmt = $subject->viewSubjsAct();

  echo"

  <body>

    <div class='container' style='margin:0; padding:0; margin-bottom:15px;'>

   <div class='card' style='max-width: 100%; margin:0;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Subject Name</p></th>
								 		<th scope='col'><p class='text-center'>Subject Description</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>

								 	</tr>

								 </thead>
								<tbody>";
								  if(isset($_POST['search'])){
								  if($subject->searchSubjsAct($_POST['search'])->rowCount()>0){
  									$srch = $subject->searchSubjsAct($_POST['search']);
 									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);
								    echo"

									<tr onclick=\"window.location='viewonesubj.php?subjId={$subjId}';\">
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
									<td class='text-center'>
										<div class='text-center' style='margin:0; padding: 5px 0;'>";
										echo "<a href='changesubjstat.php?subjstat={$subjstat}&subjId={$subjId}' class='btn btn-danger'>Deactivate</a>";
										
										echo " <a href='deletesubj.php?subjId={$subjId}' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Delete subject?\\nAll the topics under this subject will be deleted.\\nAll the topics assigned to tutors under this subject will be removed.\"); '>Delete</a>
										</div>
									</td>
									</tr>";

  }
}
								elseif($subject->searchSubjsAct($_POST['search'])->rowCount()<1){
									echo 
										"
										<tr>
											<td class='text-center' colspan='3'>Nothing to show.</td>
										</tr>
										";
								}}
									elseif($stmt->rowCount()>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr onclick=\"window.location='viewonesubj.php?subjId={$subjId}';\">
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
									<td class='text-center'>
										<div class='text-center' style='margin:0; padding: 5px 0;'>";
										echo "<a href='changesubjstat.php?subjstat={$subjstat}&subjId={$subjId}' class='btn btn-danger'>Deactivate</a>";
										
										echo " <a href='deletesubj.php?subjId={$subjId}' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Delete subject?\\nAll the topics under this subject will be deleted.\\nAll the topics assigned to tutors under this subject will be removed.\"); '>Delete</a>
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


</div>
</body>";
?>

