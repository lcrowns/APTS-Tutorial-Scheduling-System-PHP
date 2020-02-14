<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';


$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);

$stmt = $subject->viewSubjsAct();

  echo"

  <style>
  	tbody tr:hover{cursor:pointer;}
  </style>

  <body>

    <div class='container' style='margin:0; padding:0; margin-bottom:15px;'>

   <div class='card' style='max-width: 100%; margin:0;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Subject Name</p></th>
								 		<th scope='col'><p class='text-center'>Subject Description</p></th>

								 	</tr>

								 </thead>
								<tbody>";

								  if($_POST && $subject->searchSubjsAct($_POST['search'])->rowCount()>0){
  									$srch = $subject->searchSubjsAct($_POST['search']);
 									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);
								    echo"

									<tr onclick=\"window.location='viewonesubj.php?subjId={$subjId}';\">
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
									</tr>";

  }
}
								elseif($_POST && $subject->searchSubjsAct($_POST['search'])->rowCount()<1){
									echo 
										"
										<tr>
											<td class='text-center' colspan='2'>Nothing to show.</td>
										</tr>
										";
								}
									elseif($stmt->rowCount()>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr onclick=\"window.location='viewonesubj.php?subjId={$subjId}';\">
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
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


</div>
</body>";
?>

