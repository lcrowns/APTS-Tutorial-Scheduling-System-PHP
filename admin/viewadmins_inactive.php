<?php
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);

$stmt = $account->viewAdminsInact();


echo"

  <body>


   <div class='card' style='max-width: 100%; margin:0; margin-bottom: 15px;'>


<form method='POST'>

     
   
	  						<table class='table table-hover'>
								 <thead>
								 	<tr>
								 		<th scope='col'><p class='text-center'>Name</p></th>
								 		<th scope='col'><p class='text-center'>Action</p></th>
								 	</tr>
								 </thead>
								<tbody>";

								  	if(isset($_POST['search']) && $account->searchAdminsInact($_POST['search'])->rowCount()>0){
  									$srch = $account->searchAdminsInact($_POST['search']);
  									while($row=$srch->fetch(PDO::FETCH_ASSOC)){
    								extract($row);

								    echo"

									<tr onclick=\"window.location='viewoneaccount.php?userId={$userId}&loc=2';\">
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td>
									<div class='text-center' style='margin:0; padding: 5px 0;'>";
											echo "<a href='changestat.php?status={$status}&userId={$userId}' class='btn btn-danger'>Activate</a>";
											echo " <a href='deleteaccount.php?userId={$userId}&loc=2' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Are you sure?\"); '>Delete</a>
										</div>
									</td>
									</tr>";

  }									
}								elseif(isset($_POST['search']) && $account->searchAdminsInact($_POST['search'])->rowCount()<1){
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

									<tr onclick=\"window.location='viewoneaccount.php?userId={$userId}&loc=2';\">
									<td><p class='text-center'>{$fname} {$lname}</p></td>
									<td>
									<div class='text-center' style='margin:0; padding: 5px 0;'>";
											echo "<a href='changestat.php?status={$status}&userId={$userId}' class='btn btn-danger'>Activate</a>";
											echo " <a href='deleteaccount.php?userId={$userId}&loc=2' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Are you sure?\"); '>Delete</a>
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

