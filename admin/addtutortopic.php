<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';

$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$subject = new Subject($db);

$stmt = $subject->viewSubjsAct();

?>

<div class="container">

	<h1 style="margin-bottom: 0;">Add Tutor Topic</h1>
    <a class="text-danger" href="viewonetutor.php?tutorId=<?php echo $tutorId;?>">[Back]</a>
    <br>
    <h3 class="float-left" style="margin-bottom: 0;">Select a Subject</h3>
    <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="width: 100%;">
    	<?php
    	echo"

  <body>

    <div class='container' style='margin:0; padding:0; margin-bottom:15px;'>

   <div class='card' style='max-width: 100%; margin:0;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Subject ID</p></th>
								 		<th scope='col'><p class='text-center'>Subject Name</p></th>
								 		<th scope='col'><p class='text-center'>Subject Description</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>

								 	</tr>

								 </thead>
								<tbody>";
       							if($stmt->rowCount()>0){
  									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									extract($row);
									echo"

									<tr>
									<td><p class='text-center'>{$subjId}</p></td>
									<td><p class='text-center'>{$subjname}</p></td>
									<td><p class='text-center'>{$subjdesc}</p></td>
									<td class='text-center'><a class='btn btn-danger' href='addtopic2.php?tutorId={$tutorId}&subjId={$subjId}' role='button'>Select</a></td>
									</tr>
									</tbody>
									";
  							}
  							}else{
										echo 
										"
										<tr>
											<td class='text-center' colspan='4'>Nothing to show.</td>
										</tr>
										";
									}


								
								echo"
								</table>";
							?>
        
    </div>
</div>
 
