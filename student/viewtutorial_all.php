<?php
include_once '../classes/tutorial.php';
include_once '../classes/account.php';
include_once '../classes/topic.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $_SESSION['userId'];
$account->readOneAccount();

$tutorial = new Tutorial($db);
$tutorial->acctId = $account->acctId;
$tutorial->tutorId = $thisaccountud;

$stmt = $tutorial->viewTutorialsAllS();







echo"

  <body>


   <div class='card' style='max-width: 100%; margin:0;margin-bottom: 15px;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Tutorial No.</p></th>
								 		<th scope='col'><p class='text-center'>Tutor</p></th>
								 		<th scope='col'><p class='text-center'>Tutee</p></th>
								 		<th scope='col'><p class='text-center'>Topic</p></th>
								 		<th scope='col'><p class='text-center'>Date</p></th>
								 		<th scope='col'><p class='text-center'>Time</p></th>
								 		<th scope='col'><p class='text-center'>Status</p></th>
								 	</tr>
								 </thead>
								<tbody>";

								  	if(($_POST) && $tutorial->searchTutorials($_POST['search'])->rowCount()>0){
  									$srch = $tutorial->searchTutorials($_POST['search']);
  									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);

								    echo"

									<tr>
									<td><p class='text-center'>{$tlistId}</p></td>
									<td><p class='text-center'>";echo $tutorial->getTutor($tutorId);echo "</p></td>
									<td><p class='text-center'>";echo $tutorial->getTutee($acctId); echo"</p></td>
									<td><p class='text-center'>";echo $tutorial->getTopic($topicId);echo "</p></td>
									<td><p class='text-center'>{$date}</p></td>
									<td><p class='text-center'>{$time}</p></td>
									<td><p class='text-center'>{$tListStatus}</p></td>
									<td class='text-center'><a class='btn btn-danger' href='viewonetutorial.php?tlistId={$tlistId}&tutorId={$tutorId}&acctId={$acctId}' role='button'>View</a></td>
									</tr>";

  }									
}								elseif($_POST && $tutorial->searchTutorials($_POST['search'])->rowCount()<1){
									echo 
										"
										<tr>
											<td class='text-center' colspan='8'>Nothing to show.</td>
										</tr>
										";
}
								elseif(($stmt->rowCount())>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									
									
									echo"

									<tr>
									<td><p class='text-center'>{$tlistId}</p></td>
									<td><p class='text-center'>";echo $tutorial->getTutor($tutorId);echo "</p></td>
									<td><p class='text-center'>";echo $tutorial->getTutee($acctId); echo"</p></td>
									<td><p class='text-center'>";echo $tutorial->getTopic($topicId);echo "</p></td>
									<td><p class='text-center'>{$date}</p></td>
									<td><p class='text-center'>{$time}</p></td>
									<td><p class='text-center'>{$tListStatus}</p></td>
									<td class='text-center'><a class='btn btn-danger' href='viewonetutorial.php?tlistId={$tlistId}&tutorId={$tutorId}&acctId={$acctId}' role='button'>View</a></td>
									</tr>
									</tbody>
									";
									}
									}else{
										echo 
										"
										<tr>
											<td class='text-center' colspan='8'>Nothing to show.</td>
										</tr>
										";
									}


								
								echo"
								</table>

  </div>


</body>";
?>

